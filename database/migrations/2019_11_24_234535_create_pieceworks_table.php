<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePieceworksTable extends Migration {

    /**
     * Run the migrations: Таблица учета сдельных работ
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('pieceworks', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('team_id')->unsigned(); // Код бригады
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('year_id')->unsigned(); // Год табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->string('type', 50); // Наименование сдельной работы
            $table->string('unit', 50); // Единица измерения выполнения сдельных работ
            $table->float('quantity', 8,2); // Количество выполных работ
            $table->float('price', 8,2); // Цена единицы сдельной работы
            $table->float('total', 8,2); // Общая цена сдельной работы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('object_id')->references('id')->on('objects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('pieceworks');
    }
}