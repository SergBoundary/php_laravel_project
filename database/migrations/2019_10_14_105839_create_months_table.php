<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список месяцев
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('months', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->tinyInteger('number')->unique(); // Число месяца
            $table->string('title', 20)->unique(); // Название месяца
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('months');
    }
}