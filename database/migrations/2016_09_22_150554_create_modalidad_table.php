<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModalidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('modalidad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_deporte')->unsigned();
            $table->string('nombre');

            $table->foreign('id_deporte')->references('id')->on('deporte');           
        });

        schema::table('categoria', function(Blueprint $table){
            $table->foreign('id_modalidad')->references('id')->on('modalidad');
        });

        schema::table('equipo', function(Blueprint $table){
            $table->foreign('id_modalidad')->references('id')->on('modalidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipo', function(Blueprint $table){
            $table->dropForeign(['id_modalidad']);
        });

        Schema::table('categoria', function(Blueprint $table){
            $table->dropForeign(['id_modalidad']);
        });

        Schema::table('modalidad', function(Blueprint $table){
            $table->dropForeign(['id_deporte']);
        });

        Schema::drop('modalidad');
    }
}
