<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Objects;
use App\Models\HumanResources\Teams;
use App\Models\HumanResources\Allocations;
use App\Repositories\HumanResources\AllocationsRepository;
use App\Http\Requests\HumanResources\AllocationsCreateRequest;
use App\Http\Requests\HumanResources\AllocationsUpdateRequest;
use App\Models\Settings\Menu;
use Illuminate\Support\Facades\Auth;

/**
 * Class AllocationsController: Контроллер учета должностных назначений работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class AllocationsController extends BaseHumanResourcesController {

    /**
     * @var AllocationsRepository
     */
    private $allocationsRepository;

    /**
     * @var path
     */
    private $path = 'hr/allocations';

    public function __construct() {

        parent::__construct();

        $this->allocationsRepository = app(AllocationsRepository::class);

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
        $title = "Перемещения по предприятию";

        $allocationsList = $this->allocationsRepository->getTable();

        return view('hr.allocations.index',  
               compact('menu', 'title', 'access', 'allocationsList'));
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
        $title = "Карточка перемещения";

        // Формируем содержание списка заполняемых полей input
        $allocationsList = $this->allocationsRepository->getShow($id);

        return view('hr.allocations.show', 
               compact('menu', 'title', 'access', 'allocationsList'));
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
        $title = "Новое перемещение";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->allocationsRepository->getListSelect(0);
        $objectsList = $this->allocationsRepository->getListSelect(1);
        $teamsList = $this->allocationsRepository->getListSelect(2);

        return view('hr.allocations.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'objectsList', 
                      'teamsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AllocationsCreateRequest $request) {

        $data = $request->input();
//        dd($data['personal_card_id'], $data['start']);
        $item = $this->allocationsRepository->getEditExpiry($data['personal_card_id'], $data['start']);
        if(!empty($item)) {
            $item->save();
//            $data = $request->all();
//            $result = $item->update($data);
//            $result = $item->update($item);
        }
//        dd($item);
        $result = (new Allocations($data))->create($data);
//        dd($result);
        if($result) {
            return redirect()
                ->route('hr.allocations.edit', $result->id)
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
        $title = "Карточка перемещения";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->allocationsRepository->getListSelect(0);
        $objectsList = $this->allocationsRepository->getListSelect(1);
        $teamsList = $this->allocationsRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $allocationsList = $this->allocationsRepository->getEdit($id);

        return view('hr.allocations.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'objectsList', 
                      'teamsList', 
                      'allocationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AllocationsUpdateRequest $request, $id) {

        $item = $this->allocationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.allocations.edit', $item->id)
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

        $result = $this->allocationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.allocations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}