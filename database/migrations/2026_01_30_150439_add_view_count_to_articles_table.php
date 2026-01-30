<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada
            if (!Schema::hasColumn('articles', 'view_count')) {
                $table->integer('view_count')->default(0)->after('content');
            }
            
            // Juga tambah kolom lain yang mungkin belum ada
            if (!Schema::hasColumn('articles', 'is_premium')) {
                $table->boolean('is_premium')->default(false)->after('view_count');
            }
            
            if (!Schema::hasColumn('articles', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
            
            if (!Schema::hasColumn('articles', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
        
        // Update data existing dengan nilai default
        if (Schema::hasTable('articles')) {
            DB::table('articles')->update([
                'view_count' => DB::raw('FLOOR(RAND() * 1000) + 100'),
                'is_premium' => DB::raw('CASE WHEN id > 3 THEN 1 ELSE 0 END'),
                'updated_at' => DB::raw('created_at')
            ]);
        }
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['view_count', 'is_premium', 'slug', 'updated_at']);
        });
    }
};