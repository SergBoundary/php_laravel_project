<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Models\References\Districts;
use App\Repositories\References\DistrictsRepository;
use App\Http\Requests\References\DistrictsCreateRequest;
use App\Http\Requests\References\DistrictsUpdateRequest;

/**
 * Контроллер списка областей (штатов, земель, воевудств)
 * 
 * @package App\Http\Controllers\References
 */

class DistrictsController extends BaseReferencesController
{
    
    /**
     * @var CountriesRepository 
     */
    private $districtsRepository;
    
    protected $path = 'ref/districts';

    public function __construct() {
        
        parent::__construct();
        
        $this->districtsRepository = app(DistrictsRepository::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        $title = $menu->where('path', $this->path)
                ->first();
        $districtList = $this->districtsRepository->getListTable();
//        dd($districtList);
        return view('references.districts.index', 
                compact('menu', 'title', 'districtList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        $title = $menu->where('path', $this->path)
                ->first();
        $countryList = $this->districtsRepository->getListSelect();
//        $districtList = Districts::all();
        
        return view('references.districts.create', compact('menu', 'title', 'countryList'));
//        return view('references.districts.create', compact('menu', 'title', 'countryList', 'districtList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictsCreateRequest $request)
    {
        $data = $request->input();
        $item = (new Districts($data))->create($data);
        
        if($item) {
            return redirect()
                ->route('ref.districts.edit', $item->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // Формируем массив подменю выбранного пункта меню
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        // Формируем массив подменю выбранного пункта меню
        $title = $menu->where('path', $this->path)
                ->first();

        // Формируем содержание списка заполняемых полей input
        $districtList = $this->districtsRepository->getShow($id);
        
        return view('references.districts.show', compact('menu', 'title', 'districtList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        $title = $menu->where('path', $this->path)
                ->first();
//        $countryList = Countries::all();
        $countryList = $this->districtsRepository->getListSelect();
        $districtList = $this->districtsRepository->getEdit($id);
        
        return view('references.districts.edit', compact('menu', 'title', 'districtList', 'countryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictsUpdateRequest $request, $id)
    {
        $item = $this->districtsRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.districts.edit', $item->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$result = Districts::destroy($id);
        
        $result = $this->districtsRepository->getEdit($id)->forceDelete();
        
        if($result) {
            return redirect()
                ->route('ref.districts.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}
