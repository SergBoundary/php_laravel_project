<?php

namespace App\Http\Controllers\HumanResources;

use Illuminate\Http\Request;
use App\Models\HumanResources\PersonalCards;
use App\Models\HumanResources\InsuranceCertificates;
use App\Repositories\HumanResources\InsuranceCertificatesRepository;
use App\Http\Requests\HumanResources\InsuranceCertificatesCreateRequest;
use App\Http\Requests\HumanResources\InsuranceCertificatesUpdateRequest;

/**
 * Class InsuranceCertificatesController: Контроллер учета страховых свидетельств работника
 *
 * @author SeBo
 *
 * @package App\Http\Controllers\HumanResources
 */
class InsuranceCertificatesController extends BaseHumanResourcesController {

    /**
     * @var InsuranceCertificatesRepository
     */
    private $insuranceCertificatesRepository;

    /**
     * @var path
     */
    private $path = 'hr/insurance-certificates';

    public function __construct() {

        parent::__construct();

        $this->insuranceCertificatesRepository = app(InsuranceCertificatesRepository::class);

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

        $insuranceCertificatesList = $this->insuranceCertificatesRepository->getTable();

        return view('hr.insurance-certificates.index',  
               compact('menu', 'title', 'insuranceCertificatesList'));
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
        $insuranceCertificatesList = $this->insuranceCertificatesRepository->getShow($id);

        return view('hr.insurance-certificates.show', 
               compact('menu', 'title', 'insuranceCertificatesList'));
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
        $personalCardsList = $this->insuranceCertificatesRepository->getListSelect(0);

        return view('hr.insurance-certificates.create', 
               compact('menu', 'title', 
                      'personalCardsList'));
    }

    /**
     * Метод сохранения созданной новой записи
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InsuranceCertificatesCreateRequest $request) {

        $data = $request->input();

        $result = (new InsuranceCertificates($data))->create($data);

        if($result) {
            return redirect()
                ->route('hr.insurance-certificates.edit', $result->id)
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
        $personalCardsList = $this->insuranceCertificatesRepository->getListSelect(0);

        // Формируем содержание списка заполняемых полей input
        $insuranceCertificatesList = $this->insuranceCertificatesRepository->getEdit($id);

        return view('hr.insurance-certificates.edit', 
               compact('menu', 'title', 
                      'personalCardsList', 
                      'insuranceCertificatesList'));
    }

    /**
     * Обновление данных полей измененной записи
     *
     * @return \Illuminate\Http\Response
     */
    public function update(InsuranceCertificatesUpdateRequest $request, $id) {

        $item = $this->insuranceCertificatesRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('hr.insurance-certificates.edit', $item->id)
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

        $result = $this->insuranceCertificatesRepository->getEdit($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('hr.insurance-certificates.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}