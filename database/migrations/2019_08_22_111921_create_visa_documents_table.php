<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_documents', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('visa_status_id')->unsigned(); // Код записи в учете виз работкника
            $table->char('type', 50); // Вид документа
            $table->char('number', 20)->nullable(); // Номер документа
            $table->timestamp('date_issued'); // Дата выдачи документа
            $table->timestamp('date_expiration')->nullable(); // Дата окончания действия документа
            $table->timestamp('date_inclusion'); // Дата включения документа в пакет
            $table->timestamp('date_seizure')->nullable(); // Дата изъятия документа из пакета
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('visa_status_id')->references('id')->on('visa_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visa_documents');
    }
}
