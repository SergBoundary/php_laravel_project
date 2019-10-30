<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Holidays;
use App\Repositories\References\HolidaysRepository;
use App\Http\Requests\References\HolidaysCreateRequest;
use App\Http\Requests\References\HolidaysUpdateRequest;

/**
 * Class HolidaysController: Контроллер списка праздничных дней
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class HolidaysController extends BaseReferencesController {

    /**
     * @var HolidaysRepository
     */
    private $holidaysRepository;

    /**
     * @var path
     */
    private $path = 'ref/holidays';

    public function __construct() {

        parent::__construct();

        $this->holidaysRepository = app(HolidaysRepository::class);

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

        $holidaysList = $this->holidaysRepository->getTable();

        return view('ref.holidays.index',  
               compact('menu', 'title', 'holidaysList'));
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
        $holidaysList = $this->holidaysRepository->getShow($id);

        return view('ref.holidays.show', 
               compact('menu', 'title', 'holidaysList'));
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
        $countriesList = $this->holidaysRepository->getListSelect(0);
        $yearsList = $this->holidaysRepository->getListSelect(1);
        $monthsList = $this->holidaysRepository->getListSelect(2);

        return view('ref.holidays.create', 
               compact('menu', 'title', 
                      'countriesList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HolidaysCreateRequest $request) {

        $data = $request->input();

        $result = (new Holidays($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.holidays.edit', $result->id)
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
        $countriesList = $this->holidaysRepository->getListSelect(0);
        $yearsList = $this->holidaysRepository->getListSelect(1);
        $monthsList = $this->holidaysRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $holidaysList = $this->holidaysRepository->getEdit($id);

        return view('ref.holidays.edit', 
               compact('menu', 'title', 
                      'countriesList', 
                      'yearsList', 
                      'monthsList', 
                      'holidaysList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(HolidaysUpdateRequest $request, $id) {

        $item = $this->holidaysRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.holidays.edit', $item->id)
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

        $result = $this->holidaysRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.holidays.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}