<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika belum ada kolom-kolom ini
            if (!Schema::hasColumn('users', 'membership_type')) {
                $table->char('membership_type', 1)->default('A')->after('email');
            }
            if (!Schema::hasColumn('users', 'membership_name')) {
                $table->string('membership_name')->default('Basic')->after('membership_type');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('membership_name');
            }
            if (!Schema::hasColumn('users', 'social_id')) {
                $table->string('social_id')->nullable()->after('avatar');
            }
            if (!Schema::hasColumn('users', 'social_type')) {
                $table->string('social_type')->nullable()->after('social_id');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['membership_type', 'membership_name', 'avatar', 'social_id', 'social_type']);
        });
    }
};