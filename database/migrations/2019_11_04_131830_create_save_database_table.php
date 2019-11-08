<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveDatabaseTable extends Migration {

    /**
     * Run the migrations: Таблица настроек сохранения базы данных
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('save_database', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50); // Наименование параметра
            $table->string('description', 255); // Описание параметра
            $table->string('module', 50); // Ответственный модуль
            $table->string('command', 50); // Выполняемая команда
            $table->string('parametr', 50); // Параметры выполнения команды
            $table->timestamp('start'); // Дата и время включения параметра
            $table->timestamp('expiry'); // Дата и время выключения параметра
            $table->timestamp('month_day'); // День месяца запуска команды на выполнение
            $table->timestamp('week_day'); // День недели запуска команды на выполнение
            $table->timestamp('run_time'); // Время запуска команды на выполнение
            $table->string('condition', 255); // Условие экстренного запуска команды на выполнение
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

        Schema::dropIfExists('save_database');
    }
}