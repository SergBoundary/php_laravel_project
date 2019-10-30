<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\HumanResources\BorderCrossings;
use App\Repositories\HumanResources\BorderCrossingsRepository;
use App\Http\Requests\HumanResources\BorderCrossingsCreateRequest;
use App\Http\Requests\HumanResources\BorderCrossingsUpdateRequest;

/**
 * Class BorderCrossingsController: Контроллер учета пересечения границы страны пребывания работником
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class BorderCrossingsController extends BaseHumanResourcesController {

    /**
     * @var BorderCrossingsRepository
     */
    private $borderCrossingsRepository;

    /**
     * @var path
     */
    private $path = 'hr/border-crossings';

    public function __construct() {

        parent::__construct();

        $this->borderCrossingsRepository = app(BorderCrossingsRepository::class);

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

        $borderCrossingsList = $this->borderCrossingsRepository->getTable();

        return view('hr.border-crossings.index',  
               compact('menu', 'title', 'borderCrossingsList'));
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
        $borderCrossingsList = $this->borderCrossingsRepository->getShow($id);

        return view('hr.border-crossings.show', 
               compact('menu', 'title', 'borderCrossingsList'));
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
        $personalCardsList = $this->borderCrossingsRepository->getListSelect(0);
        $countriesOutList = $this->borderCrossingsRepository->getListSelect(1);
        $countriesInList = $this->borderCrossingsRepository->getListSelect(2);

        return view('hr.border-crossings.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesOutList', 
                      'countriesInList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BorderCrossingsCreateRequest $request) {

        $data = $request->input();

        $result = (new BorderCrossings($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.border-crossings.edit', $result->id)
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
        $personalCardsList = $this->borderCrossingsRepository->getListSelect(0);
        $countriesList = $this->borderCrossingsRepository->getListSelect(1);
        $countriesList = $this->borderCrossingsRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $borderCrossingsList = $this->borderCrossingsRepository->getEdit($id);

        return view('hr.border-crossings.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList', 
                      'countriesList', 
                      'borderCrossingsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BorderCrossingsUpdateRequest $request, $id) {

        $item = $this->borderCrossingsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.border-crossings.edit', $item->id)
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

        $result = $this->borderCrossingsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.border-crossings.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}