<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['emergency', 'hospital', 'private']);
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->string('coverage_area')->nullable();
            $table->string('response_time')->nullable();
            $table->string('tariff_range')->nullable();
            $table->json('facilities')->nullable();
            $table->string('distance_from_malioboro')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulances');
    }
};
