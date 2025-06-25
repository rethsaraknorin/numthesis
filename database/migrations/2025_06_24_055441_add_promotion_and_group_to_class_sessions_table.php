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
        Schema::table('class_sessions', function (Blueprint $table) {
            // Add new columns after the 'year' column
            $table->string('promotion_name')->after('year');
            $table->string('group_name')->after('promotion_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_sessions', function (Blueprint $table) {
            // This allows the migration to be undone
            $table->dropColumn(['promotion_name', 'group_name']);
        });
    }
};