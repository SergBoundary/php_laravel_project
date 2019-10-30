<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Accruals;
use App\Models\References\Departments;
use App\Models\References\Teams;
use App\Models\References\Objects;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\DepartmentAccruals;
use App\Repositories\Accounting\DepartmentAccrualsRepository;
use App\Http\Requests\Accounting\DepartmentAccrualsCreateRequest;
use App\Http\Requests\Accounting\DepartmentAccrualsUpdateRequest;

/**
 * Class DepartmentAccrualsController: Контроллер учета сумм начисления по подразделению
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class DepartmentAccrualsController extends BaseAccountingController {

    /**
     * @var DepartmentAccrualsRepository
     */
    private $departmentAccrualsRepository;

    /**
     * @var path
     */
    private $path = 'acc/department-accruals';

    public function __construct() {

        parent::__construct();

        $this->departmentAccrualsRepository = app(DepartmentAccrualsRepository::class);

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

        $departmentAccrualsList = $this->departmentAccrualsRepository->getTable();

        return view('acc.department-accruals.index',  
               compact('menu', 'title', 'departmentAccrualsList'));
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
        $departmentAccrualsList = $this->departmentAccrualsRepository->getShow($id);

        return view('acc.department-accruals.show', 
               compact('menu', 'title', 'departmentAccrualsList'));
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
        $accrualsList = $this->departmentAccrualsRepository->getListSelect(0);
        $departmentsList = $this->departmentAccrualsRepository->getListSelect(1);
        $teamsList = $this->departmentAccrualsRepository->getListSelect(2);
        $objectsList = $this->departmentAccrualsRepository->getListSelect(3);
        $yearsList = $this->departmentAccrualsRepository->getListSelect(4);
        $monthsList = $this->departmentAccrualsRepository->getListSelect(5);

        return view('acc.department-accruals.create', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'departmentsList', 
                      'teamsList', 
                      'objectsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentAccrualsCreateRequest $request) {

        $data = $request->input();

        $result = (new DepartmentAccruals($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.department-accruals.edit', $result->id)
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
        $accrualsList = $this->departmentAccrualsRepository->getListSelect(0);
        $departmentsList = $this->departmentAccrualsRepository->getListSelect(1);
        $teamsList = $this->departmentAccrualsRepository->getListSelect(2);
        $objectsList = $this->departmentAccrualsRepository->getListSelect(3);
        $yearsList = $this->departmentAccrualsRepository->getListSelect(4);
        $monthsList = $this->departmentAccrualsRepository->getListSelect(5);

        // Формируем содержание списка заполняемых полей input
        $departmentAccrualsList = $this->departmentAccrualsRepository->getEdit($id);

        return view('acc.department-accruals.edit', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'departmentsList', 
                      'teamsList', 
                      'objectsList', 
                      'yearsList', 
                      'monthsList', 
                      'departmentAccrualsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentAccrualsUpdateRequest $request, $id) {

        $item = $this->departmentAccrualsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.department-accruals.edit', $item->id)
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

        $result = $this->departmentAccrualsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.department-accruals.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}