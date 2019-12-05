<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetentionsTable extends Migration {

    /**
     * Run the migrations: Таблица учета удержаний
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('retentions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('year_id')->unsigned(); // Год табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->integer('retention_type_id')->unsigned(); // Вид удержания
            $table->float('amount', 8,2); // Сумма удержания
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('retention_type_id')->references('id')->on('retention_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('retentions');
    }
}