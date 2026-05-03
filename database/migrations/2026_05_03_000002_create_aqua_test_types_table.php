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
        Schema::create('aqua_test_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('unit')->nullable();
            $table->string('kind')->default('measured');
            $table->string('calculator')->nullable();
            $table->boolean('is_user_editable')->default(true);
            $table->decimal('value_min', 8, 2)->nullable();
            $table->decimal('value_max', 8, 2)->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aqua_test_types');
    }
};
