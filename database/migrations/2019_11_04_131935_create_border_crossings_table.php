<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorderCrossingsTable extends Migration {

    /**
     * Run the migrations: Таблица учета пересечения границы страны пребывания работником
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('border_crossings', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('country_out_id')->unsigned(); // Код страны выезда
            $table->integer('country_in_id')->unsigned(); // Код страны въезда
            $table->date('date'); // Дата пересечения
            $table->string('comment', 50)->nullable(); // Примечание
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('country_out_id')->references('id')->on('countries');
            $table->foreign('country_in_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('border_crossings');
    }
}