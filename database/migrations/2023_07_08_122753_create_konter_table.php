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
        Schema::create('konter', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('id_pemilik');
            $table->string('time_open')->nullable();
            $table->string('time_close')->nullable();
            $table->text('maps')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konter');
    }
};
