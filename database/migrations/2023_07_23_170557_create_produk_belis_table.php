<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_beli', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori_beli')->unsigned()->nullable();
            $table->string('nama_produk_beli')->nullable();
            $table->string('kode_produk_beli')->nullable();
            $table->double('harga_beli', 12, 2)->nullable();
            $table->integer('stok')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori_beli')->references('id')->on('kategori_beli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_beli');
    }
}
