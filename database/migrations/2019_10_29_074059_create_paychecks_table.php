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

        Schema::dropIfExists('paychecks');
    }
}