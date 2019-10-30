<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\SaveDatabase;
use App\Repositories\Settings\SaveDatabaseRepository;
use App\Http\Requests\Settings\SaveDatabaseCreateRequest;
use App\Http\Requests\Settings\SaveDatabaseUpdateRequest;

/**
 * Class SaveDatabaseController: Контроллер настроек сохранения базы данных
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Settings
 */
class SaveDatabaseController extends BaseSettingsController {

    /**
     * @var SaveDatabaseRepository
     */
    private $saveDatabaseRepository;

    /**
     * @var path
     */
    private $path = 'set/save-database';

    public function __construct() {

        parent::__construct();

        $this->saveDatabaseRepository = app(SaveDatabaseRepository::class);

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

        $saveDatabaseList = $this->saveDatabaseRepository->getTable();

        return view('set.save-database.index',  
               compact('menu', 'title', 'saveDatabaseList'));
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
        $saveDatabaseList = $this->saveDatabaseRepository->getShow($id);

        return view('set.save-database.show', 
               compact('menu', 'title', 'saveDatabaseList'));
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

        return view('set.save-database.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveDatabaseCreateRequest $request) {

        $data = $request->input();

        $result = (new SaveDatabase($data))->create($data);

        if($result) {
            return redirect()
                ->route('set.save-database.edit', $result->id)
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
        $saveDatabaseList = $this->saveDatabaseRepository->getEdit($id);

        return view('set.save-database.edit', 
               compact('menu', 'title', 'saveDatabaseList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SaveDatabaseUpdateRequest $request, $id) {

        $item = $this->saveDatabaseRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('set.save-database.edit', $item->id)
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

        $result = $this->saveDatabaseRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('set.save-database.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}