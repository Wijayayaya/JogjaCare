<?php

namespace Database\Seeders;

use App\Models\HealthInformation;
use Illuminate\Database\Seeder;

class HealthInformationSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        HealthInformation::truncate();

        $healthData = [
            [
                'name' => 'Demam',
                'description' => 'Peningkatan suhu tubuh di atas normal (>37.5°C)',
                'what_is' => 'Demam adalah respons alami tubuh terhadap infeksi atau peradangan. Suhu tubuh normal berkisar 36-37°C. Demam membantu tubuh melawan infeksi dengan meningkatkan aktivitas sistem kekebalan tubuh.',
                'care_tips' => [
                    'Istirahat yang cukup di tempat yang sejuk dan nyaman',
                    'Minum banyak cairan (air putih, jus buah, sup hangat)',
                    'Kompres dengan air hangat (bukan dingin) di dahi atau ketiak',
                    'Pakai pakaian yang tipis dan menyerap keringat',
                    'Konsumsi makanan yang mudah dicerna dan bergizi',
                    'Pantau suhu tubuh secara berkala',
                    'Hindari aktivitas berat dan olahraga'
                ],
                'when_to_doctor' => [
                    'Demam >39°C atau berlangsung lebih dari 3 hari',
                    'Disertai sesak napas atau nyeri dada',
                    'Kejang demam (terutama pada anak-anak)',
                    'Dehidrasi berat (mulut kering, jarang buang air kecil)',
                    'Ruam kulit yang menyebar dengan cepat',
                    'Muntah terus menerus dan tidak bisa minum',
                    'Sakit kepala hebat dengan kaku kuduk'
                ],
                'avoid' => [
                    'Jangan gunakan alkohol untuk kompres tubuh',
                    'Jangan paksa makan jika tidak nafsu makan',
                    'Jangan mandi air dingin saat demam tinggi',
                    'Hindari obat aspirin untuk anak di bawah 16 tahun',
                    'Jangan abaikan tanda-tanda dehidrasi'
                ],
                'icon' => 'fas fa-thermometer-half',
                'color' => 'red',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Batuk',
                'description' => 'Refleks tubuh untuk membersihkan saluran pernapasan',
                'what_is' => 'Batuk adalah refleks alami tubuh untuk membersihkan saluran pernapasan dari iritan, lendir, atau benda asing. Batuk dapat bersifat kering atau berdahak, akut atau kronis.',
                'care_tips' => [
                    'Minum air hangat dengan madu (untuk usia >1 tahun)',
                    'Berkumur dengan air garam hangat 2-3 kali sehari',
                    'Hindari asap rokok dan polusi udara',
                    'Jaga kelembaban udara di ruangan (40-60%)',
                    'Istirahat dengan posisi kepala sedikit lebih tinggi',
                    'Konsumsi makanan hangat seperti sup atau teh herbal',
                    'Hindari makanan atau minuman yang terlalu dingin'
                ],
                'when_to_doctor' => [
                    'Batuk berdarah atau dahak berwarna kuning/hijau',
                    'Batuk berlangsung lebih dari 2 minggu',
                    'Disertai demam tinggi lebih dari 3 hari',
                    'Sesak napas atau nyeri dada saat batuk',
                    'Penurunan berat badan tanpa sebab yang jelas',
                    'Batuk mengganggu tidur secara terus menerus',
                    'Suara serak yang tidak membaik'
                ],
                'avoid' => [
                    'Jangan berikan madu pada bayi di bawah 1 tahun',
                    'Hindari obat batuk tanpa konsultasi dokter',
                    'Jangan merokok atau terpapar asap rokok',
                    'Hindari udara kering dan berdebu',
                    'Jangan abaikan batuk yang semakin memburuk'
                ],
                'icon' => 'fas fa-head-side-cough',
                'color' => 'orange',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Sakit Kepala',
                'description' => 'Nyeri atau ketidaknyamanan di area kepala dan leher',
                'what_is' => 'Sakit kepala dapat disebabkan berbagai faktor seperti stres, kurang tidur, dehidrasi, ketegangan otot, atau kondisi medis tertentu. Jenis yang paling umum adalah sakit kepala tegang dan migrain.',
                'care_tips' => [
                    'Istirahat di ruangan yang tenang dan gelap',
                    'Kompres dingin di dahi atau belakang leher',
                    'Pijat lembut area pelipis, leher, dan bahu',
                    'Minum air putih yang cukup untuk mencegah dehidrasi',
                    'Atur pola tidur yang teratur (7-8 jam per hari)',
                    'Kelola stres dengan teknik relaksasi',
                    'Hindari makanan pemicu seperti MSG atau kafein berlebih'
                ],
                'when_to_doctor' => [
                    'Sakit kepala mendadak dan sangat hebat ("worst headache ever")',
                    'Disertai demam tinggi dan kaku kuduk',
                    'Gangguan penglihatan, bicara, atau keseimbangan',
                    'Sakit kepala berulang dan semakin parah',
                    'Disertai mual muntah terus menerus',
                    'Sakit kepala setelah cedera kepala',
                    'Perubahan pola sakit kepala yang biasa dialami'
                ],
                'avoid' => [
                    'Jangan konsumsi obat pereda nyeri berlebihan',
                    'Hindari cahaya terang dan suara keras',
                    'Jangan abaikan sakit kepala yang tidak biasa',
                    'Hindari makanan pemicu yang sudah diketahui',
                    'Jangan menunda istirahat saat merasa lelah'
                ],
                'icon' => 'fas fa-brain',
                'color' => 'purple',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Sesak Napas',
                'description' => 'Kesulitan bernapas atau napas pendek yang tidak normal',
                'what_is' => 'Sesak napas adalah kesulitan bernapas yang bisa disebabkan aktivitas berat, kondisi paru-paru, jantung, atau faktor lainnya. Dapat bersifat akut (mendadak) atau kronis (berlangsung lama).',
                'care_tips' => [
                    'Duduk tegak dengan bersandar ke depan',
                    'Bernapas perlahan dan dalam melalui hidung',
                    'Gunakan kipas angin untuk sirkulasi udara segar',
                    'Hindari aktivitas berat dan istirahat cukup',
                    'Tetap tenang dan jangan panik',
                    'Buka jendela untuk udara segar',
                    'Gunakan teknik pernapasan diafragma'
                ],
                'when_to_doctor' => [
                    'Sesak napas mendadak dan berat tanpa sebab jelas',
                    'Tidak membaik dengan istirahat dalam 10-15 menit',
                    'Disertai nyeri dada atau pusing hebat',
                    'Bibir atau kuku kebiruan (sianosis)',
                    'Riwayat penyakit jantung atau paru-paru',
                    'Sesak napas saat istirahat atau tidur',
                    'Bengkak di kaki atau pergelangan kaki'
                ],
                'avoid' => [
                    'Jangan berbaring telentang saat sesak napas',
                    'Hindari tempat berdebu, berasap, atau berpolusi',
                    'Jangan tunda mencari bantuan medis',
                    'Hindari aktivitas yang memperburuk sesak',
                    'Jangan panik karena dapat memperburuk kondisi'
                ],
                'icon' => 'fas fa-lungs',
                'color' => 'blue',
                'is_emergency' => true,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Mual dan Muntah',
                'description' => 'Sensasi tidak nyaman di perut dengan keinginan atau tindakan mengeluarkan isi lambung',
                'what_is' => 'Mual adalah sensasi tidak nyaman di perut dengan keinginan untuk muntah. Dapat disebabkan gangguan pencernaan, infeksi, kehamilan, atau kondisi medis lainnya.',
                'care_tips' => [
                    'Makan dalam porsi kecil tapi sering',
                    'Hindari makanan berlemak, pedas, atau berbau menyengat',
                    'Minum jahe hangat atau teh chamomile',
                    'Istirahat dengan posisi kepala lebih tinggi',
                    'Hirup udara segar dan hindari bau menyengat',
                    'Minum cairan sedikit-sedikit tapi sering',
                    'Konsumsi makanan hambar seperti roti tawar atau biskuit'
                ],
                'when_to_doctor' => [
                    'Muntah terus menerus lebih dari 24 jam',
                    'Tanda-tanda dehidrasi (mulut kering, pusing, jarang BAK)',
                    'Disertai nyeri perut hebat atau demam tinggi',
                    'Muntah darah atau cairan kehijauan',
                    'Tidak bisa minum atau makan sama sekali',
                    'Penurunan berat badan yang signifikan',
                    'Muntah setelah cedera kepala'
                ],
                'avoid' => [
                    'Jangan makan makanan berat saat mual',
                    'Hindari bau-bauan yang menyengat',
                    'Jangan berbaring langsung setelah makan',
                    'Hindari makanan pedas atau asam',
                    'Jangan abaikan tanda-tanda dehidrasi'
                ],
                'icon' => 'fas fa-stomach',
                'color' => 'green',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Pusing dan Vertigo',
                'description' => 'Sensasi kepala ringan atau kehilangan keseimbangan',
                'what_is' => 'Pusing dapat berupa kepala ringan, kehilangan keseimbangan, atau sensasi berputar (vertigo). Dapat disebabkan masalah telinga dalam, tekanan darah, atau kondisi neurologis.',
                'care_tips' => [
                    'Duduk atau berbaring perlahan saat merasa pusing',
                    'Minum air putih yang cukup untuk mencegah dehidrasi',
                    'Hindari gerakan kepala yang mendadak',
                    'Istirahat yang cukup dan teratur',
                    'Hindari berdiri terlalu lama',
                    'Gunakan pegangan saat berjalan jika diperlukan',
                    'Hindari cahaya terang yang menyilaukan'
                ],
                'when_to_doctor' => [
                    'Pusing berulang tanpa sebab yang jelas',
                    'Disertai nyeri dada atau sesak napas',
                    'Kehilangan kesadaran atau hampir pingsan',
                    'Gangguan pendengaran atau telinga berdenging',
                    'Pusing disertai sakit kepala hebat',
                    'Mual muntah yang tidak membaik',
                    'Gangguan penglihatan atau bicara'
                ],
                'avoid' => [
                    'Jangan mengemudi saat merasa pusing',
                    'Hindari aktivitas berbahaya di ketinggian',
                    'Jangan abaikan pusing yang berulang',
                    'Hindari perubahan posisi yang tiba-tiba',
                    'Jangan konsumsi alkohol saat pusing'
                ],
                'icon' => 'fas fa-dizzy',
                'color' => 'yellow',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Diare',
                'description' => 'Buang air besar cair atau encer lebih dari 3 kali sehari',
                'what_is' => 'Diare adalah kondisi buang air besar dengan konsistensi cair atau encer, frekuensi lebih dari 3 kali sehari. Dapat disebabkan infeksi, keracunan makanan, atau kondisi medis lainnya.',
                'care_tips' => [
                    'Minum banyak cairan untuk mencegah dehidrasi',
                    'Konsumsi oralit atau larutan elektrolit',
                    'Makan makanan hambar seperti nasi putih, roti tawar',
                    'Hindari makanan berlemak, pedas, atau berserat tinggi',
                    'Istirahat yang cukup',
                    'Jaga kebersihan tangan dengan baik',
                    'Konsumsi probiotik jika tersedia'
                ],
                'when_to_doctor' => [
                    'Diare berlangsung lebih dari 3 hari',
                    'Tanda-tanda dehidrasi berat',
                    'BAB berdarah atau berwarna hitam',
                    'Demam tinggi disertai diare',
                    'Nyeri perut hebat atau kram yang tidak membaik',
                    'Muntah terus menerus',
                    'Penurunan berat badan yang signifikan'
                ],
                'avoid' => [
                    'Jangan konsumsi makanan pedas atau berlemak',
                    'Hindari susu dan produk olahan susu',
                    'Jangan minum alkohol atau kafein berlebih',
                    'Hindari makanan mentah atau setengah matang',
                    'Jangan abaikan tanda-tanda dehidrasi'
                ],
                'icon' => 'fas fa-toilet',
                'color' => 'indigo',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'name' => 'Nyeri Dada',
                'description' => 'Rasa sakit, tekanan, atau ketidaknyamanan di area dada',
                'what_is' => 'Nyeri dada dapat disebabkan berbagai kondisi mulai dari masalah otot, tulang rusuk, paru-paru, hingga jantung. Penting untuk membedakan nyeri dada yang berbahaya dan tidak berbahaya.',
                'care_tips' => [
                    'Istirahat dan hindari aktivitas berat',
                    'Duduk tegak atau posisi yang nyaman',
                    'Bernapas perlahan dan dalam',
                    'Kompres hangat untuk nyeri otot',
                    'Hindari stres dan tetap tenang',
                    'Catat karakteristik nyeri (lokasi, durasi, pemicu)',
                    'Hindari merokok dan kafein berlebih'
                ],
                'when_to_doctor' => [
                    'Nyeri dada hebat dan menekan seperti ditimpa beban',
                    'Nyeri menjalar ke lengan, leher, rahang, atau punggung',
                    'Disertai sesak napas, keringat dingin, atau mual',
                    'Nyeri dada mendadak dan sangat tajam',
                    'Riwayat penyakit jantung atau faktor risiko tinggi',
                    'Nyeri tidak membaik dengan istirahat',
                    'Disertai pusing atau hampir pingsan'
                ],
                'avoid' => [
                    'Jangan abaikan nyeri dada yang tidak biasa',
                    'Hindari aktivitas berat saat nyeri dada',
                    'Jangan merokok atau terpapar asap',
                    'Hindari makanan berlemak tinggi',
                    'Jangan tunda mencari bantuan medis'
                ],
                'icon' => 'fas fa-heartbeat',
                'color' => 'red',
                'is_emergency' => true,
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'name' => 'Sakit Perut',
                'description' => 'Nyeri atau ketidaknyamanan di area perut',
                'what_is' => 'Sakit perut dapat disebabkan berbagai kondisi mulai dari gangguan pencernaan ringan hingga kondisi serius yang memerlukan penanganan medis segera.',
                'care_tips' => [
                    'Istirahat dan hindari makanan berat',
                    'Kompres hangat di area perut',
                    'Minum air putih hangat atau teh herbal',
                    'Makan dalam porsi kecil dan sering',
                    'Hindari makanan pedas, berlemak, atau asam',
                    'Posisi tidur miring atau lutut ditekuk ke dada',
                    'Pijat lembut area perut searah jarum jam'
                ],
                'when_to_doctor' => [
                    'Nyeri perut hebat dan mendadak',
                    'Disertai demam tinggi atau muntah terus menerus',
                    'Perut kaku dan tidak bisa ditekan',
                    'BAB berdarah atau berwarna hitam',
                    'Tidak bisa buang air kecil atau BAB',
                    'Nyeri menjalar ke punggung atau bahu',
                    'Penurunan berat badan tanpa sebab'
                ],
                'avoid' => [
                    'Jangan konsumsi obat pereda nyeri tanpa konsultasi',
                    'Hindari makanan pedas atau berlemak',
                    'Jangan makan berlebihan',
                    'Hindari alkohol dan merokok',
                    'Jangan abaikan nyeri perut yang memburuk'
                ],
                'icon' => 'fas fa-hand-holding-medical',
                'color' => 'pink',
                'is_emergency' => false,
                'is_active' => true,
                'sort_order' => 9
            ]
        ];

        foreach ($healthData as $data) {
            HealthInformation::create($data);
        }

        $this->command->info('Health Information seeder completed successfully!');
        $this->command->info('Created ' . count($healthData) . ' health information records.');
    }
}
