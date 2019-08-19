<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDismissalReasonsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список оснований увольнения работника
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dismissal_reasons', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 100)->unique(); // Основание увольнения работника
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
        Schema::dropIfExists('dismissal_reasons');
    }
}
