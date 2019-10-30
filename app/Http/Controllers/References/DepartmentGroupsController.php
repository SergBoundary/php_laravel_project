<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\DepartmentGroups;
use App\Repositories\References\DepartmentGroupsRepository;
use App\Http\Requests\References\DepartmentGroupsCreateRequest;
use App\Http\Requests\References\DepartmentGroupsUpdateRequest;

/**
 * Class DepartmentGroupsController: Контроллер списка групп подразделений компании
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class DepartmentGroupsController extends BaseReferencesController {

    /**
     * @var DepartmentGroupsRepository
     */
    private $departmentGroupsRepository;

    /**
     * @var path
     */
    private $path = 'ref/department-groups';

    public function __construct() {

        parent::__construct();

        $this->departmentGroupsRepository = app(DepartmentGroupsRepository::class);

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

        $departmentGroupsList = $this->departmentGroupsRepository->getTable();

        return view('ref.department-groups.index',  
               compact('menu', 'title', 'departmentGroupsList'));
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
        $departmentGroupsList = $this->departmentGroupsRepository->getShow($id);

        return view('ref.department-groups.show', 
               compact('menu', 'title', 'departmentGroupsList'));
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

        return view('ref.department-groups.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentGroupsCreateRequest $request) {

        $data = $request->input();

        $result = (new DepartmentGroups($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.department-groups.edit', $result->id)
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

        // Формируем содержание списка заполняемых полей input
        $departmentGroupsList = $this->departmentGroupsRepository->getEdit($id);

        return view('ref.department-groups.edit', 
               compact('menu', 'title', 'departmentGroupsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentGroupsUpdateRequest $request, $id) {

        $item = $this->departmentGroupsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.department-groups.edit', $item->id)
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

        $result = $this->departmentGroupsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.department-groups.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}