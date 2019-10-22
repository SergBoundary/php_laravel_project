<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculationSetupTable extends Migration {

    /**
     * Run the migrations: Таблица настроек финансовых параметров расчетов
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('calculation_setup', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50); // Наименование финансового параметра
            $table->string('description', 255); // Описание параметра
            $table->string('condition', 255); // Условие применения параметра
            $table->float('value', 8,2); // Значение параметра
            $table->timestamp('start'); // Дата и время включения параметра
            $table->timestamp('expiry'); // Дата и время выключения параметра
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('calculation_setup');
    }
}