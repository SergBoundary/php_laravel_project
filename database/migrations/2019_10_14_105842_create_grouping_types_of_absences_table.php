<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupingTypesOfAbsencesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список видов отсутствия на работе
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('grouping_types_of_absences', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 255)->unique(); // Наименование вида причин невыхода на работу
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

        Schema::dropIfExists('grouping_types_of_absences');
    }
}