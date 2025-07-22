@extends('dashboardadmin.layouts.app')

@section('title', 'Manajemen Informasi Kesehatan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    
    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }
    
    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        transform: translate(-50%, 50%);
    }
    
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient);
    }
    
    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .stats-card.primary::before {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .stats-card.success::before {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stats-card.warning::before {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .stats-card.danger::before {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }
    
    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stats-card.primary .stats-number {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .stats-card.success .stats-number {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .stats-card.warning .stats-number {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .stats-card.danger .stats-number {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .main-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.5rem 2rem;
        border: none;
        position: relative;
    }
    
    .card-header-custom::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }
    
    .table-modern {
        margin: 0;
    }
    
    .table-modern thead th {
        background: #f8fafc;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #64748b;
        padding: 1rem 1.5rem;
    }
    
    .table-modern tbody tr {
        border: none;
        transition: all 0.3s ease;
    }
    
    .table-modern tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        transform: scale(1.01);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .table-modern tbody td {
        border: none;
        padding: 1.5rem;
        vertical-align: middle;
    }
    
    .icon-circle-modern {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .icon-circle-modern::before {
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
    
    .icon-circle-modern:hover::before {
        transform: translateX(100%);
    }
    
    .bg-blue-modern { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
    .bg-green-modern { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    .bg-red-modern { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
    .bg-yellow-modern { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .bg-purple-modern { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
    .bg-orange-modern { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
    .bg-pink-modern { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
    .bg-indigo-modern { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
    
    .btn-modern {
        border-radius: 12px;
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
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transition: all 0.3s ease;
        transform: translate(-50%, -50%);
    }
    
    .action-btn:hover::before {
        width: 100%;
        height: 100%;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .filter-dropdown {
        background: white;
        border-radius: 15px;
        border: 2px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
    
    .empty-state-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #94a3b8;
    }
    
    .pagination-modern .page-link {
        border: none;
        border-radius: 12px;
        margin: 0 0.25rem;
        padding: 0.75rem 1rem;
        color: #64748b;
        background: #f8fafc;
        transition: all 0.3s ease;
    }
    
    .pagination-modern .page-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
    }
    
    .pagination-modern .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
    
    .alert-modern {
        border: none;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .alert-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--alert-color);
    }
    
    .alert-success-modern {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        color: #065f46;
        --alert-color: #10b981;
    }
    
    .alert-danger-modern {
        background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        color: #991b1b;
        --alert-color: #ef4444;
    }
    
    .search-box {
        background: white;
        border-radius: 15px;
        border: 2px solid #e2e8f0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .search-box:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    .bulk-actions {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 15px;
        padding: 1rem;
        margin-bottom: 1rem;
        border: 2px dashed #cbd5e1;
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
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header animate-fade-in-up">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-4">
                        <div class="icon-circle-modern bg-white" style="background: rgba(255,255,255,0.2) !important;">
                            <i class="fas fa-heartbeat" style="color: white;"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="h2 mb-2 fw-bold">Manajemen Informasi Kesehatan</h1>
                        <p class="mb-0 opacity-75">Kelola informasi kesehatan dan gejala untuk platform edukasi dengan sistem yang terintegrasi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex gap-2 justify-content-lg-end">
                    <button class="btn btn-light btn-modern" onclick="refreshData()">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                    <a href="{{ route('dashboardadmin.health-information.create') }}" class="btn btn-warning btn-modern">
                        <i class="fas fa-plus me-2"></i>Tambah Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success-modern alert-modern alert-dismissible fade show animate-fade-in-up" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-4"></i>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger-modern alert-modern alert-dismissible fade show animate-fade-in-up" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                <div>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">Total Informasi</div>
                        <div class="stats-number">{{ $healthInfo->total() }}</div>
                        <div class="text-muted small">
                            <i class="fas fa-chart-line me-1"></i>
                            Semua data kesehatan
                        </div>
                    </div>
                    <div class="icon-circle-modern bg-primary-modern">
                        <i class="fas fa-database"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card success animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">Status Aktif</div>
                        <div class="stats-number">{{ $healthInfo->where('is_active', true)->count() }}</div>
                        <div class="text-muted small">
                            <i class="fas fa-check-circle me-1"></i>
                            Ditampilkan di frontend
                        </div>
                    </div>
                    <div class="icon-circle-modern bg-success-modern">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card warning animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">Kondisi Darurat</div>
                        <div class="stats-number">{{ $healthInfo->where('is_emergency', true)->count() }}</div>
                        <div class="text-muted small">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Memerlukan perhatian khusus
                        </div>
                    </div>
                    <div class="icon-circle-modern bg-warning-modern">
                        <i class="fas fa-ambulance"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card danger animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted text-uppercase fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">Nonaktif</div>
                        <div class="stats-number">{{ $healthInfo->where('is_active', false)->count() }}</div>
                        <div class="text-muted small">
                            <i class="fas fa-eye-slash me-1"></i>
                            Tidak ditampilkan
                        </div>
                    </div>
                    <div class="icon-circle-modern bg-danger-modern">
                        <i class="fas fa-pause-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control search-box me-2" 
                       placeholder="Cari nama gejala atau deskripsi..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary-modern btn-modern">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('dashboardadmin.health-information.index') }}" 
                       class="btn btn-secondary-modern btn-modern ms-2">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
        </div>
        <div class="col-md-6 text-end">
            <div class="dropdown">
                <button class="btn btn-info-modern btn-modern dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-2"></i>Filter Data
                </button>
                <ul class="dropdown-menu filter-dropdown">
                    <li><a class="dropdown-item" href="?filter=all"><i class="fas fa-list me-2"></i>Semua Data</a></li>
                    <li><a class="dropdown-item" href="?filter=active"><i class="fas fa-check-circle me-2"></i>Hanya Aktif</a></li>
                    <li><a class="dropdown-item" href="?filter=inactive"><i class="fas fa-times-circle me-2"></i>Hanya Nonaktif</a></li>
                    <li><a class="dropdown-item" href="?filter=emergency"><i class="fas fa-exclamation-triangle me-2"></i>Kondisi Darurat</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bulk Actions -->
    <div class="bulk-actions" id="bulkActions" style="display: none;">
        <form method="POST" action="{{ route('dashboardadmin.health-information.bulk-action') }}" id="bulkForm">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="fw-bold">
                        <span id="selectedCount">0</span> item dipilih
                    </span>
                </div>
                <div class="col-md-6 text-end">
                    <select name="action" class="form-select d-inline-block w-auto me-2" required>
                        <option value="">Pilih Aksi</option>
                        <option value="activate">Aktifkan</option>
                        <option value="deactivate">Nonaktifkan</option>
                        <option value="delete">Hapus</option>
                    </select>
                    <button type="submit" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-check me-1"></i>Jalankan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Content Card -->
    <div class="main-card animate-fade-in-up" style="animation-delay: 0.5s;">
        <div class="card-header-custom">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-table me-2"></i>Daftar Informasi Kesehatan
                    </h5>
                    <p class="mb-0 text-white-50 small">Kelola dan pantau semua informasi kesehatan dalam satu tempat</p>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label text-white" for="selectAll">
                            Pilih Semua
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-0">
            <div class="table-responsive">
                <table class="table table-modern" id="healthInfoTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">
                                <input type="checkbox" class="form-check-input" id="selectAllHeader">
                            </th>
                            <th class="text-center" style="width: 100px;">Icon</th>
                            <th>Informasi Gejala</th>
                            <th style="width: 350px;">Deskripsi & Detail</th>
                            <th class="text-center" style="width: 120px;">Status</th>
                            <th class="text-center" style="width: 120px;">Prioritas</th>
                            <th class="text-center" style="width: 80px;">Urutan</th>
                            <th class="text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($healthInfo as $info)
                            <tr class="health-info-row" data-id="{{ $info->id }}">
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input row-checkbox" 
                                           name="selected_items[]" value="{{ $info->id }}">
                                </td>
                                <td class="text-center">
                                    <div class="icon-circle-modern bg-{{ $info->color }}-modern mx-auto">
                                        <i class="{{ $info->icon }}"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 fw-bold text-dark">{{ $info->name }}</h6>
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="fas fa-link me-1"></i>
                                            <code class="bg-light px-2 py-1 rounded">{{ $info->slug }}</code>
                                        </div>
                                        <div class="text-muted small mt-1">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $info->created_at->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <p class="mb-2 text-dark" style="line-height: 1.5;">
                                            {{ Str::limit($info->description, 120) }}
                                        </p>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <span class="badge badge-secondary-modern">
                                                <i class="fas fa-heart me-1"></i>{{ count($info->care_tips) }} Tips
                                            </span>
                                            <span class="badge badge-warning-modern">
                                                <i class="fas fa-user-md me-1"></i>{{ count($info->when_to_doctor) }} Kondisi
                                            </span>
                                            @if($info->avoid && count($info->avoid) > 0)
                                                <span class="badge badge-danger-modern">
                                                    <i class="fas fa-ban me-1"></i>{{ count($info->avoid) }} Hindari
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('dashboardadmin.health-information.toggle-status', $info) }}" 
                                          method="POST" class="d-inline status-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-modern status-btn {{ $info->is_active ? 'btn-success-modern' : 'btn-secondary-modern' }}"
                                                title="Klik untuk {{ $info->is_active ? 'nonaktifkan' : 'aktifkan' }}">
                                            <i class="fas fa-{{ $info->is_active ? 'check' : 'times' }} me-1"></i>
                                            {{ $info->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    @if($info->is_emergency)
                                        <span class="badge badge-danger-modern animate-pulse-custom">
                                            <i class="fas fa-exclamation-triangle me-1"></i>DARURAT
                                        </span>
                                    @else
                                        <span class="badge badge-success-modern">
                                            <i class="fas fa-check-circle me-1"></i>NORMAL
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-secondary-modern fs-6">{{ $info->sort_order }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('dashboardadmin.health-information.show', $info) }}" 
                                           class="action-btn bg-info-modern" 
                                           title="Lihat Detail"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye text-white"></i>
                                        </a>
                                        <a href="{{ route('dashboardadmin.health-information.edit', $info) }}" 
                                           class="action-btn bg-warning-modern" 
                                           title="Edit"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                        <form action="{{ route('dashboardadmin.health-information.destroy', $info) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $info->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn bg-danger-modern" title="Hapus" data-bs-toggle="tooltip">
                                                <i class="fas fa-trash text-white"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-heartbeat"></i>
                                        </div>
                                        <h4 class="text-muted mb-3">Belum Ada Informasi Kesehatan</h4>
                                        <p class="text-muted mb-4">Mulai dengan menambahkan informasi kesehatan pertama untuk platform edukasi Anda.</p>
                                        <a href="{{ route('dashboardadmin.health-information.create') }}" 
                                           class="btn btn-primary-modern btn-modern">
                                            <i class="fas fa-plus me-2"></i>Tambah Informasi Kesehatan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($healthInfo->hasPages())
            <div class="p-4 bg-light" style="border-radius: 0 0 25px 25px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Menampilkan {{ $healthInfo->firstItem() }} - {{ $healthInfo->lastItem() }} 
                        dari {{ $healthInfo->total() }} data
                    </div>
                    <nav>
                        <ul class="pagination pagination-modern mb-0">
                            {{ $healthInfo->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade modal-modern" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger-modern">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <div class="icon-circle-modern bg-danger-modern mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-trash"></i>
                    </div>
                    <h5 class="mb-3">Hapus Informasi Kesehatan?</h5>
                    <p class="text-muted">Apakah Anda yakin ingin menghapus informasi kesehatan <strong id="deleteName"></strong>?</p>
                </div>
                <div class="alert alert-danger-modern">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait!
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary-modern btn-modern" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-modern btn-modern" id="confirmDeleteBtn">
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

    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const url = this.dataset.url;
            
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = url;
            
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });

    // Handle delete form submission
    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('confirmDeleteBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...';
        btn.disabled = true;
    });

    // Status toggle with confirmation
    document.querySelectorAll('.status-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = this.querySelector('.status-btn');
            const isActive = btn.classList.contains('btn-success-modern');
            const action = isActive ? 'nonaktifkan' : 'aktifkan';
            
            if (confirm(`Apakah Anda yakin ingin ${action} informasi kesehatan ini?`)) {
                // Show loading state
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
                btn.disabled = true;
                
                this.submit();
            }
        });
    });

    // Bulk selection functionality
    const selectAll = document.getElementById('selectAll');
    const selectAllHeader = document.getElementById('selectAllHeader');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');
    const bulkForm = document.getElementById('bulkForm');

    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const count = checkedBoxes.length;
        
        selectedCount.textContent = count;
        
        if (count > 0) {
            bulkActions.style.display = 'block';
            // Add selected IDs to bulk form
            const existingInputs = bulkForm.querySelectorAll('input[name="selected_items[]"]');
            existingInputs.forEach(input => input.remove());
            
            checkedBoxes.forEach(checkbox => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_items[]';
                input.value = checkbox.value;
                bulkForm.appendChild(input);
            });
        } else {
            bulkActions.style.display = 'none';
        }
    }

    // Select all functionality
    [selectAll, selectAllHeader].forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const isChecked = this.checked;
            rowCheckboxes.forEach(cb => {
                cb.checked = isChecked;
            });
            // Sync both select all checkboxes
            selectAll.checked = isChecked;
            selectAllHeader.checked = isChecked;
            updateBulkActions();
        });
    });

    // Individual checkbox functionality
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);
            
            selectAll.checked = allChecked;
            selectAllHeader.checked = allChecked;
            selectAll.indeterminate = someChecked && !allChecked;
            selectAllHeader.indeterminate = someChecked && !allChecked;
            
            updateBulkActions();
        });
    });

    // Bulk form submission
    bulkForm.addEventListener('submit', function(e) {
        const action = this.querySelector('select[name="action"]').value;
        const count = document.querySelectorAll('.row-checkbox:checked').length;
        
        if (!action) {
            e.preventDefault();
            alert('Pilih aksi yang ingin dilakukan');
            return;
        }
        
        let message = '';
        switch(action) {
            case 'activate':
                message = `Aktifkan ${count} informasi kesehatan?`;
                break;
            case 'deactivate':
                message = `Nonaktifkan ${count} informasi kesehatan?`;
                break;
            case 'delete':
                message = `Hapus ${count} informasi kesehatan? Tindakan ini tidak dapat dibatalkan!`;
                break;
        }
        
        if (!confirm(message)) {
            e.preventDefault();
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Add smooth scroll animation for page load
    window.addEventListener('load', function() {
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 100);
    });
});

function refreshData() {
    // Add loading animation
    const btn = event.target;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Refreshing...';
    btn.disabled = true;
    
    setTimeout(() => {
        location.reload();
    }, 1000);
}
</script>
@endpush
