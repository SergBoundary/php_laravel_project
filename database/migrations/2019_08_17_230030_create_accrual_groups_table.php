<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccrualGroupsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список групп видов начислений
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accrual_groups', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50); // Наименование группы
            $table->string('description', 256); // Описание группы расчета
            $table->tinyInteger('type'); // Вид ???
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accrual_groups');
    }
}
