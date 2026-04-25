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
        Schema::create('post_adoption_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->unique()->constrained()->cascadeOnDelete();
            $table->boolean('vaccinated')->nullable();
            $table->text('vaccines_description')->nullable();
            $table->string('health_status')->nullable();
            $table->boolean('sterilized')->nullable();
            $table->text('adoption_requirements')->nullable();
            $table->decimal('adoption_fee', 10, 2)->nullable();
            $table->text('adoption_process_notes')->nullable();
            $table->boolean('good_with_children')->nullable();
            $table->boolean('good_with_dogs')->nullable();
            $table->boolean('good_with_cats')->nullable();
            $table->string('energy_level')->nullable(); // expected: low, medium, high, unknown
            $table->boolean('requires_yard')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_adoption_details');
    }
};
