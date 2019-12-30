<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('conductors', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('aerolineas', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('vuelos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('carreras', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('conductors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('aerolineas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('vuelos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('carreras', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
