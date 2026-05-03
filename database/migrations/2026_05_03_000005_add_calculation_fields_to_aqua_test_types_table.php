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
        Schema::table('aqua_test_types', function (Blueprint $table) {
            $table->string('kind')->default('measured')->after('unit');
            $table->string('calculator')->nullable()->after('kind');
            $table->boolean('is_user_editable')->default(true)->after('calculator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aqua_test_types', function (Blueprint $table) {
            $table->dropColumn([
                'kind',
                'calculator',
                'is_user_editable',
            ]);
        });
    }
};
