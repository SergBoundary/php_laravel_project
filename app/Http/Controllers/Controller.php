<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Settings\Menus;
use App\Models\Settings\Interfaces;
use App\Models\Settings\InterfaceTitles;

class Controller extends BaseController {
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $language;
    public $interface = [];


    public function createMenu($path) {
        if(auth()->check()) {
            $data = [];
            $i = 1;
            $user = Auth::user();
            // Извлекаем данные текущего пункта меню
            $currents = Menus::where('path', $path)
                        ->first();
            $id = $currents->id;
            // Извлекаем данные, отсекая пункты меню дальше текущего пункта
            $items = Menus::where('id', '<=', $id)
                        ->where('access_'.$user->access, '>', 0)
                        ->get();
            // Переворачиваем список для чтения с конца
            $sorted = $items->sortKeysDesc();
            $sorted->values()->all();
            // Проходим по спису пунктов меню
            foreach ($sorted as $item){
                // Находим нужный номер id в списке
                if($id == $item->id){
                    $data[$i]['id'] = $item->id;
                    $data[$i]['name'] = $item->name;
                    $data[$i]['path'] = $item->path;
                    // Запоминаем id вышестоящего пункта меню
                    $id = $item->parent_id;
                    $i++;
                    // Выходим из списка, если id вышестоящего пункта меню не существует
                    if($id == 0) {
                        krsort($data);
                        $collection = collect($data);
                        return $collection;
                    }
                }
            }
        } else {
            return false;
        }
    }
    
    public function setInterface($request, $modul = "guest", $id = null) {
        
        if(empty($request['language'])) {
            if(empty($id)) { // guest
                if($request->session()->has('interface')) {
                    $interface = $this->setCreateInterface(session('interface')['language'], $modul);
                } else {
                    $interface = $this->setCreateInterface('PL', $modul);
                }
            } else { // user language
                $userItem = User::find($id);
                if(!empty($userItem['language'])) {
                    $interface = $this->setCreateInterface($userItem['language'], $modul);
                } else {
                    $interface = $this->setCreateInterface('PL', $modul);
                }
            }
        } else {
            $interface = $this->setCreateInterface($request['language'], $modul);
            if(!empty($id)) { // user language
                $userItem = User::find($id);
                $userData['language'] = $request['language'];
                $userItem->update($userData);
            }
        }
        
        return $interface;
    }
    
    public function setCreateInterface($lang = "PL", $modul = "guest") {
        
        $column = mb_convert_case($lang, MB_CASE_LOWER, "UTF-8");

        $title = InterfaceTitles::select($column)
            ->where('view', $modul)
            ->first();
        
        $this->interface['language'] = $lang;
        $this->interface['title'] = $title[$column];
        
        $result = Interfaces::select('modul', 'element', $column)
            ->toBase()
            ->get();
    
        foreach ($result as $v) {
            $value = (array)$v;
            $this->interface[$value['modul']][$value['element']] = $value[$column];
        }
        
        session(['interface' => $this->interface]);
        
        return $this->interface;
    }
    
    public function getGrammarEnding($text, $sex) {
        
        $ending = substr($text, -1);
        $titleTeam = substr($text, 0, -1);
        switch ($ending) {
            case "а":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            case "о":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            case "е":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            case "и":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            case "у":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            case "я":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            case "ю":
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
                break;
            default:
                if($sex == "М") {
                    $titleTeam .= "";
                } elseif($sex == "Ж") {
                    $titleTeam .= "";
                }
        }
    }
}
