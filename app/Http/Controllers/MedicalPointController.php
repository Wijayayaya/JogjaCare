<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MedicalPoint\Models\MedicalPoint;
use Illuminate\Support\Str;

class MedicalPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalPoints = MedicalPoint::latest()->paginate(10);
        return view('dashboardadmin.services.medicalpoint.index', compact('medicalPoints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardadmin.services.medicalpoint.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'sub_district' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|string|max:255',
            'intro' => 'required|string',
            'description' => 'nullable|string',
            'maps' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medicalpoints'), $imageName);
            $data['image'] = 'uploads/medicalpoints/' . $imageName;
        }

        MedicalPoint::create($data);

        return redirect()->route('dashboardadmin.services.medicalpoint.index')
                        ->with('success', 'Medical Point created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medicalPoint = MedicalPoint::findOrFail($id);
        return view('dashboardadmin.services.medicalpoint.show', compact('medicalPoint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicalPoint = MedicalPoint::findOrFail($id);
        return view('dashboardadmin.services.medicalpoint.edit', compact('medicalPoint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicalPoint = MedicalPoint::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'sub_district' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|string|max:255',
            'intro' => 'required|string',
            'description' => 'nullable|string',
            'maps' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($medicalPoint->image && file_exists(public_path($medicalPoint->image))) {
                unlink(public_path($medicalPoint->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medicalpoints'), $imageName);
            $data['image'] = 'uploads/medicalpoints/' . $imageName;
        }

        $medicalPoint->update($data);

        return redirect()->route('dashboardadmin.services.medicalpoint.index')
                        ->with('success', 'Medical Point updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicalPoint = MedicalPoint::findOrFail($id);
        
        // Delete image if exists
        if ($medicalPoint->image && file_exists(public_path($medicalPoint->image))) {
            unlink(public_path($medicalPoint->image));
        }

        $medicalPoint->delete();

        return redirect()->route('dashboardadmin.services.medicalpoint.index')
                        ->with('success', 'Medical Point deleted successfully.');
    }
}
