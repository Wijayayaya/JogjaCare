<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthInformation;

class MedicalEducationController extends Controller
{
    public function index()
    {
        return view('frontend.medicaleducation.index');
    }

    public function articles()
    {
        return view('frontend.medicaleducation.articles');
    }

    public function expertSystem()
    {
        return view('frontend.medicaleducation.expert-system');
    }

    public function getHealthInformation()
    {
        $healthInfo = HealthInformation::active()
            ->ordered()
            ->get()
            ->mapWithKeys(function ($info) {
                return [$info->slug => [
                    'name' => $info->name,
                    'description' => $info->description,
                    'education' => [
                        'what_is' => $info->what_is,
                        'care_tips' => $info->care_tips,
                        'when_to_doctor' => $info->when_to_doctor,
                        'avoid' => $info->avoid
                    ],
                    'icon' => $info->icon,
                    'color' => $info->color,
                    'is_emergency' => $info->is_emergency
                ]];
            });

        return response()->json($healthInfo);
    }
}
