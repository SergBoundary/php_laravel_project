<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\PositionProfessions;
use App\Models\HumanResources\WorkExperiences;
use App\Repositories\HumanResources\WorkExperiencesRepository;
use App\Http\Requests\HumanResources\WorkExperiencesCreateRequest;
use App\Http\Requests\HumanResources\WorkExperiencesUpdateRequest;

/**
 * Class WorkExperiencesController: Контроллер учета трудового стаража работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class WorkExperiencesController extends BaseHumanResourcesController {

    /**
     * @var WorkExperiencesRepository
     */
    private $workExperiencesRepository;

    /**
     * @var path
     */
    private $path = 'hr/work-experiences';

    public function __construct() {

        parent::__construct();

        $this->workExperiencesRepository = app(WorkExperiencesRepository::class);

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

        $workExperiencesList = $this->workExperiencesRepository->getTable();

        return view('hr.work-experiences.index',  
               compact('menu', 'title', 'workExperiencesList'));
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
        $workExperiencesList = $this->workExperiencesRepository->getShow($id);

        return view('hr.work-experiences.show', 
               compact('menu', 'title', 'workExperiencesList'));
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
        $personalCardsList = $this->workExperiencesRepository->getListSelect(0);
        $positionProfessionsList = $this->workExperiencesRepository->getListSelect(1);

        return view('hr.work-experiences.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'positionProfessionsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(WorkExperiencesCreateRequest $request) {

        $data = $request->input();

        $result = (new WorkExperiences($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.work-experiences.edit', $result->id)
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
        $personalCardsList = $this->workExperiencesRepository->getListSelect(0);
        $positionProfessionsList = $this->workExperiencesRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $workExperiencesList = $this->workExperiencesRepository->getEdit($id);

        return view('hr.work-experiences.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'positionProfessionsList', 
                      'workExperiencesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(WorkExperiencesUpdateRequest $request, $id) {

        $item = $this->workExperiencesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.work-experiences.edit', $item->id)
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

        $result = $this->workExperiencesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.work-experiences.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}