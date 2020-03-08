<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Departments;
use App\Models\References\Positions;
use App\Models\References\PositionProfessions;
use App\Models\HumanResources\ManningOrders;
use App\Models\Settings\Users;
use App\Repositories\HumanResources\ManningOrdersRepository;
use App\Http\Requests\HumanResources\ManningOrdersCreateRequest;
use App\Http\Requests\HumanResources\ManningOrdersUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class ManningOrdersController: Контроллер учета должностных назначений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class ManningOrdersController extends BaseHumanResourcesController {

    /**
     * @var ManningOrdersRepository
     */
    private $manningOrdersRepository;

    /**
     * @var path
     */
    private $path = 'hr/manning-orders';

    public function __construct() {

        parent::__construct();

        $this->manningOrdersRepository = app(ManningOrdersRepository::class);

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

        $manningOrdersList = $this->manningOrdersRepository->getTable();

        return view('hr.manning-orders.index',  
               compact('interface', 'title', 'access', 
                       'manningOrdersList'));
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

        // Данные о назначении
        $manningOrderData = $this->manningOrdersRepository->getManningOrder($id);
        // Данные об авторе записи
        $autorData = $this->manningOrdersRepository->getAutor($manningOrderData['user_id']);
        // Данные о сотруднике
        $personalCardData = $this->manningOrdersRepository->getPersonalCard($manningOrderData['personal_card_id']);
        $userData = Users::find($manningOrderData['personal_card_id']);

        return view('hr.manning-orders.show', 
               compact('interface', 'title', 'access', 
                       'personalCardData',
                       'autorData',
                       'userData', 
                       'manningOrderData'));
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
        $personalCardsList = $this->manningOrdersRepository->getListSelect(0);
        $departmentsList = $this->manningOrdersRepository->getListSelect(1);
        $positionsList = $this->manningOrdersRepository->getListSelect(2);
        $positionProfessionsList = $this->manningOrdersRepository->getListSelect(3);

        return view('hr.manning-orders.create', 
               compact('interface', 'title', 'access', 
                      'personalCardsList', 
                      'departmentsList', 
                      'positionsList', 
                      'positionProfessionsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ManningOrdersCreateRequest $request) {
        
        $data = $request->input();
        
        // Формируем новое назначение на должность
        $newData['user_id'] = Auth::user()->id;
        $newData['personal_card_id'] = $data['personal_card_id'];
        $newData['department_id'] = $data['department_id'];
        $newData['position_id'] = $data['position_id'];
        $newData['position_profession_id'] = $data['position_profession_id'];
        $newData['assignment_date'] = $data['assignment_date'];
        $newData['resignation_date'] = $data['resignation_date'];
        
        $result = (new ManningOrders($newData))->create($newData);
        
        if($result) {
            return redirect()
                ->route('hr.manning-orders.edit', $result->id)
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
        $manningOrderData = $this->manningOrdersRepository->getEdit($id);
        // Данные об авторе записи
        $autorData = $this->manningOrdersRepository->getAutor($manningOrderData['user_id']);
        // Данные о сотруднике
        $personalCardData = $this->manningOrdersRepository->getPersonalCard($manningOrderData['personal_card_id']);
        $userData = Users::find($manningOrderData['personal_card_id']);

        // Формируем содержание списка выбираемых полей полей select
        $departmentsList = $this->manningOrdersRepository->getListSelect(1);
        $positionsList = $this->manningOrdersRepository->getListSelect(2);
        $positionProfessionsList = $this->manningOrdersRepository->getListSelect(3);

        return view('hr.manning-orders.edit', 
               compact('interface', 'title', 'access', 
                       'personalCardData',
                       'autorData',
                       'userData', 
                       'manningOrderData',
                       'departmentsList', 
                       'positionsList', 
                       'positionProfessionsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ManningOrdersUpdateRequest $request, $id) {

        $item = $this->manningOrdersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        
        // Формируем изменения назначения на должность
        $newData['user_id'] = Auth::user()->id;
        $newData['personal_card_id'] = $data['personal_card_id'];
        $newData['department_id'] = $data['department_id'];
        $newData['position_id'] = $data['position_id'];
        $newData['position_profession_id'] = $data['position_profession_id'];
        $newData['assignment_date'] = $data['assignment_date'];
        $newData['resignation_date'] = $data['resignation_date'];
        
        $result = $item->update($newData);
        if($result) {
            return redirect()
                ->route('hr.manning-orders.show', $item->id)
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

        $result = $this->manningOrdersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.manning-orders.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}