<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelConditionsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список условий найма жилья
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('hotel_conditions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('hotel_id')->unsigned(); // Код отеля
            $table->integer('free_beds')->default(0); // Количество свободных  спальных мест
            $table->float('bed_price', 8,2)->default(0); // Цена спального места
            $table->float('collateral', 8,2)->default(0); // Сумма залога
            $table->boolean('contract')->default(0); // Договор найма
            $table->string('rental_conditions', 255)->nullable(); // Условия найма
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('hotel_conditions');
    }
}