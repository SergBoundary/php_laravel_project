<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список гостиниц
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->integer('city_id')->unsigned(); // Код города
            $table->string('house_type', 50)->nullable(); // Тип отеля
            $table->string('address', 100)->nullable(); // Местонахождения отеля
            $table->string('contragent', 100)->nullable(); // Владелец отеля
            $table->string('phone', 100)->nullable(); // Способ коммуникации
            $table->string('messenger', 100)->nullable(); // Способ коммуникации
            $table->integer('beds_number')->nullable(); // Количество спальных мест
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('hotels');
    }
}