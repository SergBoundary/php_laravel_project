<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvisionsTable extends Migration
{
    /**
     * Run the migrations: Таблица учета материального обеспечения работника
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisions', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('document_id')->unsigned(); // Код кадрового документа
            $table->integer('manning_order_id')->unsigned(); // Код назначения работника
            $table->timestamp('date_from'); // Дата начала пользования
            $table->timestamp('date_to'); // Дата окончания пользования
            $table->float('amount', 8,2); // Сумма или стоимость выдаваемых материальных средств
            $table->string('rationale_title', 100); // Обоснование для выписки накладной
            $table->timestamp('provision_date'); // Дата выдачи работнику
            $table->timestamp('return_date'); // Дата возврата работником
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
            
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('manning_order_id')->references('id')->on('manning_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provisions');
    }
}
