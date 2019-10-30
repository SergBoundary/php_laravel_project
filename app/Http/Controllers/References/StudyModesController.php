<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\StudyModes;
use App\Repositories\References\StudyModesRepository;
use App\Http\Requests\References\StudyModesCreateRequest;
use App\Http\Requests\References\StudyModesUpdateRequest;

/**
 * Class StudyModesController: Контроллер списка режимов (форм) обучения
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class StudyModesController extends BaseReferencesController {

    /**
     * @var StudyModesRepository
     */
    private $studyModesRepository;

    /**
     * @var path
     */
    private $path = 'ref/study-modes';

    public function __construct() {

        parent::__construct();

        $this->studyModesRepository = app(StudyModesRepository::class);

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

        $studyModesList = $this->studyModesRepository->getTable();

        return view('ref.study-modes.index',  
               compact('menu', 'title', 'studyModesList'));
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
        $studyModesList = $this->studyModesRepository->getShow($id);

        return view('ref.study-modes.show', 
               compact('menu', 'title', 'studyModesList'));
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

        return view('ref.study-modes.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StudyModesCreateRequest $request) {

        $data = $request->input();

        $result = (new StudyModes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.study-modes.edit', $result->id)
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
        $studyModesList = $this->studyModesRepository->getEdit($id);

        return view('ref.study-modes.edit', 
               compact('menu', 'title', 'studyModesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StudyModesUpdateRequest $request, $id) {

        $item = $this->studyModesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.study-modes.edit', $item->id)
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

        $result = $this->studyModesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.study-modes.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}