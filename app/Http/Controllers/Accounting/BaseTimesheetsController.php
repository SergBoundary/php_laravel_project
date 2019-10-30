<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Accruals;
use App\Models\References\HoursBalanceClassifiers;
use App\Models\References\Departments;
use App\Models\References\Accounts;
use App\Models\References\Positions;
use App\Models\References\Objects;
use App\Models\Accounting\BaseTimesheets;
use App\Repositories\Accounting\BaseTimesheetsRepository;
use App\Http\Requests\Accounting\BaseTimesheetsCreateRequest;
use App\Http\Requests\Accounting\BaseTimesheetsUpdateRequest;

/**
 * Class BaseTimesheetsController: Контроллер учета отработанного времени (табель)
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class BaseTimesheetsController extends BaseAccountingController {

    /**
     * @var BaseTimesheetsRepository
     */
    private $baseTimesheetsRepository;

    /**
     * @var path
     */
    private $path = 'acc/base-timesheets';

    public function __construct() {

        parent::__construct();

        $this->baseTimesheetsRepository = app(BaseTimesheetsRepository::class);

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

        $baseTimesheetsList = $this->baseTimesheetsRepository->getTable();

        return view('acc.base-timesheets.index',  
               compact('menu', 'title', 'baseTimesheetsList'));
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
        $baseTimesheetsList = $this->baseTimesheetsRepository->getShow($id);

        return view('acc.base-timesheets.show', 
               compact('menu', 'title', 'baseTimesheetsList'));
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
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $accrualsList = $this->baseTimesheetsRepository->getListSelect(3);
        $hoursBalanceClassifiersList = $this->baseTimesheetsRepository->getListSelect(4);
        $departmentsList = $this->baseTimesheetsRepository->getListSelect(5);
        $accountsList = $this->baseTimesheetsRepository->getListSelect(6);
        $positionsList = $this->baseTimesheetsRepository->getListSelect(7);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(8);

        return view('acc.base-timesheets.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'accrualsList', 
                      'hoursBalanceClassifiersList', 
                      'departmentsList', 
                      'accountsList', 
                      'positionsList', 
                      'objectsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BaseTimesheetsCreateRequest $request) {

        $data = $request->input();

        $result = (new BaseTimesheets($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.base-timesheets.edit', $result->id)
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
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $accrualsList = $this->baseTimesheetsRepository->getListSelect(3);
        $hoursBalanceClassifiersList = $this->baseTimesheetsRepository->getListSelect(4);
        $departmentsList = $this->baseTimesheetsRepository->getListSelect(5);
        $accountsList = $this->baseTimesheetsRepository->getListSelect(6);
        $positionsList = $this->baseTimesheetsRepository->getListSelect(7);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(8);

        // Формируем содержание списка заполняемых полей input
        $baseTimesheetsList = $this->baseTimesheetsRepository->getEdit($id);

        return view('acc.base-timesheets.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'accrualsList', 
                      'hoursBalanceClassifiersList', 
                      'departmentsList', 
                      'accountsList', 
                      'positionsList', 
                      'objectsList', 
                      'baseTimesheetsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BaseTimesheetsUpdateRequest $request, $id) {

        $item = $this->baseTimesheetsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.base-timesheets.edit', $item->id)
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

        $result = $this->baseTimesheetsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.base-timesheets.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}