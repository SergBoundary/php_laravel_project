<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculationGroupsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список видов расчетов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation_groups', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_groups_id')->unsigned(); // Код группы вида начиления
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->tinyInteger('calculation_attribute')->unsigned(); // Признак использования: 0 - "не используется", 1 - "добавляется", 2 - "отнимается"
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('accrual_groups_id')->references('id')->on('accrual_groups');
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
        Schema::dropIfExists('calculation_groups');
    }
}
