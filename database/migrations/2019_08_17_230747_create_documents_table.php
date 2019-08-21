<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета кадровых документов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('document_id')->unsigned()->default(0); // Номер связанного документа в общем учете кадровых документов
            $table->timestamp('date'); // Дата выписки документа
            $table->char('number', 10); // Номер документа
            $table->string('annotation', 100); // Аннотация к документу
            $table->text('description'); // Описание документа
            $table->boolean('print'); // Статус печати документа: 0 - не распечатан; 1 - распечатан
            $table->integer('document_type_id')->unsigned(); // Код типа документа
            $table->integer('personal_card_id')->unsigned()->default(0); // Личная карточка работника
            $table->integer('create_user_id')->unsigned(); // Пользователь, создавший документ
            $table->integer('editor_user_id')->unsigned(); // Пользователь, изменивший документ
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('create_user_id')->references('id')->on('users');
            $table->foreign('editor_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
