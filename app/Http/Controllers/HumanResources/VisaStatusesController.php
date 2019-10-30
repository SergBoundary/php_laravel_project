<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\References\Countries;
use App\Models\HumanResources\VisaStatuses;
use App\Repositories\HumanResources\VisaStatusesRepository;
use App\Http\Requests\HumanResources\VisaStatusesCreateRequest;
use App\Http\Requests\HumanResources\VisaStatusesUpdateRequest;

/**
 * Class VisaStatusesController: Контроллер учета виз работника на пребывание в стране
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class VisaStatusesController extends BaseHumanResourcesController {

    /**
     * @var VisaStatusesRepository
     */
    private $visaStatusesRepository;

    /**
     * @var path
     */
    private $path = 'hr/visa-statuses';

    public function __construct() {

        parent::__construct();

        $this->visaStatusesRepository = app(VisaStatusesRepository::class);

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

        $visaStatusesList = $this->visaStatusesRepository->getTable();

        return view('hr.visa-statuses.index',  
               compact('menu', 'title', 'visaStatusesList'));
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
        $visaStatusesList = $this->visaStatusesRepository->getShow($id);

        return view('hr.visa-statuses.show', 
               compact('menu', 'title', 'visaStatusesList'));
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
        $personalCardsList = $this->visaStatusesRepository->getListSelect(0);
        $countriesList = $this->visaStatusesRepository->getListSelect(1);
        $countriesList = $this->visaStatusesRepository->getListSelect(2);

        return view('hr.visa-statuses.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList', 
                      'countriesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VisaStatusesCreateRequest $request) {

        $data = $request->input();

        $result = (new VisaStatuses($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.visa-statuses.edit', $result->id)
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
        $personalCardsList = $this->visaStatusesRepository->getListSelect(0);
        $countriesList = $this->visaStatusesRepository->getListSelect(1);
        $countriesList = $this->visaStatusesRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $visaStatusesList = $this->visaStatusesRepository->getEdit($id);

        return view('hr.visa-statuses.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList', 
                      'countriesList', 
                      'visaStatusesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VisaStatusesUpdateRequest $request, $id) {

        $item = $this->visaStatusesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.visa-statuses.edit', $item->id)
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

        $result = $this->visaStatusesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.visa-statuses.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}