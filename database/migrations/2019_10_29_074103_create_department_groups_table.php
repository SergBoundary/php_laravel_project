<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentGroupsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список групп подразделений компании
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('department_groups', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Наименование группы подразделений
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

        Schema::dropIfExists('department_groups');
    }
}