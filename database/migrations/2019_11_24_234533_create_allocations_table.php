<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocationsTable extends Migration {

    /**
     * Run the migrations: Таблица учета должностных назначений работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('allocations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('object_id')->unsigned(); // Распределен на объект
            $table->integer('team_id')->unsigned(); // Распределен в бригаду
            $table->date('start'); // Дата прикрепления
            $table->date('expiry')->nullable(); // Дата открепления
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('allocations');
    }
}