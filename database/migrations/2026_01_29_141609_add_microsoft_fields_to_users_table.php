<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Microsoft fields
            $table->string('microsoft_id')->nullable()->after('id');
            // auth provider: local or microsoft
            $table->enum('auth_provider', ['local', 'microsoft'])->default('local')->after('password');
            // role: admin, staff, viewer
            $table->enum('role', ['admin', 'staff', 'viewer'])->default('staff')->after('auth_provider');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['microsoft_id', 'auth_provider', 'role']);
        });
    }
};
