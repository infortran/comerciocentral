<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_id')->unsigned();
            $table->string('titulo', 50);
            $table->string('subtitulo', 50);
            $table->string('txt_boton');
            $table->string('img')->default('image.png');
            $table->string('img_pricing')->default('image.png');
            $table->string('logo')->default('navbar-brand.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slides');
    }
}
