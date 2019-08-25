<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список населенных пунктов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->integer('district_id')->unsigned(); // Код области
            $table->integer('region_id')->unsigned(); // Код района
            $table->string('title', 100)->unique(); // Название населенного пункта
            $table->string('national_name', 100)->unique()->nullable(); // Национальное наименование населенного пункта
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
        Schema::dropIfExists('cities');
    }
}
