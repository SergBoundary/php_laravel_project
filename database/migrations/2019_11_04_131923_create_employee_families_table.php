<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeFamiliesTable extends Migration {

    /**
     * Run the migrations: Таблица учета влияния близкого окружения
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('employee_families', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('family_relation_type_id')->unsigned(); // Степень родства
            $table->string('surname', 100); // Фамилия
            $table->string('first_name', 100); // Имя (первое имя)
            $table->string('second_name', 100); // Отчество (второе имя)
            $table->timestamp('born_date'); // Дата рождения
            $table->tinyInteger('sex'); // Пол
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('family_relation_type_id')->references('id')->on('family_relation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('employee_families');
    }
}