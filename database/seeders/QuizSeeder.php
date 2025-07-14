<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $quizzes = [
            [
                'question' => 'Gula merah lebih sehat daripada gula putih',
                'answer' => 'Mitos',
                'explanation' => 'Kandungan kalori dan indeks glikemiknya tidak jauh berbeda; konsumsi tetap harus dibatasi.',
                'order' => 1
            ],
            [
                'question' => 'Konsumsi nanas dapat menyebabkan ibu hamil keguguran',
                'answer' => 'Mitos',
                'explanation' => 'Jumlah bromelain dalam nanas segar sangat kecil dan tidak cukup kuat untuk menyebabkan kontraksi atau keguguran, sehingga ibu hamil sangat aman mengkonsumsi nanas dalam jumlah normal.',
                'order' => 2
            ],
            [
                'question' => 'Menggigit es bisa merusak gigi',
                'answer' => 'Fakta',
                'explanation' => 'Benar, menggigit es dapat menyebabkan keretakan kecil pada gigi dan kerusakan email.',
                'order' => 3
            ],
            [
                'question' => 'Mandi malam menyebabkan rematik',
                'answer' => 'Mitos',
                'explanation' => 'Rematik tidak disebabkan oleh mandi malam; ini adalah gangguan autoimun atau inflamasi sendi.',
                'order' => 4
            ],
            [
                'question' => 'Makan makanan pedas bisa memicu sakit maag',
                'answer' => 'Fakta',
                'explanation' => 'Makan pedas akan memicu peningkatan asam lambung didalam lambung, makanya setiap orang ada toleransi pedasnya, jika melebihi batas toleransi asam lambungnya akan terus meningkat dan menjadi faktor GERD.',
                'order' => 5
            ],
            [
                'question' => 'Minum air dingin saat haid bisa menyebabkan kista ovarium',
                'answer' => 'Mitos',
                'explanation' => 'Kista ovarium adalah kantung berisi cairan yang terbentuk di ovarium dan umumnya disebabkan oleh fluktuasi hormon dan gaya hidup tidak sehat bukan karena suhu minuman yang kamu minum.',
                'order' => 6
            ],
            [
                'question' => 'Obat Antibiotik yang telah diresepkan oleh Dokter harus dihabiskan',
                'answer' => 'Fakta',
                'explanation' => 'Jika tidak dihabiskan, bakteri yang lebih kuat bisa bertahan hidup dan berkembang lagi, menyebabkan infeksi kambuh dan bakteri kebal terhadap obat tersebut.',
                'order' => 7
            ],
            [
                'question' => 'Sering Sakit Kepala disebabkan karena kurang tidur',
                'answer' => 'Fakta',
                'explanation' => 'Terutama orang yang jam tidurnya kacau, akan rentan mengalami TTH (Tension Type Headache) dan migrain. Karena terjadinya penyempitan pembuluh darah (terutama kapiler) pada bagian kulit kepala dan kepala.',
                'order' => 8
            ],
            [
                'question' => 'Tertawa bisa meningkatkan rasio panjang umur',
                'answer' => 'Fakta',
                'explanation' => 'Ketika tertawa meredakan stres, endorfin keluar, gula turun, adrenalin turun, tekanan darah turun karena lagi happy.',
                'order' => 9
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
