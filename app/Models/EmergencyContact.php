<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'description',
        'coverage',
        'response_time',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function getStatusBadgeAttribute()
    {
        return $this->is_active 
            ? '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>'
            : '<span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactive</span>';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
