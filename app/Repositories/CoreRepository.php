<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Репозиторий для выдачи данных по запросу (не создает и не изменяет данные)
 *
 * @author Se Bo
 * 
 * @package App\Repositories
 */
abstract class CoreRepository {
    /**
     * @var Model
     */
    protected $model;
    
    /**
     * CoreRepository constructor
     */
    public function __construct() {
        $this->model = app($this->getModelClass());
    }
    
    /**
     * @return mixed
     */
    abstract protected function getModelClass();
    
    /**
     * @return Model | Illuminate\Foundation\Application | mixed
     */
    protected function startConditions() {
        return clone $this->model;
    }
}
