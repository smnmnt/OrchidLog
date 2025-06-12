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
//        TOPID - type of planting (id)
//        DOT   - date of transplanting
//        SOP   - size of the pot
        Schema::create('flower_transplantings', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->bigInteger('TOPID')->unsigned()->nullable();
            $table->date('DOT')->nullable();
            $table->string('SOP')->nullable();
            $table->timestamps();

            $table->foreign('FlowerID')->references('ID')->on('flowers');
            $table->foreign('TOPID')->references('ID')->on('types_of_planting');
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
