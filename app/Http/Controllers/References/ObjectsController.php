<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\ObjectGroups;
use App\Models\References\Objects;
use App\Repositories\References\ObjectsRepository;
use App\Http\Requests\References\ObjectsCreateRequest;
use App\Http\Requests\References\ObjectsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class ObjectsController: Контроллер списка объектов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class ObjectsController extends BaseReferencesController {

    /**
     * @var ObjectsRepository
     */
    private $objectsRepository;

    /**
     * @var path
     */
    private $path = 'ref/objects';

    public function __construct() {

        parent::__construct();

        $this->objectsRepository = app(ObjectsRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		
	$auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Список объекта";

        $objectsList = $this->objectsRepository->getTable();

        return view('ref.objects.index',  
               compact('menu', 'title', 'access', 'objectsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
	$auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Карточка объекта";

        // Формируем содержание списка заполняемых полей input
        $objectsList = $this->objectsRepository->getShow($id);

        return view('ref.objects.show', 
               compact('menu', 'title', 'access', 'objectsList'));
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
        $title = "Новый объект";

        return view('ref.objects.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ObjectsCreateRequest $request) {

        $data = $request->input();

        $result = (new Objects($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.objects.edit', $result->id)
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
        $title = "Карточка объекта";

        // Формируем содержание списка заполняемых полей input
        $objectsList = $this->objectsRepository->getEdit($id);

        return view('ref.objects.edit', 
               compact('menu', 'title',  
                      'objectsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ObjectsUpdateRequest $request, $id) {

        $item = $this->objectsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.objects.edit', $item->id)
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

        $result = $this->objectsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.objects.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}