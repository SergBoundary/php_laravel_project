<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Years;
use App\Repositories\References\YearsRepository;
use App\Http\Requests\References\YearsCreateRequest;
use App\Http\Requests\References\YearsUpdateRequest;

/**
 * Class YearsController: Контроллер списка годов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class YearsController extends BaseReferencesController {

    /**
     * @var YearsRepository
     */
    private $yearsRepository;

    /**
     * @var path
     */
    private $path = 'ref/years';

    public function __construct() {

        parent::__construct();

        $this->yearsRepository = app(YearsRepository::class);

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

        $yearsList = $this->yearsRepository->getTable();

        return view('ref.years.index',  
               compact('menu', 'title', 'yearsList'));
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
        $yearsList = $this->yearsRepository->getShow($id);

        return view('ref.years.show', 
               compact('menu', 'title', 'yearsList'));
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

        return view('ref.years.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(YearsCreateRequest $request) {

        $data = $request->input();

        $result = (new Years($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.years.edit', $result->id)
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
        $yearsList = $this->yearsRepository->getEdit($id);

        return view('ref.years.edit', 
               compact('menu', 'title', 'yearsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(YearsUpdateRequest $request, $id) {

        $item = $this->yearsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.years.edit', $item->id)
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

        $result = $this->yearsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.years.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}