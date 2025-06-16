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
        Schema::table('programs', function (Blueprint $table) {
            // Add columns for pricing after the 'description' column
            $table->decimal('price_per_year', 8, 2)->nullable()->after('description');
            $table->decimal('price_per_semester', 8, 2)->nullable()->after('price_per_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['price_per_year', 'price_per_semester']);
        });
    }
};