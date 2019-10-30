<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilitaryAccountingTable extends Migration {

    /**
     * Run the migrations: Таблица воинского учета работников
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('military_accounting', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->string('accounting_group', 50); // Группа воинского учета
            $table->string('accounting_category', 50); // Категория воинского учета
            $table->string('composition', 50); // Состав
            $table->string('military_rank', 50); // Воинское звание
            $table->string('military_specialty', 50); // Военная специальность
            $table->tinyInteger('military_suitability'); // Годность к службе: 1 - строевой; 2 - не строевой
            $table->string('military_commissariat', 50); // Место призыва и мобилизации (военный комиссариат)
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('military_accounting');
    }
}