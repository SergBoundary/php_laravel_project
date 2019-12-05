<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Departments;
use App\Repositories\References\DepartmentsRepository;
use App\Http\Requests\References\DepartmentsCreateRequest;
use App\Http\Requests\References\DepartmentsUpdateRequest;

/**
 * Class DepartmentsController: Контроллер списка подразделений компании
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class DepartmentsController extends BaseReferencesController {

    /**
     * @var DepartmentsRepository
     */
    private $departmentsRepository;

    /**
     * @var path
     */
    private $path = 'ref/departments';

    public function __construct() {

        parent::__construct();

        $this->departmentsRepository = app(DepartmentsRepository::class);

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

        $departmentsList = $this->departmentsRepository->getTable();

        return view('ref.departments.index',  
               compact('menu', 'title', 'departmentsList'));
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
        $departmentsList = $this->departmentsRepository->getShow($id);

        return view('ref.departments.show', 
               compact('menu', 'title', 'departmentsList'));
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

        return view('ref.departments.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentsCreateRequest $request) {

        $data = $request->input();

        $result = (new Departments($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.departments.edit', $result->id)
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
        $departmentsList = $this->departmentsRepository->getEdit($id);

        return view('ref.departments.edit', 
               compact('menu', 'title', 
                      'departmentsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentsUpdateRequest $request, $id) {

        $item = $this->departmentsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.departments.edit', $item->id)
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

        $result = $this->departmentsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.departments.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}