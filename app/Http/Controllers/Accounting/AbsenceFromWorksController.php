<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\AbsenceClassifiers;
use App\Models\Accounting\AbsenceFromWorks;
use App\Repositories\Accounting\AbsenceFromWorksRepository;
use App\Http\Requests\Accounting\AbsenceFromWorksCreateRequest;
use App\Http\Requests\Accounting\AbsenceFromWorksUpdateRequest;

/**
 * Class AbsenceFromWorksController: Контроллер учета отсутствия на работе
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class AbsenceFromWorksController extends BaseAccountingController {

    /**
     * @var AbsenceFromWorksRepository
     */
    private $absenceFromWorksRepository;

    /**
     * @var path
     */
    private $path = 'acc/absence-from-works';

    public function __construct() {

        parent::__construct();

        $this->absenceFromWorksRepository = app(AbsenceFromWorksRepository::class);

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

        $absenceFromWorksList = $this->absenceFromWorksRepository->getTable();

        return view('acc.absence-from-works.index',  
               compact('menu', 'title', 'absenceFromWorksList'));
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
        $absenceFromWorksList = $this->absenceFromWorksRepository->getShow($id);

        return view('acc.absence-from-works.show', 
               compact('menu', 'title', 'absenceFromWorksList'));
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
        $personalCardsList = $this->absenceFromWorksRepository->getListSelect(0);
        $absenceClassifiersList = $this->absenceFromWorksRepository->getListSelect(1);

        return view('acc.absence-from-works.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'absenceClassifiersList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenceFromWorksCreateRequest $request) {

        $data = $request->input();

        $result = (new AbsenceFromWorks($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.absence-from-works.edit', $result->id)
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
        $personalCardsList = $this->absenceFromWorksRepository->getListSelect(0);
        $absenceClassifiersList = $this->absenceFromWorksRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $absenceFromWorksList = $this->absenceFromWorksRepository->getEdit($id);

        return view('acc.absence-from-works.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'absenceClassifiersList', 
                      'absenceFromWorksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AbsenceFromWorksUpdateRequest $request, $id) {

        $item = $this->absenceFromWorksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.absence-from-works.edit', $item->id)
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

        $result = $this->absenceFromWorksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.absence-from-works.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}