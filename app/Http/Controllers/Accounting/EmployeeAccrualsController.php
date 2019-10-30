<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Departments;
use App\Models\Accounting\DepartmentAccruals;
use App\Models\References\Teams;
use App\Models\References\Objects;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\CurrencyKurses;
use App\Models\Accounting\EmployeeAccruals;
use App\Repositories\Accounting\EmployeeAccrualsRepository;
use App\Http\Requests\Accounting\EmployeeAccrualsCreateRequest;
use App\Http\Requests\Accounting\EmployeeAccrualsUpdateRequest;

/**
 * Class EmployeeAccrualsController: Контроллер учета сумм начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class EmployeeAccrualsController extends BaseAccountingController {

    /**
     * @var EmployeeAccrualsRepository
     */
    private $employeeAccrualsRepository;

    /**
     * @var path
     */
    private $path = 'acc/employee-accruals';

    public function __construct() {

        parent::__construct();

        $this->employeeAccrualsRepository = app(EmployeeAccrualsRepository::class);

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

        $employeeAccrualsList = $this->employeeAccrualsRepository->getTable();

        return view('acc.employee-accruals.index',  
               compact('menu', 'title', 'employeeAccrualsList'));
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
        $employeeAccrualsList = $this->employeeAccrualsRepository->getShow($id);

        return view('acc.employee-accruals.show', 
               compact('menu', 'title', 'employeeAccrualsList'));
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
        $departmentsList = $this->employeeAccrualsRepository->getListSelect(0);
        $departmentAccrualsList = $this->employeeAccrualsRepository->getListSelect(1);
        $teamsList = $this->employeeAccrualsRepository->getListSelect(2);
        $objectsList = $this->employeeAccrualsRepository->getListSelect(3);
        $personalCardsList = $this->employeeAccrualsRepository->getListSelect(4);
        $yearsList = $this->employeeAccrualsRepository->getListSelect(5);
        $monthsList = $this->employeeAccrualsRepository->getListSelect(6);
        $currencyKursesList = $this->employeeAccrualsRepository->getListSelect(7);

        return view('acc.employee-accruals.create', 
               compact('menu', 'title', 
                      'departmentsList', 
                      'departmentAccrualsList', 
                      'teamsList', 
                      'objectsList', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'currencyKursesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeAccrualsCreateRequest $request) {

        $data = $request->input();

        $result = (new EmployeeAccruals($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.employee-accruals.edit', $result->id)
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
        $departmentsList = $this->employeeAccrualsRepository->getListSelect(0);
        $departmentAccrualsList = $this->employeeAccrualsRepository->getListSelect(1);
        $teamsList = $this->employeeAccrualsRepository->getListSelect(2);
        $objectsList = $this->employeeAccrualsRepository->getListSelect(3);
        $personalCardsList = $this->employeeAccrualsRepository->getListSelect(4);
        $yearsList = $this->employeeAccrualsRepository->getListSelect(5);
        $monthsList = $this->employeeAccrualsRepository->getListSelect(6);
        $currencyKursesList = $this->employeeAccrualsRepository->getListSelect(7);

        // Формируем содержание списка заполняемых полей input
        $employeeAccrualsList = $this->employeeAccrualsRepository->getEdit($id);

        return view('acc.employee-accruals.edit', 
               compact('menu', 'title', 
                      'departmentsList', 
                      'departmentAccrualsList', 
                      'teamsList', 
                      'objectsList', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'currencyKursesList', 
                      'employeeAccrualsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeAccrualsUpdateRequest $request, $id) {

        $item = $this->employeeAccrualsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.employee-accruals.edit', $item->id)
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

        $result = $this->employeeAccrualsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.employee-accruals.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}