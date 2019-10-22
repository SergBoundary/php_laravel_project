<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceCertificatesTable extends Migration {

    /**
     * Run the migrations: Таблица учета страховых свидетельств работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('insurance_certificates', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->char('certificate_series', 10); // Серия страхового свидетельства
            $table->string('certificate_number', 50); // Номер страхового свидетельства
            $table->float('insurance_fee', 8,2); // Сумма страхового взноса
            $table->timestamp('certificate_expiry'); // Истечение срока действия страхового свидетельства
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

        Schema::dropIfExists('insurance_certificates');
    }
}