<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenceClassifiersTable extends Migration {

    /**
     * Run the migrations: Справочник. Классификатор отсутствия на работе
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('absence_classifiers', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_id')->unsigned(); // Код вида начиления
            $table->integer('absences_grouping_id')->unsigned(); // Код группы причин невыхода на работу
            $table->string('title', 50)->unique(); // Наименование причины невыхода на работу
            $table->char('abbr', 4)->unique(); // Обозначение для невыхода на работу
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('absences_grouping_id')->references('id')->on('grouping_types_of_absences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('absence_classifiers');
    }
}