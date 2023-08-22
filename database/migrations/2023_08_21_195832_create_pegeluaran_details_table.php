<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegeluaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegeluaran_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pengeluaran')->unsigned()->nullable();
            $table->bigInteger('id_akun')->unsigned()->nullable();
            $table->string('keterangan')->nullable();
            $table->double('total', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_pengeluaran')->references('id')->on('pengeluaran')->onDelete('cascade');
            $table->foreign('id_akun')->references('id')->on('akun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegeluaran_detail');
    }
}
