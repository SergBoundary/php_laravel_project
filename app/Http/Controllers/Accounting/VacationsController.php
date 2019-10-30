<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\Documents;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\AbsenceClassifiers;
use App\Models\References\PhraseLists;
use App\Models\Accounting\Vacations;
use App\Repositories\Accounting\VacationsRepository;
use App\Http\Requests\Accounting\VacationsCreateRequest;
use App\Http\Requests\Accounting\VacationsUpdateRequest;

/**
 * Class VacationsController: Контроллер учета отпусков
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class VacationsController extends BaseAccountingController {

    /**
     * @var VacationsRepository
     */
    private $vacationsRepository;

    /**
     * @var path
     */
    private $path = 'acc/vacations';

    public function __construct() {

        parent::__construct();

        $this->vacationsRepository = app(VacationsRepository::class);

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

        $vacationsList = $this->vacationsRepository->getTable();

        return view('acc.vacations.index',  
               compact('menu', 'title', 'vacationsList'));
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
        $vacationsList = $this->vacationsRepository->getShow($id);

        return view('acc.vacations.show', 
               compact('menu', 'title', 'vacationsList'));
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
        $documentsList = $this->vacationsRepository->getListSelect(0);
        $personalCardsList = $this->vacationsRepository->getListSelect(1);
        $absenceClassifiersList = $this->vacationsRepository->getListSelect(2);
        $phraseListsList = $this->vacationsRepository->getListSelect(3);

        return view('acc.vacations.create', 
               compact('menu', 'title', 
                      'documentsList', 
                      'personalCardsList', 
                      'absenceClassifiersList', 
                      'phraseListsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VacationsCreateRequest $request) {

        $data = $request->input();

        $result = (new Vacations($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.vacations.edit', $result->id)
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
        $documentsList = $this->vacationsRepository->getListSelect(0);
        $personalCardsList = $this->vacationsRepository->getListSelect(1);
        $absenceClassifiersList = $this->vacationsRepository->getListSelect(2);
        $phraseListsList = $this->vacationsRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $vacationsList = $this->vacationsRepository->getEdit($id);

        return view('acc.vacations.edit', 
               compact('menu', 'title', 
                      'documentsList', 
                      'personalCardsList', 
                      'absenceClassifiersList', 
                      'phraseListsList', 
                      'vacationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VacationsUpdateRequest $request, $id) {

        $item = $this->vacationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.vacations.edit', $item->id)
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

        $result = $this->vacationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.vacations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}