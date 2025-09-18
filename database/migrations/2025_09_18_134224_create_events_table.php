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
        // Create events table with check constraint using raw SQL
        // SQLite doesn't support ALTER TABLE ADD CONSTRAINT
        DB::statement('
            CREATE TABLE events (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name VARCHAR(255) NOT NULL,
                category VARCHAR(50),
                location VARCHAR(255),
                date_attended DATE,
                overall_rating TINYINT CHECK(overall_rating >= 1 AND overall_rating <= 5),
                photo_path VARCHAR(500),
                notes TEXT,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
            )
        ');

        // Create indexes
        DB::statement('CREATE INDEX events_name_index ON events (name)');
        DB::statement('CREATE INDEX events_category_index ON events (category)');
        DB::statement('CREATE INDEX events_date_attended_index ON events (date_attended)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
