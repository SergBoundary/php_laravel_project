<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersAmountsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета сумм нарядов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders_amounts', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('work_order_id')->unsigned(); // Номер порядковый наряда
            $table->integer('piecework_id')->unsigned(); // Код сдельной работы
            $table->integer('account_id')->unsigned(); // Счет затрат выполненой работы
            $table->integer('object_id')->unsigned(); // Объект для счета
            $table->integer('algorithm_id')->unsigned(); // Алгоритм расчета суммы
            $table->integer('quantity'); // Количество выполненой работы
            $table->float('price', 8,2); // Цена единицы
            $table->float('amount', 8,2); // Сумма выполненой работы
            $table->float('holidays_amount', 8,2); // Сумма выполненой работы в праздники
            $table->float('hours', 8,2); // Отработано часов на выполнение наряда
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('work_order_id')->references('id')->on('work_orders');
            $table->foreign('piecework_id')->references('id')->on('pieceworks');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('algorithm_id')->references('id')->on('algorithms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders_amounts');
    }
}
