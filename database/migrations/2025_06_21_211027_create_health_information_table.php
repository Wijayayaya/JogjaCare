<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('health_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('what_is');
            $table->json('care_tips'); // Array of care tips
            $table->json('when_to_doctor'); // Array of when to see doctor conditions
            $table->json('avoid')->nullable(); // Array of things to avoid
            $table->string('icon')->default('fas fa-heartbeat');
            $table->string('color')->default('blue');
            $table->boolean('is_emergency')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_information');
    }
};
