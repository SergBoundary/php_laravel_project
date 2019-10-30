<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Objects;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Accruals;
use App\Models\References\Algorithms;
use App\Models\References\TaxRates;
use App\Models\Accounting\EmployeeAccrualCalculations;
use App\Repositories\Accounting\EmployeeAccrualCalculationsRepository;
use App\Http\Requests\Accounting\EmployeeAccrualCalculationsCreateRequest;
use App\Http\Requests\Accounting\EmployeeAccrualCalculationsUpdateRequest;

/**
 * Class EmployeeAccrualCalculationsController: Контроллер расчета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class EmployeeAccrualCalculationsController extends BaseAccountingController {

    /**
     * @var EmployeeAccrualCalculationsRepository
     */
    private $employeeAccrualCalculationsRepository;

    /**
     * @var path
     */
    private $path = 'acc/employee-accrual-calculations';

    public function __construct() {

        parent::__construct();

        $this->employeeAccrualCalculationsRepository = app(EmployeeAccrualCalculationsRepository::class);

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

        $employeeAccrualCalculationsList = $this->employeeAccrualCalculationsRepository->getTable();

        return view('acc.employee-accrual-calculations.index',  
               compact('menu', 'title', 'employeeAccrualCalculationsList'));
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
        $employeeAccrualCalculationsList = $this->employeeAccrualCalculationsRepository->getShow($id);

        return view('acc.employee-accrual-calculations.show', 
               compact('menu', 'title', 'employeeAccrualCalculationsList'));
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
        $objectsList = $this->employeeAccrualCalculationsRepository->getListSelect(0);
        $personalCardsList = $this->employeeAccrualCalculationsRepository->getListSelect(1);
        $accrualsList = $this->employeeAccrualCalculationsRepository->getListSelect(2);
        $algorithmsList = $this->employeeAccrualCalculationsRepository->getListSelect(3);
        $taxRatesList = $this->employeeAccrualCalculationsRepository->getListSelect(4);

        return view('acc.employee-accrual-calculations.create', 
               compact('menu', 'title', 
                      'objectsList', 
                      'personalCardsList', 
                      'accrualsList', 
                      'algorithmsList', 
                      'taxRatesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeAccrualCalculationsCreateRequest $request) {

        $data = $request->input();

        $result = (new EmployeeAccrualCalculations($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-calculations.edit', $result->id)
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
        $objectsList = $this->employeeAccrualCalculationsRepository->getListSelect(0);
        $personalCardsList = $this->employeeAccrualCalculationsRepository->getListSelect(1);
        $accrualsList = $this->employeeAccrualCalculationsRepository->getListSelect(2);
        $algorithmsList = $this->employeeAccrualCalculationsRepository->getListSelect(3);
        $taxRatesList = $this->employeeAccrualCalculationsRepository->getListSelect(4);

        // Формируем содержание списка заполняемых полей input
        $employeeAccrualCalculationsList = $this->employeeAccrualCalculationsRepository->getEdit($id);

        return view('acc.employee-accrual-calculations.edit', 
               compact('menu', 'title', 
                      'objectsList', 
                      'personalCardsList', 
                      'accrualsList', 
                      'algorithmsList', 
                      'taxRatesList', 
                      'employeeAccrualCalculationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeAccrualCalculationsUpdateRequest $request, $id) {

        $item = $this->employeeAccrualCalculationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.employee-accrual-calculations.edit', $item->id)
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

        $result = $this->employeeAccrualCalculationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-calculations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}