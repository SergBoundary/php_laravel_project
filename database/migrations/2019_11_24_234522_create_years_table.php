<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список годов
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('years', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->smallInteger('number')->unique(); // Число года
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

        Schema::dropIfExists('years');
    }
}