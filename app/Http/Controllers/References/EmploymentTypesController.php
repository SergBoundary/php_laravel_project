<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\EmploymentTypes;
use App\Repositories\References\EmploymentTypesRepository;
use App\Http\Requests\References\EmploymentTypesCreateRequest;
use App\Http\Requests\References\EmploymentTypesUpdateRequest;

/**
 * Class EmploymentTypesController: Контроллер списка видов трудовых отношений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class EmploymentTypesController extends BaseReferencesController {

    /**
     * @var EmploymentTypesRepository
     */
    private $employmentTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/employment-types';

    public function __construct() {

        parent::__construct();

        $this->employmentTypesRepository = app(EmploymentTypesRepository::class);

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

        $employmentTypesList = $this->employmentTypesRepository->getTable();

        return view('ref.employment-types.index',  
               compact('menu', 'title', 'employmentTypesList'));
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
        $employmentTypesList = $this->employmentTypesRepository->getShow($id);

        return view('ref.employment-types.show', 
               compact('menu', 'title', 'employmentTypesList'));
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

        return view('ref.employment-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmploymentTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new EmploymentTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.employment-types.edit', $result->id)
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
        $employmentTypesList = $this->employmentTypesRepository->getEdit($id);

        return view('ref.employment-types.edit', 
               compact('menu', 'title', 'employmentTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmploymentTypesUpdateRequest $request, $id) {

        $item = $this->employmentTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.employment-types.edit', $item->id)
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

        $result = $this->employmentTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.employment-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}