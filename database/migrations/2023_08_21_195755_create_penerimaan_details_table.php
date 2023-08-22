<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_penerimaan')->unsigned()->nullable();
            $table->bigInteger('id_akun')->unsigned()->nullable();
            $table->string('keterangan')->nullable();
            $table->double('total', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_penerimaan')->references('id')->on('penerimaan')->onDelete('cascade');
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
        Schema::dropIfExists('penerimaan_detail');
    }
}
