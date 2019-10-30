<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\FamilyRelationTypes;
use App\Models\HumanResources\EmployeeFamilies;
use App\Repositories\HumanResources\EmployeeFamiliesRepository;
use App\Http\Requests\HumanResources\EmployeeFamiliesCreateRequest;
use App\Http\Requests\HumanResources\EmployeeFamiliesUpdateRequest;

/**
 * Class EmployeeFamiliesController: Контроллер учета влияния близкого окружения
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class EmployeeFamiliesController extends BaseHumanResourcesController {

    /**
     * @var EmployeeFamiliesRepository
     */
    private $employeeFamiliesRepository;

    /**
     * @var path
     */
    private $path = 'hr/employee-families';

    public function __construct() {

        parent::__construct();

        $this->employeeFamiliesRepository = app(EmployeeFamiliesRepository::class);

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

        $employeeFamiliesList = $this->employeeFamiliesRepository->getTable();

        return view('hr.employee-families.index',  
               compact('menu', 'title', 'employeeFamiliesList'));
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
        $employeeFamiliesList = $this->employeeFamiliesRepository->getShow($id);

        return view('hr.employee-families.show', 
               compact('menu', 'title', 'employeeFamiliesList'));
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
        $personalCardsList = $this->employeeFamiliesRepository->getListSelect(0);
        $familyRelationTypesList = $this->employeeFamiliesRepository->getListSelect(1);

        return view('hr.employee-families.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'familyRelationTypesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeFamiliesCreateRequest $request) {

        $data = $request->input();

        $result = (new EmployeeFamilies($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.employee-families.edit', $result->id)
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
        $personalCardsList = $this->employeeFamiliesRepository->getListSelect(0);
        $familyRelationTypesList = $this->employeeFamiliesRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $employeeFamiliesList = $this->employeeFamiliesRepository->getEdit($id);

        return view('hr.employee-families.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'familyRelationTypesList', 
                      'employeeFamiliesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeFamiliesUpdateRequest $request, $id) {

        $item = $this->employeeFamiliesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.employee-families.edit', $item->id)
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

        $result = $this->employeeFamiliesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.employee-families.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}