<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Subordinations;
use App\Models\References\PositionProfessions;
use App\Models\References\PositionCategories;
use App\Models\References\Positions;
use App\Repositories\References\PositionsRepository;
use App\Http\Requests\References\PositionsCreateRequest;
use App\Http\Requests\References\PositionsUpdateRequest;

/**
 * Class PositionsController: Контроллер списка должностей
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PositionsController extends BaseReferencesController {

    /**
     * @var PositionsRepository
     */
    private $positionsRepository;

    /**
     * @var path
     */
    private $path = 'ref/positions';

    public function __construct() {

        parent::__construct();

        $this->positionsRepository = app(PositionsRepository::class);

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

        $positionsList = $this->positionsRepository->getTable();

        return view('ref.positions.index',  
               compact('menu', 'title', 'positionsList'));
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
        $positionsList = $this->positionsRepository->getShow($id);

        return view('ref.positions.show', 
               compact('menu', 'title', 'positionsList'));
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
        $subordinationsList = $this->positionsRepository->getListSelect(0);
        $positionProfessionsList = $this->positionsRepository->getListSelect(1);
        $positionCategoriesList = $this->positionsRepository->getListSelect(2);

        return view('ref.positions.create', 
               compact('menu', 'title', 
                      'subordinationsList', 
                      'positionProfessionsList', 
                      'positionCategoriesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PositionsCreateRequest $request) {

        $data = $request->input();

        $result = (new Positions($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.positions.edit', $result->id)
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
        $subordinationsList = $this->positionsRepository->getListSelect(0);
        $positionProfessionsList = $this->positionsRepository->getListSelect(1);
        $positionCategoriesList = $this->positionsRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $positionsList = $this->positionsRepository->getEdit($id);

        return view('ref.positions.edit', 
               compact('menu', 'title', 
                      'subordinationsList', 
                      'positionProfessionsList', 
                      'positionCategoriesList', 
                      'positionsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PositionsUpdateRequest $request, $id) {

        $item = $this->positionsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.positions.edit', $item->id)
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

        $result = $this->positionsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.positions.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}