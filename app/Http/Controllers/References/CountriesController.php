<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Repositories\References\CountriesRepository;
use App\Http\Requests\References\CountriesCreateRequest;
use App\Http\Requests\References\CountriesUpdateRequest;

/**
 * Контроллер списка стран
 * 
 * @package App\Http\Controllers\References
 */

class CountriesController extends BaseReferencesController
{
    
    /**
     * @var CountriesRepository 
     */
    private $countriesRepository;
    
    protected $path = 'ref/countries';

    public function __construct() {
        
        parent::__construct();
        
        $this->countriesRepository = app(CountriesRepository::class);
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
                ->toBase()
                ->first();
        $countryList = $this->countriesRepository->getListTable();
//        $countryList = $this->countriesRepository->getAllPaginate(5);
//        $countryList = Countries::where('visible', 1)
//                ->orderBy('title')
//                ->toBase()
//                ->get();
        
        return view('references.countries.index', 
                compact('menu', 'title', 'countryList'));
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
                ->toBase()
                ->first();
        
        return view('references.countries.create', 
                compact('menu', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountriesCreateRequest $request)
    {
        $data = $request->input();
        
        $result = (new Countries($data))->create($data);
        
        if($result) {
            return redirect()
                ->route('ref.countries.edit', $result->id)
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
        $countriesList = Countries::find($id);

        return view('references.countries.show', 
               compact('menu', 'title', 'countriesList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CountriesRepository $countries)
    {
        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        $title = $menu->where('path', $this->path)
                ->toBase()
                ->first();
        $item = $countries->getEdit($id);
        if(empty($item)) {
            abort(404);
        }
//        dd($item);
        return view('references.countries.edit', 
                compact('menu', 'title', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesUpdateRequest $request, $id)
    {
        $item = Countries::find($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if($result) {
            return redirect()
                ->route('ref.countries.edit', $item->id)
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
        //$result = Countries::destroy($id);
        
        $result = Countries::find($id)->forceDelete();
        
        if($result) {
            return redirect()
                ->route('ref.countries.index')
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения.."])
                ->withInput();
        }
    }
}
