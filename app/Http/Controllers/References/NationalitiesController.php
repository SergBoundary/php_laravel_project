<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Nationalities;
use App\Repositories\References\NationalitiesRepository;
use App\Http\Requests\References\NationalitiesCreateRequest;
use App\Http\Requests\References\NationalitiesUpdateRequest;

/**
 * Class NationalitiesController: Контроллер списка национальностей
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class NationalitiesController extends BaseReferencesController {

    /**
     * @var NationalitiesRepository
     */
    private $nationalitiesRepository;

    /**
     * @var path
     */
    private $path = 'ref/nationalities';

    public function __construct() {

        parent::__construct();

        $this->nationalitiesRepository = app(NationalitiesRepository::class);

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

        $nationalitiesList = $this->nationalitiesRepository->getTable();

        return view('ref.nationalities.index',  
               compact('menu', 'title', 'nationalitiesList'));
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
        $nationalitiesList = $this->nationalitiesRepository->getShow($id);

        return view('ref.nationalities.show', 
               compact('menu', 'title', 'nationalitiesList'));
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

        return view('ref.nationalities.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NationalitiesCreateRequest $request) {

        $data = $request->input();

        $result = (new Nationalities($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.nationalities.edit', $result->id)
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
        $nationalitiesList = $this->nationalitiesRepository->getEdit($id);

        return view('ref.nationalities.edit', 
               compact('menu', 'title', 'nationalitiesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(NationalitiesUpdateRequest $request, $id) {

        $item = $this->nationalitiesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.nationalities.edit', $item->id)
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

        $result = $this->nationalitiesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.nationalities.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}