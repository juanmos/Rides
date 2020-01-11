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
            $table->integer('empresa_id');
            $table->integer('estado_id')->default(1);
            $table->integer('usuario_id');
            $table->integer('conductor_id')->nullable();
            $table->integer('forma_pago_id');
            $table->date('fecha');
            $table->time('hora');
            $table->string('direccion')->nullable()->after('personas');
            $table->string('referencia')->nullable()->after('direccion');
            $table->string('destino')->nullable();
            $table->integer('ciudad_id')->default(1);
            $table->decimal('latitud',16,10)->default(0);
            $table->decimal('longitud',16,10)->default(0);
            $table->decimal('latitud_destino',16,10)->default(0);
            $table->decimal('longitud_destino',16,10)->default(0);
            $table->decimal('costo',6,2)->default(0);
            $table->decimal('comision',6,2)->default(0);
            $table->integer('calificacion_usuario')->default(0);
            $table->integer('calificacion_conductor')->default(0);
            $table->dateTime('hora_aceptacion')->nullable();
            $table->dateTime('hora_llegada')->nullable();
            $table->dateTime('hora_abordaje')->nullable();
            $table->dateTime('hora_terminacion')->nullable();
            $table->dateTime('hora_cancelacion')->nullable();
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
