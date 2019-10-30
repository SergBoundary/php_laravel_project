<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\AccrualGroups;
use App\Models\References\Algorithms;
use App\Models\References\Accruals;
use App\Repositories\References\AccrualsRepository;
use App\Http\Requests\References\AccrualsCreateRequest;
use App\Http\Requests\References\AccrualsUpdateRequest;

/**
 * Class AccrualsController: Справочник. Классификатор начислений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AccrualsController extends BaseReferencesController {

    /**
     * @var AccrualsRepository
     */
    private $accrualsRepository;

    /**
     * @var path
     */
    private $path = 'ref/accruals';

    public function __construct() {

        parent::__construct();

        $this->accrualsRepository = app(AccrualsRepository::class);

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

        $accrualsList = $this->accrualsRepository->getTable();

        return view('ref.accruals.index',  
               compact('menu', 'title', 'accrualsList'));
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
        $accrualsList = $this->accrualsRepository->getShow($id);

        return view('ref.accruals.show', 
               compact('menu', 'title', 'accrualsList'));
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
        $accrualGroupsList = $this->accrualsRepository->getListSelect(0);
        $algorithmsList = $this->accrualsRepository->getListSelect(1);

        return view('ref.accruals.create', 
               compact('menu', 'title', 
                      'accrualGroupsList', 
                      'algorithmsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccrualsCreateRequest $request) {

        $data = $request->input();

        $result = (new Accruals($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.accruals.edit', $result->id)
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
        $accrualGroupsList = $this->accrualsRepository->getListSelect(0);
        $algorithmsList = $this->accrualsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $accrualsList = $this->accrualsRepository->getEdit($id);

        return view('ref.accruals.edit', 
               compact('menu', 'title', 
                      'accrualGroupsList', 
                      'algorithmsList', 
                      'accrualsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccrualsUpdateRequest $request, $id) {

        $item = $this->accrualsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.accruals.edit', $item->id)
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

        $result = $this->accrualsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.accruals.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}