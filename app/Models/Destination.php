<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'image_mime_type',
        'map_url',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && $this->image_mime_type) {
            return 'data:' . $this->image_mime_type . ';base64,' . $this->image;
        }
        return asset('img/destinasi/default.jpg');
    }

    public function hasImage()
    {
        return !empty($this->image) && !empty($this->image_mime_type);
    }

    public function getImageSizeAttribute()
    {
        if ($this->hasImage()) {
            // Calculate approximate size from base64 string
            $sizeInBytes = (strlen($this->image) * 3) / 4;
            return $this->formatBytes($sizeInBytes);
        }
        return null;
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB');
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }
}