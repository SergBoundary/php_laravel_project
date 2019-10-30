<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Algorithms;
use App\Repositories\References\AlgorithmsRepository;
use App\Http\Requests\References\AlgorithmsCreateRequest;
use App\Http\Requests\References\AlgorithmsUpdateRequest;

/**
 * Class AlgorithmsController: Контроллер списка алгоритмов начислений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AlgorithmsController extends BaseReferencesController {

    /**
     * @var AlgorithmsRepository
     */
    private $algorithmsRepository;

    /**
     * @var path
     */
    private $path = 'ref/algorithms';

    public function __construct() {

        parent::__construct();

        $this->algorithmsRepository = app(AlgorithmsRepository::class);

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

        $algorithmsList = $this->algorithmsRepository->getTable();

        return view('ref.algorithms.index',  
               compact('menu', 'title', 'algorithmsList'));
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
        $algorithmsList = $this->algorithmsRepository->getShow($id);

        return view('ref.algorithms.show', 
               compact('menu', 'title', 'algorithmsList'));
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

        return view('ref.algorithms.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AlgorithmsCreateRequest $request) {

        $data = $request->input();

        $result = (new Algorithms($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.algorithms.edit', $result->id)
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
        $algorithmsList = $this->algorithmsRepository->getEdit($id);

        return view('ref.algorithms.edit', 
               compact('menu', 'title', 'algorithmsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AlgorithmsUpdateRequest $request, $id) {

        $item = $this->algorithmsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.algorithms.edit', $item->id)
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

        $result = $this->algorithmsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.algorithms.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}