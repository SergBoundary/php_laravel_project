<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration {

    /**
     * Run the migrations: Таблица обслуживания расчета заработной платы
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id'); // ID записи
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

        Schema::dropIfExists('payrolls');
    }
}