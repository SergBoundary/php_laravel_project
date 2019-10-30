<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Departments;
use App\Models\References\Objects;
use App\Models\References\Teams;
use App\Models\References\Accounts;
use App\Models\References\Algorithms;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\WorkOrders;
use App\Repositories\Accounting\WorkOrdersRepository;
use App\Http\Requests\Accounting\WorkOrdersCreateRequest;
use App\Http\Requests\Accounting\WorkOrdersUpdateRequest;

/**
 * Class WorkOrdersController: Контроллер учета нарядов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class WorkOrdersController extends BaseAccountingController {

    /**
     * @var WorkOrdersRepository
     */
    private $workOrdersRepository;

    /**
     * @var path
     */
    private $path = 'acc/work-orders';

    public function __construct() {

        parent::__construct();

        $this->workOrdersRepository = app(WorkOrdersRepository::class);

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

        $workOrdersList = $this->workOrdersRepository->getTable();

        return view('acc.work-orders.index',  
               compact('menu', 'title', 'workOrdersList'));
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
        $workOrdersList = $this->workOrdersRepository->getShow($id);

        return view('acc.work-orders.show', 
               compact('menu', 'title', 'workOrdersList'));
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
        $departmentsList = $this->workOrdersRepository->getListSelect(0);
        $objectsList = $this->workOrdersRepository->getListSelect(1);
        $teamsList = $this->workOrdersRepository->getListSelect(2);
        $accountsList = $this->workOrdersRepository->getListSelect(3);
        $algorithmsList = $this->workOrdersRepository->getListSelect(4);
        $yearsList = $this->workOrdersRepository->getListSelect(5);
        $monthsList = $this->workOrdersRepository->getListSelect(6);

        return view('acc.work-orders.create', 
               compact('menu', 'title', 
                      'departmentsList', 
                      'objectsList', 
                      'teamsList', 
                      'accountsList', 
                      'algorithmsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(WorkOrdersCreateRequest $request) {

        $data = $request->input();

        $result = (new WorkOrders($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.work-orders.edit', $result->id)
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
        $departmentsList = $this->workOrdersRepository->getListSelect(0);
        $objectsList = $this->workOrdersRepository->getListSelect(1);
        $teamsList = $this->workOrdersRepository->getListSelect(2);
        $accountsList = $this->workOrdersRepository->getListSelect(3);
        $algorithmsList = $this->workOrdersRepository->getListSelect(4);
        $yearsList = $this->workOrdersRepository->getListSelect(5);
        $monthsList = $this->workOrdersRepository->getListSelect(6);

        // Формируем содержание списка заполняемых полей input
        $workOrdersList = $this->workOrdersRepository->getEdit($id);

        return view('acc.work-orders.edit', 
               compact('menu', 'title', 
                      'departmentsList', 
                      'objectsList', 
                      'teamsList', 
                      'accountsList', 
                      'algorithmsList', 
                      'yearsList', 
                      'monthsList', 
                      'workOrdersList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(WorkOrdersUpdateRequest $request, $id) {

        $item = $this->workOrdersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.work-orders.edit', $item->id)
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

        $result = $this->workOrdersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.work-orders.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}