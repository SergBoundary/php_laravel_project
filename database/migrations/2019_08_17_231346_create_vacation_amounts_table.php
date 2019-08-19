<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationAmountsTable extends Migration
{
    /**
     * Run the migrations: Таблица расчета сумм отпускных
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_amounts', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('vacation_id')->unsigned(); // Код записи об отпуске
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->integer('account_id')->unsigned(); // Код номера бухгалтерского счета
            $table->integer('year_id')->unsigned(); // Год расчета
            $table->integer('month_id')->unsigned(); // Месяц расчета
            $table->integer('calculation_year_id')->unsigned(); // Расчет за год
            $table->integer('calculation_month_id')->unsigned(); // Расчет за месяц
            $table->timestamp('date_from'); // Расчет от даты
            $table->timestamp('date_to'); // Расчет до даты
            $table->tinyInteger('calculation_type'); // Тип расчета: 1 - по дням; 2 - по часам
            $table->tinyInteger('days'); // Дни
            $table->float('hours', 8,2); // Часы
            $table->tinyInteger('days_unpaid'); // Не оплачиваемые дни отпуска
            $table->tinyInteger('days_paid'); // Оплачиваемые дни отпуска
            $table->tinyInteger('days_total'); // Всего дней отпуска
            $table->float('hours_total', 8,2); // Всего часов отпуска
            $table->float('amount_days', 8,2); // Сумма за день
            $table->float('amount_hours', 8,2); // Сумма за час
            $table->float('amount_total', 8,2); // Сумма всего
            $table->float('percent', 8,2); // Процент оплаты
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('vacation_id')->references('id')->on('vacations');
            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('calculation_year_id')->references('id')->on('years');
            $table->foreign('calculation_month_id')->references('id')->on('months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacation_amounts');
    }
}
