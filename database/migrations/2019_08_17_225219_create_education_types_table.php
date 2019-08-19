<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTypesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список уровней образования
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_types', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 100)->unique(); // Уровень образования
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
        Schema::dropIfExists('education_types');
    }
}
