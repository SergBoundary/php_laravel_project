<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAccrualCalculationsTable extends Migration
{
    /**
     * Run the migrations: Таблица расчета сумм начислений работникам
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_accrual_calculations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->integer('algorithm_id')->unsigned(); // Алгоритм начисления работнику
            $table->integer('tax_rate_id')->unsigned(); // Код ставки налогообложения
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->float('accrual_amount', 8,2); // Сумма начисления работнику
            $table->timestamp('start'); // Действие ставки налога от даты
            $table->timestamp('expiry')->nullable(); // Действие ставки налога до даты
            $table->tinyInteger('save_of_analytics'); // Для хранения аналитики по адресу
            $table->char('account_title', 10); // Номер бухгалтерского счета
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('algorithm_id')->references('id')->on('algorithms');
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates');
            $table->foreign('object_id')->references('id')->on('objects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_accrual_calculations');
    }
}
