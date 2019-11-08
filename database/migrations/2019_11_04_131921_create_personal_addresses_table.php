<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalAddressesTable extends Migration {

    /**
     * Run the migrations: Таблица учета адресов работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('personal_addresses', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->char('postcode', 10)->nullable(); // Почтовый индекс
            $table->integer('city_id')->unsigned(); // Название города
            $table->char('street', 50); // Название улицы
            $table->char('house', 10); // Номер дома
            $table->char('apartment', 10)->nullable(); // Номер квартиры
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('personal_addresses');
    }
}