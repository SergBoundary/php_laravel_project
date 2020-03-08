<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список объектов
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->string('code', 10)->unique(); // Код объекта выполнения работ
            $table->string('title')->unique(); // Наименование объекта выполнения работ
            $table->char('abbr', 10)->unique(); // Аббривиатура объекта выполнения работ
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

        Schema::dropIfExists('objects');
    }
}