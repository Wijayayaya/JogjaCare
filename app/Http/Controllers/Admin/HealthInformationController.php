<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HealthInformationController extends Controller
{
    public function index()
    {
        $healthInfo = HealthInformation::ordered()->paginate(15);
        return view('dashboardadmin.health-information.index', compact('healthInfo'));
    }

    public function create()
    {
        $icons = [
            'fas fa-heartbeat' => 'Heartbeat',
            'fas fa-thermometer-half' => 'Thermometer',
            'fas fa-head-side-cough' => 'Cough',
            'fas fa-brain' => 'Brain/Head',
            'fas fa-stomach' => 'Stomach',
            'fas fa-lungs' => 'Lungs',
            'fas fa-eye' => 'Eye',
            'fas fa-ear' => 'Ear',
            'fas fa-hand-holding-medical' => 'Medical Care',
            'fas fa-pills' => 'Pills',
            'fas fa-stethoscope' => 'Stethoscope',
            'fas fa-user-injured' => 'Injured',
        ];

        $colors = [
            'blue' => 'Blue',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'purple' => 'Purple',
            'orange' => 'Orange',
            'pink' => 'Pink',
            'indigo' => 'Indigo',
        ];

        return view('dashboardadmin.health-information.create', compact('icons', 'colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'what_is' => 'required|string',
            'care_tips' => 'required|array|min:1',
            'care_tips.*' => 'required|string',
            'when_to_doctor' => 'required|array|min:1',
            'when_to_doctor.*' => 'required|string',
            'avoid' => 'nullable|array',
            'avoid.*' => 'nullable|string',
            'icon' => 'required|string',
            'color' => 'required|string',
            'is_emergency' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        // Filter out empty avoid items
        if (isset($data['avoid'])) {
            $data['avoid'] = array_filter($data['avoid'], function($item) {
                return !empty(trim($item));
            });
        }

        HealthInformation::create($data);

        return redirect()->route('dashboardadmin.health-information.index')
            ->with('success', 'Informasi kesehatan berhasil ditambahkan.');
    }

    public function show(HealthInformation $healthInformation)
    {
        return view('dashboardadmin.health-information.show', compact('healthInformation'));
    }

    public function edit(HealthInformation $healthInformation)
    {
        $icons = [
            'fas fa-heartbeat' => 'Heartbeat',
            'fas fa-thermometer-half' => 'Thermometer',
            'fas fa-head-side-cough' => 'Cough',
            'fas fa-brain' => 'Brain/Head',
            'fas fa-stomach' => 'Stomach',
            'fas fa-lungs' => 'Lungs',
            'fas fa-eye' => 'Eye',
            'fas fa-ear' => 'Ear',
            'fas fa-hand-holding-medical' => 'Medical Care',
            'fas fa-pills' => 'Pills',
            'fas fa-stethoscope' => 'Stethoscope',
            'fas fa-user-injured' => 'Injured',
        ];

        $colors = [
            'blue' => 'Blue',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'purple' => 'Purple',
            'orange' => 'Orange',
            'pink' => 'Pink',
            'indigo' => 'Indigo',
        ];

        return view('dashboardadmin.health-information.edit', compact('healthInformation', 'icons', 'colors'));
    }

    public function update(Request $request, HealthInformation $healthInformation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'what_is' => 'required|string',
            'care_tips' => 'required|array|min:1',
            'care_tips.*' => 'required|string',
            'when_to_doctor' => 'required|array|min:1',
            'when_to_doctor.*' => 'required|string',
            'avoid' => 'nullable|array',
            'avoid.*' => 'nullable|string',
            'icon' => 'required|string',
            'color' => 'required|string',
            'is_emergency' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $data = $request->all();
        
        // Filter out empty avoid items
        if (isset($data['avoid'])) {
            $data['avoid'] = array_filter($data['avoid'], function($item) {
                return !empty(trim($item));
            });
        }

        $healthInformation->update($data);

        return redirect()->route('dashboardadmin.health-information.index')
            ->with('success', 'Informasi kesehatan berhasil diperbarui.');
    }

    public function destroy(HealthInformation $healthInformation)
    {
        $healthInformation->delete();

        return redirect()->route('dashboardadmin.health-information.index')
            ->with('success', 'Informasi kesehatan berhasil dihapus.');
    }

    public function toggleStatus(HealthInformation $healthInformation)
    {
        $healthInformation->update([
            'is_active' => !$healthInformation->is_active
        ]);

        $status = $healthInformation->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Informasi kesehatan berhasil {$status}.");
    }
}
