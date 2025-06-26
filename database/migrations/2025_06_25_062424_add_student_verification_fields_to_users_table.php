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
        Schema::table('users', function (Blueprint $table) {
            // Add new columns after the 'phone' column for organization
            $table->string('student_id')->nullable()->unique()->after('phone');
            $table->string('promotion_name')->nullable()->after('student_id');
            $table->string('group_name')->nullable()->after('promotion_name');
            $table->boolean('is_approved')->default(false)->after('group_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // This allows the migration to be safely undone
            $table->dropColumn(['student_id', 'promotion_name', 'group_name', 'is_approved']);
        });
    }
};