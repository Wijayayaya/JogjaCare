<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MedicalCost\Models\MedicalCost;
use Illuminate\Support\Str;

class MedicalCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MedicalCost::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('lowest_price', '>=', $request->get('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('highest_price', '<=', $request->get('max_price'));
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $allowedSorts = ['name', 'lowest_price', 'highest_price', 'status', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $medicalCosts = $query->paginate(10)->withQueryString();

        return view('dashboardadmin.services.medicalcost.index', compact('medicalCosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardadmin.services.medicalcost.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:medicalcosts,name',
            'lowest_price' => 'required|numeric|min:0',
            'highest_price' => 'required|numeric|min:0|gte:lowest_price',
            'status' => 'required|boolean',
        ], [
            'name.required' => 'Nama layanan medis wajib diisi.',
            'name.unique' => 'Nama layanan medis sudah ada.',
            'lowest_price.required' => 'Harga terendah wajib diisi.',
            'lowest_price.numeric' => 'Harga terendah harus berupa angka.',
            'lowest_price.min' => 'Harga terendah tidak boleh negatif.',
            'highest_price.required' => 'Harga tertinggi wajib diisi.',
            'highest_price.numeric' => 'Harga tertinggi harus berupa angka.',
            'highest_price.min' => 'Harga tertinggi tidak boleh negatif.',
            'highest_price.gte' => 'Harga tertinggi harus lebih besar atau sama dengan harga terendah.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        try {
            MedicalCost::create([
                'name' => $request->name,
                'lowest_price' => $request->lowest_price,
                'highest_price' => $request->highest_price,
                'status' => $request->status,
                'created_by' => auth()->id() ?? 1, // Default to 1 if no auth
            ]);

            return redirect()
                ->route('dashboardadmin.services.medicalcost.index')
                ->with('success', 'Medical Cost berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medicalCost = MedicalCost::findOrFail($id);
        return view('dashboardadmin.services.medicalcost.show', compact('medicalCost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicalCost = MedicalCost::findOrFail($id);
        return view('dashboardadmin.services.medicalcost.edit', compact('medicalCost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medicalCost = MedicalCost::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:medicalcosts,name,' . $id,
            'lowest_price' => 'required|numeric|min:0',
            'highest_price' => 'required|numeric|min:0|gte:lowest_price',
            'status' => 'required|boolean',
        ], [
            'name.required' => 'Nama layanan medis wajib diisi.',
            'name.unique' => 'Nama layanan medis sudah ada.',
            'lowest_price.required' => 'Harga terendah wajib diisi.',
            'lowest_price.numeric' => 'Harga terendah harus berupa angka.',
            'lowest_price.min' => 'Harga terendah tidak boleh negatif.',
            'highest_price.required' => 'Harga tertinggi wajib diisi.',
            'highest_price.numeric' => 'Harga tertinggi harus berupa angka.',
            'highest_price.min' => 'Harga tertinggi tidak boleh negatif.',
            'highest_price.gte' => 'Harga tertinggi harus lebih besar atau sama dengan harga terendah.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        try {
            $medicalCost->update([
                'name' => $request->name,
                'lowest_price' => $request->lowest_price,
                'highest_price' => $request->highest_price,
                'status' => $request->status,
                'updated_by' => auth()->id() ?? 1, // Default to 1 if no auth
            ]);

            return redirect()
                ->route('dashboardadmin.services.medicalcost.index')
                ->with('success', 'Medical Cost berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $medicalCost = MedicalCost::findOrFail($id);
            
            // Soft delete
            $medicalCost->update(['deleted_by' => auth()->id() ?? 1]);
            $medicalCost->delete();

            return redirect()
                ->route('dashboardadmin.services.medicalcost.index')
                ->with('success', 'Medical Cost berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
