<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursBalanceClassifiersTable extends Migration {

    /**
     * Run the migrations: Справочник. Классификатор графиков распределения рабочих часов в периоде
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('hours_balance_classifiers', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Название баланса
            $table->char('monday_day', 5); // Понедельник день
            $table->char('tuesday_day', 5); // Вторник день
            $table->char('wednesday_day', 5); // Среда день
            $table->char('thursday_day', 5); // Четверг день
            $table->char('friday_day', 5); // Пятница день
            $table->char('saturday_day', 5); // Суббота день
            $table->char('sunday_day', 5); // Воскресенье день
            $table->char('hours_reduction', 5); // Сокращение часов
            $table->float('hourly_rate', 8,2); // Ставка за час
            $table->tinyInteger('period'); // Количество дней в периоде
            $table->char('monday_evening', 5); // Понедельник вечер
            $table->char('tuesday_evening', 5); // Вторник вечер
            $table->char('wednesday_evening', 5); // Среда вечер
            $table->char('thursday_evening', 5); // Четверг вечер
            $table->char('friday_evening', 5); // Пятница вечер
            $table->char('saturday_evening', 5); // Суббота вечер
            $table->char('sunday_evening', 5); // Воскресенье
            $table->char('monday_night', 5); // Понедельник ночь
            $table->char('tuesday_night', 5); // Вторник ночь
            $table->char('wednesday_night', 5); // Среда ночь
            $table->char('thursday_night', 5); // Четверг ночь
            $table->char('friday_night', 5); // Пятница ночь
            $table->char('saturday_night', 5); // Суббота ночь
            $table->char('sunday_night', 5); // Воскресенье ночь
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

        Schema::dropIfExists('hours_balance_classifiers');
    }
}