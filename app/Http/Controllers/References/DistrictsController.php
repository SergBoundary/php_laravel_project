<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Repositories\References\DistrictsRepository;
use App\Http\Requests\References\DistrictsCreateRequest;
use App\Http\Requests\References\DistrictsUpdateRequest;

/**
 * Class DistrictsController: Контроллер списка областей (штатов, земель, воевудств)
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class DistrictsController extends BaseReferencesController {

    /**
     * @var DistrictsRepository
     */
    private $districtsRepository;

    /**
     * @var path
     */
    private $path = 'ref/districts';

    public function __construct() {

        parent::__construct();

        $this->districtsRepository = app(DistrictsRepository::class);

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

        $districtsList = $this->districtsRepository->getListTable();

        return view('references.districts.index',  
               compact('menu', 'title', 'districtsList'));
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
        $districtsList = $this->districtsRepository->getShow($id);

        return view('references.districts.show', 
               compact('menu', 'title', 'districtsList'));
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
        $countryList = $this->districtsRepository->getListSelect(0);

        return view('references.districts.create', 
               compact('menu', 'title', 
                      'countryList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictsCreateRequest $request) {

        $data = $request->input();

        $result = (new Districts($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.districts.edit', $result->id)
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
        $countryList = $this->districtsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $districtsList = $this->districtsRepository->getEdit($id);

        return view('references.districts.edit', 
               compact('menu', 'title', 
                      'countryList', 
                      'districtsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictsUpdateRequest $request, $id) {

        $item = $this->districtsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.districts.edit', $item->id)
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

        $result = $this->districtsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.districts.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}