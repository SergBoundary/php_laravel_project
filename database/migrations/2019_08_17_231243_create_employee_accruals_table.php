<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAccrualsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета сумм начислений работникам
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_accruals', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('department_id')->unsigned(); // Код подразделения
            $table->integer('department_accrual_id')->unsigned(); // Код  начисления по подразделению
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->float('accrual_amount', 8,2); // Сумма начисления работнику
            $table->integer('year_id')->unsigned(); // Месяц учета
            $table->integer('month_id')->unsigned(); // Год учета
            $table->tinyInteger('days'); // Отработанные дни
            $table->float('hours', 8,2); // Отработанные часы
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->string('account_title', 10); // Номер бухгалтерского счета
            $table->integer('currency_id')->unsigned(); // Код валюты
            $table->float('currency_amount', 8,2); // Сумма в валюте
            $table->integer('currency_kurs_id')->unsigned(); // Курс обмена валюты
            $table->float('tariff', 8,2); // Тариф начисления работнику
            $table->integer('calculation_year_id')->unsigned(); // Год расчета и  начисления
            $table->integer('calculation_month_id')->unsigned(); // Месяц расчета и  начисления
            $table->string('comment', 50); // Примечание
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('department_accrual_id')->references('id')->on('department_accruals');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('currency_kurs_id')->references('id')->on('currency_kurses');
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
        Schema::dropIfExists('employee_accruals');
    }
}
