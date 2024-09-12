<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('m4user')->unique();
            $table->string('nombre');
            $table->string('etiqueta');
            $table->string('persona');
            $table->string('email')->unique();
            $table->string('celular');
            $table->text('observaciones')->nullable();
            $table->timestamps(); // Auditoría de registro (created_at y updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
