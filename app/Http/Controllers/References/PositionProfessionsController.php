<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\PositionProfessions;
use App\Repositories\References\PositionProfessionsRepository;
use App\Http\Requests\References\PositionProfessionsCreateRequest;
use App\Http\Requests\References\PositionProfessionsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class PositionProfessionsController: Справочник. Государственный классификатор профессий
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PositionProfessionsController extends BaseReferencesController {

    /**
     * @var PositionProfessionsRepository
     */
    private $positionProfessionsRepository;

    /**
     * @var path
     */
    private $path = 'ref/position-professions';

    public function __construct() {

        parent::__construct();

        $this->positionProfessionsRepository = app(PositionProfessionsRepository::class);

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
        $title = "Классификатор профессий";

        $positionProfessionsList = $this->positionProfessionsRepository->getTable();

        return view('ref.position-professions.index',  
               compact('menu', 'title', 'access', 'positionProfessionsList'));
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
        $title = "Карточка профессии";

        // Формируем содержание списка заполняемых полей input
        $positionProfessionsList = $this->positionProfessionsRepository->getShow($id);

        return view('ref.position-professions.show', 
               compact('menu', 'title', 'access', 'positionProfessionsList'));
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
        $title = "Новая профессия";

        return view('ref.position-professions.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PositionProfessionsCreateRequest $request) {

        $data = $request->input();

        $result = (new PositionProfessions($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.position-professions.edit', $result->id)
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
        $title = "Карточка профессии";

        // Формируем содержание списка заполняемых полей input
        $positionProfessionsList = $this->positionProfessionsRepository->getEdit($id);

        return view('ref.position-professions.edit', 
               compact('menu', 'title', 'positionProfessionsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PositionProfessionsUpdateRequest $request, $id) {

        $item = $this->positionProfessionsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.position-professions.edit', $item->id)
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

        $result = $this->positionProfessionsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.position-professions.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}