<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations: Таблица учета нарядов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('department_id')->unsigned(); // Код подразделения
            $table->integer('object_id')->unsigned(); // Объект для счета
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('account_id')->unsigned(); // Счет затрат выполненой работы
            $table->integer('algorithm_id')->unsigned(); // Алгоритм расчета сдельной суммы
            $table->timestamp('date'); // Дата наряда
            $table->string('number', 50); // Номер наряда
            $table->float('amount', 8,2); // Сумма наряда
            $table->smallInteger('year'); // Год расчета
            $table->tinyInteger('month'); // Месяц расчета
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('algorithm_id')->references('id')->on('algorithms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}
