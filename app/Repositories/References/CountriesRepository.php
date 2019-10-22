<?php

namespace App\Repositories\References;

use App\Models\References\Countries as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class CountriesRepository
 * 
 * @author Se Bo
 * 
 * @package App\Repositories\References
 */
class CountriesRepository extends CoreRepository {
    
    /**
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }
    
    /**
     * Получить модель для представления полного списка строк данных
     * 
     * @return Model
     */
    public function getListTable() {
        
        $columns = ['id', 'title', 'national_name', 'symbol_alfa2', 'symbol_alfa3', 'number_iso'];
        $order = ['title', 'national_name'];
        
//        $columns = ['t0.title', 't0.national_name', 't0.symbol_alfa2', 't0.symbol_alfa3', 't0.number_iso', 't0.visible', 't0.id'];
//        $order = ['t0.title', 't0.national_name', 't0.symbol_alfa2', 't0.symbol_alfa3', 't0.number_iso'];
        
        $result = $this->startConditions()
                ->select($columns)
                ->where('visible', 1)
                ->orderBy('title')
                ->orderBy('national_name')
                ->toBase()
                ->get();
        
        return $result;
    }
    
    /**
     * Получить модель для представления полного списка строк данных
     * 
     * @param int|null $perPage
     * 
     * @return Model
     */
    public function getAllPaginate($perPage = null) {
        
        $columns = ['id', 'title', 'national_name', 'symbol_alfa2', 'symbol_alfa3', 'number_iso'];
        
        $result = $this->startConditions()
                ->select($columns)
                ->where('visible', 1)
                ->toBase()
                ->paginate($perPage);
        
        return $result;
    }
    
    /**
     * Получить модель для редактирования данных
     * 
     * @param int $id
     * 
     * @return Model
     */
    public function getEdit($id) {
        
        $columns = ['id', 'title', 'national_name', 'symbol_alfa2', 'symbol_alfa3', 'number_iso', 'visible'];
        
        $result = $this->startConditions()
                ->select($columns)
//                ->selectRaw($columns)
                ->toBase()
                ->find($id);
        
        return $result;
    }
    
    /**
     * Получить модель для раскрывающегося списка данных
     * 
     * @param int $id
     * 
     * @return Model
     */
    public function getListSelect() {
        
        $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country']);
        
        $result = $this->startConditions()
                ->selectRaw($columns)
                ->toBase()
                ->get();
        
        return $result;
    }
}
