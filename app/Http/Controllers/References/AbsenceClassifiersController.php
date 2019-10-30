<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Accruals;
use App\Models\References\GroupingTypesOfAbsences;
use App\Models\References\AbsenceClassifiers;
use App\Repositories\References\AbsenceClassifiersRepository;
use App\Http\Requests\References\AbsenceClassifiersCreateRequest;
use App\Http\Requests\References\AbsenceClassifiersUpdateRequest;

/**
 * Class AbsenceClassifiersController: Справочник. Классификатор отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AbsenceClassifiersController extends BaseReferencesController {

    /**
     * @var AbsenceClassifiersRepository
     */
    private $absenceClassifiersRepository;

    /**
     * @var path
     */
    private $path = 'ref/absence-classifiers';

    public function __construct() {

        parent::__construct();

        $this->absenceClassifiersRepository = app(AbsenceClassifiersRepository::class);

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

        $absenceClassifiersList = $this->absenceClassifiersRepository->getTable();

        return view('ref.absence-classifiers.index',  
               compact('menu', 'title', 'absenceClassifiersList'));
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
        $absenceClassifiersList = $this->absenceClassifiersRepository->getShow($id);

        return view('ref.absence-classifiers.show', 
               compact('menu', 'title', 'absenceClassifiersList'));
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
        $accrualsList = $this->absenceClassifiersRepository->getListSelect(0);
        $groupingTypesOfAbsencesList = $this->absenceClassifiersRepository->getListSelect(1);

        return view('ref.absence-classifiers.create', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'groupingTypesOfAbsencesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenceClassifiersCreateRequest $request) {

        $data = $request->input();

        $result = (new AbsenceClassifiers($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.absence-classifiers.edit', $result->id)
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
        $accrualsList = $this->absenceClassifiersRepository->getListSelect(0);
        $groupingTypesOfAbsencesList = $this->absenceClassifiersRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $absenceClassifiersList = $this->absenceClassifiersRepository->getEdit($id);

        return view('ref.absence-classifiers.edit', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'groupingTypesOfAbsencesList', 
                      'absenceClassifiersList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AbsenceClassifiersUpdateRequest $request, $id) {

        $item = $this->absenceClassifiersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.absence-classifiers.edit', $item->id)
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

        $result = $this->absenceClassifiersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.absence-classifiers.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}