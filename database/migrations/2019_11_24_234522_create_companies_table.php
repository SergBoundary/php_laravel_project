<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список компаний
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->integer('country')->unique(); // Страна происхождения компании
            $table->char('code', 10)->unique(); // Код компании
            $table->string('title')->unique(); // Наименование компании
            $table->char('abbr', 10)->unique(); // Аббривиатура компании
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

        Schema::dropIfExists('companies');
    }
}