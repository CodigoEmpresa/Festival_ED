<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('validacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_localidad')->unsigned();
            $table->integer('id_modalidad')->unsigned();
            $table->integer('cantidad')->unsigned();

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
        Schema::table('validacion', function(Blueprint $table){
            $table->dropForeign(['id_modalidad']);
        });

        Schema::drop('validacion');
    }
}
