<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VuelosDias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->boolean('lunes')->default(0);
            $table->boolean('martes')->default(0);
            $table->boolean('miercoles')->default(0);
            $table->boolean('jueves')->default(0);
            $table->boolean('viernes')->default(0);
            $table->boolean('sabado')->default(0);
            $table->boolean('domingo')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vuelos', function (Blueprint $table) {
            $table->dropColumn('lunes');
            $table->dropColumn('martes');
            $table->dropColumn('miercoles');
            $table->dropColumn('jueves');
            $table->dropColumn('viernes');
            $table->dropColumn('sabado');
            $table->dropColumn('domingo');
        });
    }
}
