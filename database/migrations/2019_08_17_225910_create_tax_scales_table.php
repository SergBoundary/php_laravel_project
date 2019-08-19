<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxScalesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список получателей подоходного налога
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_scales', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 30)->unique(); // Описание диапазона
            $table->float('lower amount', 8,2)->nullable(); // Нижняя сумма диапазона
            $table->float('top amount', 8,2)->nullable(); // Верхняя сумма диапазона
            $table->float('tax percentage', 8,2); // Процент налога
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
        Schema::dropIfExists('tax_recipients');
    }
}
