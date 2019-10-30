<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\PieceworksUnits;
use App\Models\References\Accruals;
use App\Models\References\Pieceworks;
use App\Repositories\References\PieceworksRepository;
use App\Http\Requests\References\PieceworksCreateRequest;
use App\Http\Requests\References\PieceworksUpdateRequest;

/**
 * Class PieceworksController: Контроллер списка сдельных работ
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PieceworksController extends BaseReferencesController {

    /**
     * @var PieceworksRepository
     */
    private $pieceworksRepository;

    /**
     * @var path
     */
    private $path = 'ref/pieceworks';

    public function __construct() {

        parent::__construct();

        $this->pieceworksRepository = app(PieceworksRepository::class);

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

        $pieceworksList = $this->pieceworksRepository->getTable();

        return view('ref.pieceworks.index',  
               compact('menu', 'title', 'pieceworksList'));
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
        $pieceworksList = $this->pieceworksRepository->getShow($id);

        return view('ref.pieceworks.show', 
               compact('menu', 'title', 'pieceworksList'));
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
        $pieceworksUnitsList = $this->pieceworksRepository->getListSelect(0);
        $accrualsList = $this->pieceworksRepository->getListSelect(1);

        return view('ref.pieceworks.create', 
               compact('menu', 'title', 
                      'pieceworksUnitsList', 
                      'accrualsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PieceworksCreateRequest $request) {

        $data = $request->input();

        $result = (new Pieceworks($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.pieceworks.edit', $result->id)
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
        $pieceworksUnitsList = $this->pieceworksRepository->getListSelect(0);
        $accrualsList = $this->pieceworksRepository->getListSelect(1);

        // Формируем содержание списка заполняемых полей input
        $pieceworksList = $this->pieceworksRepository->getEdit($id);

        return view('ref.pieceworks.edit', 
               compact('menu', 'title', 
                      'pieceworksUnitsList', 
                      'accrualsList', 
                      'pieceworksList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PieceworksUpdateRequest $request, $id) {

        $item = $this->pieceworksRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.pieceworks.edit', $item->id)
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

        $result = $this->pieceworksRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.pieceworks.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}