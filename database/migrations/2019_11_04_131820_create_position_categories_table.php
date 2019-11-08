<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionCategoriesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список категорий должностей
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('position_categories', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 100); // Наименование категории должностей
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

        Schema::dropIfExists('position_categories');
    }
}