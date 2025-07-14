<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ambulance;
use App\Models\EmergencyContact;

class AmbulanceSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Emergency Contacts
        EmergencyContact::create([
            'number' => '118',
            'name' => 'Ambulans Nasional Indonesia',
            'description' => 'Layanan ambulans darurat nasional 24 jam',
            'coverage' => 'Seluruh Indonesia',
            'response_time' => '8-15 menit',
            'is_active' => true
        ]);

        EmergencyContact::create([
            'number' => '119',
            'name' => 'Pemadam Kebakaran & Rescue',
            'description' => 'Layanan darurat kebakaran dan penyelamatan',
            'coverage' => 'Yogyakarta',
            'response_time' => '5-10 menit',
            'is_active' => true
        ]);

        // Hospital Ambulances
        Ambulance::create([
            'name' => 'RSUP Dr. Sardjito',
            'type' => 'hospital',
            'phone' => '(0274) 587333',
            'whatsapp' => '0274587333',
            'address' => 'Jl. Kesehatan No.1, Yogyakarta',
            'coverage_area' => 'DIY & Jawa Tengah',
            'response_time' => '10-15 menit',
            'distance_from_malioboro' => '3.2 km',
            'facilities' => ['ICU Mobile', 'Ventilator', 'Defibrillator'],
            'description' => 'Ambulans rumah sakit rujukan utama dengan fasilitas lengkap',
            'is_active' => true
        ]);

        Ambulance::create([
            'name' => 'RS Bethesda',
            'type' => 'hospital',
            'phone' => '(0274) 563533',
            'whatsapp' => '0274563533',
            'address' => 'Jl. Jend. Sudirman No.70, Yogyakarta',
            'coverage_area' => 'Yogyakarta',
            'response_time' => '8-12 menit',
            'distance_from_malioboro' => '2.8 km',
            'facilities' => ['Basic Life Support', 'Oksigen', 'Stretcher'],
            'description' => 'Ambulans rumah sakit swasta dengan pelayanan berkualitas',
            'is_active' => true
        ]);

        Ambulance::create([
            'name' => 'RS PKU Muhammadiyah Yogyakarta',
            'type' => 'hospital',
            'phone' => '(0274) 512653',
            'whatsapp' => '0274512653',
            'address' => 'Jl. KH. Ahmad Dahlan No.20, Yogyakarta',
            'coverage_area' => 'Yogyakarta',
            'response_time' => '5-10 menit',
            'distance_from_malioboro' => '1.5 km',
            'facilities' => ['Advanced Life Support', 'Cardiac Monitor', 'Suction'],
            'description' => 'Ambulans rumah sakit dengan lokasi strategis di pusat kota',
            'is_active' => true
        ]);

        // Private Ambulances
        Ambulance::create([
            'name' => 'Ambulans Jogja 24 Jam',
            'type' => 'private',
            'phone' => '0812-3456-7890',
            'whatsapp' => '0812-3456-7890',
            'coverage_area' => 'DIY & Jawa Tengah',
            'response_time' => '15-20 menit',
            'tariff_range' => 'Rp 200.000 - Rp 500.000',
            'facilities' => ['Basic Life Support', 'Oksigen', 'Stretcher'],
            'description' => 'Layanan ambulans swasta 24 jam dengan tarif terjangkau',
            'is_active' => true
        ]);

        Ambulance::create([
            'name' => 'Medika Ambulance',
            'type' => 'private',
            'phone' => '0813-2345-6789',
            'whatsapp' => '0813-2345-6789',
            'coverage_area' => 'Yogyakarta & sekitarnya',
            'response_time' => '10-15 menit',
            'tariff_range' => 'Rp 150.000 - Rp 400.000',
            'facilities' => ['Advanced Life Support', 'Defibrillator', 'Cardiac Monitor'],
            'description' => 'Ambulans swasta dengan fasilitas medis lengkap',
            'is_active' => true
        ]);
    }
}
