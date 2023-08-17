<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->bigInteger('id_customer')->unsigned()->nullable();
            $table->bigInteger('id_salesman')->unsigned()->nullable();
            $table->integer('total_item')->nullable();
            $table->double('subtotal', 12, 2)->nullable();
            $table->integer('diskon')->nullable()->default(0);
            $table->double('tunai', 12, 2)->nullable()->default(0);
            $table->string('keterangan_penjualan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_customer')->references('id')->on('customer')->onDelete('set null');
            $table->foreign('id_salesman')->references('id')->on('salesman')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
