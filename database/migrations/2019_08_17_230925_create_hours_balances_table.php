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
            $table->char('day_1', 5)->nullable(); // 1-й день месяца
            $table->char('day_2', 5)->nullable(); // 2-й день месяца
            $table->char('day_3', 5)->nullable(); // 3-й день месяца
            $table->char('day_4', 5)->nullable(); // 4-й день месяца
            $table->char('day_5', 5)->nullable(); // 5-й день месяца
            $table->char('day_6', 5)->nullable(); // 6-й день месяца
            $table->char('day_7', 5)->nullable(); // 7-й день месяца
            $table->char('day_8', 5)->nullable(); // 8-й день месяца
            $table->char('day_9', 5)->nullable(); // 9-й день месяца
            $table->char('day_10', 5)->nullable(); // 10-й день месяца
            $table->char('day_11', 5)->nullable(); // 11-й день месяца
            $table->char('day_12', 5)->nullable(); // 12-й день месяца
            $table->char('day_13', 5)->nullable(); // 13-й день месяца
            $table->char('day_14', 5)->nullable(); // 14-й день месяца
            $table->char('day_15', 5)->nullable(); // 15-й день месяца
            $table->char('day_16', 5)->nullable(); // 16-й день месяца
            $table->char('day_17', 5)->nullable(); // 17-й день месяца
            $table->char('day_18', 5)->nullable(); // 18-й день месяца
            $table->char('day_19', 5)->nullable(); // 19-й день месяца
            $table->char('day_20', 5)->nullable(); // 20-й день месяца
            $table->char('day_21', 5)->nullable(); // 21-й день месяца
            $table->char('day_22', 5)->nullable(); // 22-й день месяца
            $table->char('day_23', 5)->nullable(); // 23-й день месяца
            $table->char('day_24', 5)->nullable(); // 24-й день месяца
            $table->char('day_25', 5)->nullable(); // 25-й день месяца
            $table->char('day_26', 5)->nullable(); // 26-й день месяца
            $table->char('day_27', 5)->nullable(); // 27-й день месяца
            $table->char('day_28', 5)->nullable(); // 28-й день месяца
            $table->char('day_29', 5)->nullable(); // 29-й день месяца
            $table->char('day_30', 5)->nullable(); // 30-й день месяца
            $table->char('day_31', 5)->nullable(); // 31-й день месяца
            $table->char('evening_1', 5)->nullable(); // 1-й вечер месяца
            $table->char('evening_2', 5)->nullable(); // 2-й вечер месяца
            $table->char('evening_3', 5)->nullable(); // 3-й вечер месяца
            $table->char('evening_4', 5)->nullable(); // 4-й вечер месяца
            $table->char('evening_5', 5)->nullable(); // 5-й вечер месяца
            $table->char('evening_6', 5)->nullable(); // 6-й вечер месяца
            $table->char('evening_7', 5)->nullable(); // 7-й вечер месяца
            $table->char('evening_8', 5)->nullable(); // 8-й вечер месяца
            $table->char('evening_9', 5)->nullable(); // 9-й вечер месяца
            $table->char('evening_10', 5)->nullable(); // 10-й вечер месяца
            $table->char('evening_11', 5)->nullable(); // 11-й вечер месяца
            $table->char('evening_12', 5)->nullable(); // 12-й вечер месяца
            $table->char('evening_13', 5)->nullable(); // 13-й вечер месяца
            $table->char('evening_14', 5)->nullable(); // 14-й вечер месяца
            $table->char('evening_15', 5)->nullable(); // 15-й вечер месяца
            $table->char('evening_16', 5)->nullable(); // 16-й вечер месяца
            $table->char('evening_17', 5)->nullable(); // 17-й вечер месяца
            $table->char('evening_18', 5)->nullable(); // 18-й вечер месяца
            $table->char('evening_19', 5)->nullable(); // 19-й вечер месяца
            $table->char('evening_20', 5)->nullable(); // 20-й вечер месяца
            $table->char('evening_21', 5)->nullable(); // 21-й вечер месяца
            $table->char('evening_22', 5)->nullable(); // 22-й вечер месяца
            $table->char('evening_23', 5)->nullable(); // 23-й вечер месяца
            $table->char('evening_24', 5)->nullable(); // 24-й вечер месяца
            $table->char('evening_25', 5)->nullable(); // 25-й вечер месяца
            $table->char('evening_26', 5)->nullable(); // 26-й вечер месяца
            $table->char('evening_27', 5)->nullable(); // 27-й вечер месяца
            $table->char('evening_28', 5)->nullable(); // 28-й вечер месяца
            $table->char('evening_29', 5)->nullable(); // 29-й вечер месяца
            $table->char('evening_30', 5)->nullable(); // 30-й вечер месяца
            $table->char('evening_31', 5)->nullable(); // 31-й вечер месяца
            $table->char('night_1', 5)->nullable(); // 1-я ночь месяца
            $table->char('night_2', 5)->nullable(); // 2-я ночь месяца
            $table->char('night_3', 5)->nullable(); // 3-я ночь месяца
            $table->char('night_4', 5)->nullable(); // 4-я ночь месяца
            $table->char('night_5', 5)->nullable(); // 5-я ночь месяца
            $table->char('night_6', 5)->nullable(); // 6-я ночь месяца
            $table->char('night_7', 5)->nullable(); // 7-я ночь месяца
            $table->char('night_8', 5)->nullable(); // 8-я ночь месяца
            $table->char('night_9', 5)->nullable(); // 9-я ночь месяца
            $table->char('night_10', 5)->nullable(); // 10-я ночь месяца
            $table->char('night_11', 5)->nullable(); // 11-я ночь месяца
            $table->char('night_12', 5)->nullable(); // 12-я ночь месяца
            $table->char('night_13', 5)->nullable(); // 13-я ночь месяца
            $table->char('night_14', 5)->nullable(); // 14-я ночь месяца
            $table->char('night_15', 5)->nullable(); // 15-я ночь месяца
            $table->char('night_16', 5)->nullable(); // 16-я ночь месяца
            $table->char('night_17', 5)->nullable(); // 17-я ночь месяца
            $table->char('night_18', 5)->nullable(); // 18-я ночь месяца
            $table->char('night_19', 5)->nullable(); // 19-я ночь месяца
            $table->char('night_20', 5)->nullable(); // 20-я ночь месяца
            $table->char('night_21', 5)->nullable(); // 21-я ночь месяца
            $table->char('night_22', 5)->nullable(); // 22-я ночь месяца
            $table->char('night_23', 5)->nullable(); // 23-я ночь месяца
            $table->char('night_24', 5)->nullable(); // 24-я ночь месяца
            $table->char('night_25', 5)->nullable(); // 25-я ночь месяца
            $table->char('night_26', 5)->nullable(); // 26-я ночь месяца
            $table->char('night_27', 5)->nullable(); // 27-я ночь месяца
            $table->char('night_28', 5)->nullable(); // 28-я ночь месяца
            $table->char('night_29', 5)->nullable(); // 29-я ночь месяца
            $table->char('night_30', 5)->nullable(); // 30-я ночь месяца
            $table->char('night_31', 5)->nullable(); // 31-я ночь месяца
            $table->char('holiday_1', 5)->nullable(); // 1-й праздничный день месяца
            $table->char('holiday_2', 5)->nullable(); // 2-й праздничный день месяца
            $table->char('holiday_3', 5)->nullable(); // 3-й праздничный день месяца
            $table->char('holiday_4', 5)->nullable(); // 4-й праздничный день месяца
            $table->char('holiday_5', 5)->nullable(); // 5-й праздничный день месяца
            $table->char('holiday_6', 5)->nullable(); // 6-й праздничный день месяца
            $table->char('holiday_7', 5)->nullable(); // 7-й праздничный день месяца
            $table->char('holiday_8', 5)->nullable(); // 8-й праздничный день месяца
            $table->char('holiday_9', 5)->nullable(); // 9-й праздничный день месяца
            $table->char('holiday_10', 5)->nullable(); // 10-й праздничный день месяца
            $table->char('holiday_11', 5)->nullable(); // 11-й праздничный день месяца
            $table->char('holiday_12', 5)->nullable(); // 12-й праздничный день месяца
            $table->char('holiday_13', 5)->nullable(); // 13-й праздничный день месяца
            $table->char('holiday_14', 5)->nullable(); // 14-й праздничный день месяца
            $table->char('holiday_15', 5)->nullable(); // 15-й праздничный день месяца
            $table->char('holiday_16', 5)->nullable(); // 16-й праздничный день месяца
            $table->char('holiday_17', 5)->nullable(); // 17-й праздничный день месяца
            $table->char('holiday_18', 5)->nullable(); // 18-й праздничный день месяца
            $table->char('holiday_19', 5)->nullable(); // 19-й праздничный день месяца
            $table->char('holiday_20', 5)->nullable(); // 20-й праздничный день месяца
            $table->char('holiday_21', 5)->nullable(); // 21-й праздничный день месяца
            $table->char('holiday_22', 5)->nullable(); // 22-й праздничный день месяца
            $table->char('holiday_23', 5)->nullable(); // 23-й праздничный день месяца
            $table->char('holiday_24', 5)->nullable(); // 24-й праздничный день месяца
            $table->char('holiday_25', 5)->nullable(); // 25-й праздничный день месяца
            $table->char('holiday_26', 5)->nullable(); // 26-й праздничный день месяца
            $table->char('holiday_27', 5)->nullable(); // 27-й праздничный день месяца
            $table->char('holiday_28', 5)->nullable(); // 28-й праздничный день месяца
            $table->char('holiday_29', 5)->nullable(); // 29-й праздничный день месяца
            $table->char('holiday_30', 5)->nullable(); // 30-й праздничный день месяца
            $table->char('holiday_31', 5)->nullable(); // 31-й праздничный день месяца
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
