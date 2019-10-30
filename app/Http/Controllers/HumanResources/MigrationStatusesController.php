<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\HumanResources\MigrationStatuses;
use App\Repositories\HumanResources\MigrationStatusesRepository;
use App\Http\Requests\HumanResources\MigrationStatusesCreateRequest;
use App\Http\Requests\HumanResources\MigrationStatusesUpdateRequest;

/**
 * Class MigrationStatusesController: Контроллер учета миграционного статуса работника в стране
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class MigrationStatusesController extends BaseHumanResourcesController {

    /**
     * @var MigrationStatusesRepository
     */
    private $migrationStatusesRepository;

    /**
     * @var path
     */
    private $path = 'hr/migration-statuses';

    public function __construct() {

        parent::__construct();

        $this->migrationStatusesRepository = app(MigrationStatusesRepository::class);

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

        $migrationStatusesList = $this->migrationStatusesRepository->getTable();

        return view('hr.migration-statuses.index',  
               compact('menu', 'title', 'migrationStatusesList'));
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
        $migrationStatusesList = $this->migrationStatusesRepository->getShow($id);

        return view('hr.migration-statuses.show', 
               compact('menu', 'title', 'migrationStatusesList'));
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
        $personalCardsList = $this->migrationStatusesRepository->getListSelect(0);
        $countriesList = $this->migrationStatusesRepository->getListSelect(1);

        return view('hr.migration-statuses.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MigrationStatusesCreateRequest $request) {

        $data = $request->input();

        $result = (new MigrationStatuses($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.migration-statuses.edit', $result->id)
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
        $personalCardsList = $this->migrationStatusesRepository->getListSelect(0);
        $countriesList = $this->migrationStatusesRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $migrationStatusesList = $this->migrationStatusesRepository->getEdit($id);

        return view('hr.migration-statuses.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList', 
                      'migrationStatusesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MigrationStatusesUpdateRequest $request, $id) {

        $item = $this->migrationStatusesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.migration-statuses.edit', $item->id)
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

        $result = $this->migrationStatusesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.migration-statuses.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}