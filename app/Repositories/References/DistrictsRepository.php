<?php

namespace App\Repositories\References;

use App\Models\References\Countries;
use App\Models\References\Districts as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class of DistrictsRepository
 *
 * @author Se Bo
 * 
 * @package App\Repositories\References
 */
class DistrictsRepository extends CoreRepository {
    
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
        
        $result = $this->startConditions()
            ->join('countries', 'districts.country_id', '=', 'countries.id')
            ->select('countries.title AS country', 'districts.title', 'districts.national_name', 'districts.number_iso', 'districts.id')
            ->orderBy('countries.title', 'asc')
            ->orderBy('districts.title', 'asc')
            ->get();
        
        return $result;
    }
    
    /**
     * Получить модель для постраничного представления полного списка строк данных
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
     * Получить модель для представления данных одной записи
     * 
     * @param int $id
     * 
     * @return Model
     */
    public function getShow($id) {
        
        $result = $this->startConditions()
            ->join('countries', 'districts.country_id', '=', 'countries.id')
            ->select('countries.title AS country', 'districts.title', 'districts.national_name', 'districts.number_iso', 'districts.id')
            ->where('districts.id', $id)
            ->toBase()
            ->first();
        
        return $result;
    }
    
    /**
     * Получить модель для редактирования данных одной записи
     * 
     * @param int $id
     * 
     * @return Model
     */
    public function getEdit($id) {
        
        $columns = ['id', 'country_id', 'title', 'national_name', 'number_iso'];
        
        $result = $this->startConditions()
            ->select($columns)
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
    public function getListSelect($i) {
        
        switch ($i) {
            case 0:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", symbol_alfa2) AS country']);
                break;
        }
        
        $result = Countries::selectRaw($columns)
            ->where('visible', 1)
            ->toBase()
            ->get();
        
        return $result;
    }
}
