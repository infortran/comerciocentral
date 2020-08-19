<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id')->unsigned();
            $table->integer('number');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('telefono');
            $table->string('email');
            $table->text('cart');
            $table->integer('total');
            $table->integer('envio')->nullable();
            $table->string('estado')->default('pendiente');
            $table->string('tipo_pago');
            $table->string('entrega')->default('tienda');
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
        Schema::dropIfExists('ordens');
    }
}
