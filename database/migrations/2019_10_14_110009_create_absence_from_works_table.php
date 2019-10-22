<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenceFromWorksTable extends Migration {

    /**
     * Run the migrations: Таблица учета отсутствия на работе
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('absence_from_works', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('absence_classifier_id')->unsigned(); // Код вида отсутствия на работе
            $table->timestamp('start'); // Начало периода отсутствия на работе
            $table->timestamp('expiry')->nullable(); // Окончание периода отсутствия на работе
            $table->string('rationale', 20); // Обоснование отсутствия на работе
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('absence_classifier_id')->references('id')->on('absence_classifiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('absence_from_works');
    }
}