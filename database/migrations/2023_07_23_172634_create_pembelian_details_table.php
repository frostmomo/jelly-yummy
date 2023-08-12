<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pembelian')->unsigned()->nullable();
            $table->bigInteger('id_produk_beli')->unsigned()->nullable();
            $table->integer('qty')->nullable();
            $table->double('total', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_pembelian')->references('id')->on('pembelian')->onDelete('set null');
            $table->foreign('id_produk_beli')->references('id')->on('produk_beli')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_detail');
    }
}
