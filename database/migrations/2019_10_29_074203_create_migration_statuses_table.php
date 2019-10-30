<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigrationStatusesTable extends Migration {

    /**
     * Run the migrations: Таблица учета миграционного статуса работника в стране
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('migration_statuses', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('country_id')->unsigned(); // Код страны легального пребывания
            $table->string('status_old', 50); // Текущий статус пребывания
            $table->string('status_new', 50)->nullable(); // Новый статус пребывания
            $table->string('opening_reason', 100)->nullable(); // Основание получения нового статуса
            $table->timestamp('submitted')->nullable(); // Дата подачи документов в орган легализации пребывания
            $table->timestamp('incomplete')->nullable(); // Дата требования подать недостающие документы
            $table->string('decision_number', 50)->nullable(); // Номер решения о легализации пребывания
            $table->timestamp('decision_date')->nullable(); // Дата выдачи решения о легализации пребывания
            $table->timestamp('date_opening')->nullable(); // Дата открытия пребывания в стране
            $table->timestamp('date_closing')->nullable(); // Дата закрытия пребывания в стране
            $table->string('closing_reason', 100)->nullable(); // Основание анулирования пребывания
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('migration_statuses');
    }
}