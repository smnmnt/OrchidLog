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
//        GroupID - flower watering group id
        Schema::create('flower_waterings', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('TypeID')->unsigned()->nullable();
            $table->bigInteger('GroupID')->unsigned()->nullable();
            $table->bigInteger('FertilizerID')->unsigned()->nullable();
            $table->string('FertilizerDoze')->nullable();
            $table->date('WateringDate');
            $table->timestamps();

            $table->foreign('TypeID')->references('ID')->on('watering_types_of');
            $table->foreign('GroupID')->references('ID')->on('watering_groups');
            $table->foreign('FertilizerID')->references('ID')->on('fertilizers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower_waterings');
    }
};
