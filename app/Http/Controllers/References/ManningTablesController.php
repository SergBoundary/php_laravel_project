<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\Ranks;
use App\Models\References\ManningTables;
use App\Repositories\References\ManningTablesRepository;
use App\Http\Requests\References\ManningTablesCreateRequest;
use App\Http\Requests\References\ManningTablesUpdateRequest;

/**
 * Class ManningTablesController: Справочник. Штатное расписание - список количеств, окладов и квалификации работников
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class ManningTablesController extends BaseReferencesController {

    /**
     * @var ManningTablesRepository
     */
    private $manningTablesRepository;

    /**
     * @var path
     */
    private $path = 'ref/manning-tables';

    public function __construct() {

        parent::__construct();

        $this->manningTablesRepository = app(ManningTablesRepository::class);

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

        $manningTablesList = $this->manningTablesRepository->getTable();

        return view('ref.manning-tables.index',  
               compact('menu', 'title', 'manningTablesList'));
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
        $manningTablesList = $this->manningTablesRepository->getShow($id);

        return view('ref.manning-tables.show', 
               compact('menu', 'title', 'manningTablesList'));
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
        $departmentsList = $this->manningTablesRepository->getListSelect(0);
        $positionsList = $this->manningTablesRepository->getListSelect(1);
        $ranksList = $this->manningTablesRepository->getListSelect(2);

        return view('ref.manning-tables.create', 
               compact('menu', 'title', 
                      'departmentsList', 
                      'positionsList', 
                      'ranksList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ManningTablesCreateRequest $request) {

        $data = $request->input();

        $result = (new ManningTables($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.manning-tables.edit', $result->id)
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
        $departmentsList = $this->manningTablesRepository->getListSelect(0);
        $positionsList = $this->manningTablesRepository->getListSelect(1);
        $ranksList = $this->manningTablesRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $manningTablesList = $this->manningTablesRepository->getEdit($id);

        return view('ref.manning-tables.edit', 
               compact('menu', 'title', 
                      'departmentsList', 
                      'positionsList', 
                      'ranksList', 
                      'manningTablesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ManningTablesUpdateRequest $request, $id) {

        $item = $this->manningTablesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.manning-tables.edit', $item->id)
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

        $result = $this->manningTablesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.manning-tables.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}