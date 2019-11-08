<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalEducationsTable extends Migration {

    /**
     * Run the migrations: Таблица учета образования и квалификации работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('personal_educations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('education_type_id')->unsigned(); // Уровень образования: высшая школа, средняя школа, базовая школа
            $table->integer('study_mode_id')->unsigned(); // Режим (форма) обучения: дневная, вечерняя, заочная
            $table->string('institution', 100); // Название учебного заведения
            $table->string('specialty', 100); // Дипломная специальность
            $table->string('degree', 100); // Дипломная квалификация (степень)
            $table->char('degree_abbr', 10); // Аббривиатура квалификации
            $table->string('diploma', 100); // Серия и номер диплома об образовании
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('education_type_id')->references('id')->on('education_types');
            $table->foreign('study_mode_id')->references('id')->on('study_modes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('personal_educations');
    }
}