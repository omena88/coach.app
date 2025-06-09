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
        Schema::create('commitments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('coaching_sessions')->onDelete('cascade');
            $table->text('description');
            $table->date('due_date');
            $table->enum('status', ['pending', 'fulfilled', 'unfulfilled'])->default('pending');
            $table->text('evaluation_coach')->nullable();
            $table->text('evaluation_coachee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commitments');
    }
};
