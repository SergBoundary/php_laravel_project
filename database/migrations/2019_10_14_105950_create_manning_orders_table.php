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
            $table->integer('manning_table_id')->unsigned(); // Код позиции в штатном расписании
            $table->timestamp('assignment_date'); // Дата назначения
            $table->char('assignment_order', 10); // Номер приказа о назначении на должность
            $table->timestamp('resignation_date'); // Дата снятия
            $table->char('resignation_order', 10); // Номер приказа о снятии с должности
            $table->float('salary', 8,2); // Индивидуальный размер тарифа
            $table->float('tariff', 8,2); // Индивидуальный размер оклада
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('manning_table_id')->references('id')->on('manning_tables');
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