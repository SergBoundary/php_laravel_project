<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Objects;
use App\Models\Accounting\Pieceworks;
use App\Repositories\Accounting\PieceworksRepository;
use App\Http\Requests\Accounting\PieceworksCreateRequest;
use App\Http\Requests\Accounting\PieceworksUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class PieceworksController: Контроллер учета сдельных работ
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class PieceworksController extends BaseAccountingController {

    /**
     * @var PieceworksRepository
     */
    private $pieceworksRepository;

    /**
     * @var path
     */
    private $path = 'acc/pieceworks';

    public function __construct() {

        parent::__construct();

        $this->pieceworksRepository = app(PieceworksRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest', compact('interface'));
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];
		
        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Сдельные работы";
        
        $year = $this->pieceworksRepository->getYearNumer(date("Y"));
        $month = $this->pieceworksRepository->getMonth(date("m"));
        $yearsList = $this->pieceworksRepository->getListSelect(1);
        $monthsList = $this->pieceworksRepository->getListSelect(2);
        $pieceworksList = $this->pieceworksRepository->getTable();
//        dd($year['id']);
        return view('acc.pieceworks.index',  
               compact('menu', 'interface', 'title', 'access', 
                       'year', 
                       'month',
                       'yearsList', 
                       'monthsList', 
                       'pieceworksList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
		
        $auth = Auth::user();
        if(empty($auth)) {
            return view('guest', compact('interface'));
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Сдельная работа";
        // Параметры отбора данных
        $row = explode("-", $id);
        $team = $this->pieceworksRepository->getTeam($row[0]);
        $year = $this->pieceworksRepository->getYear($row[1]);
        $month = $this->pieceworksRepository->getMonth($row[2]);
        // Данные табеля для данной группы в данном периоде
        $pieceworksList = $this->pieceworksRepository->getEdit($row[0], $row[1], $row[2]);
        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->pieceworksRepository->getListSelect(0);
        $yearsList = $this->pieceworksRepository->getListSelect(1);
        $monthsList = $this->pieceworksRepository->getListSelect(2);
        $objectsList = $this->pieceworksRepository->getListSelect(3);
//        $id = "3-4-12";
//        dd($pieceworksList);
        return view('acc.pieceworks.show', 
               compact('menu', 'interface', 'title', 'access', 'team', 'year', 'month', 'id', 
                       'pieceworksList',
                       'personalCardsList', 
                       'yearsList', 
                       'monthsList', 
                       'objectsList'));
    }

    /**
     * Метод создания представления новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }
        
        $auth = Auth::user();
        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Новая сдельная работа";
        // Параметры отбора данных
        $data = $request->input();
        $teamLeader = $this->pieceworksRepository->getTeamLeader($auth['id']);
        $team = $this->pieceworksRepository->getTeam($teamLeader['id']);
        if($team) {
            $teamId = $team['id'];
        } else {
            $teamId = 0;
        }
//        dd($data);
        $year = $this->pieceworksRepository->getYear($data['year_id']);
        $month = $this->pieceworksRepository->getMonth($data['month_id']);
        // Данные о перемещениях в данном периоде
        $allocationsList = $this->pieceworksRepository->getCreate($team['id'], $year['number'], $month['number']);
        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->pieceworksRepository->getListSelect(0);
        $yearsList = $this->pieceworksRepository->getListSelect(1);
        $monthsList = $this->pieceworksRepository->getListSelect(2);
        $objectsList = $this->pieceworksRepository->getListSelect(3);
        
        return view('acc.pieceworks.create', 
               compact('menu', 'interface', 'title', 'team', 'year', 'month',
                       'allocationsList',
                       'personalCardsList', 
                       'yearsList', 
                       'monthsList', 
                       'objectsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PieceworksCreateRequest $request) {
        
        $data = $request->input();
        
        $auth = Auth::user();
        $teamLeader = $this->pieceworksRepository->getTeamLeader($auth['id']);
        $team = $this->pieceworksRepository->getTeam($teamLeader['id']);
        if($team) {
            $teamId = $team['id'];
        } else {
            $teamId = 0;
        }
        // Данные о перемещениях в данном периоде
        $allocationList = $this->pieceworksRepository->getCreate($teamId, $data['year'], $data['month']);
        foreach ($allocationList as $key => $value) {
            for ($i = 1; $i < 3; $i++) {
                $newData['user_id'] = Auth::user()->id;
                $newData['team_id'] = $value['team_id'];
                $newData['personal_card_id'] = $data['personal_card_id_'.$key];
                $newData['object_id'] = $data['object_id_'.$key];
                $newData['year_id'] = $data['year_id'];
                $newData['month_id'] = $data['month_id'];
                $newData['type'] = $data['type_'.$i.'_'.$key];
                $newData['unit'] = $data['unit_'.$i.'_'.$key];
                $newData['quantity'] = $data['quantity_'.$i.'_'.$key];
                $newData['price'] = $data['price_'.$i.'_'.$key];
                $newData['total'] = $data['total_'.$i.'_'.$key];
                
                $baseTimesheetsData['user_id'] = $newData['user_id'];
                $baseTimesheetsData['team_id'] = $newData['team_id'];
                $baseTimesheetsData['personal_card_id'] = $newData['personal_card_id'];
                $baseTimesheetsData['object_id'] = $newData['object_id'];
                $baseTimesheetsData['year_id'] = $newData['year_id'];
                $baseTimesheetsData['month_id'] = $newData['month_id'];
                $baseTimesheetsData['piecework'] = $newData['total'];

                if($newData['type'] !== null && $newData['total'] != 0) {
                    $result = (new Pieceworks($newData))->create($newData);
                    $baseTimesheetsItem = $this->pieceworksRepository->getBaseTimesheets($newData['team_id'], $newData['personal_card_id'], $newData['object_id'], $newData['year_id'], $newData['month_id']);
                    if(!empty($baseTimesheetsItem)) {
//                        dd($newData, $baseTimesheetsItem);
                        $baseTimesheetsResult = $baseTimesheetsItem->update($baseTimesheetsData);
                    }
                }
            }
        }
        
        if(isset($result)) {
            if($result) {
                return redirect()
                    ->route('acc.pieceworks.index')
                    ->with(['success' => "Успешно сохранено"]);
            } else {
                return back()
                    ->withErrors(['msg' => "Ошибка сохранения.."])
                    ->withInput();
            }
        } else {
            return redirect()
                ->route('acc.pieceworks.index');
        }
    }

    /**
     * Метод создания представления изменения
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        
        $data = $request->input();
        if(!empty($data['language'])) {
            $this->setInterface($data['language']);
            $interface = session('interface');
        } else {
            if($request->session()->has('interface')) {
                $interface = session('interface');
            } else {
                $this->setInterface();
                $interface = session('interface');
            }
        }

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest', compact('interface'));
        }
        // Формируем массив данных о представлении
        $title = "Сдельная работа";
        // Параметры отбора данных
        $row = explode("-", $id);
        $team = $this->pieceworksRepository->getTeam($row[0]);
        $year = $this->pieceworksRepository->getYear($row[1]);
        $month = $this->pieceworksRepository->getMonth($row[2]);
        // Данные табеля для данной группы в данном периоде
        $pieceworksList = $this->pieceworksRepository->getEdit($row[0], $row[1], $row[2]);
        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->pieceworksRepository->getListSelect(0);
        $yearsList = $this->pieceworksRepository->getListSelect(1);
        $monthsList = $this->pieceworksRepository->getListSelect(2);
        $objectsList = $this->pieceworksRepository->getListSelect(3);
//        $id = "3-4-12";
//        dd($id, $pieceworksList);
        return view('acc.pieceworks.edit', 
               compact('menu', 'interface', 'title', 'team', 'year', 'month', 'id', 
                       'pieceworksList',
                       'personalCardsList', 
                       'yearsList', 
                       'monthsList', 
                       'objectsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PieceworksUpdateRequest $request, $id) {
        
        $row = explode("-", $id);
        $data = $request->all();
//        dd($row, $data);
        // Данные о перемещениях в данном периоде
        $countEdit = $this->pieceworksRepository->getEdit($row[0], $row[1], $row[2]);
//        dd($row[0], $row[1], $row[2], count($countEdit));
        for ($order = 0; $order < count($countEdit); $order++) {
            $newData['user_id'] = Auth::user()->id;
            $newData['team_id'] = $data['team_id'];
            $newData['year_id'] = $data['year_id'];
            $newData['month_id'] = $data['month_id'];
            $newData['personal_card_id'] = $data['personal_card_id_'.$order];
            $newData['object_id'] = $data['object_id_'.$order];
            $newData['type'] = $data['type_'.$order];
            $newData['unit'] = $data['unit_'.$order];
            $newData['quantity'] = $data['quantity_'.$order];
            $newData['price'] = $data['price_'.$order];
            $newData['total'] = $data['total_'.$order];
            $item = $this->pieceworksRepository->getUpdate($data['id_'.$order]);
            $result = $item->update($newData);
        }
        
        if($result) {
            return redirect()
                ->route('acc.pieceworks.show', $id)
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
        
        $pos = strpos($id, "-");
        
        if ($pos === false) {
            dd($id);
            $result = $this->pieceworksRepository->getUpdate($id)->forceDelete();
        } else {
            // Параметры отбора данных
            $row = explode("-", $id);
            dd($id, $row);
            $team = $this->pieceworksRepository->getTeam($row[0]);
            $year = $this->pieceworksRepository->getYear($row[1]);
            $month = $this->pieceworksRepository->getMonth($row[2]);
        }

        $result = $this->pieceworksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.pieceworks.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}