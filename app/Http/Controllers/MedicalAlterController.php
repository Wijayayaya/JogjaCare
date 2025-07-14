<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MedicalAlter\Models\MedicalAlter;
use Illuminate\Support\Str;

class MedicalAlterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalAlters = MedicalAlter::latest()->paginate(10);
        return view('dashboardadmin.services.medicalalter.index', compact('medicalAlters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardadmin.services.medicalalter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'intro' => 'nullable|string',
            'benefits' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medicalalter'), $imageName);
            $data['image'] = 'uploads/medicalalter/' . $imageName;
        }

        MedicalAlter::create($data);

        return redirect()->route('dashboardadmin.services.medicalalter.index')
                        ->with('success', 'Medical Alter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medicalalter = MedicalAlter::findOrFail($id);
        return view('dashboardadmin.services.medicalalter.show', compact('medicalalter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicalalter = MedicalAlter::findOrFail($id);
        return view('dashboardadmin.services.medicalalter.edit', compact('medicalalter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicalalter = MedicalAlter::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'intro' => 'nullable|string',
            'benefits' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($medicalalter->image && file_exists(public_path($medicalalter->image))) {
                unlink(public_path($medicalalter->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/medicalalter'), $imageName);
            $data['image'] = 'uploads/medicalalter/' . $imageName;
        }

        $medicalalter->update($data);

        return redirect()->route('dashboardadmin.services.medicalalter.index')
                        ->with('success', 'Medical Alter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicalalter = MedicalAlter::findOrFail($id);
        
        // Delete image if exists
        if ($medicalalter->image && file_exists(public_path($medicalalter->image))) {
            unlink(public_path($medicalalter->image));
        }

        $medicalalter->delete();

        return redirect()->route('dashboardadmin.services.medicalalter.index')
                        ->with('success', 'Medical Alter deleted successfully.');
    }
}
