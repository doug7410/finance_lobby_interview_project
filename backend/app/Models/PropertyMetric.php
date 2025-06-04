<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'monthly_rent',
        'operating_expenses',
        'occupancy_rate',
        'recorded_at'
    ];

    protected $casts = [
        'monthly_rent' => 'decimal:2',
        'operating_expenses' => 'decimal:2',
        'occupancy_rate' => 'decimal:2',
        'recorded_at' => 'datetime'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
