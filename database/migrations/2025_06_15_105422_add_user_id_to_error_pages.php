<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Clear existing data to avoid foreign key constraint issues
        DB::table('error_pages')->truncate();

        Schema::table('error_pages', function (Blueprint $table) {
            // Only add user_id column if it doesn't exist
            if (!Schema::hasColumn('error_pages', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
                $table->index('user_id'); // Index for better performance
            } else {
                // Column exists but might not have foreign key constraint
                // Drop and recreate the foreign key constraint if needed
                try {
                    $table->dropForeign(['user_id']);
                } catch (Exception $e) {
                    // Foreign key might not exist, continue
                }
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->index('user_id'); // Ensure index exists
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('error_pages', function (Blueprint $table) {
            if (Schema::hasColumn('error_pages', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
