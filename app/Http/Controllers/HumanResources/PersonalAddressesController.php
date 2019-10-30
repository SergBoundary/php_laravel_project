<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Cities;
use App\Models\HumanResources\PersonalAddresses;
use App\Repositories\HumanResources\PersonalAddressesRepository;
use App\Http\Requests\HumanResources\PersonalAddressesCreateRequest;
use App\Http\Requests\HumanResources\PersonalAddressesUpdateRequest;

/**
 * Class PersonalAddressesController: Контроллер учета адресов работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalAddressesController extends BaseHumanResourcesController {

    /**
     * @var PersonalAddressesRepository
     */
    private $personalAddressesRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-addresses';

    public function __construct() {

        parent::__construct();

        $this->personalAddressesRepository = app(PersonalAddressesRepository::class);

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

        $personalAddressesList = $this->personalAddressesRepository->getTable();

        return view('hr.personal-addresses.index',  
               compact('menu', 'title', 'personalAddressesList'));
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
        $personalAddressesList = $this->personalAddressesRepository->getShow($id);

        return view('hr.personal-addresses.show', 
               compact('menu', 'title', 'personalAddressesList'));
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
        $personalCardsList = $this->personalAddressesRepository->getListSelect(0);
        $citiesList = $this->personalAddressesRepository->getListSelect(1);

        return view('hr.personal-addresses.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'citiesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalAddressesCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalAddresses($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-addresses.edit', $result->id)
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
        $personalCardsList = $this->personalAddressesRepository->getListSelect(0);
        $citiesList = $this->personalAddressesRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $personalAddressesList = $this->personalAddressesRepository->getEdit($id);

        return view('hr.personal-addresses.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'citiesList', 
                      'personalAddressesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalAddressesUpdateRequest $request, $id) {

        $item = $this->personalAddressesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.personal-addresses.edit', $item->id)
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

        $result = $this->personalAddressesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-addresses.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}