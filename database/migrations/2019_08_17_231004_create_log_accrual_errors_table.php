<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAccrualErrorsTable extends Migration
{
    /**
     * Run the migrations: Таблица ошибок в расчете начислений работникам
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_accrual_errors', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->string('message', 150); // Сообщение об ошибке
            $table->tinyInteger('error_type'); // Статус ошибки: 1 - расчет не прозведен, 2 - предупреждение
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
        Schema::dropIfExists('log_accrual_errors');
    }
}
