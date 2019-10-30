<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Accruals;
use App\Models\References\TaxRates;
use App\Repositories\References\TaxRatesRepository;
use App\Http\Requests\References\TaxRatesCreateRequest;
use App\Http\Requests\References\TaxRatesUpdateRequest;

/**
 * Class TaxRatesController: Справочник. Классификатор налоговых ставок
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class TaxRatesController extends BaseReferencesController {

    /**
     * @var TaxRatesRepository
     */
    private $taxRatesRepository;

    /**
     * @var path
     */
    private $path = 'ref/tax-rates';

    public function __construct() {

        parent::__construct();

        $this->taxRatesRepository = app(TaxRatesRepository::class);

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

        $taxRatesList = $this->taxRatesRepository->getTable();

        return view('ref.tax-rates.index',  
               compact('menu', 'title', 'taxRatesList'));
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
        $taxRatesList = $this->taxRatesRepository->getShow($id);

        return view('ref.tax-rates.show', 
               compact('menu', 'title', 'taxRatesList'));
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
        $accrualsList = $this->taxRatesRepository->getListSelect(0);

        return view('ref.tax-rates.create', 
               compact('menu', 'title', 
                      'accrualsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRatesCreateRequest $request) {

        $data = $request->input();

        $result = (new TaxRates($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.tax-rates.edit', $result->id)
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
        $accrualsList = $this->taxRatesRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $taxRatesList = $this->taxRatesRepository->getEdit($id);

        return view('ref.tax-rates.edit', 
               compact('menu', 'title', 
                      'accrualsList', 
                      'taxRatesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRatesUpdateRequest $request, $id) {

        $item = $this->taxRatesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.tax-rates.edit', $item->id)
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

        $result = $this->taxRatesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.tax-rates.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}