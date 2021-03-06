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
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->char('personal_account', 10); // Табельный номер
            $table->string('surname', 100); // Фамилия
            $table->string('first_name', 100); // Имя (первое имя)
            $table->string('second_name', 100)->nullable(); // Отчество (второе имя)
            $table->string('full_name_latina', 100)->nullable(); // Фамилия на национальном языке работника
            $table->char('sex', 3)->nullable(); // Пол
            $table->date('born_date')->nullable(); // Дата рождения
            $table->string('phone', 255)->nullable(); // Телефон
            $table->string('photo_url', 255)->nullable()->default('/img/no_photo.jpg'); // Фотография
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
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