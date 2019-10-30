<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\Constants;
use App\Repositories\Settings\ConstantsRepository;
use App\Http\Requests\Settings\ConstantsCreateRequest;
use App\Http\Requests\Settings\ConstantsUpdateRequest;

/**
 * Class ConstantsController: Контроллер констант системы
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Settings
 */
class ConstantsController extends BaseSettingsController {

    /**
     * @var ConstantsRepository
     */
    private $constantsRepository;

    /**
     * @var path
     */
    private $path = 'set/constants';

    public function __construct() {

        parent::__construct();

        $this->constantsRepository = app(ConstantsRepository::class);

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

        $constantsList = $this->constantsRepository->getTable();

        return view('set.constants.index',  
               compact('menu', 'title', 'constantsList'));
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
        $constantsList = $this->constantsRepository->getShow($id);

        return view('set.constants.show', 
               compact('menu', 'title', 'constantsList'));
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

        return view('set.constants.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConstantsCreateRequest $request) {

        $data = $request->input();

        $result = (new Constants($data))->create($data);

        if($result) {
            return redirect()
                ->route('set.constants.edit', $result->id)
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
        $constantsList = $this->constantsRepository->getEdit($id);

        return view('set.constants.edit', 
               compact('menu', 'title', 'constantsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConstantsUpdateRequest $request, $id) {

        $item = $this->constantsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('set.constants.edit', $item->id)
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

        $result = $this->constantsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('set.constants.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}