<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список валют
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 30)->unique(); // Наименование валюты
            $table->char('symbol', 3)->unique(); // Символьный код валюты
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

        Schema::dropIfExists('currencies');
    }
}