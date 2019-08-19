<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalAddressesTable extends Migration
{
    /**
     * Run the migrations: Таблица учета адресов работника
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_addresses', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->char('postcode', 10); // Почтовый индекс
            $table->char('city', 20); // Название города
            $table->char('street', 50); // Название улицы
            $table->char('house', 10); // Номер дома
            $table->char('apartment', 10)->nullable(); // Номер квартиры
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
    public function down()
    {
        Schema::dropIfExists('personal_addresses');
    }
}
