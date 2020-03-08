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
            $table->string('structura'); // Код организационной структуры
            $table->integer('user_id')->unsigned(); // Код пользователя - автора записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->date('employment_date'); // Дата найма работника
            $table->string('employment_order', 15)->nullable(); // Номер приказа о найме работника
            $table->integer('probation')->default(0); // Количество дней испытательного срока
            $table->date('dismissal_date')->nullable(); // Дата увольнения работника
            $table->string('dismissal_order', 15)->nullable(); // Номер приказа об увольнении работника
            $table->string('dismissal_reason', 255)->nullable(); // Причина увольнения работника
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
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