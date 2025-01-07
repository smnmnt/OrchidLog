<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flower_blooms', function (Blueprint $table) {
            $table->bigIncrements('FlowerBloomID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->date('BloomDate_Beginning');
            $table->date('BloomDate_Ending')->nullable();
            $table->timestamps();
            $table->foreign('FlowerID')->references('FlowerID')->on('flowers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_blooms');
    }
};
