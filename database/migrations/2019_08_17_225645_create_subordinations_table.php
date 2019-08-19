<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubordinationsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список уровней должностей
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subordinations', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Наименование уровня должности: 1 - Директор; 2 - Заместитель; 3 - Главный специалист; 4 - Начальник отдела; 5 - Заместитель нач.отдела; 6 - ИТР; 7 - Рабочий
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
        Schema::dropIfExists('subordinations');
    }
}
