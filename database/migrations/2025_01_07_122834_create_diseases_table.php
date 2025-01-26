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
//        mot - method of treatment
        Schema::create('diseases', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('Name');
            $table->longText('Desc')->nullable();
            $table->longText('MOT')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};
