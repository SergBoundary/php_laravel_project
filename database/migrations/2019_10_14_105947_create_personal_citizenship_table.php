<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalCitizenshipTable extends Migration {

    /**
     * Run the migrations: Таблица учета гражданств работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('personal_citizenship', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('country_id')->unsigned(); // Код страны
            $table->timestamp('start'); // Дата вступления в гражданство
            $table->timestamp('expiry'); // Дата выхода из гражданства
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('personal_citizenship');
    }
}