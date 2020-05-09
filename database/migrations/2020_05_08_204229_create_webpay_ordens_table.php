<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpay_ordens', function (Blueprint $table) {
            $table->id();
            $table->integer('id_orden')->unsigned();
            $table->string('session_id');
            $table->string('card_number');
            $table->string('accounting_date');
            $table->string('transaction_date');
            $table->string('authorization_code');
            $table->integer('amount');
            $table->integer('shares_number');
            $table->string('commerce_code');
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
        Schema::dropIfExists('webpay_ordens');
    }
}
