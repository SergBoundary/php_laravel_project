<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Teams;
use App\Repositories\References\TeamsRepository;
use App\Http\Requests\References\TeamsCreateRequest;
use App\Http\Requests\References\TeamsUpdateRequest;

/**
 * Class TeamsController: Контроллер списка бригад
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class TeamsController extends BaseReferencesController {

    /**
     * @var TeamsRepository
     */
    private $teamsRepository;

    /**
     * @var path
     */
    private $path = 'ref/teams';

    public function __construct() {

        parent::__construct();

        $this->teamsRepository = app(TeamsRepository::class);

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

        $teamsList = $this->teamsRepository->getTable();

        return view('ref.teams.index',  
               compact('menu', 'title', 'teamsList'));
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
        $teamsList = $this->teamsRepository->getShow($id);

        return view('ref.teams.show', 
               compact('menu', 'title', 'teamsList'));
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

        return view('ref.teams.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TeamsCreateRequest $request) {

        $data = $request->input();

        $result = (new Teams($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.teams.edit', $result->id)
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
        $teamsList = $this->teamsRepository->getEdit($id);

        return view('ref.teams.edit', 
               compact('menu', 'title', 'teamsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TeamsUpdateRequest $request, $id) {

        $item = $this->teamsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.teams.edit', $item->id)
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

        $result = $this->teamsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.teams.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}