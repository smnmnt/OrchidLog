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
        Schema::create('aqua_tests', function (Blueprint $table) {
            $table->id();
            $table->string('source_type')->default('aquarium');
            $table->string('source_name')->nullable();
            $table->foreignId('aquarium_id')->nullable()->constrained('aquariums')->cascadeOnDelete();
            $table->dateTime('tested_at');
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->index(['source_type', 'aquarium_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aqua_tests');
    }
};
