<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidaysTable extends Migration {

    /**
     * Run the migrations: Справочник. Список праздничных дней
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('holidays', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->integer('year_id')->unsigned(); // Код года
            $table->integer('month_id')->unsigned(); // Код месяца
            $table->tinyInteger('holiday'); // Праздничный день
            $table->string('title', 50)->unique(); // Описание праздника
            $table->boolean('not_work')->default(0); // Не рабочий день
            $table->boolean('religion')->default(0); // Религиозный праздник
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('holidays');
    }
}