<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('structura');
            $table->string('name');
            $table->string('surname');
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('access')->default(1); // Уровень доступа
            $table->string('photo_url')->default('/img/no_photo.jpg'); // Фотография
            $table->char('language', 2); // Язык интерфейса
            $table->integer('package')->default(0); // Пакет услуг: 0 - бесплатный, 1 - платный минимальный, 2 - платный безлимитный
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
