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
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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
            color: #888;
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
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
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-button.active {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-blue-600 bg-clip-text text-transparent">
                    {{ __('Latest Medical Articles') }}
                </h1>
            </div>

            <p class="text-gray-600 dark:text-gray-300 text-lg max-w-3xl mx-auto leading-relaxed">
                {{ __('A collection of medical articles based on trusted research and scientific journals to enhance your understanding of the latest developments in medicine.') }}
            </p>
        </header>

        <!-- Quick Navigation -->
        <nav class="mb-12 animate-slide-up">
            <div class="flex flex-wrap gap-3 justify-center">
                <button onclick="toggleArticle('article1')"
                    class="nav-button px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg transition duration-300 text-sm font-medium">
                    {{ __('Cancer Immunotherapy') }}
                </button>
                <button onclick="toggleArticle('article2')"
                    class="nav-button px-4 py-2 bg-green-100 hover:bg-green-200 text-green-800 rounded-lg transition duration-300 text-sm font-medium">
                    {{ __('Mental Health') }}
                </button>
                <button onclick="toggleArticle('article3')"
                    class="nav-button px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-800 rounded-lg transition duration-300 text-sm font-medium">
                    {{ __('AI Diagnosis') }}
                </button>
                <button onclick="toggleArticle('article4')"
                    class="nav-button px-4 py-2 bg-orange-100 hover:bg-orange-200 text-orange-800 rounded-lg transition duration-300 text-sm font-medium">
                    {{ __('Telemedicine') }}
                </button>
            </div>
        </nav>

        <!-- Articles Section -->
        <main class="space-y-6">
            <!-- Article 1: Immunotherapy -->
            <article id="article1"
                class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article1')">
                    <div class="flex items-start gap-6">
                        <div
                        class="article-icon w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 100 20 10 10 0 000-20zM12 6v6m0 4h.01" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                {{ __('Recent Advances in Immunotherapy for Cancer Treatment') }}
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. Sarah Johnson</span>
                                <span>•</span>
                                <span>{{ __('May 28, 2025') }}</span>
                                <span>•</span>
                                <span>8 {{ __('min read') }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                {{ __('Immunotherapy has become a revolutionary breakthrough in cancer treatment, with recent research showing very promising results for various types of cancer...') }}
                            </p>
                        </div>
                        <div class="expand-icon">
                            <!-- icon -->
                        </div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            {{ __('Immunotherapy has become a revolutionary breakthrough in cancer treatment, with recent research showing very promising results for various types of cancer.') }}
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Dostarlimab Breakthrough in Rectal Cancer') }}
                        </h3>
                        <p>
                            {{ __('A recent study published in 2024 showed encouraging results with the use of dostarlimab, a checkpoint inhibitor. In a small study involving 42 rectal cancer patients, all patients who received dostarlimab as a monthly infusion experienced complete remission, with some remaining in remission after four years.') }}
                        </p>

                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "{{ __('This study demonstrates the potential of immunotherapy as a first-line therapy for early-stage mismatch repair-deficient cancer, allowing patients to avoid invasive surgery and chemotherapy.') }}"
                                - TIME Magazine, 2024
                            </p>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Immunotherapy as an Alternative to Surgery') }}
                        </h3>
                        <p>
                            {{ __('Recent studies suggest that immunotherapy can help certain cancer patients avoid surgery and other invasive treatments. This represents a new paradigm in cancer management, where immune therapy may be the first choice compared to conventional approaches.') }}
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('PROTAC: A New Approach in Immunotherapy') }}
                        </h3>
                        <p>
                            {{ __('A new compound called NR-V04, which is a PROTAC (Proteolysis Targeting Chimeras), has been developed as a new alternative in immunotherapy. PROTACs work similarly to checkpoint inhibitors by releasing the "brakes" on the body\'s immune cells so they can more effectively attack cancer cells.') }}
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Future Prospects') }}
                        </h3>
                        <p>
                            {{ __('Experts predict that 2025 will be a significant year for advancements in precision medicine, immunotherapy, and the use of AI in cancer treatment. Research is also focused on reducing disparities in cancer treatment access and developing more personalized and effective therapies.') }}
                        </p>

                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-3">{{ __('Conclusion') }}</h4>
                            <p class="text-blue-700 dark:text-blue-400">
                                {{ __('Immunotherapy continues to develop as a revolutionary treatment modality, offering new hope for cancer patients with fewer side effects compared to conventional therapies. Ongoing research is needed to optimize the use of immunotherapy for various types of cancer.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Article 2: Mental Health -->
            <article id="article2"
                class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article2')">
                    <div class="flex items-start gap-6">
                        <div
                            class="article-icon w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <!-- icon -->
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                {{ __('Mental Health of Healthcare Workers: Insights Post-Pandemic') }}
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. Michael Chen</span>
                                <span>•</span>
                                <span>{{ __('May 26, 2025') }}</span>
                                <span>•</span>
                                <span>12 {{ __('min read') }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                {{ __('The impact of the COVID-19 pandemic on the mental health of healthcare workers has been the focus of intensive research, uncovering complex and ongoing challenges...') }}
                            </p>
                        </div>
                        <div class="expand-icon">
                            <!-- icon -->
                        </div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            {{ __('The impact of the COVID-19 pandemic on the mental health of healthcare workers has been the focus of intensive research, uncovering complex and ongoing challenges.') }}
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Findings from the 2020-2023 Longitudinal Study') }}
                        </h3>
                        <p>
                            {{ __('A longitudinal study published in Scientific Reports (2024) followed 538 hospital workers from the fall of 2020 until the end of the COVID-19 pandemic in 2023. Of the original cohort, 289 workers (54%) completed the eighth survey, providing valuable insights into mental health trends during this critical period.') }}
                        </p>

                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "{{ __('The repeated-measures ANOVA analysis revealed significant changes in psychological distress (F = 7.4, P < .001) and posttraumatic symptoms (F=14.1, P < .001) among healthcare workers throughout the pandemic.') }}"
                                - Scientific Reports, 2024
                            </p>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Prevalence of Mental Health Issues') }}
                        </h3>
                        <p>
                            {{ __('A comprehensive meta-analysis published in PubMed (2024) identified a significant increase in the levels of depression, anxiety, and insomnia among healthcare workers. This research systematically evaluated the mental health issues faced by healthcare workers worldwide during the pandemic.') }}
                        </p>

                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>{{ __('Depression rates significantly increased compared to the pre-pandemic period') }}
                            </li>
                            <li>{{ __('Anxiety disorders became more prevalent among nurses and doctors') }}</li>
                            <li>{{ __('Insomnia and sleep disturbances were widely reported') }}</li>
                            <li>{{ __('PTSD symptoms were found in a concerning proportion') }}</li>
                        </ul>

                        <div class="grid md:grid-cols-2 gap-6 my-6">
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-green-800 dark:text-green-300 mb-2">
                                    {{ __('Organizational Support') }}
                                </h4>
                                <ul class="text-sm text-green-700 dark:text-green-400 space-y-1">
                                    <li>• {{ __('Employee Assistance Programs (EAP)') }}</li>
                                    <li>• {{ __('Work-life balance policies') }}</li>
                                    <li>• {{ __('Rotation systems to reduce workload') }}</li>
                                </ul>
                            </div>
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">
                                    {{ __('Individual Interventions') }}
                                </h4>
                                <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                    <li>• {{ __('Cognitive-behavioral therapy') }}</li>
                                    <li>• {{ __('Mindfulness and meditation techniques') }}</li>
                                    <li>• {{ __('Stress management programs') }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-green-800 dark:text-green-300 mb-3">
                                {{ __('Recommendations') }}
                            </h4>
                            <p class="text-green-700 dark:text-green-400">
                                {{ __('Sustained investment in mental health programs for healthcare workers is crucial, not only for their well-being but also to ensure optimal quality of healthcare services for the community.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Article 3: AI in Medical Diagnosis -->
            <article id="article3"
                class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article3')">
                    <div class="flex items-start gap-6">
                        <div
                            class="article-icon w-24 h-24 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <!-- icon -->
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                {{ __('AI and Machine Learning in Medical Diagnosis') }}
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. Emily Rodriguez</span>
                                <span>•</span>
                                <span>{{ __('May 24, 2025') }}</span>
                                <span>•</span>
                                <span>10 {{ __('min read') }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                {{ __('Artificial intelligence has fundamentally changed the landscape of medical diagnosis, with market growth projected to reach $188 billion by 2030...') }}
                            </p>
                        </div>
                        <div class="expand-icon"></div>
                    </div>
                </div>
                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            {{ __('Artificial intelligence has fundamentally changed the landscape of medical diagnosis, with market growth projected to reach $188 billion by 2030.') }}
                        </p>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Transformations in Medical Diagnosis') }}
                        </h3>
                        <p>
                            {{ __('According to a comprehensive review published in Medical Review (2025), the integration of artificial intelligence in medical diagnostics represents a transformative advancement in healthcare.') }}
                        </p>
                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "{{ __('AI processes large amounts of data quickly, potentially resulting in earlier and more accurate diagnoses.') }}"
                                - MGMA, 2024
                            </p>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 my-6">
                            <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg">
                                <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">
                                    {{ __('Medical Image Analysis') }}
                                </h4>
                                <p class="text-sm text-purple-700 dark:text-purple-400">
                                    {{ __('AI-based tools use advanced machine learning algorithms to analyze wound images, providing fast and precise assessments.') }}
                                </p>
                            </div>
                            <div class="bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-lg">
                                <h4 class="font-semibold text-indigo-800 dark:text-indigo-300 mb-3">
                                    {{ __('Large Language Models') }}
                                </h4>
                                <p class="text-sm text-indigo-700 dark:text-indigo-400">
                                    {{ __('Foundation models have triggered additional aspects in AI research related to healthcare, especially the use of text-based data.') }}
                                </p>
                            </div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-purple-800 dark:text-purple-300 mb-3">
                                {{ __('Vision 2025') }}
                            </h4>
                            <p class="text-purple-700 dark:text-purple-400">
                                {{ __('2025 is expected to be a revolutionary year for AI in healthcare, focusing on personalized treatment and improved diagnostic efficiency.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Article 4: Telemedicine -->
            <article id="article4"
                class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden animate-slide-up">
                <div class="article-header p-8" onclick="toggleArticle('article4')">
                    <div class="flex items-start gap-6">
                        <div
                            class="article-icon w-24 h-24 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                            <!-- icon -->
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white leading-tight">
                                {{ __('Telemedicine: Best Practices and Patient Safety') }}
                            </h2>
                            <div class="article-meta text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Dr. James Wilson</span>
                                <span>•</span>
                                <span>{{ __('May 22, 2025') }}</span>
                                <span>•</span>
                                <span>6 {{ __('min read') }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 article-preview leading-relaxed">
                                {{ __('Telemedicine has grown rapidly post-pandemic with strict security protocols...') }}
                            </p>
                        </div>
                        <div class="expand-icon"></div>
                    </div>
                </div>

                <div class="article-body px-8 pb-8">
                    <div class="section-divider"></div>
                    <div class="article-content text-gray-700 dark:text-gray-300 space-y-6">
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            {{ __('Telemedicine has grown rapidly post-pandemic, with recent research highlighting the importance of implementing strict security protocols to ensure service quality and patient safety.') }}
                        </p>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
                            {{ __('Evolution of Telemedicine Post-Pandemic') }}
                        </h3>
                        <p>
                            {{ __('According to a comprehensive analysis published in Healthcare Management Forum (2024), telemedicine has undergone a significant transformation from an emergency pandemic solution to an integral component of modern healthcare systems.') }}
                        </p>
                        <div class="citation p-4 rounded-lg my-6">
                            <p class="text-sm italic">
                                "{{ __('Telemedicine is no longer a temporary solution, but has become a permanent healthcare modality with clear protocols and standards.') }}"
                                - American Medical Association, 2024
                            </p>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 my-6">
                            <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-orange-800 dark:text-orange-300 mb-3">
                                    {{ __('Technical Security') }}
                                </h4>
                                <ul class="text-sm text-orange-700 dark:text-orange-400 space-y-2">
                                    <li>• {{ __('End-to-end encryption for all communications') }}</li>
                                    <li>• {{ __('Multi-factor authentication for providers and patients') }}</li>
                                    <li>• {{ __('Verified HIPAA-compliant platforms') }}</li>
                                </ul>
                            </div>
                            <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-red-800 dark:text-red-300 mb-3">
                                    {{ __('Clinical Protocols') }}
                                </h4>
                                <ul class="text-sm text-red-700 dark:text-red-400 space-y-2">
                                    <li>• {{ __('Strict patient identity verification') }}</li>
                                    <li>• {{ __('Comprehensive documentation') }}</li>
                                    <li>• {{ __('Emergency response protocols') }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-orange-50 dark:bg-orange-900/20 p-6 rounded-lg mt-8">
                            <h4 class="font-semibold text-orange-800 dark:text-orange-300 mb-3">
                                {{ __('Conclusion') }}
                            </h4>
                            <p class="text-orange-700 dark:text-orange-400">
                                {{ __('Telemedicine has proven itself as a valuable and sustainable healthcare modality with the right implementation of best practices.') }}
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
