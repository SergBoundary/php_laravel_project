<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccrualTypesTable extends Migration {

    /**
     * Run the migrations: Справочник. Классификатор начислений
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('accrual_types', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->char('title', 5)->unique(); // Код начисления (для < 500)
            $table->string('description', 100)->unique(); // Наименование начисления
            $table->char('abbr', 20); // Сокращенное наименование начисления
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

        Schema::dropIfExists('accrual_types');
    }
}