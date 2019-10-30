<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Currencies;
use App\Repositories\References\CurrenciesRepository;
use App\Http\Requests\References\CurrenciesCreateRequest;
use App\Http\Requests\References\CurrenciesUpdateRequest;

/**
 * Class CurrenciesController: Контроллер списка валют
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class CurrenciesController extends BaseReferencesController {

    /**
     * @var CurrenciesRepository
     */
    private $currenciesRepository;

    /**
     * @var path
     */
    private $path = 'ref/currencies';

    public function __construct() {

        parent::__construct();

        $this->currenciesRepository = app(CurrenciesRepository::class);

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

        $currenciesList = $this->currenciesRepository->getTable();

        return view('ref.currencies.index',  
               compact('menu', 'title', 'currenciesList'));
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
        $currenciesList = $this->currenciesRepository->getShow($id);

        return view('ref.currencies.show', 
               compact('menu', 'title', 'currenciesList'));
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

        return view('ref.currencies.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CurrenciesCreateRequest $request) {

        $data = $request->input();

        $result = (new Currencies($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.currencies.edit', $result->id)
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
        $currenciesList = $this->currenciesRepository->getEdit($id);

        return view('ref.currencies.edit', 
               compact('menu', 'title', 'currenciesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CurrenciesUpdateRequest $request, $id) {

        $item = $this->currenciesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.currencies.edit', $item->id)
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

        $result = $this->currenciesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.currencies.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}