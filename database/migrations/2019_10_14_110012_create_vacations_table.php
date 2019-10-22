<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationsTable extends Migration {

    /**
     * Run the migrations: Таблица учета отпусков
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('vacations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('document_id')->unsigned(); // Код приказа на отпуск
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('absence_classifier_id')->unsigned(); // Код вида отсутствия на работе
            $table->timestamp('period_start'); // За период работы с даты
            $table->timestamp('period_expiry'); // За период работы до даты
            $table->smallInteger('period'); // Кличество отработанных дней без оплачиваемого отпуска
            $table->timestamp('start'); // Начало отпуска
            $table->timestamp('expiry'); // Конец отпуска
            $table->integer('phrase_list_id')->unsigned(); // Обоснование выхода в отпуск
            $table->tinyInteger('work_days'); // Количество рабочих дней в дни невыхода
            $table->smallInteger('work_hours'); // Количество рабочих часов в дни невыхода
            $table->float('vacation_pay', 8,2)->default(0); // Сумма отпускных или материальной помощи
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('absence_classifier_id')->references('id')->on('absence_classifiers');
            $table->foreign('phrase_list_id')->references('id')->on('phrase_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('vacations');
    }
}