<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\PositionProfessions;
use App\Models\HumanResources\LastJobs;
use App\Repositories\HumanResources\LastJobsRepository;
use App\Http\Requests\HumanResources\LastJobsCreateRequest;
use App\Http\Requests\HumanResources\LastJobsUpdateRequest;

/**
 * Class LastJobsController: Контроллер учета предыдущих мест работы
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class LastJobsController extends BaseHumanResourcesController {

    /**
     * @var LastJobsRepository
     */
    private $lastJobsRepository;

    /**
     * @var path
     */
    private $path = 'hr/last-jobs';

    public function __construct() {

        parent::__construct();

        $this->lastJobsRepository = app(LastJobsRepository::class);

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

        $lastJobsList = $this->lastJobsRepository->getTable();

        return view('hr.last-jobs.index',  
               compact('menu', 'title', 'lastJobsList'));
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
        $lastJobsList = $this->lastJobsRepository->getShow($id);

        return view('hr.last-jobs.show', 
               compact('menu', 'title', 'lastJobsList'));
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
        $personalCardsList = $this->lastJobsRepository->getListSelect(0);
        $positionProfessionsList = $this->lastJobsRepository->getListSelect(1);

        return view('hr.last-jobs.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'positionProfessionsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LastJobsCreateRequest $request) {

        $data = $request->input();

        $result = (new LastJobs($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.last-jobs.edit', $result->id)
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
        $personalCardsList = $this->lastJobsRepository->getListSelect(0);
        $positionProfessionsList = $this->lastJobsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $lastJobsList = $this->lastJobsRepository->getEdit($id);

        return view('hr.last-jobs.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'positionProfessionsList', 
                      'lastJobsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LastJobsUpdateRequest $request, $id) {

        $item = $this->lastJobsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.last-jobs.edit', $item->id)
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

        $result = $this->lastJobsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.last-jobs.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}