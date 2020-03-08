<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterfaceTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interface_titles', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('view'); // Представление
            $table->string('de')->nullable(); // Немецкий язык
            $table->string('en'); // Английский язык
            $table->string('sp')->nullable(); // Испанский язык
            $table->string('fr')->nullable(); // Французский язык
            $table->string('it')->nullable(); // Итальянский язык
            $table->string('pl'); // Польский язык
            $table->string('pt')->nullable(); // Португальский язык
            $table->string('ru'); // Русский язык
            $table->string('ua'); // Украинский язык
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
        Schema::dropIfExists('interface_titles');
    }
}
