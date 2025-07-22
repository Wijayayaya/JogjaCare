<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminDestinationController extends Controller
{
    /**
     * Display a listing of destinations
     */
    public function index(Request $request)
    {
        $query = Destination::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Order by sort_order and created_at
        $destinations = $query->orderBy('sort_order', 'asc')
                             ->orderBy('created_at', 'desc')
                             ->paginate(12)
                             ->withQueryString();

        return view('dashboardadmin.management.destination.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new destination
     */
    public function create()
    {
        return view('dashboardadmin.management.destination.create');
    }

    /**
     * Store a newly created destination
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'map_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = base64_encode(file_get_contents($image->getRealPath()));
                $validated['image'] = $imageData;
                $validated['image_mime_type'] = $image->getMimeType();
            }

            // Set default values
            $validated['is_active'] = $request->has('is_active');
            
            if (!isset($validated['sort_order'])) {
                $validated['sort_order'] = (Destination::max('sort_order') ?? 0) + 1;
            }

            $destination = Destination::create($validated);

            DB::commit();

            return redirect()->route('dashboardadmin.management.destination.index')
                           ->with('success', 'Destination created successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating destination: ' . $e->getMessage());
            
            return back()->withInput()
                        ->with('error', 'Failed to create destination: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified destination
     */
    public function show(Destination $destination)
    {
        return view('dashboardadmin.management.destination.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified destination
     */
    public function edit(Destination $destination)
    {
        return view('dashboardadmin.management.destination.edit', compact('destination'));
    }

    /**
     * Update the specified destination
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'map_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = base64_encode(file_get_contents($image->getRealPath()));
                $validated['image'] = $imageData;
                $validated['image_mime_type'] = $image->getMimeType();
            }

            // Handle checkbox
            $validated['is_active'] = $request->has('is_active');

            $destination->update($validated);

            DB::commit();

            return redirect()->route('dashboardadmin.management.destination.index')
                           ->with('success', 'Destination updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating destination: ' . $e->getMessage());
            
            return back()->withInput()
                        ->with('error', 'Failed to update destination: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified destination
     */
    public function destroy(Destination $destination)
    {
        try {
            DB::beginTransaction();

            $destination->delete();

            DB::commit();

            return redirect()->route('dashboardadmin.management.destination.index')
                           ->with('success', 'Destination deleted successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting destination: ' . $e->getMessage());
            
            return back()->with('error', 'Failed to delete destination: ' . $e->getMessage());
        }
    }

    /**
     * Toggle destination status
     */
    public function toggleStatus(Destination $destination)
    {
        try {
            $destination->update(['is_active' => !$destination->is_active]);
            
            $status = $destination->is_active ? 'activated' : 'deactivated';
            
            return response()->json([
                'success' => true,
                'message' => "Destination {$status} successfully!",
                'is_active' => $destination->is_active
            ]);

        } catch (\Exception $e) {
            Log::error('Error toggling destination status: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update destination status'
            ], 500);
        }
    }
}
