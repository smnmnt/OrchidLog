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
        Schema::create('flowers', function (Blueprint $table) {
            $table->bigIncrements('FlowerID');
            $table->string('FlowerName');
            $table->bigInteger('ShopID')->unsigned();
            $table->bigInteger('WateringRequirementID')->unsigned();
            $table->bigInteger('PlacementId')->unsigned();
            $table->date('DateOfBuying')->nullable();
            $table->string('Size')->nullable();
            $table->longText('FlowerNotes')->nullable();
            $table->timestamps();

            $table->foreign('ShopID')->references('ShopID')->on('shops');
            $table->foreign('WateringRequirementID')->references('WateringRequirementID')->on('watering_requirements');
            $table->foreign('PlacementId')->references('PlacementID')->on('placements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flowers');
    }
};
