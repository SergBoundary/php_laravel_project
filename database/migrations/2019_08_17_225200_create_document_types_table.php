<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список видов документов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 80)->unique(); // Наименование документа
            $table->string('abbr', 10)->unique(); // Абривиатура документа
            $table->boolean('standart_status'); // Стандартный документ: 0 - нет; 1 - да
            $table->string('standart_number', 10)->unique(); // Неизменная часть номера документа (??? >0 для внутренних документов)
            $table->string('template_form', 50); // Наименование и размещение формы ввода данных
            $table->string('template_view', 100); // Наименование и размещение view-шаблона документа
            $table->string('template_print', 100); // Наименование и размещение pdf-шаблона документа
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_types');
    }
}
