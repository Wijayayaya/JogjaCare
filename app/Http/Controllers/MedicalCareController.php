<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MedicalCare\Models\MedicalCare;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MedicalCareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = MedicalCare::query();
        
        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('intro', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filter by type
        if (request('type')) {
            $query->where('type', request('type'));
        }
        
        // Filter by status
        if (request('status') !== null && request('status') !== '') {
            $query->where('status', request('status'));
        }
        
        $medicalCares = $query->latest()->paginate(10);
        
        return view('dashboardadmin.services.medicalcare.index', compact('medicalCares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardadmin.services.medicalcare.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'intro' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['created_by'] = auth()->id() ?? 1;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medicalcare'), $imageName);
            $data['image'] = 'uploads/medicalcare/' . $imageName;
        }
        MedicalCare::create($data);

        return redirect()->route('dashboardadmin.services.medicalcare.index')
                        ->with('success', 'Medical Care created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalCare $medicalCare)
    {
        return view('dashboardadmin.services.medicalcare.show', compact('medicalCare'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalCare $medicalCare)
    {
        return view('dashboardadmin.services.medicalcare.edit', compact('medicalCare'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalCare $medicalCare)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'intro' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['updated_by'] = auth()->id() ?? 1;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medicalcare'), $imageName);
            $data['image'] = 'uploads/medicalcare/' . $imageName;
        }


        $medicalCare->update($data);

        return redirect()->route('dashboardadmin.services.medicalcare.index')
                        ->with('success', 'Medical Care updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalCare $medicalCare)
    {
        // Delete image if exists
        if ($medicalCare->image) {
            Storage::delete('public/' . $medicalCare->image);
        }

        $medicalCare->delete();

        return redirect()->route('dashboardadmin.services.medicalcare.index')
                        ->with('success', 'Medical Care deleted successfully.');
    }
}