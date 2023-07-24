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
            $table->bigInteger('id_supplier')->unsigned()->nullable();
            $table->bigInteger('id_produk_beli')->unsigned()->nullable();
            $table->double('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('id_supplier')->references('id')->on('supplier')->onDelete('cascade');
            $table->foreign('id_produk_beli')->references('id')->on('produk_beli')->onDelete('cascade');
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
