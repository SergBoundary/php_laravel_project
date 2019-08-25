<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations: Справочник. Список стран
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 50)->unique(); // Наименование страны
            $table->string('national_name', 50)->unique()->nullable(); // Национальное наименование страны
            $table->char('symbol_alfa2 ', 2)->nullable(); // Международный код страны (двухсимвольный)
            $table->char('symbol_alfa3', 3)->nullable(); // Международный код страны (трехсимвольный)
            $table->char('number_iso', 3)->nullable(); // Международный код страны (цифровой)
            $table->boolean('visible')->default(0); // Видимость наименования в списке
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
        Schema::dropIfExists('countries');
    }
}
