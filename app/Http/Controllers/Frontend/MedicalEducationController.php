<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalEducationController extends Controller
{
    public function index()
    {
        return view('frontend.medicaleducation.index');
    }

    public function quiz()
    {
        return view('frontend.medicaleducation.quiz'); // Sesuaikan dengan lokasi file view quiz
    }

    public function articles()
    {
        return view('frontend.medicaleducation.articles'); // Sesuaikan dengan lokasi file view artikel
    }
}
