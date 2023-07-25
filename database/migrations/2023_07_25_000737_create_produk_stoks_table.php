<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_konter');
            $table->foreignId('id_produk');
            $table->string('stok');
            $table->boolean('type')->default(0);
            $table->timestamps();

            $table->foreign('id_konter')->references('id')->on('konter');
            $table->foreign('id_produk')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_stoks');
    }
};
