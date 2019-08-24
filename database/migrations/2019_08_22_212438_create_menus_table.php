<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('parent_id')->unsigned()->default(0); // Код меню верхнего уровня: 0 - "гостевая страница" с роутом "/"
            $table->tinyInteger('sort')->default(0); // Порядок сортировки пунктов меню
            $table->string('name', 100); // Название пункта меню
            $table->string('url', 50)->nullable(); // Путь к представлению
            $table->boolean('access_0'); // Право доступа уровня 0 (администратор)
            $table->boolean('access_1'); // Право доступа уровня 1 (руководитель)
            $table->boolean('access_2'); // Право доступа уровня 2 (специалист)
            $table->boolean('access_3'); // Право доступа уровня 3 (работник)
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
        Schema::dropIfExists('menus');
    }
}
