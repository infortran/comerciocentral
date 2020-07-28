<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_banners', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->string('titulo')->default('Productos');
            $table->string('txt1')->default('texto');
            $table->string('txt2')->default('texto');
            $table->string('btn')->default('Comprar');
            $table->string('dscto')->default('OFERTA');
            $table->string('color_bg_a1')->default('#FFFFFF');
            $table->string('color_bg_a2')->default('#FFFFFF');
            $table->string('color_bg_b1')->default('#FFFFFF');
            $table->string('color_bg_b2')->default('#FFFFFF');
            $table->string('color_titulo')->default('#FFFFFF');
            $table->string('color_texto')->default('#FFFFFF');
            $table->string('img')->default('logo.jpg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_banners');
    }
}
