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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained();
            $table->foreignId('term_id')->constrained();
            $table->decimal('revenue', 10, 5);
            $table->timestamp('timestamp');
            $table->timestamps();

            // Indexes for faster queries
            $table->index('timestamp');
            $table->index(['campaign_id', 'timestamp']);
            $table->index(['campaign_id', 'term_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
