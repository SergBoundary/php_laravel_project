<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\GroupingTypesOfAbsences;
use App\Repositories\References\GroupingTypesOfAbsencesRepository;
use App\Http\Requests\References\GroupingTypesOfAbsencesCreateRequest;
use App\Http\Requests\References\GroupingTypesOfAbsencesUpdateRequest;

/**
 * Class GroupingTypesOfAbsencesController: Контроллер списка видов отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class GroupingTypesOfAbsencesController extends BaseReferencesController {

    /**
     * @var GroupingTypesOfAbsencesRepository
     */
    private $groupingTypesOfAbsencesRepository;

    /**
     * @var path
     */
    private $path = 'ref/grouping-types-of-absences';

    public function __construct() {

        parent::__construct();

        $this->groupingTypesOfAbsencesRepository = app(GroupingTypesOfAbsencesRepository::class);

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

        $groupingTypesOfAbsencesList = $this->groupingTypesOfAbsencesRepository->getTable();

        return view('ref.grouping-types-of-absences.index',  
               compact('menu', 'title', 'groupingTypesOfAbsencesList'));
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
        $groupingTypesOfAbsencesList = $this->groupingTypesOfAbsencesRepository->getShow($id);

        return view('ref.grouping-types-of-absences.show', 
               compact('menu', 'title', 'groupingTypesOfAbsencesList'));
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

        return view('ref.grouping-types-of-absences.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupingTypesOfAbsencesCreateRequest $request) {

        $data = $request->input();

        $result = (new GroupingTypesOfAbsences($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.grouping-types-of-absences.edit', $result->id)
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
        $groupingTypesOfAbsencesList = $this->groupingTypesOfAbsencesRepository->getEdit($id);

        return view('ref.grouping-types-of-absences.edit', 
               compact('menu', 'title', 'groupingTypesOfAbsencesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(GroupingTypesOfAbsencesUpdateRequest $request, $id) {

        $item = $this->groupingTypesOfAbsencesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.grouping-types-of-absences.edit', $item->id)
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

        $result = $this->groupingTypesOfAbsencesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.grouping-types-of-absences.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}