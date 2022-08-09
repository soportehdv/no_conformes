<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();

            $table->string('serial');
            $table->integer('estado_id')->unsigned();
            $table->string('estado_ubi')->nullable()->default("Bodega");
            $table->integer('unidades');
            $table->integer('uni');
            $table->string('elemento');
            $table->string('caracteristicas');
            $table->decimal('ancho',5,2);
            $table->decimal('largo',5,2);
            $table->string('color');
            $table->string('tela');

            $table->integer('status');//activo o inactivo



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
        Schema::dropIfExists('compras');
    }
}
