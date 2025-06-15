<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'message',
        'sender_type',
        'is_read',
        'is_deleted',
        'deleted_at',
        'deleted_by'
    ];

    protected $casts = [
        'is_read' => 'boolean',
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

    // Scopes
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', false);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeBySender($query, $senderType)
    {
        return $query->where('sender_type', $senderType);
    }

    // Methods
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function markAsDeleted($deletedBy = null)
    {
        $this->update([
            'is_deleted' => true,
            'deleted_at' => now(),
            'deleted_by' => $deletedBy
        ]);
    }

    public function canBeDeletedBy($user)
    {
        // Users can delete their own messages
        if ($this->sender_type === 'user' && $this->user_id === $user->id) {
            return true;
        }

        // Check if user has admin role
        if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
            return true;
        }

        // Alternative check for admin role if using different role system
        if (isset($user->role) && $user->role === 'admin') {
            return true;
        }

        return false;
    }
}
