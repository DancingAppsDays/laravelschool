<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('fechadeinicio')->nullable();
            $table->date('fechadefinal')->nullable();

            $table->string('namecarrera')->nullable();
            $table->string('periodo')->nullable();
            $table->integer('idmaestro')->nullable();
            $table->string('namemaestro')->nullable();
            
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
        Schema::dropIfExists('cursos');
    }
}
