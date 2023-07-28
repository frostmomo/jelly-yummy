<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_jual', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori_jual')->unsigned()->nullable();
            $table->string('nama_produk_jual')->nullable();
            $table->string('kode_produk_jual')->nullable();
            $table->double('harga_produksi', 12, 2)->nullable();
            $table->double('harga_jual', 12, 2)->nullable();
            $table->integer('stok')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori_jual')->references('id')->on('kategori_jual')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_jual');
    }
}
