<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialEatingsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета специального питания
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_eatings', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('year_id')->unsigned(); // Год расхода на специальное питание
            $table->integer('month_id')->unsigned(); // Месяц расхода на специальное питание
            $table->float('residual_amount', 8,2); // Остаток суммы на начало месяца
            $table->float('amount', 8,2); // Сумма затрат на специальное питание в месяц
            $table->float('hours', 8,2); // Отработано часов за месяц
            $table->float('unit_price', 8,2); // Цена пиания за штуку
            $table->integer('unit_quantity'); // Количество положено за месяц
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_eatings');
    }
}
