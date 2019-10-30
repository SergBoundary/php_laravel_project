<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\SpecialEatings;
use App\Repositories\Accounting\SpecialEatingsRepository;
use App\Http\Requests\Accounting\SpecialEatingsCreateRequest;
use App\Http\Requests\Accounting\SpecialEatingsUpdateRequest;

/**
 * Class SpecialEatingsController: Контроллер учета специального питания
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class SpecialEatingsController extends BaseAccountingController {

    /**
     * @var SpecialEatingsRepository
     */
    private $specialEatingsRepository;

    /**
     * @var path
     */
    private $path = 'acc/special-eatings';

    public function __construct() {

        parent::__construct();

        $this->specialEatingsRepository = app(SpecialEatingsRepository::class);

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

        $specialEatingsList = $this->specialEatingsRepository->getTable();

        return view('acc.special-eatings.index',  
               compact('menu', 'title', 'specialEatingsList'));
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
        $specialEatingsList = $this->specialEatingsRepository->getShow($id);

        return view('acc.special-eatings.show', 
               compact('menu', 'title', 'specialEatingsList'));
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
        $personalCardsList = $this->specialEatingsRepository->getListSelect(0);
        $yearsList = $this->specialEatingsRepository->getListSelect(1);
        $monthsList = $this->specialEatingsRepository->getListSelect(2);

        return view('acc.special-eatings.create', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialEatingsCreateRequest $request) {

        $data = $request->input();

        $result = (new SpecialEatings($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.special-eatings.edit', $result->id)
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
        $personalCardsList = $this->specialEatingsRepository->getListSelect(0);
        $yearsList = $this->specialEatingsRepository->getListSelect(1);
        $monthsList = $this->specialEatingsRepository->getListSelect(2);

        // Формируем содержание списка заполняемых полей input
        $specialEatingsList = $this->specialEatingsRepository->getEdit($id);

        return view('acc.special-eatings.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'yearsList', 
                      'monthsList', 
                      'specialEatingsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialEatingsUpdateRequest $request, $id) {

        $item = $this->specialEatingsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.special-eatings.edit', $item->id)
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

        $result = $this->specialEatingsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.special-eatings.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}