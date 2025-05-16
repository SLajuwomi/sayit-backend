<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT

            // Foreign key for the Topic
            $table->foreignId('topic_id')
                ->constrained('topics') // Assumes 'topics' table and 'id' column
                ->onDelete('cascade');  // Optional: if a topic is deleted, delete its messages

            // Foreign key for the User (author)
            $table->foreignId('user_id')
                ->constrained('users')  // Assumes 'users' table and 'id' column
                ->onDelete('cascade'); // Optional: if a user is deleted, delete their messages

            $table->text('body'); // TEXT, NOT NULL (for message content, max 500 chars enforced by app logic)
            $table->timestamps(); // created_at and updated_at TIMESTAMPS, NULLABLE

            // Index for efficient retrieval of messages per topic, ordered by time
            $table->index(['topic_id', 'created_at'], 'messages_topic_id_created_at_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};