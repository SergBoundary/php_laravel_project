<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

    /**
     * Run the migrations: Таблица учета размещения сотрудников
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('object_id')->unsigned(); // Код объекта строительства
            $table->integer('hotel_id')->unsigned(); // Код отеля размещения
            $table->date('start'); // Дата заселения
            $table->date('expiry'); // Дата выселения
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('locations');
    }
}