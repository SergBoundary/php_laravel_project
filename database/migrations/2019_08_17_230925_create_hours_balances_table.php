<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursBalancesTable extends Migration
{
    /**
     * Run the migrations: Таблица учета распределения часов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours_balances', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('year_id')->unsigned(); // Год баланса
            $table->integer('month_id')->unsigned(); // Месяц баланса
            $table->integer('hours_balance_classifier_id')->unsigned(); // Код баланса
            $table->tinyInteger('balance_days'); // Баланс дней
            $table->float('balance_hours', 8,2); // Баланс часов
            $table->сhar('day-1', 5)->nullable(); // 1-й день месяца
            $table->сhar('day-2', 5)->nullable(); // 2-й день месяца
            $table->сhar('day-3', 5)->nullable(); // 3-й день месяца
            $table->сhar('day-4', 5)->nullable(); // 4-й день месяца
            $table->сhar('day-5', 5)->nullable(); // 5-й день месяца
            $table->сhar('day-6', 5)->nullable(); // 6-й день месяца
            $table->сhar('day-7', 5)->nullable(); // 7-й день месяца
            $table->сhar('day-8', 5)->nullable(); // 8-й день месяца
            $table->сhar('day-9', 5)->nullable(); // 9-й день месяца
            $table->сhar('day-10', 5)->nullable(); // 10-й день месяца
            $table->сhar('day-11', 5)->nullable(); // 11-й день месяца
            $table->сhar('day-12', 5)->nullable(); // 12-й день месяца
            $table->сhar('day-13', 5)->nullable(); // 13-й день месяца
            $table->сhar('day-14', 5)->nullable(); // 14-й день месяца
            $table->сhar('day-15', 5)->nullable(); // 15-й день месяца
            $table->сhar('day-16', 5)->nullable(); // 16-й день месяца
            $table->сhar('day-17', 5)->nullable(); // 17-й день месяца
            $table->сhar('day-18', 5)->nullable(); // 18-й день месяца
            $table->сhar('day-19', 5)->nullable(); // 19-й день месяца
            $table->сhar('day-20', 5)->nullable(); // 20-й день месяца
            $table->сhar('day-21', 5)->nullable(); // 21-й день месяца
            $table->сhar('day-22', 5)->nullable(); // 22-й день месяца
            $table->сhar('day-23', 5)->nullable(); // 23-й день месяца
            $table->сhar('day-24', 5)->nullable(); // 24-й день месяца
            $table->сhar('day-25', 5)->nullable(); // 25-й день месяца
            $table->сhar('day-26', 5)->nullable(); // 26-й день месяца
            $table->сhar('day-27', 5)->nullable(); // 27-й день месяца
            $table->сhar('day-28', 5)->nullable(); // 28-й день месяца
            $table->сhar('day-29', 5)->nullable(); // 29-й день месяца
            $table->сhar('day-30', 5)->nullable(); // 30-й день месяца
            $table->сhar('day-31', 5)->nullable(); // 31-й день месяца
            $table->сhar('evening-1', 5)->nullable(); // 1-й вечер месяца
            $table->сhar('evening-2', 5)->nullable(); // 2-й вечер месяца
            $table->сhar('evening-3', 5)->nullable(); // 3-й вечер месяца
            $table->сhar('evening-4', 5)->nullable(); // 4-й вечер месяца
            $table->сhar('evening-5', 5)->nullable(); // 5-й вечер месяца
            $table->сhar('evening-6', 5)->nullable(); // 6-й вечер месяца
            $table->сhar('evening-7', 5)->nullable(); // 7-й вечер месяца
            $table->сhar('evening-8', 5)->nullable(); // 8-й вечер месяца
            $table->сhar('evening-9', 5)->nullable(); // 9-й вечер месяца
            $table->сhar('evening-10', 5)->nullable(); // 10-й вечер месяца
            $table->сhar('evening-11', 5)->nullable(); // 11-й вечер месяца
            $table->сhar('evening-12', 5)->nullable(); // 12-й вечер месяца
            $table->сhar('evening-13', 5)->nullable(); // 13-й вечер месяца
            $table->сhar('evening-14', 5)->nullable(); // 14-й вечер месяца
            $table->сhar('evening-15', 5)->nullable(); // 15-й вечер месяца
            $table->сhar('evening-16', 5)->nullable(); // 16-й вечер месяца
            $table->сhar('evening-17', 5)->nullable(); // 17-й вечер месяца
            $table->сhar('evening-18', 5)->nullable(); // 18-й вечер месяца
            $table->сhar('evening-19', 5)->nullable(); // 19-й вечер месяца
            $table->сhar('evening-20', 5)->nullable(); // 20-й вечер месяца
            $table->сhar('evening-21', 5)->nullable(); // 21-й вечер месяца
            $table->сhar('evening-22', 5)->nullable(); // 22-й вечер месяца
            $table->сhar('evening-23', 5)->nullable(); // 23-й вечер месяца
            $table->сhar('evening-24', 5)->nullable(); // 24-й вечер месяца
            $table->сhar('evening-25', 5)->nullable(); // 25-й вечер месяца
            $table->сhar('evening-26', 5)->nullable(); // 26-й вечер месяца
            $table->сhar('evening-27', 5)->nullable(); // 27-й вечер месяца
            $table->сhar('evening-28', 5)->nullable(); // 28-й вечер месяца
            $table->сhar('evening-29', 5)->nullable(); // 29-й вечер месяца
            $table->сhar('evening-30', 5)->nullable(); // 30-й вечер месяца
            $table->сhar('evening-31', 5)->nullable(); // 31-й вечер месяца
            $table->сhar('night-1', 5)->nullable(); // 1-я ночь месяца
            $table->сhar('night-2', 5)->nullable(); // 2-я ночь месяца
            $table->сhar('night-3', 5)->nullable(); // 3-я ночь месяца
            $table->сhar('night-4', 5)->nullable(); // 4-я ночь месяца
            $table->сhar('night-5', 5)->nullable(); // 5-я ночь месяца
            $table->сhar('night-6', 5)->nullable(); // 6-я ночь месяца
            $table->сhar('night-7', 5)->nullable(); // 7-я ночь месяца
            $table->сhar('night-8', 5)->nullable(); // 8-я ночь месяца
            $table->сhar('night-9', 5)->nullable(); // 9-я ночь месяца
            $table->сhar('night-10', 5)->nullable(); // 10-я ночь месяца
            $table->сhar('night-11', 5)->nullable(); // 11-я ночь месяца
            $table->сhar('night-12', 5)->nullable(); // 12-я ночь месяца
            $table->сhar('night-13', 5)->nullable(); // 13-я ночь месяца
            $table->сhar('night-14', 5)->nullable(); // 14-я ночь месяца
            $table->сhar('night-15', 5)->nullable(); // 15-я ночь месяца
            $table->сhar('night-16', 5)->nullable(); // 16-я ночь месяца
            $table->сhar('night-17', 5)->nullable(); // 17-я ночь месяца
            $table->сhar('night-18', 5)->nullable(); // 18-я ночь месяца
            $table->сhar('night-19', 5)->nullable(); // 19-я ночь месяца
            $table->сhar('night-20', 5)->nullable(); // 20-я ночь месяца
            $table->сhar('night-21', 5)->nullable(); // 21-я ночь месяца
            $table->сhar('night-22', 5)->nullable(); // 22-я ночь месяца
            $table->сhar('night-23', 5)->nullable(); // 23-я ночь месяца
            $table->сhar('night-24', 5)->nullable(); // 24-я ночь месяца
            $table->сhar('night-25', 5)->nullable(); // 25-я ночь месяца
            $table->сhar('night-26', 5)->nullable(); // 26-я ночь месяца
            $table->сhar('night-27', 5)->nullable(); // 27-я ночь месяца
            $table->сhar('night-28', 5)->nullable(); // 28-я ночь месяца
            $table->сhar('night-29', 5)->nullable(); // 29-я ночь месяца
            $table->сhar('night-30', 5)->nullable(); // 30-я ночь месяца
            $table->сhar('night-31', 5)->nullable(); // 31-я ночь месяца
            $table->сhar('holiday-1', 5)->nullable(); // 1-й праздничный день месяца
            $table->сhar('holiday-2', 5)->nullable(); // 2-й праздничный день месяца
            $table->сhar('holiday-3', 5)->nullable(); // 3-й праздничный день месяца
            $table->сhar('holiday-4', 5)->nullable(); // 4-й праздничный день месяца
            $table->сhar('holiday-5', 5)->nullable(); // 5-й праздничный день месяца
            $table->сhar('holiday-6', 5)->nullable(); // 6-й праздничный день месяца
            $table->сhar('holiday-7', 5)->nullable(); // 7-й праздничный день месяца
            $table->сhar('holiday-8', 5)->nullable(); // 8-й праздничный день месяца
            $table->сhar('holiday-9', 5)->nullable(); // 9-й праздничный день месяца
            $table->сhar('holiday-10', 5)->nullable(); // 10-й праздничный день месяца
            $table->сhar('holiday-11', 5)->nullable(); // 11-й праздничный день месяца
            $table->сhar('holiday-12', 5)->nullable(); // 12-й праздничный день месяца
            $table->сhar('holiday-13', 5)->nullable(); // 13-й праздничный день месяца
            $table->сhar('holiday-14', 5)->nullable(); // 14-й праздничный день месяца
            $table->сhar('holiday-15', 5)->nullable(); // 15-й праздничный день месяца
            $table->сhar('holiday-16', 5)->nullable(); // 16-й праздничный день месяца
            $table->сhar('holiday-17', 5)->nullable(); // 17-й праздничный день месяца
            $table->сhar('holiday-18', 5)->nullable(); // 18-й праздничный день месяца
            $table->сhar('holiday-19', 5)->nullable(); // 19-й праздничный день месяца
            $table->сhar('holiday-20', 5)->nullable(); // 20-й праздничный день месяца
            $table->сhar('holiday-21', 5)->nullable(); // 21-й праздничный день месяца
            $table->сhar('holiday-22', 5)->nullable(); // 22-й праздничный день месяца
            $table->сhar('holiday-23', 5)->nullable(); // 23-й праздничный день месяца
            $table->сhar('holiday-24', 5)->nullable(); // 24-й праздничный день месяца
            $table->сhar('holiday-25', 5)->nullable(); // 25-й праздничный день месяца
            $table->сhar('holiday-26', 5)->nullable(); // 26-й праздничный день месяца
            $table->сhar('holiday-27', 5)->nullable(); // 27-й праздничный день месяца
            $table->сhar('holiday-28', 5)->nullable(); // 28-й праздничный день месяца
            $table->сhar('holiday-29', 5)->nullable(); // 29-й праздничный день месяца
            $table->сhar('holiday-30', 5)->nullable(); // 30-й праздничный день месяца
            $table->сhar('holiday-31', 5)->nullable(); // 31-й праздничный день месяца
            $table->tinyInteger('weekends'); // Баланс выходных дней
            $table->tinyInteger('holidays'); // Баланс праздничных дней
            $table->float('balance_evening', 8,2); // Баланс вечерних часов
            $table->float('balance_night', 8,2); // Баланс ночных часов
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('hours_balance_classifier_id')->references('id')->on('hours_balance_classifiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hours_balances');
    }
}
