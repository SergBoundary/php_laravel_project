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
use App\Models\Settings\Menu;
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
    public function index() {
		
        $auth = Auth::user();
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
        $title = $menu->where('path', $this->path)
                ->first();

        $baseTimesheetsList = $this->baseTimesheetsRepository->getTable();

        return view('acc.base-timesheets.index',  
               compact('menu', 'title', 'access', 'baseTimesheetsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
        $auth = Auth::user();
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
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка заполняемых полей input
        $baseTimesheetsList = $this->baseTimesheetsRepository->getShow($id);

        return view('acc.base-timesheets.show', 
               compact('menu', 'title', 'access', 'baseTimesheetsList'));
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

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(3);

        return view('acc.base-timesheets.create', 
               compact('menu', 'title', 
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

        $result = (new BaseTimesheets($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.base-timesheets.edit', $result->id)
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

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->baseTimesheetsRepository->getListSelect(0);
        $yearsList = $this->baseTimesheetsRepository->getListSelect(1);
        $monthsList = $this->baseTimesheetsRepository->getListSelect(2);
        $objectsList = $this->baseTimesheetsRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $baseTimesheetsList = $this->baseTimesheetsRepository->getEdit($id);

        return view('acc.base-timesheets.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'objectsList', 
                      'baseTimesheetsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BaseTimesheetsUpdateRequest $request, $id) {

        $item = $this->baseTimesheetsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.base-timesheets.edit', $item->id)
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

        $result = $this->baseTimesheetsRepository->getEdit($id)->forceDelete();

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