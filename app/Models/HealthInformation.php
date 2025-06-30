<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HealthInformation extends Model
{
    use HasFactory;

    protected $table = 'health_information';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'what_is',
        'care_tips',
        'when_to_doctor',
        'avoid',
        'icon',
        'color',
        'is_emergency',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'care_tips' => 'array',
        'when_to_doctor' => 'array',
        'avoid' => 'array',
        'is_emergency' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
        
        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeEmergency($query)
    {
        return $query->where('is_emergency', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
