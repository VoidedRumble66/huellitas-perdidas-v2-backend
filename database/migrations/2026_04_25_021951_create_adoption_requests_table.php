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
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('applicant_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('pending'); // pending, in_review, shortlisted, selected, approved, rejected, cancelled, completed
            $table->string('housing_type')->nullable(); // house, apartment, ranch, other, unknown
            $table->boolean('has_other_pets')->nullable();
            $table->text('other_pets_description')->nullable();
            $table->text('experience_with_pets')->nullable();
            $table->text('reason_for_adoption')->nullable();
            $table->string('responsible_adult_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('selected_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('post_id');
            $table->index('applicant_user_id');
            $table->index('status');
            $table->index('reviewed_by');
            $table->index('created_at');
            $table->unique(['post_id', 'applicant_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_requests');
    }
};
