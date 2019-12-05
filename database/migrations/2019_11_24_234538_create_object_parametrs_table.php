<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectParametrsTable extends Migration {

    /**
     * Run the migrations: Таблица учета финансовых параметров объекта
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('object_parametrs', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->date('start')->nullable(); // Дата начала работ
            $table->date('finish')->nullable(); // Дата завершения работ
            $table->string('type', 50)->unique(); // Наименование сдельной работы
            $table->string('unit', 50); // Единица измерения выполнения сдельных работ
            $table->float('quantity', 8,2); // Количество выполных работ
            $table->float('price', 8,2); // Цена единицы сдельной работы
            $table->float('sanctions', 8,2); // Санкции
            $table->float('total', 8,2); // Общая стоимость работы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('object_id')->references('id')->on('objects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('object_parametrs');
    }
}