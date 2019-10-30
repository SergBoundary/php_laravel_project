<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\ClothingSizes;
use App\Repositories\References\ClothingSizesRepository;
use App\Http\Requests\References\ClothingSizesCreateRequest;
use App\Http\Requests\References\ClothingSizesUpdateRequest;

/**
 * Class ClothingSizesController: Контроллер списка размеров одежды
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class ClothingSizesController extends BaseReferencesController {

    /**
     * @var ClothingSizesRepository
     */
    private $clothingSizesRepository;

    /**
     * @var path
     */
    private $path = 'ref/clothing-sizes';

    public function __construct() {

        parent::__construct();

        $this->clothingSizesRepository = app(ClothingSizesRepository::class);

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

        $clothingSizesList = $this->clothingSizesRepository->getTable();

        return view('ref.clothing-sizes.index',  
               compact('menu', 'title', 'clothingSizesList'));
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
        $clothingSizesList = $this->clothingSizesRepository->getShow($id);

        return view('ref.clothing-sizes.show', 
               compact('menu', 'title', 'clothingSizesList'));
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

        return view('ref.clothing-sizes.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClothingSizesCreateRequest $request) {

        $data = $request->input();

        $result = (new ClothingSizes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.clothing-sizes.edit', $result->id)
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
        $clothingSizesList = $this->clothingSizesRepository->getEdit($id);

        return view('ref.clothing-sizes.edit', 
               compact('menu', 'title', 'clothingSizesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ClothingSizesUpdateRequest $request, $id) {

        $item = $this->clothingSizesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.clothing-sizes.edit', $item->id)
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

        $result = $this->clothingSizesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.clothing-sizes.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}