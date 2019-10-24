<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRecipientsTable extends Migration {

    /**
     * Run the migrations: Справочник. Список получателей подоходного налога
     *
     * @author SeBo
     *
     * @return void
     */
    public function up() {

        Schema::create('tax_recipients', function (Blueprint $table) {
            $table->increments('id'); // ID записи
            $table->integer('country_id')->unsigned(); // Код страны
            $table->integer('district_id')->unsigned(); // Код области
            $table->integer('region_id')->unsigned()->nullable(); // Код района
            $table->integer('city_id')->unsigned()->nullable(); // Код города
            $table->string('title', 100)->unique(); // Название получателя подоходного налога
            $table->timestamps(); // Поля с датой создания и датой изменения записи
            $table->softDeletes(); // Поле с датой удаления (исключения) записи из обслуживания

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('tax_recipients');
    }
}