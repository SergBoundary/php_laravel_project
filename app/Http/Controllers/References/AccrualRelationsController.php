<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Accruals;
use App\Models\References\AccrualRelations;
use App\Repositories\References\AccrualRelationsRepository;
use App\Http\Requests\References\AccrualRelationsCreateRequest;
use App\Http\Requests\References\AccrualRelationsUpdateRequest;

/**
 * Class AccrualRelationsController: Контроллер списка зависимостей начислений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AccrualRelationsController extends BaseReferencesController {

    /**
     * @var AccrualRelationsRepository
     */
    private $accrualRelationsRepository;

    /**
     * @var path
     */
    private $path = 'ref/accrual-relations';

    public function __construct() {

        parent::__construct();

        $this->accrualRelationsRepository = app(AccrualRelationsRepository::class);

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

        $accrualRelationsList = $this->accrualRelationsRepository->getTable();

        return view('ref.accrual-relations.index',  
               compact('menu', 'title', 'accrualRelationsList'));
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
        $accrualRelationsList = $this->accrualRelationsRepository->getShow($id);

        return view('ref.accrual-relations.show', 
               compact('menu', 'title', 'accrualRelationsList'));
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
        $accrualsList = $this->accrualRelationsRepository->getListSelect(0);

        return view('ref.accrual-relations.create', 
               compact('menu', 'title', 
                      'accrualsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccrualRelationsCreateRequest $request) {

        $data = $request->input();

        $result = (new AccrualRelations($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.accrual-relations.edit', $result->id)
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
        $accrualsList = $this->accrualRelationsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $accrualRelationsList = $this->accrualRelationsRepository->getEdit($id);

        return view('ref.accrual-relations.edit', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'accrualRelationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccrualRelationsUpdateRequest $request, $id) {

        $item = $this->accrualRelationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.accrual-relations.edit', $item->id)
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

        $result = $this->accrualRelationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.accrual-relations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}