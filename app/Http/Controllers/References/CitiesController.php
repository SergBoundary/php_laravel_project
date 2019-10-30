<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions;
use App\Models\References\Cities;
use App\Repositories\References\CitiesRepository;
use App\Http\Requests\References\CitiesCreateRequest;
use App\Http\Requests\References\CitiesUpdateRequest;

/**
 * Class CitiesController: Контроллер списка населенных пунктов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class CitiesController extends BaseReferencesController {

    /**
     * @var CitiesRepository
     */
    private $citiesRepository;

    /**
     * @var path
     */
    private $path = 'ref/cities';

    public function __construct() {

        parent::__construct();

        $this->citiesRepository = app(CitiesRepository::class);

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

        $citiesList = $this->citiesRepository->getTable();

        return view('ref.cities.index',  
               compact('menu', 'title', 'citiesList'));
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
        $citiesList = $this->citiesRepository->getShow($id);

        return view('ref.cities.show', 
               compact('menu', 'title', 'citiesList'));
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
        $countriesList = $this->citiesRepository->getListSelect(0);
        $districtsList = $this->citiesRepository->getListSelect(1);
        $regionsList = $this->citiesRepository->getListSelect(2);

        return view('ref.cities.create', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CitiesCreateRequest $request) {

        $data = $request->input();

        $result = (new Cities($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.cities.edit', $result->id)
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
        $countriesList = $this->citiesRepository->getListSelect(0);
        $districtsList = $this->citiesRepository->getListSelect(1);
        $regionsList = $this->citiesRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $citiesList = $this->citiesRepository->getEdit($id);

        return view('ref.cities.edit', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList', 
                      'citiesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CitiesUpdateRequest $request, $id) {

        $item = $this->citiesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.cities.edit', $item->id)
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

        $result = $this->citiesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.cities.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}