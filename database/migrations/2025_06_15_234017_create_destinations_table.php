<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description'); // Changed from longText to text
            $table->mediumText('image')->nullable(); // Changed from longText to mediumText
            $table->string('image_mime_type', 50)->nullable();
            $table->string('map_url', 500)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['is_active', 'sort_order']);
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};