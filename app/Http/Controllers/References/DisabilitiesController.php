<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Disabilities;
use App\Repositories\References\DisabilitiesRepository;
use App\Http\Requests\References\DisabilitiesCreateRequest;
use App\Http\Requests\References\DisabilitiesUpdateRequest;

/**
 * Class DisabilitiesController: Контроллер списка групп инвалидности
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class DisabilitiesController extends BaseReferencesController {

    /**
     * @var DisabilitiesRepository
     */
    private $disabilitiesRepository;

    /**
     * @var path
     */
    private $path = 'ref/disabilities';

    public function __construct() {

        parent::__construct();

        $this->disabilitiesRepository = app(DisabilitiesRepository::class);

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

        $disabilitiesList = $this->disabilitiesRepository->getTable();

        return view('ref.disabilities.index',  
               compact('menu', 'title', 'disabilitiesList'));
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
        $disabilitiesList = $this->disabilitiesRepository->getShow($id);

        return view('ref.disabilities.show', 
               compact('menu', 'title', 'disabilitiesList'));
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

        return view('ref.disabilities.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DisabilitiesCreateRequest $request) {

        $data = $request->input();

        $result = (new Disabilities($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.disabilities.edit', $result->id)
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
        $disabilitiesList = $this->disabilitiesRepository->getEdit($id);

        return view('ref.disabilities.edit', 
               compact('menu', 'title', 'disabilitiesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DisabilitiesUpdateRequest $request, $id) {

        $item = $this->disabilitiesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.disabilities.edit', $item->id)
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

        $result = $this->disabilitiesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.disabilities.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}