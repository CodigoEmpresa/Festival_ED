<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_deporte')->unsigned();
            $table->integer('id_modalidad')->unsigned();
            $table->integer('id_categoria')->unsigned();
            $table->string('nombre_equipo');
            $table->string('programa');
            $table->enum('genero',['Masculino', 'Femenino', 'Mixto']);
            $table->integer('id_localidad');
            $table->integer('id_upz');
            $table->string('id_barrio',60);
            $table->string('delegado',60);
            $table->string('direccion',50);
            $table->string('telefono',20);
            $table->string('email',60);
            $table->text('pdf');

            $table->foreign('id_deporte')->references('id')->on('deporte');
            $table->foreign('id_categoria')->references('id')->on('categoria');
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
            $table->dropForeign(['id_deporte']);
            $table->dropForeign(['id_categoria']);
        });

        Schema::drop('equipo');
    }
}
