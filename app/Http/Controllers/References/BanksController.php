<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Banks;
use App\Repositories\References\BanksRepository;
use App\Http\Requests\References\BanksCreateRequest;
use App\Http\Requests\References\BanksUpdateRequest;

/**
 * Class BanksController: Контроллер списка банков
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class BanksController extends BaseReferencesController {

    /**
     * @var BanksRepository
     */
    private $banksRepository;

    /**
     * @var path
     */
    private $path = 'ref/banks';

    public function __construct() {

        parent::__construct();

        $this->banksRepository = app(BanksRepository::class);

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

        $banksList = $this->banksRepository->getTable();

        return view('ref.banks.index',  
               compact('menu', 'title', 'banksList'));
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
        $banksList = $this->banksRepository->getShow($id);

        return view('ref.banks.show', 
               compact('menu', 'title', 'banksList'));
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
        $countriesList = $this->banksRepository->getListSelect(0);

        return view('ref.banks.create', 
               compact('menu', 'title', 
                      'countriesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BanksCreateRequest $request) {

        $data = $request->input();

        $result = (new Banks($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.banks.edit', $result->id)
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
        $countriesList = $this->banksRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $banksList = $this->banksRepository->getEdit($id);

        return view('ref.banks.edit', 
               compact('menu', 'title', 
                      'countriesList', 
                      'banksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BanksUpdateRequest $request, $id) {

        $item = $this->banksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.banks.edit', $item->id)
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

        $result = $this->banksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.banks.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}