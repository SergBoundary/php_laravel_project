<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstantsTable extends Migration
{
    /**
     * Run the migrations: Таблица констант системы
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constants', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50); // Название константы
            $table->string('description', 256); // Описание константы
            $table->integer('value_number'); // Числовое значение параметра
            $table->string('value_string', 255); // Текстовое значение параметра
            $table->timestamp('start'); // Дата и время включения константы
            $table->timestamp('expiry'); // Дата и время выключения константы
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
        Schema::dropIfExists('constants');
    }
}
