<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id')->unsigned();
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('precio');
            $table->string('img');
            $table->integer('categoria_id')->unsigned()->default(0);
            $table->integer('marca_id')->unsigned()->default(0);
            $table->timestamps();
            $table->boolean('is_available')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
