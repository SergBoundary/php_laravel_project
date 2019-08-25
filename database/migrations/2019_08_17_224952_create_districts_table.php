<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список областей (штатов, земель, воевудств)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->string('title', 50)->unique(); // Наименование области (штата, земли, воевудства)
            $table->string('national_name', 50)->unique()->nullable(); // Национальное наименование областии (штата, земли, воевудства)
            $table->char('number_iso', 8)->nullable(); // Международный код области (штата, земли, воевудства)
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
