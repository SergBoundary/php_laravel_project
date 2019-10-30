<?php

namespace App\Http\Controllers\Calculations;

use Illuminate\Http\Request;
use App\Models\Calculations\Paychecks;
use App\Repositories\Calculations\PaychecksRepository;
use App\Http\Requests\Calculations\PaychecksCreateRequest;
use App\Http\Requests\Calculations\PaychecksUpdateRequest;

/**
 * Class PaychecksController: Контроллер обслуживания расчетного листа по заработной плате
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Calculations
 */
class PaychecksController extends BaseCalculationsController {

    /**
     * @var PaychecksRepository
     */
    private $paychecksRepository;

    /**
     * @var path
     */
    private $path = 'calc/paychecks';

    public function __construct() {

        parent::__construct();

        $this->paychecksRepository = app(PaychecksRepository::class);

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

        $paychecksList = $this->paychecksRepository->getTable();

        return view('calc.paychecks.index',  
               compact('menu', 'title', 'paychecksList'));
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
        $paychecksList = $this->paychecksRepository->getShow($id);

        return view('calc.paychecks.show', 
               compact('menu', 'title', 'paychecksList'));
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

        return view('calc.paychecks.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaychecksCreateRequest $request) {

        $data = $request->input();

        $result = (new Paychecks($data))->create($data);

        if($result) {
            return redirect()
                ->route('calc.paychecks.edit', $result->id)
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
        $paychecksList = $this->paychecksRepository->getEdit($id);

        return view('calc.paychecks.edit', 
               compact('menu', 'title', 'paychecksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PaychecksUpdateRequest $request, $id) {

        $item = $this->paychecksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('calc.paychecks.edit', $item->id)
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

        $result = $this->paychecksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('calc.paychecks.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}