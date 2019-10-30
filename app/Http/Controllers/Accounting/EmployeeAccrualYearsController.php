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
use App\Models\References\Accounts;
use App\Models\References\TaxScales;
use App\Models\References\Currencies;
use App\Models\References\CurrencyKurses;
use App\Models\Accounting\EmployeeAccrualYears;
use App\Repositories\Accounting\EmployeeAccrualYearsRepository;
use App\Http\Requests\Accounting\EmployeeAccrualYearsCreateRequest;
use App\Http\Requests\Accounting\EmployeeAccrualYearsUpdateRequest;

/**
 * Class EmployeeAccrualYearsController: Контроллер учета сумм начислений работникам за год
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class EmployeeAccrualYearsController extends BaseAccountingController {

    /**
     * @var EmployeeAccrualYearsRepository
     */
    private $employeeAccrualYearsRepository;

    /**
     * @var path
     */
    private $path = 'acc/employee-accrual-years';

    public function __construct() {

        parent::__construct();

        $this->employeeAccrualYearsRepository = app(EmployeeAccrualYearsRepository::class);

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

        $employeeAccrualYearsList = $this->employeeAccrualYearsRepository->getTable();

        return view('acc.employee-accrual-years.index',  
               compact('menu', 'title', 'employeeAccrualYearsList'));
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
        $employeeAccrualYearsList = $this->employeeAccrualYearsRepository->getShow($id);

        return view('acc.employee-accrual-years.show', 
               compact('menu', 'title', 'employeeAccrualYearsList'));
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
        $yearsList = $this->employeeAccrualYearsRepository->getListSelect(0);
        $monthsList = $this->employeeAccrualYearsRepository->getListSelect(1);
        $departmentsList = $this->employeeAccrualYearsRepository->getListSelect(2);
        $positionsList = $this->employeeAccrualYearsRepository->getListSelect(3);
        $objectsList = $this->employeeAccrualYearsRepository->getListSelect(4);
        $teamsList = $this->employeeAccrualYearsRepository->getListSelect(5);
        $personalCardsList = $this->employeeAccrualYearsRepository->getListSelect(6);
        $accrualsList = $this->employeeAccrualYearsRepository->getListSelect(7);
        $employmentTypesList = $this->employeeAccrualYearsRepository->getListSelect(8);
        $yearsList = $this->employeeAccrualYearsRepository->getListSelect(9);
        $accountsList = $this->employeeAccrualYearsRepository->getListSelect(10);
        $taxScalesList = $this->employeeAccrualYearsRepository->getListSelect(11);
        $currenciesList = $this->employeeAccrualYearsRepository->getListSelect(12);
        $currencyKursesList = $this->employeeAccrualYearsRepository->getListSelect(13);

        return view('acc.employee-accrual-years.create', 
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
    public function store(EmployeeAccrualYearsCreateRequest $request) {

        $data = $request->input();

        $result = (new EmployeeAccrualYears($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-years.edit', $result->id)
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
        $yearsList = $this->employeeAccrualYearsRepository->getListSelect(0);
        $monthsList = $this->employeeAccrualYearsRepository->getListSelect(1);
        $departmentsList = $this->employeeAccrualYearsRepository->getListSelect(2);
        $positionsList = $this->employeeAccrualYearsRepository->getListSelect(3);
        $objectsList = $this->employeeAccrualYearsRepository->getListSelect(4);
        $teamsList = $this->employeeAccrualYearsRepository->getListSelect(5);
        $personalCardsList = $this->employeeAccrualYearsRepository->getListSelect(6);
        $accrualsList = $this->employeeAccrualYearsRepository->getListSelect(7);
        $employmentTypesList = $this->employeeAccrualYearsRepository->getListSelect(8);
        $yearsList = $this->employeeAccrualYearsRepository->getListSelect(9);
        $accountsList = $this->employeeAccrualYearsRepository->getListSelect(10);
        $taxScalesList = $this->employeeAccrualYearsRepository->getListSelect(11);
        $currenciesList = $this->employeeAccrualYearsRepository->getListSelect(12);
        $currencyKursesList = $this->employeeAccrualYearsRepository->getListSelect(13);

        // Формируем содержание списка заполняемых полей input
        $employeeAccrualYearsList = $this->employeeAccrualYearsRepository->getEdit($id);

        return view('acc.employee-accrual-years.edit', 
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
                      'accountsList', 
                      'taxScalesList', 
                      'currenciesList', 
                      'currencyKursesList', 
                      'employeeAccrualYearsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeAccrualYearsUpdateRequest $request, $id) {

        $item = $this->employeeAccrualYearsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.employee-accrual-years.edit', $item->id)
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

        $result = $this->employeeAccrualYearsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-years.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}