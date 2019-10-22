<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryCardsTable extends Migration {

    /**
     * Run the migrations: Таблица учета зарплатных карт работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('salary_cards', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('bank_id')->unsigned(); // 
            $table->string('payment_card', 50); // Номер банковской карточки для начисления зарплаты
            $table->timestamp('expiry'); // Дата истечения срока действия банковской карточки
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('bank_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('salary_cards');
    }
}