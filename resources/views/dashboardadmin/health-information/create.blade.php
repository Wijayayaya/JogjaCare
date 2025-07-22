@extends('dashboardadmin.layouts.app')

@section('title', 'Tambah Informasi Kesehatan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }
    
    .page-container {
        padding: 2rem 0;
    }
    
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .page-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }
    
    .page-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
        position: relative;
        z-index: 2;
    }
    
    .action-buttons {
        position: relative;
        z-index: 2;
    }
    
    .main-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.5rem 2rem;
        border: none;
        position: relative;
    }
    
    .card-header-custom::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .form-section {
        padding: 2rem;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }
    
    .form-section:last-child {
        border-bottom: none;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .section-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }
    
    .section-description {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
        margin-top: 0.25rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label-custom {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.95rem;
    }
    
    .form-control-custom {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f9fafb;
        width: 100%;
    }
    
    .form-control-custom:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
    }
    
    .form-control-custom.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }
    
    .form-select-custom {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f9fafb;
        width: 100%;
    }
    
    .form-select-custom:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
    }
    
    .dynamic-section {
        background: #f8fafc;
        border-radius: 15px;
        padding: 1.5rem;
        border: 2px dashed #cbd5e1;
        margin-top: 1rem;
    }
    
    .dynamic-item {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .dynamic-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .btn-custom {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.2);
        transition: left 0.3s ease;
    }
    
    .btn-custom:hover::before {
        left: 100%;
    }
    
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-success-custom {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .btn-secondary-custom {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        color: white;
    }
    
    .btn-warning-custom {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .btn-add {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .btn-remove {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
        border: none;
        border-radius: 6px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .preview-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
        position: sticky;
        top: 2rem;
    }
    
    .preview-header {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        padding: 1.5rem;
        border: none;
    }
    
    .preview-body {
        padding: 2rem;
    }
    
    .preview-item {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        border: 2px dashed #cbd5e1;
        transition: all 0.3s ease;
    }
    
    .preview-item:hover {
        border-color: #667eea;
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
    }
    
    .preview-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin: 0 auto 1rem;
        position: relative;
        overflow: hidden;
    }
    
    .preview-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.2);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .preview-icon:hover::before {
        transform: translateX(100%);
    }
    
    .bg-blue-gradient { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
    .bg-green-gradient { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    .bg-red-gradient { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
    .bg-yellow-gradient { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .bg-purple-gradient { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
    .bg-orange-gradient { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
    .bg-pink-gradient { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
    .bg-indigo-gradient { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
    
    .checkbox-custom {
        background: #f9fafb;
        border-radius: 12px;
        padding: 1.5rem;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }
    
    .checkbox-custom:hover {
        border-color: #667eea;
        background: #f0f4ff;
    }
    
    .checkbox-custom input:checked ~ .checkbox-label {
        color: #667eea;
        font-weight: 600;
    }
    
    .alert-custom {
        border: none;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .alert-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--alert-color);
    }
    
    .alert-danger-custom {
        background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        color: #991b1b;
        --alert-color: #ef4444;
    }
    
    .guidelines {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid #bae6fd;
        margin-top: 1.5rem;
    }
    
    .guidelines h6 {
        color: #0369a1;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .guidelines ul {
        margin: 0;
        padding-left: 1.25rem;
    }
    
    .guidelines li {
        color: #0c4a6e;
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
    
    .form-text-custom {
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }
    
    .invalid-feedback {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 0.5rem;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .required-mark {
        color: #ef4444;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header animate-fade-in">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center">
                        <div class="preview-icon bg-white me-3" style="background: rgba(255,255,255,0.2) !important;">
                            <i class="fas fa-plus-circle" style="color: white;"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Tambah Informasi Kesehatan</h1>
                            <p class="page-subtitle">Tambahkan informasi kesehatan dan gejala baru untuk platform edukasi medis</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="action-buttons text-lg-end">
                        <a href="{{ route('dashboardadmin.health-information.index') }}" class="btn btn-secondary-custom btn-custom me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="button" class="btn btn-warning-custom btn-custom" onclick="resetForm()">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Alert -->
        @if($errors->any())
            <div class="alert alert-danger-custom alert-custom alert-dismissible fade show animate-fade-in" role="alert">
                <div class="d-flex align-items-start">
                    <i class="fas fa-exclamation-circle me-3 fs-4 mt-1"></i>
                    <div class="flex-grow-1">
                        <strong>Terdapat kesalahan pada form:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8">
                <div class="main-card animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="card-header-custom">
                        <h5 class="mb-0 fw-bold text-white">
                            <i class="fas fa-edit me-2"></i>Form Informasi Kesehatan
                        </h5>
                        <p class="mb-0 text-white-50 small mt-1">Lengkapi semua informasi dengan detail dan akurat</p>
                    </div>
                    
                    <form action="{{ route('dashboardadmin.health-information.store') }}" method="POST" id="healthForm">
                        @csrf
                        
                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div>
                                    <h3 class="section-title">Informasi Dasar</h3>
                                    <p class="section-description">Data dasar tentang gejala atau kondisi kesehatan</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="form-label-custom">
                                            Nama Gejala/Kondisi <span class="required-mark">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control-custom @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Contoh: Demam, Batuk, Sakit Kepala"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sort_order" class="form-label-custom">Urutan Tampil</label>
                                        <input type="number" 
                                               class="form-control-custom @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" 
                                               name="sort_order" 
                                               value="{{ old('sort_order', 0) }}" 
                                               min="0"
                                               placeholder="0">
                                        <div class="form-text-custom">Urutan tampil di daftar (0 = paling atas)</div>
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label-custom">
                                    Deskripsi Singkat <span class="required-mark">*</span>
                                </label>
                                <textarea class="form-control-custom @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3" 
                                          placeholder="Deskripsi singkat yang akan muncul di daftar gejala (maksimal 200 karakter)"
                                          required>{{ old('description') }}</textarea>
                                <div class="form-text-custom">Deskripsi singkat untuk preview di daftar gejala</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="what_is" class="form-label-custom">
                                    Penjelasan Lengkap <span class="required-mark">*</span>
                                </label>
                                <textarea class="form-control-custom @error('what_is') is-invalid @enderror" 
                                          id="what_is" 
                                          name="what_is" 
                                          rows="4" 
                                          placeholder="Penjelasan detail tentang gejala/kondisi ini untuk edukasi pengguna"
                                          required>{{ old('what_is') }}</textarea>
                                <div class="form-text-custom">Penjelasan detail untuk edukasi pengguna</div>
                                @error('what_is')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Care Tips Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div>
                                    <h3 class="section-title">Tips Perawatan</h3>
                                    <p class="section-description">Saran perawatan yang aman dan dapat dilakukan sendiri</p>
                                </div>
                            </div>
                            
                            <div class="dynamic-section">
                                <label class="form-label-custom mb-3">
                                    Tips Perawatan <span class="required-mark">*</span>
                                </label>
                                <div id="care-tips-container">
                                    @if(old('care_tips'))
                                        @foreach(old('care_tips') as $index => $tip)
                                            <div class="dynamic-item">
                                                <div class="d-flex gap-2">
                                                    <input type="text" 
                                                           class="form-control-custom flex-grow-1" 
                                                           name="care_tips[]" 
                                                           value="{{ $tip }}" 
                                                           placeholder="Contoh: Istirahat yang cukup, Minum air putih yang banyak"
                                                           required>
                                                    <button type="button" class="btn-remove remove-care-tip">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="dynamic-item">
                                            <div class="d-flex gap-2">
                                                <input type="text" 
                                                       class="form-control-custom flex-grow-1" 
                                                       name="care_tips[]" 
                                                       placeholder="Contoh: Istirahat yang cukup, Minum air putih yang banyak"
                                                       required>
                                                <button type="button" class="btn-remove remove-care-tip">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn-add" id="add-care-tip">
                                    <i class="fas fa-plus me-2"></i>Tambah Tips Perawatan
                                </button>
                                @error('care_tips')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- When to Doctor Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div>
                                    <h3 class="section-title">Kapan Harus ke Dokter</h3>
                                    <p class="section-description">Kondisi yang memerlukan konsultasi medis profesional</p>
                                </div>
                            </div>
                            
                            <div class="dynamic-section">
                                <label class="form-label-custom mb-3">
                                    Kapan Harus ke Dokter <span class="required-mark">*</span>
                                </label>
                                <div id="doctor-conditions-container">
                                    @if(old('when_to_doctor'))
                                        @foreach(old('when_to_doctor') as $index => $condition)
                                            <div class="dynamic-item">
                                                <div class="d-flex gap-2">
                                                    <input type="text" 
                                                           class="form-control-custom flex-grow-1" 
                                                           name="when_to_doctor[]" 
                                                           value="{{ $condition }}" 
                                                           placeholder="Contoh: Demam tinggi lebih dari 3 hari, Sesak napas"
                                                           required>
                                                    <button type="button" class="btn-remove remove-doctor-condition">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="dynamic-item">
                                            <div class="d-flex gap-2">
                                                <input type="text" 
                                                       class="form-control-custom flex-grow-1" 
                                                       name="when_to_doctor[]" 
                                                       placeholder="Contoh: Demam tinggi lebih dari 3 hari, Sesak napas"
                                                       required>
                                                <button type="button" class="btn-remove remove-doctor-condition">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn-add" id="add-doctor-condition">
                                    <i class="fas fa-plus me-2"></i>Tambah Kondisi Dokter
                                </button>
                                @error('when_to_doctor')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Things to Avoid Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <div>
                                    <h3 class="section-title">Yang Harus Dihindari</h3>
                                    <p class="section-description">Hal-hal yang sebaiknya dihindari (opsional)</p>
                                </div>
                            </div>
                            
                            <div class="dynamic-section">
                                <label class="form-label-custom mb-3">Yang Harus Dihindari</label>
                                <div id="avoid-container">
                                    @if(old('avoid'))
                                        @foreach(old('avoid') as $index => $avoid)
                                            <div class="dynamic-item">
                                                <div class="d-flex gap-2">
                                                    <input type="text" 
                                                           class="form-control-custom flex-grow-1" 
                                                           name="avoid[]" 
                                                           value="{{ $avoid }}"
                                                           placeholder="Contoh: Makanan pedas, Aktivitas berat">
                                                    <button type="button" class="btn-remove remove-avoid">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="dynamic-item">
                                            <div class="d-flex gap-2">
                                                <input type="text" 
                                                       class="form-control-custom flex-grow-1" 
                                                       name="avoid[]" 
                                                       placeholder="Contoh: Makanan pedas, Aktivitas berat">
                                                <button type="button" class="btn-remove remove-avoid">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn-add" id="add-avoid">
                                    <i class="fas fa-plus me-2"></i>Tambah Item yang Dihindari
                                </button>
                            </div>
                        </div>

                        <!-- Appearance Settings Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <div>
                                    <h3 class="section-title">Pengaturan Tampilan</h3>
                                    <p class="section-description">Icon dan warna untuk identifikasi visual</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon" class="form-label-custom">
                                            Icon <span class="required-mark">*</span>
                                        </label>
                                        <select class="form-select-custom @error('icon') is-invalid @enderror" id="icon" name="icon" required>
                                            <option value="">Pilih Icon</option>
                                            @foreach($icons as $value => $label)
                                                <option value="{{ $value }}" {{ old('icon') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color" class="form-label-custom">
                                            Warna <span class="required-mark">*</span>
                                        </label>
                                        <select class="form-select-custom @error('color') is-invalid @enderror" id="color" name="color" required>
                                            <option value="">Pilih Warna</option>
                                            @foreach($colors as $value => $label)
                                                <option value="{{ $value }}" {{ old('color') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Settings Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div>
                                    <h3 class="section-title">Pengaturan Status</h3>
                                    <p class="section-description">Status dan kategori informasi kesehatan</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkbox-custom">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_emergency" name="is_emergency" value="1" {{ old('is_emergency') ? 'checked' : '' }}>
                                            <label class="form-check-label checkbox-label fw-semibold" for="is_emergency">
                                                <span class="text-danger">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>Kondisi Darurat
                                                </span>
                                                <div class="form-text-custom mt-1">Centang jika ini adalah kondisi yang memerlukan penanganan darurat</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox-custom">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label checkbox-label fw-semibold" for="is_active">
                                                <span class="text-success">
                                                    <i class="fas fa-eye me-2"></i>Status Aktif
                                                </span>
                                                <div class="form-text-custom mt-1">Informasi akan ditampilkan di frontend</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-section">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('dashboardadmin.health-information.index') }}" class="btn btn-secondary-custom btn-custom">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="button" class="btn btn-warning-custom btn-custom" onclick="resetForm()">
                                    <i class="fas fa-redo me-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary-custom btn-custom">
                                    <i class="fas fa-save me-2"></i>Simpan Informasi Kesehatan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview Sidebar -->
            <div class="col-lg-4">
                <div class="preview-card animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="preview-header">
                        <h6 class="mb-0 fw-bold text-white">
                            <i class="fas fa-eye me-2"></i>Preview Real-time
                        </h6>
                        <p class="mb-0 text-white-50 small">Lihat bagaimana tampilan akan muncul</p>
                    </div>
                    <div class="preview-body">
                        <div class="preview-item" id="preview-card">
                            <div id="preview-icon" class="preview-icon bg-blue-gradient">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h6 id="preview-name" class="fw-bold text-dark mb-2">Nama Gejala</h6>
                            <p id="preview-description" class="text-muted small mb-0">Deskripsi akan muncul di sini</p>
                        </div>
                        
                        <div class="guidelines">
                            <h6><i class="fas fa-lightbulb me-2"></i>Panduan Pengisian</h6>
                            <ul class="small">
                                <li>Nama gejala harus jelas dan mudah dipahami oleh pengguna umum</li>
                                <li>Deskripsi singkat untuk preview di daftar (maksimal 200 karakter)</li>
                                <li>Tips perawatan berisi saran umum yang aman dan dapat dilakukan sendiri</li>
                                <li>Kondisi dokter berisi tanda bahaya yang memerlukan konsultasi medis</li>
                                <li>Centang "Kondisi Darurat" untuk gejala yang memerlukan penanganan segera</li>
                                <li>Pastikan semua informasi akurat dan berdasarkan sumber medis terpercaya</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    setupDynamicFields();
    setupPreview();
    setupFormValidation();
});

function setupDynamicFields() {
    // Care Tips
    document.getElementById('add-care-tip').addEventListener('click', function() {
        const container = document.getElementById('care-tips-container');
        const newItem = document.createElement('div');
        newItem.className = 'dynamic-item';
        newItem.innerHTML = `
            <div class="d-flex gap-2">
                <input type="text" class="form-control-custom flex-grow-1" name="care_tips[]" placeholder="Contoh: Istirahat yang cukup, Minum air putih yang banyak" required>
                <button type="button" class="btn-remove remove-care-tip">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newItem);
        animateNewItem(newItem);
    });

    // Doctor Conditions
    document.getElementById('add-doctor-condition').addEventListener('click', function() {
        const container = document.getElementById('doctor-conditions-container');
        const newItem = document.createElement('div');
        newItem.className = 'dynamic-item';
        newItem.innerHTML = `
            <div class="d-flex gap-2">
                <input type="text" class="form-control-custom flex-grow-1" name="when_to_doctor[]" placeholder="Contoh: Demam tinggi lebih dari 3 hari, Sesak napas" required>
                <button type="button" class="btn-remove remove-doctor-condition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newItem);
        animateNewItem(newItem);
    });

    // Avoid Items
    document.getElementById('add-avoid').addEventListener('click', function() {
        const container = document.getElementById('avoid-container');
        const newItem = document.createElement('div');
        newItem.className = 'dynamic-item';
        newItem.innerHTML = `
            <div class="d-flex gap-2">
                <input type="text" class="form-control-custom flex-grow-1" name="avoid[]" placeholder="Contoh: Makanan pedas, Aktivitas berat">
                <button type="button" class="btn-remove remove-avoid">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newItem);
        animateNewItem(newItem);
    });

    // Remove buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-care-tip')) {
            const container = document.getElementById('care-tips-container');
            if (container.children.length > 1) {
                animateRemoveItem(e.target.closest('.dynamic-item'));
            } else {
                alert('Minimal harus ada satu tips perawatan');
            }
        }
        
        if (e.target.closest('.remove-doctor-condition')) {
            const container = document.getElementById('doctor-conditions-container');
            if (container.children.length > 1) {
                animateRemoveItem(e.target.closest('.dynamic-item'));
            } else {
                alert('Minimal harus ada satu kondisi dokter');
            }
        }
        
        if (e.target.closest('.remove-avoid')) {
            animateRemoveItem(e.target.closest('.dynamic-item'));
        }
    });
}

function animateNewItem(item) {
    item.style.opacity = '0';
    item.style.transform = 'translateY(-20px)';
    setTimeout(() => {
        item.style.transition = 'all 0.3s ease';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
    }, 10);
}

function animateRemoveItem(item) {
    item.style.transition = 'all 0.3s ease';
    item.style.opacity = '0';
    item.style.transform = 'translateX(-20px)';
    setTimeout(() => {
        item.remove();
    }, 300);
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
        previewName.textContent = nameInput.value || 'Nama Gejala';
        previewDescription.textContent = descriptionInput.value || 'Deskripsi akan muncul di sini';
        
        // Update icon
        const iconClass = iconSelect.value || 'fas fa-heartbeat';
        previewIcon.innerHTML = `<i class="${iconClass}"></i>`;
        
        // Update color
        const color = colorSelect.value || 'blue';
        previewIcon.className = `preview-icon bg-${color}-gradient`;
    }
    
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    iconSelect.addEventListener('change', updatePreview);
    colorSelect.addEventListener('change', updatePreview);
}

function setupFormValidation() {
    const form = document.getElementById('healthForm');
    
    form.addEventListener('submit', function(e) {
        const careTips = document.querySelectorAll('input[name="care_tips[]"]');
        const doctorConditions = document.querySelectorAll('input[name="when_to_doctor[]"]');
        
        let hasEmptyCareTips = false;
        let hasEmptyDoctorConditions = false;
        
        careTips.forEach(input => {
            if (!input.value.trim()) {
                hasEmptyCareTips = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        doctorConditions.forEach(input => {
            if (!input.value.trim()) {
                hasEmptyDoctorConditions = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        if (hasEmptyCareTips || hasEmptyDoctorConditions) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
}

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset semua data form? Semua data yang telah diisi akan hilang.')) {
        document.getElementById('healthForm').reset();
        
        // Reset dynamic fields to initial state
        resetDynamicFields();
        
        // Reset preview
        document.getElementById('preview-name').textContent = 'Nama Gejala';
        document.getElementById('preview-description').textContent = 'Deskripsi akan muncul di sini';
        document.getElementById('preview-icon').className = 'preview-icon bg-blue-gradient';
        document.getElementById('preview-icon').innerHTML = '<i class="fas fa-heartbeat"></i>';
    }
}

function resetDynamicFields() {
    document.getElementById('care-tips-container').innerHTML = `
        <div class="dynamic-item">
            <div class="d-flex gap-2">
                <input type="text" class="form-control-custom flex-grow-1" name="care_tips[]" placeholder="Contoh: Istirahat yang cukup, Minum air putih yang banyak" required>
                <button type="button" class="btn-remove remove-care-tip">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    document.getElementById('doctor-conditions-container').innerHTML = `
        <div class="dynamic-item">
            <div class="d-flex gap-2">
                <input type="text" class="form-control-custom flex-grow-1" name="when_to_doctor[]" placeholder="Contoh: Demam tinggi lebih dari 3 hari, Sesak napas" required>
                <button type="button" class="btn-remove remove-doctor-condition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    document.getElementById('avoid-container').innerHTML = `
        <div class="dynamic-item">
            <div class="d-flex gap-2">
                <input type="text" class="form-control-custom flex-grow-1" name="avoid[]" placeholder="Contoh: Makanan pedas, Aktivitas berat">
                <button type="button" class="btn-remove remove-avoid">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
}
</script>
@endpush
