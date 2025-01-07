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
        Schema::create('flower_waterings', function (Blueprint $table) {
            $table->bigIncrements('WateringID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->bigInteger('FertilizerID')->unsigned();
            $table->string('FertilizerDoze')->nullable();
            $table->date('WateringDate');
            $table->timestamps();

            $table->foreign('FlowerID')->references('FlowerID')->on('flowers');
            $table->foreign('FertilizerID')->references('FertilizerID')->on('fertilizers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_waterings');
    }
};
