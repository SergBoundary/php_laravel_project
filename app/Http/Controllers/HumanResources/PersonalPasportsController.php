<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\PersonalPasports;
use App\Repositories\HumanResources\PersonalPasportsRepository;
use App\Http\Requests\HumanResources\PersonalPasportsCreateRequest;
use App\Http\Requests\HumanResources\PersonalPasportsUpdateRequest;

/**
 * Class PersonalPasportsController: Контроллер учета паспортов работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalPasportsController extends BaseHumanResourcesController {

    /**
     * @var PersonalPasportsRepository
     */
    private $personalPasportsRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-pasports';

    public function __construct() {

        parent::__construct();

        $this->personalPasportsRepository = app(PersonalPasportsRepository::class);

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

        $personalPasportsList = $this->personalPasportsRepository->getTable();

        return view('hr.personal-pasports.index',  
               compact('menu', 'title', 'personalPasportsList'));
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
        $personalPasportsList = $this->personalPasportsRepository->getShow($id);

        return view('hr.personal-pasports.show', 
               compact('menu', 'title', 'personalPasportsList'));
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
        $personalCardsList = $this->personalPasportsRepository->getListSelect(0);

        return view('hr.personal-pasports.create', 
               compact('menu', 'title', 
                      'personalCardsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalPasportsCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalPasports($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-pasports.edit', $result->id)
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
        $personalCardsList = $this->personalPasportsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $personalPasportsList = $this->personalPasportsRepository->getEdit($id);

        return view('hr.personal-pasports.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'personalPasportsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalPasportsUpdateRequest $request, $id) {

        $item = $this->personalPasportsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.personal-pasports.edit', $item->id)
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

        $result = $this->personalPasportsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-pasports.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}