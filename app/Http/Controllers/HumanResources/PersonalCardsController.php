<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\Settings\Users;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\Allocations;
use App\Models\HumanResources\ManningOrders;
use App\Repositories\HumanResources\PersonalCardsRepository;
use App\Http\Requests\HumanResources\PersonalCardsCreateRequest;
use App\Http\Requests\HumanResources\PersonalCardsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class PersonalCardsController: Контроллер учета неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalCardsController extends BaseHumanResourcesController {

    /**
     * @var PersonalCardsRepository
     */
    private $personalCardsRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-cards';

    public function __construct() {

        parent::__construct();

        $this->personalCardsRepository = app(PersonalCardsRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
		
        $auth = Auth::user();
        
        if(empty($auth)) {
            $interface = $this->setInterface($request, 'guest');
            return view('guest', compact('interface'));
        } else {
            $interface = $this->setInterface($request, 'human-resources-index', $auth['id']);
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        $personalCardsList = $this->personalCardsRepository->getTable();
        
        return view('hr.personal-cards.index',  
               compact('interface', 'access', 
                       'personalCardsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
		
        $auth = Auth::user();
        
        if(empty($auth)) {
            $interface = $this->setInterface($request, 'guest');
            return view('guest', compact('interface'));
        } else {
            $interface = $this->setInterface($request, 'human-resources-show', $auth['id']);
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        // Формируем содержание списка заполняемых полей input
        $userData = Users::find($id);
        $personalCardData = $this->personalCardsRepository->getPersonalActuality($id, $auth['structura']);
        $manningOrderData = $this->personalCardsRepository->getManningOrderActuality($id, $auth['structura']);
        $allocationData = $this->personalCardsRepository->getAllocationActuality($id, $auth['structura']);
        
        $manningOrderList = $this->personalCardsRepository->getManningOrderHistory($id, $auth['structura']);
        $allocationList = $this->personalCardsRepository->getAllocationHistory($id, $auth['structura']);
        
        $manningOrderCount = $this->personalCardsRepository->getManningOrderCount($id, $auth['structura']);
        $allocationCount = $this->personalCardsRepository->getAllocationCount($id, $auth['structura']);

        return view('hr.personal-cards.show', 
               compact('interface', 'access', 
                       'userData',
                       'personalCardData', 
                       'manningOrderData', 
                       'allocationData', 
                       'manningOrderList', 
                       'allocationList', 
                       'manningOrderCount', 
                       'allocationCount'));
    }

    /**
     * Метод создания представления новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
		
        $auth = Auth::user();
        
        if(empty($auth)) {
            $interface = $this->setInterface($request, 'guest');
            return view('guest', compact('interface'));
        } else {
            $interface = $this->setInterface($request, 'human-resources-add', $auth['id']);
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        $departmentsList = $this->personalCardsRepository->getListSelect(1);
        $positionsList = $this->personalCardsRepository->getListSelect(2);
        $positionProfessionsList = $this->personalCardsRepository->getListSelect(3);
        $teamsList = $this->personalCardsRepository->getListSelect(4);
        $objectsList = $this->personalCardsRepository->getListSelect(5);

        return view('hr.personal-cards.create', 
               compact('interface', 'access',
                       'departmentsList',
                       'positionsList',
                       'positionProfessionsList',
                       'teamsList',
                       'objectsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalCardsCreateRequest $request) {

        $data = $request->input();
        
        $personalCardData['user_id'] = Auth::user()->id;
        $personalCardData['surname'] = $data['surname'];
        $personalCardData['first_name'] = $data['first_name'];
        $personalCardData['second_name'] = $data['second_name'];
        $personalCardData['personal_account'] = $data['personal_account'];
        $personalCardData['full_name_latina'] = mb_convert_case($data['full_name_latina'], MB_CASE_UPPER);
        $personalCardData['sex'] = ucwords($data['sex']);
        $personalCardData['born_date'] = $data['born_date'];
        $personalCardData['phone'] = $data['phone'];
        $personalCardData['photo_url'] = "/img/".$data['photo_url'];
        
        $personalCardsResult = (new PersonalCards($personalCardData))->create($personalCardData);
        $id = $personalCardsResult->id;
        
        $userData['name'] = trim($data['surname']." ".$data['first_name']." ".$data['second_name']);
        $userData['login'] = $data['personal_account'];
        $userData['email'] = $data['email'];
        $userData['password'] = bcrypt($data['personal_account']);
        $userData['access'] = 1;
        $userData['photo_url'] = $data['photo_url'];
        
        $userResult = (new Users($userData))->create($userData);
        
        $manningOrderData['user_id'] = Auth::user()->id;
        $manningOrderData['personal_card_id'] = $id;
        $manningOrderData['department_id'] = $data['department_id'];
        $manningOrderData['position_id'] = $data['position_id'];
        $manningOrderData['position_profession_id'] = $data['position_profession_id'];
        $manningOrderData['assignment_date'] = $data['assignment_date'];
        
        $manningOrdersResult = (new ManningOrders($manningOrderData))->create($manningOrderData);
        
        $allocationData['user_id'] = Auth::user()->id;
        $allocationData['personal_card_id'] = $id;
        $allocationData['team_id'] = $data['team_id'];
        $allocationData['object_id'] = $data['object_id'];
        $allocationData['start'] = $data['start'];
        
        $allocationsResult = (new Allocations($allocationData))->create($allocationData);

        if($personalCardData && $userData && $manningOrderData && $allocationsResult) {
            return redirect()
                ->route('hr.personal-cards.edit', $personalCardsResult->id)
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
        
        if(empty($auth)) {
            $interface = $this->setInterface($request, 'guest');
            return view('guest', compact('interface'));
        } else {
            $interface = $this->setInterface($request, 'human-resources-edit', $auth['id']);
        }
        
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
        
        // Формируем содержание списка заполняемых полей input
        $userData = Users::find($id);
        $personalCardData = $this->personalCardsRepository->getPersonalActuality($id);
        $manningOrderData = $this->personalCardsRepository->getManningOrderActuality($id);
        $allocationData = $this->personalCardsRepository->getAllocationActuality($id);
        
        $departmentsList = $this->personalCardsRepository->getListSelect(1);
        $positionsList = $this->personalCardsRepository->getListSelect(2);
        $positionProfessionsList = $this->personalCardsRepository->getListSelect(3);
        $teamsList = $this->personalCardsRepository->getListSelect(4);
        $objectsList = $this->personalCardsRepository->getListSelect(5);

        return view('hr.personal-cards.edit', 
               compact('interface', 'access', 
                       'userData',
                       'personalCardData',
                       'manningOrderData',
                       'allocationData',
                       'departmentsList',
                       'positionsList',
                       'positionProfessionsList',
                       'teamsList',
                       'objectsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalCardsUpdateRequest $request, $id) {

        $personalCardsItem = $this->personalCardsRepository->getPersonalActuality($id);
        if(empty($personalCardsItem)) {
            return back()
                ->withErrors(['msg' => "Запись с указанными персональными данными не найдена.."])
                ->withInput();
        }
        $userItem = Users::find($id);
        if(empty($userItem)) {
            return back()
                ->withErrors(['msg' => "Запись с указанным пользователем не найдена.."])
                ->withInput();
        }
        $manningOrdersItem = $this->personalCardsRepository->getManningOrderActuality($id);
        if(empty($manningOrdersItem)) {
            return back()
                ->withErrors(['msg' => "Запись с указанными назначениями не найдена.."])
                ->withInput();
        }
        $allocationsItem = $this->personalCardsRepository->getAllocationActuality($id);
        if(empty($allocationsItem)) {
            return back()
                ->withErrors(['msg' => "Запись с указанными перемещениями не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        
        $personalCardData['surname'] = $data['surname'];
        $personalCardData['first_name'] = $data['first_name'];
        $personalCardData['second_name'] = $data['second_name'];
        $personalCardData['personal_account'] = $data['personal_account'];
        $personalCardData['full_name_latina'] = mb_convert_case($data['full_name_latina'], MB_CASE_UPPER);
        $personalCardData['sex'] = ucwords($data['sex']);
        $personalCardData['born_date'] = $data['born_date'];
        $personalCardData['phone'] = $data['phone'];
        $personalCardData['photo_url'] = $data['photo_url'];
        
        $userData['name'] = trim($data['surname']." ".$data['first_name']." ".$data['second_name']);
        $userData['personal_account'] = $data['personal_account'];
        $userData['email'] = $data['email'];
        $userData['photo_url'] = $data['photo_url'];
        
        $manningOrderData['personal_card_id'] = $id;
        $manningOrderData['department_id'] = $data['department_id'];
        $manningOrderData['position_id'] = $data['position_id'];
        $manningOrderData['position_profession_id'] = $data['position_profession_id'];
        $manningOrderData['assignment_date'] = $data['assignment_date'];
        
        $allocationData['personal_card_id'] = $id;
        $allocationData['team_id'] = $data['team_id'];
        $allocationData['object_id'] = $data['object_id'];
        $allocationData['start'] = $data['start'];
        $allocationData['expiry'] = $data['expiry'];
        
        $personalCardsResult = $personalCardsItem->update($personalCardData);
        $userResult = $userItem->update($userData);
        $manningOrdersResult = $manningOrdersItem->update($manningOrderData);
        $allocationsResult = $allocationsItem->update($allocationData);
//dd($data, $personalCardData, $userData, $manningOrdersItem, $manningOrderData, $allocationData);
        if($personalCardsResult && $userResult && $manningOrdersResult && $allocationsResult) {
            return redirect()
                ->route('hr.personal-cards.show', $personalCardsItem->id)
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

        $result = $this->personalCardsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-cards.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}