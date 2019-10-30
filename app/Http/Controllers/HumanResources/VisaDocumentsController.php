<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\VisaStatuses;
use App\Models\HumanResources\VisaDocuments;
use App\Repositories\HumanResources\VisaDocumentsRepository;
use App\Http\Requests\HumanResources\VisaDocumentsCreateRequest;
use App\Http\Requests\HumanResources\VisaDocumentsUpdateRequest;

/**
 * Class VisaDocumentsController: Контроллер учета документов работника для получения визы и въезда в страну
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class VisaDocumentsController extends BaseHumanResourcesController {

    /**
     * @var VisaDocumentsRepository
     */
    private $visaDocumentsRepository;

    /**
     * @var path
     */
    private $path = 'hr/visa-documents';

    public function __construct() {

        parent::__construct();

        $this->visaDocumentsRepository = app(VisaDocumentsRepository::class);

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

        $visaDocumentsList = $this->visaDocumentsRepository->getTable();

        return view('hr.visa-documents.index',  
               compact('menu', 'title', 'visaDocumentsList'));
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
        $visaDocumentsList = $this->visaDocumentsRepository->getShow($id);

        return view('hr.visa-documents.show', 
               compact('menu', 'title', 'visaDocumentsList'));
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
        $personalCardsList = $this->visaDocumentsRepository->getListSelect(0);
        $visaStatusesList = $this->visaDocumentsRepository->getListSelect(1);

        return view('hr.visa-documents.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'visaStatusesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VisaDocumentsCreateRequest $request) {

        $data = $request->input();

        $result = (new VisaDocuments($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.visa-documents.edit', $result->id)
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
        $personalCardsList = $this->visaDocumentsRepository->getListSelect(0);
        $visaStatusesList = $this->visaDocumentsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $visaDocumentsList = $this->visaDocumentsRepository->getEdit($id);

        return view('hr.visa-documents.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'visaStatusesList', 
                      'visaDocumentsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VisaDocumentsUpdateRequest $request, $id) {

        $item = $this->visaDocumentsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.visa-documents.edit', $item->id)
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

        $result = $this->visaDocumentsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.visa-documents.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}