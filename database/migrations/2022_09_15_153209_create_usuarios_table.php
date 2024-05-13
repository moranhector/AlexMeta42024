<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre');
            $table->string('apellido_nombre');
            $table->string('nombre_usuario');
            $table->string('mail');
            $table->string('numero_cuit');
            $table->string('codigo_reparticion');
            $table->string('nombre_reparticion');
            $table->string('codigo_sector_interno');
            $table->string('cargo');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
