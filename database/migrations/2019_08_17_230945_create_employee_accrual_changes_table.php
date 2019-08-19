<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAccrualChangesTable extends Migration
{
    /**
     * Run the migrations: Таблица учета переформирования начислений работникам
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_accrual_changes', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('algorithm_id')->unsigned(); // Код алгоритм начисления работнику
            $table->integer('tax_rates_id')->unsigned(); // Код ставки налогообложения
            $table->timestamp('date_to'); // Переформирование до даты
            $table->float('amount', 8,2); // Новое значение
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('algorithm_id')->references('id')->on('algorithms');
            $table->foreign('tax_rates_id')->references('id')->on('tax_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_accrual_changes');
    }
}
