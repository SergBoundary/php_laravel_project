<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\Accounting\LogAccrualErrors;
use App\Repositories\Accounting\LogAccrualErrorsRepository;
use App\Http\Requests\Accounting\LogAccrualErrorsCreateRequest;
use App\Http\Requests\Accounting\LogAccrualErrorsUpdateRequest;

/**
 * Class LogAccrualErrorsController: Контроллер ошибок в расчете начислений работникам
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Accounting
 */
class LogAccrualErrorsController extends BaseAccountingController {

    /**
     * @var LogAccrualErrorsRepository
     */
    private $logAccrualErrorsRepository;

    /**
     * @var path
     */
    private $path = 'acc/log-accrual-errors';

    public function __construct() {

        parent::__construct();

        $this->logAccrualErrorsRepository = app(LogAccrualErrorsRepository::class);

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

        $logAccrualErrorsList = $this->logAccrualErrorsRepository->getTable();

        return view('acc.log-accrual-errors.index',  
               compact('menu', 'title', 'logAccrualErrorsList'));
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
        $logAccrualErrorsList = $this->logAccrualErrorsRepository->getShow($id);

        return view('acc.log-accrual-errors.show', 
               compact('menu', 'title', 'logAccrualErrorsList'));
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
        $personalCardsList = $this->logAccrualErrorsRepository->getListSelect(0);

        return view('acc.log-accrual-errors.create', 
               compact('menu', 'title', 
                      'personalCardsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LogAccrualErrorsCreateRequest $request) {

        $data = $request->input();

        $result = (new LogAccrualErrors($data))->create($data);

        if($result) {
            return redirect()
                ->route('acc.log-accrual-errors.edit', $result->id)
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
        $personalCardsList = $this->logAccrualErrorsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $logAccrualErrorsList = $this->logAccrualErrorsRepository->getEdit($id);

        return view('acc.log-accrual-errors.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'logAccrualErrorsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LogAccrualErrorsUpdateRequest $request, $id) {

        $item = $this->logAccrualErrorsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('acc.log-accrual-errors.edit', $item->id)
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

        $result = $this->logAccrualErrorsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('acc.log-accrual-errors.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}