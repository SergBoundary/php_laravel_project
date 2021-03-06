<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список подразделений компании
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->string('title', 50)->unique(); // Наименование подразделения
            $table->char('abbr', 15)->unique(); // Аббривиатура подразделения
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

        Schema::dropIfExists('departments');
    }
}