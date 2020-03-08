<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Objects;
use App\Models\HumanResources\Teams;
use App\Models\HumanResources\Allocations;
use App\Models\Settings\Users;
use App\Repositories\HumanResources\AllocationsRepository;
use App\Http\Requests\HumanResources\AllocationsCreateRequest;
use App\Http\Requests\HumanResources\AllocationsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class AllocationsController: Контроллер учета должностных назначений работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class AllocationsController extends BaseHumanResourcesController {

    /**
     * @var AllocationsRepository
     */
    private $allocationsRepository;

    /**
     * @var path
     */
    private $path = 'hr/allocations';

    public function __construct() {

        parent::__construct();

        $this->allocationsRepository = app(AllocationsRepository::class);

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

        $allocationsList = $this->allocationsRepository->getTable();

        return view('hr.allocations.index',  
               compact('interface', 'title', 'access', 
                       'allocationsList'));
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

        // Данные о перемещении
        $allocationData = $this->allocationsRepository->getAllocation($id);
        // Данные об авторе записи
        $autorData = $this->allocationsRepository->getAutor($allocationData['user_id']);
        // Данные о сотруднике
        $personalCardData = $this->allocationsRepository->getPersonalCard($allocationData['personal_card_id']);
        $userData = Users::find($allocationData['personal_card_id']);

        return view('hr.allocations.show', 
               compact('interface', 'title', 'access', 
                       'personalCardData',
                       'autorData',
                       'userData', 
                       'allocationData'));
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

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->allocationsRepository->getListSelect(0);
        $objectsList = $this->allocationsRepository->getListSelect(1);
        $teamsList = $this->allocationsRepository->getListSelect(2);

        return view('hr.allocations.create', 
               compact('interface', 'title', 'access', 
                      'personalCardsList', 
                      'objectsList', 
                      'teamsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AllocationsCreateRequest $request) {

        $data = $request->input();
        
        // Формируем изменения назначения на должность
        $newData['user_id'] = Auth::user()->id;
        $newData['personal_card_id'] = $data['personal_card_id'];
        $newData['object_id'] = $data['object_id'];
        $newData['team_id'] = $data['team_id'];
        $newData['start'] = $data['start'];
        $newData['expiry'] = null;
        
        $result = (new Allocations($newData))->create($newData);
        if($result) {
            return redirect()
                ->route('hr.allocations.edit', $result->id)
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

        // Данные о назначении
        $allocationData = $this->allocationsRepository->getEdit($id);
        // Данные об авторе записи
        $autorData = $this->allocationsRepository->getAutor($allocationData['user_id']);
        // Данные о сотруднике
        $personalCardData = $this->allocationsRepository->getPersonalCard($allocationData['personal_card_id']);
        $userData = Users::find($allocationData['personal_card_id']);

        // Формируем содержание списка выбираемых полей полей select
        $objectsList = $this->allocationsRepository->getListSelect(1);
        $teamsList = $this->allocationsRepository->getListSelect(2);

        return view('hr.allocations.edit', 
               compact('interface', 'title', 'access', 
                       'personalCardData',
                       'autorData',
                       'userData', 
                       'allocationData',
                       'objectsList', 
                       'teamsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AllocationsUpdateRequest $request, $id) {

        $item = $this->allocationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        
        // Формируем изменения назначения на должность
        $newData['user_id'] = Auth::user()->id;
        $newData['personal_card_id'] = $data['personal_card_id'];
        $newData['object_id'] = $data['object_id'];
        $newData['team_id'] = $data['team_id'];
        $newData['start'] = $data['start'];
        $newData['expiry'] = $data['expiry'];
        
        $result = $item->update($newData);
        if($result) {
            return redirect()
                ->route('hr.allocations.show', $item->id)
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

        $result = $this->allocationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.allocations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}