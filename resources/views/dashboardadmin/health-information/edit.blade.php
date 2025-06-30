@extends('dashboardadmin.layouts.app')

@section('title', 'Edit Informasi Kesehatan')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-edit text-warning me-2"></i>
                Edit Informasi Kesehatan
            </h1>
            <p class="text-muted mb-0">Edit informasi kesehatan: <strong>{{ $healthInformation->name }}</strong></p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboardadmin.health-information.show', $healthInformation) }}" class="btn btn-info">
                <i class="fas fa-eye me-2"></i>Lihat Detail
            </a>
            <a href="{{ route('dashboardadmin.health-information.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Terdapat kesalahan pada form:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-edit me-2"></i>Form Edit Informasi Kesehatan
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboardadmin.health-information.update', $healthInformation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="name" class="form-label">Nama Gejala/Kondisi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $healthInformation->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sort_order" class="form-label">Urutan Tampil</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $healthInformation->sort_order) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="2" required>{{ old('description', $healthInformation->description) }}</textarea>
                            <div class="form-text">Deskripsi singkat yang akan muncul di daftar gejala</div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="what_is" class="form-label">Penjelasan Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('what_is') is-invalid @enderror" 
                                      id="what_is" name="what_is" rows="3" required>{{ old('what_is', $healthInformation->what_is) }}</textarea>
                            <div class="form-text">Penjelasan detail tentang gejala/kondisi ini</div>
                            @error('what_is')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Care Tips -->
                        <div class="mb-3">
                            <label class="form-label">Tips Perawatan <span class="text-danger">*</span></label>
                            <div id="care-tips-container">
                                @php
                                    $careTips = old('care_tips', $healthInformation->care_tips);
                                @endphp
                                @foreach($careTips as $index => $tip)
                                    <div class="input-group mb-2 care-tip-item">
                                        <input type="text" class="form-control" name="care_tips[]" value="{{ $tip }}" required>
                                        <button type="button" class="btn btn-outline-danger remove-care-tip">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-care-tip">
                                <i class="fas fa-plus me-1"></i>Tambah Tips
                            </button>
                            @error('care_tips')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- When to Doctor -->
                        <div class="mb-3">
                            <label class="form-label">Kapan Harus ke Dokter <span class="text-danger">*</span></label>
                            <div id="doctor-conditions-container">
                                @php
                                    $whenToDoctor = old('when_to_doctor', $healthInformation->when_to_doctor);
                                @endphp
                                @foreach($whenToDoctor as $index => $condition)
                                    <div class="input-group mb-2 doctor-condition-item">
                                        <input type="text" class="form-control" name="when_to_doctor[]" value="{{ $condition }}" required>
                                        <button type="button" class="btn btn-outline-danger remove-doctor-condition">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-doctor-condition">
                                <i class="fas fa-plus me-1"></i>Tambah Kondisi
                            </button>
                            @error('when_to_doctor')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Things to Avoid -->
                        <div class="mb-3">
                            <label class="form-label">Yang Harus Dihindari (Opsional)</label>
                            <div id="avoid-container">
                                @php
                                    $avoid = old('avoid', $healthInformation->avoid ?? []);
                                @endphp
                                @if(count($avoid) > 0)
                                    @foreach($avoid as $index => $avoidItem)
                                        <div class="input-group mb-2 avoid-item">
                                            <input type="text" class="form-control" name="avoid[]" value="{{ $avoidItem }}">
                                            <button type="button" class="btn btn-outline-danger remove-avoid">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 avoid-item">
                                        <input type="text" class="form-control" name="avoid[]" placeholder="Hal yang harus dihindari">
                                        <button type="button" class="btn btn-outline-danger remove-avoid">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-avoid">
                                <i class="fas fa-plus me-1"></i>Tambah Item
                            </button>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon" required>
                                    @foreach($icons as $value => $label)
                                        <option value="{{ $value }}" {{ old('icon', $healthInformation->icon) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                                <select class="form-select @error('color') is-invalid @enderror" id="color" name="color" required>
                                    @foreach($colors as $value => $label)
                                        <option value="{{ $value }}" {{ old('color', $healthInformation->color) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_emergency" name="is_emergency" value="1" 
                                           {{ old('is_emergency', $healthInformation->is_emergency) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_emergency">
                                        <strong class="text-danger">Kondisi Darurat</strong>
                                        <div class="form-text">Centang jika ini adalah kondisi yang memerlukan penanganan darurat</div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                           {{ old('is_active', $healthInformation->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        <strong>Aktif</strong>
                                        <div class="form-text">Informasi akan ditampilkan di frontend</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboardadmin.health-information.show', $healthInformation) }}" class="btn btn-info">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </a>
                            <a href="{{ route('dashboardadmin.health-information.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Update Informasi Kesehatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Current Data Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-info-circle me-2"></i>Data Saat Ini
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-circle bg-{{ $healthInformation->color }} text-white me-3">
                            <i class="{{ $healthInformation->icon }}"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $healthInformation->name }}</h6>
                            <small class="text-muted">{{ $healthInformation->slug }}</small>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="p-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Status</div>
                                <span class="badge bg-{{ $healthInformation->is_active ? 'success' : 'secondary' }}">
                                    {{ $healthInformation->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Darurat</div>
                                <span class="badge bg-{{ $healthInformation->is_emergency ? 'danger' : 'light text-dark' }}">
                                    {{ $healthInformation->is_emergency ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-eye me-2"></i>Preview Perubahan
                    </h6>
                </div>
                <div class="card-body">
                    <div id="preview-card" class="border rounded p-3">
                        <div class="d-flex align-items-center mb-2">
                            <div id="preview-icon" class="icon-circle bg-{{ $healthInformation->color }} text-white me-3">
                                <i class="{{ $healthInformation->icon }}"></i>
                            </div>
                            <div>
                                <h6 id="preview-name" class="mb-0">{{ $healthInformation->name }}</h6>
                                <small id="preview-description" class="text-muted">{{ $healthInformation->description }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <h6>Panduan Edit:</h6>
                        <ul class="small text-muted">
                            <li>Pastikan nama gejala tetap jelas dan mudah dipahami</li>
                            <li>Update deskripsi jika ada perubahan informasi</li>
                            <li>Periksa kembali tips perawatan dan kondisi darurat</li>
                            <li>Simpan perubahan setelah selesai mengedit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dynamic form fields
    setupDynamicFields();
    
    // Preview functionality
    setupPreview();
});

function setupDynamicFields() {
    // Care Tips
    document.getElementById('add-care-tip').addEventListener('click', function() {
        const container = document.getElementById('care-tips-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 care-tip-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="care_tips[]" placeholder="Masukkan tips perawatan" required>
            <button type="button" class="btn btn-outline-danger remove-care-tip">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newItem);
    });

    // Doctor Conditions
    document.getElementById('add-doctor-condition').addEventListener('click', function() {
        const container = document.getElementById('doctor-conditions-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 doctor-condition-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="when_to_doctor[]" placeholder="Kondisi yang memerlukan konsultasi dokter" required>
            <button type="button" class="btn btn-outline-danger remove-doctor-condition">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newItem);
    });

    // Avoid Items
    document.getElementById('add-avoid').addEventListener('click', function() {
        const container = document.getElementById('avoid-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 avoid-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="avoid[]" placeholder="Hal yang harus dihindari">
            <button type="button" class="btn btn-outline-danger remove-avoid">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newItem);
    });

    // Remove buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-care-tip')) {
            const container = document.getElementById('care-tips-container');
            if (container.children.length > 1) {
                e.target.closest('.care-tip-item').remove();
            }
        }
        
        if (e.target.closest('.remove-doctor-condition')) {
            const container = document.getElementById('doctor-conditions-container');
            if (container.children.length > 1) {
                e.target.closest('.doctor-condition-item').remove();
            }
        }
        
        if (e.target.closest('.remove-avoid')) {
            e.target.closest('.avoid-item').remove();
        }
    });
}

function setupPreview() {
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const iconSelect = document.getElementById('icon');
    const colorSelect = document.getElementById('color');
    
    const previewName = document.getElementById('preview-name');
    const previewDescription = document.getElementById('preview-description');
    const previewIcon = document.getElementById('preview-icon');
    
    function updatePreview() {
        previewName.textContent = nameInput.value || '{{ $healthInformation->name }}';
        previewDescription.textContent = descriptionInput.value || '{{ $healthInformation->description }}';
        
        // Update icon
        const iconClass = iconSelect.value || '{{ $healthInformation->icon }}';
        previewIcon.innerHTML = `<i class="${iconClass}"></i>`;
        
        // Update color
        const color = colorSelect.value || '{{ $healthInformation->color }}';
        previewIcon.className = `icon-circle bg-${color} text-white me-3`;
    }
    
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    iconSelect.addEventListener('change', updatePreview);
    colorSelect.addEventListener('change', updatePreview);
}
</script>

<style>
.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.bg-blue { background-color: #3b82f6 !important; }
.bg-green { background-color: #10b981 !important; }
.bg-red { background-color: #ef4444 !important; }
.bg-yellow { background-color: #f59e0b !important; }
.bg-purple { background-color: #8b5cf6 !important; }
.bg-orange { background-color: #f97316 !important; }
.bg-pink { background-color: #ec4899 !important; }
.bg-indigo { background-color: #6366f1 !important; }
</style>
@endsection
