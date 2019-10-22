<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\Menu;
use Illuminate\Support\Facades\Auth;

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
    
    protected $path;
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $this->path = $request->path();

        $menu = $this->createMenu($this->path);
        if(empty($menu)) {
            return view('guest');
        }
        $title = $menu->where('path', $this->path)
                ->first();
        $parent = $menu->last();
        $items = Menu::where('parent_id', $parent['id'])
                ->where('access_'.$user->access, '>', 0)
                ->orderBy('sort')
                ->get();

        return view('menu', compact('menu', 'title', 'items'));
        
    }
}
