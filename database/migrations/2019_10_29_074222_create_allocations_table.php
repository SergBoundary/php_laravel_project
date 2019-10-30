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
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('object_id')->unsigned(); // Распределен на объект
            $table->integer('team_id')->unsigned(); // Распределен в бригаду
            $table->integer('document_id')->unsigned(); // Номер документа в учете кадровых документов
            $table->timestamp('date'); // Дата распределения
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('document_id')->references('id')->on('documents');
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