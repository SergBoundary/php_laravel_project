<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\PhraseListGroups;
use App\Models\References\PhraseLists;
use App\Repositories\References\PhraseListsRepository;
use App\Http\Requests\References\PhraseListsCreateRequest;
use App\Http\Requests\References\PhraseListsUpdateRequest;

/**
 * Class PhraseListsController: Контроллер списка формулировок для заполнения документов и форм 
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class PhraseListsController extends BaseReferencesController {

    /**
     * @var PhraseListsRepository
     */
    private $phraseListsRepository;

    /**
     * @var path
     */
    private $path = 'ref/phrase-lists';

    public function __construct() {

        parent::__construct();

        $this->phraseListsRepository = app(PhraseListsRepository::class);

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

        $phraseListsList = $this->phraseListsRepository->getTable();

        return view('ref.phrase-lists.index',  
               compact('menu', 'title', 'phraseListsList'));
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
        $phraseListsList = $this->phraseListsRepository->getShow($id);

        return view('ref.phrase-lists.show', 
               compact('menu', 'title', 'phraseListsList'));
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
        $phraseListGroupsList = $this->phraseListsRepository->getListSelect(0);

        return view('ref.phrase-lists.create', 
               compact('menu', 'title', 
                      'phraseListGroupsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PhraseListsCreateRequest $request) {

        $data = $request->input();

        $result = (new PhraseLists($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.phrase-lists.edit', $result->id)
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
        $phraseListGroupsList = $this->phraseListsRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $phraseListsList = $this->phraseListsRepository->getEdit($id);

        return view('ref.phrase-lists.edit', 
               compact('menu', 'title', 
                      'phraseListGroupsList', 
                      'phraseListsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PhraseListsUpdateRequest $request, $id) {

        $item = $this->phraseListsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.phrase-lists.edit', $item->id)
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

        $result = $this->phraseListsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.phrase-lists.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}