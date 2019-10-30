<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\FamilyRelationTypes;
use App\Repositories\References\FamilyRelationTypesRepository;
use App\Http\Requests\References\FamilyRelationTypesCreateRequest;
use App\Http\Requests\References\FamilyRelationTypesUpdateRequest;

/**
 * Class FamilyRelationTypesController: Контроллер списка видов степени родства
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class FamilyRelationTypesController extends BaseReferencesController {

    /**
     * @var FamilyRelationTypesRepository
     */
    private $familyRelationTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/family-relation-types';

    public function __construct() {

        parent::__construct();

        $this->familyRelationTypesRepository = app(FamilyRelationTypesRepository::class);

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

        $familyRelationTypesList = $this->familyRelationTypesRepository->getTable();

        return view('ref.family-relation-types.index',  
               compact('menu', 'title', 'familyRelationTypesList'));
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
        $familyRelationTypesList = $this->familyRelationTypesRepository->getShow($id);

        return view('ref.family-relation-types.show', 
               compact('menu', 'title', 'familyRelationTypesList'));
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

        return view('ref.family-relation-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyRelationTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new FamilyRelationTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.family-relation-types.edit', $result->id)
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
        $familyRelationTypesList = $this->familyRelationTypesRepository->getEdit($id);

        return view('ref.family-relation-types.edit', 
               compact('menu', 'title', 'familyRelationTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(FamilyRelationTypesUpdateRequest $request, $id) {

        $item = $this->familyRelationTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.family-relation-types.edit', $item->id)
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

        $result = $this->familyRelationTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.family-relation-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}