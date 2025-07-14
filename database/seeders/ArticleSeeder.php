<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Kemajuan Terkini dalam Imunoterapi untuk Pengobatan Kanker',
                'author' => 'Dr. Sarah Johnson',
                'excerpt' => 'Imunoterapi telah menjadi terobosan revolusioner dalam pengobatan kanker, dengan penelitian terbaru menunjukkan hasil yang sangat menjanjikan untuk berbagai jenis kanker.',
                'content' => $this->getImmunotherapyContent(),
                'category' => 'Onkologi',
                'icon_color' => 'blue',
                'read_time' => 8,
                'is_active' => true,
                'order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Kesehatan Mental Tenaga Kesehatan: Wawasan Pasca-Pandemi',
                'author' => 'Dr. Michael Chen',
                'excerpt' => 'Dampak pandemi COVID-19 terhadap kesehatan mental tenaga kesehatan telah menjadi fokus penelitian yang intensif, mengungkap tantangan yang kompleks dan berkelanjutan.',
                'content' => $this->getMentalHealthContent(),
                'category' => 'Kesehatan Mental',
                'icon_color' => 'green',
                'read_time' => 12,
                'is_active' => true,
                'order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'AI dan Machine Learning dalam Diagnosis Medis',
                'author' => 'Dr. Emily Rodriguez',
                'excerpt' => 'Kecerdasan buatan telah mengubah lanskap diagnosis medis secara fundamental, dengan proyeksi pertumbuhan pasar mencapai $188 miliar pada tahun 2030.',
                'content' => $this->getAIDiagnosisContent(),
                'category' => 'Teknologi Medis',
                'icon_color' => 'purple',
                'read_time' => 10,
                'is_active' => true,
                'order' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Telemedicine: Best Practices dan Keamanan Pasien',
                'author' => 'Dr. James Wilson',
                'excerpt' => 'Telemedicine telah berkembang pesat pasca-pandemi dengan protokol keamanan yang ketat untuk memastikan kualitas pelayanan dan keselamatan pasien.',
                'content' => $this->getTelemedicineContent(),
                'category' => 'Telemedicine',
                'icon_color' => 'orange',
                'read_time' => 6,
                'is_active' => true,
                'order' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Nutrisi dan Pencegahan Penyakit Kardiovaskular',
                'author' => 'Dr. Lisa Anderson',
                'excerpt' => 'Penelitian terbaru menunjukkan peran penting nutrisi dalam pencegahan penyakit jantung dan pembuluh darah, dengan fokus pada pola makan Mediterania.',
                'content' => $this->getNutritionContent(),
                'category' => 'Kardiologi',
                'icon_color' => 'red',
                'read_time' => 7,
                'is_active' => true,
                'order' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Terapi Gen: Masa Depan Pengobatan Penyakit Genetik',
                'author' => 'Dr. Robert Kim',
                'excerpt' => 'Terapi gen menawarkan harapan baru untuk pengobatan penyakit genetik yang sebelumnya tidak dapat disembuhkan, dengan teknologi CRISPR sebagai terobosan utama.',
                'content' => $this->getGeneTherapyContent(),
                'category' => 'Genetika',
                'icon_color' => 'indigo',
                'read_time' => 9,
                'is_active' => true,
                'order' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Mikrobioma dan Kesehatan Pencernaan',
                'author' => 'Dr. Maria Santos',
                'excerpt' => 'Penelitian mikrobioma usus mengungkap hubungan kompleks antara bakteri usus dan kesehatan secara keseluruhan, membuka jalan untuk terapi probiotik yang lebih efektif.',
                'content' => $this->getMicrobiomeContent(),
                'category' => 'Gastroenterologi',
                'icon_color' => 'pink',
                'read_time' => 8,
                'is_active' => true,
                'order' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Vaksinasi dan Kekebalan Komunitas di Era Modern',
                'author' => 'Dr. David Thompson',
                'excerpt' => 'Pentingnya vaksinasi dalam menciptakan kekebalan komunitas dan melindungi populasi rentan dari penyakit menular yang dapat dicegah.',
                'content' => $this->getVaccinationContent(),
                'category' => 'Imunologi',
                'icon_color' => 'yellow',
                'read_time' => 6,
                'is_active' => true,
                'order' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Manajemen Diabetes Tipe 2: Pendekatan Holistik',
                'author' => 'Dr. Jennifer Lee',
                'excerpt' => 'Pendekatan komprehensif dalam manajemen diabetes tipe 2 yang menggabungkan terapi medis, perubahan gaya hidup, dan dukungan psikososial.',
                'content' => $this->getDiabetesContent(),
                'category' => 'Endokrinologi',
                'icon_color' => 'blue',
                'read_time' => 11,
                'is_active' => true,
                'order' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Kesehatan Reproduksi Wanita: Update Terkini',
                'author' => 'Dr. Amanda Foster',
                'excerpt' => 'Perkembangan terbaru dalam kesehatan reproduksi wanita, termasuk teknologi reproduksi berbantu dan pendekatan preventif untuk kanker ginekologi.',
                'content' => $this->getReproductiveHealthContent(),
                'category' => 'Ginekologi',
                'icon_color' => 'green',
                'read_time' => 9,
                'is_active' => true,
                'order' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }

    private function getImmunotherapyContent(): string
    {
        return "
        <h3>Terobosan Dostarlimab dalam Kanker Rektal</h3>
        <p>Penelitian terbaru yang dipublikasikan pada tahun 2024 menunjukkan hasil yang menggembirakan dengan penggunaan dostarlimab, sebuah checkpoint inhibitor. Dalam studi kecil yang melibatkan 42 pasien kanker rektal, seluruh pasien yang menerima dostarlimab sebagai infus bulanan mengalami remisi lengkap, dengan beberapa pasien tetap dalam kondisi remisi setelah empat tahun.</p>

        <h3>Imunoterapi sebagai Alternatif Operasi</h3>
        <p>Studi terbaru menunjukkan bahwa imunoterapi dapat membantu pasien kanker tertentu menghindari operasi dan perawatan invasif lainnya. Ini merupakan paradigma baru dalam penanganan kanker, di mana terapi imun dapat menjadi pilihan pertama dibandingkan dengan pendekatan konvensional.</p>

        <h3>PROTAC: Pendekatan Baru dalam Imunoterapi</h3>
        <p>Senyawa baru yang disebut NR-V04, yang merupakan PROTAC (Proteolysis Targeting Chimeras), telah dikembangkan sebagai alternatif baru dalam imunoterapi. PROTAC berfungsi mirip dengan checkpoint inhibitor dengan melepaskan 'rem' pada sel-sel imun tubuh sehingga dapat menyerang sel kanker dengan lebih efektif.</p>

        <h3>Prospek Masa Depan</h3>
        <p>Para ahli memperkirakan bahwa tahun 2025 akan menjadi tahun yang penting untuk kemajuan dalam precision medicine, imunoterapi, dan penggunaan AI dalam pengobatan kanker. Fokus penelitian juga diarahkan pada pengurangan disparitas dalam akses pengobatan kanker dan pengembangan terapi yang lebih personal dan efektif.</p>
        ";
    }

    private function getMentalHealthContent(): string
    {
        return "
        <h3>Temuan Studi Longitudinal 2020-2023</h3>
        <p>Studi longitudinal yang dipublikasikan dalam Scientific Reports (2024) mengikuti 538 pekerja rumah sakit dari musim gugur 2020 hingga akhir pandemi COVID-19 pada tahun 2023. Dari kohort asli, 289 pekerja (54%) menyelesaikan survei kedelapan, memberikan wawasan berharga tentang tren kesehatan mental selama periode kritis ini.</p>

        <h3>Prevalensi Masalah Kesehatan Mental</h3>
        <p>Meta-analisis komprehensif yang diterbitkan dalam PubMed (2024) mengidentifikasi peningkatan signifikan dalam tingkat depresi, kecemasan, dan insomnia di kalangan tenaga kesehatan. Penelitian ini mengevaluasi secara sistematis masalah kesehatan mental tenaga kesehatan di seluruh dunia selama pandemi.</p>

        <h3>Intervensi dan Dukungan</h3>
        <p>Investasi berkelanjutan dalam program kesehatan mental untuk tenaga kesehatan sangat penting, tidak hanya untuk kesejahteraan mereka tetapi juga untuk memastikan kualitas pelayanan kesehatan yang optimal bagi masyarakat.</p>
        ";
    }

    private function getAIDiagnosisContent(): string
    {
        return "
        <h3>Transformasi dalam Diagnosis Medis</h3>
        <p>Menurut review komprehensif yang diterbitkan dalam Medical Review (2025), integrasi artificial intelligence dalam diagnostik medis merepresentasikan kemajuan transformatif dalam healthcare. AI memproses data dalam jumlah besar dengan cepat, yang berpotensi menghasilkan diagnosis yang lebih dini dan akurat.</p>

        <h3>Analisis Citra Medis</h3>
        <p>Tools berbasis AI menggunakan algoritma machine learning yang canggih untuk menganalisis gambar luka, memberikan assessment yang cepat dan presisi. Foundation models telah memicu aspek tambahan dalam penelitian AI terkait healthcare, khususnya penggunaan data berbasis teks.</p>

        <h3>Visi 2025</h3>
        <p>Tahun 2025 diperkirakan akan menjadi tahun revolusioner untuk AI dalam healthcare, dengan fokus pada personalisasi pengobatan dan peningkatan efisiensi diagnostik.</p>
        ";
    }

    private function getTelemedicineContent(): string
    {
        return "
        <h3>Evolusi Telemedicine Post-Pandemi</h3>
        <p>Berdasarkan analisis komprehensif yang dipublikasikan dalam Healthcare Management Forum (2024), telemedicine telah mengalami transformasi signifikan dari solusi darurat pandemi menjadi komponen integral dari sistem healthcare modern.</p>

        <h3>Protokol Keamanan</h3>
        <p>Implementasi protokol keamanan yang ketat meliputi enkripsi end-to-end untuk semua komunikasi, autentikasi multi-faktor untuk provider dan pasien, serta platform HIPAA-compliant yang terverifikasi.</p>

        <h3>Best Practices</h3>
        <p>Telemedicine telah membuktikan dirinya sebagai modalitas healthcare yang valuable dan sustainable dengan implementasi best practices yang tepat.</p>
        ";
    }

    private function getNutritionContent(): string
    {
        return "
        <h3>Pola Makan Mediterania</h3>
        <p>Penelitian menunjukkan bahwa pola makan Mediterania yang kaya akan buah-buahan, sayuran, ikan, dan minyak zaitun dapat mengurangi risiko penyakit kardiovaskular hingga 30%.</p>

        <h3>Antioksidan dan Kesehatan Jantung</h3>
        <p>Konsumsi makanan tinggi antioksidan seperti berry, dark chocolate, dan teh hijau terbukti dapat melindungi pembuluh darah dari kerusakan oksidatif.</p>

        <h3>Rekomendasi Praktis</h3>
        <p>Panduan nutrisi praktis untuk pencegahan penyakit kardiovaskular meliputi pembatasan sodium, peningkatan konsumsi serat, dan pemilihan lemak sehat.</p>
        ";
    }

    private function getGeneTherapyContent(): string
    {
        return "
        <h3>Teknologi CRISPR</h3>
        <p>CRISPR-Cas9 telah merevolusi terapi gen dengan memungkinkan editing genetik yang presisi. Teknologi ini telah berhasil digunakan untuk mengobati penyakit sel sabit dan beta-thalassemia.</p>

        <h3>Aplikasi Klinis</h3>
        <p>Terapi gen kini digunakan untuk mengobati berbagai kondisi termasuk defisiensi imun, penyakit mata herediter, dan beberapa jenis kanker.</p>

        <h3>Tantangan dan Masa Depan</h3>
        <p>Meskipun menjanjikan, terapi gen masih menghadapi tantangan dalam hal keamanan jangka panjang, biaya, dan aksesibilitas.</p>
        ";
    }

    private function getMicrobiomeContent(): string
    {
        return "
        <h3>Peran Mikrobioma dalam Kesehatan</h3>
        <p>Mikrobioma usus memainkan peran penting dalam pencernaan, sistem imun, dan bahkan kesehatan mental melalui gut-brain axis.</p>

        <h3>Terapi Probiotik</h3>
        <p>Pengembangan probiotik yang dipersonalisasi berdasarkan profil mikrobioma individu menunjukkan hasil yang menjanjikan dalam pengobatan berbagai kondisi gastrointestinal.</p>

        <h3>Penelitian Terkini</h3>
        <p>Studi terbaru mengungkap hubungan antara mikrobioma dan penyakit seperti diabetes, obesitas, dan penyakit autoimun.</p>
        ";
    }

    private function getVaccinationContent(): string
    {
        return "
        <h3>Kekebalan Komunitas</h3>
        <p>Vaksinasi tidak hanya melindungi individu yang divaksin, tetapi juga menciptakan kekebalan komunitas yang melindungi populasi rentan.</p>

        <h3>Teknologi Vaksin Baru</h3>
        <p>Pengembangan vaksin mRNA telah membuka jalan untuk respons yang lebih cepat terhadap pandemi dan penyakit menular baru.</p>

        <h3>Mengatasi Hesitansi Vaksin</h3>
        <p>Strategi komunikasi yang efektif dan edukasi berbasis bukti penting untuk mengatasi keraguan vaksin di masyarakat.</p>
        ";
    }

    private function getDiabetesContent(): string
    {
        return "
        <h3>Pendekatan Multidisiplin</h3>
        <p>Manajemen diabetes tipe 2 yang efektif memerlukan kolaborasi antara dokter, ahli gizi, educator diabetes, dan dukungan keluarga.</p>

        <h3>Teknologi dalam Manajemen Diabetes</h3>
        <p>Continuous glucose monitoring (CGM) dan insulin pump telah mengubah cara pasien mengelola diabetes mereka sehari-hari.</p>

        <h3>Pencegahan Komplikasi</h3>
        <p>Kontrol glikemik yang ketat dapat mencegah komplikasi jangka panjang seperti neuropati, retinopati, dan nefropati diabetik.</p>
        ";
    }

    private function getReproductiveHealthContent(): string
    {
        return "
        <h3>Teknologi Reproduksi Berbantu</h3>
        <p>Kemajuan dalam IVF, ICSI, dan teknik preservasi fertilitas telah memberikan harapan baru bagi pasangan dengan masalah kesuburan.</p>

        <h3>Skrining Kanker Ginekologi</h3>
        <p>Program skrining rutin untuk kanker serviks, ovarium, dan endometrium dapat meningkatkan deteksi dini dan survival rate.</p>

        <h3>Kesehatan Reproduksi Remaja</h3>
        <p>Edukasi komprehensif tentang kesehatan reproduksi sejak dini penting untuk mencegah kehamilan tidak diinginkan dan infeksi menular seksual.</p>
        ";
    }
}
