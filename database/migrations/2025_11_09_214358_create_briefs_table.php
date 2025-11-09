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
        Schema::create('briefs', function (Blueprint $table) {
            $table->id();

            // Link to user (foreign key)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Core brief fields
            $table->string('title');
            $table->text('content');

            // Optional file attachment (like a doc, image, etc.)
            $table->string('attachment_path')->nullable();

            // AI-generated fields (optional for later)
            $table->json('ai_responses')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('briefs');
    }
};
