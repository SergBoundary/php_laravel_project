<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTimesheetsTable extends Migration {

    /**
     * Run the migrations: Таблица учета отработанного времени (табель)
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('base_timesheets', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('allocation_id')->unsigned(); // Код перемещения
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('year_id')->unsigned(); // Код табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->char('hours_day_1', 5)->nullable(); // Часы 1 дня месяца
            $table->char('hours_day_2', 5)->nullable(); // Часы 2 дня месяца
            $table->char('hours_day_3', 5)->nullable(); // Часы 3 дня месяца
            $table->char('hours_day_4', 5)->nullable(); // Часы 4 дня месяца
            $table->char('hours_day_5', 5)->nullable(); // Часы 5 дня месяца
            $table->char('hours_day_6', 5)->nullable(); // Часы 6 дня месяца
            $table->char('hours_day_7', 5)->nullable(); // Часы 7 дня месяца
            $table->char('hours_day_8', 5)->nullable(); // Часы 8 дня месяца
            $table->char('hours_day_9', 5)->nullable(); // Часы 9 дня месяца
            $table->char('hours_day_10', 5)->nullable(); // Часы 10 дня месяца
            $table->char('hours_day_11', 5)->nullable(); // Часы 11 дня месяца
            $table->char('hours_day_12', 5)->nullable(); // Часы 12 дня месяца
            $table->char('hours_day_13', 5)->nullable(); // Часы 13 дня месяца
            $table->char('hours_day_14', 5)->nullable(); // Часы 14 дня месяца
            $table->char('hours_day_15', 5)->nullable(); // Часы 15 дня месяца
            $table->char('hours_day_16', 5)->nullable(); // Часы 16 дня месяца
            $table->char('hours_day_17', 5)->nullable(); // Часы 17 дня месяца
            $table->char('hours_day_18', 5)->nullable(); // Часы 18 дня месяца
            $table->char('hours_day_19', 5)->nullable(); // Часы 19 дня месяца
            $table->char('hours_day_20', 5)->nullable(); // Часы 20 дня месяца
            $table->char('hours_day_21', 5)->nullable(); // Часы 21 дня месяца
            $table->char('hours_day_22', 5)->nullable(); // Часы 22 дня месяца
            $table->char('hours_day_23', 5)->nullable(); // Часы 23 дня месяца
            $table->char('hours_day_24', 5)->nullable(); // Часы 24 дня месяца
            $table->char('hours_day_25', 5)->nullable(); // Часы 25 дня месяца
            $table->char('hours_day_26', 5)->nullable(); // Часы 26 дня месяца
            $table->char('hours_day_27', 5)->nullable(); // Часы 27 дня месяца
            $table->char('hours_day_28', 5)->nullable(); // Часы 28 дня месяца
            $table->char('hours_day_29', 5)->nullable(); // Часы 29 дня месяца
            $table->char('hours_day_30', 5)->nullable(); // Часы 30 дня месяца
            $table->char('hours_day_31', 5)->nullable(); // Часы 31 дня месяца
            $table->char('rate_day_1', 5)->nullable(); // Ставка 1 дня месяца
            $table->char('rate_day_2', 5)->nullable(); // Ставка 2 дня месяца
            $table->char('rate_day_3', 5)->nullable(); // Ставка 3 дня месяца
            $table->char('rate_day_4', 5)->nullable(); // Ставка 4 дня месяца
            $table->char('rate_day_5', 5)->nullable(); // Ставка 5 дня месяца
            $table->char('rate_day_6', 5)->nullable(); // Ставка 6 дня месяца
            $table->char('rate_day_7', 5)->nullable(); // Ставка 7 дня месяца
            $table->char('rate_day_8', 5)->nullable(); // Ставка 8 дня месяца
            $table->char('rate_day_9', 5)->nullable(); // Ставка 9 дня месяца
            $table->char('rate_day_10', 5)->nullable(); // Ставка 10 дня месяца
            $table->char('rate_day_11', 5)->nullable(); // Ставка 11 дня месяца
            $table->char('rate_day_12', 5)->nullable(); // Ставка 12 дня месяца
            $table->char('rate_day_13', 5)->nullable(); // Ставка 13 дня месяца
            $table->char('rate_day_14', 5)->nullable(); // Ставка 14 дня месяца
            $table->char('rate_day_15', 5)->nullable(); // Ставка 15 дня месяца
            $table->char('rate_day_16', 5)->nullable(); // Ставка 16 дня месяца
            $table->char('rate_day_17', 5)->nullable(); // Ставка 17 дня месяца
            $table->char('rate_day_18', 5)->nullable(); // Ставка 18 дня месяца
            $table->char('rate_day_19', 5)->nullable(); // Ставка 19 дня месяца
            $table->char('rate_day_20', 5)->nullable(); // Ставка 20 дня месяца
            $table->char('rate_day_21', 5)->nullable(); // Ставка 21 дня месяца
            $table->char('rate_day_22', 5)->nullable(); // Ставка 22 дня месяца
            $table->char('rate_day_23', 5)->nullable(); // Ставка 23 дня месяца
            $table->char('rate_day_24', 5)->nullable(); // Ставка 24 дня месяца
            $table->char('rate_day_25', 5)->nullable(); // Ставка 25 дня месяца
            $table->char('rate_day_26', 5)->nullable(); // Ставка 26 дня месяца
            $table->char('rate_day_27', 5)->nullable(); // Ставка 27 дня месяца
            $table->char('rate_day_28', 5)->nullable(); // Ставка 28 дня месяца
            $table->char('rate_day_29', 5)->nullable(); // Ставка 29 дня месяца
            $table->char('rate_day_30', 5)->nullable(); // Ставка 30 дня месяца
            $table->char('rate_day_31', 5)->nullable(); // Ставка 31 дня месяца
			$table->float('hours', 8,2)->default(0); // ќтработано часов
            $table->float('rate', 8,2)->default(0); // Ставка за час
            $table->float('hourly', 8,2)->default(0); // Сумма за почасовую работу
            $table->float('piecework', 8,2)->default(0); // Сумма за сдельную работу
            $table->float('return_fix', 8,2)->default(0); // Возврат поправки
            $table->float('retention_fix', 8,2)->default(0); // Удержано поправки
            $table->float('penalty', 8,2)->default(0); // Штраф
            $table->float('prepaid_expense', 8,2)->default(0); // Аванс
            $table->float('food', 8,2)->default(0); // Компенсаци¤ питание
            $table->float('work_clothes', 8,2)->default(0); // Спецодежда
            $table->float('total', 8,2)->default(0); // Итоговая сумма
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('allocation_id')->references('id')->on('allocations');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('object_id')->references('id')->on('objects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('base_timesheets');
    }
}