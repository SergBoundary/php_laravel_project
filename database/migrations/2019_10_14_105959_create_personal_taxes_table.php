<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTaxesTable extends Migration {

    /**
     * Run the migrations: Таблица учета налоговой информации работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('personal_taxes', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('tax_office_id')->unsigned(); // Код налоговой инспекции
            $table->integer('tax_recipient_id')->unsigned(); // Код населенного пункта для перечисления подоходного налога
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('tax_office_id')->references('id')->on('tax_offices');
            $table->foreign('tax_recipient_id')->references('id')->on('tax_recipients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('personal_taxes');
    }
}