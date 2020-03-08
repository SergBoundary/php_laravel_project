<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Teams;
use App\Models\HumanResources\Allocations;
use App\Models\Settings\Users;
use App\Repositories\HumanResources\TeamsRepository;
use App\Http\Requests\HumanResources\TeamsCreateRequest;
use App\Http\Requests\HumanResources\TeamsUpdateRequest;
use App\Models\Settings\Menus;
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
    public function index(Request $request) {
		
        $auth = Auth::user();
        
        if($request->session()->has('interface')) {
            $interface = session('interface');
        } else {
            $this->setInterface();
            $interface = session('interface');
        }
        
        if($request->session()->has('title')) {
            $title = session('title');
        } else {
            $this->setInterface();
            $title = session('title');
        }
        
        if(empty($auth)) {
            return view('guest', compact('interface', 'title'));
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        $teamsList = $this->teamsRepository->getTable();

        return view('hr.teams.index',  
               compact('interface', 'title', 'access', 
                       'teamsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
		
        $auth = Auth::user();
        
        if($request->session()->has('interface')) {
            $interface = session('interface');
        } else {
            $this->setInterface();
            $interface = session('interface');
        }
        
        if($request->session()->has('title')) {
            $title = session('title');
        } else {
            $this->setInterface();
            $title = session('title');
        }
        
        if(empty($auth)) {
            return view('guest', compact('interface', 'title'));
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        // Данные о группе
        $teamData = $this->teamsRepository->getTeam($id);
        // Данные об авторе записи о группе
        $autorData = $this->teamsRepository->getAutor($teamData['user_id']);
        // Данные о руководителе группы как сотруднике и пользователе
        $leaderData = $this->teamsRepository->getLeader($teamData['personal_card_id']);
        $userData = Users::find($teamData['personal_card_id']);
        $leaderManningOrderData = $this->teamsRepository->getLeaderManningOrderActuality($teamData['personal_card_id']);
        // Данные о текущих объектах группы
        $objectsList = $this->teamsRepository->getObject($id, $teamData['personal_card_id']);
        $objectsCount = $this->teamsRepository->getObjectCount($id, $teamData['personal_card_id']);
        // Данные о текущем составе группы
        $peopleList = $this->teamsRepository->getPeople($id, $teamData['personal_card_id']);
        $peopleCount = $this->teamsRepository->getPeopleCount($id, $teamData['personal_card_id']);

        return view('hr.teams.show', 
               compact('interface', 'title', 'access', 
                       'autorData',
                       'teamData', 
                       'objectsList',
                       'objectsCount',
                       
                       'leaderData', 
                       'userData', 
                       'leaderManningOrderData',
                       
                       'peopleList', 
                       'peopleCount'));
    }

    /**
     * Метод создания представления новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
		
        $auth = Auth::user();
        
        if($request->session()->has('interface')) {
            $interface = session('interface');
        } else {
            $this->setInterface();
            $interface = session('interface');
        }
        
        if($request->session()->has('title')) {
            $title = session('title');
        } else {
            $this->setInterface();
            $title = session('title');
        }
        
        if(empty($auth)) {
            return view('guest', compact('interface', 'title'));
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        // Списки данных
        $peopleList = $this->teamsRepository->getListSelect(0);

        return view('hr.teams.create', 
               compact('interface', 'title', 'access', 
                       'peopleList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TeamsCreateRequest $request) {

        $data = $request->input();
        // Формируем новую бригаду
        $newData['user_id'] = Auth::user()->id;
        $newData['personal_card_id'] = $data['personal_card_id'];
        $newData['title'] = $data['title'];
        $newData['abbr'] = $data['abbr'];
        $newData['start'] = $data['start'];
        $newData['expiry'] = null;
//        dd($newData);
        $result = (new Teams($newData))->create($newData);

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
    public function edit(Request $request, $id) {
		
        $auth = Auth::user();
        
        if($request->session()->has('interface')) {
            $interface = session('interface');
        } else {
            $this->setInterface();
            $interface = session('interface');
        }
        
        if($request->session()->has('title')) {
            $title = session('title');
        } else {
            $this->setInterface();
            $title = session('title');
        }
        
        if(empty($auth)) {
            return view('guest', compact('interface', 'title'));
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        // Данные о группе
        $teamData = $this->teamsRepository->getTeam($id);
        // Данные об авторе записи о группе
        $autorData = $this->teamsRepository->getAutor($teamData['user_id']);
        // Данные о руководителе группы как сотруднике и пользователе
        $leaderData = $this->teamsRepository->getLeader($teamData['personal_card_id']);
        $userData = Users::find($teamData['personal_card_id']);
        $leaderManningOrderData = $this->teamsRepository->getLeaderManningOrderActuality($teamData['personal_card_id']);
        // Списки данных
        $leadersList = $this->teamsRepository->getListSelect(0);
        $departmentsList = $this->teamsRepository->getListSelect(1);
        $positionsList = $this->teamsRepository->getListSelect(2);
        $positionProfessionsList = $this->teamsRepository->getListSelect(3);
        // Данные о текущих объектах группы
        $objectsList = $this->teamsRepository->getObject($id, $teamData['personal_card_id']);
        $objectsCount = $this->teamsRepository->getObjectCount($id, $teamData['personal_card_id']);
        // Данные о текущем составе группы
        $peopleList = $this->teamsRepository->getPeople($id, $teamData['personal_card_id']);
        $peopleCount = $this->teamsRepository->getPeopleCount($id, $teamData['personal_card_id']);

        return view('hr.teams.edit', 
               compact('interface', 'title', 'access', 
                       'autorData',
                       'teamData', 
                       'leaderData', 
                       'userData', 
                       'leaderManningOrderData',
                       
                       'leadersList', 
                       'departmentsList', 
                       'positionsList', 
                       'positionProfessionsList', 
                       
                       'objectsList',
                       'objectsCount',
                       'peopleList', 
                       'peopleCount'));
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
        if($item['personal_card_id'] == $data['personal_card_id']) {
            // Проверка на расформирование активной бригады
            if(!empty($data['expiry'])) {
                // Открепляем сотрудников от расформировываемой бригады
                $peopleItem = $this->teamsRepository->getAllPeople($id);
                foreach ($peopleItem as $value) {
                    $peopleResult = $this->teamsRepository->getCloseTeam($value['id'], $data['expiry']);
                }
                $result = $item->update($data);
                if($peopleResult && $result) {
                    return redirect()
                        ->route('hr.teams.edit', $item->id)
                        ->with(['success' => "Успешно сохранено"]);
                } else {
                    return back()
                        ->withErrors(['msg' => "Ошибка сохранения.."])
                        ->withInput();
                }
            }
            $result = $item->update($data);
            if($result) {
                return redirect()
                    ->route('hr.teams.show', $item->id)
                    ->with(['success' => "Успешно сохранено"]);
            } else {
                return back()
                    ->withErrors(['msg' => "Ошибка сохранения.."])
                    ->withInput();
            }
        } else {
            // Расформировываем текущую бригаду
            $oldData['user_id'] = $item['user_id'];
            $oldData['personal_card_id'] = $item['personal_card_id'];
            $oldData['title'] = $item['title'];
            $oldData['abbr'] = $item['abbr'];
            $oldData['start'] = $item['start'];
            $oldData['expiry'] = $data['start'];
            // Формируем новую бригаду
            $newData['user_id'] = Auth::user()->id;
            $newData['personal_card_id'] = $data['personal_card_id'];
            $newData['title'] = $data['title'];
            $newData['abbr'] = $data['abbr'];
            $newData['start'] = $data['start'];
            $newData['expiry'] = null;
            $newResult = (new Teams($newData))->create($newData);
            $newID = $newResult->id;
            // Перемещаем персонал из старой бригады в новую бригаду
            $peopleItem = $this->teamsRepository->getAllPeople($id);
            foreach ($peopleItem as $value) {
                // 1) закрепляем сотрудников за новой бригадой
                if($oldData['personal_card_id'] != $value['personal_card_id']) {
                    $createResult = $this->teamsRepository->getMovingPeople($newID, $value['personal_card_id'], $value['object_id'], $data['start'], $newData['user_id']);
                } elseif($oldData['personal_card_id'] == $value['personal_card_id']) {
                    $createResult = $this->teamsRepository->getMovingPeople($newID, $data['personal_card_id'], $value['object_id'], $data['start'], $newData['user_id']);
                }
                // 2) открепляем сотрудников от расформировываемой бригады
                $updateResult = $this->teamsRepository->getCloseTeam($value['id'], $data['start']);
            }
            $oldResult = $item->update($oldData);
            if($oldResult && $newResult) {
                return redirect()
                    ->route('hr.teams.show', $item->id)
                    ->with(['success' => "Успешно сохранено"]);
            } else {
                return back()
                    ->withErrors(['msg' => "Ошибка сохранения.."])
                    ->withInput();
            }
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