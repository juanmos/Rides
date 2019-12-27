<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('estado_id');
            $table->integer('usuario_id');
            $table->integer('forma_pago_id');
            $table->string('nombre');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('aerolinea_id')->nullable();
            $table->integer('vuelo_id')->nullable();
            $table->string('vuelo')->nullable();
            $table->string('lugar_arribo')->nullable();
            $table->integer('personas')->default(1);
            $table->string('destino')->nullable(0);
            $table->decimal('latitud',16,10)->default(0);
            $table->decimal('longitud',16,10)->default(0);
            $table->decimal('costo',6,2)->default(10);
            $table->decimal('comision',6,2)->default(1);
            $table->boolean('factura')->default(0);
            $table->boolean('compartido')->default(1);
            $table->integer('maletas')->default(1);
            $table->boolean('sentido')->default(0);
            $table->integer('calificacion')->default(0);
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
        Schema::dropIfExists('carreras');
    }
}
