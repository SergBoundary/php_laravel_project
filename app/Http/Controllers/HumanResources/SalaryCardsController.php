<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Banks;
use App\Models\HumanResources\SalaryCards;
use App\Repositories\HumanResources\SalaryCardsRepository;
use App\Http\Requests\HumanResources\SalaryCardsCreateRequest;
use App\Http\Requests\HumanResources\SalaryCardsUpdateRequest;

/**
 * Class SalaryCardsController: Контроллер учета зарплатных карт работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class SalaryCardsController extends BaseHumanResourcesController {

    /**
     * @var SalaryCardsRepository
     */
    private $salaryCardsRepository;

    /**
     * @var path
     */
    private $path = 'hr/salary-cards';

    public function __construct() {

        parent::__construct();

        $this->salaryCardsRepository = app(SalaryCardsRepository::class);

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

        $salaryCardsList = $this->salaryCardsRepository->getTable();

        return view('hr.salary-cards.index',  
               compact('menu', 'title', 'salaryCardsList'));
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
        $salaryCardsList = $this->salaryCardsRepository->getShow($id);

        return view('hr.salary-cards.show', 
               compact('menu', 'title', 'salaryCardsList'));
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
        $personalCardsList = $this->salaryCardsRepository->getListSelect(0);
        $banksList = $this->salaryCardsRepository->getListSelect(1);

        return view('hr.salary-cards.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'banksList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryCardsCreateRequest $request) {

        $data = $request->input();

        $result = (new SalaryCards($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.salary-cards.edit', $result->id)
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
        $personalCardsList = $this->salaryCardsRepository->getListSelect(0);
        $banksList = $this->salaryCardsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $salaryCardsList = $this->salaryCardsRepository->getEdit($id);

        return view('hr.salary-cards.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'banksList', 
                      'salaryCardsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryCardsUpdateRequest $request, $id) {

        $item = $this->salaryCardsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.salary-cards.edit', $item->id)
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

        $result = $this->salaryCardsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.salary-cards.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}