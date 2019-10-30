<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalitiesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список национальностей
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('nationalities', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 100)->unique(); // Название нацианальности
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

        Schema::dropIfExists('nationalities');
    }
}