<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\WorkWeekTypes;
use App\Repositories\References\WorkWeekTypesRepository;
use App\Http\Requests\References\WorkWeekTypesCreateRequest;
use App\Http\Requests\References\WorkWeekTypesUpdateRequest;

/**
 * Class WorkWeekTypesController: Контроллер списка видов рабочих недель
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class WorkWeekTypesController extends BaseReferencesController {

    /**
     * @var WorkWeekTypesRepository
     */
    private $workWeekTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/work-week-types';

    public function __construct() {

        parent::__construct();

        $this->workWeekTypesRepository = app(WorkWeekTypesRepository::class);

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

        $workWeekTypesList = $this->workWeekTypesRepository->getTable();

        return view('ref.work-week-types.index',  
               compact('menu', 'title', 'workWeekTypesList'));
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
        $workWeekTypesList = $this->workWeekTypesRepository->getShow($id);

        return view('ref.work-week-types.show', 
               compact('menu', 'title', 'workWeekTypesList'));
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

        return view('ref.work-week-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(WorkWeekTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new WorkWeekTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.work-week-types.edit', $result->id)
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
        $workWeekTypesList = $this->workWeekTypesRepository->getEdit($id);

        return view('ref.work-week-types.edit', 
               compact('menu', 'title', 'workWeekTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(WorkWeekTypesUpdateRequest $request, $id) {

        $item = $this->workWeekTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.work-week-types.edit', $item->id)
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

        $result = $this->workWeekTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.work-week-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}