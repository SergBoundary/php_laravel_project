<?php

namespace app\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 *
 * @author Se Bo
 * 
 * @package App\Repositories
 * 
 * Репозиторий для выдачи данных по запросу
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
     * @return mixed Description
     */
    abstract protected function getModelClass();
    
    /**
     * @return Model | Illuminate\Foundation\Application | mixed
     */
    protected function startConditions() {
        return clone $this->model;
    }
}
