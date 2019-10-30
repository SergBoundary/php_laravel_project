<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\Documents;
use App\Models\HumanResources\ManningOrders;
use App\Models\HumanResources\Provisions;
use App\Repositories\HumanResources\ProvisionsRepository;
use App\Http\Requests\HumanResources\ProvisionsCreateRequest;
use App\Http\Requests\HumanResources\ProvisionsUpdateRequest;

/**
 * Class ProvisionsController: Контроллер учета материального обеспечения работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class ProvisionsController extends BaseHumanResourcesController {

    /**
     * @var ProvisionsRepository
     */
    private $provisionsRepository;

    /**
     * @var path
     */
    private $path = 'hr/provisions';

    public function __construct() {

        parent::__construct();

        $this->provisionsRepository = app(ProvisionsRepository::class);

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

        $provisionsList = $this->provisionsRepository->getTable();

        return view('hr.provisions.index',  
               compact('menu', 'title', 'provisionsList'));
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
        $provisionsList = $this->provisionsRepository->getShow($id);

        return view('hr.provisions.show', 
               compact('menu', 'title', 'provisionsList'));
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
        $documentsList = $this->provisionsRepository->getListSelect(0);
        $manningOrdersList = $this->provisionsRepository->getListSelect(1);

        return view('hr.provisions.create', 
               compact('menu', 'title', 
                      'documentsList', 
                      'manningOrdersList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProvisionsCreateRequest $request) {

        $data = $request->input();

        $result = (new Provisions($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.provisions.edit', $result->id)
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
        $documentsList = $this->provisionsRepository->getListSelect(0);
        $manningOrdersList = $this->provisionsRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $provisionsList = $this->provisionsRepository->getEdit($id);

        return view('hr.provisions.edit', 
               compact('menu', 'title', 
                      'documentsList', 
                      'manningOrdersList', 
                      'provisionsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProvisionsUpdateRequest $request, $id) {

        $item = $this->provisionsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.provisions.edit', $item->id)
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

        $result = $this->provisionsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.provisions.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}