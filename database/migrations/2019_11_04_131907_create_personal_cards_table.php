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
            $table->tinyInteger('sex')->nullable(); // Пол
            $table->date('born_date')->nullable(); // Дата рождения
            $table->integer('clothing_size_id')->unsigned()->nullable(); // Размер одежды
            $table->integer('shoe_size_id')->unsigned()->nullable(); // Размер обуви
            $table->string('photo_url', 255)->nullable(); // Фотография
            $table->integer('nationality_id')->unsigned(); // Национальность
            $table->integer('born_city_id')->unsigned()->nullable(); // Город рождения
            $table->integer('born_country_id')->unsigned()->nullable(); // Страна рождения
            $table->integer('marital_status_id')->unsigned()->nullable(); // Семейное положение
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('clothing_size_id')->references('id')->on('clothing_sizes');
            $table->foreign('shoe_size_id')->references('id')->on('shoe_sizes');
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->foreign('born_city_id')->references('id')->on('cities');
            $table->foreign('born_country_id')->references('id')->on('countries');
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses');
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