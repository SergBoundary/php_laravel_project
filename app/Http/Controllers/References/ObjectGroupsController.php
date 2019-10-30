<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\ObjectGroups;
use App\Repositories\References\ObjectGroupsRepository;
use App\Http\Requests\References\ObjectGroupsCreateRequest;
use App\Http\Requests\References\ObjectGroupsUpdateRequest;

/**
 * Class ObjectGroupsController: Контроллер списка групп объектов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class ObjectGroupsController extends BaseReferencesController {

    /**
     * @var ObjectGroupsRepository
     */
    private $objectGroupsRepository;

    /**
     * @var path
     */
    private $path = 'ref/object-groups';

    public function __construct() {

        parent::__construct();

        $this->objectGroupsRepository = app(ObjectGroupsRepository::class);

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

        $objectGroupsList = $this->objectGroupsRepository->getTable();

        return view('ref.object-groups.index',  
               compact('menu', 'title', 'objectGroupsList'));
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
        $objectGroupsList = $this->objectGroupsRepository->getShow($id);

        return view('ref.object-groups.show', 
               compact('menu', 'title', 'objectGroupsList'));
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

        return view('ref.object-groups.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ObjectGroupsCreateRequest $request) {

        $data = $request->input();

        $result = (new ObjectGroups($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.object-groups.edit', $result->id)
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
        $objectGroupsList = $this->objectGroupsRepository->getEdit($id);

        return view('ref.object-groups.edit', 
               compact('menu', 'title', 'objectGroupsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ObjectGroupsUpdateRequest $request, $id) {

        $item = $this->objectGroupsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.object-groups.edit', $item->id)
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

        $result = $this->objectGroupsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.object-groups.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}