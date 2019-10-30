<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\Accounting\WorkOrders;
use App\Models\References\Pieceworks;
use App\Models\References\Accounts;
use App\Models\References\Objects;
use App\Models\References\Algorithms;
use App\Models\Accounting\WorkOrdersAmounts;
use App\Repositories\Accounting\WorkOrdersAmountsRepository;
use App\Http\Requests\Accounting\WorkOrdersAmountsCreateRequest;
use App\Http\Requests\Accounting\WorkOrdersAmountsUpdateRequest;

/**
 * Class WorkOrdersAmountsController: Контроллер учета сумм нарядов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class WorkOrdersAmountsController extends BaseAccountingController {

    /**
     * @var WorkOrdersAmountsRepository
     */
    private $workOrdersAmountsRepository;

    /**
     * @var path
     */
    private $path = 'acc/work-orders-amounts';

    public function __construct() {

        parent::__construct();

        $this->workOrdersAmountsRepository = app(WorkOrdersAmountsRepository::class);

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

        $workOrdersAmountsList = $this->workOrdersAmountsRepository->getTable();

        return view('acc.work-orders-amounts.index',  
               compact('menu', 'title', 'workOrdersAmountsList'));
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
        $workOrdersAmountsList = $this->workOrdersAmountsRepository->getShow($id);

        return view('acc.work-orders-amounts.show', 
               compact('menu', 'title', 'workOrdersAmountsList'));
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
        $personalCardsList = $this->workOrdersAmountsRepository->getListSelect(0);
        $workOrdersList = $this->workOrdersAmountsRepository->getListSelect(1);
        $pieceworksList = $this->workOrdersAmountsRepository->getListSelect(2);
        $accountsList = $this->workOrdersAmountsRepository->getListSelect(3);
        $objectsList = $this->workOrdersAmountsRepository->getListSelect(4);
        $algorithmsList = $this->workOrdersAmountsRepository->getListSelect(5);

        return view('acc.work-orders-amounts.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'workOrdersList', 
                      'pieceworksList', 
                      'accountsList', 
                      'objectsList', 
                      'algorithmsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(WorkOrdersAmountsCreateRequest $request) {

        $data = $request->input();

        $result = (new WorkOrdersAmounts($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.work-orders-amounts.edit', $result->id)
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
        $personalCardsList = $this->workOrdersAmountsRepository->getListSelect(0);
        $workOrdersList = $this->workOrdersAmountsRepository->getListSelect(1);
        $pieceworksList = $this->workOrdersAmountsRepository->getListSelect(2);
        $accountsList = $this->workOrdersAmountsRepository->getListSelect(3);
        $objectsList = $this->workOrdersAmountsRepository->getListSelect(4);
        $algorithmsList = $this->workOrdersAmountsRepository->getListSelect(5);

        // Формируем содержание списка заполняемых полей input
        $workOrdersAmountsList = $this->workOrdersAmountsRepository->getEdit($id);

        return view('acc.work-orders-amounts.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'workOrdersList', 
                      'pieceworksList', 
                      'accountsList', 
                      'objectsList', 
                      'algorithmsList', 
                      'workOrdersAmountsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(WorkOrdersAmountsUpdateRequest $request, $id) {

        $item = $this->workOrdersAmountsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.work-orders-amounts.edit', $item->id)
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

        $result = $this->workOrdersAmountsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.work-orders-amounts.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}