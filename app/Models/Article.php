<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'excerpt',
        'content',
        'category',
        'icon_color',
        'read_time',
        'is_active',
        'order'
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
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'asc');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }

    public function getReadTimeTextAttribute()
    {
        return $this->read_time . ' min read';
    }
}
