<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaychecksTable extends Migration {

    /**
     * Run the migrations: Таблица обслуживания расчетного листа по заработной плате
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('paychecks', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('year_id')->unsigned(); // Год табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->float('balance_start', 8,2); // Остаток на начало периода
            $table->float('hourly', 8,2); // Сумма за почасовую работу
            $table->float('piecework', 8,2); // Сумма за сдельную работу
            $table->float('accrual', 8,2); // Сумма начисления
            $table->float('retention', 8,2); // Сумма удержания
            $table->float('issued_by', 8,2); // Сумма уже выдана
            $table->float('give_out', 8,2); // Сумма к выдаче
            $table->float('debt', 8,2); // Сумма долга
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
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

        Schema::dropIfExists('paychecks');
    }
}