<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_articulos', function (Blueprint $table) {
            $table->id();
            $table->float('precio');
            $table->float('descuento');
            $table->date('fechafindescuento');
            $table->timestamps();
        });
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('unidad');
            $table->foreignId('detalle_articulos_id')->references('id')->on('detalle_articulos')->onDelete('cascade')->comment('el detalle del articulo');
            $table->foreignId('user_id')->references('id')->on('users')->comment('el usuario que oferta el articulo');
            $table->timestamps();
        });
        Schema::create('requesicions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elaborador_id')->references('id')->on('users')->comment('el usuario que realiza la requesicion');
            //estado y el aprobador seran modificados durante la aprovacion de la requesicion.
            $table->string('estado');
            $table->string('comentario');
            $table->bigInteger('aprobador_id');
            $table->timestamps();
        });
        Schema::create('linea_de_requesicions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_articulo');
            $table->string('unidad_articulo');
            $table->double('cantidad_articulo');
            $table->foreignId('requesicion_id')->references('id')->on('requesicions')->unsigned()->nullable()->comment('la requesicion a la que pertenecen');
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
        Schema::dropIfExists('detalle_articulos');
        Schema::dropIfExists('articulos');
    }
}
