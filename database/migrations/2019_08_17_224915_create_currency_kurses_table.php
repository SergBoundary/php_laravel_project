<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyKursesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список текущих курсов валют
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_kurses', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('base currency_id')->unsigned(); // Код базовой валюты
            $table->integer('quoted currency_id')->unsigned(); // Код котируемой валюты
            $table->float('residual', 8,2); // Цена базовой валюты в значении котируемой
            $table->float('bay', 8,2); // Цена покупки валюты
            $table->float('sell', 8,2); // Цена продажи валюты
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('base currency_id')->references('id')->on('currencies');
            $table->foreign('quoted currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_kurses');
    }
}
