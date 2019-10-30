<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\CommunicationTypes;
use App\Repositories\References\CommunicationTypesRepository;
use App\Http\Requests\References\CommunicationTypesCreateRequest;
use App\Http\Requests\References\CommunicationTypesUpdateRequest;

/**
 * Class CommunicationTypesController: Контроллер списка способов коммуникации с работником
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class CommunicationTypesController extends BaseReferencesController {

    /**
     * @var CommunicationTypesRepository
     */
    private $communicationTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/communication-types';

    public function __construct() {

        parent::__construct();

        $this->communicationTypesRepository = app(CommunicationTypesRepository::class);

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

        $communicationTypesList = $this->communicationTypesRepository->getTable();

        return view('ref.communication-types.index',  
               compact('menu', 'title', 'communicationTypesList'));
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
        $communicationTypesList = $this->communicationTypesRepository->getShow($id);

        return view('ref.communication-types.show', 
               compact('menu', 'title', 'communicationTypesList'));
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

        return view('ref.communication-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommunicationTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new CommunicationTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.communication-types.edit', $result->id)
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
        $communicationTypesList = $this->communicationTypesRepository->getEdit($id);

        return view('ref.communication-types.edit', 
               compact('menu', 'title', 'communicationTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CommunicationTypesUpdateRequest $request, $id) {

        $item = $this->communicationTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.communication-types.edit', $item->id)
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

        $result = $this->communicationTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.communication-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}