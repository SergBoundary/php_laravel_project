<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalCardsTable extends Migration {

    /**
     * Run the migrations: Таблица учета неизменяемых персональных данных
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('personal_cards', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->char('personal_account', 10)->unique(); // Табельный номер
            $table->char('tax_number', 15)->nullable(); // Индивидуальный налоговый номер
            $table->string('surname', 100); // Фамилия
            $table->string('first_name', 100); // Имя (первое имя)
            $table->string('second_name', 100); // Отчество (второе имя)
            $table->string('full_name_latina', 100)->nullable(); // Фамилия на национальном языке работника
            $table->char('sex', 3)->nullable(); // Пол
            $table->date('born_date')->nullable(); // Дата рождения
            $table->string('photo_url', 255)->nullable(); // Фотография
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

        Schema::dropIfExists('personal_cards');
    }
}