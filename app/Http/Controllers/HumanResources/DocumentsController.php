<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\Documents;
use App\Models\References\DocumentTypes;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Users;
use App\Models\HumanResources\Users;
use App\Models\HumanResources\Documents;
use App\Repositories\HumanResources\DocumentsRepository;
use App\Http\Requests\HumanResources\DocumentsCreateRequest;
use App\Http\Requests\HumanResources\DocumentsUpdateRequest;

/**
 * Class DocumentsController: Контроллер учета кадровых документов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class DocumentsController extends BaseHumanResourcesController {

    /**
     * @var DocumentsRepository
     */
    private $documentsRepository;

    /**
     * @var path
     */
    private $path = 'hr/documents';

    public function __construct() {

        parent::__construct();

        $this->documentsRepository = app(DocumentsRepository::class);

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

        $documentsList = $this->documentsRepository->getTable();

        return view('hr.documents.index',  
               compact('menu', 'title', 'documentsList'));
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
        $documentsList = $this->documentsRepository->getShow($id);

        return view('hr.documents.show', 
               compact('menu', 'title', 'documentsList'));
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
        $documentsList = $this->documentsRepository->getListSelect(0);
        $documentTypesList = $this->documentsRepository->getListSelect(1);
        $personalCardsList = $this->documentsRepository->getListSelect(2);
        $usersList = $this->documentsRepository->getListSelect(3);
        $usersList = $this->documentsRepository->getListSelect(4);

        return view('hr.documents.create', 
               compact('menu', 'title', 
                      'documentsList', 
                      'documentTypesList', 
                      'personalCardsList', 
                      'usersList', 
                      'usersList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentsCreateRequest $request) {

        $data = $request->input();

        $result = (new Documents($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.documents.edit', $result->id)
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
        $documentsList = $this->documentsRepository->getListSelect(0);
        $documentTypesList = $this->documentsRepository->getListSelect(1);
        $personalCardsList = $this->documentsRepository->getListSelect(2);
        $usersList = $this->documentsRepository->getListSelect(3);
        $usersList = $this->documentsRepository->getListSelect(4);

        // Формируем содержание списка заполняемых полей input
        $documentsList = $this->documentsRepository->getEdit($id);

        return view('hr.documents.edit', 
               compact('menu', 'title', 
                      'documentsList', 
                      'documentTypesList', 
                      'personalCardsList', 
                      'usersList', 
                      'usersList', 
                      'documentsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentsUpdateRequest $request, $id) {

        $item = $this->documentsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.documents.edit', $item->id)
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

        $result = $this->documentsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.documents.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}