<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\PhraseListGroups;
use App\Repositories\References\PhraseListGroupsRepository;
use App\Http\Requests\References\PhraseListGroupsCreateRequest;
use App\Http\Requests\References\PhraseListGroupsUpdateRequest;

/**
 * Class PhraseListGroupsController: Контроллер списка групп формулировок для заполнения документов и форм 
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PhraseListGroupsController extends BaseReferencesController {

    /**
     * @var PhraseListGroupsRepository
     */
    private $phraseListGroupsRepository;

    /**
     * @var path
     */
    private $path = 'ref/phrase-list-groups';

    public function __construct() {

        parent::__construct();

        $this->phraseListGroupsRepository = app(PhraseListGroupsRepository::class);

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

        $phraseListGroupsList = $this->phraseListGroupsRepository->getTable();

        return view('ref.phrase-list-groups.index',  
               compact('menu', 'title', 'phraseListGroupsList'));
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
        $phraseListGroupsList = $this->phraseListGroupsRepository->getShow($id);

        return view('ref.phrase-list-groups.show', 
               compact('menu', 'title', 'phraseListGroupsList'));
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

        return view('ref.phrase-list-groups.create', 
               compact('menu', 'title'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PhraseListGroupsCreateRequest $request) {

        $data = $request->input();

        $result = (new PhraseListGroups($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.phrase-list-groups.edit', $result->id)
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
        $phraseListGroupsList = $this->phraseListGroupsRepository->getEdit($id);

        return view('ref.phrase-list-groups.edit', 
               compact('menu', 'title', 'phraseListGroupsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PhraseListGroupsUpdateRequest $request, $id) {

        $item = $this->phraseListGroupsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.phrase-list-groups.edit', $item->id)
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

        $result = $this->phraseListGroupsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.phrase-list-groups.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}