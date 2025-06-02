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
        Schema::create('flower_disease_links', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->bigInteger('DiseaseID')->unsigned();
            $table->timestamps();

            $table->foreign('FlowerID')->references('ID')->on('flowers');
            $table->foreign('DiseaseID')->references('ID')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_disease_links');
    }
};
