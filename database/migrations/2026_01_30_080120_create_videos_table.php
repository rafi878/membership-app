<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->text('description')->nullable();
            $table->integer('duration_seconds')->default(0); // durasi dalam detik
            $table->string('duration_formatted')->nullable(); // format: "10:30"
            $table->integer('view_count')->default(0);
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
            
            $table->index('is_premium');
        });
    }

    public function down()
    {
        Schema::dropIfExists('videos');
    }
};