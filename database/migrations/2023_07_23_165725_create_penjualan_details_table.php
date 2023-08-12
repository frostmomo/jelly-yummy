<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_penjualan')->unsigned()->nullable();
            $table->bigInteger('id_produk_jual')->unsigned()->nullable();
            $table->integer('qty')->nullable();
            $table->double('total', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_penjualan')->references('id')->on('penjualan')->onDelete('set null');
            $table->foreign('id_produk_jual')->references('id')->on('produk_jual')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_detail');
    }
}
