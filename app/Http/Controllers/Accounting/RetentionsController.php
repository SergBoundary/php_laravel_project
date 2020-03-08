<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\RetentionTypes;
use App\Models\Accounting\Retentions;
use App\Repositories\Accounting\RetentionsRepository;
use App\Http\Requests\Accounting\RetentionsCreateRequest;
use App\Http\Requests\Accounting\RetentionsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class RetentionsController: Контроллер учета удержаний
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class RetentionsController extends BaseAccountingController {

    /**
     * @var RetentionsRepository
     */
    private $retentionsRepository;

    /**
     * @var path
     */
    private $path = 'acc/retentions';

    public function __construct() {

        parent::__construct();

        $this->retentionsRepository = app(RetentionsRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest', compact('interface'));
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Удержания с сотрудников";

        $retentionsList = $this->retentionsRepository->getTable();

        return view('acc.retentions.index',  
               compact('menu', 'interface', 'title', 'access', 'retentionsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest', compact('interface'));
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Карточка удержания";

        // Формируем содержание списка заполняемых полей input
        $retentionsList = $this->retentionsRepository->getShow($id);

        return view('acc.retentions.show', 
               compact('menu', 'interface', 'title', 'access', 'retentionsList'));
    }

    /**
     * Метод создания представления новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Новое удержание";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->retentionsRepository->getListSelect(0);
        $yearsList = $this->retentionsRepository->getListSelect(1);
        $monthsList = $this->retentionsRepository->getListSelect(2);
        $retentionTypesList = $this->retentionsRepository->getListSelect(3);

        return view('acc.retentions.create', 
               compact('menu', 'interface', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'retentionTypesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RetentionsCreateRequest $request) {

        $data = $request->input();
        
        // Формируем удержание сумм с сотрудника
        $newData['user_id'] = Auth::user()->id;
        $newData['personal_card_id'] = $data['personal_card_id'];
        $newData['year_id'] = $data['year_id'];
        $newData['month_id'] = $data['month_id'];
        $newData['retention_type_id'] = $data['retention_type_id'];
        $newData['amount'] = $data['amount'];
        
        $result = (new Retentions($newData))->create($newData);

        if($result) {
            return redirect()
                ->route('acc.retentions.edit', $result->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }

    /**
     * Метод создания представления изменения
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Карточка удержания";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->retentionsRepository->getListSelect(0);
        $yearsList = $this->retentionsRepository->getListSelect(1);
        $monthsList = $this->retentionsRepository->getListSelect(2);
        $retentionTypesList = $this->retentionsRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $retentionsList = $this->retentionsRepository->getEdit($id);

        return view('acc.retentions.edit', 
               compact('menu', 'interface', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'retentionTypesList', 
                      'retentionsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RetentionsUpdateRequest $request, $id) {

        $item = $this->retentionsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.retentions.edit', $item->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }

    /**
     * Удаление выбранной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $result = $this->retentionsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.retentions.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}