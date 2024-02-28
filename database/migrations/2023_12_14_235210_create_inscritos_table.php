<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscrito', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcurso');
            $table->integer('idalumno');
            $table->integer('idmaestro')->nullable();
            $table->integer('calificacion')->nullable();

            $table->string('namecurso');
            $table->string('namealumno');
            $table->string('namemaestro')->nullable();
            $table->string('namecarrera')->nullable();
            $table->string('periodo')->nullable();
            $table->string('asistencia')->nullable();
          
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
        Schema::dropIfExists('inscritos');
    }
}
