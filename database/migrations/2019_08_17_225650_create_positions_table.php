<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список должностей 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('subordination_id')->unsigned(); // Код уровня управления
            $table->integer('position_profession_id')->unsigned(); // Код профессии в классификаторе
            $table->integer('position_category_id')->unsigned(); // Код категории профессии
            $table->string('title', 100); // Наименование должности
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('subordination_id')->references('id')->on('subordinations');
            $table->foreign('position_profession_id')->references('id')->on('position_professions');
            $table->foreign('position_category_id')->references('id')->on('position_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
