<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HealthInformationController extends Controller
{
    public function index(Request $request)
    {
        $query = HealthInformation::query();
        
        // Apply filters
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'active':
                    $query->where('is_active', true);
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
                case 'emergency':
                    $query->where('is_emergency', true);
                    break;
            }
        }
        
        // Apply search
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        $healthInfo = $query->ordered()->paginate(15);
        
        return view('dashboardadmin.health-information.index', compact('healthInfo'));
    }

    public function create()
    {
        $icons = [
            'fas fa-heartbeat' => 'Heartbeat - Detak Jantung',
            'fas fa-thermometer-half' => 'Thermometer - Demam',
            'fas fa-head-side-cough' => 'Cough - Batuk',
            'fas fa-brain' => 'Brain - Otak/Kepala',
            'fas fa-stomach' => 'Stomach - Perut',
            'fas fa-lungs' => 'Lungs - Paru-paru',
            'fas fa-eye' => 'Eye - Mata',
            'fas fa-ear' => 'Ear - Telinga',
            'fas fa-hand-holding-medical' => 'Medical Care - Perawatan',
            'fas fa-pills' => 'Pills - Obat',
            'fas fa-stethoscope' => 'Stethoscope - Stetoskop',
            'fas fa-user-injured' => 'Injured - Cedera',
            'fas fa-bone' => 'Bone - Tulang',
            'fas fa-tooth' => 'Tooth - Gigi',
            'fas fa-allergies' => 'Allergies - Alergi',
            'fas fa-virus' => 'Virus - Infeksi',
        ];

        $colors = [
            'blue' => 'Biru - Umum',
            'green' => 'Hijau - Sehat/Normal',
            'red' => 'Merah - Darurat/Bahaya',
            'yellow' => 'Kuning - Peringatan',
            'purple' => 'Ungu - Khusus',
            'orange' => 'Oranye - Perhatian',
            'pink' => 'Pink - Ringan',
            'indigo' => 'Indigo - Serius',
        ];

        return view('dashboardadmin.health-information.create', compact('icons', 'colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:health_information,name',
            'description' => 'required|string|max:500',
            'what_is' => 'required|string',
            'care_tips' => 'required|array|min:1',
            'care_tips.*' => 'required|string|max:255',
            'when_to_doctor' => 'required|array|min:1',
            'when_to_doctor.*' => 'required|string|max:255',
            'avoid' => 'nullable|array',
            'avoid.*' => 'nullable|string|max:255',
            'icon' => 'required|string',
            'color' => 'required|string',
            'is_emergency' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ], [
            'name.required' => 'Nama gejala/kondisi wajib diisi.',
            'name.unique' => 'Nama gejala/kondisi sudah ada, gunakan nama lain.',
            'description.required' => 'Deskripsi singkat wajib diisi.',
            'description.max' => 'Deskripsi singkat maksimal 500 karakter.',
            'what_is.required' => 'Penjelasan lengkap wajib diisi.',
            'care_tips.required' => 'Minimal harus ada 1 tips perawatan.',
            'care_tips.min' => 'Minimal harus ada 1 tips perawatan.',
            'when_to_doctor.required' => 'Minimal harus ada 1 kondisi kapan harus ke dokter.',
            'when_to_doctor.min' => 'Minimal harus ada 1 kondisi kapan harus ke dokter.',
            'icon.required' => 'Icon wajib dipilih.',
            'color.required' => 'Warna wajib dipilih.',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_emergency'] = $request->has('is_emergency');
        $data['is_active'] = $request->has('is_active');
        
        // Filter out empty avoid items
        if (isset($data['avoid'])) {
            $data['avoid'] = array_values(array_filter($data['avoid'], function($item) {
                return !empty(trim($item));
            }));
        }

        // Filter out empty care tips and when_to_doctor
        $data['care_tips'] = array_values(array_filter($data['care_tips'], function($item) {
            return !empty(trim($item));
        }));
        
        $data['when_to_doctor'] = array_values(array_filter($data['when_to_doctor'], function($item) {
            return !empty(trim($item));
        }));

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
            'fas fa-heartbeat' => 'Heartbeat - Detak Jantung',
            'fas fa-thermometer-half' => 'Thermometer - Demam',
            'fas fa-head-side-cough' => 'Cough - Batuk',
            'fas fa-brain' => 'Brain - Otak/Kepala',
            'fas fa-stomach' => 'Stomach - Perut',
            'fas fa-lungs' => 'Lungs - Paru-paru',
            'fas fa-eye' => 'Eye - Mata',
            'fas fa-ear' => 'Ear - Telinga',
            'fas fa-hand-holding-medical' => 'Medical Care - Perawatan',
            'fas fa-pills' => 'Pills - Obat',
            'fas fa-stethoscope' => 'Stethoscope - Stetoskop',
            'fas fa-user-injured' => 'Injured - Cedera',
            'fas fa-bone' => 'Bone - Tulang',
            'fas fa-tooth' => 'Tooth - Gigi',
            'fas fa-allergies' => 'Allergies - Alergi',
            'fas fa-virus' => 'Virus - Infeksi',
        ];

        $colors = [
            'blue' => 'Biru - Umum',
            'green' => 'Hijau - Sehat/Normal',
            'red' => 'Merah - Darurat/Bahaya',
            'yellow' => 'Kuning - Peringatan',
            'purple' => 'Ungu - Khusus',
            'orange' => 'Oranye - Perhatian',
            'pink' => 'Pink - Ringan',
            'indigo' => 'Indigo - Serius',
        ];

        return view('dashboardadmin.health-information.edit', compact('healthInformation', 'icons', 'colors'));
    }

    public function update(Request $request, HealthInformation $healthInformation)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:health_information,name,' . $healthInformation->id,
            'description' => 'required|string|max:500',
            'what_is' => 'required|string',
            'care_tips' => 'required|array|min:1',
            'care_tips.*' => 'required|string|max:255',
            'when_to_doctor' => 'required|array|min:1',
            'when_to_doctor.*' => 'required|string|max:255',
            'avoid' => 'nullable|array',
            'avoid.*' => 'nullable|string|max:255',
            'icon' => 'required|string',
            'color' => 'required|string',
            'is_emergency' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ], [
            'name.required' => 'Nama gejala/kondisi wajib diisi.',
            'name.unique' => 'Nama gejala/kondisi sudah ada, gunakan nama lain.',
            'description.required' => 'Deskripsi singkat wajib diisi.',
            'description.max' => 'Deskripsi singkat maksimal 500 karakter.',
            'what_is.required' => 'Penjelasan lengkap wajib diisi.',
            'care_tips.required' => 'Minimal harus ada 1 tips perawatan.',
            'care_tips.min' => 'Minimal harus ada 1 tips perawatan.',
            'when_to_doctor.required' => 'Minimal harus ada 1 kondisi kapan harus ke dokter.',
            'when_to_doctor.min' => 'Minimal harus ada 1 kondisi kapan harus ke dokter.',
            'icon.required' => 'Icon wajib dipilih.',
            'color.required' => 'Warna wajib dipilih.',
        ]);

        $data = $request->all();
        $data['is_emergency'] = $request->has('is_emergency');
        $data['is_active'] = $request->has('is_active');
        
        // Update slug only if name changed
        if ($healthInformation->name !== $request->name) {
            $data['slug'] = Str::slug($request->name);
        }
        
        // Filter out empty avoid items
        if (isset($data['avoid'])) {
            $data['avoid'] = array_values(array_filter($data['avoid'], function($item) {
                return !empty(trim($item));
            }));
        }

        // Filter out empty care tips and when_to_doctor
        $data['care_tips'] = array_values(array_filter($data['care_tips'], function($item) {
            return !empty(trim($item));
        }));
        
        $data['when_to_doctor'] = array_values(array_filter($data['when_to_doctor'], function($item) {
            return !empty(trim($item));
        }));

        $healthInformation->update($data);

        return redirect()->route('dashboardadmin.health-information.index')
            ->with('success', 'Informasi kesehatan berhasil diperbarui.');
    }

    public function destroy(HealthInformation $healthInformation)
    {
        try {
            $name = $healthInformation->name;
            $healthInformation->delete();

            return redirect()->route('dashboardadmin.health-information.index')
                ->with('success', "Informasi kesehatan '{$name}' berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('dashboardadmin.health-information.index')
                ->with('error', 'Gagal menghapus informasi kesehatan. ' . $e->getMessage());
        }
    }

    public function toggleStatus(HealthInformation $healthInformation)
    {
        try {
            $healthInformation->update([
                'is_active' => !$healthInformation->is_active
            ]);

            $status = $healthInformation->is_active ? 'diaktifkan' : 'dinonaktifkan';
            
            return redirect()->back()
                ->with('success', "Informasi kesehatan berhasil {$status}.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengubah status. ' . $e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:health_information,id'
        ]);

        $count = 0;
        $items = HealthInformation::whereIn('id', $request->selected_items);

        try {
            switch ($request->action) {
                case 'activate':
                    $count = $items->update(['is_active' => true]);
                    $message = "{$count} informasi kesehatan berhasil diaktifkan.";
                    break;
                case 'deactivate':
                    $count = $items->update(['is_active' => false]);
                    $message = "{$count} informasi kesehatan berhasil dinonaktifkan.";
                    break;
                case 'delete':
                    $count = $items->count();
                    $items->delete();
                    $message = "{$count} informasi kesehatan berhasil dihapus.";
                    break;
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan aksi bulk. ' . $e->getMessage());
        }
    }
}
