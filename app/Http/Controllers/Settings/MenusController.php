<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\Menus;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Контроллер настроек пользовательского меню системы
 */

class MenusController extends BaseSettingsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $path;
    
    public function index(Request $request) {
        
        $auth = Auth::user();
        
        if(empty($auth)) {
            $interface = $this->setInterface($request, 'guest');
            return view('guest', compact('interface'));
        } else {
            $interface = $this->setInterface($request, 'guest-menu', $auth['id']);
            $user = $auth;
        }
        
        return view('menus', compact('interface'));
        
    }
}
