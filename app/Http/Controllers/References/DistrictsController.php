<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Models\References\Districts;
use App\Models\References\Countries;

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
//        $this->show(4);
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)->first();
        $countryList = Countries::where('visible', 1)->get();
        
        return view('references.districts.index', compact('paths', 'title', 'countryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $title = $paths->where('url', $this->url)->first();
        $countryRow = Countries::where('id', $id)->first();
        $districtList = Districts::where('country_id', $id)->get();
        
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
        $title = $paths->where('url', $this->url)->first();
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
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|min:3|max:50',
            'national_name' => 'string||min:3max:50',
            'number_iso' => 'string|min:2|max:8',
            'country_id' => 'required|integer|exists:countries,id',  
        ];
        $validateData = validate($request, $rules);
        
        $districts = Districts::find($id);
        if(empty($districts)) {
            return back()
                ->withErrors(['msg' => "Запись #{$id} не найдена.."])
                ->withInput();
        }
        $data = $request->all();
        $result = $districts->fill($data)->save();
        if($result) {
            return redirect()
                ->route('ref.districts.edit', $districts->id)
                ->with(['success' => "Успешносохранено"]);
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
