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
            $table->string('city', 100); // Город
            $table->string('house_type', 50); // Тип отеля
            $table->string('address', 100); // Местонахождения отеля
            $table->string('contragent', 100)->nullable(); // Владелец отеля
            $table->string('phone', 100)->nullable(); // Номера телефонов
            $table->string('messenger', 100)->nullable(); // почтовый и голосовой месенджеры
            $table->integer('beds_number')->nullable(); // Количество спальных мест
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
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