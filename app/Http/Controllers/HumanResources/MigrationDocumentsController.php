<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\MigrationStatuses;
use App\Models\HumanResources\MigrationDocuments;
use App\Repositories\HumanResources\MigrationDocumentsRepository;
use App\Http\Requests\HumanResources\MigrationDocumentsCreateRequest;
use App\Http\Requests\HumanResources\MigrationDocumentsUpdateRequest;

/**
 * Class MigrationDocumentsController: Контроллер учета документов работника для легализации пребывания в стране
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class MigrationDocumentsController extends BaseHumanResourcesController {

    /**
     * @var MigrationDocumentsRepository
     */
    private $migrationDocumentsRepository;

    /**
     * @var path
     */
    private $path = 'hr/migration-documents';

    public function __construct() {

        parent::__construct();

        $this->migrationDocumentsRepository = app(MigrationDocumentsRepository::class);

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

        $migrationDocumentsList = $this->migrationDocumentsRepository->getTable();

        return view('hr.migration-documents.index',  
               compact('menu', 'title', 'migrationDocumentsList'));
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
        $migrationDocumentsList = $this->migrationDocumentsRepository->getShow($id);

        return view('hr.migration-documents.show', 
               compact('menu', 'title', 'migrationDocumentsList'));
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
        $personalCardsList = $this->migrationDocumentsRepository->getListSelect(0);
        $migrationStatusesList = $this->migrationDocumentsRepository->getListSelect(1);

        return view('hr.migration-documents.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'migrationStatusesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MigrationDocumentsCreateRequest $request) {

        $data = $request->input();

        $result = (new MigrationDocuments($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.migration-documents.edit', $result->id)
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
        $personalCardsList = $this->migrationDocumentsRepository->getListSelect(0);
        $migrationStatusesList = $this->migrationDocumentsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $migrationDocumentsList = $this->migrationDocumentsRepository->getEdit($id);

        return view('hr.migration-documents.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'migrationStatusesList', 
                      'migrationDocumentsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MigrationDocumentsUpdateRequest $request, $id) {

        $item = $this->migrationDocumentsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.migration-documents.edit', $item->id)
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

        $result = $this->migrationDocumentsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.migration-documents.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}