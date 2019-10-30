<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRateAmountsTable extends Migration {

    /**
     * Run the migrations: Справочник. Классификатор сумм оплаты налогов
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('tax_rate_amounts', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('tax_rate_id')->unsigned(); // Номер ставки налогообложения
            $table->timestamp('date_from'); // Дата с которой действует данная ставка
            $table->float('amount_from', 8,2); // Сумма с которой действует данная ставка
            $table->float('amount_to', 8,2); // Сумма до которой действует данная ставка
            $table->float('amount', 8,2); // Сумма для добавления к сумме от процента
            $table->float('percent', 8,2); // Процент начисления  налога
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('tax_rate_id')->references('id')->on('tax_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('tax_rate_amounts');
    }
}