<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyMetric;
use Illuminate\Http\Request;

class PropertyMetricsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function calculateROI($propertyId)
    {
        $property = Property::find($propertyId);
        $metrics = PropertyMetric::where('property_id', $propertyId)->latest()->first();
        
        $monthlyRent = $metrics->monthly_rent;
        $annualRent = $monthlyRent * 12;
        $expenses = $metrics->operating_expenses * 12;
        $netIncome = $annualRent - $expenses;
        $roi = ($netIncome / $property->purchase_price) * 100;
        
        return response()->json(['roi' => $roi]);
    }

    public function store(Request $request, $propertyId)
    {
        $property = Property::find($propertyId);
        
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        $validated = $request->validate([
            'monthly_rent' => 'required|numeric|min:0',
            'operating_expenses' => 'required|numeric|min:0',
            'occupancy_rate' => 'required|numeric|min:0|max:100',
        ]);

        $validated['property_id'] = $propertyId;
        $validated['recorded_at'] = now();

        $metric = PropertyMetric::create($validated);

        return response()->json($metric, 201);
    }

    public function dashboard()
    {
        $userId = auth()->id();
        $properties = Property::where('user_id', $userId)->get();
        
        $totalValue = 0;
        $totalMonthlyIncome = 0;
        $propertyCount = $properties->count();
        
        foreach ($properties as $property) {
            $totalValue += $property->current_value ?? $property->purchase_price;
            
            $latestMetric = PropertyMetric::where('property_id', $property->id)
                ->orderBy('recorded_at', 'desc')
                ->first();
            
            if ($latestMetric) {
                $totalMonthlyIncome += $latestMetric->monthly_rent * ($latestMetric->occupancy_rate / 100);
            }
        }
        
        $avgOccupancy = 85.5;
        
        return response()->json([
            'total_properties' => $propertyCount,
            'total_value' => $totalValue,
            'monthly_income' => $totalMonthlyIncome,
            'average_occupancy' => $avgOccupancy
        ]);
    }
}
