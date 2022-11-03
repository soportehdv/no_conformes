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
            $table->date('fReporte');
            $table->string('proceso');
            $table->string('reportado');
            $table->string('descripcion');
            $table->string('correccion');
            $table->date('fCorreccion');
            $table->string('reportante');
            $table->string('accion');
            $table->string('nDueñoP');
            $table->string('fDueñoP');
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
