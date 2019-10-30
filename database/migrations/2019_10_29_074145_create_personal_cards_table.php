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
            $table->char('tax_number', 10)->nullable(); // Индивидуальный налоговый номер
            $table->string('surname', 100); // Фамилия
            $table->string('first_name', 100); // Имя (первое имя)
            $table->string('second_name', 100); // Отчество (второе имя)
            $table->integer('nationality_id')->unsigned(); // Национальность
            $table->string('full_name_latina', 100)->nullable(); // Фамилия на национальном языке работника
            $table->timestamp('born_date'); // Дата рождения
            $table->integer('born_city_id')->unsigned(); // Город рождения
            $table->integer('born_region_id')->unsigned(); // Район рождения
            $table->integer('born_district_id')->unsigned(); // Область рождения
            $table->integer('born_country_id')->unsigned(); // Страна рождения
            $table->tinyInteger('sex'); // Пол
            $table->integer('marital_status_id')->unsigned(); // Семейное положение
            $table->integer('clothing_size_id')->unsigned(); // Размер одежды
            $table->integer('shoe_size_id')->unsigned(); // Размер обуви
            $table->boolean('union_member')->default(0); // Членство в профсоюзе: 0 - нет, 1 - есть
            $table->boolean('disability')->default(0); // Наличие инвалидости: 0 - нет, 1 - есть
            $table->integer('disability_id')->unsigned()->nullable(); // Группа инвалидности. Если инвалидности нет, то номер группы отсутствует
            $table->timestamp('pension_date')->nullable(); // Дата выхода на пенсию. Если даты нет, то не пенсионер
            $table->string('pension_certificate', 100)->nullable(); // Номер пенсионного удостоверения. Если не пенсионер, номер отсутствует
            $table->string('photo_url', 255)->nullable(); // Фотография
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->foreign('born_city_id')->references('id')->on('cities');
            $table->foreign('born_region_id')->references('id')->on('regions');
            $table->foreign('born_district_id')->references('id')->on('districts');
            $table->foreign('born_country_id')->references('id')->on('countries');
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses');
            $table->foreign('clothing_size_id')->references('id')->on('clothing_sizes');
            $table->foreign('shoe_size_id')->references('id')->on('shoe_sizes');
            $table->foreign('disability_id')->references('id')->on('disabilities');
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