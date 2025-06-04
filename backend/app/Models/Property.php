<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'property_type',
        'purchase_price',
        'current_value',
        'bedrooms',
        'bathrooms',
        'square_feet',
        'description'
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'current_value' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function metrics()
    {
        return $this->hasMany(PropertyMetric::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function latestMetric()
    {
        return $this->hasOne(PropertyMetric::class)->latestOfMany('recorded_at');
    }
}
