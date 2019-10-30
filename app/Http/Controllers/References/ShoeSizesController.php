<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\ShoeSizes;
use App\Repositories\References\ShoeSizesRepository;
use App\Http\Requests\References\ShoeSizesCreateRequest;
use App\Http\Requests\References\ShoeSizesUpdateRequest;

/**
 * Class ShoeSizesController: Контроллер списка размеров обуви
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class ShoeSizesController extends BaseReferencesController {

    /**
     * @var ShoeSizesRepository
     */
    private $shoeSizesRepository;

    /**
     * @var path
     */
    private $path = 'ref/shoe-sizes';

    public function __construct() {

        parent::__construct();

        $this->shoeSizesRepository = app(ShoeSizesRepository::class);

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

        $shoeSizesList = $this->shoeSizesRepository->getTable();

        return view('ref.shoe-sizes.index',  
               compact('menu', 'title', 'shoeSizesList'));
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
        $shoeSizesList = $this->shoeSizesRepository->getShow($id);

        return view('ref.shoe-sizes.show', 
               compact('menu', 'title', 'shoeSizesList'));
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

        return view('ref.shoe-sizes.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ShoeSizesCreateRequest $request) {

        $data = $request->input();

        $result = (new ShoeSizes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.shoe-sizes.edit', $result->id)
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
        $shoeSizesList = $this->shoeSizesRepository->getEdit($id);

        return view('ref.shoe-sizes.edit', 
               compact('menu', 'title', 'shoeSizesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ShoeSizesUpdateRequest $request, $id) {

        $item = $this->shoeSizesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.shoe-sizes.edit', $item->id)
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

        $result = $this->shoeSizesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.shoe-sizes.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}