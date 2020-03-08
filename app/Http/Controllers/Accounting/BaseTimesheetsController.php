<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\Objects;
use App\Models\Accounting\BaseTimesheets;
use App\Repositories\Accounting\BaseTimesheetsRepository;
use App\Http\Requests\Accounting\BaseTimesheetsCreateRequest;
use App\Http\Requests\Accounting\BaseTimesheetsUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class BaseTimesheetsController: Контроллер учета отработанного времени (табель)
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class BaseTimesheetsController extends BaseAccountingController {

    /**
     * @var BaseTimesheetsRepository
     */
    private $baseTimesheetsRepository;

    /**
     * @var path
     */
    private $path = 'acc/base-timesheets';

    public function __construct() {

        parent::__construct();

        $this->baseTimesheetsRepository = app(BaseTimesheetsRepository::class);

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
        $title = "Табеля выполненных работ";
        $year = $this->baseTimesheetsRepository->getYearNumer(date("Y"));
        $month = $this->baseTimesheetsRepository->getMonth(date("m"));
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $baseTimesheetsList = $this->baseTimesheetsRepository->getTable();
//        dd($year['id']);
        return view('acc.base-timesheets.index',  
               compact('menu', 'interface', 'title', 'access', 
                       'year', 
                       'month',
                       'yearsList', 
                       'monthsList', 
                       'baseTimesheetsList'));
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
        $title = "Табель выполненных работ";
        // Параметры отбора данных
        $row = explode("-", $id);
        $team = $this->baseTimesheetsRepository->getTeam($row[0]);
        $year = $this->baseTimesheetsRepository->getYear($row[1]);
        $month = $this->baseTimesheetsRepository->getMonth($row[2]);
        // Данные табеля для данной группы в данном периоде
        $baseTimesheetsList = $this->baseTimesheetsRepository->getEdit($row[0], $row[1], $row[2]);
        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(3);
//        $id = "3-4-12";
//        dd($baseTimesheetsList);
        return view('acc.base-timesheets.show', 
               compact('menu', 'interface', 'title', 'access', 'team', 'year', 'month', 'id', 
                       'baseTimesheetsList',
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
        $title = "Новый табель";
        // Параметры отбора данных
        $data = $request->input();
        $teamLeader = $this->baseTimesheetsRepository->getTeamLeader($auth['id']);
        $team = $this->baseTimesheetsRepository->getTeam($teamLeader['id']);
        if($team) {
            $teamId = $team['id'];
        } else {
            $teamId = 0;
        }
//        dd($auth['id'], $teamId, $teamLeader, $team);
        $year = $this->baseTimesheetsRepository->getYear($data['year_id']);
        $month = $this->baseTimesheetsRepository->getMonth($data['month_id']);
        // Данные о перемещениях в данном периоде
        $allocationsList = $this->baseTimesheetsRepository->getCreate($teamId, $year['number'], $month['number']);
        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(3);
        
        return view('acc.base-timesheets.create', 
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
    public function store(BaseTimesheetsCreateRequest $request) {
        
        $data = $request->input();
        
        $auth = Auth::user();
        $teamLeader = $this->baseTimesheetsRepository->getTeamLeader($auth['id']);
        $team = $this->baseTimesheetsRepository->getTeam($teamLeader['id']);
        if($team) {
            $teamId = $team['id'];
        } else {
            $teamId = 0;
        }
        // Данные о перемещениях в данном периоде
        $allocationList = $this->baseTimesheetsRepository->getCreate($teamId, $data['year'], $data['month']);
        foreach ($allocationList as $key => $value) {
            $newData['user_id'] = Auth::user()->id;
            $newData['team_id'] = $value['team_id'];
            $newData['year_id'] = $data['year_id'];
            $newData['month_id'] = $data['month_id'];
            $newData['personal_card_id'] = $data['personal_card_id_'.$key];
            $newData['object_id'] = $data['object_id_'.$key];
            $newData['hours_day_1'] = $data['hours_day_1_'.$key];
            $newData['hours_day_2'] = $data['hours_day_2_'.$key];
            $newData['hours_day_3'] = $data['hours_day_3_'.$key];
            $newData['hours_day_4'] = $data['hours_day_4_'.$key];
            $newData['hours_day_5'] = $data['hours_day_5_'.$key];
            $newData['hours_day_6'] = $data['hours_day_6_'.$key];
            $newData['hours_day_7'] = $data['hours_day_7_'.$key];
            $newData['hours_day_8'] = $data['hours_day_8_'.$key];
            $newData['hours_day_9'] = $data['hours_day_9_'.$key];
            $newData['hours_day_10'] = $data['hours_day_10_'.$key];
            $newData['hours_day_11'] = $data['hours_day_11_'.$key];
            $newData['hours_day_12'] = $data['hours_day_12_'.$key];
            $newData['hours_day_13'] = $data['hours_day_13_'.$key];
            $newData['hours_day_14'] = $data['hours_day_14_'.$key];
            $newData['hours_day_15'] = $data['hours_day_15_'.$key];
            $newData['hours_day_16'] = $data['hours_day_16_'.$key];
            $newData['hours_day_17'] = $data['hours_day_17_'.$key];
            $newData['hours_day_18'] = $data['hours_day_18_'.$key];
            $newData['hours_day_19'] = $data['hours_day_19_'.$key];
            $newData['hours_day_20'] = $data['hours_day_20_'.$key];
            $newData['hours_day_21'] = $data['hours_day_21_'.$key];
            $newData['hours_day_22'] = $data['hours_day_22_'.$key];
            $newData['hours_day_23'] = $data['hours_day_23_'.$key];
            $newData['hours_day_24'] = $data['hours_day_24_'.$key];
            $newData['hours_day_25'] = $data['hours_day_25_'.$key];
            $newData['hours_day_26'] = $data['hours_day_26_'.$key];
            $newData['hours_day_27'] = $data['hours_day_27_'.$key];
            $newData['hours_day_28'] = $data['hours_day_28_'.$key];
            $newData['hours_day_29'] = $data['hours_day_29_'.$key];
            $newData['hours_day_30'] = $data['hours_day_30_'.$key];
            $newData['hours_day_31'] = $data['hours_day_31_'.$key];
            $newData['rate_day_1'] = $data['rate_day_1_'.$key];
            $newData['rate_day_2'] = $data['rate_day_2_'.$key];
            $newData['rate_day_3'] = $data['rate_day_3_'.$key];
            $newData['rate_day_4'] = $data['rate_day_4_'.$key];
            $newData['rate_day_5'] = $data['rate_day_5_'.$key];
            $newData['rate_day_6'] = $data['rate_day_6_'.$key];
            $newData['rate_day_7'] = $data['rate_day_7_'.$key];
            $newData['rate_day_8'] = $data['rate_day_8_'.$key];
            $newData['rate_day_9'] = $data['rate_day_9_'.$key];
            $newData['rate_day_10'] = $data['rate_day_10_'.$key];
            $newData['rate_day_11'] = $data['rate_day_11_'.$key];
            $newData['rate_day_12'] = $data['rate_day_12_'.$key];
            $newData['rate_day_13'] = $data['rate_day_13_'.$key];
            $newData['rate_day_14'] = $data['rate_day_14_'.$key];
            $newData['rate_day_15'] = $data['rate_day_15_'.$key];
            $newData['rate_day_16'] = $data['rate_day_16_'.$key];
            $newData['rate_day_17'] = $data['rate_day_17_'.$key];
            $newData['rate_day_18'] = $data['rate_day_18_'.$key];
            $newData['rate_day_19'] = $data['rate_day_19_'.$key];
            $newData['rate_day_20'] = $data['rate_day_20_'.$key];
            $newData['rate_day_21'] = $data['rate_day_21_'.$key];
            $newData['rate_day_22'] = $data['rate_day_22_'.$key];
            $newData['rate_day_23'] = $data['rate_day_23_'.$key];
            $newData['rate_day_24'] = $data['rate_day_24_'.$key];
            $newData['rate_day_25'] = $data['rate_day_25_'.$key];
            $newData['rate_day_26'] = $data['rate_day_26_'.$key];
            $newData['rate_day_27'] = $data['rate_day_27_'.$key];
            $newData['rate_day_28'] = $data['rate_day_28_'.$key];
            $newData['rate_day_29'] = $data['rate_day_29_'.$key];
            $newData['rate_day_30'] = $data['rate_day_30_'.$key];
            $newData['rate_day_31'] = $data['rate_day_31_'.$key];
            $newData['hours'] = $data['hours_'.$key];
            $newData['rate'] = $data['rate_'.$key];
            $newData['hourly'] = $data['hourly_'.$key];
            $newData['piecework'] = $data['piecework_'.$key];
//            $newData['return_fix'] = $data['return_fix_'.$key];
//            $newData['retention_fix'] = $data['retention_fix_'.$key];
//            $newData['penalty'] = $data['penalty_'.$key];
//            $newData['prepaid_expense'] = $data['prepaid_expense_'.$key];
//            $newData['food'] = $data['food_'.$key];
//            $newData['work_clothes'] = $data['work_clothes_'.$key];
            $newData['total'] = $data['total_'.$key];
            $result = (new BaseTimesheets($newData))->create($newData);
        }
        
        if($result) {
            return redirect()
                ->route('acc.base-timesheets.index')
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
        $title = "Табель выполненных работ";
        // Параметры отбора данных
        $row = explode("-", $id);
        $team = $this->baseTimesheetsRepository->getTeam($row[0]);
        $year = $this->baseTimesheetsRepository->getYear($row[1]);
        $month = $this->baseTimesheetsRepository->getMonth($row[2]);
        // Данные табеля для данной группы в данном периоде
        $baseTimesheetsList = $this->baseTimesheetsRepository->getEdit($row[0], $row[1], $row[2]);
        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(3);
//        $id = "3-4-12";
//        dd($baseTimesheetsList);
        return view('acc.base-timesheets.edit', 
               compact('menu', 'interface', 'title', 'team', 'year', 'month', 'id', 
                       'baseTimesheetsList',
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
    public function update(BaseTimesheetsUpdateRequest $request, $id) {
        
        $row = explode("-", $id);
        $data = $request->all();
//        dd($data);
        // Данные о перемещениях в данном периоде
        $countEdit = $this->baseTimesheetsRepository->getEdit($row[0], $row[1], $row[2]);
        for ($order = 0; $order < count($countEdit); $order++) {
            $newData['user_id'] = Auth::user()->id;
            $newData['team_id'] = $data['team_id'];
            $newData['year_id'] = $data['year_id'];
            $newData['month_id'] = $data['month_id'];
            $newData['personal_card_id'] = $data['personal_card_id_'.$order];
            $newData['object_id'] = $data['object_id_'.$order];
            $newData['hours_day_1'] = $data['hours_day_1_'.$order];
            $newData['hours_day_2'] = $data['hours_day_2_'.$order];
            $newData['hours_day_3'] = $data['hours_day_3_'.$order];
            $newData['hours_day_4'] = $data['hours_day_4_'.$order];
            $newData['hours_day_5'] = $data['hours_day_5_'.$order];
            $newData['hours_day_6'] = $data['hours_day_6_'.$order];
            $newData['hours_day_7'] = $data['hours_day_7_'.$order];
            $newData['hours_day_8'] = $data['hours_day_8_'.$order];
            $newData['hours_day_9'] = $data['hours_day_9_'.$order];
            $newData['hours_day_10'] = $data['hours_day_10_'.$order];
            $newData['hours_day_11'] = $data['hours_day_11_'.$order];
            $newData['hours_day_12'] = $data['hours_day_12_'.$order];
            $newData['hours_day_13'] = $data['hours_day_13_'.$order];
            $newData['hours_day_14'] = $data['hours_day_14_'.$order];
            $newData['hours_day_15'] = $data['hours_day_15_'.$order];
            $newData['hours_day_16'] = $data['hours_day_16_'.$order];
            $newData['hours_day_17'] = $data['hours_day_17_'.$order];
            $newData['hours_day_18'] = $data['hours_day_18_'.$order];
            $newData['hours_day_19'] = $data['hours_day_19_'.$order];
            $newData['hours_day_20'] = $data['hours_day_20_'.$order];
            $newData['hours_day_21'] = $data['hours_day_21_'.$order];
            $newData['hours_day_22'] = $data['hours_day_22_'.$order];
            $newData['hours_day_23'] = $data['hours_day_23_'.$order];
            $newData['hours_day_24'] = $data['hours_day_24_'.$order];
            $newData['hours_day_25'] = $data['hours_day_25_'.$order];
            $newData['hours_day_26'] = $data['hours_day_26_'.$order];
            $newData['hours_day_27'] = $data['hours_day_27_'.$order];
            $newData['hours_day_28'] = $data['hours_day_28_'.$order];
            $newData['hours_day_29'] = $data['hours_day_29_'.$order];
            $newData['hours_day_30'] = $data['hours_day_30_'.$order];
            $newData['hours_day_31'] = $data['hours_day_31_'.$order];
            $newData['rate_day_1'] = $data['rate_day_1_'.$order];
            $newData['rate_day_2'] = $data['rate_day_2_'.$order];
            $newData['rate_day_3'] = $data['rate_day_3_'.$order];
            $newData['rate_day_4'] = $data['rate_day_4_'.$order];
            $newData['rate_day_5'] = $data['rate_day_5_'.$order];
            $newData['rate_day_6'] = $data['rate_day_6_'.$order];
            $newData['rate_day_7'] = $data['rate_day_7_'.$order];
            $newData['rate_day_8'] = $data['rate_day_8_'.$order];
            $newData['rate_day_9'] = $data['rate_day_9_'.$order];
            $newData['rate_day_10'] = $data['rate_day_10_'.$order];
            $newData['rate_day_11'] = $data['rate_day_11_'.$order];
            $newData['rate_day_12'] = $data['rate_day_12_'.$order];
            $newData['rate_day_13'] = $data['rate_day_13_'.$order];
            $newData['rate_day_14'] = $data['rate_day_14_'.$order];
            $newData['rate_day_15'] = $data['rate_day_15_'.$order];
            $newData['rate_day_16'] = $data['rate_day_16_'.$order];
            $newData['rate_day_17'] = $data['rate_day_17_'.$order];
            $newData['rate_day_18'] = $data['rate_day_18_'.$order];
            $newData['rate_day_19'] = $data['rate_day_19_'.$order];
            $newData['rate_day_20'] = $data['rate_day_20_'.$order];
            $newData['rate_day_21'] = $data['rate_day_21_'.$order];
            $newData['rate_day_22'] = $data['rate_day_22_'.$order];
            $newData['rate_day_23'] = $data['rate_day_23_'.$order];
            $newData['rate_day_24'] = $data['rate_day_24_'.$order];
            $newData['rate_day_25'] = $data['rate_day_25_'.$order];
            $newData['rate_day_26'] = $data['rate_day_26_'.$order];
            $newData['rate_day_27'] = $data['rate_day_27_'.$order];
            $newData['rate_day_28'] = $data['rate_day_28_'.$order];
            $newData['rate_day_29'] = $data['rate_day_29_'.$order];
            $newData['rate_day_30'] = $data['rate_day_30_'.$order];
            $newData['rate_day_31'] = $data['rate_day_31_'.$order];
            $newData['hours'] = $data['hours_'.$order];
            $newData['rate'] = $data['rate_'.$order];
            $newData['hourly'] = $data['hourly_'.$order];
            $newData['piecework'] = $data['piecework_'.$order];
            $newData['return_fix'] = 0;
            $newData['retention_fix'] = 0;
            $newData['penalty'] = 0;
            $newData['prepaid_expense'] = 0;
            $newData['food'] = 0;
            $newData['work_clothes'] = 0;
            $newData['total'] = $data['total_'.$order];
            $item = $this->baseTimesheetsRepository->getUpdate($data['id_'.$order]);
            $result = $item->update($newData);
        }
        
        if($result) {
            return redirect()
                ->route('acc.base-timesheets.show', $id)
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
            $result = $this->baseTimesheetsRepository->getUpdate($id)->forceDelete();
        } else {
            // Параметры отбора данных
            $row = explode("-", $id);
            dd($id, $row);
            $team = $this->baseTimesheetsRepository->getTeam($row[0]);
            $year = $this->baseTimesheetsRepository->getYear($row[1]);
            $month = $this->baseTimesheetsRepository->getMonth($row[2]);
        }
        

        if($result) {
            return redirect()
                ->route('acc.base-timesheets.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}