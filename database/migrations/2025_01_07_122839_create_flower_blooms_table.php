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
//        BB - bloom begins
//        BE - bloom ends
        Schema::create('flower_blooms', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('FlowerID')->unsigned();
            $table->date('BB');
            $table->date('BE')->nullable();
            $table->boolean('peduncle')->default(true)->comment('0 - old, 1 - new');
            $table->timestamps();
            $table->foreign('FlowerID')->references('ID')->on('flowers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_blooms');
    }
};
