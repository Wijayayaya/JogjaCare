<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_id')->unique();
            $table->decimal('gross_amount', 10, 2);
            $table->string('payment_type', 50)->nullable();
            $table->string('transaction_status', 50)->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->string('payment_code', 255)->nullable();
            $table->string('pdf_url', 255)->nullable();
            $table->string('va_number', 255)->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('fraud_status', 50)->nullable();
            $table->text('status_message')->nullable();
            $table->string('snap_token', 255)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id', 'idx_user_id');
            $table->index('order_id', 'idx_order_id');
            $table->index('transaction_status', 'idx_transaction_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
