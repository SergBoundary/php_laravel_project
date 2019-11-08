<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersTable extends Migration {

    /**
     * Run the migrations: Таблица учета нарядов
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('work_orders', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('department_id')->unsigned(); // Код подразделения
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('account_id')->unsigned(); // Счет затрат выполненой работы
            $table->integer('algorithm_id')->unsigned(); // Алгоритм расчета сдельной суммы
            $table->timestamp('date'); // Дата наряда
            $table->string('number', 50)->unique(); // Номер наряда
            $table->float('amount', 8,2); // Сумма наряда
            $table->integer('year_id')->unsigned(); // Год расчета
            $table->integer('month_id')->unsigned(); // Месяц расчета
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('algorithm_id')->references('id')->on('algorithms');
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

        Schema::dropIfExists('work_orders');
    }
}