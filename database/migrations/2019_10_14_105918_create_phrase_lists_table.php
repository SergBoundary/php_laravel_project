<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhraseListsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список формулировок для заполнения документов и форм 
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('phrase_lists', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('phrase_group_id')->unsigned(); // Код группы фраз
            $table->string('title', 100); // Текст фразы
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('phrase_group_id')->references('id')->on('phrase_list_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('phrase_lists');
    }
}