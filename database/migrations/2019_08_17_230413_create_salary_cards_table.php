<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryCardsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета зарплатных карт работника
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_cards', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->string('number', 50); // Номер банковской карточки для начисления зарплаты
            $table->timestamp('expiry'); // Дата истечения срока действия банковской карточки
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
        Schema::dropIfExists('salary_cards');
    }
}
