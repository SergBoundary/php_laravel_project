<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\TaxOffices;
use App\Models\References\TaxRecipients;
use App\Models\HumanResources\PersonalTaxes;
use App\Repositories\HumanResources\PersonalTaxesRepository;
use App\Http\Requests\HumanResources\PersonalTaxesCreateRequest;
use App\Http\Requests\HumanResources\PersonalTaxesUpdateRequest;

/**
 * Class PersonalTaxesController: Контроллер учета налоговой информации работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalTaxesController extends BaseHumanResourcesController {

    /**
     * @var PersonalTaxesRepository
     */
    private $personalTaxesRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-taxes';

    public function __construct() {

        parent::__construct();

        $this->personalTaxesRepository = app(PersonalTaxesRepository::class);

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

        $personalTaxesList = $this->personalTaxesRepository->getTable();

        return view('hr.personal-taxes.index',  
               compact('menu', 'title', 'personalTaxesList'));
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
        $personalTaxesList = $this->personalTaxesRepository->getShow($id);

        return view('hr.personal-taxes.show', 
               compact('menu', 'title', 'personalTaxesList'));
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
        $personalCardsList = $this->personalTaxesRepository->getListSelect(0);
        $taxOfficesList = $this->personalTaxesRepository->getListSelect(1);
        $taxRecipientsList = $this->personalTaxesRepository->getListSelect(2);

        return view('hr.personal-taxes.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'taxOfficesList', 
                      'taxRecipientsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalTaxesCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalTaxes($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-taxes.edit', $result->id)
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
        $personalCardsList = $this->personalTaxesRepository->getListSelect(0);
        $taxOfficesList = $this->personalTaxesRepository->getListSelect(1);
        $taxRecipientsList = $this->personalTaxesRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $personalTaxesList = $this->personalTaxesRepository->getEdit($id);

        return view('hr.personal-taxes.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'taxOfficesList', 
                      'taxRecipientsList', 
                      'personalTaxesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalTaxesUpdateRequest $request, $id) {

        $item = $this->personalTaxesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.personal-taxes.edit', $item->id)
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

        $result = $this->personalTaxesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-taxes.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}