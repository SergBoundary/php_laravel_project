<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\DismissalReasons;
use App\Repositories\References\DismissalReasonsRepository;
use App\Http\Requests\References\DismissalReasonsCreateRequest;
use App\Http\Requests\References\DismissalReasonsUpdateRequest;

/**
 * Class DismissalReasonsController: Контроллер списка оснований увольнения работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class DismissalReasonsController extends BaseReferencesController {

    /**
     * @var DismissalReasonsRepository
     */
    private $dismissalReasonsRepository;

    /**
     * @var path
     */
    private $path = 'ref/dismissal-reasons';

    public function __construct() {

        parent::__construct();

        $this->dismissalReasonsRepository = app(DismissalReasonsRepository::class);

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

        $dismissalReasonsList = $this->dismissalReasonsRepository->getTable();

        return view('ref.dismissal-reasons.index',  
               compact('menu', 'title', 'dismissalReasonsList'));
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
        $dismissalReasonsList = $this->dismissalReasonsRepository->getShow($id);

        return view('ref.dismissal-reasons.show', 
               compact('menu', 'title', 'dismissalReasonsList'));
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

        return view('ref.dismissal-reasons.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DismissalReasonsCreateRequest $request) {

        $data = $request->input();

        $result = (new DismissalReasons($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.dismissal-reasons.edit', $result->id)
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
        $dismissalReasonsList = $this->dismissalReasonsRepository->getEdit($id);

        return view('ref.dismissal-reasons.edit', 
               compact('menu', 'title', 'dismissalReasonsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DismissalReasonsUpdateRequest $request, $id) {

        $item = $this->dismissalReasonsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.dismissal-reasons.edit', $item->id)
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

        $result = $this->dismissalReasonsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.dismissal-reasons.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}