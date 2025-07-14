@extends('dashboardadmin.layouts.app')

@section('title', 'Dashboard - Medical Services')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of Medical Services')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Dashboard</span>
    </div>
</li>
@endsection

@section('content')
<!-- Service Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Medical Care Card dengan link ke CRUD -->
    <a href="{{ route('dashboardadmin.services.medicalcare.index') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 cursor-pointer">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-heartbeat text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Medical Care</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ number_format($serviceData['medical_care']) }}</p>
                    <p class="text-sm text-gray-500">Active services</p>
                </div>
            </div>
        </div>
    </a>

    <!-- Medical Point Card dengan link ke CRUD -->
    <a href="{{ route('dashboardadmin.services.medicalpoint.index') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 cursor-pointer">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-map-marker-alt text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Medical Point</h3>
                    <p class="text-3xl font-bold text-green-600">{{ number_format($serviceData['medical_point']) }}</p>
                    <p class="text-sm text-gray-500">Service points</p>
                </div>
            </div>
        </div>
    </a>

    <!-- Medical Center Card dengan link ke CRUD -->
    <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 cursor-pointer">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-hospital text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Medical Center</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ number_format($serviceData['medical_center']) }}</p>
                    <p class="text-sm text-gray-500">Medical centers</p>
                </div>
            </div>
        </div>
    </a>

    <!-- Medical Alter Card -->
    <a href="{{ route('dashboardadmin.services.medicalalter.index') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 cursor-pointer">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-pills text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Medical Alter</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ number_format($serviceData['medical_alter']) }}</p>
                    <p class="text-sm text-gray-500">Alternative treatments</p>
                </div>
            </div>
        </div>
    </a>

    <!-- Medical Cost Card dengan link ke CRUD -->
    <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 cursor-pointer">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Medical Cost</h3>
                    <p class="text-3xl font-bold text-red-600">{{ number_format($serviceData['medical_cost']) }}</p>
                    <p class="text-sm text-gray-500">Price entries</p>
                </div>
            </div>
        </div>
    </a>

    <!-- Medical Education Card -->
    <a href="{{ route('dashboardadmin.services.medicaleducation') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 cursor-pointer">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Medical Education</h3>
                    <p class="text-3xl font-bold text-indigo-600">{{ number_format($serviceData['medical_education']) }}</p>
                    <p class="text-sm text-gray-500">Students enrolled</p>
                </div>
            </div>
        </div>
    </a>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Bar Chart -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-gray-900 mb-4">
            <i class="fas fa-chart-bar mr-2 text-blue-600"></i>Service Statistics Overview
        </h2>
        <canvas id="serviceChart" width="400" height="200"></canvas>
    </div>

    <!-- Pie Chart -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-gray-900 mb-4">
            <i class="fas fa-chart-pie mr-2 text-green-600"></i>Service Distribution
        </h2>
        <canvas id="pieChart" width="400" height="200"></canvas>
    </div>
</div>

<!-- Line Chart -->
<div class="bg-white p-6 rounded-lg shadow-lg mb-8">
    <h2 class="text-xl font-bold text-gray-900 mb-4">
        <i class="fas fa-chart-line mr-2 text-purple-600"></i>Monthly Trends (Last 6 Months)
    </h2>
    <canvas id="lineChart" width="400" height="150"></canvas>
</div>

<!-- Recent Medical Costs -->
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-900">
            <i class="fas fa-clock mr-2 text-red-600"></i>Recent Medical Costs
        </h2>
        <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" 
           class="text-red-600 hover:text-red-800 text-sm font-medium">
            View All
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price Range</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $recentMedicalCosts = \Modules\MedicalCost\Models\MedicalCost::latest()->take(5)->get();
                @endphp
                @forelse($recentMedicalCosts as $medicalCost)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $medicalCost->name }}</div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <span class="font-medium text-green-600">{{ $medicalCost->formatted_lowest_price }}</span>
                            <span class="text-gray-500 mx-1">-</span>
                            <span class="font-medium text-red-600">{{ $medicalCost->formatted_highest_price }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        @if($medicalCost->status)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                Active
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $medicalCost->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dashboardadmin.services.medicalcost.show', $medicalCost->id) }}" 
                           class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="{{ route('dashboardadmin.services.medicalcost.edit', $medicalCost->id) }}" 
                           class="text-green-600 hover:text-green-900">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-dollar-sign text-3xl text-gray-300 mb-2"></i>
                        <p>No medical costs found.</p>
                        <a href="{{ route('dashboardadmin.services.medicalcost.create') }}" 
                           class="text-red-600 hover:text-red-800 font-medium">
                            Create your first medical cost entry
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Bar Chart
    const ctx1 = document.getElementById('serviceChart').getContext('2d');
    const serviceChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Medical Care', 'Medical Point', 'Medical Center', 'Medical Alter', 'Medical Cost', 'Medical Education'],
            datasets: [{
                label: 'Service Count',
                data: [
                    {{ $serviceData['medical_care'] }},
                    {{ $serviceData['medical_point'] }},
                    {{ $serviceData['medical_center'] }},
                    {{ $serviceData['medical_alter'] }},
                    {{ $serviceData['medical_cost'] }},
                    {{ $serviceData['medical_education'] }}
                ],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(99, 102, 241, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(99, 102, 241, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Pie Chart
    const ctx2 = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Medical Care', 'Medical Point', 'Medical Center', 'Medical Alter', 'Medical Cost', 'Medical Education'],
            datasets: [{
                data: [
                    {{ $serviceData['medical_care'] }},
                    {{ $serviceData['medical_point'] }},
                    {{ $serviceData['medical_center'] }},
                    {{ $serviceData['medical_alter'] }},
                    {{ $serviceData['medical_cost'] }},
                    {{ $serviceData['medical_education'] }}
                ],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(99, 102, 241, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });

    // Line Chart
    const ctx3 = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($monthlyData, 'month')) !!},
            datasets: [
                {
                    label: 'Medical Care',
                    data: {!! json_encode(array_column($monthlyData, 'medical_care')) !!},
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Medical Point',
                    data: {!! json_encode(array_column($monthlyData, 'medical_point')) !!},
                    borderColor: 'rgba(16, 185, 129, 1)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Medical Center',
                    data: {!! json_encode(array_column($monthlyData, 'medical_center')) !!},
                    borderColor: 'rgba(139, 92, 246, 1)',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Medical Alter',
                    data: {!! json_encode(array_column($monthlyData, 'medical_alter')) !!},
                    borderColor: 'rgba(245, 158, 11, 1)',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Medical Cost',
                    data: {!! json_encode(array_column($monthlyData, 'medical_cost')) !!},
                    borderColor: 'rgba(239, 68, 68, 1)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Medical Education',
                    data: {!! json_encode(array_column($monthlyData, 'medical_education')) !!},
                    borderColor: 'rgba(99, 102, 241, 1)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
