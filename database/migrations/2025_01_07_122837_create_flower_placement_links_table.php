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
        Schema::create('flower_placement_links', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->bigInteger('PlacementID')->unsigned();
            $table->timestamps();
            $table->foreign('FlowerID')->references('ID')->on('flowers');
            $table->foreign('PlacementID')->references('ID')->on('placements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_placement_links');
    }
};
