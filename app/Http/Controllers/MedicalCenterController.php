<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MedicalCenter\Models\MedicalCenter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MedicalCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MedicalCenter::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('intro', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('sub_district', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }

        // Filter by district
        if ($request->has('district') && !empty($request->district)) {
            $query->where('district', $request->district);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $medicalCenters = $query->latest()->paginate(10);

        // Get unique types and districts for filter dropdowns
        $types = MedicalCenter::distinct()->pluck('type')->filter()->sort();
        $districts = ['Bantul', 'Gunungkidul', 'Kulon Progo', 'Sleman', 'Kota Yogyakarta'];

        return view('dashboardadmin.services.medicalcenter.index', compact('medicalCenters', 'types', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = ['Bantul', 'Gunungkidul', 'Kulon Progo', 'Sleman', 'Kota Yogyakarta'];
        return view('dashboardadmin.services.medicalcenter.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'intro' => 'required|string',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'district' => 'required|in:Bantul,Gunungkidul,Kulon Progo,Sleman,Kota Yogyakarta',
            'sub_district' => 'required|string|max:255',
            'address' => 'required|string',
            'maps' => 'nullable|url',
            'contact' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/medicalcenters');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            // Move the uploaded file
            $image->move($uploadPath, $imageName);
            $data['image'] = 'uploads/medicalcenters/' . $imageName;
        }

        MedicalCenter::create($data);

        return redirect()->route('dashboardadmin.services.medicalcenter.index')
                        ->with('success', 'Medical Center created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalCenter $medicalCenter)
    {
        return view('dashboardadmin.services.medicalcenter.show', compact('medicalCenter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalCenter $medicalCenter)
    {
        $districts = ['Bantul', 'Gunungkidul', 'Kulon Progo', 'Sleman', 'Kota Yogyakarta'];
        return view('dashboardadmin.services.medicalcenter.edit', compact('medicalCenter', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalCenter $medicalCenter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'intro' => 'required|string',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'district' => 'required|in:Bantul,Gunungkidul,Kulon Progo,Sleman,Kota Yogyakarta',
            'sub_district' => 'required|string|max:255',
            'address' => 'required|string',
            'maps' => 'nullable|url',
            'contact' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($medicalCenter->image && File::exists(public_path($medicalCenter->image))) {
                File::delete(public_path($medicalCenter->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/medicalcenters');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            // Move the uploaded file
            $image->move($uploadPath, $imageName);
            $data['image'] = 'uploads/medicalcenters/' . $imageName;
        }

        $medicalCenter->update($data);

        return redirect()->route('dashboardadmin.services.medicalcenter.index')
                        ->with('success', 'Medical Center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalCenter $medicalCenter)
    {
        // Delete image if exists
        if ($medicalCenter->image && File::exists(public_path($medicalCenter->image))) {
            File::delete(public_path($medicalCenter->image));
        }

        $medicalCenter->delete();

        return redirect()->route('dashboardadmin.services.medicalcenter.index')
                        ->with('success', 'Medical Center deleted successfully.');
    }
}
