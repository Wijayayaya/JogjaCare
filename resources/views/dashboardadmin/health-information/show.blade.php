@extends('dashboardadmin.layouts.app')

@section('title', 'Detail Informasi Kesehatan')

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
    
    .detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 25px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
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
    
    .emergency-banner {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        color: white;
        animation: pulse 2s infinite;
        box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
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
    
    .timeline-item {
        position: relative;
        padding-left: 3rem;
        margin-bottom: 2rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .timeline-marker {
        position: absolute;
        left: -8px;
        top: 0;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 3px solid white;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
    
    .tip-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #10b981;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .tip-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .tip-item:hover::before {
        opacity: 1;
    }
    
    .tip-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .doctor-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #f59e0b;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .doctor-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(217, 119, 6, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .doctor-item:hover::before {
        opacity: 1;
    }
    
    .doctor-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .avoid-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #ef4444;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .avoid-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .avoid-item:hover::before {
        opacity: 1;
    }
    
    .avoid-item:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .action-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .action-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: #667eea;
    }
    
    .action-card-emergency {
        background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        border-color: #ef4444;
    }
    
    .action-card-emergency:hover {
        border-color: #dc2626;
    }
    
    .btn-modern {
        border-radius: 15px;
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
        transition: all 0.3s ease;
    }
    
    .metadata-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    
    .floating-actions {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
    }
    
    .floating-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    }
    
    .breadcrumb-modern {
        background: white;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .breadcrumb-modern .breadcrumb {
        margin: 0;
        background: none;
        padding: 0;
    }
    
    .breadcrumb-modern .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-modern .breadcrumb-item a:hover {
        color: #764ba2;
    }
    
    .print-section {
        display: none;
    }
    
    @media print {
        .no-print {
            display: none !important;
        }
        
        .print-section {
            display: block !important;
        }
        
        body {
            background: white !important;
        }
        
        .detail-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            page-break-inside: avoid;
        }
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
    
    .share-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        margin-top: 1rem;
    }
    
    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        color: white;
    }
    
    .share-btn:hover {
        transform: scale(1.1);
    }
    
    .share-btn.facebook { background: #3b5998; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.whatsapp { background: #25d366; }
    .share-btn.telegram { background: #0088cc; }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Breadcrumb -->
    <div class="breadcrumb-modern animate-fade-in-up no-print">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboardadmin.health-information.index') }}">
                        <i class="fas fa-heartbeat me-1"></i>Informasi Kesehatan
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $healthInformation->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- Emergency Banner -->
    @if($healthInformation->is_emergency)
        <div class="emergency-banner animate-fade-in-up no-print">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fs-2 me-3"></i>
                <div>
                    <h5 class="mb-1 fw-bold">⚠️ KONDISI DARURAT</h5>
                    <p class="mb-0">Informasi ini berkaitan dengan kondisi yang memerlukan penanganan medis segera. Jika mengalami gejala ini, segera hubungi layanan darurat atau dokter terdekat.</p>
                </div>
            </div>
        </div>
    @endif

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
                        <p class="mb-1 opacity-75 fs-5">{{ $healthInformation->description }}</p>
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <code class="bg-white bg-opacity-20 px-3 py-1 rounded-pill text-white">{{ $healthInformation->slug }}</code>
                            @if($healthInformation->is_emergency)
                                <span class="badge badge-danger-modern animate-pulse-custom">
                                    <i class="fas fa-exclamation-triangle me-1"></i>DARURAT
                                </span>
                            @endif
                            <span class="badge badge-{{ $healthInformation->is_active ? 'success' : 'secondary' }}-modern">
                                <i class="fas fa-{{ $healthInformation->is_active ? 'check' : 'times' }}-circle me-1"></i>
                                {{ $healthInformation->is_active ? 'AKTIF' : 'NONAKTIF' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex gap-2 justify-content-lg-end flex-wrap no-print">
                    <button class="btn btn-info-modern btn-modern" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                    <button class="btn btn-success-modern btn-modern" onclick="shareContent()">
                        <i class="fas fa-share-alt me-2"></i>Bagikan
                    </button>
                    <a href="{{ route('dashboardadmin.health-information.index') }}" class="btn btn-secondary-modern btn-modern">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('dashboardadmin.health-information.edit', $healthInformation) }}" class="btn btn-warning-modern btn-modern">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Print Header (Only visible when printing) -->
    <div class="print-section">
        <div class="text-center mb-4">
            <h1>{{ $healthInformation->name }}</h1>
            <p class="text-muted">{{ $healthInformation->description }}</p>
            <hr>
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
                    <div class="timeline-container">
                        @foreach($healthInformation->care_tips as $index => $tip)
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <div class="tip-item">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-size: 0.875rem; font-weight: 600; flex-shrink: 0;">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h6 class="mb-2 fw-bold text-success">Tip {{ $index + 1 }}</h6>
                                            <p class="mb-0 text-dark" style="line-height: 1.6;">{{ $tip }}</p>
                                        </div>
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
                                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-size: 0.875rem; font-weight: 600; flex-shrink: 0;">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-2 fw-bold text-warning">Kondisi {{ $index + 1 }}</h6>
                                            <p class="mb-0 text-dark" style="line-height: 1.6;">{{ $condition }}</p>
                                        </div>
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
                                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-size: 0.875rem; font-weight: 600; flex-shrink: 0;">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-2 fw-bold text-danger">Hindari {{ $index + 1 }}</h6>
                                                <p class="mb-0 text-dark" style="line-height: 1.6;">{{ $avoid }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Emergency Actions Section -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="card-header-info">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-ambulance me-2"></i>Kontak Darurat & Langkah Selanjutnya
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="action-card action-card-emergency">
                                <div class="mb-3">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <h6 class="fw-bold mb-2">Layanan Darurat</h6>
                                <p class="text-muted small mb-3">Hubungi segera jika kondisi memburuk</p>
                                <a href="tel:119" class="btn btn-danger-modern btn-modern">
                                    <i class="fas fa-phone me-2"></i>119
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="action-card">
                                <div class="mb-3">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-ambulance"></i>
                                    </div>
                                </div>
                                <h6 class="fw-bold mb-2">Ambulans</h6>
                                <p class="text-muted small mb-3">Layanan ambulans 24 jam</p>
                                <a href="tel:1500-567" class="btn btn-info-modern btn-modern">
                                    <i class="fas fa-ambulance me-2"></i>1500-567
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section info-section-success">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-route me-2"></i>Langkah-Langkah yang Disarankan:
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">1. Konsultasi Dokter</h6>
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
                                        <h6 class="mb-1 fw-bold">2. Catat Gejala</h6>
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
                                        <h6 class="mb-1 fw-bold">3. Bawa Riwayat</h6>
                                        <small class="text-muted">Siapkan riwayat kesehatan dan obat yang sedang dikonsumsi</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">4. Ikuti Anjuran</h6>
                                        <small class="text-muted">Patuhi anjuran dokter dan minum obat sesuai resep</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Stats Card -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-header-info">
                    <h6 class="mb-0 fw-bold text-white">
                        <i class="fas fa-chart-bar me-2"></i>Statistik Konten
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="stats-mini">
                                <div class="text-success fw-bold fs-3">{{ count($healthInformation->care_tips) }}</div>
                                <small class="text-muted fw-semibold">Tips Perawatan</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-mini">
                                <div class="text-warning fw-bold fs-3">{{ count($healthInformation->when_to_doctor) }}</div>
                                <small class="text-muted fw-semibold">Kondisi Dokter</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-mini">
                                <div class="text-danger fw-bold fs-3">{{ $healthInformation->avoid ? count($healthInformation->avoid) : 0 }}</div>
                                <small class="text-muted fw-semibold">Yang Dihindari</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status & Settings Card -->
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="card-header-gradient">
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
                                <span class="badge badge-secondary-modern fs-6"># {{ $healthInformation->sort_order }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="d-grid gap-2 no-print">
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
            <div class="detail-card animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="card-header-success">
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
                                <code class="bg-light px-2 py-1 rounded">#{{ $healthInformation->id }}</code>
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
                                <small class="text-muted">{{ Str::limit($healthInformation->description, 80) }}</small>
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
                    
                    <!-- Share Buttons -->
                    <div class="share-buttons no-print">
                        <button class="share-btn facebook" onclick="shareToFacebook()">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="share-btn twitter" onclick="shareToTwitter()">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="share-btn whatsapp" onclick="shareToWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button class="share-btn telegram" onclick="shareToTelegram()">
                            <i class="fab fa-telegram"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Actions -->
<div class="floating-actions no-print">
    <button class="floating-btn bg-primary-modern" onclick="scrollToTop()" title="Scroll to Top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <button class="floating-btn bg-success-modern" onclick="shareContent()" title="Share Content">
        <i class="fas fa-share-alt"></i>
    </button>
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

<!-- Share Modal -->
<div class="modal fade modal-modern" id="shareModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-share-alt me-2"></i>Bagikan Informasi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <div class="icon-circle-large bg-info-gradient mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h5 class="mb-3">Bagikan "{{ $healthInformation->name }}"</h5>
                    <p class="text-muted">Pilih platform untuk membagikan informasi kesehatan ini</p>
                </div>
                
                <div class="row">
                    <div class="col-6 mb-3">
                        <button class="btn btn-primary w-100" onclick="shareToFacebook()">
                            <i class="fab fa-facebook-f me-2"></i>Facebook
                        </button>
                    </div>
                    <div class="col-6 mb-3">
                        <button class="btn btn-info w-100" onclick="shareToTwitter()">
                            <i class="fab fa-twitter me-2"></i>Twitter
                        </button>
                    </div>
                    <div class="col-6 mb-3">
                        <button class="btn btn-success w-100" onclick="shareToWhatsApp()">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </button>
                    </div>
                    <div class="col-6 mb-3">
                        <button class="btn btn-primary w-100" onclick="shareToTelegram()">
                            <i class="fab fa-telegram me-2"></i>Telegram
                        </button>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label class="form-label">Link untuk dibagikan:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="shareUrl" value="{{ url()->current() }}" readonly>
                        <button class="btn btn-outline-secondary" onclick="copyToClipboard()">
                            <i class="fas fa-copy"></i>
                        </button>
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

    // Auto-hide floating buttons on scroll
    let lastScrollTop = 0;
    const floatingActions = document.querySelector('.floating-actions');
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > lastScrollTop) {
            // Scrolling down
            floatingActions.style.transform = 'translateX(100px)';
        } else {
            // Scrolling up
            floatingActions.style.transform = 'translateX(0)';
        }
        
        lastScrollTop = scrollTop;
    });
});

