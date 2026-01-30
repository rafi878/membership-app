<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom untuk membership
            $table->enum('membership_type', ['A', 'B', 'C'])->default('A')->after('password');
            $table->string('google_id')->nullable()->unique()->after('membership_type');
            $table->string('facebook_id')->nullable()->unique()->after('google_id');
            $table->string('avatar')->nullable()->after('facebook_id');
            $table->timestamp('last_login')->nullable()->after('avatar');
            
            // Ubah password menjadi nullable untuk social login
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['membership_type', 'google_id', 'facebook_id', 'avatar', 'last_login']);
            $table->string('password')->nullable(false)->change();
        });
    }
};