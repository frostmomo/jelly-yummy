<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_penjualan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_customer')->unsigned()->nullable();
            $table->bigInteger('id_produk_jual')->unsigned()->nullable();
            $table->double('subtotal', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('id_produk_jual')->references('id')->on('produk_jual')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retur_penjualan');
    }
}
