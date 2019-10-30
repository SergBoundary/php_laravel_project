<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhraseListGroupsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список групп формулировок для заполнения документов и форм 
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('phrase_list_groups', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->string('title', 30)->unique(); // Наименование группы фраз
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

        Schema::dropIfExists('phrase_list_groups');
    }
}