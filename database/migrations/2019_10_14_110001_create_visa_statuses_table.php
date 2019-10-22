<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaStatusesTable extends Migration {

    /**
     * Run the migrations: Таблица учета виз работника на пребывание в стране
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('visa_statuses', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('country_out_id')->unsigned(); // Код страны оформления визы
            $table->integer('country_in_id')->unsigned(); // Код страны пребывания (выезда)
            $table->string('opening_reason', 100); // Основание открытия визы
            $table->timestamp('submitted')->nullable(); // Дата подачи документов в визовый орган
            $table->timestamp('incomplete')->nullable(); // Дата требования подать недостающие документы
            $table->timestamp('visa_issued')->nullable(); // Дата выдачи визы
            $table->string('visa_type', 50); // Тип визы
            $table->timestamp('date_opening'); // Дата открытия визы
            $table->timestamp('date_closing'); // Дата закрытия визы
            $table->string('closing_reason', 100)->nullable(); // Основание закрытия визы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('country_out_id')->references('id')->on('countries');
            $table->foreign('country_in_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('visa_statuses');
    }
}