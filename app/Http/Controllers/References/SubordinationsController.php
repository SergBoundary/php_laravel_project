<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Subordinations;
use App\Repositories\References\SubordinationsRepository;
use App\Http\Requests\References\SubordinationsCreateRequest;
use App\Http\Requests\References\SubordinationsUpdateRequest;

/**
 * Class SubordinationsController: Контроллер списка уровней должностей
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class SubordinationsController extends BaseReferencesController {

    /**
     * @var SubordinationsRepository
     */
    private $subordinationsRepository;

    /**
     * @var path
     */
    private $path = 'ref/subordinations';

    public function __construct() {

        parent::__construct();

        $this->subordinationsRepository = app(SubordinationsRepository::class);

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

        $subordinationsList = $this->subordinationsRepository->getTable();

        return view('ref.subordinations.index',  
               compact('menu', 'title', 'subordinationsList'));
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
        $subordinationsList = $this->subordinationsRepository->getShow($id);

        return view('ref.subordinations.show', 
               compact('menu', 'title', 'subordinationsList'));
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

        return view('ref.subordinations.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SubordinationsCreateRequest $request) {

        $data = $request->input();

        $result = (new Subordinations($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.subordinations.edit', $result->id)
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
        $subordinationsList = $this->subordinationsRepository->getEdit($id);

        return view('ref.subordinations.edit', 
               compact('menu', 'title', 'subordinationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SubordinationsUpdateRequest $request, $id) {

        $item = $this->subordinationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.subordinations.edit', $item->id)
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

        $result = $this->subordinationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.subordinations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}