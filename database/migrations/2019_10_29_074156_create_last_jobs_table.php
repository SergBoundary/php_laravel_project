<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastJobsTable extends Migration {

    /**
     * Run the migrations: Таблица учета предыдущих мест работы
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('last_jobs', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->string('last_job', 100); // Наименование последнего места работы
            $table->integer('position_profession_id')->unsigned(); // Код основной профессии на последнем месте работы
            $table->timestamp('dismissal_date'); // Дата увольнения с предыдущей работы
            $table->string('dismissal_reason', 100); // Причина увольнения с предыдущей работы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('position_profession_id')->references('id')->on('position_professions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('last_jobs');
    }
}