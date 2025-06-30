<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\EmergencyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AmbulanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Ambulance::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('coverage_area', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $ambulances = $query->latest()->paginate(10)->withQueryString();

        // Statistics
        $stats = [
            'total' => Ambulance::count(),
            'active' => Ambulance::where('is_active', true)->count(),
            'emergency' => Ambulance::where('type', 'emergency')->count(),
            'hospital' => Ambulance::where('type', 'hospital')->count(),
            'private' => Ambulance::where('type', 'private')->count(),
        ];

        // Check if request wants JSON response (for AJAX/API calls)
        if ($request->wantsJson() || $request->has('json') || $request->ajax()) {
            Log::info('Ambulance index API called', ['data_count' => $ambulances->count()]);
            
            return response()->json([
                'success' => true,
                'data' => $ambulances->items(),
                'stats' => $stats,
                'pagination' => [
                    'current_page' => $ambulances->currentPage(),
                    'last_page' => $ambulances->lastPage(),
                    'per_page' => $ambulances->perPage(),
                    'total' => $ambulances->total(),
                ]
            ]);
        }

        return view('dashboardadmin.ambulance.index', compact('ambulances', 'stats'));
    }

    public function create()
    {
        return view('dashboardadmin.ambulance.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:emergency,hospital,private',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'coverage_area' => 'nullable|string|max:255',
            'response_time' => 'nullable|string|max:50',
            'tariff_range' => 'nullable|string|max:100',
            'facilities' => 'nullable|array',
            'distance_from_malioboro' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $ambulance = Ambulance::create($validated);

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ambulance created successfully!',
                    'data' => $ambulance
                ]);
            }

            return redirect()->route('ambulance.index')
                           ->with('success', 'Ambulance created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating ambulance: ' . $e->getMessage());
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create ambulance: ' . $e->getMessage()
                ], 500);
            }

            return back()->withInput()
                        ->with('error', 'Failed to create ambulance: ' . $e->getMessage());
        }
    }

    public function show(Ambulance $ambulance)
    {
        return view('dashboardadmin.ambulance.show', compact('ambulance'));
    }

    public function edit(Ambulance $ambulance)
    {
        return view('dashboardadmin.ambulance.edit', compact('ambulance'));
    }

    public function update(Request $request, Ambulance $ambulance)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:emergency,hospital,private',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'coverage_area' => 'nullable|string|max:255',
            'response_time' => 'nullable|string|max:50',
            'tariff_range' => 'nullable|string|max:100',
            'facilities' => 'nullable|array',
            'distance_from_malioboro' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $ambulance->update($validated);

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ambulance updated successfully!',
                    'data' => $ambulance
                ]);
            }

            return redirect()->route('ambulance.index')
                           ->with('success', 'Ambulance updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating ambulance: ' . $e->getMessage());
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update ambulance: ' . $e->getMessage()
                ], 500);
            }

            return back()->withInput()
                        ->with('error', 'Failed to update ambulance: ' . $e->getMessage());
        }
    }

    public function destroy(Ambulance $ambulance)
    {
        try {
            DB::beginTransaction();

            $ambulance->delete();

            DB::commit();

            return redirect()->route('ambulance.index')
                           ->with('success', 'Ambulance deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to delete ambulance: ' . $e->getMessage());
        }
    }

    public function emergencyContacts(Request $request)
    {
        $contacts = EmergencyContact::active()->latest()->get();
        
        Log::info('Emergency contacts API called', ['contacts_count' => $contacts->count()]);
        
        // Check if request wants JSON response
        if ($request->wantsJson() || $request->has('json') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $contacts
            ]);
        }
        
        $contacts = EmergencyContact::active()->latest()->paginate(10);
        return view('dashboardadmin.ambulance.emergency-contacts', compact('contacts'));
    }

    public function hospitals(Request $request)
    {
        $hospitals = Ambulance::active()->where('type', 'hospital')->latest()->get();
        
        Log::info('Hospital ambulances API called', ['hospitals_count' => $hospitals->count()]);
        
        // Check if request wants JSON response
        if ($request->wantsJson() || $request->has('json') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $hospitals
            ]);
        }
        
        $hospitals = Ambulance::active()->where('type', 'hospital')->latest()->paginate(10);
        return view('dashboardadmin.ambulance.hospitals', compact('hospitals'));
    }

    public function privateServices(Request $request)
    {
        $privateServices = Ambulance::active()->where('type', 'private')->latest()->get();
        
        Log::info('Private ambulances API called', ['private_count' => $privateServices->count()]);
        
        // Check if request wants JSON response
        if ($request->wantsJson() || $request->has('json') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $privateServices
            ]);
        }
        
        $privateServices = Ambulance::active()->where('type', 'private')->latest()->paginate(10);
        return view('dashboardadmin.ambulance.private-services', compact('privateServices'));
    }
}
