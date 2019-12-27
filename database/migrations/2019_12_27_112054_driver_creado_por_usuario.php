<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DriverCreadoPorUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conductors', function (Blueprint $table) {
            $table->integer('usuario_crea_id')->default(0)->after('propio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conductors', function (Blueprint $table) {
            $table->dropColumn('usuario_crea_id');
        });
    }
}
