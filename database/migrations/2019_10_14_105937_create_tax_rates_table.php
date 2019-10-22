<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRatesTable extends Migration {

    /**
     * Run the migrations: Справочник. Классификатор налоговых ставок
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('tax_rates', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_id')->unsigned(); // Код удержания
            $table->string('title', 50)->unique(); // Наименование ставки налогообложения
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('accrual_id')->references('id')->on('accruals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('tax_rates');
    }
}