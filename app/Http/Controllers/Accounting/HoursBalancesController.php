<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\HoursBalanceClassifiers;
use App\Models\Accounting\HoursBalances;
use App\Repositories\Accounting\HoursBalancesRepository;
use App\Http\Requests\Accounting\HoursBalancesCreateRequest;
use App\Http\Requests\Accounting\HoursBalancesUpdateRequest;

/**
 * Class HoursBalancesController: Контроллер учета распределения часов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class HoursBalancesController extends BaseAccountingController {

    /**
     * @var HoursBalancesRepository
     */
    private $hoursBalancesRepository;

    /**
     * @var path
     */
    private $path = 'acc/hours-balances';

    public function __construct() {

        parent::__construct();

        $this->hoursBalancesRepository = app(HoursBalancesRepository::class);

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

        $hoursBalancesList = $this->hoursBalancesRepository->getTable();

        return view('acc.hours-balances.index',  
               compact('menu', 'title', 'hoursBalancesList'));
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
        $hoursBalancesList = $this->hoursBalancesRepository->getShow($id);

        return view('acc.hours-balances.show', 
               compact('menu', 'title', 'hoursBalancesList'));
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
        $yearsList = $this->hoursBalancesRepository->getListSelect(0);
        $monthsList = $this->hoursBalancesRepository->getListSelect(1);
        $hoursBalanceClassifiersList = $this->hoursBalancesRepository->getListSelect(2);

        return view('acc.hours-balances.create', 
               compact('menu', 'title', 
                      'yearsList', 
                      'monthsList', 
                      'hoursBalanceClassifiersList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HoursBalancesCreateRequest $request) {

        $data = $request->input();

        $result = (new HoursBalances($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.hours-balances.edit', $result->id)
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
        $yearsList = $this->hoursBalancesRepository->getListSelect(0);
        $monthsList = $this->hoursBalancesRepository->getListSelect(1);
        $hoursBalanceClassifiersList = $this->hoursBalancesRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $hoursBalancesList = $this->hoursBalancesRepository->getEdit($id);

        return view('acc.hours-balances.edit', 
               compact('menu', 'title', 
                      'yearsList', 
                      'monthsList', 
                      'hoursBalanceClassifiersList', 
                      'hoursBalancesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(HoursBalancesUpdateRequest $request, $id) {

        $item = $this->hoursBalancesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.hours-balances.edit', $item->id)
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

        $result = $this->hoursBalancesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.hours-balances.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}