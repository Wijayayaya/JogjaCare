@extends('dashboardadmin.layouts.app')

@section('title', 'Detail Informasi Kesehatan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    
    .detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 25px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .detail-header::before {
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
    
    .detail-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    
    .card-header-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.5rem 2rem;
        border: none;
        position: relative;
    }
    
    .card-header-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        padding: 1.5rem 2rem;
        border: none;
    }
    
    .card-header-success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        padding: 1.5rem 2rem;
        border: none;
    }
    
    .card-header-warning {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        padding: 1.5rem 2rem;
        border: none;
    }
    
    .card-header-danger {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        padding: 1.5rem 2rem;
        border: none;
    }
    
    .icon-circle-large {
        width: 80px;
        height: 80px;
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .icon-circle-large::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.2);
        transform: translateX(-100%);
        transition: transform 0.5s ease;
    }
    
    .icon-circle-large:hover::before {
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
    
    .info-section {
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .info-section-primary {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-left: 5px solid #667eea;
    }
    
    .info-section-success {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        border-left: 5px solid #10b981;
    }
    
    .info-section-warning {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        border-left: 5px solid #f59e0b;
    }
    
    .info-section-danger {
        background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        border-left: 5px solid #ef4444;
    }
    
    .tip-item {
        background: white;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #10b981;
        transition: all 0.3s ease;
    }
    
    .tip-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .doctor-item {
        background: white;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #f59e0b;
        transition: all 0.3s ease;
    }
    
    .doctor-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .avoid-item {
        background: white;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #ef4444;
        transition: all 0.3s ease;
    }
    
    .avoid-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .btn-modern {
        border-radius: 15px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.2);
        transition: left 0.3s ease;
    }
    
    .btn-modern:hover::before {
        left: 100%;
    }
    
    .btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-success-modern {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .btn-warning-modern {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .btn-danger-modern {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #dc2626;
    }
    
    .btn-info-modern {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #0369a1;
    }
    
    .btn-secondary-modern {
        background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%);
        color: #374151;
    }
    
    .badge-modern {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-success-modern {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .badge-danger-modern {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .badge-secondary-modern {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        color: #475569;
    }
    
    .badge-warning-modern {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        color: #92400e;
    }
    
    .stats-mini {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .stats-mini:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .preview-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 2rem;
        border: 2px dashed #cbd5e1;
        transition: all 0.3s ease;
    }
    
    .preview-card:hover {
        border-color: #667eea;
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
    }
    
    .metadata-item {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border-left: 3px solid #667eea;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 0.75rem;
        width: 24px;
        text-align: center;
    }
    
    .counter-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 50px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
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
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
    
    .animate-pulse-custom {
        animation: pulse 2s infinite;
    }
    
    .modal-modern .modal-content {
        border: none;
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }
    
    .modal-modern .modal-header {
        border: none;
        border-radius: 25px 25px 0 0;
        padding: 2rem;
    }
    
    .modal-modern .modal-body {
        padding: 2rem;
    }
    
    .modal-modern .modal-footer {
        border: none;
        padding: 2rem;
        border-radius: 0 0 25px 25px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Detail Header -->
    <div class="detail-header animate-fade-in-up">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle-large bg-{{ $healthInformation->color }}-gradient me-4">
                        <i class="{{ $healthInformation->icon }}"></i>
                    </div>
                    <div>
                        <h1 class="h2 mb-2 fw-bold">{{ $healthInformation->name }}</h1>
                        <p class="mb-1 opacity-75">{{ $healthInformation->description }}</p>
                        <div class="d-flex align-items-center">
                            <code class="bg-white bg-opacity-20 px-3 py-1 rounded-pill text-white">{{ $healthInformation->slug }}</code>
                            @if($healthInformation->is_emergency)
                                <span class="badge badge-danger-modern ms-2 animate-pulse-custom">
                                    <i class="fas fa-exclamation-triangle me-1"></i>DARURAT
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex gap-2 justify-content-lg-end flex-wrap">
                    <a href="{{ route('dashboardadmin.health-information.index') }}" class="btn btn-light btn-modern">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('dashboardadmin.health-information.edit', $healthInformation) }}" class="btn btn-warning btn-modern">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-modern" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- What Is Section -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-header-gradient">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-question-circle me-2"></i>Apa itu {{ $healthInformation->name }}?
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="info-section info-section-primary">
                        <p class="mb-0 text-dark" style="line-height: 1.8; font-size: 1.1rem;">
                            {{ $healthInformation->what_is }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Care Tips Section -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="card-header-success">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-heart me-2"></i>Tips Perawatan
                        <span class="counter-badge">{{ count($healthInformation->care_tips) }} Tips</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($healthInformation->care_tips as $index => $tip)
                            <div class="col-md-6 mb-3">
                                <div class="tip-item">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.875rem; font-weight: 600;">
                                            {{ $index + 1 }}
                                        </div>
                                        <span class="text-dark" style="line-height: 1.6;">{{ $tip }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- When to Doctor Section -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="card-header-warning">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-user-md me-2"></i>Kapan Harus ke Dokter
                        <span class="counter-badge">{{ count($healthInformation->when_to_doctor) }} Kondisi</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($healthInformation->when_to_doctor as $index => $condition)
                            <div class="col-md-6 mb-3">
                                <div class="doctor-item">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-exclamation-triangle text-warning me-3 mt-1"></i>
                                        <span class="text-dark" style="line-height: 1.6;">{{ $condition }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Things to Avoid Section -->
            @if($healthInformation->avoid && count($healthInformation->avoid) > 0)
                <div class="detail-card animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="card-header-danger">
                        <h5 class="mb-0 fw-bold text-white">
                            <i class="fas fa-ban me-2"></i>Yang Harus Dihindari
                            <span class="counter-badge">{{ count($healthInformation->avoid) }} Item</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($healthInformation->avoid as $index => $avoid)
                                <div class="col-md-6 mb-3">
                                    <div class="avoid-item">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-times-circle text-danger me-3 mt-1"></i>
                                            <span class="text-dark" style="line-height: 1.6;">{{ $avoid }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Next Steps Section -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="card-header-info">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-route me-2"></i>Langkah Selanjutnya
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-section info-section-success">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Konsultasi Dokter</h6>
                                        <small class="text-muted">Jadwalkan konsultasi dengan dokter umum atau spesialis</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Catat Gejala</h6>
                                        <small class="text-muted">Buat catatan detail tentang gejala yang dialami</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Bawa Riwayat</h6>
                                        <small class="text-muted">Siapkan riwayat kesehatan dan obat yang sedang dikonsumsi</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Jangan Tunda</h6>
                                        <small class="text-muted">Jika gejala memburuk, segera cari bantuan medis</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <a href="tel:119" class="btn btn-danger-modern btn-modern">
                                    <i class="fas fa-phone me-2"></i>Darurat: 119
                                </a>
                                <a href="tel:1500-567" class="btn btn-info-modern btn-modern">
                                    <i class="fas fa-ambulance me-2"></i>Ambulans: 1500-567
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status & Settings Card -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-header-info">
                    <h6 class="mb-0 fw-bold text-white">
                        <i class="fas fa-cog me-2"></i>Status & Pengaturan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-6">
                            <div class="stats-mini">
                                <div class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem;">Status</div>
                                @if($healthInformation->is_active)
                                    <span class="badge badge-success-modern fs-6">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="badge badge-secondary-modern fs-6">
                                        <i class="fas fa-times-circle me-1"></i>Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-mini">
                                <div class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem;">Urutan</div>
                                <span class="badge badge-secondary-modern fs-6">{{ $healthInformation->sort_order }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="d-grid gap-2">
                        <form action="{{ route('dashboardadmin.health-information.toggle-status', $healthInformation) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-modern w-100 {{ $healthInformation->is_active ? 'btn-warning-modern' : 'btn-success-modern' }}">
                                <i class="fas fa-{{ $healthInformation->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $healthInformation->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="card-header-gradient">
                    <h6 class="mb-0 fw-bold text-white">
                        <i class="fas fa-info me-2"></i>Informasi Metadata
                    </h6>
                </div>
                <div class="card-body">
                    <div class="metadata-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">Dibuat pada</small>
                                <strong>{{ $healthInformation->created_at->format('d F Y, H:i') }}</strong>
                            </div>
                            <i class="fas fa-calendar-plus text-primary"></i>
                        </div>
                    </div>
                    
                    <div class="metadata-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">Terakhir diupdate</small>
                                <strong>{{ $healthInformation->updated_at->format('d F Y, H:i') }}</strong>
                            </div>
                            <i class="fas fa-calendar-edit text-warning"></i>
                        </div>
                    </div>
                    
                    <div class="metadata-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">ID Sistem</small>
                                <code class="bg-light px-2 py-1 rounded">{{ $healthInformation->id }}</code>
                            </div>
                            <i class="fas fa-hashtag text-info"></i>
                        </div>
                    </div>
                    
                    <div class="metadata-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">URL Slug</small>
                                <code class="bg-light px-2 py-1 rounded">{{ $healthInformation->slug }}</code>
                            </div>
                            <i class="fas fa-link text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="card-header-success">
                    <h6 class="mb-0 fw-bold text-white">
                        <i class="fas fa-chart-bar me-2"></i>Statistik Konten
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="stats-mini">
                                <div class="text-success fw-bold fs-4">{{ count($healthInformation->care_tips) }}</div>
                                <small class="text-muted">Tips Perawatan</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-mini">
                                <div class="text-warning fw-bold fs-4">{{ count($healthInformation->when_to_doctor) }}</div>
                                <small class="text-muted">Kondisi Dokter</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-mini">
                                <div class="text-danger fw-bold fs-4">{{ $healthInformation->avoid ? count($healthInformation->avoid) : 0 }}</div>
                                <small class="text-muted">Yang Dihindari</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Frontend Card -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="card-header-warning">
                    <h6 class="mb-0 fw-bold text-white">
                        <i class="fas fa-eye me-2"></i>Preview Frontend
                    </h6>
                </div>
                <div class="card-body">
                    <div class="preview-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle-large bg-{{ $healthInformation->color }}-gradient me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="{{ $healthInformation->icon }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold text-dark">{{ $healthInformation->name }}</h6>
                                <small class="text-muted">{{ $healthInformation->description }}</small>
                                @if($healthInformation->is_emergency)
                                    <div class="mt-2">
                                        <span class="badge badge-danger-modern">🚨 Darurat</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Tampilan ini akan muncul di halaman frontend
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade modal-modern" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <div class="icon-circle-large bg-red-gradient mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-trash"></i>
                    </div>
                    <h5 class="mb-3">Hapus Informasi Kesehatan?</h5>
                    <p class="text-muted">Apakah Anda yakin ingin menghapus informasi kesehatan <strong>"{{ $healthInformation->name }}"</strong>?</p>
                </div>
                <div class="alert alert-danger border-0" style="background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait!
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary-modern btn-modern" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form action="{{ route('dashboardadmin.health-information.destroy', $healthInformation) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-modern btn-modern">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading animation for buttons
    document.querySelectorAll('.btn-modern').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.type === 'submit') {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                this.disabled = true;
                
                // Re-enable after form submission
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 3000);
            }
        });
    });

    // Add smooth page load animation
    window.addEventListener('load', function() {
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 100);
    });
});
</script>
@endpush
