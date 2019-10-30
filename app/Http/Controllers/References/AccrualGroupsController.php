<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\AccrualGroups;
use App\Repositories\References\AccrualGroupsRepository;
use App\Http\Requests\References\AccrualGroupsCreateRequest;
use App\Http\Requests\References\AccrualGroupsUpdateRequest;

/**
 * Class AccrualGroupsController: Контроллер списка групп видов начислений
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AccrualGroupsController extends BaseReferencesController {

    /**
     * @var AccrualGroupsRepository
     */
    private $accrualGroupsRepository;

    /**
     * @var path
     */
    private $path = 'ref/accrual-groups';

    public function __construct() {

        parent::__construct();

        $this->accrualGroupsRepository = app(AccrualGroupsRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        $accrualGroupsList = $this->accrualGroupsRepository->getTable();

        return view('ref.accrual-groups.index',  
               compact('menu', 'title', 'accrualGroupsList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка заполняемых полей input
        $accrualGroupsList = $this->accrualGroupsRepository->getShow($id);

        return view('ref.accrual-groups.show', 
               compact('menu', 'title', 'accrualGroupsList'));
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

        return view('ref.accrual-groups.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccrualGroupsCreateRequest $request) {

        $data = $request->input();

        $result = (new AccrualGroups($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.accrual-groups.edit', $result->id)
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

        // Формируем содержание списка заполняемых полей input
        $accrualGroupsList = $this->accrualGroupsRepository->getEdit($id);

        return view('ref.accrual-groups.edit', 
               compact('menu', 'title', 'accrualGroupsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccrualGroupsUpdateRequest $request, $id) {

        $item = $this->accrualGroupsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.accrual-groups.edit', $item->id)
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

        $result = $this->accrualGroupsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.accrual-groups.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}