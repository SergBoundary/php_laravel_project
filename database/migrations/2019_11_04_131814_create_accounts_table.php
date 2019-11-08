<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список бухгалтерских счетов
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->char('title', 10)->unique(); // Код счета
            $table->string('description', 50)->unique(); // Наименование счета
            $table->char('account_balance_type', 3); // Тип счета в балансе: А, П, А/П, ЗБ
            $table->tinyInteger('balance_type'); // Тип остатка ???
            $table->integer('task'); // Задача ???
            $table->boolean('currency_status'); // Счет валютный
            $table->char('transaction_report', 3); // Номер "журнал ордера"
            $table->boolean('choose_account'); // Выбрать счет ???
            $table->char('inventory', 10); // Товарно материальные ценности (ТМЦ)
            $table->tinyInteger('inventory_write_off'); // Списание ТМЦ
            $table->integer('clients'); // Клиенты ???
            $table->integer('objects'); // Объекты: имущество, обязательства, хозяйственные операции
            $table->char('fixed_assets', 10); // Основные средства
            $table->integer('main_warehouse'); // Основной склад ???
            $table->tinyInteger('amount_type'); // Тип суммы ???
            $table->tinyInteger('type'); // Вид ???
            $table->char('gross_costs', 9); // Валовые затраты
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('accounts');
    }
}