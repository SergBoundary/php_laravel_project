<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\Users;
use App\Repositories\Settings\UsersRepository;
use App\Http\Requests\Settings\UsersCreateRequest;
use App\Http\Requests\Settings\UsersUpdateRequest;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersController: Контроллер учета пользователей системы
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\Settings
 */
class UsersController extends BaseSettingsController {

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var path
     */
    private $path = 'set/users';

    public function __construct() {

        parent::__construct();

        $this->usersRepository = app(UsersRepository::class);

    }

    /**
     * Метод создания краткого табличного представления
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		
	$auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Список пользователей";

        $usersList = $this->usersRepository->getTable();

        return view('set.users.index',  
               compact('menu', 'title', 'access', 'usersList'));
    }

    /**
     * Метод создания полного представления существющей записи
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
		
	$auth = Auth::user();
        if(empty($auth)) {
            return view('guest');
        }
        $auth_access = Menus::select('access_'.$auth['access'])
                    ->where('path', $this->path)
                    ->first();
        $access = $auth_access['access_'.$auth['access']];

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив данных о представлении
        $title = "Данные пользователя";

        // Формируем содержание списка заполняемых полей input
        $usersList = $this->usersRepository->getShow($id);

        return view('set.users.show', 
               compact('menu', 'title', 'access', 'usersList'));
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
        $title = "Новый пользователь";

        return view('set.users.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request) {

        $data = $request->input();

        $result = (new Users($data))->create($data);

        if($result) {
            return redirect()
                ->route('set.users.edit', $result->id)
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
        $title = "Данные пользователя";

        // Формируем содержание списка заполняемых полей input
        $usersList = $this->usersRepository->getEdit($id);

        return view('set.users.edit', 
               compact('menu', 'title', 'usersList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UsersUpdateRequest $request, $id) {

        $item = $this->usersRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('set.users.edit', $item->id)
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

        $result = $this->usersRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('set.users.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}