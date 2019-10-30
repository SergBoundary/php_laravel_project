<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\DocumentTypes;
use App\Repositories\References\DocumentTypesRepository;
use App\Http\Requests\References\DocumentTypesCreateRequest;
use App\Http\Requests\References\DocumentTypesUpdateRequest;

/**
 * Class DocumentTypesController: Контроллер списка видов кадровых документов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class DocumentTypesController extends BaseReferencesController {

    /**
     * @var DocumentTypesRepository
     */
    private $documentTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/document-types';

    public function __construct() {

        parent::__construct();

        $this->documentTypesRepository = app(DocumentTypesRepository::class);

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

        $documentTypesList = $this->documentTypesRepository->getTable();

        return view('ref.document-types.index',  
               compact('menu', 'title', 'documentTypesList'));
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
        $documentTypesList = $this->documentTypesRepository->getShow($id);

        return view('ref.document-types.show', 
               compact('menu', 'title', 'documentTypesList'));
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

        return view('ref.document-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new DocumentTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.document-types.edit', $result->id)
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
        $documentTypesList = $this->documentTypesRepository->getEdit($id);

        return view('ref.document-types.edit', 
               compact('menu', 'title', 'documentTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypesUpdateRequest $request, $id) {

        $item = $this->documentTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.document-types.edit', $item->id)
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

        $result = $this->documentTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.document-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}