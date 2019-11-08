<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список должностей
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('position_category_id')->unsigned(); // Код категории профессии
            $table->integer('subordination_id')->unsigned(); // Код уровня управления
            $table->string('title', 100); // Наименование должности
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('position_category_id')->references('id')->on('position_categories');
            $table->foreign('subordination_id')->references('id')->on('subordinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('positions');
    }
}