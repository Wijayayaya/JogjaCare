<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\MedicalCare\Models\MedicalCare;
use Modules\MedicalAlter\Models\MedicalAlter;
use Modules\MedicalPoint\Models\MedicalPoint;
use Modules\MedicalCost\Models\MedicalCost;
use Modules\MedicalCenter\Models\MedicalCenter;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Get service data for dashboard
        $serviceData = [
            'medical_care' => MedicalCare::count(),
            'medical_alter' => MedicalAlter::count(),
            'medical_point' => MedicalPoint::count(),
            'medical_center' => MedicalCenter::count(),
            'medical_cost' => MedicalCost::count(),
        ];

        // Get monthly data for charts (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'medical_care' => MedicalCare::whereYear('created_at', $date->year)
                                           ->whereMonth('created_at', $date->month)
                                           ->count(),
                'medical_alter' => MedicalAlter::whereYear('created_at', $date->year)
                                              ->whereMonth('created_at', $date->month)
                                              ->count(),
                'medical_point' => MedicalAlter::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
                'medical_center' => MedicalCenter::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
                'medical_cost' => MedicalCost::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(),
                'medical_education' => rand(10, 20),
            ];
        }

        return view('dashboardadmin.index', compact('serviceData', 'monthlyData'));
    }

    // Add logout method
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('message', 'You have been logged out successfully.');
    }

    public function medicalAlter()
    {
        return view('dashboardadmin.services.placeholder', ['service' => 'Medical Alter']);
    }

    public function medicalPoint()
    {
        return view('dashboardadmin.services.placeholder', ['service' => 'Medical Point']);
    }

    public function medicalCenter()
    {
        return view('dashboardadmin.services.placeholder', ['service' => 'Medical Center']);
    }

    public function medicalCost()
    {
        return view('dashboardadmin.services.placeholder', ['service' => 'Medical Cost']);
    }

    public function medicalEducation()
    {
        return view('dashboardadmin.services.placeholder', ['service' => 'Medical Education']);
    }
}
