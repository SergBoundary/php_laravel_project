<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManningOrdersTable extends Migration {

    /**
     * Run the migrations: Таблица учета должностных назначений
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('manning_orders', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Код личной карточки работника
            $table->integer('department_id')->unsigned(); // Подразделение
            $table->integer('position_id')->unsigned(); // Фактическая должность
            $table->integer('position_professions')->unsigned(); // Формальная должность по классификатору
            $table->date('assignment_date'); // Дата назначения
            $table->char('assignment_order', 10)->nullable(); // Номер приказа о назначении на должность
            $table->date('resignation_date')->nullable(); // Дата снятия
            $table->char('resignation_order', 10)->nullable(); // Номер приказа о снятии с должности
            $table->float('salary', 8,2)->nullable(); // Индивидуальный размер тарифа
            $table->float('tariff', 8,2)->nullable(); // Индивидуальный размер оклада
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('position_professions')->references('id')->on('position_professions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('manning_orders');
    }
}