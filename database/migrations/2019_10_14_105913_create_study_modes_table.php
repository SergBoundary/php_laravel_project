<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyModesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список режимов (форм) обучения
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('study_modes', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 100)->unique(); // Вид режима (формы) обучения
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

        Schema::dropIfExists('study_modes');
    }
}