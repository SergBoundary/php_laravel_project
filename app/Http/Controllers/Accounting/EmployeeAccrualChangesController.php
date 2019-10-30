<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Algorithms;
use App\Models\References\TaxRates;
use App\Models\Accounting\EmployeeAccrualChanges;
use App\Repositories\Accounting\EmployeeAccrualChangesRepository;
use App\Http\Requests\Accounting\EmployeeAccrualChangesCreateRequest;
use App\Http\Requests\Accounting\EmployeeAccrualChangesUpdateRequest;

/**
 * Class EmployeeAccrualChangesController: Контроллер учета переформирования начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class EmployeeAccrualChangesController extends BaseAccountingController {

    /**
     * @var EmployeeAccrualChangesRepository
     */
    private $employeeAccrualChangesRepository;

    /**
     * @var path
     */
    private $path = 'acc/employee-accrual-changes';

    public function __construct() {

        parent::__construct();

        $this->employeeAccrualChangesRepository = app(EmployeeAccrualChangesRepository::class);

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

        $employeeAccrualChangesList = $this->employeeAccrualChangesRepository->getTable();

        return view('acc.employee-accrual-changes.index',  
               compact('menu', 'title', 'employeeAccrualChangesList'));
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
        $employeeAccrualChangesList = $this->employeeAccrualChangesRepository->getShow($id);

        return view('acc.employee-accrual-changes.show', 
               compact('menu', 'title', 'employeeAccrualChangesList'));
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
        $algorithmsList = $this->employeeAccrualChangesRepository->getListSelect(0);
        $taxRatesList = $this->employeeAccrualChangesRepository->getListSelect(1);

        return view('acc.employee-accrual-changes.create', 
               compact('menu', 'title', 
                      'algorithmsList', 
                      'taxRatesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeAccrualChangesCreateRequest $request) {

        $data = $request->input();

        $result = (new EmployeeAccrualChanges($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-changes.edit', $result->id)
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
        $algorithmsList = $this->employeeAccrualChangesRepository->getListSelect(0);
        $taxRatesList = $this->employeeAccrualChangesRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $employeeAccrualChangesList = $this->employeeAccrualChangesRepository->getEdit($id);

        return view('acc.employee-accrual-changes.edit', 
               compact('menu', 'title', 
                      'algorithmsList', 
                      'taxRatesList', 
                      'employeeAccrualChangesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeAccrualChangesUpdateRequest $request, $id) {

        $item = $this->employeeAccrualChangesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.employee-accrual-changes.edit', $item->id)
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

        $result = $this->employeeAccrualChangesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.employee-accrual-changes.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}