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
        Schema::create('flower_transplantings', function (Blueprint $table) {
            $table->bigIncrements('TransplantingID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->bigInteger('TypeOfPlantingID')->unsigned();
            $table->date('DateOfTransplanting');
            $table->string('SizeOfPot');
            $table->timestamps();

            $table->foreign('FlowerID')->references('FlowerID')->on('flowers');
            $table->foreign('TypeOfPlantingID')->references('TypeOfPlantingID')->on('types_of_planting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_transplantings');
    }
};
