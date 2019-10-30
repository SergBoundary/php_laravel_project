<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\HoursBalanceClassifiers;
use App\Repositories\References\HoursBalanceClassifiersRepository;
use App\Http\Requests\References\HoursBalanceClassifiersCreateRequest;
use App\Http\Requests\References\HoursBalanceClassifiersUpdateRequest;

/**
 * Class HoursBalanceClassifiersController: Справочник. Классификатор графиков распределения рабочих часов в периоде
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class HoursBalanceClassifiersController extends BaseReferencesController {

    /**
     * @var HoursBalanceClassifiersRepository
     */
    private $hoursBalanceClassifiersRepository;

    /**
     * @var path
     */
    private $path = 'ref/hours-balance-classifiers';

    public function __construct() {

        parent::__construct();

        $this->hoursBalanceClassifiersRepository = app(HoursBalanceClassifiersRepository::class);

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

        $hoursBalanceClassifiersList = $this->hoursBalanceClassifiersRepository->getTable();

        return view('ref.hours-balance-classifiers.index',  
               compact('menu', 'title', 'hoursBalanceClassifiersList'));
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
        $hoursBalanceClassifiersList = $this->hoursBalanceClassifiersRepository->getShow($id);

        return view('ref.hours-balance-classifiers.show', 
               compact('menu', 'title', 'hoursBalanceClassifiersList'));
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

        return view('ref.hours-balance-classifiers.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HoursBalanceClassifiersCreateRequest $request) {

        $data = $request->input();

        $result = (new HoursBalanceClassifiers($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.hours-balance-classifiers.edit', $result->id)
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
        $hoursBalanceClassifiersList = $this->hoursBalanceClassifiersRepository->getEdit($id);

        return view('ref.hours-balance-classifiers.edit', 
               compact('menu', 'title', 'hoursBalanceClassifiersList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(HoursBalanceClassifiersUpdateRequest $request, $id) {

        $item = $this->hoursBalanceClassifiersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.hours-balance-classifiers.edit', $item->id)
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

        $result = $this->hoursBalanceClassifiersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.hours-balance-classifiers.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}