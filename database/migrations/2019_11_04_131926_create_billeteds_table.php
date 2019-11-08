<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilletedsTable extends Migration {

    /**
     * Run the migrations: Таблица учета расселения работников
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('billeteds', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('hotel_id')->unsigned(); // Код отеля
            $table->date('start'); // Дата заселения
            $table->smallInteger('days')->nullable(); // Оплачено дней
            $table->date('expiry')->nullable(); // Дата выселения
            $table->float('balance', 8,2)->nullable(); // Остаток
            $table->float('fine', 8,2)->nullable(); // Штрафы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('hotel_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('billeteds');
    }
}