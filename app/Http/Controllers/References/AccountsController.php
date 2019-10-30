<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Accounts;
use App\Repositories\References\AccountsRepository;
use App\Http\Requests\References\AccountsCreateRequest;
use App\Http\Requests\References\AccountsUpdateRequest;

/**
 * Class AccountsController: Контроллер списка бухгалтерских счетов
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class AccountsController extends BaseReferencesController {

    /**
     * @var AccountsRepository
     */
    private $accountsRepository;

    /**
     * @var path
     */
    private $path = 'ref/accounts';

    public function __construct() {

        parent::__construct();

        $this->accountsRepository = app(AccountsRepository::class);

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

        $accountsList = $this->accountsRepository->getTable();

        return view('ref.accounts.index',  
               compact('menu', 'title', 'accountsList'));
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
        $accountsList = $this->accountsRepository->getShow($id);

        return view('ref.accounts.show', 
               compact('menu', 'title', 'accountsList'));
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

        return view('ref.accounts.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccountsCreateRequest $request) {

        $data = $request->input();

        $result = (new Accounts($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.accounts.edit', $result->id)
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
        $accountsList = $this->accountsRepository->getEdit($id);

        return view('ref.accounts.edit', 
               compact('menu', 'title', 'accountsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccountsUpdateRequest $request, $id) {

        $item = $this->accountsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.accounts.edit', $item->id)
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

        $result = $this->accountsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.accounts.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}