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
use App\Models\Settings\Menu;
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
    public function index() {
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menu::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Удержания с сотрудников";

        $retentionsList = $this->retentionsRepository->getTable();

        return view('acc.retentions.index',  
               compact('menu', 'title', 'access', 'retentionsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menu::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Карточка удержания";

        // Формируем содержание списка заполняемых полей input
        $retentionsList = $this->retentionsRepository->getShow($id);

        return view('acc.retentions.show', 
               compact('menu', 'title', 'access', 'retentionsList'));
    }

    /**
     * Метод создания представления новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Новое удержание";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->retentionsRepository->getListSelect(0);
        $yearsList = $this->retentionsRepository->getListSelect(1);
        $monthsList = $this->retentionsRepository->getListSelect(2);
        $retentionTypesList = $this->retentionsRepository->getListSelect(3);

        return view('acc.retentions.create', 
               compact('menu', 'title', 
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

        $result = (new Retentions($data))->create($data);

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
    public function edit($id) {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
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
               compact('menu', 'title', 
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