<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код пользователя - автора записи
            $table->date('date'); // Дата праздника
            $table->tinyInteger('day'); // День недели
            $table->string('title', 100); // Название праздника
            $table->boolean('public')->default('0'); // Государственный праздник
            $table->boolean('religion')->default('0'); // Религиозный праздник
            $table->boolean('free')->default('0'); // Выходной день
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
        Schema::dropIfExists('holidays');
    }
}
