<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add category_id column
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('categories')->nullOnDelete();
        });

        // 2. Migrate existing categories to the new table
        $existingCategories = DB::table('events')->distinct()->pluck('category')->toArray();
        
        foreach ($existingCategories as $catName) {
            if ($catName) {
                $id = DB::table('categories')->insertGetId([
                    'name' => ucfirst($catName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('events')->where('category', $catName)->update(['category_id' => $id]);
            }
        }

        // 3. Drop the old enum column
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('category')->nullable()->after('category_id');
        });

        // Optional: migrate back if needed, but enum constraints make it hard
        
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
