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
        Schema::create('share_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->string('channel')->default('copy_link');
            $table->string('platform')->nullable();
            $table->timestamp('shared_at')->useCurrent();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index('channel');
            $table->index('platform');
            $table->index('shared_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_events');
    }
};
