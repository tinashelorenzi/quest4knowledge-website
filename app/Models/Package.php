<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'hours',
        'price_in_person',
        'price_online',
        'is_featured',
        'is_active',
        'sort_order',
        'features',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'features' => 'array',
        'hours' => 'integer',
        'price_in_person' => 'decimal:2',
        'price_online' => 'decimal:2',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Accessors
    public function getFormattedPriceInPersonAttribute()
    {
        return 'R' . number_format($this->price_in_person, 0);
    }

    public function getFormattedPriceOnlineAttribute()
    {
        return 'R' . number_format($this->price_online, 0);
    }

    public function getHourlyRateInPersonAttribute()
    {
        return $this->hours > 0 ? $this->price_in_person / $this->hours : 0;
    }

    public function getHourlyRateOnlineAttribute()
    {
        return $this->hours > 0 ? $this->price_online / $this->hours : 0;
    }

    public function getFormattedHourlyRateInPersonAttribute()
    {
        return 'R' . number_format($this->hourly_rate_in_person, 0);
    }

    public function getFormattedHourlyRateOnlineAttribute()
    {
        return 'R' . number_format($this->hourly_rate_online, 0);
    }
}