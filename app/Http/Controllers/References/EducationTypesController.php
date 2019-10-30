<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\EducationTypes;
use App\Repositories\References\EducationTypesRepository;
use App\Http\Requests\References\EducationTypesCreateRequest;
use App\Http\Requests\References\EducationTypesUpdateRequest;

/**
 * Class EducationTypesController: Контроллер списка уровней образования
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class EducationTypesController extends BaseReferencesController {

    /**
     * @var EducationTypesRepository
     */
    private $educationTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/education-types';

    public function __construct() {

        parent::__construct();

        $this->educationTypesRepository = app(EducationTypesRepository::class);

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

        $educationTypesList = $this->educationTypesRepository->getTable();

        return view('ref.education-types.index',  
               compact('menu', 'title', 'educationTypesList'));
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
        $educationTypesList = $this->educationTypesRepository->getShow($id);

        return view('ref.education-types.show', 
               compact('menu', 'title', 'educationTypesList'));
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

        return view('ref.education-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EducationTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new EducationTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.education-types.edit', $result->id)
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
        $educationTypesList = $this->educationTypesRepository->getEdit($id);

        return view('ref.education-types.edit', 
               compact('menu', 'title', 'educationTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EducationTypesUpdateRequest $request, $id) {

        $item = $this->educationTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.education-types.edit', $item->id)
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

        $result = $this->educationTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.education-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}