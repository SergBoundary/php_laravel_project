<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\AccrualGroups;
use App\Models\References\Accruals;
use App\Models\References\CalculationGroups;
use App\Repositories\References\CalculationGroupsRepository;
use App\Http\Requests\References\CalculationGroupsCreateRequest;
use App\Http\Requests\References\CalculationGroupsUpdateRequest;

/**
 * Class CalculationGroupsController: Контроллер списка видов расчетов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class CalculationGroupsController extends BaseReferencesController {

    /**
     * @var CalculationGroupsRepository
     */
    private $calculationGroupsRepository;

    /**
     * @var path
     */
    private $path = 'ref/calculation-groups';

    public function __construct() {

        parent::__construct();

        $this->calculationGroupsRepository = app(CalculationGroupsRepository::class);

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

        $calculationGroupsList = $this->calculationGroupsRepository->getTable();

        return view('ref.calculation-groups.index',  
               compact('menu', 'title', 'calculationGroupsList'));
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
        $calculationGroupsList = $this->calculationGroupsRepository->getShow($id);

        return view('ref.calculation-groups.show', 
               compact('menu', 'title', 'calculationGroupsList'));
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
        $accrualGroupsList = $this->calculationGroupsRepository->getListSelect(0);
        $accrualsList = $this->calculationGroupsRepository->getListSelect(1);

        return view('ref.calculation-groups.create', 
               compact('menu', 'title', 
                      'accrualGroupsList', 
                      'accrualsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CalculationGroupsCreateRequest $request) {

        $data = $request->input();

        $result = (new CalculationGroups($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.calculation-groups.edit', $result->id)
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
        $accrualGroupsList = $this->calculationGroupsRepository->getListSelect(0);
        $accrualsList = $this->calculationGroupsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $calculationGroupsList = $this->calculationGroupsRepository->getEdit($id);

        return view('ref.calculation-groups.edit', 
               compact('menu', 'title', 
                      'accrualGroupsList', 
                      'accrualsList', 
                      'calculationGroupsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CalculationGroupsUpdateRequest $request, $id) {

        $item = $this->calculationGroupsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.calculation-groups.edit', $item->id)
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

        $result = $this->calculationGroupsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.calculation-groups.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}