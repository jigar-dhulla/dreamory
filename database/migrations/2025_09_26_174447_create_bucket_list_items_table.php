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
        // Create bucket_list_items table with check constraint using raw SQL
        // SQLite doesn't support ALTER TABLE ADD CONSTRAINT
        DB::statement('
            CREATE TABLE bucket_list_items (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                category VARCHAR(50),
                priority TINYINT CHECK(priority >= 1 AND priority <= 5) DEFAULT 3,
                target_date DATE,
                is_completed BOOLEAN DEFAULT FALSE,
                completed_at TIMESTAMP NULL,
                linked_event_id INTEGER NULL,
                notes TEXT,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (linked_event_id) REFERENCES events(id) ON DELETE SET NULL
            )
        ');

        // Create indexes for performance
        DB::statement('CREATE INDEX bucket_list_items_category_index ON bucket_list_items (category)');
        DB::statement('CREATE INDEX bucket_list_items_completed_index ON bucket_list_items (is_completed)');
        DB::statement('CREATE INDEX bucket_list_items_priority_index ON bucket_list_items (priority)');
        DB::statement('CREATE INDEX bucket_list_items_target_date_index ON bucket_list_items (target_date)');
        DB::statement('CREATE INDEX bucket_list_items_linked_event_id_index ON bucket_list_items (linked_event_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bucket_list_items');
    }
};
