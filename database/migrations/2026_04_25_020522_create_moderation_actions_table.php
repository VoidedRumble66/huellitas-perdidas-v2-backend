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
        Schema::create('moderation_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moderator_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('target_type');
            $table->unsignedBigInteger('target_id');
            $table->string('action'); // expected: approve, reject, hide, restore, delete, suspend_user, ban_user, mark_as_fake, mark_as_duplicate, mark_as_scam_attempt, resolve_report, ignore_report
            $table->text('reason')->nullable();
            $table->string('previous_status')->nullable();
            $table->string('new_status')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['target_type', 'target_id']);
            $table->index('moderator_user_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderation_actions');
    }
};
