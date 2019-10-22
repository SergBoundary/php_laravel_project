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
            $table->integer('department_group_id')->unsigned(); // Код группы подразделения
            $table->string('title', 50)->unique(); // Наименование подразделения
            $table->char('abbr', 10)->unique(); // Аббривиатура подразделения
            $table->tinyInteger('department_attribute'); // Признак ???
            $table->tinyInteger('print_order')->default(0); // Номер по порядку для печати
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('department_group_id')->references('id')->on('department_groups');
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