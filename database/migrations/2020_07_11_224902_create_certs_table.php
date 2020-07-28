<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certs', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id');
            $table->boolean('ubicacion')->default(false);
            $table->boolean('admin')->default(false);
            $table->boolean('tributario')->default(false);
            $table->boolean('telefonico')->default(false);
            $table->boolean('delivery')->default(false);
            $table->boolean('sanitario')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certs');
    }
}
