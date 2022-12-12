<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNconformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nconformes', function (Blueprint $table) {
            $table->id();
            $table->string('reportado');
            $table->datetime('fReporte');
            $table->string('proceso');
            $table->foreignId('nCproceso')->constrained;
            $table->string('nCdescripcion');
            $table->string('nCacciones');
            $table->string('accion');
            $table->string('status')->default('1');
            $table->integer('imagen');
            $table->integer('asignado');
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
        Schema::dropIfExists('nconformes');
    }
}
