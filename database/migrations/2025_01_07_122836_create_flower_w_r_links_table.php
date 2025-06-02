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
//        wrid - watering reqs id
        Schema::create('flower_w_r_links', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->bigInteger('WRID')->unsigned();
            $table->timestamps();
            $table->foreign('FlowerID')->references('ID')->on('flowers');
            $table->foreign('WRID')->references('ID')->on('watering_requirements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_w_r_links');
    }
};
