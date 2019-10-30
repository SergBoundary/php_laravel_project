<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions;
use App\Models\References\Cities;
use App\Models\References\TaxOffices;
use App\Repositories\References\TaxOfficesRepository;
use App\Http\Requests\References\TaxOfficesCreateRequest;
use App\Http\Requests\References\TaxOfficesUpdateRequest;

/**
 * Class TaxOfficesController: Контроллер списка налоговых инспекций
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class TaxOfficesController extends BaseReferencesController {

    /**
     * @var TaxOfficesRepository
     */
    private $taxOfficesRepository;

    /**
     * @var path
     */
    private $path = 'ref/tax-offices';

    public function __construct() {

        parent::__construct();

        $this->taxOfficesRepository = app(TaxOfficesRepository::class);

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

        $taxOfficesList = $this->taxOfficesRepository->getTable();

        return view('ref.tax-offices.index',  
               compact('menu', 'title', 'taxOfficesList'));
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
        $taxOfficesList = $this->taxOfficesRepository->getShow($id);

        return view('ref.tax-offices.show', 
               compact('menu', 'title', 'taxOfficesList'));
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
        $countriesList = $this->taxOfficesRepository->getListSelect(0);
        $districtsList = $this->taxOfficesRepository->getListSelect(1);
        $regionsList = $this->taxOfficesRepository->getListSelect(2);
        $citiesList = $this->taxOfficesRepository->getListSelect(3);

        return view('ref.tax-offices.create', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList', 
                      'citiesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxOfficesCreateRequest $request) {

        $data = $request->input();

        $result = (new TaxOffices($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.tax-offices.edit', $result->id)
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
        $countriesList = $this->taxOfficesRepository->getListSelect(0);
        $districtsList = $this->taxOfficesRepository->getListSelect(1);
        $regionsList = $this->taxOfficesRepository->getListSelect(2);
        $citiesList = $this->taxOfficesRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $taxOfficesList = $this->taxOfficesRepository->getEdit($id);

        return view('ref.tax-offices.edit', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList', 
                      'citiesList', 
                      'taxOfficesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxOfficesUpdateRequest $request, $id) {

        $item = $this->taxOfficesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.tax-offices.edit', $item->id)
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

        $result = $this->taxOfficesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.tax-offices.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}