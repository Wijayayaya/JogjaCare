<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Medis - Penelitian Terkini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'expand': 'expand 0.4s ease-out',
                        'collapse': 'collapse 0.3s ease-in'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes expand {
            from { 
                opacity: 0;
                max-height: 0;
                transform: translateY(-10px);
            }
            to { 
                opacity: 1;
                max-height: 2000px;
                transform: translateY(0);
            }
        }
        
        @keyframes collapse {
            from { 
                opacity: 1;
                max-height: 2000px;
            }
            to { 
                opacity: 0;
                max-height: 0;
            }
        }
        
        .article-content {
            line-height: 1.8;
        }
        
        .citation {
            background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
            border-left: 4px solid #2196f3;
        }
        
        .article-body {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .article-body.expanded {
            max-height: 2000px;
            opacity: 1;
            animation: expand 0.4s ease-out;
        }
        
        .article-header {
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .article-header:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        .article-header:active {
            transform: translateY(0);
        }
        
        .expand-icon {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
        }
        
        .expanded .expand-icon {
            transform: rotate(180deg);
        }
        
        .article-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .article-card.expanded {
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
            border-color: rgba(59, 130, 246, 0.1);
        }
        
        .article-preview {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .nav-button {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .nav-button.active {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            z-index: 1000;
            transition: width 0.3s ease;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        
        .article-meta span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 2rem 0;
        }
        
        /* Font consistency with quiz */
        h1 {
            font-weight: 700;
            font-size: 2.25rem;
        }
        
        h2 {
            font-weight: 700;
            font-size: 1.875rem;
        }
        
        h3 {
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        h4 {
            font-weight: 600;
            font-size: 1.125rem;
        }
        
        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }
        
        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 500;
        }
        
        .text-2xl {
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 700;
        }
        
        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
            font-weight: 700;
        }
        
        .text-4xl {
            font-size: 2.25rem;
            line-height: 2.5rem;
            font-weight: 700;
        }
        
        p {
            font-weight: 400;
            line-height: 1.75;
        }
        
        .font-medium {
            font-weight: 500;
        }
        
        .font-semibold {
            font-weight: 600;
        }
        
        .font-bold {
            font-weight: 700;
        }
        
        @media (max-width: 768px) {
            .article-header {
                padding: 1.5rem !important;
            }
            
            .article-body {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
            
            .article-icon {
                width: 4rem !important;
                height: 4rem !important;
            }
            
            .article-icon svg {
                width: 2rem !important;
                height: 2rem !important;
            }
            
            h1 {
                font-size: 1.875rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 min-h-screen">
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>
    
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header Section -->
        <header class="text-center mb-12 animate-fade-in">
            <div class="flex items-center justify-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-blue-600 bg-clip-text text-transparent">
                    Artikel Medis Terkini
                </h1>
            </div>
            
            <p class="text-gray-600 dark:text-gray-300 text-lg max-w-3xl mx-auto leading-relaxed">
                Koleksi artikel medis berdasarkan penelitian dan jurnal ilmiah terpercaya untuk meningkatkan pemahaman tentang perkembangan terkini dalam dunia kedokteran.
            </p>
        </header>

        <!-- Quick Navigation -->
        <nav class="mb-12 animate-slide-up">
            <div class="flex flex-wrap gap-3 justify-center">
                <button onclick="toggleArticle('article1')" class="nav-button px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg transition duration-300 text-sm font-medium">
                    Imunoterapi Kanker
                </button>
                <button onclick="toggleArticle('article2')" class="nav-button px-4 py-2 bg-green-100 hover:bg-green-200 text-green-800 rounded-lg transition duration-300 text-sm font-medium">
                    Kesehatan Mental
                </button>
                <button onclick="toggleArticle('article3')" class="nav-button px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-800 rounded-lg transition duration-300 text-sm font-medium">
                    AI Diagnosis
                </button>
                <button onclick="toggleArticle('article4')" class="nav-button px-4 py-2 bg-orange-100 hover:bg-orange-200 text-orange-800 rounded-lg transition duration-300 text-sm font-medium">
                    Telemedicine
                </button>
            </div>
        </nav>

        <!-- Articles Section -->
        <main class="space-y-6">
            <!-- Article 1: Immunotherapy -->
            <article id="article1" class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article1')">
                    <div class="flex items-start gap-6">
                        <div class="article-icon w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                Kemajuan Terkini dalam Imunoterapi untuk Pengobatan Kanker
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. Sarah Johnson</span>
                                <span>•</span>
                                <span>28 Mei 2025</span>
                                <span>•</span>
                                <span>8 min read</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                Imunoterapi telah menjadi terobosan revolusioner dalam pengobatan kanker, dengan penelitian terbaru menunjukkan hasil yang sangat menjanjikan untuk berbagai jenis kanker...
                            </p>
                        </div>
                        <div class="expand-icon">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Imunoterapi telah menjadi terobosan revolusioner dalam pengobatan kanker, dengan penelitian terbaru menunjukkan hasil yang sangat menjanjikan untuk berbagai jenis kanker.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Terobosan Dostarlimab dalam Kanker Rektal</h3>
                        <p>
                            Penelitian terbaru yang dipublikasikan pada tahun 2024 menunjukkan hasil yang menggembirakan dengan penggunaan dostarlimab, sebuah checkpoint inhibitor. Dalam studi kecil yang melibatkan 42 pasien kanker rektal, seluruh pasien yang menerima dostarlimab sebagai infus bulanan mengalami remisi lengkap, dengan beberapa pasien tetap dalam kondisi remisi setelah empat tahun.
                        </p>

                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "Penelitian ini menunjukkan potensi imunoterapi sebagai terapi lini pertama untuk kanker stadium awal dengan defisiensi mismatch repair, memungkinkan pasien untuk menghindari operasi dan kemoterapi invasif." - TIME Magazine, 2024
                            </p>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Imunoterapi sebagai Alternatif Operasi</h3>
                        <p>
                            Studi terbaru menunjukkan bahwa imunoterapi dapat membantu pasien kanker tertentu menghindari operasi dan perawatan invasif lainnya. Ini merupakan paradigma baru dalam penanganan kanker, di mana terapi imun dapat menjadi pilihan pertama dibandingkan dengan pendekatan konvensional.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">PROTAC: Pendekatan Baru dalam Imunoterapi</h3>
                        <p>
                            Senyawa baru yang disebut NR-V04, yang merupakan PROTAC (Proteolysis Targeting Chimeras), telah dikembangkan sebagai alternatif baru dalam imunoterapi. PROTAC berfungsi mirip dengan checkpoint inhibitor dengan melepaskan "rem" pada sel-sel imun tubuh sehingga dapat menyerang sel kanker dengan lebih efektif.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Prospek Masa Depan</h3>
                        <p>
                            Para ahli memperkirakan bahwa tahun 2025 akan menjadi tahun yang penting untuk kemajuan dalam precision medicine, imunoterapi, dan penggunaan AI dalam pengobatan kanker. Fokus penelitian juga diarahkan pada pengurangan disparitas dalam akses pengobatan kanker dan pengembangan terapi yang lebih personal dan efektif.
                        </p>

                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-3">Kesimpulan</h4>
                            <p class="text-blue-700 dark:text-blue-400">
                                Imunoterapi terus berkembang sebagai modalitas pengobatan yang revolusioner, memberikan harapan baru bagi pasien kanker dengan efek samping yang lebih minimal dibandingkan terapi konvensional. Penelitian berkelanjutan diperlukan untuk mengoptimalkan penggunaan imunoterapi pada berbagai jenis kanker.
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Article 2: Mental Health -->
            <article id="article2" class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article2')">
                    <div class="flex items-start gap-6">
                        <div class="article-icon w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                Kesehatan Mental Tenaga Kesehatan: Wawasan Pasca-Pandemi
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. Michael Chen</span>
                                <span>•</span>
                                <span>26 Mei 2025</span>
                                <span>•</span>
                                <span>12 min read</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                Dampak pandemi COVID-19 terhadap kesehatan mental tenaga kesehatan telah menjadi fokus penelitian yang intensif, mengungkap tantangan yang kompleks dan berkelanjutan...
                            </p>
                        </div>
                        <div class="expand-icon">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Dampak pandemi COVID-19 terhadap kesehatan mental tenaga kesehatan telah menjadi fokus penelitian yang intensif, mengungkap tantangan yang kompleks dan berkelanjutan.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Temuan Studi Longitudinal 2020-2023</h3>
                        <p>
                            Studi longitudinal yang dipublikasikan dalam Scientific Reports (2024) mengikuti 538 pekerja rumah sakit dari musim gugur 2020 hingga akhir pandemi COVID-19 pada tahun 2023. Dari kohort asli, 289 pekerja (54%) menyelesaikan survei kedelapan, memberikan wawasan berharga tentang tren kesehatan mental selama periode kritis ini.
                        </p>

                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "Analisis repeated-measures ANOVA mengungkap perubahan signifikan dalam distres psikologis (F = 7.4, P < .001) dan gejala posttraumatic (F = 14.1, P < .001) pada tenaga kesehatan sepanjang periode pandemi." - Scientific Reports, 2024
                            </p>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Prevalensi Masalah Kesehatan Mental</h3>
                        <p>
                            Meta-analisis komprehensif yang diterbitkan dalam PubMed (2024) mengidentifikasi peningkatan signifikan dalam tingkat depresi, kecemasan, dan insomnia di kalangan tenaga kesehatan. Penelitian ini mengevaluasi secara sistematis masalah kesehatan mental tenaga kesehatan di seluruh dunia selama pandemi.
                        </p>

                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Tingkat depresi meningkat secara signifikan dibandingkan periode pra-pandemi</li>
                            <li>Gangguan kecemasan menjadi lebih prevalent di kalangan perawat dan dokter</li>
                            <li>Insomnia dan gangguan tidur dilaporkan secara luas</li>
                            <li>Gejala PTSD ditemukan pada proporsi yang mengkhawatirkan</li>
                        </ul>

                        <div class="grid md:grid-cols-2 gap-6 my-6">
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-green-800 dark:text-green-300 mb-2">Dukungan Organisasi</h4>
                                <ul class="text-sm text-green-700 dark:text-green-400 space-y-1">
                                    <li>• Program bantuan karyawan (EAP)</li>
                                    <li>• Kebijakan work-life balance</li>
                                    <li>• Sistem rotasi untuk mengurangi beban kerja</li>
                                </ul>
                            </div>
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">Intervensi Individual</h4>
                                <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                    <li>• Terapi kognitif-behavioral</li>
                                    <li>• Teknik mindfulness dan meditasi</li>
                                    <li>• Program manajemen stres</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-green-800 dark:text-green-300 mb-3">Rekomendasi</h4>
                            <p class="text-green-700 dark:text-green-400">
                                Investasi berkelanjutan dalam program kesehatan mental untuk tenaga kesehatan sangat penting, tidak hanya untuk kesejahteraan mereka tetapi juga untuk memastikan kualitas pelayanan kesehatan yang optimal bagi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Article 3: AI in Medical Diagnosis -->
            <article id="article3" class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article3')">
                    <div class="flex items-start gap-6">
                        <div class="article-icon w-24 h-24 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                AI dan Machine Learning dalam Diagnosis Medis
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. Emily Rodriguez</span>
                                <span>•</span>
                                <span>24 Mei 2025</span>
                                <span>•</span>
                                <span>10 min read</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                Kecerdasan buatan telah mengubah lanskap diagnosis medis secara fundamental, dengan proyeksi pertumbuhan pasar mencapai $188 miliar pada tahun 2030...
                            </p>
                        </div>
                        <div class="expand-icon">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Kecerdasan buatan telah mengubah lanskap diagnosis medis secara fundamental, dengan proyeksi pertumbuhan pasar mencapai $188 miliar pada tahun 2030.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Transformasi dalam Diagnosis Medis</h3>
                        <p>
                            Menurut review komprehensif yang diterbitkan dalam Medical Review (2025), integrasi artificial intelligence dalam diagnostik medis merepresentasikan kemajuan transformatif dalam healthcare.
                        </p>

                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "AI memproses data dalam jumlah besar dengan cepat, yang berpotensi menghasilkan diagnosis yang lebih dini dan akurat." - MGMA, 2024
                            </p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 my-6">
                            <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg">
                                <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">Analisis Citra Medis</h4>
                                <p class="text-sm text-purple-700 dark:text-purple-400">
                                    Tools berbasis AI menggunakan algoritma machine learning yang canggih untuk menganalisis gambar luka, memberikan assessment yang cepat dan presisi.
                                </p>
                            </div>
                            <div class="bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-lg">
                                <h4 class="font-semibold text-indigo-800 dark:text-indigo-300 mb-3">Large Language Models</h4>
                                <p class="text-sm text-indigo-700 dark:text-indigo-400">
                                    Foundation models telah memicu aspek tambahan dalam penelitian AI terkait healthcare, khususnya penggunaan data berbasis teks.
                                </p>
                            </div>
                        </div>

                        <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">Visi 2025</h4>
                            <p class="text-purple-700 dark:text-purple-400">
                                Tahun 2025 diperkirakan akan menjadi tahun revolusioner untuk AI dalam healthcare, dengan fokus pada personalisasi pengobatan dan peningkatan efisiensi diagnostik.
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Article 4: Telemedicine -->
            <article id="article4" class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article4')">
                    <div class="flex items-start gap-6">
                        <div class="article-icon w-24 h-24 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                Telemedicine: Best Practices dan Keamanan Pasien
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. James Wilson</span>
                                <span>•</span>
                                <span>22 Mei 2025</span>
                                <span>•</span>
                                <span>6 min read</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                Telemedicine telah berkembang pesat pasca-pandemi dengan protokol keamanan yang ketat...
                            </p>
                        </div>
                        <div class="expand-icon">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Telemedicine telah berkembang pesat pasca-pandemi, dengan penelitian terbaru menunjukkan pentingnya implementasi protokol keamanan yang ketat untuk memastikan kualitas pelayanan dan keselamatan pasien.
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">Evolusi Telemedicine Post-Pandemi</h3>
                        <p>
                            Berdasarkan analisis komprehensif yang dipublikasikan dalam Healthcare Management Forum (2024), telemedicine telah mengalami transformasi signifikan dari solusi darurat pandemi menjadi komponen integral dari sistem healthcare modern.
                        </p>

                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "Telemedicine bukan lagi solusi sementara, tetapi telah menjadi modalitas pelayanan kesehatan yang permanen dengan protokol dan standar yang jelas." - American Medical Association, 2024
                            </p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 my-6">
                            <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-orange-800 dark:text-orange-300 mb-3">Keamanan Teknis</h4>
                                <ul class="text-sm text-orange-700 dark:text-orange-400 space-y-2">
                                    <li>• Enkripsi end-to-end untuk semua komunikasi</li>
                                    <li>• Autentikasi multi-faktor untuk provider dan pasien</li>
                                    <li>• Platform HIPAA-compliant yang terverifikasi</li>
                                </ul>
                            </div>
                            <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-red-800 dark:text-red-300 mb-3">Protokol Klinis</h4>
                                <ul class="text-sm text-red-700 dark:text-red-400 space-y-2">
                                    <li>• Verifikasi identitas pasien yang ketat</li>
                                    <li>• Dokumentasi yang komprehensif</li>
                                    <li>• Protokol emergency response</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-orange-50 dark:bg-orange-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-orange-800 dark:text-orange-300 mb-3">Kesimpulan</h4>
                            <p class="text-orange-700 dark:text-orange-400">
                                Telemedicine telah membuktikan dirinya sebagai modalitas healthcare yang valuable dan sustainable dengan implementasi best practices yang tepat.
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </main>

    </div>

    <script>
        let currentlyExpanded = null;

        function toggleArticle(articleId) {
            const article = document.getElementById(articleId);
            const articleBody = article.querySelector('.article-body');
            const isCurrentlyExpanded = article.classList.contains('expanded');

            // Close all articles first
            document.querySelectorAll('.article-card').forEach(card => {
                card.classList.remove('expanded');
                card.querySelector('.article-body').classList.remove('expanded');
            });

            // If the clicked article wasn't expanded, expand it
            if (!isCurrentlyExpanded) {
                article.classList.add('expanded');
                articleBody.classList.add('expanded');
                currentlyExpanded = articleId;
                
                // Smooth scroll to the article
                setTimeout(() => {
                    article.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            } else {
                currentlyExpanded = null;
            }
        }

        function scrollToArticle(articleId) {
            toggleArticle(articleId);
        }

        // Add smooth scrolling animation for articles
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('article').forEach(article => {
            article.style.opacity = '0';
            article.style.transform = 'translateY(30px)';
            article.style.transition = 'all 0.6s ease-out';
            observer.observe(article);
        });

        // Dark mode toggle functionality
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        }

        // Load dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }

        // Close article when clicking outside
        document.addEventListener('click', function(event) {
            const clickedElement = event.target;
            const isInsideArticle = clickedElement.closest('.article-card');
            const isNavigationButton = clickedElement.closest('.flex.flex-wrap');
            
            if (!isInsideArticle && !isNavigationButton && currentlyExpanded) {
                document.querySelectorAll('.article-card').forEach(card => {
                    card.classList.remove('expanded');
                    card.querySelector('.article-body').classList.remove('expanded');
                });
                currentlyExpanded = null;
            }
        });
    </script>
</body>
</html>