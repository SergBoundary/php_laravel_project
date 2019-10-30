<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Models\References\Regions;
use App\Models\References\Cities;
use App\Models\References\TaxRecipients;
use App\Repositories\References\TaxRecipientsRepository;
use App\Http\Requests\References\TaxRecipientsCreateRequest;
use App\Http\Requests\References\TaxRecipientsUpdateRequest;

/**
 * Class TaxRecipientsController: Контроллер списка получателей подоходного налога
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\References
 */
class TaxRecipientsController extends BaseReferencesController {

    /**
     * @var TaxRecipientsRepository
     */
    private $taxRecipientsRepository;

    /**
     * @var path
     */
    private $path = 'ref/tax-recipients';

    public function __construct() {

        parent::__construct();

        $this->taxRecipientsRepository = app(TaxRecipientsRepository::class);

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

        $taxRecipientsList = $this->taxRecipientsRepository->getTable();

        return view('ref.tax-recipients.index',  
               compact('menu', 'title', 'taxRecipientsList'));
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
        $taxRecipientsList = $this->taxRecipientsRepository->getShow($id);

        return view('ref.tax-recipients.show', 
               compact('menu', 'title', 'taxRecipientsList'));
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
        $countriesList = $this->taxRecipientsRepository->getListSelect(0);
        $districtsList = $this->taxRecipientsRepository->getListSelect(1);
        $regionsList = $this->taxRecipientsRepository->getListSelect(2);
        $citiesList = $this->taxRecipientsRepository->getListSelect(3);

        return view('ref.tax-recipients.create', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList', 
                      'citiesList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRecipientsCreateRequest $request) {

        $data = $request->input();

        $result = (new TaxRecipients($data))->create($data);

        if($result) {
            return redirect()
                ->route('ref.tax-recipients.edit', $result->id)
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
        $countriesList = $this->taxRecipientsRepository->getListSelect(0);
        $districtsList = $this->taxRecipientsRepository->getListSelect(1);
        $regionsList = $this->taxRecipientsRepository->getListSelect(2);
        $citiesList = $this->taxRecipientsRepository->getListSelect(3);

        // Формируем содержание списка заполняемых полей input
        $taxRecipientsList = $this->taxRecipientsRepository->getEdit($id);

        return view('ref.tax-recipients.edit', 
               compact('menu', 'title', 
                      'countriesList', 
                      'districtsList', 
                      'regionsList', 
                      'citiesList', 
                      'taxRecipientsList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRecipientsUpdateRequest $request, $id) {

        $item = $this->taxRecipientsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.tax-recipients.edit', $item->id)
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

        $result = $this->taxRecipientsRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('ref.tax-recipients.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}