@extends('dashboardadmin.layouts.app')

@section('title', 'Destinations - Medical Services')
@section('page-title', 'Destinations')
@section('page-description', 'Manage medical service destinations')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-900">
            <i class="fas fa-map-marked-alt mr-2 text-blue-600"></i>Medical Destinations
        </h2>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Add Destination
        </button>
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Sample destination cards -->
        <div class="border rounded-lg p-4 hover:shadow-lg transition duration-200">
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hospital text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="font-semibold text-gray-900">General Hospital</h3>
                    <p class="text-sm text-gray-600">Main Campus</p>
                </div>
            </div>
            <p class="text-gray-700 text-sm mb-3">Complete medical services with emergency care and specialized departments.</p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">
                    <i class="fas fa-map-marker-alt mr-1"></i>Downtown Area
                </span>
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="border rounded-lg p-4 hover:shadow-lg transition duration-200">
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clinic-medical text-green-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="font-semibold text-gray-900">Health Clinic</h3>
                    <p class="text-sm text-gray-600">North Branch</p>
                </div>
            </div>
            <p class="text-gray-700 text-sm mb-3">Primary care services and routine medical checkups for the community.</p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">
                    <i class="fas fa-map-marker-alt mr-1"></i>North District
                </span>
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="border rounded-lg p-4 hover:shadow-lg transition duration-200">
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-ambulance text-purple-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="font-semibold text-gray-900">Emergency Center</h3>
                    <p class="text-sm text-gray-600">24/7 Service</p>
                </div>
            </div>
            <p class="text-gray-700 text-sm mb-3">Round-the-clock emergency medical services and trauma care.</p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">
                    <i class="fas fa-map-marker-alt mr-1"></i>City Center
                </span>
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection