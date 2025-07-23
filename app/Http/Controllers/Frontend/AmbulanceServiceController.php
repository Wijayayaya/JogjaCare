<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AmbulanceServiceController extends Controller
{
    /**
     * Get all active ambulances grouped by type
     */
    public function getAmbulances(): JsonResponse
    {
        try {
            $ambulances = Ambulance::where('is_active', true)
                ->orderBy('type')
                ->orderBy('name')
                ->get();

            // Group ambulances by type
            $groupedAmbulances = [
                'emergency' => $ambulances->where('type', 'emergency')->values(),
                'hospital' => $ambulances->where('type', 'hospital')->values(),
                'private' => $ambulances->where('type', 'private')->values(),
            ];

            return response()->json([
                'success' => true,
                'data' => $groupedAmbulances
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data ambulans',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get ambulances by type
     */
    public function getAmbulancesByType(string $type): JsonResponse
    {
        try {
            $validTypes = ['emergency', 'hospital', 'private'];
            
            if (!in_array($type, $validTypes)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tipe ambulans tidak valid'
                ], 400);
            }

            $ambulances = Ambulance::where('type', $type)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $ambulances
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data ambulans',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get emergency contacts
     */
    public function getEmergencyContacts(): JsonResponse
    {
        try {
            $emergencyContacts = Ambulance::where('type', 'emergency')
                ->where('is_active', true)
                ->select('name', 'phone', 'description', 'coverage_area', 'response_time')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $emergencyContacts
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil kontak darurat',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search ambulances by name or location
     */
    public function searchAmbulances(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            $type = $request->get('type', '');

            $ambulancesQuery = Ambulance::where('is_active', true);

            if (!empty($query)) {
                $ambulancesQuery->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('address', 'LIKE', "%{$query}%")
                      ->orWhere('coverage_area', 'LIKE', "%{$query}%");
                });
            }

            if (!empty($type) && in_array($type, ['emergency', 'hospital', 'private'])) {
                $ambulancesQuery->where('type', $type);
            }

            $ambulances = $ambulancesQuery->orderBy('name')->get();

            return response()->json([
                'success' => true,
                'data' => $ambulances,
                'count' => $ambulances->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari data ambulans',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get ambulance statistics for chat widget
     */
    public function getStatistics(): JsonResponse
    {
        try {
            $stats = [
                'total_ambulances' => Ambulance::where('is_active', true)->count(),
                'emergency_services' => Ambulance::where('type', 'emergency')->where('is_active', true)->count(),
                'hospital_ambulances' => Ambulance::where('type', 'hospital')->where('is_active', true)->count(),
                'private_ambulances' => Ambulance::where('type', 'private')->where('is_active', true)->count(),
                'coverage_areas' => Ambulance::where('is_active', true)
                    ->whereNotNull('coverage_area')
                    ->distinct()
                    ->pluck('coverage_area')
                    ->filter()
                    ->values()
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik ambulans',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
