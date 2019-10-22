<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentOrdersTable extends Migration {

    /**
     * Run the migrations: Таблица учета найма и увольнений работника
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('recruitment_orders', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('document_id')->unsigned(); // Код кадрового документа
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->timestamp('employment_date'); // Дата найма работника
            $table->char('employment_order', 10); // Номер приказа о найме работника
            $table->integer('probation')->unsigned(); // Количество дней испытательного срока
            $table->timestamp('dismissal_date'); // Дата увольнения работника
            $table->char('dismissal_order', 10); // Номер приказа об увольнении работника
            $table->integer('dismissal_reason_id')->unsigned(); // Причина увольнения работника
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('dismissal_reason_id')->references('id')->on('dismissal_reasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('recruitment_orders');
    }
}