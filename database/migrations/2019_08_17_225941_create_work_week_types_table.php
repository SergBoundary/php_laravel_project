<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkWeekTypesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список видов рабочих недель
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_week_types', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Наименование вида рабочей недели: 1 - полная; 2 - сокращенная; 3 - другое
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_week_types');
    }
}
