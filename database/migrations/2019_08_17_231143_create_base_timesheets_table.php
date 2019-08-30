<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTimesheetsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета отработанного времени (табель)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_timesheets', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('personal_card_id')->unsigned(); // Личная карточка работника
            $table->integer('year_id')->unsigned(); // Год табеля
            $table->integer('month_id')->unsigned(); // Месяц табеля
            $table->integer('accrual_id')->unsigned(); // Код оплаты по табелю: 1 - оклад; 2 - сдельно; 3 - тариф)
            
            $table->integer('hours_balance_classifier_id')->unsigned(); // Код баланса для строки табеля
            $table->integer('department_id')->unsigned(); // Подразделение
            $table->float('amount', 8,2); // Размер оклада или тарифа для работника
            $table->tinyInteger('actual_days'); // Отработано фактических дней
            $table->tinyInteger('vacation_days'); // Отпускные дни
            $table->tinyInteger('childbirth_leave'); // Отпуск в связи с родами
            $table->tinyInteger('sick_days'); // Больничные дни
            $table->tinyInteger('other_days'); // Прочие дни разрешеные законом (оплачиваемые)
            $table->tinyInteger('unpaid_leave'); // Не оплачиваемый отпуск с разрешения администрации
            $table->tinyInteger('absense from work'); // Дни отсутствия на работе без уважительных причин
            $table->tinyInteger('weekend'); // Выходные и праздничные дни
            $table->tinyInteger('holidays'); // Отработано праздничных дней
            $table->float('hours', 8,2); // Отработано часов
            $table->float('night_hours', 8,2); // Отработано часов в ночное время
            $table->float('overtime', 8,2); // Отработано сверхурочно
            $table->integer('account_id')->unsigned(); // Номер счета для отнесения затрат
            $table->integer('position_id')->unsigned(); // Занимаемая должность
            $table->integer('object_id')->unsigned(); // Объект для счета
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            $table->char('day_1', 5)->nullable(); // 1-й день месяца
            $table->char('day_2', 5)->nullable(); // 2-й день месяца
            $table->char('day_3', 5)->nullable(); // 3-й день месяца
            $table->char('day_4', 5)->nullable(); // 4-й день месяца
            $table->char('day_5', 5)->nullable(); // 5-й день месяца
            $table->char('day_6', 5)->nullable(); // 6-й день месяца
            $table->char('day_7', 5)->nullable(); // 7-й день месяца
            $table->char('day_8', 5)->nullable(); // 8-й день месяца
            $table->char('day_9', 5)->nullable(); // 9-й день месяца
            $table->char('day_10', 5)->nullable(); // 10-й день месяца
            $table->char('day_11', 5)->nullable(); // 11-й день месяца
            $table->char('day_12', 5)->nullable(); // 12-й день месяца
            $table->char('day_13', 5)->nullable(); // 13-й день месяца
            $table->char('day_14', 5)->nullable(); // 14-й день месяца
            $table->char('day_15', 5)->nullable(); // 15-й день месяца
            $table->char('day_16', 5)->nullable(); // 16-й день месяца
            $table->char('day_17', 5)->nullable(); // 17-й день месяца
            $table->char('day_18', 5)->nullable(); // 18-й день месяца
            $table->char('day_19', 5)->nullable(); // 19-й день месяца
            $table->char('day_20', 5)->nullable(); // 20-й день месяца
            $table->char('day_21', 5)->nullable(); // 21-й день месяца
            $table->char('day_22', 5)->nullable(); // 22-й день месяца
            $table->char('day_23', 5)->nullable(); // 23-й день месяца
            $table->char('day_24', 5)->nullable(); // 24-й день месяца
            $table->char('day_25', 5)->nullable(); // 25-й день месяца
            $table->char('day_26', 5)->nullable(); // 26-й день месяца
            $table->char('day_27', 5)->nullable(); // 27-й день месяца
            $table->char('day_28', 5)->nullable(); // 28-й день месяца
            $table->char('day_29', 5)->nullable(); // 29-й день месяца
            $table->char('day_30', 5)->nullable(); // 30-й день месяца
            $table->char('day_31', 5)->nullable(); // 31-й день месяца
            $table->foreign('personal_card_id')->references('id')->on('personal_cards');
            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('accrual_id')->references('id')->on('accruals');
            $table->foreign('hours_balance_classifier_id')->references('id')->on('hours_balance_classifiers');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('object_id')->references('id')->on('objects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_timesheets');
    }
}
