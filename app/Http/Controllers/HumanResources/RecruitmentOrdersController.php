<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\Documents;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\DismissalReasons;
use App\Models\HumanResources\RecruitmentOrders;
use App\Repositories\HumanResources\RecruitmentOrdersRepository;
use App\Http\Requests\HumanResources\RecruitmentOrdersCreateRequest;
use App\Http\Requests\HumanResources\RecruitmentOrdersUpdateRequest;

/**
 * Class RecruitmentOrdersController: Контроллер учета найма и увольнений работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class RecruitmentOrdersController extends BaseHumanResourcesController {

    /**
     * @var RecruitmentOrdersRepository
     */
    private $recruitmentOrdersRepository;

    /**
     * @var path
     */
    private $path = 'hr/recruitment-orders';

    public function __construct() {

        parent::__construct();

        $this->recruitmentOrdersRepository = app(RecruitmentOrdersRepository::class);

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

        $recruitmentOrdersList = $this->recruitmentOrdersRepository->getTable();

        return view('hr.recruitment-orders.index',  
               compact('menu', 'title', 'recruitmentOrdersList'));
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
        $recruitmentOrdersList = $this->recruitmentOrdersRepository->getShow($id);

        return view('hr.recruitment-orders.show', 
               compact('menu', 'title', 'recruitmentOrdersList'));
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
        $documentsList = $this->recruitmentOrdersRepository->getListSelect(0);
        $personalCardsList = $this->recruitmentOrdersRepository->getListSelect(1);
        $dismissalReasonsList = $this->recruitmentOrdersRepository->getListSelect(2);

        return view('hr.recruitment-orders.create', 
               compact('menu', 'title', 
                      'documentsList', 
                      'personalCardsList', 
                      'dismissalReasonsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RecruitmentOrdersCreateRequest $request) {

        $data = $request->input();

        $result = (new RecruitmentOrders($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.recruitment-orders.edit', $result->id)
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
        $documentsList = $this->recruitmentOrdersRepository->getListSelect(0);
        $personalCardsList = $this->recruitmentOrdersRepository->getListSelect(1);
        $dismissalReasonsList = $this->recruitmentOrdersRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $recruitmentOrdersList = $this->recruitmentOrdersRepository->getEdit($id);

        return view('hr.recruitment-orders.edit', 
               compact('menu', 'title', 
                      'documentsList', 
                      'personalCardsList', 
                      'dismissalReasonsList', 
                      'recruitmentOrdersList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RecruitmentOrdersUpdateRequest $request, $id) {

        $item = $this->recruitmentOrdersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.recruitment-orders.edit', $item->id)
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

        $result = $this->recruitmentOrdersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.recruitment-orders.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}