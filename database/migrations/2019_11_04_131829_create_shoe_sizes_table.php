<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoeSizesTable extends Migration {

    /**
     * Run the migrations: Справочник. Список размеров обуви
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('shoe_sizes', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->char('region', 10); // Регион применения размера обуви
            $table->char('title', 10); // Номер размера обуви
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

        Schema::dropIfExists('shoe_sizes');
    }
}