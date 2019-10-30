<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Months;
use App\Repositories\References\MonthsRepository;
use App\Http\Requests\References\MonthsCreateRequest;
use App\Http\Requests\References\MonthsUpdateRequest;

/**
 * Class MonthsController: Контроллер списка месяцев
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class MonthsController extends BaseReferencesController {

    /**
     * @var MonthsRepository
     */
    private $monthsRepository;

    /**
     * @var path
     */
    private $path = 'ref/months';

    public function __construct() {

        parent::__construct();

        $this->monthsRepository = app(MonthsRepository::class);

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

        $monthsList = $this->monthsRepository->getTable();

        return view('ref.months.index',  
               compact('menu', 'title', 'monthsList'));
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
        $monthsList = $this->monthsRepository->getShow($id);

        return view('ref.months.show', 
               compact('menu', 'title', 'monthsList'));
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

        return view('ref.months.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MonthsCreateRequest $request) {

        $data = $request->input();

        $result = (new Months($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.months.edit', $result->id)
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
        $monthsList = $this->monthsRepository->getEdit($id);

        return view('ref.months.edit', 
               compact('menu', 'title', 'monthsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MonthsUpdateRequest $request, $id) {

        $item = $this->monthsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.months.edit', $item->id)
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

        $result = $this->monthsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.months.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}