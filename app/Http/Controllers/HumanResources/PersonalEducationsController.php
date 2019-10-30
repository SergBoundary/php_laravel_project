<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\EducationTypes;
use App\Models\References\StudyModes;
use App\Models\HumanResources\PersonalEducations;
use App\Repositories\HumanResources\PersonalEducationsRepository;
use App\Http\Requests\HumanResources\PersonalEducationsCreateRequest;
use App\Http\Requests\HumanResources\PersonalEducationsUpdateRequest;

/**
 * Class PersonalEducationsController: Контроллер учета образования и квалификации работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class PersonalEducationsController extends BaseHumanResourcesController {

    /**
     * @var PersonalEducationsRepository
     */
    private $personalEducationsRepository;

    /**
     * @var path
     */
    private $path = 'hr/personal-educations';

    public function __construct() {

        parent::__construct();

        $this->personalEducationsRepository = app(PersonalEducationsRepository::class);

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

        $personalEducationsList = $this->personalEducationsRepository->getTable();

        return view('hr.personal-educations.index',  
               compact('menu', 'title', 'personalEducationsList'));
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
        $personalEducationsList = $this->personalEducationsRepository->getShow($id);

        return view('hr.personal-educations.show', 
               compact('menu', 'title', 'personalEducationsList'));
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
        $personalCardsList = $this->personalEducationsRepository->getListSelect(0);
        $educationTypesList = $this->personalEducationsRepository->getListSelect(1);
        $studyModesList = $this->personalEducationsRepository->getListSelect(2);

        return view('hr.personal-educations.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'educationTypesList', 
                      'studyModesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalEducationsCreateRequest $request) {

        $data = $request->input();

        $result = (new PersonalEducations($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.personal-educations.edit', $result->id)
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
        $personalCardsList = $this->personalEducationsRepository->getListSelect(0);
        $educationTypesList = $this->personalEducationsRepository->getListSelect(1);
        $studyModesList = $this->personalEducationsRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $personalEducationsList = $this->personalEducationsRepository->getEdit($id);

        return view('hr.personal-educations.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'educationTypesList', 
                      'studyModesList', 
                      'personalEducationsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalEducationsUpdateRequest $request, $id) {

        $item = $this->personalEducationsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.personal-educations.edit', $item->id)
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

        $result = $this->personalEducationsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.personal-educations.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}