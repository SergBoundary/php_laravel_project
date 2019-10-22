<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccrualTimesheetsTable extends Migration {

    /**
     * Run the migrations: Таблица расчета сумм начислений работникам
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('accrual_timesheets', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->integer('account_id')->unsigned(); // Код номера бухгалтерского счета
            $table->integer('base_timesheet_id')->unsigned(); // Код записи отработанного времени
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->integer('year_id')->unsigned(); // Год учета
            $table->integer('month_id')->unsigned(); // Месяц учета
            $table->tinyInteger('days'); // Отработанные дни
            $table->float('hours', 8,2); // Отработанные часы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('base_timesheet_id')->references('id')->on('base_timesheets');
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

        Schema::dropIfExists('accrual_timesheets');
    }
}