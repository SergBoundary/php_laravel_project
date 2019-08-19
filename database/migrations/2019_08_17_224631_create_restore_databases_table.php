<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestoreDatabasesTable extends Migration
{
    /**
     * Run the migrations: Таблица настроек восстановления базы данных
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restore_databases', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50); // Наименование параметра
            $table->string('description', 255); // Описание параметра
            $table->string('module', 50); // Ответственный модуль
            $table->string('command', 50); // Выполняемая команда
            $table->string('parametr', 50); // Параметр выполнения команды
            $table->string('condition', 255); // Условие запуска команды на выполнение
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restore_databases');
    }
}
