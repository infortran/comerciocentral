<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->string('nombre');
            $table->string('titulo');
            $table->string('subtitulo');
            $table->string('texto');
            $table->string('dscto');
            $table->string('txt_btn');
            $table->string('color_a1');
            $table->string('color_a2');
            $table->string('color_b1');
            $table->string('color_b2');
            $table->string('color_dscto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
