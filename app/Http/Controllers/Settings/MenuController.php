<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\Menu;
use Illuminate\Support\Facades\DB;

/**
 * Контроллер настроек пользовательского меню системы
 */

class MenuController extends BaseSettingsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url = $request->path();
        
        $parents = Menu::where('url', $url)->first();
        $paths = $this->createMenu($url);
        $items = Menu::where('parent_id', $parents->id)->orderBy('sort')->get();
        
        return view('menu', compact('paths', 'items'));
    }
}
