<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalCommunicationsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета способов коммуникации с работником
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_communications', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('communication_type_id')->unsigned(); // Код способа коммуникации с работником: телефон рабочий, домашний, другой; пейджер; емейл
            $table->char('content', 20); // Номер телефона, пейджера, текст емейла
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('communication_type_id')->references('id')->on('communication_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_communications');
    }
}
