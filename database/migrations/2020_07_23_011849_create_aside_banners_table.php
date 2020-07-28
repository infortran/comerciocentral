<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsideBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aside_banners', function (Blueprint $table) {
            $table->id();
            $table->integer('tienda_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->string('dscto');
            $table->string('btn');
            $table->string('color_princ_a');
            $table->string('color_princ_b');
            $table->string('color_sec_a');
            $table->string('color_sec_b');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aside_banners');
    }
}
