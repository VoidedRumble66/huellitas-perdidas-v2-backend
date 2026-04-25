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
        Schema::create('user_acquisition_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('marketing_campaign_id')->nullable()->constrained()->nullOnDelete();
            $table->string('source')->nullable();
            $table->string('medium')->nullable();
            $table->string('campaign')->nullable();
            $table->string('referrer_url')->nullable();
            $table->string('landing_path')->nullable();
            $table->timestamp('acquired_at')->useCurrent();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['source', 'medium']);
            $table->index('acquired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_acquisition_sources');
    }
};