// Scroll to top function
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Share content function
function shareContent() {
    new bootstrap.Modal(document.getElementById('shareModal')).show();
}

// Social media sharing functions
function shareToFacebook() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent('{{ $healthInformation->name }} - Informasi Kesehatan');
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&t=${title}`, '_blank', 'width=600,height=400');
}

function shareToTwitter() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('{{ $healthInformation->name }} - {{ Str::limit($healthInformation->description, 100) }}');
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
}

function shareToWhatsApp() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('{{ $healthInformation->name }} - {{ Str::limit($healthInformation->description, 100) }} ' + url);
    window.open(`https://wa.me/?text=${text}`, '_blank');
}

function shareToTelegram() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('{{ $healthInformation->name }} - {{ Str::limit($healthInformation->description, 100) }}');
    window.open(`https://t.me/share/url?url=${url}&text=${text}`, '_blank');
}

// Copy to clipboard function
function copyToClipboard() {
    const shareUrl = document.getElementById('shareUrl');
    shareUrl.select();
    shareUrl.setSelectionRange(0, 99999);
    
    try {
        document.execCommand('copy');
        
        // Show success feedback
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
        }, 2000);
        
    } catch (err) {
        console.error('Failed to copy: ', err);
        alert('Gagal menyalin link. Silakan salin manual.');
    }
}

// Print optimization
window.addEventListener('beforeprint', function() {
    document.title = '{{ $healthInformation->name }} - Informasi Kesehatan';
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + P for print
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.
    // Ctrl/Cmd + P for print
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.preventDefault();
        window.print();
    }
    
    // Ctrl/Cmd + S for share
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        shareContent();
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => {
            bootstrap.Modal.getInstance(modal)?.hide();
        });
    }
});
</script>
@endpush
