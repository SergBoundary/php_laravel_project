<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\MilitaryAccounting;
use App\Repositories\HumanResources\MilitaryAccountingRepository;
use App\Http\Requests\HumanResources\MilitaryAccountingCreateRequest;
use App\Http\Requests\HumanResources\MilitaryAccountingUpdateRequest;

/**
 * Class MilitaryAccountingController: Контроллер воинского учета работников
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class MilitaryAccountingController extends BaseHumanResourcesController {

    /**
     * @var MilitaryAccountingRepository
     */
    private $militaryAccountingRepository;

    /**
     * @var path
     */
    private $path = 'hr/military-accounting';

    public function __construct() {

        parent::__construct();

        $this->militaryAccountingRepository = app(MilitaryAccountingRepository::class);

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

        $militaryAccountingList = $this->militaryAccountingRepository->getTable();

        return view('hr.military-accounting.index',  
               compact('menu', 'title', 'militaryAccountingList'));
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
        $militaryAccountingList = $this->militaryAccountingRepository->getShow($id);

        return view('hr.military-accounting.show', 
               compact('menu', 'title', 'militaryAccountingList'));
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
        $personalCardsList = $this->militaryAccountingRepository->getListSelect(0);

        return view('hr.military-accounting.create', 
               compact('menu', 'title', 
                      'personalCardsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MilitaryAccountingCreateRequest $request) {

        $data = $request->input();

        $result = (new MilitaryAccounting($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.military-accounting.edit', $result->id)
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
        $personalCardsList = $this->militaryAccountingRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $militaryAccountingList = $this->militaryAccountingRepository->getEdit($id);

        return view('hr.military-accounting.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'militaryAccountingList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MilitaryAccountingUpdateRequest $request, $id) {

        $item = $this->militaryAccountingRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.military-accounting.edit', $item->id)
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

        $result = $this->militaryAccountingRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.military-accounting.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}