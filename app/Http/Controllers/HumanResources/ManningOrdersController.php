<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\ManningTables;
use App\Models\HumanResources\ManningOrders;
use App\Repositories\HumanResources\ManningOrdersRepository;
use App\Http\Requests\HumanResources\ManningOrdersCreateRequest;
use App\Http\Requests\HumanResources\ManningOrdersUpdateRequest;

/**
 * Class ManningOrdersController: Контроллер учета должностных назначений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class ManningOrdersController extends BaseHumanResourcesController {

    /**
     * @var ManningOrdersRepository
     */
    private $manningOrdersRepository;

    /**
     * @var path
     */
    private $path = 'hr/manning-orders';

    public function __construct() {

        parent::__construct();

        $this->manningOrdersRepository = app(ManningOrdersRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        $manningOrdersList = $this->manningOrdersRepository->getTable();

        return view('hr.manning-orders.index',  
               compact('menu', 'title', 'manningOrdersList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка заполняемых полей input
        $manningOrdersList = $this->manningOrdersRepository->getShow($id);

        return view('hr.manning-orders.show', 
               compact('menu', 'title', 'manningOrdersList'));
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
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->manningOrdersRepository->getListSelect(0);
        $manningTablesList = $this->manningOrdersRepository->getListSelect(1);

        return view('hr.manning-orders.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'manningTablesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ManningOrdersCreateRequest $request) {

        $data = $request->input();

        $result = (new ManningOrders($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.manning-orders.edit', $result->id)
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
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->manningOrdersRepository->getListSelect(0);
        $manningTablesList = $this->manningOrdersRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $manningOrdersList = $this->manningOrdersRepository->getEdit($id);

        return view('hr.manning-orders.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'manningTablesList', 
                      'manningOrdersList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ManningOrdersUpdateRequest $request, $id) {

        $item = $this->manningOrdersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.manning-orders.edit', $item->id)
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

        $result = $this->manningOrdersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.manning-orders.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}