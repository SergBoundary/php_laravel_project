<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\Accounting\Vacations;
use App\Models\References\Accruals;
use App\Models\References\Accounts;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\VacationAmounts;
use App\Repositories\Accounting\VacationAmountsRepository;
use App\Http\Requests\Accounting\VacationAmountsCreateRequest;
use App\Http\Requests\Accounting\VacationAmountsUpdateRequest;

/**
 * Class VacationAmountsController: Контроллер расчета сумм отпускных
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class VacationAmountsController extends BaseAccountingController {

    /**
     * @var VacationAmountsRepository
     */
    private $vacationAmountsRepository;

    /**
     * @var path
     */
    private $path = 'acc/vacation-amounts';

    public function __construct() {

        parent::__construct();

        $this->vacationAmountsRepository = app(VacationAmountsRepository::class);

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

        $vacationAmountsList = $this->vacationAmountsRepository->getTable();

        return view('acc.vacation-amounts.index',  
               compact('menu', 'title', 'vacationAmountsList'));
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
        $vacationAmountsList = $this->vacationAmountsRepository->getShow($id);

        return view('acc.vacation-amounts.show', 
               compact('menu', 'title', 'vacationAmountsList'));
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
        $personalCardsList = $this->vacationAmountsRepository->getListSelect(0);
        $vacationsList = $this->vacationAmountsRepository->getListSelect(1);
        $accrualsList = $this->vacationAmountsRepository->getListSelect(2);
        $accountsList = $this->vacationAmountsRepository->getListSelect(3);
        $yearsList = $this->vacationAmountsRepository->getListSelect(4);
        $monthsList = $this->vacationAmountsRepository->getListSelect(5);
        $yearsList = $this->vacationAmountsRepository->getListSelect(6);
        $monthsList = $this->vacationAmountsRepository->getListSelect(7);

        return view('acc.vacation-amounts.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'vacationsList', 
                      'accrualsList', 
                      'accountsList', 
                      'yearsList', 
                      'monthsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VacationAmountsCreateRequest $request) {

        $data = $request->input();

        $result = (new VacationAmounts($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.vacation-amounts.edit', $result->id)
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
        $personalCardsList = $this->vacationAmountsRepository->getListSelect(0);
        $vacationsList = $this->vacationAmountsRepository->getListSelect(1);
        $accrualsList = $this->vacationAmountsRepository->getListSelect(2);
        $accountsList = $this->vacationAmountsRepository->getListSelect(3);
        $yearsList = $this->vacationAmountsRepository->getListSelect(4);
        $monthsList = $this->vacationAmountsRepository->getListSelect(5);
        $yearsList = $this->vacationAmountsRepository->getListSelect(6);
        $monthsList = $this->vacationAmountsRepository->getListSelect(7);

        // Формируем содержание списка заполняемых полей input
        $vacationAmountsList = $this->vacationAmountsRepository->getEdit($id);

        return view('acc.vacation-amounts.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'vacationsList', 
                      'accrualsList', 
                      'accountsList', 
                      'yearsList', 
                      'monthsList', 
                      'yearsList', 
                      'monthsList', 
                      'vacationAmountsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VacationAmountsUpdateRequest $request, $id) {

        $item = $this->vacationAmountsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.vacation-amounts.edit', $item->id)
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

        $result = $this->vacationAmountsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.vacation-amounts.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}