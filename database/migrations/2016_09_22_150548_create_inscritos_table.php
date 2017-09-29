<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('inscritos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona')->unsigned();
            $table->integer('id_equipo')->unsigned();
            $table->enum('rh', ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB+', 'AB-']);
            $table->text('digital_documento')->nullable();
            $table->text('digital_eps')->nullable();
            $table->text('telefono');
            $table->text('email');
            
            $table->foreign('id_equipo')->references('id')->on('equipo');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::table('inscritos', function(Blueprint $table){
            $table->dropForeign(['id_equipo']);
        });

        Schema::drop('inscritos');
    }
}
