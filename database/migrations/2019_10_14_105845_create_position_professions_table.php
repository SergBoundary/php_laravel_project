<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionProfessionsTable extends Migration {

    /**
     * Run the migrations: Справочник. Государственный классификатор профессий
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('position_professions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->char('code', 10); // Код профессии в классификаторе
            $table->string('title', 255); // Наименование профессии в классификаторе
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

        Schema::dropIfExists('position_professions');
    }
}