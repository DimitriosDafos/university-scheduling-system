<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_recurrences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('rrule')->nullable(); // RFC 5545
            $table->dateTime('until')->nullable();
            $table->integer('count')->nullable();
            $table->json('exdates')->nullable(); // ausgeschlossene Termine
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_recurrences');
    }
};
