<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cert_data', function (Blueprint $table) {
            $table->id();
            $table->integer('cert_id');
            $table->string('img_ubicacion')->default('image.png');
            $table->string('nombre_admin')->nullable();
            $table->string('run_admin')->nullable();
            $table->string('img_admin')->default('avatar.png');
            $table->string('rut_tributario')->nullable();
            $table->dateTime('hora_inicio_tel')->nullable();
            $table->dateTime('hora_fin_tel')->nullable();
            $table->string('res_sanitaria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cert_datas');
    }
}
