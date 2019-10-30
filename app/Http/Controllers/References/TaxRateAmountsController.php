<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\TaxRates;
use App\Models\References\TaxRateAmounts;
use App\Repositories\References\TaxRateAmountsRepository;
use App\Http\Requests\References\TaxRateAmountsCreateRequest;
use App\Http\Requests\References\TaxRateAmountsUpdateRequest;

/**
 * Class TaxRateAmountsController: Справочник. Классификатор сумм оплаты налогов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class TaxRateAmountsController extends BaseReferencesController {

    /**
     * @var TaxRateAmountsRepository
     */
    private $taxRateAmountsRepository;

    /**
     * @var path
     */
    private $path = 'ref/tax-rate-amounts';

    public function __construct() {

        parent::__construct();

        $this->taxRateAmountsRepository = app(TaxRateAmountsRepository::class);

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

        $taxRateAmountsList = $this->taxRateAmountsRepository->getTable();

        return view('ref.tax-rate-amounts.index',  
               compact('menu', 'title', 'taxRateAmountsList'));
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
        $taxRateAmountsList = $this->taxRateAmountsRepository->getShow($id);

        return view('ref.tax-rate-amounts.show', 
               compact('menu', 'title', 'taxRateAmountsList'));
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
        $taxRatesList = $this->taxRateAmountsRepository->getListSelect(0);

        return view('ref.tax-rate-amounts.create', 
               compact('menu', 'title', 
                      'taxRatesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRateAmountsCreateRequest $request) {

        $data = $request->input();

        $result = (new TaxRateAmounts($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.tax-rate-amounts.edit', $result->id)
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
        $taxRatesList = $this->taxRateAmountsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $taxRateAmountsList = $this->taxRateAmountsRepository->getEdit($id);

        return view('ref.tax-rate-amounts.edit', 
               compact('menu', 'title', 
                      'taxRatesList', 
                      'taxRateAmountsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRateAmountsUpdateRequest $request, $id) {

        $item = $this->taxRateAmountsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.tax-rate-amounts.edit', $item->id)
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

        $result = $this->taxRateAmountsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.tax-rate-amounts.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}