<?php

namespace App\Http\Controllers\Calculations;

use Illuminate\Http\Request;
use App\Models\Calculations\PayrollPreparations;
use App\Repositories\Calculations\PayrollPreparationsRepository;
use App\Http\Requests\Calculations\PayrollPreparationsCreateRequest;
use App\Http\Requests\Calculations\PayrollPreparationsUpdateRequest;

/**
 * Class PayrollPreparationsController: Контроллер обслуживания подготовки расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Calculations
 */
class PayrollPreparationsController extends BaseCalculationsController {

    /**
     * @var PayrollPreparationsRepository
     */
    private $payrollPreparationsRepository;

    /**
     * @var path
     */
    private $path = 'calc/payroll-preparations';

    public function __construct() {

        parent::__construct();

        $this->payrollPreparationsRepository = app(PayrollPreparationsRepository::class);

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

        $payrollPreparationsList = $this->payrollPreparationsRepository->getTable();

        return view('calc.payroll-preparations.index',  
               compact('menu', 'title', 'payrollPreparationsList'));
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
        $payrollPreparationsList = $this->payrollPreparationsRepository->getShow($id);

        return view('calc.payroll-preparations.show', 
               compact('menu', 'title', 'payrollPreparationsList'));
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

        return view('calc.payroll-preparations.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollPreparationsCreateRequest $request) {

        $data = $request->input();

        $result = (new PayrollPreparations($data))->create($data);

        if($result) {
            return redirect()
                ->route('calc.payroll-preparations.edit', $result->id)
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
        $payrollPreparationsList = $this->payrollPreparationsRepository->getEdit($id);

        return view('calc.payroll-preparations.edit', 
               compact('menu', 'title', 'payrollPreparationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollPreparationsUpdateRequest $request, $id) {

        $item = $this->payrollPreparationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('calc.payroll-preparations.edit', $item->id)
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

        $result = $this->payrollPreparationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('calc.payroll-preparations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}