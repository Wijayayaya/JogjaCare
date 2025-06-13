<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('expert_system_access')->default(false)->after('remember_token');
            $table->timestamp('expert_system_expires_at')->nullable()->after('expert_system_access');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['expert_system_access', 'expert_system_expires_at']);
        });
    }
};
