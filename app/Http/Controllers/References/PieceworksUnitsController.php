<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\PieceworksUnits;
use App\Repositories\References\PieceworksUnitsRepository;
use App\Http\Requests\References\PieceworksUnitsCreateRequest;
use App\Http\Requests\References\PieceworksUnitsUpdateRequest;

/**
 * Class PieceworksUnitsController: Контроллер списка единиц изменерия сдельных работ
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PieceworksUnitsController extends BaseReferencesController {

    /**
     * @var PieceworksUnitsRepository
     */
    private $pieceworksUnitsRepository;

    /**
     * @var path
     */
    private $path = 'ref/pieceworks-units';

    public function __construct() {

        parent::__construct();

        $this->pieceworksUnitsRepository = app(PieceworksUnitsRepository::class);

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

        $pieceworksUnitsList = $this->pieceworksUnitsRepository->getTable();

        return view('ref.pieceworks-units.index',  
               compact('menu', 'title', 'pieceworksUnitsList'));
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
        $pieceworksUnitsList = $this->pieceworksUnitsRepository->getShow($id);

        return view('ref.pieceworks-units.show', 
               compact('menu', 'title', 'pieceworksUnitsList'));
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

        return view('ref.pieceworks-units.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PieceworksUnitsCreateRequest $request) {

        $data = $request->input();

        $result = (new PieceworksUnits($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.pieceworks-units.edit', $result->id)
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
        $pieceworksUnitsList = $this->pieceworksUnitsRepository->getEdit($id);

        return view('ref.pieceworks-units.edit', 
               compact('menu', 'title', 'pieceworksUnitsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PieceworksUnitsUpdateRequest $request, $id) {

        $item = $this->pieceworksUnitsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.pieceworks-units.edit', $item->id)
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

        $result = $this->pieceworksUnitsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.pieceworks-units.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}