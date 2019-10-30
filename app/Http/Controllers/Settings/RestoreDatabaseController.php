<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\RestoreDatabase;
use App\Repositories\Settings\RestoreDatabaseRepository;
use App\Http\Requests\Settings\RestoreDatabaseCreateRequest;
use App\Http\Requests\Settings\RestoreDatabaseUpdateRequest;

/**
 * Class RestoreDatabaseController: Контроллер настроек восстановления базы данных
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Settings
 */
class RestoreDatabaseController extends BaseSettingsController {

    /**
     * @var RestoreDatabaseRepository
     */
    private $restoreDatabaseRepository;

    /**
     * @var path
     */
    private $path = 'set/restore-database';

    public function __construct() {

        parent::__construct();

        $this->restoreDatabaseRepository = app(RestoreDatabaseRepository::class);

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

        $restoreDatabaseList = $this->restoreDatabaseRepository->getTable();

        return view('set.restore-database.index',  
               compact('menu', 'title', 'restoreDatabaseList'));
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
        $restoreDatabaseList = $this->restoreDatabaseRepository->getShow($id);

        return view('set.restore-database.show', 
               compact('menu', 'title', 'restoreDatabaseList'));
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

        return view('set.restore-database.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RestoreDatabaseCreateRequest $request) {

        $data = $request->input();

        $result = (new RestoreDatabase($data))->create($data);

        if($result) {
            return redirect()
                ->route('set.restore-database.edit', $result->id)
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
        $restoreDatabaseList = $this->restoreDatabaseRepository->getEdit($id);

        return view('set.restore-database.edit', 
               compact('menu', 'title', 'restoreDatabaseList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RestoreDatabaseUpdateRequest $request, $id) {

        $item = $this->restoreDatabaseRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('set.restore-database.edit', $item->id)
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

        $result = $this->restoreDatabaseRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('set.restore-database.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}