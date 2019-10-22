<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentTypesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список видов трудовых отношений
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('employment_types', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 100)->unique(); // Вид трудовых отношений
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

        Schema::dropIfExists('employment_types');
    }
}