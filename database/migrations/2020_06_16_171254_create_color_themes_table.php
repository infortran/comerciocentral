<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_themes', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id')->unsigned();
            $table->string('primario',20);
            $table->string('secundario', 20);
            $table->string('background', 20);
            $table->string('texto', 20);
            $table->string('texto_claro', 20);
            $table->string('texto_btn', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_themes');
    }
}
