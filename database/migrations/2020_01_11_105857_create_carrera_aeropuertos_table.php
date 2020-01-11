<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraAeropuertosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_aeropuertos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('carrera_id');
            $table->integer('aerolinea_id')->nullable();
            $table->integer('vuelo_id')->nullable();
            $table->string('vuelo')->nullable();
            $table->string('lugar_arribo')->nullable();
            $table->integer('personas')->default(0);
            $table->boolean('factura')->default(0);
            $table->boolean('compartido')->default(0);
            $table->integer('maletas')->default(0);
            $table->boolean('sentido')->default(0);
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
        Schema::dropIfExists('carrera_aeropuertos');
    }
}
