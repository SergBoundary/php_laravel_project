<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\CommunicationTypes;
use App\Models\HumanResources\PersonalCommunications;
use App\Repositories\HumanResources\PersonalCommunicationsRepository;
use App\Http\Requests\HumanResources\PersonalCommunicationsCreateRequest;
use App\Http\Requests\HumanResources\PersonalCommunicationsUpdateRequest;

/**
 * Class PersonalCommunicationsController: Контроллер учета способов коммуникации с работником
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalCommunicationsController extends BaseHumanResourcesController {

    /**
     * @var PersonalCommunicationsRepository
     */
    private $personalCommunicationsRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-communications';

    public function __construct() {

        parent::__construct();

        $this->personalCommunicationsRepository = app(PersonalCommunicationsRepository::class);

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

        $personalCommunicationsList = $this->personalCommunicationsRepository->getTable();

        return view('hr.personal-communications.index',  
               compact('menu', 'title', 'personalCommunicationsList'));
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
        $personalCommunicationsList = $this->personalCommunicationsRepository->getShow($id);

        return view('hr.personal-communications.show', 
               compact('menu', 'title', 'personalCommunicationsList'));
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
        $personalCardsList = $this->personalCommunicationsRepository->getListSelect(0);
        $communicationTypesList = $this->personalCommunicationsRepository->getListSelect(1);

        return view('hr.personal-communications.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'communicationTypesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalCommunicationsCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalCommunications($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-communications.edit', $result->id)
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
        $personalCardsList = $this->personalCommunicationsRepository->getListSelect(0);
        $communicationTypesList = $this->personalCommunicationsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $personalCommunicationsList = $this->personalCommunicationsRepository->getEdit($id);

        return view('hr.personal-communications.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'communicationTypesList', 
                      'personalCommunicationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalCommunicationsUpdateRequest $request, $id) {

        $item = $this->personalCommunicationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.personal-communications.edit', $item->id)
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

        $result = $this->personalCommunicationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-communications.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}