<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration {

    /**
     * Run the migrations: Справочник. Список банков
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->string('title', 50)->unique(); // Наименование банка
            $table->float('commission', 8,2)->nullable(); // Комиссия зачисления зарплаты на карту
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('banks');
    }
}