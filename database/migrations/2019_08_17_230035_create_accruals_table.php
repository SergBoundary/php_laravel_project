<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccrualsTable extends Migration
{
    /**
     * Run the migrations: Справочник. Классификатор начислений
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accruals', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('accrual_group_id')->unsigned(); // Код группы видов начислений
            $table->char('title', 10)->unique(); // ??? Код начисления (для < 500) и удержаний (для>500)
            $table->tinyInteger('direction'); // Направление операции: 1 - начисление; 2 - удержание
            $table->string('description', 50)->unique(); // Наименование начисления/удержания
            $table->char('description_abbr', 10); // Сокращенное наименование начисления/удержания
            $table->string('description_1с', 100)->nullable(); // 1С-наименование начисления/удержания
            $table->integer('algorithm_id')->unsigned(); // Алгоритм разработанных начислений/удержаний
            $table->float('accrual_sum', 8,2); // Количество для начисления по виду
            $table->tinyInteger('income_number_8dr'); // Номер дохода в 8-ДР для начислений (признак удержания: 1 - получено для 8-ДР, 2-налог подоходн, 3- взносы в фонды и т.д.)
            $table->smallInteger('calculation_number'); // Порядковый номер расчета
            $table->float('accrual_amount', 8,2); // Сумма по виду начисления
            $table->integer('accrual_analytics'); // Аналитический учет для начисления
            $table->integer('rounded amount'); // Предел округления суммы перед вычислением
            $table->integer('rounded result'); // Предел округления результата
            $table->char('account_title', 10); // Номер бухгалтерского счета
            $table->integer('object_id')->unsigned(); // Код объекта
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('accrual_group_id')->references('id')->on('accrual_groups');
            $table->foreign('algorithm_id')->references('id')->on('algorithms');
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
        Schema::dropIfExists('accruals');
    }
}
