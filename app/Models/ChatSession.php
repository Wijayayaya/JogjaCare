<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'status',
        'last_activity',
        'is_deleted',
        'deleted_at',
        'deleted_by'
    ];

    protected $casts = [
        'last_activity' => 'datetime',
        'is_deleted' => 'boolean',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'user_id', 'user_id');
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(ChatMessage::class, 'user_id', 'user_id')
                    ->where('is_deleted', false)
                    ->latest();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('is_deleted', false);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', false);
    }

    // Methods
    public function markAsDeleted($deletedBy = null)
    {
        // Mark session as deleted
        $this->update([
            'is_deleted' => true,
            'deleted_at' => now(),
            'deleted_by' => $deletedBy,
            'status' => 'closed'
        ]);

        // Mark all messages in this session as deleted
        ChatMessage::where('user_id', $this->user_id)
            ->where('is_deleted', false)
            ->update([
                'is_deleted' => true,
                'deleted_at' => now(),
                'deleted_by' => $deletedBy
            ]);
    }

    public function updateActivity()
    {
        $this->update(['last_activity' => now()]);
    }
}
