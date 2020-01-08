<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->decimal('costo', 10, 2)->default(0);
            $table->boolean('activo')->default(1);
            $table->integer('ciudad_id')->default(1);
            $table->boolean('pruebas')->default(0);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin_pruebas')->nullable();
            $table->integer('usuarios_permitidos')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('empresas');
    }
}
