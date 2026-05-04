<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Ersteller / Dozent
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->enum('category', ['lecture', 'exam', 'event', 'other'])->default('lecture');
            $table->boolean('all_day')->default(false);
            $table->string('color')->nullable(); // UI-Farbcode
            $table->string('recurrence_rule')->nullable(); // RFC 5545 rule oder JSON
            $table->timestamps();

            $table->index(['start_datetime', 'end_datetime']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
