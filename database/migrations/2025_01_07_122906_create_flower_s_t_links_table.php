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
//        TPID - transplanting id
        Schema::create('flower_s_t_links', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('TPID')->unsigned();
            $table->bigInteger('SoilID')->unsigned();
            $table->timestamps();

            $table->foreign('TPID')->references('ID')->on('flower_transplantings');
            $table->foreign('SoilID')->references('ID')->on('soils');
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
