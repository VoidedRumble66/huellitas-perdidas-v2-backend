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
        Schema::create('user_reputation_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->integer('score')->default(0);
            $table->string('level')->default('bronze');
            $table->unsignedInteger('posts_created_count')->default(0);
            $table->unsignedInteger('helpful_reports_count')->default(0);
            $table->unsignedInteger('resolved_cases_count')->default(0);
            $table->timestamp('last_calculated_at')->nullable();
            $table->timestamps();

            $table->index('score');
            $table->index('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reputation_summaries');
    }
};
