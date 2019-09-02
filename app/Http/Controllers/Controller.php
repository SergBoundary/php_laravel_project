<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Settings\Menu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function createMenu($url) {
        $data = [];
        $i = 1;
        $user = \Illuminate\Support\Facades\Auth::user();
        // Извлекаем данные текущего пункта меню
        $currents = Menu::where('url', $url)
                    ->first();
        $id = $currents->id;
        // Извлекаем данные, отсекая пункты меню дальше текущего пункта
        $items = Menu::where('id', '<=', $id)
                    ->where('access_'.$user->access, '>', 0)
                    ->get();
//        dd($user->access, $items);
        // Переворачиваем список для чтения с конца
        $sorted = $items->sortKeysDesc();
        $sorted->values()->all();
        // Проходим по спису пунктов меню
        foreach ($sorted as $item){
            // Находим нужный номер id в списке
            if($id == $item->id){
                $data[$i]['id'] = $item->id;
                $data[$i]['name'] = $item->name;
                $data[$i]['url'] = $item->url;
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
    }
}
