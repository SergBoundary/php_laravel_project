<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAccrualYearsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета сумм начислений работникам за год
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_accrual_years', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('calculation_year_id')->unsigned(); // Год расчета и  начисления
            $table->integer('calculation_month_id')->unsigned(); // Месяц расчета и  начисления
            $table->integer('department_id')->unsigned(); // Код подразделения
            $table->integer('position_id')->unsigned(); // Код должности (профессии)
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->integer('employment_type_id')->unsigned(); // Тип занятости: Основная ,совместитель, трудовое соглашение и т.д.
            $table->integer('year_id')->unsigned(); // Учет за указанный год
            $table->integer('account_id')->unsigned(); // Номер бухгалтерского счета
            $table->integer('tax_scale_id')->unsigned(); // Шкала расчета подоходного налога
            $table->float('accrual_amount', 8,2); // Сумма начисления работнику
            $table->float('retention_amount', 8,2); // Сумма удержания с работника
            $table->tinyInteger('days'); // Отработанные дни
            $table->float('hours', 8,2); // Отработанные часы
            $table->string('analytics', 10); // Аналитика
            $table->integer('currency_id')->unsigned(); // Код валюты
            $table->float('currency_amount', 8,2); // Сумма в валюте
            $table->integer('currency_kurs_id')->unsigned(); // Курс обмена валюты
            $table->float('tariff', 8,2); // Тариф начисления работнику
            $table->float('ssc_amount', 8,2); // Сумма для начисления ЕСВ по сотруднику
            $table->float('ssc_amount_disability', 8,2); // Сумма для начисления ЕСВ по сотруднику инвалиду
            $table->float('ssc_amount_sickness', 8,2); // Сумма для начисления ЕСВ по сотруднику больничный
            $table->float('ssc_amount_disability_sickness', 8,2); // Сумма для начисления ЕСВ по сотруднику инвалиду  больничный
            $table->float('ssc_amount_civil_contract', 8,2); // Сумма для начисления ЕСВ по сотруднику ГПХ
            $table->timestamp('retention_date'); // Дата ввода начисления удержания
            $table->string('comment', 50); // Примечание
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('calculation_year_id')->references('id')->on('years');
            $table->foreign('calculation_month_id')->references('id')->on('months');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('employment_type_id')->references('id')->on('employment_types');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('tax_scale_id')->references('id')->on('tax_scales');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('currency_kurs_id')->references('id')->on('currency_kurses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_accrual_years');
    }
}
