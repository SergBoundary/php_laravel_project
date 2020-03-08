<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetentionTypesTable extends Migration {

    /**
     * Run the migrations: Справочник. Классификатор удержаний
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('retention_types', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->char('title', 5)->unique(); // Код удержаний (для>500)
            $table->string('description', 100)->unique(); // Наименование удержания
            $table->char('abbr', 20); // Сокращенное наименование удержания
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

        Schema::dropIfExists('retention_types');
    }
}