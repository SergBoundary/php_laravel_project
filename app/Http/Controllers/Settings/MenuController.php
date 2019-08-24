<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\Menu;

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
        
        $paths = $this->createMenu($url);
        $parent = $paths->last();
        $items = Menu::where('parent_id', $parent['id'])->orderBy('sort')->get();
        
        return view('menu', compact('paths', 'items'));
    }
}
