<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccrualRelationsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список зависимостей начислений
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accrual_relations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_id')->unsigned(); // Зависимость от кода начисления
            $table->tinyInteger('relation_attribute')->unsigned()->default(0); // Признак зависимости: 0 - "Нет"; 1 - "+ Да"; 2 - "- Да"
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
    public function down()
    {
        Schema::dropIfExists('accrual_relations');
    }
}
