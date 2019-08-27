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
        $paths = $this->createMenu($this->url);
        $title = $paths->where('url', $this->url)->first();
        $items = Districts::all(); 
        
        return view('references.districts.index', compact('title', 'paths', 'items'));
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
        //
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
