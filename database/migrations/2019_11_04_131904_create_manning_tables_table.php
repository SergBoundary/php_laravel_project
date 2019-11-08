<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManningTablesTable extends Migration {

    /**
     * Run the migrations: Справочник. Штатное расписание - список численности, окладов и квалификации работников
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('manning_tables', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('department_id')->unsigned(); // Подразделение
            $table->integer('position_id')->unsigned(); // Должность
            $table->integer('rank_id')->unsigned(); // Уровень квалификации (разряд, ранг)
            $table->integer('quantity'); // Количество работников в штате
            $table->float('salary', 8,2); // Размер оклада
            $table->float('tariff', 8,2); // Размер тарифа
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('rank_id')->references('id')->on('ranks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('manning_tables');
    }
}