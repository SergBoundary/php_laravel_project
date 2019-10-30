<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\References\Nationalities;
use App\Models\References\Cities;
use App\Models\References\Regions;
use App\Models\References\Districts;
use App\Models\References\Countries;
use App\Models\References\MaritalStatuses;
use App\Models\References\ClothingSizes;
use App\Models\References\ShoeSizes;
use App\Models\References\Disabilities;
use App\Models\HumanResources\PersonalCards;
use App\Repositories\HumanResources\PersonalCardsRepository;
use App\Http\Requests\HumanResources\PersonalCardsCreateRequest;
use App\Http\Requests\HumanResources\PersonalCardsUpdateRequest;

/**
 * Class PersonalCardsController: Контроллер учета неизменяемых персональных данных
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalCardsController extends BaseHumanResourcesController {

    /**
     * @var PersonalCardsRepository
     */
    private $personalCardsRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-cards';

    public function __construct() {

        parent::__construct();

        $this->personalCardsRepository = app(PersonalCardsRepository::class);

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

        $personalCardsList = $this->personalCardsRepository->getTable();

        return view('hr.personal-cards.index',  
               compact('menu', 'title', 'personalCardsList'));
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
        $personalCardsList = $this->personalCardsRepository->getShow($id);

        return view('hr.personal-cards.show', 
               compact('menu', 'title', 'personalCardsList'));
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
        $nationalitiesList = $this->personalCardsRepository->getListSelect(0);
        $citiesList = $this->personalCardsRepository->getListSelect(1);
        $regionsList = $this->personalCardsRepository->getListSelect(2);
        $districtsList = $this->personalCardsRepository->getListSelect(3);
        $countriesList = $this->personalCardsRepository->getListSelect(4);
        $maritalStatusesList = $this->personalCardsRepository->getListSelect(5);
        $clothingSizesList = $this->personalCardsRepository->getListSelect(6);
        $shoeSizesList = $this->personalCardsRepository->getListSelect(7);
        $disabilitiesList = $this->personalCardsRepository->getListSelect(8);

        return view('hr.personal-cards.create', 
               compact('menu', 'title', 
                      'nationalitiesList', 
                      'citiesList', 
                      'regionsList', 
                      'districtsList', 
                      'countriesList', 
                      'maritalStatusesList', 
                      'clothingSizesList', 
                      'shoeSizesList', 
                      'disabilitiesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalCardsCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalCards($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-cards.edit', $result->id)
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
        $nationalitiesList = $this->personalCardsRepository->getListSelect(0);
        $citiesList = $this->personalCardsRepository->getListSelect(1);
        $regionsList = $this->personalCardsRepository->getListSelect(2);
        $districtsList = $this->personalCardsRepository->getListSelect(3);
        $countriesList = $this->personalCardsRepository->getListSelect(4);
        $maritalStatusesList = $this->personalCardsRepository->getListSelect(5);
        $clothingSizesList = $this->personalCardsRepository->getListSelect(6);
        $shoeSizesList = $this->personalCardsRepository->getListSelect(7);
        $disabilitiesList = $this->personalCardsRepository->getListSelect(8);

        // Формируем содержание списка заполняемых полей input
        $personalCardsList = $this->personalCardsRepository->getEdit($id);

        return view('hr.personal-cards.edit', 
               compact('menu', 'title', 
                      'nationalitiesList', 
                      'citiesList', 
                      'regionsList', 
                      'districtsList', 
                      'countriesList', 
                      'maritalStatusesList', 
                      'clothingSizesList', 
                      'shoeSizesList', 
                      'disabilitiesList', 
                      'personalCardsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalCardsUpdateRequest $request, $id) {

        $item = $this->personalCardsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
//        dd($result);
        if($result) {
            return redirect()
                ->route('hr.personal-cards.edit', $item->id)
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

        $result = $this->personalCardsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-cards.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}