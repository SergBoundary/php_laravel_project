<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\MaritalStatuses;
use App\Repositories\References\MaritalStatusesRepository;
use App\Http\Requests\References\MaritalStatusesCreateRequest;
use App\Http\Requests\References\MaritalStatusesUpdateRequest;

/**
 * Class MaritalStatusesController: Контроллер списка видов семейного положения
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class MaritalStatusesController extends BaseReferencesController {

    /**
     * @var MaritalStatusesRepository
     */
    private $maritalStatusesRepository;

    /**
     * @var path
     */
    private $path = 'ref/marital-statuses';

    public function __construct() {

        parent::__construct();

        $this->maritalStatusesRepository = app(MaritalStatusesRepository::class);

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

        $maritalStatusesList = $this->maritalStatusesRepository->getTable();

        return view('ref.marital-statuses.index',  
               compact('menu', 'title', 'maritalStatusesList'));
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
        $maritalStatusesList = $this->maritalStatusesRepository->getShow($id);

        return view('ref.marital-statuses.show', 
               compact('menu', 'title', 'maritalStatusesList'));
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

        return view('ref.marital-statuses.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MaritalStatusesCreateRequest $request) {

        $data = $request->input();

        $result = (new MaritalStatuses($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.marital-statuses.edit', $result->id)
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
        $maritalStatusesList = $this->maritalStatusesRepository->getEdit($id);

        return view('ref.marital-statuses.edit', 
               compact('menu', 'title', 'maritalStatusesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MaritalStatusesUpdateRequest $request, $id) {

        $item = $this->maritalStatusesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.marital-statuses.edit', $item->id)
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

        $result = $this->maritalStatusesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.marital-statuses.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}