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
use App\Models\Settings\Menu;
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
        $title = "Сдельные работы";

        $pieceworksList = $this->pieceworksRepository->getTable();

        return view('acc.pieceworks.index',  
               compact('menu', 'title', 'access', 'pieceworksList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
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
        $title = "Сдельная работа";

        // Формируем содержание списка заполняемых полей input
        $pieceworksList = $this->pieceworksRepository->getShow($id);

        return view('acc.pieceworks.show', 
               compact('menu', 'title', 'access', 'pieceworksList'));
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
        $title = "Новая сдельная работа";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->pieceworksRepository->getListSelect(0);
        $yearsList = $this->pieceworksRepository->getListSelect(1);
        $monthsList = $this->pieceworksRepository->getListSelect(2);
        $objectsList = $this->pieceworksRepository->getListSelect(3);

        return view('acc.pieceworks.create', 
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
    public function store(PieceworksCreateRequest $request) {

        $data = $request->input();

        $result = (new Pieceworks($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.pieceworks.edit', $result->id)
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
        $title = "Сдельная работа";

        // Формируем содержание списка выбираемых полей полей select
        $personalCardsList = $this->pieceworksRepository->getListSelect(0);
        $yearsList = $this->pieceworksRepository->getListSelect(1);
        $monthsList = $this->pieceworksRepository->getListSelect(2);
        $objectsList = $this->pieceworksRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $pieceworksList = $this->pieceworksRepository->getEdit($id);

        return view('acc.pieceworks.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'objectsList', 
                      'pieceworksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PieceworksUpdateRequest $request, $id) {

        $item = $this->pieceworksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.pieceworks.edit', $item->id)
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