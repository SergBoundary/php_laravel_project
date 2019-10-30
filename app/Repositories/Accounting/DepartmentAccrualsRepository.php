<?php

namespace App\Repositories\Accounting;

use App\Models\References\Accruals;
use App\Models\References\Departments;
use App\Models\References\Teams;
use App\Models\References\Objects;
use App\Models\References\Years;
use App\Models\References\Months;
use App\Models\Accounting\DepartmentAccruals as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class DepartmentAccrualsRepository: Репозиторий учета сумм начисления по подразделению
 *
 * @author SeBo
 *
 * @package App\Repositories\Accounting
 */
class DepartmentAccrualsRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass() {

        return Model::class;
    }

    /**
     * Получить список данных
     *
     * @param arr $id
     *
     * @return Collection
     */
    public function getTable() {

        $result = $this->startConditions()
            ->join('accruals', 'department_accruals.accrual_id', '=', 'accruals.id')
            ->join('departments', 'department_accruals.department_id', '=', 'departments.id')
            ->join('teams', 'department_accruals.team_id', '=', 'teams.id')
            ->join('objects', 'department_accruals.object_id', '=', 'objects.id')
            ->join('years', 'department_accruals.year_id', '=', 'years.id')
            ->join('months', 'department_accruals.month_id', '=', 'months.id')
            ->select('accruals.title AS accrual', 'departments.abbr AS department', 'teams.abbr AS team', 'objects.abbr AS object', 'years.number AS year', 'months.number AS month', 'department_accruals.accrual_amount', 'department_accruals.id')
            ->orderBy('accruals.title')
            ->orderBy('departments.abbr')
            ->orderBy('teams.abbr')
            ->orderBy('objects.abbr')
            ->orderBy('years.number')
            ->orderBy('months.number')
            ->orderBy('department_accruals.accrual_amount')
            ->get();
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
            ->join('accruals', 'department_accruals.accrual_id', '=', 'accruals.id')
            ->join('departments', 'department_accruals.department_id', '=', 'departments.id')
            ->join('teams', 'department_accruals.team_id', '=', 'teams.id')
            ->join('objects', 'department_accruals.object_id', '=', 'objects.id')
            ->join('years', 'department_accruals.year_id', '=', 'years.id')
            ->join('months', 'department_accruals.month_id', '=', 'months.id')
            ->select('accruals.title AS accrual', 'departments.abbr AS department', 'teams.abbr AS team', 'objects.abbr AS object', 'years.number AS year', 'months.number AS month', 'department_accruals.accrual_amount', 'department_accruals.accrual_date', 'department_accruals.loaded', 'department_accruals.id')
            ->where('department_accruals.id', $id)
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

        $columns = ['id', 'accrual_id', 'department_id', 'team_id', 'object_id', 'accrual_amount', 'accrual_date', 'year_id', 'month_id', 'loaded', ];

        $result = $this->startConditions()
            ->select($columns)
            ->find($id);

        return $result;
    }

    /**
     * Получить модель для раскрывающегося списка данных
     *
     * @param int $i
     *
     * @return Model
     */
    public function getListSelect($i) {

        switch ($i) {
            case 0:
                $columns = implode(", ", ['id', 'CONCAT(title, ", ", description_abbr) AS accrual']);
                $result = Accruals::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 1:
                $columns = implode(", ", ['id', 'abbr AS department']);
                $result = Departments::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 2:
                $columns = implode(", ", ['id', 'abbr AS team']);
                $result = Teams::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 3:
                $columns = implode(", ", ['id', 'abbr AS object']);
                $result = Objects::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 4:
                $columns = implode(", ", ['id', 'number AS year']);
                $result = Years::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
            case 5:
                $columns = implode(", ", ['id', 'number AS month']);
                $result = Months::selectRaw($columns)
                    ->toBase()
                    ->get();

                break;
        }

        return $result;
    }

}