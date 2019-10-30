<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\CalculationSetup;
use App\Repositories\Settings\CalculationSetupRepository;
use App\Http\Requests\Settings\CalculationSetupCreateRequest;
use App\Http\Requests\Settings\CalculationSetupUpdateRequest;

/**
 * Class CalculationSetupController: Контроллер настроек финансовых параметров расчетов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Settings
 */
class CalculationSetupController extends BaseSettingsController {

    /**
     * @var CalculationSetupRepository
     */
    private $calculationSetupRepository;

    /**
     * @var path
     */
    private $path = 'set/calculation-setup';

    public function __construct() {

        parent::__construct();

        $this->calculationSetupRepository = app(CalculationSetupRepository::class);

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

        $calculationSetupList = $this->calculationSetupRepository->getTable();

        return view('set.calculation-setup.index',  
               compact('menu', 'title', 'calculationSetupList'));
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
        $calculationSetupList = $this->calculationSetupRepository->getShow($id);

        return view('set.calculation-setup.show', 
               compact('menu', 'title', 'calculationSetupList'));
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

        return view('set.calculation-setup.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CalculationSetupCreateRequest $request) {

        $data = $request->input();

        $result = (new CalculationSetup($data))->create($data);

        if($result) {
            return redirect()
                ->route('set.calculation-setup.edit', $result->id)
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
        $calculationSetupList = $this->calculationSetupRepository->getEdit($id);

        return view('set.calculation-setup.edit', 
               compact('menu', 'title', 'calculationSetupList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CalculationSetupUpdateRequest $request, $id) {

        $item = $this->calculationSetupRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('set.calculation-setup.edit', $item->id)
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

        $result = $this->calculationSetupRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('set.calculation-setup.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}