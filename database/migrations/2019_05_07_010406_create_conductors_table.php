<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('placa')->nullable();
            $table->string('color')->nullable();
            $table->integer('capacidad')->default(3);
            $table->integer('tipo_vehiculo_id')->default(1);
            $table->integer('ano')->default(2019);
            $table->decimal('saldo',10,2)->default(0);
            $table->decimal('calificacion',2,1)->default(5);
            $table->boolean('propio')->default(1);
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
        Schema::dropIfExists('conductors');
    }
}
