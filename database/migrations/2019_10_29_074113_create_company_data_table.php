<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDataTable extends Migration {

    /**
     * Run the migrations: Таблица реквизитов компании
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('company_data', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50); // Наименование реквизита
            $table->string('description', 255); // Описание реквизита
            $table->string('data_short', 100); // Сокращенное содержание реквизита
            $table->text('data_full'); // Полное содержание реквизита
            $table->timestamp('start'); // Время начала правового действия реквизита
            $table->timestamp('expiry'); // Время окончания правового действия реквизита
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

        Schema::dropIfExists('company_data');
    }
}