<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'gross_amount',
        'payment_type',
        'transaction_status',
        'transaction_id',
        'payment_code',
        'pdf_url',
        'va_number',
        'bank',
        'fraud_status',
        'status_message',
        'snap_token',
        'expires_at',
        'paid_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
        'gross_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPaid()
    {
        return in_array($this->transaction_status, ['settlement', 'capture']) && $this->paid_at;
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at < now();
    }
}