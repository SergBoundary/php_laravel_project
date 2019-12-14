<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Teams;
use App\Repositories\HumanResources\TeamsRepository;
use App\Http\Requests\HumanResources\TeamsCreateRequest;
use App\Http\Requests\HumanResources\TeamsUpdateRequest;
use App\Models\Settings\Menu;
use Illuminate\Support\Facades\Auth;

/**
 * Class TeamsController: Контроллер учета формирования бригад
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class TeamsController extends BaseHumanResourcesController {

    /**
     * @var TeamsRepository
     */
    private $teamsRepository;

    /**
     * @var path
     */
    private $path = 'hr/teams';

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
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menu::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Список бригад";

        $teamsList = $this->teamsRepository->getTable();

        return view('hr.teams.index',  
               compact('menu', 'title', 'access', 'teamsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
        $user = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menu::select('access_'.$user['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Карточка бригады";

        // Данные о группе
        $teamData = $this->teamsRepository->getTeam($id);
        // Данные о руководителе группы
        $leaderData = $this->teamsRepository->getLeader($teamData['personal_card_id']);
        $userData = Users::find($teamData['user_id']);
        // Данные об авторе записи о группе
        $autorData = $this->teamsRepository->getAutor($teamData['user_id']);
        // Данные о текущем составе группы
        $peopleActualityList = $this->teamsRepository->getPeopleActuality($id);
        $peopleActualityCount = $this->teamsRepository->getPeopleActualityCount($id);
        // Данные об истории ротации состава группы
        $peopleHistoryList = $this->teamsRepository->getPeopleHistory($id);
        $peopleHistoryCount = $this->teamsRepository->getPeopleHistoryCount($id);

        return view('hr.personal-cards.show', 
               compact('user', 'menu', 'title', 'access', 
                       'teamData', 
                       'leaderData', 
                       'userData',
                       '$autorData', 
                       'peopleActualityList', 
                       'peopleActualityCount',
                       'peopleHistoryList',  
                       'peopleHistoryCount'
                       ));
//        $teamsList = $this->teamsRepository->getShow($id);
//
//        return view('hr.teams.show', 
//               compact('menu', 'title', 'access', 'teamsList'));
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
        $title = "Новая бригада";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->teamsRepository->getListSelect(0);

        return view('hr.teams.create', 
               compact('menu', 'title', 
                      'personalCardsList'));
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
                ->route('hr.teams.edit', $result->id)
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
        $title = "Карточка бригады";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->teamsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $teamsList = $this->teamsRepository->getEdit($id);

        return view('hr.teams.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'teamsList'));
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
                ->route('hr.teams.edit', $item->id)
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
                ->route('hr.teams.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}