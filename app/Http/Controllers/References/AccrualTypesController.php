<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\AccrualTypes;
use App\Repositories\References\AccrualTypesRepository;
use App\Http\Requests\References\AccrualTypesCreateRequest;
use App\Http\Requests\References\AccrualTypesUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccrualTypesController: Контроллер списка видов начислений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AccrualTypesController extends BaseReferencesController {

    /**
     * @var AccrualTypesRepository
     */
    private $accrualTypesRepository;

    /**
     * @var path
     */
    private $path = 'ref/accrual-types';

    public function __construct() {

        parent::__construct();

        $this->accrualTypesRepository = app(AccrualTypesRepository::class);

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
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Список начислений";

        $accrualTypesList = $this->accrualTypesRepository->getTable();

        return view('ref.accrual-types.index',  
               compact('menu', 'title', 'access', 'accrualTypesList'));
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
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Карточка начисления";

        // Формируем содержание списка заполняемых полей input
        $accrualTypesList = $this->accrualTypesRepository->getShow($id);

        return view('ref.accrual-types.show', 
               compact('menu', 'title', 'access', 'accrualTypesList'));
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
        $title = "Новое начисление";

        return view('ref.accrual-types.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccrualTypesCreateRequest $request) {

        $data = $request->input();

        $result = (new AccrualTypes($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.accrual-types.edit', $result->id)
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
        $title = "Карточка начисления";

        // Формируем содержание списка заполняемых полей input
        $accrualTypesList = $this->accrualTypesRepository->getEdit($id);

        return view('ref.accrual-types.edit', 
               compact('menu', 'title',  
                      'accrualTypesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccrualTypesUpdateRequest $request, $id) {

        $item = $this->accrualTypesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.accrual-types.edit', $item->id)
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

        $result = $this->accrualTypesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.accrual-types.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}