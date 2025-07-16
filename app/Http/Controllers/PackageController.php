<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PackageController extends Controller
{
    /**
     * Get all active packages for the website
     */
    public function index(): JsonResponse
    {
        try {
            $packages = Package::active()
                ->ordered()
                ->get()
                ->map(function ($package) {
                    return [
                        'id' => $package->id,
                        'name' => $package->name,
                        'description' => $package->description,
                        'hours' => $package->hours,
                        'price_in_person' => $package->price_in_person,
                        'price_online' => $package->price_online,
                        'formatted_price_in_person' => $package->formatted_price_in_person,
                        'formatted_price_online' => $package->formatted_price_online,
                        'hourly_rate_in_person' => $package->hourly_rate_in_person,
                        'hourly_rate_online' => $package->hourly_rate_online,
                        'formatted_hourly_rate_in_person' => $package->formatted_hourly_rate_in_person,
                        'formatted_hourly_rate_online' => $package->formatted_hourly_rate_online,
                        'is_featured' => $package->is_featured,
                        'features' => $package->features ?? [],
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $packages,
                'message' => 'Packages retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving packages: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get packages by type (for frontend pricing toggle)
     */
    public function getByType(Request $request): JsonResponse
    {
        $type = $request->get('type', 'in-person'); // 'in-person' or 'online'
        
        try {
            $packages = Package::active()
                ->ordered()
                ->get()
                ->map(function ($package) use ($type) {
                    $priceField = $type === 'online' ? 'price_online' : 'price_in_person';
                    $hourlyRateField = $type === 'online' ? 'hourly_rate_online' : 'hourly_rate_in_person';
                    $formattedHourlyRateField = $type === 'online' ? 'formatted_hourly_rate_online' : 'formatted_hourly_rate_in_person';
                    
                    return [
                        'id' => $package->id,
                        'name' => $package->name,
                        'description' => $package->description,
                        'hours' => $package->hours,
                        'price' => $package->$priceField,
                        'hourly_rate' => $package->$hourlyRateField,
                        'formatted_hourly_rate' => $package->$formattedHourlyRateField,
                        'is_featured' => $package->is_featured,
                        'features' => $package->features ?? [],
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $packages,
                'type' => $type,
                'message' => 'Packages retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving packages: ' . $e->getMessage()
            ], 500);
        }
    }
}