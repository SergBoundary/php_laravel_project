<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\References\AccrualTypes;
use App\Models\Accounting\Accruals;
use App\Repositories\Accounting\AccrualsRepository;
use App\Http\Requests\Accounting\AccrualsCreateRequest;
use App\Http\Requests\Accounting\AccrualsUpdateRequest;
use App\Models\Settings\Menu;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccrualsController: Контроллер учета начислений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class AccrualsController extends BaseAccountingController {

    /**
     * @var AccrualsRepository
     */
    private $accrualsRepository;

    /**
     * @var path
     */
    private $path = 'acc/accruals';

    public function __construct() {

        parent::__construct();

        $this->accrualsRepository = app(AccrualsRepository::class);

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

        $accrualsList = $this->accrualsRepository->getTable();

        return view('acc.accruals.index',  
               compact('menu', 'title', 'access', 'accrualsList'));
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
        $accrualsList = $this->accrualsRepository->getShow($id);

        return view('acc.accruals.show', 
               compact('menu', 'title', 'access', 'accrualsList'));
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
        $personalCardsList = $this->accrualsRepository->getListSelect(0);
        $yearsList = $this->accrualsRepository->getListSelect(1);
        $monthsList = $this->accrualsRepository->getListSelect(2);
        $accrualTypesList = $this->accrualsRepository->getListSelect(3);

        return view('acc.accruals.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'accrualTypesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccrualsCreateRequest $request) {

        $data = $request->input();

        $result = (new Accruals($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.accruals.edit', $result->id)
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
        $personalCardsList = $this->accrualsRepository->getListSelect(0);
        $yearsList = $this->accrualsRepository->getListSelect(1);
        $monthsList = $this->accrualsRepository->getListSelect(2);
        $accrualTypesList = $this->accrualsRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $accrualsList = $this->accrualsRepository->getEdit($id);

        return view('acc.accruals.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'accrualTypesList', 
                      'accrualsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccrualsUpdateRequest $request, $id) {

        $item = $this->accrualsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.accruals.edit', $item->id)
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

        $result = $this->accrualsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.accruals.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}