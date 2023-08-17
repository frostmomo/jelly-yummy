<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_pembelian', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pembelian')->unsigned()->nullable();
            $table->bigInteger('id_supplier')->unsigned()->nullable();
            $table->bigInteger('id_produk_beli')->unsigned()->nullable();
            $table->integer('qty')->nullable();
            $table->double('subtotal', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_pembelian')->references('id')->on('pembelian')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id')->on('supplier')->onDelete('set null');
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
        Schema::dropIfExists('retur_pembelian');
    }
}
