<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            //Campo relacional
            $table->bigInteger('user_id')->unsigned();
            //Titulo del post
            $table->string('title');
            //Imagen del post
            $table->string('image')->nullable();
            //Slug para el titulo
            $table->string('slug')->unique();
            //Cuerpo del post
            $table->text('body');
            //Contenido multimedia
            $table->text('iframe')->nullable();
            $table->timestamps();

            //Habilitamos softDeletes para borrado lógico
            $table->softDeletes();

            //Configuracion de la relacion
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
