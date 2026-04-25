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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('pet_id')->nullable()->constrained()->nullOnDelete();
            $table->string('post_type'); // expected: lost, found, adoption, care_tip, alert
            $table->string('status')->default('draft'); // expected: draft, pending_review, published, rejected, paused, resolved, archived, deleted
            $table->string('visibility')->default('public'); // expected: public, private, hidden
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->string('contact_method')->default('platform'); // expected: platform, whatsapp, phone, hidden
            $table->string('contact_phone')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('post_type');
            $table->index('status');
            $table->index('visibility');
            $table->index('published_at');
            $table->index('created_at');
            $table->index(['post_type', 'status', 'visibility']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
