<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Ranks;
use App\Repositories\References\RanksRepository;
use App\Http\Requests\References\RanksCreateRequest;
use App\Http\Requests\References\RanksUpdateRequest;

/**
 * Class RanksController: Контроллер списка уровней квалификации (разрядов, рангов)
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class RanksController extends BaseReferencesController {

    /**
     * @var RanksRepository
     */
    private $ranksRepository;

    /**
     * @var path
     */
    private $path = 'ref/ranks';

    public function __construct() {

        parent::__construct();

        $this->ranksRepository = app(RanksRepository::class);

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

        $ranksList = $this->ranksRepository->getTable();

        return view('ref.ranks.index',  
               compact('menu', 'title', 'ranksList'));
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
        $ranksList = $this->ranksRepository->getShow($id);

        return view('ref.ranks.show', 
               compact('menu', 'title', 'ranksList'));
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

        return view('ref.ranks.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RanksCreateRequest $request) {

        $data = $request->input();

        $result = (new Ranks($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.ranks.edit', $result->id)
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
        $ranksList = $this->ranksRepository->getEdit($id);

        return view('ref.ranks.edit', 
               compact('menu', 'title', 'ranksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RanksUpdateRequest $request, $id) {

        $item = $this->ranksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.ranks.edit', $item->id)
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

        $result = $this->ranksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.ranks.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}