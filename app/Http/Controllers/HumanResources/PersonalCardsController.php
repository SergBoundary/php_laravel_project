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
use App\Models\Settings\Menu;
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
        $title = "Кадровый ресурс";

        $personalCardsList = $this->personalCardsRepository->getTable();

        return view('hr.personal-cards.index',  
               compact('menu', 'title', 'access', 'personalCardsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
        $user = Auth::user();
        if(empty($user)) {
            return view('guest');
        }
        $auth_access = Menu::select('access_'.$user['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$user['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Карточка сотрудника";  
        // Формируем содержание списка заполняемых полей input
        $userData = Users::find($id);
        $personalCardsData = $this->personalCardsRepository->getPersonalActuality($id);
        $manningOrderData = $this->personalCardsRepository->getManningOrderActuality($id);
        $allocationData = $this->personalCardsRepository->getAllocationActuality($id);
        $manningOrderList = $this->personalCardsRepository->getManningOrderHistory($id);
        $allocationList = $this->personalCardsRepository->getAllocationHistory($id);
        $manningOrderCount = $this->personalCardsRepository->getManningOrderCount($id);
        $allocationCount = $this->personalCardsRepository->getAllocationCount($id);

        return view('hr.personal-cards.show', 
               compact('user', 'menu', 'title', 'access', 
                       'userData',
                       'personalCardsData', 
                       'manningOrderData', 
                       'allocationData', 
                       'manningOrderList', 
                       'allocationList', 
                       'manningOrderCount', 
                       'allocationCount'
                       ));
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
        $title = "Новый сотрудник";
        
        $departmentsList = $this->personalCardsRepository->getListSelect(1);
        $positionsList = $this->personalCardsRepository->getListSelect(2);
        $positionProfessionsList = $this->personalCardsRepository->getListSelect(3);
        $teamsList = $this->personalCardsRepository->getListSelect(4);
        $objectsList = $this->personalCardsRepository->getListSelect(5);

        return view('hr.personal-cards.create', 
               compact('menu', 'title',
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
        
        $personalCardsData['surname'] = $data['surname'];
        $personalCardsData['first_name'] = $data['first_name'];
        $personalCardsData['second_name'] = $data['second_name'];
        $personalCardsData['personal_account'] = $data['personal_account'];
        $personalCardsData['full_name_latina'] = mb_convert_case($data['full_name_latina'], MB_CASE_UPPER);
        $personalCardsData['sex'] = ucwords($data['sex']);
        $personalCardsData['born_date'] = $data['born_date'];
        $personalCardsData['phone'] = $data['phone'];
        $personalCardsData['photo_url'] = "/img/".$data['photo_url'];
        
        $personalCardsResult = (new PersonalCards($personalCardsData))->create($personalCardsData);
        $id = $personalCardsResult->id;
        
        $userData['name'] = trim($data['surname']." ".$data['first_name']." ".$data['second_name']);
        $userData['personal_account'] = $data['personal_account'];
        $userData['email'] = $data['email'];
        $userData['password'] = bcrypt($data['personal_account']);
        $userData['access'] = 1;
        $userData['photo_url'] = $data['photo_url'];
        
        $userResult = (new Users($userData))->create($userData);
        
        $manningOrdersData['personal_card_id'] = $id;
        $manningOrdersData['department_id'] = $data['department_id'];
        $manningOrdersData['position_id'] = $data['position_id'];
        $manningOrdersData['position_profession_id'] = $data['position_profession_id'];
        $manningOrdersData['assignment_date'] = $data['assignment_date'];
        
        $manningOrdersResult = (new ManningOrders($manningOrdersData))->create($manningOrdersData);
        
        $allocationsData['personal_card_id'] = $id;
        $allocationsData['team_id'] = $data['team_id'];
        $allocationsData['object_id'] = $data['object_id'];
        $allocationsData['start'] = $data['start'];
        
        $allocationsResult = (new Allocations($allocationsData))->create($allocationsData);

        if($personalCardsData && $userData && $manningOrdersData && $allocationsResult) {
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
    public function edit($id) {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Карточка сотрудника";
        // Формируем содержание списка заполняемых полей input
        $userData = Users::find($id);
        $personalCardsData = $this->personalCardsRepository->getPersonalActuality($id);
        $manningOrderData = $this->personalCardsRepository->getManningOrderActuality($id);
        $allocationData = $this->personalCardsRepository->getAllocationActuality($id);
        $departmentsList = $this->personalCardsRepository->getListSelect(1);
        $positionsList = $this->personalCardsRepository->getListSelect(2);
        $positionProfessionsList = $this->personalCardsRepository->getListSelect(3);
        $teamsList = $this->personalCardsRepository->getListSelect(4);
        $objectsList = $this->personalCardsRepository->getListSelect(5);

        return view('hr.personal-cards.edit', 
               compact('menu', 'title', 
                       'userData',
                       'personalCardsData',
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
        
        $personalCardsData['surname'] = $data['surname'];
        $personalCardsData['first_name'] = $data['first_name'];
        $personalCardsData['second_name'] = $data['second_name'];
        $personalCardsData['personal_account'] = $data['personal_account'];
        $personalCardsData['full_name_latina'] = mb_convert_case($data['full_name_latina'], MB_CASE_UPPER);
        $personalCardsData['sex'] = ucwords($data['sex']);
        $personalCardsData['born_date'] = $data['born_date'];
        $personalCardsData['phone'] = $data['phone'];
        $personalCardsData['photo_url'] = $data['photo_url'];
        
        $userData['name'] = trim($data['surname']." ".$data['first_name']." ".$data['second_name']);
        $userData['personal_account'] = $data['personal_account'];
        $userData['email'] = $data['email'];
        $userData['photo_url'] = $data['photo_url'];
        
        $manningOrdersData['personal_card_id'] = $id;
        $manningOrdersData['department_id'] = $data['department_id'];
        $manningOrdersData['position_id'] = $data['position_id'];
        $manningOrdersData['position_profession_id'] = $data['position_profession_id'];
        $manningOrdersData['assignment_date'] = $data['assignment_date'];
        
        $allocationsData['personal_card_id'] = $id;
        $allocationsData['team_id'] = $data['team_id'];
        $allocationsData['object_id'] = $data['object_id'];
        $allocationsData['start'] = $data['start'];
        
        $personalCardsResult = $personalCardsItem->update($personalCardsData);
        $userResult = $userItem->update($userData);
        $manningOrdersResult = $manningOrdersItem->update($manningOrdersData);
        $allocationsResult = $allocationsItem->update($allocationsData);
//dd($data, $personalCardsData, $userData, $manningOrdersItem, $manningOrdersData, $allocationsData);
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