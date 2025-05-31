@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs />
@endsection

@section('styles')
<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .chart-container {
        position: relative;
        height: 300px;
        margin: 1rem 0;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
    }
    
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .dashboard-section {
        margin-bottom: 2rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    
    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        border: none;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .progress {
        background-color: #e9ecef;
        border-radius: 10px;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
    
    /* Fix for high contrast mode warnings */
    @media (prefers-contrast: high) {
        .card {
            border: 1px solid #000;
        }
        .stat-card {
            border: 1px solid #000;
        }
    }
    
    /* Loading animation */
    .chart-loading {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
        color: #6c757d;
    }
    
    .loading-spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #007bff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin-right: 10px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Error state */
    .chart-error {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 300px;
        color: #dc3545;
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100 stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Medical Centers</h6>
                            <h2 class="mb-0" id="medicalCentersCount">{{ DB::table('medicalcenters')->count() }}</h2>
                        </div>
                        <i class="fas fa-hospital fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.medicalcenters.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100 stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Medical Care</h6>
                            <h2 class="mb-0" id="medicalCareCount">{{ DB::table('medicalcares')->count() }}</h2>
                        </div>
                        <i class="fas fa-heartbeat fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.medicalcares.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white h-100 stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Medical Points</h6>
                            <h2 class="mb-0" id="medicalPointsCount">{{ DB::table('medicalpoints')->count() }}</h2>
                        </div>
                        <i class="fas fa-map-marker-alt fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.medicalpoints.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white h-100 stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Users</h6>
                            <h2 class="mb-0" id="usersCount">{{ DB::table('users')->count() }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.users.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4 dashboard-section">
        <!-- Medical Centers by District Chart -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Medical Centers by District
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart-loading" id="districtChartLoading">
                            <div class="loading-spinner"></div>
                            <span>Loading chart...</span>
                        </div>
                        <canvas id="districtChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Medical Services by Type Chart -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Medical Services by Type
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart-loading" id="servicesChartLoading">
                            <div class="loading-spinner"></div>
                            <span>Loading chart...</span>
                        </div>
                        <canvas id="servicesChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Summary Tables -->
    <div class="row mb-4">
        <!-- Medical Centers by District -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table mr-2"></i>
                        Medical Centers by District
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>District</th>
                                    <th>Count</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $centersByDistrict = DB::table('medicalcenters')
                                        ->select('district', DB::raw('count(*) as count'))
                                        ->whereNotNull('district')
                                        ->where('district', '!=', '')
                                        ->groupBy('district')
                                        ->orderBy('count', 'desc')
                                        ->get();
                                    
                                    $totalCenters = $centersByDistrict->sum('count');
                                @endphp
                                
                                @if($centersByDistrict->count() > 0)
                                    @foreach($centersByDistrict as $district)
                                    <tr>
                                        <td><strong>{{ $district->district }}</strong></td>
                                        <td><span class="badge bg-primary">{{ $district->count }}</span></td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ $totalCenters > 0 ? round(($district->count / $totalCenters) * 100, 1) : 0 }}%">
                                                    {{ $totalCenters > 0 ? round(($district->count / $totalCenters) * 100, 1) : 0 }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No data available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Medical Services by Type -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table mr-2"></i>
                        Medical Services by Type
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Type</th>
                                    <th>Count</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $servicesByType = DB::table('medicalcenters')
                                        ->select('type', DB::raw('count(*) as count'))
                                        ->whereNotNull('type')
                                        ->where('type', '!=', '')
                                        ->groupBy('type')
                                        ->orderBy('count', 'desc')
                                        ->get();
                                    
                                    $totalServices = $servicesByType->sum('count');
                                @endphp
                                
                                @if($servicesByType->count() > 0)
                                    @foreach($servicesByType as $service)
                                    <tr>
                                        <td><strong>{{ $service->type }}</strong></td>
                                        <td><span class="badge bg-success">{{ $service->count }}</span></td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" role="progressbar" 
                                                     style="width: {{ $totalServices > 0 ? round(($service->count / $totalServices) * 100, 1) : 0 }}%">
                                                    {{ $totalServices > 0 ? round(($service->count / $totalServices) * 100, 1) : 0 }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No data available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Costs Chart and Table -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line mr-2"></i>
                        Medical Costs Comparison
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart-loading" id="costsChartLoading">
                            <div class="loading-spinner"></div>
                            <span>Loading chart...</span>
                        </div>
                        <canvas id="costsChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        Medical Costs Range
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Service Name</th>
                                    <th>Lowest Price</th>
                                    <th>Highest Price</th>
                                    <th>Price Range</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $medicalCosts = DB::table('medicalcosts')
                                        ->select('name', 'lowest_price', 'highest_price')
                                        ->whereNotNull('name')
                                        ->where('name', '!=', '')
                                        ->orderBy('name')
                                        ->get();
                                @endphp
                                
                                @if($medicalCosts->count() > 0)
                                    @foreach($medicalCosts as $cost)
                                    <tr>
                                        <td><strong>{{ $cost->name }}</strong></td>
                                        <td class="text-success">Rp {{ number_format($cost->lowest_price, 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($cost->highest_price, 0, ',', '.') }}</td>
                                        <td class="text-warning">Rp {{ number_format($cost->highest_price - $cost->lowest_price, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No cost data available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock mr-2"></i>
                        Recent Medical Centers
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>District</th>
                                    <th>Sub District</th>
                                    <th>Contact</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $recentMedicalCenters = DB::table('medicalcenters')
                                        ->orderBy('created_at', 'desc')
                                        ->take(10)
                                        ->get();
                                @endphp
                                
                                @if($recentMedicalCenters->count() > 0)
                                    @foreach($recentMedicalCenters as $center)
                                    <tr>
                                        <td><strong>{{ $center->id }}</strong></td>
                                        <td>{{ $center->name ?? 'N/A' }}</td>
                                        <td><span class="badge bg-info">{{ $center->type ?? 'N/A' }}</span></td>
                                        <td>{{ $center->district ?? 'N/A' }}</td>
                                        <td>{{ $center->sub_district ?? 'N/A' }}</td>
                                        <td>{{ $center->contact ?? 'N/A' }}</td>
                                        <td>{{ $center->created_at ? date('d M Y', strtotime($center->created_at)) : 'N/A' }}</td>
                                        <td>
                                            @if(isset($center->status) && $center->status == 1)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Active
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-pause-circle"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No data available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Load Chart.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" 
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Collect data from PHP into JavaScript
    const centersByDistrict = @json($centersByDistrict ?? collect());
    const servicesByType = @json($servicesByType ?? collect());
    const medicalCosts = @json($medicalCosts ?? collect());

    // Chart utility functions
    function hideLoading(loadingId) {
        const loading = document.getElementById(loadingId);
        if (loading) loading.style.display = 'none';
    }

    function showChart(chartId) {
        const chart = document.getElementById(chartId);
        if (chart) chart.style.display = 'block';
    }

    function showError(containerId, message) {
        const container = document.getElementById(containerId);
        if (container) {
            hideLoading(containerId);
            container.innerHTML = `
                <div class="chart-error">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <div>${message}</div>
                    <small class="text-muted mt-1">Please refresh the page or check your data.</small>
                </div>
            `;
        }
    }

    // Check if Chart.js loaded successfully
    if (typeof Chart === 'undefined') {
        console.error('Chart.js failed to load');
        showError('districtChartLoading', 'Chart library failed to load');
        showError('servicesChartLoading', 'Chart library failed to load');
        showError('costsChartLoading', 'Chart library failed to load');
        return;
    }

    try {
        // 1. District Chart (Pie Chart)
        const districtCanvas = document.getElementById('districtChart');
        if (districtCanvas && centersByDistrict && centersByDistrict.length > 0) {
            const districtCtx = districtCanvas.getContext('2d');
            
            new Chart(districtCtx, {
                type: 'pie',
                data: {
                    labels: centersByDistrict.map(item => item.district || 'Unknown'),
                    datasets: [{
                        data: centersByDistrict.map(item => parseInt(item.count) || 0),
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#9966FF', '#FF9F40', '#FF6B6B', '#4ECDC4',
                            '#45B7D1', '#96CEB4', '#FECA57', '#FF9FF3'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true,
                                font: { size: 11 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed * 100) / total).toFixed(1) : 0;
                                    return `${context.label}: ${context.parsed} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            
            hideLoading('districtChartLoading');
            showChart('districtChart');
        } else {
            showError('districtChartLoading', 'No district data available');
        }

        // 2. Services Chart (Doughnut Chart)
        const servicesCanvas = document.getElementById('servicesChart');
        if (servicesCanvas && servicesByType && servicesByType.length > 0) {
            const servicesCtx = servicesCanvas.getContext('2d');
            
            new Chart(servicesCtx, {
                type: 'doughnut',
                data: {
                    labels: servicesByType.map(item => item.type || 'Unknown'),
                    datasets: [{
                        data: servicesByType.map(item => parseInt(item.count) || 0),
                        backgroundColor: [
                            '#36A2EB', '#4BC0C0', '#FFCE56', '#FF6384',
                            '#9966FF', '#FF9F40', '#4ECDC4', '#45B7D1',
                            '#96CEB4', '#FECA57', '#FF9FF3', '#6C5CE7'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true,
                                font: { size: 11 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed * 100) / total).toFixed(1) : 0;
                                    return `${context.label}: ${context.parsed} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            
            hideLoading('servicesChartLoading');
            showChart('servicesChart');
        } else {
            showError('servicesChartLoading', 'No services data available');
        }

        // 3. Costs Chart (Bar Chart)
        const costsCanvas = document.getElementById('costsChart');
        if (costsCanvas && medicalCosts && medicalCosts.length > 0) {
            const costsCtx = costsCanvas.getContext('2d');
            
            new Chart(costsCtx, {
                type: 'bar',
                data: {
                    labels: medicalCosts.map(item => {
                        const name = item.name || 'Unknown';
                        return name.length > 15 ? name.substring(0, 15) + '...' : name;
                    }),
                    datasets: [{
                        label: 'Lowest Price',
                        data: medicalCosts.map(item => parseInt(item.lowest_price) || 0),
                        backgroundColor: '#36A2EB',
                        borderColor: '#2E86AB',
                        borderWidth: 1
                    }, {
                        label: 'Highest Price',
                        data: medicalCosts.map(item => parseInt(item.highest_price) || 0),
                        backgroundColor: '#FF6384',
                        borderColor: '#E84A5F',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Medical Services',
                                font: { size: 12 }
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Price (Rp)',
                                font: { size: 12 }
                            },
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: Rp ${new Intl.NumberFormat('id-ID').format(context.parsed.y)}`;
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
            
            hideLoading('costsChartLoading');
            showChart('costsChart');
        } else {
            showError('costsChartLoading', 'No cost data available');
        }

    } catch (error) {
        console.error('Error creating charts:', error);
        showError('districtChartLoading', 'Error loading charts');
        showError('servicesChartLoading', 'Error loading charts');
        showError('costsChartLoading', 'Error loading charts');
    }

    // Animate stat cards
    const cards = document.querySelectorAll('.stat-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection