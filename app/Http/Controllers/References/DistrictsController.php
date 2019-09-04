<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Districts;
use App\Models\References\Countries;
use App\Http\Requests\References\DistrictsUpdateRequest;
use App\Http\Requests\References\DistrictsCreateRequest;

/**
 * Контроллер списка областей (штатов, земель, воевудств)
 */

class DistrictsController extends BaseReferencesController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $url = 'ref/districts';
    
    public function index()
    {
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)
                ->first();
        $countryList = Countries::where('visible', 1)
                ->orderBy('title')
                ->get();
        
        return view('references.districts.index', compact('paths', 'title', 'countryList'));
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
        $districtList = Districts::all();
        
        return view('references.districts.create', compact('paths', 'title', 'countryList', 'districtList'));
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
    public function show($id)
    {
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)
                ->first();
        $countryRow = Countries::where('id', $id)
                ->first();
        $districtList = Districts::where('country_id', $id)
                ->orderBy('title')
                ->get();
        
        return view('references.districts.show', 
                compact('paths', 'title', 'countryRow', 'districtList'));
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
        $districts = Districts::find($id);
        $countryList = Countries::all();
        
        return view('references.districts.edit', compact('paths', 'title', 'districts', 'countryList'));
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
        $item = Districts::find($id);
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
        
        $result = Districts::find($id)->forceDelete();
        
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
