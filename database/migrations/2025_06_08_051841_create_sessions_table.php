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
        Schema::create('coaching_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('coachee_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->enum('mode', ['in_person', 'virtual', 'phone'])->default('virtual');
            $table->enum('status', ['scheduled', 'completed', 'rescheduled', 'cancelled'])->default('scheduled');
            $table->text('goals')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaching_sessions');
    }
};
