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
        Schema::create('post_lost_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->unique()->constrained()->cascadeOnDelete();
            $table->dateTime('lost_at')->nullable();
            $table->text('last_seen_description')->nullable();
            $table->boolean('reward_offered')->default(false);
            $table->decimal('reward_amount', 10, 2)->nullable();
            $table->text('safe_contact_instructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_lost_details');
    }
};
