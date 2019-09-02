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
    
    protected $url;
    
    public function index(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
//        dd($user->access);
        if(empty($user)) {
            return view('guest');
        } else {
            $this->url = $request->path();
        
            $paths = $this->createMenu($this->url);
            $title = $paths->where('url', $this->url)
                    ->first();
            $parent = $paths->last();
            $items = Menu::where('parent_id', $parent['id'])
                    ->where('access_'.$user->access, '>', 0)
                    ->orderBy('sort')
                    ->get();
            
            return view('menu', compact('title', 'paths', 'items'));
        }
        
    }
}
