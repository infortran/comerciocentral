<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_infos', function (Blueprint $table) {
            $table->id();
            $table->string('info')->default('Soy la leyenda del footer');
            $table->string('direccion')->default('direccion calle #333, Ciudad, Pais.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_infos');
    }
}
