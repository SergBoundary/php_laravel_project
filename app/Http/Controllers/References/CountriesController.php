<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Countries;
use App\Http\Requests\References\CountriesCreateRequest;
use App\Http\Requests\References\CountriesUpdateRequest;

/**
 * Контроллер списка стран
 */

class CountriesController extends BaseReferencesController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $url = 'ref/countries';
    
    public function index()
    {
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)
                ->first();
        $countryList = Countries::where('visible', 1)
                ->orderBy('title')
                ->get();
        
        return view('references.countries.index', compact('paths', 'title', 'countryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)
                ->first();
        $countryList = Countries::where('visible', 1)
                ->get();
        
        return view('references.countries.create', compact('paths', 'title', 'countryList'));
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
        $item = (new Countries($data))->create($data);
        
        if($item) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)
                ->first();
        $countries = Countries::find($id);
        
        return view('references.countries.edit', compact('paths', 'title', 'countries'));
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
        //
    }
}
