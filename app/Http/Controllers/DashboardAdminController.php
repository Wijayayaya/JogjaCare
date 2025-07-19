<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'medical_point' => MedicalPoint::count(), // Placeholder data
            'medical_center' => MedicalCenter::count(), // Placeholder data
            'medical_cost' => MedicalCost::count(), // Placeholder data
            'medical_education' => 2, // Placeholder data
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
                ->count(), // Placeholder data
                'medical_center' => MedicalCenter::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(), // Placeholder data
                'medical_cost' => MedicalCost::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count(), // Placeholder data
                'medical_education' => rand(10, 20), // Placeholder data
            ];
        }

        return view('dashboardadmin.index', compact('serviceData', 'monthlyData'));
    }

    // Tambahkan method medicalAlter setelah method index

public function medicalAlter()
{
    return view('dashboardadmin.services.placeholder', ['service' => 'Medical Alter']);
}

// Pastikan juga method lainnya ada:
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
