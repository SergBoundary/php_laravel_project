<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccrualsTable extends Migration {

    /**
     * Run the migrations: Таблица учета начислений
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('accruals', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('year_id')->unsigned(); // Год табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->integer('accrual_type_id')->unsigned(); // Вид начисления
            $table->float('amount', 8,2); // Сумма начисления
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('accrual_type_id')->references('id')->on('accrual_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('accruals');
    }
}