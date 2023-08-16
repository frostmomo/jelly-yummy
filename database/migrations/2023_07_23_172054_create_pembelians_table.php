<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_supplier')->unsigned()->nullable();
            $table->integer('total_item')->nullable();
            $table->double('subtotal', 12, 2)->nullable();
            $table->integer('diskon')->nullable()->default(0);
            $table->double('bayar', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_supplier')->references('id')->on('supplier')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
