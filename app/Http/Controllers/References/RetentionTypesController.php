<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\RetentionTypes;
use App\Repositories\References\RetentionTypesRepository;
use App\Http\Requests\References\RetentionTypesCreateRequest;
use App\Http\Requests\References\RetentionTypesUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class RetentionTypesController: Контроллер списка видов удержаний
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class RetentionTypesController extends BaseReferencesController {

    /**
     * @var RetentionTypesRepository
     */
    private $retentionTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/retention-types';

    public function __construct() {

        parent::__construct();

        $this->retentionTypesRepository = app(RetentionTypesRepository::class);

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
        $title = "Список удержаний";

        $retentionTypesList = $this->retentionTypesRepository->getTable();

        return view('ref.retention-types.index',  
               compact('menu', 'title', 'access', 'retentionTypesList'));
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
        $title = "Карточка удержания";

        // Формируем содержание списка заполняемых полей input
        $retentionTypesList = $this->retentionTypesRepository->getShow($id);

        return view('ref.retention-types.show', 
               compact('menu', 'title', 'access', 'retentionTypesList'));
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
        $title = "Новое удержание";

        return view('ref.retention-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RetentionTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new RetentionTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.retention-types.edit', $result->id)
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
        $title = "Карточка удержания";

        // Формируем содержание списка заполняемых полей input
        $retentionTypesList = $this->retentionTypesRepository->getEdit($id);

        return view('ref.retention-types.edit', 
               compact('menu', 'title',  
                      'retentionTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RetentionTypesUpdateRequest $request, $id) {

        $item = $this->retentionTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.retention-types.edit', $item->id)
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

        $result = $this->retentionTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.retention-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}