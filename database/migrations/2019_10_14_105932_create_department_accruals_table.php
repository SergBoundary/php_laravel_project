<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentAccrualsTable extends Migration {

    /**
     * Run the migrations: Таблица учета сумм начисления по подразделению
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('department_accruals', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->integer('department_id')->unsigned(); // Код подразделения
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->float('accrual_amount', 8,2); // Сумма начисления по подразделению
            $table->timestamp('accrual_date'); // Дата ввода начисления
            $table->integer('year_id')->unsigned(); // Год расчета
            $table->integer('month_id')->unsigned(); // Месяц расчета
            $table->tinyInteger('loaded'); // Статус загрузки: 1 да, 0 нет
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('department_accruals');
    }
}