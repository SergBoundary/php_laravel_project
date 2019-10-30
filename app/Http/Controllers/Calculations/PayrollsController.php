<?php

namespace App\Http\Controllers\Calculations;

use Illuminate\Http\Request;
use App\Models\Calculations\Payrolls;
use App\Repositories\Calculations\PayrollsRepository;
use App\Http\Requests\Calculations\PayrollsCreateRequest;
use App\Http\Requests\Calculations\PayrollsUpdateRequest;

/**
 * Class PayrollsController: Контроллер обслуживания расчета заработной платы
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Calculations
 */
class PayrollsController extends BaseCalculationsController {

    /**
     * @var PayrollsRepository
     */
    private $payrollsRepository;

    /**
     * @var path
     */
    private $path = 'calc/payrolls';

    public function __construct() {

        parent::__construct();

        $this->payrollsRepository = app(PayrollsRepository::class);

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

        $payrollsList = $this->payrollsRepository->getTable();

        return view('calc.payrolls.index',  
               compact('menu', 'title', 'payrollsList'));
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
        $payrollsList = $this->payrollsRepository->getShow($id);

        return view('calc.payrolls.show', 
               compact('menu', 'title', 'payrollsList'));
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

        return view('calc.payrolls.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollsCreateRequest $request) {

        $data = $request->input();

        $result = (new Payrolls($data))->create($data);

        if($result) {
            return redirect()
                ->route('calc.payrolls.edit', $result->id)
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
        $payrollsList = $this->payrollsRepository->getEdit($id);

        return view('calc.payrolls.edit', 
               compact('menu', 'title', 'payrollsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollsUpdateRequest $request, $id) {

        $item = $this->payrollsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('calc.payrolls.edit', $item->id)
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

        $result = $this->payrollsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('calc.payrolls.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}