<?php

namespace App\Http\Controllers\Calculations;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Calculations\Paychecks;
use App\Repositories\Calculations\PaychecksRepository;
use App\Http\Requests\Calculations\PaychecksCreateRequest;
use App\Http\Requests\Calculations\PaychecksUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaychecksController: Контроллер обслуживания расчетного листа по заработной плате
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Calculations
 */
class PaychecksController extends BaseCalculationsController {

    /**
     * @var PaychecksRepository
     */
    private $paychecksRepository;

    /**
     * @var path
     */
    private $path = 'calc/paychecks';

    public function __construct() {

        parent::__construct();

        $this->paychecksRepository = app(PaychecksRepository::class);

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
        $title = $menu->where('path', $this->path)
                ->first();

        $paychecksList = $this->paychecksRepository->getTable();

        return view('calc.paychecks.index',  
               compact('menu', 'interface', 'title', 'access', 'paychecksList'));
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
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка заполняемых полей input
        $paychecksList = $this->paychecksRepository->getShow($id);

        return view('calc.paychecks.show', 
               compact('menu', 'interface', 'title', 'access', 'paychecksList'));
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
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->paychecksRepository->getListSelect(0);
        $yearsList = $this->paychecksRepository->getListSelect(1);
        $monthsList = $this->paychecksRepository->getListSelect(2);

        return view('calc.paychecks.create', 
               compact('menu', 'interface', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaychecksCreateRequest $request) {

        $data = $request->input();

        $result = (new Paychecks($data))->create($data);

        if($result) {
            return redirect()
                ->route('calc.paychecks.edit', $result->id)
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
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->paychecksRepository->getListSelect(0);
        $yearsList = $this->paychecksRepository->getListSelect(1);
        $monthsList = $this->paychecksRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $paychecksList = $this->paychecksRepository->getEdit($id);

        return view('calc.paychecks.edit', 
               compact('menu', 'interface', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'paychecksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PaychecksUpdateRequest $request, $id) {

        $item = $this->paychecksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('calc.paychecks.edit', $item->id)
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

        $result = $this->paychecksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('calc.paychecks.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}