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
        Schema::create('topics', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT
            $table->string('name', 100)->unique(); // VARCHAR(100), NOT NULL, UNIQUE
            $table->timestamps(); // created_at and updated_at TIMESTAMPS, NULLABLE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};