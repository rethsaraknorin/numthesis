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
        Schema::table('events', function (Blueprint $table) {
            // Add new columns for the event feed
            $table->string('image_path')->nullable()->after('date');
            $table->text('description')->nullable()->after('title');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('id');

            // Drop the old 'type' column if it exists, as it's no longer needed.
            // This will prevent errors if the column is already gone.
            if (Schema::hasColumn('events', 'type')) {
                $table->dropColumn('type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['image_path', 'description', 'user_id']);

            // If we roll back, we should add the 'type' column back for consistency.
            if (!Schema::hasColumn('events', 'type')) {
                $table->string('type')->default('other');
            }
        });
    }
};
