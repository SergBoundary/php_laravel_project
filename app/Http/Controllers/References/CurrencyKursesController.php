<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Currencies;
use App\Models\References\Currencies;
use App\Models\References\CurrencyKurses;
use App\Repositories\References\CurrencyKursesRepository;
use App\Http\Requests\References\CurrencyKursesCreateRequest;
use App\Http\Requests\References\CurrencyKursesUpdateRequest;

/**
 * Class CurrencyKursesController: Контроллер списка текущих курсов валют
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class CurrencyKursesController extends BaseReferencesController {

    /**
     * @var CurrencyKursesRepository
     */
    private $currencyKursesRepository;

    /**
     * @var path
     */
    private $path = 'ref/currency-kurses';

    public function __construct() {

        parent::__construct();

        $this->currencyKursesRepository = app(CurrencyKursesRepository::class);

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

        $currencyKursesList = $this->currencyKursesRepository->getTable();

        return view('ref.currency-kurses.index',  
               compact('menu', 'title', 'currencyKursesList'));
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
        $currencyKursesList = $this->currencyKursesRepository->getShow($id);

        return view('ref.currency-kurses.show', 
               compact('menu', 'title', 'currencyKursesList'));
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
        $currenciesList = $this->currencyKursesRepository->getListSelect(0);
        $currenciesList = $this->currencyKursesRepository->getListSelect(1);

        return view('ref.currency-kurses.create', 
               compact('menu', 'title', 
                      'currenciesList', 
                      'currenciesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyKursesCreateRequest $request) {

        $data = $request->input();

        $result = (new CurrencyKurses($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.currency-kurses.edit', $result->id)
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
        $currenciesList = $this->currencyKursesRepository->getListSelect(0);
        $currenciesList = $this->currencyKursesRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $currencyKursesList = $this->currencyKursesRepository->getEdit($id);

        return view('ref.currency-kurses.edit', 
               compact('menu', 'title', 
                      'currenciesList', 
                      'currenciesList', 
                      'currencyKursesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyKursesUpdateRequest $request, $id) {

        $item = $this->currencyKursesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.currency-kurses.edit', $item->id)
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

        $result = $this->currencyKursesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.currency-kurses.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}