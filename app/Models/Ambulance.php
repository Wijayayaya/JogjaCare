<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'phone',
        'whatsapp',
        'address',
        'coverage_area',
        'response_time',
        'tariff_range',
        'facilities',
        'distance_from_malioboro',
        'description',
        'is_active'
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_active' => 'boolean'
    ];

    public function getFormattedFacilitiesAttribute()
    {
        if (is_array($this->facilities)) {
            return implode(', ', $this->facilities);
        }
        return $this->facilities;
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active 
            ? '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>'
            : '<span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactive</span>';
    }

    public function getTypeBadgeAttribute()
    {
        $badges = [
            'emergency' => '<span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Emergency</span>',
            'hospital' => '<span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Hospital</span>',
            'private' => '<span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Private</span>'
        ];

        return $badges[$this->type] ?? $this->type;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
