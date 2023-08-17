<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_penjualan')->unsigned()->nullable();
            $table->bigInteger('id_retur_penjualan')->unsigned()->nullable();
            $table->double('bayar', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_penjualan')->references('id')->on('penjualan')->onDelete('cascade');
            $table->foreign('id_retur_penjualan')->references('id')->on('retur_penjualan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piutang');
    }
}
