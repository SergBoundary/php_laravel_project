<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceworksUnitsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список единиц изменерия сдельных работ
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('pieceworks_units', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Наименование единицы измерения сдельных работ
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

        Schema::dropIfExists('pieceworks_units');
    }
}