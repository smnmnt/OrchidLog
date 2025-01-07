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
        Schema::create('flower_s_t_links', function (Blueprint $table) {
            $table->bigIncrements('STLinkID');
            $table->bigInteger('TransplantingID')->unsigned();
            $table->bigInteger('SoilID')->unsigned();
            $table->timestamps();

            $table->foreign('TransplantingID')->references('TransplantingID')->on('flower_transplantings');
            $table->foreign('SoilID')->references('SoilID')->on('soils');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_s_t_links');
    }
};
