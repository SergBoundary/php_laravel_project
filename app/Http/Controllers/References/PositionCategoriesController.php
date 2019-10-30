<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\PositionCategories;
use App\Repositories\References\PositionCategoriesRepository;
use App\Http\Requests\References\PositionCategoriesCreateRequest;
use App\Http\Requests\References\PositionCategoriesUpdateRequest;

/**
 * Class PositionCategoriesController: Контроллер списка категорий должностей
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PositionCategoriesController extends BaseReferencesController {

    /**
     * @var PositionCategoriesRepository
     */
    private $positionCategoriesRepository;

    /**
     * @var path
     */
    private $path = 'ref/position-categories';

    public function __construct() {

        parent::__construct();

        $this->positionCategoriesRepository = app(PositionCategoriesRepository::class);

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

        $positionCategoriesList = $this->positionCategoriesRepository->getTable();

        return view('ref.position-categories.index',  
               compact('menu', 'title', 'positionCategoriesList'));
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
        $positionCategoriesList = $this->positionCategoriesRepository->getShow($id);

        return view('ref.position-categories.show', 
               compact('menu', 'title', 'positionCategoriesList'));
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

        return view('ref.position-categories.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PositionCategoriesCreateRequest $request) {

        $data = $request->input();

        $result = (new PositionCategories($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.position-categories.edit', $result->id)
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
        $positionCategoriesList = $this->positionCategoriesRepository->getEdit($id);

        return view('ref.position-categories.edit', 
               compact('menu', 'title', 'positionCategoriesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PositionCategoriesUpdateRequest $request, $id) {

        $item = $this->positionCategoriesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.position-categories.edit', $item->id)
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

        $result = $this->positionCategoriesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.position-categories.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}