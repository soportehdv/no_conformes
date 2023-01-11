<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id')->comment('llave foranea autoincremento');
            $table->string('nombre')->comment('nombre archivo');
            $table->string('ruta')->comment('ruta del archivo');
            $table->string('mime')->comment('tipo archivo');
            $table->string('extension')->comment('extencion');
            $table->string('size')->comment('tamaño archivo');
            $table->string('aDescripcion')->comment('descripcion');
            $table->integer('noConforme')->comment('foranea')->nullable();



            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
