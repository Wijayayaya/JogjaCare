<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->timestamp('last_activity')->useCurrent();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
