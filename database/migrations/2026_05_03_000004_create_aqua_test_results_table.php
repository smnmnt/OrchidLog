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
        Schema::create('aqua_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('aqua_tests')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('aqua_test_types')->cascadeOnDelete();
            $table->decimal('value', 8, 2);
            $table->timestamps();

            $table->unique(['test_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aqua_test_results');
    }
};
