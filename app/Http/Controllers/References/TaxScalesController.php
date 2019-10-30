<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\TaxScales;
use App\Repositories\References\TaxScalesRepository;
use App\Http\Requests\References\TaxScalesCreateRequest;
use App\Http\Requests\References\TaxScalesUpdateRequest;

/**
 * Class TaxScalesController: Справочник. Шкала расчета подоходного налога
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class TaxScalesController extends BaseReferencesController {

    /**
     * @var TaxScalesRepository
     */
    private $taxScalesRepository;

    /**
     * @var path
     */
    private $path = 'ref/tax-scales';

    public function __construct() {

        parent::__construct();

        $this->taxScalesRepository = app(TaxScalesRepository::class);

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

        $taxScalesList = $this->taxScalesRepository->getTable();

        return view('ref.tax-scales.index',  
               compact('menu', 'title', 'taxScalesList'));
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
        $taxScalesList = $this->taxScalesRepository->getShow($id);

        return view('ref.tax-scales.show', 
               compact('menu', 'title', 'taxScalesList'));
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

        return view('ref.tax-scales.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxScalesCreateRequest $request) {

        $data = $request->input();

        $result = (new TaxScales($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.tax-scales.edit', $result->id)
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
        $taxScalesList = $this->taxScalesRepository->getEdit($id);

        return view('ref.tax-scales.edit', 
               compact('menu', 'title', 'taxScalesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxScalesUpdateRequest $request, $id) {

        $item = $this->taxScalesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.tax-scales.edit', $item->id)
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

        $result = $this->taxScalesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.tax-scales.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}