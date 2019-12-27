<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_vehiculo');
            $table->decimal('precio_simple',6,2)->default(18);
            $table->decimal('precio_compartido',6,2)->default(18);
            $table->decimal('comision_simple',6,2)->default(2);
            $table->decimal('comision_compartido',6,2)->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_vehiculos');
    }
}
