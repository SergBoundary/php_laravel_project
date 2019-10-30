<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\CompanyData;
use App\Repositories\Settings\CompanyDataRepository;
use App\Http\Requests\Settings\CompanyDataCreateRequest;
use App\Http\Requests\Settings\CompanyDataUpdateRequest;

/**
 * Class CompanyDataController: Контроллер реквизитов компании
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Settings
 */
class CompanyDataController extends BaseSettingsController {

    /**
     * @var CompanyDataRepository
     */
    private $companyDataRepository;

    /**
     * @var path
     */
    private $path = 'set/company-data';

    public function __construct() {

        parent::__construct();

        $this->companyDataRepository = app(CompanyDataRepository::class);

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

        $companyDataList = $this->companyDataRepository->getTable();

        return view('set.company-data.index',  
               compact('menu', 'title', 'companyDataList'));
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
        $companyDataList = $this->companyDataRepository->getShow($id);

        return view('set.company-data.show', 
               compact('menu', 'title', 'companyDataList'));
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

        return view('set.company-data.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyDataCreateRequest $request) {

        $data = $request->input();

        $result = (new CompanyData($data))->create($data);

        if($result) {
            return redirect()
                ->route('set.company-data.edit', $result->id)
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

        // Формируем содержание списка заполняемых полей input
        $companyDataList = $this->companyDataRepository->getEdit($id);

        return view('set.company-data.edit', 
               compact('menu', 'title', 'companyDataList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyDataUpdateRequest $request, $id) {

        $item = $this->companyDataRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('set.company-data.edit', $item->id)
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

        $result = $this->companyDataRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('set.company-data.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}