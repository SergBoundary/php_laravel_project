<?php

namespace App\Http\Controllers\Calculations;

use Illuminate\Http\Request;
use App\Models\Calculations\ClosingFinancialPeriods;
use App\Repositories\Calculations\ClosingFinancialPeriodsRepository;
use App\Http\Requests\Calculations\ClosingFinancialPeriodsCreateRequest;
use App\Http\Requests\Calculations\ClosingFinancialPeriodsUpdateRequest;

/**
 * Class ClosingFinancialPeriodsController: Контроллер обслуживания закрытия финансового периода
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Calculations
 */
class ClosingFinancialPeriodsController extends BaseCalculationsController {

    /**
     * @var ClosingFinancialPeriodsRepository
     */
    private $closingFinancialPeriodsRepository;

    /**
     * @var path
     */
    private $path = 'calc/closing-financial-periods';

    public function __construct() {

        parent::__construct();

        $this->closingFinancialPeriodsRepository = app(ClosingFinancialPeriodsRepository::class);

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

        $closingFinancialPeriodsList = $this->closingFinancialPeriodsRepository->getTable();

        return view('calc.closing-financial-periods.index',  
               compact('menu', 'title', 'closingFinancialPeriodsList'));
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
        $closingFinancialPeriodsList = $this->closingFinancialPeriodsRepository->getShow($id);

        return view('calc.closing-financial-periods.show', 
               compact('menu', 'title', 'closingFinancialPeriodsList'));
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

        return view('calc.closing-financial-periods.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClosingFinancialPeriodsCreateRequest $request) {

        $data = $request->input();

        $result = (new ClosingFinancialPeriods($data))->create($data);

        if($result) {
            return redirect()
                ->route('calc.closing-financial-periods.edit', $result->id)
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

        // Формируем содержание списка заполняемых полей input
        $closingFinancialPeriodsList = $this->closingFinancialPeriodsRepository->getEdit($id);

        return view('calc.closing-financial-periods.edit', 
               compact('menu', 'title', 'closingFinancialPeriodsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ClosingFinancialPeriodsUpdateRequest $request, $id) {

        $item = $this->closingFinancialPeriodsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('calc.closing-financial-periods.edit', $item->id)
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

        $result = $this->closingFinancialPeriodsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('calc.closing-financial-periods.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}