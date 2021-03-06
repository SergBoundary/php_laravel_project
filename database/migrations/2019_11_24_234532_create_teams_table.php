<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration {

    /**
     * Run the migrations: Таблица учета формирования бригад
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('personal_card_id')->default(0); // Код личной карточки работника
            $table->string('title'); // Наименование бригады
            $table->char('abbr', 10); // Аббривиатура бригады
            $table->date('start')->nullable(); // Дата формирования бригады
            $table->date('expiry')->nullable(); // Дата расформирования бригады
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('personal_card_id')->references('id')->on('personal_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('teams');
    }
}