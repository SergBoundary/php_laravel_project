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
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('year_id')->unsigned(); // Код табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->char('day_1', 5)->nullable(); // 1 день мес¤ца
            $table->char('day_2', 5)->nullable(); // 2 день мес¤ца
            $table->char('day_3', 5)->nullable(); // 3 день мес¤ца
            $table->char('day_4', 5)->nullable(); // 4 день мес¤ца
            $table->char('day_5', 5)->nullable(); // 5 день мес¤ца
            $table->char('day_6', 5)->nullable(); // 6 день мес¤ца
            $table->char('day_7', 5)->nullable(); // 7 день мес¤ца
            $table->char('day_8', 5)->nullable(); // 8 день мес¤ца
            $table->char('day_9', 5)->nullable(); // 9 день мес¤ца
            $table->char('day_10', 5)->nullable(); // 10 день мес¤ца
            $table->char('day_11', 5)->nullable(); // 11 день мес¤ца
            $table->char('day_12', 5)->nullable(); // 12 день мес¤ца
            $table->char('day_13', 5)->nullable(); // 13 день мес¤ца
            $table->char('day_14', 5)->nullable(); // 14 день мес¤ца
            $table->char('day_15', 5)->nullable(); // 15 день мес¤ца
            $table->char('day_16', 5)->nullable(); // 16 день мес¤ца
            $table->char('day_17', 5)->nullable(); // 17 день мес¤ца
            $table->char('day_18', 5)->nullable(); // 18 день мес¤ца
            $table->char('day_19', 5)->nullable(); // 19 день мес¤ца
            $table->char('day_20', 5)->nullable(); // 20 день мес¤ца
            $table->char('day_21', 5)->nullable(); // 21 день мес¤ца
            $table->char('day_22', 5)->nullable(); // 22 день мес¤ца
            $table->char('day_23', 5)->nullable(); // 23 день мес¤ца
            $table->char('day_24', 5)->nullable(); // 24 день мес¤ца
            $table->char('day_25', 5)->nullable(); // 25 день мес¤ца
            $table->char('day_26', 5)->nullable(); // 26 день мес¤ца
            $table->char('day_27', 5)->nullable(); // 27 день мес¤ца
            $table->char('day_28', 5)->nullable(); // 28 день мес¤ца
            $table->char('day_29', 5)->nullable(); // 29 день мес¤ца
            $table->char('day_30', 5)->nullable(); // 30 день мес¤ца
            $table->char('day_31', 5)->nullable(); // 31 день мес¤ца
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