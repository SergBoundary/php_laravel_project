<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions;
use App\Repositories\References\RegionsRepository;
use App\Http\Requests\References\RegionsCreateRequest;
use App\Http\Requests\References\RegionsUpdateRequest;

/**
 * Class RegionsController: Контроллер списка районов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class RegionsController extends BaseReferencesController {

    /**
     * @var RegionsRepository
     */
    private $regionsRepository;

    /**
     * @var path
     */
    private $path = 'ref/regions';

    public function __construct() {

        parent::__construct();

        $this->regionsRepository = app(RegionsRepository::class);

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

        $regionsList = $this->regionsRepository->getTable();

        return view('ref.regions.index',  
               compact('menu', 'title', 'regionsList'));
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
        $regionsList = $this->regionsRepository->getShow($id);

        return view('ref.regions.show', 
               compact('menu', 'title', 'regionsList'));
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
        $countriesList = $this->regionsRepository->getListSelect(0);
        $districtsList = $this->regionsRepository->getListSelect(1);

        return view('ref.regions.create', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RegionsCreateRequest $request) {

        $data = $request->input();

        $result = (new Regions($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.regions.edit', $result->id)
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
        $countriesList = $this->regionsRepository->getListSelect(0);
        $districtsList = $this->regionsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $regionsList = $this->regionsRepository->getEdit($id);

        return view('ref.regions.edit', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RegionsUpdateRequest $request, $id) {

        $item = $this->regionsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.regions.edit', $item->id)
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

        $result = $this->regionsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.regions.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}