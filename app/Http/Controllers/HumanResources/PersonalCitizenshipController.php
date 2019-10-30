<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Countries;
use App\Models\HumanResources\PersonalCitizenship;
use App\Repositories\HumanResources\PersonalCitizenshipRepository;
use App\Http\Requests\HumanResources\PersonalCitizenshipCreateRequest;
use App\Http\Requests\HumanResources\PersonalCitizenshipUpdateRequest;

/**
 * Class PersonalCitizenshipController: Контроллер учета гражданств работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalCitizenshipController extends BaseHumanResourcesController {

    /**
     * @var PersonalCitizenshipRepository
     */
    private $personalCitizenshipRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-citizenship';

    public function __construct() {

        parent::__construct();

        $this->personalCitizenshipRepository = app(PersonalCitizenshipRepository::class);

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

        $personalCitizenshipList = $this->personalCitizenshipRepository->getTable();

        return view('hr.personal-citizenship.index',  
               compact('menu', 'title', 'personalCitizenshipList'));
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
        $personalCitizenshipList = $this->personalCitizenshipRepository->getShow($id);

        return view('hr.personal-citizenship.show', 
               compact('menu', 'title', 'personalCitizenshipList'));
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
        $personalCardsList = $this->personalCitizenshipRepository->getListSelect(0);
        $countriesList = $this->personalCitizenshipRepository->getListSelect(1);

        return view('hr.personal-citizenship.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalCitizenshipCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalCitizenship($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-citizenship.edit', $result->id)
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
        $personalCardsList = $this->personalCitizenshipRepository->getListSelect(0);
        $countriesList = $this->personalCitizenshipRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $personalCitizenshipList = $this->personalCitizenshipRepository->getEdit($id);

        return view('hr.personal-citizenship.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'countriesList', 
                      'personalCitizenshipList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalCitizenshipUpdateRequest $request, $id) {

        $item = $this->personalCitizenshipRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.personal-citizenship.edit', $item->id)
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

        $result = $this->personalCitizenshipRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-citizenship.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}