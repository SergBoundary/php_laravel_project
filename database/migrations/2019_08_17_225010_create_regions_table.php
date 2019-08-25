<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список районов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->integer('district_id')->unsigned(); // Код области
            $table->string('title', 50)->unique(); // Наименование района
            $table->string('national_name', 50)->unique()->nullable(); // Национальное наименование района
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
