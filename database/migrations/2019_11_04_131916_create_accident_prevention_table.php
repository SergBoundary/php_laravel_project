<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentPreventionTable extends Migration {

    /**
     * Run the migrations: Таблица учета сертификатов по техники безопастности работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('accident_prevention', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->char('certificate_series', 10); // Серия сертификата по техники безопастности
            $table->string('certificate_number', 50); // Номер сертификата по техники безопастности
            $table->date('certificate_start'); // Начало срока действия сертификата
            $table->date('certificate_expiry'); // Истечение срока действия сертификата
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

        Schema::dropIfExists('accident_prevention');
    }
}