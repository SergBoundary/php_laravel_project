<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\Objects;
use App\Models\References\Teams;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Accruals;
use App\Models\References\EmploymentTypes;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Accounts;
use App\Models\References\TaxScales;
use App\Models\References\Currencies;
use App\Models\References\CurrencyKurses;
use App\Models\Accounting\EmployeeAccrualMonths;
use App\Repositories\Accounting\EmployeeAccrualMonthsRepository;
use App\Http\Requests\Accounting\EmployeeAccrualMonthsCreateRequest;
use App\Http\Requests\Accounting\EmployeeAccrualMonthsUpdateRequest;

/**
 * Class EmployeeAccrualMonthsController: Контроллер учета сумм начислений работникам за месяц
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class EmployeeAccrualMonthsController extends BaseAccountingController {

    /**
     * @var EmployeeAccrualMonthsRepository
     */
    private $employeeAccrualMonthsRepository;

    /**
     * @var path
     */
    private $path = 'acc/employee-accrual-months';

    public function __construct() {

        parent::__construct();

        $this->employeeAccrualMonthsRepository = app(EmployeeAccrualMonthsRepository::class);

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

        $employeeAccrualMonthsList = $this->employeeAccrualMonthsRepository->getTable();

        return view('acc.employee-accrual-months.index',  
               compact('menu', 'title', 'employeeAccrualMonthsList'));
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
        $employeeAccrualMonthsList = $this->employeeAccrualMonthsRepository->getShow($id);

        return view('acc.employee-accrual-months.show', 
               compact('menu', 'title', 'employeeAccrualMonthsList'));
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
        $yearsList = $this->employeeAccrualMonthsRepository->getListSelect(0);
        $monthsList = $this->employeeAccrualMonthsRepository->getListSelect(1);
        $departmentsList = $this->employeeAccrualMonthsRepository->getListSelect(2);
        $positionsList = $this->employeeAccrualMonthsRepository->getListSelect(3);
        $objectsList = $this->employeeAccrualMonthsRepository->getListSelect(4);
        $teamsList = $this->employeeAccrualMonthsRepository->getListSelect(5);
        $personalCardsList = $this->employeeAccrualMonthsRepository->getListSelect(6);
        $accrualsList = $this->employeeAccrualMonthsRepository->getListSelect(7);
        $employmentTypesList = $this->employeeAccrualMonthsRepository->getListSelect(8);
        $yearsList = $this->employeeAccrualMonthsRepository->getListSelect(9);
        $monthsList = $this->employeeAccrualMonthsRepository->getListSelect(10);
        $accountsList = $this->employeeAccrualMonthsRepository->getListSelect(11);
        $taxScalesList = $this->employeeAccrualMonthsRepository->getListSelect(12);
        $currenciesList = $this->employeeAccrualMonthsRepository->getListSelect(13);
        $currencyKursesList = $this->employeeAccrualMonthsRepository->getListSelect(14);

        return view('acc.employee-accrual-months.create', 
               compact('menu', 'title', 
                      'yearsList', 
                      'monthsList', 
                      'departmentsList', 
                      'positionsList', 
                      'objectsList', 
                      'teamsList', 
                      'personalCardsList', 
                      'accrualsList', 
                      'employmentTypesList', 
                      'yearsList', 
                      'monthsList', 
                      'accountsList', 
                      'taxScalesList', 
                      'currenciesList', 
                      'currencyKursesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeAccrualMonthsCreateRequest $request) {

        $data = $request->input();

        $result = (new EmployeeAccrualMonths($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-months.edit', $result->id)
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
        $yearsList = $this->employeeAccrualMonthsRepository->getListSelect(0);
        $monthsList = $this->employeeAccrualMonthsRepository->getListSelect(1);
        $departmentsList = $this->employeeAccrualMonthsRepository->getListSelect(2);
        $positionsList = $this->employeeAccrualMonthsRepository->getListSelect(3);
        $objectsList = $this->employeeAccrualMonthsRepository->getListSelect(4);
        $teamsList = $this->employeeAccrualMonthsRepository->getListSelect(5);
        $personalCardsList = $this->employeeAccrualMonthsRepository->getListSelect(6);
        $accrualsList = $this->employeeAccrualMonthsRepository->getListSelect(7);
        $employmentTypesList = $this->employeeAccrualMonthsRepository->getListSelect(8);
        $yearsList = $this->employeeAccrualMonthsRepository->getListSelect(9);
        $monthsList = $this->employeeAccrualMonthsRepository->getListSelect(10);
        $accountsList = $this->employeeAccrualMonthsRepository->getListSelect(11);
        $taxScalesList = $this->employeeAccrualMonthsRepository->getListSelect(12);
        $currenciesList = $this->employeeAccrualMonthsRepository->getListSelect(13);
        $currencyKursesList = $this->employeeAccrualMonthsRepository->getListSelect(14);

        // Формируем содержание списка заполняемых полей input
        $employeeAccrualMonthsList = $this->employeeAccrualMonthsRepository->getEdit($id);

        return view('acc.employee-accrual-months.edit', 
               compact('menu', 'title', 
                      'yearsList', 
                      'monthsList', 
                      'departmentsList', 
                      'positionsList', 
                      'objectsList', 
                      'teamsList', 
                      'personalCardsList', 
                      'accrualsList', 
                      'employmentTypesList', 
                      'yearsList', 
                      'monthsList', 
                      'accountsList', 
                      'taxScalesList', 
                      'currenciesList', 
                      'currencyKursesList', 
                      'employeeAccrualMonthsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeAccrualMonthsUpdateRequest $request, $id) {

        $item = $this->employeeAccrualMonthsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.employee-accrual-months.edit', $item->id)
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

        $result = $this->employeeAccrualMonthsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-months.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}