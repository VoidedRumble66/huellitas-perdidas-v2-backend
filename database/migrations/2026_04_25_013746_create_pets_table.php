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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name')->nullable();
            $table->foreignId('species_id')->constrained()->restrictOnDelete();
            $table->foreignId('breed_id')->nullable()->constrained()->nullOnDelete();
            $table->string('sex')->default('unknown'); // expected: male, female, unknown
            $table->string('size')->default('unknown'); // expected: small, medium, large, extra_large, unknown
            $table->foreignId('main_color_id')->nullable()->constrained('colors')->nullOnDelete();
            $table->foreignId('secondary_color_id')->nullable()->constrained('colors')->nullOnDelete();
            $table->date('birth_date')->nullable();
            $table->string('approximate_age')->nullable();
            $table->text('distinctive_signs')->nullable();
            $table->boolean('sterilized')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['species_id', 'breed_id']);
            $table->index(['main_color_id', 'secondary_color_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
