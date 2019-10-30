<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Accruals;
use App\Models\References\Accounts;
use App\Models\Accounting\BaseTimesheets;
use App\Models\References\Objects;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\AccrualTimesheets;
use App\Repositories\Accounting\AccrualTimesheetsRepository;
use App\Http\Requests\Accounting\AccrualTimesheetsCreateRequest;
use App\Http\Requests\Accounting\AccrualTimesheetsUpdateRequest;

/**
 * Class AccrualTimesheetsController: Контроллер расчета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class AccrualTimesheetsController extends BaseAccountingController {

    /**
     * @var AccrualTimesheetsRepository
     */
    private $accrualTimesheetsRepository;

    /**
     * @var path
     */
    private $path = 'acc/accrual-timesheets';

    public function __construct() {

        parent::__construct();

        $this->accrualTimesheetsRepository = app(AccrualTimesheetsRepository::class);

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

        $accrualTimesheetsList = $this->accrualTimesheetsRepository->getTable();

        return view('acc.accrual-timesheets.index',  
               compact('menu', 'title', 'accrualTimesheetsList'));
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
        $accrualTimesheetsList = $this->accrualTimesheetsRepository->getShow($id);

        return view('acc.accrual-timesheets.show', 
               compact('menu', 'title', 'accrualTimesheetsList'));
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
        $accrualsList = $this->accrualTimesheetsRepository->getListSelect(0);
        $accountsList = $this->accrualTimesheetsRepository->getListSelect(1);
        $baseTimesheetsList = $this->accrualTimesheetsRepository->getListSelect(2);
        $objectsList = $this->accrualTimesheetsRepository->getListSelect(3);
        $yearsList = $this->accrualTimesheetsRepository->getListSelect(4);
        $monthsList = $this->accrualTimesheetsRepository->getListSelect(5);

        return view('acc.accrual-timesheets.create', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'accountsList', 
                      'baseTimesheetsList', 
                      'objectsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccrualTimesheetsCreateRequest $request) {

        $data = $request->input();

        $result = (new AccrualTimesheets($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.accrual-timesheets.edit', $result->id)
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
        $accrualsList = $this->accrualTimesheetsRepository->getListSelect(0);
        $accountsList = $this->accrualTimesheetsRepository->getListSelect(1);
        $baseTimesheetsList = $this->accrualTimesheetsRepository->getListSelect(2);
        $objectsList = $this->accrualTimesheetsRepository->getListSelect(3);
        $yearsList = $this->accrualTimesheetsRepository->getListSelect(4);
        $monthsList = $this->accrualTimesheetsRepository->getListSelect(5);

        // Формируем содержание списка заполняемых полей input
        $accrualTimesheetsList = $this->accrualTimesheetsRepository->getEdit($id);

        return view('acc.accrual-timesheets.edit', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'accountsList', 
                      'baseTimesheetsList', 
                      'objectsList', 
                      'yearsList', 
                      'monthsList', 
                      'accrualTimesheetsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccrualTimesheetsUpdateRequest $request, $id) {

        $item = $this->accrualTimesheetsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.accrual-timesheets.edit', $item->id)
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

        $result = $this->accrualTimesheetsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.accrual-timesheets.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}