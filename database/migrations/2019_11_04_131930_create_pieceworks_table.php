<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceworksTable extends Migration {

    /**
     * Run the migrations: Справочник. Список сдельных работ
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('pieceworks', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Наименование сдельной работы
            $table->integer('pieceworks_unit_id')->unsigned(); // Единица измерения выполнения сдельных работ
            $table->float('price', 8,2); // Цена единицы сдельной работы
            $table->integer('accrual_id')->unsigned(); // Счет отнесения сдельной работы на затраты
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('pieceworks_unit_id')->references('id')->on('pieceworks_units');
            $table->foreign('accrual_id')->references('id')->on('accruals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('pieceworks');
    }
}