<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkExperiencesTable extends Migration {

    /**
     * Run the migrations: Таблица учета трудового стаража работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('position_profession_id')->unsigned(); // Код основной профессии
            $table->smallInteger('work_experience_years'); // Количество лет стажа до поступления на работу
            $table->smallInteger('work_experience_months'); // Количество месяцев стажа до поступления на работу
            $table->smallInteger('work_experience_days'); // Количество дней стажа до поступления на работу
            $table->smallInteger('work_experience_continuous'); // Количество дней непрерывного стажа
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

        Schema::dropIfExists('work_experiences');
    }
}