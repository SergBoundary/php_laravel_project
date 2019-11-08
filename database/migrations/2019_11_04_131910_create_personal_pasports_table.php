<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalPasportsTable extends Migration {

    /**
     * Run the migrations: Таблица учета паспортов работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('personal_pasports', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->char('series', 10); // Серия паспорта
            $table->char('number', 10); // Номер паспорта
            $table->date('issuing_date'); // Дата выдачи паспорта
            $table->string('issuing_authority', 30); // Орган выдачи паспорта
            $table->date('expiration_date'); // Дата окончания срока действия
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('personal_pasports');
    }
}