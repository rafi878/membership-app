<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('category');
            $table->integer('view_count')->default(0);
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_premium');
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};