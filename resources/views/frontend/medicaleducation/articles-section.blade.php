<div class="bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 min-h-screen">
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>
    
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header Section -->
        <header class="text-center mb-8 animate-fade-in">
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
                Koleksi artikel medis berdasarkan penelitian dan jurnal ilmiah terpercaya
            </p>
        </header>

        <!-- Search Bar -->
        <div class="mb-8 animate-slide-up">
            <div class="max-w-md mx-auto relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="Cari artikel berdasarkan judul..." 
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 shadow-lg"
                    oninput="handleSearch()"
                >
            </div>
        </div>

        <!-- Category Filter -->
        <nav class="mb-8 animate-slide-up">
            <div class="flex flex-wrap gap-3 justify-center" id="category-filter">
                <!-- Category buttons will be generated dynamically -->
            </div>
        </nav>

        <!-- Articles Count -->
        <div class="text-center mb-6">
            <p class="text-gray-600 dark:text-gray-400" id="articles-count">
                <!-- Count will be updated dynamically -->
            </p>
        </div>

        <!-- Articles Grid -->
        <main class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="articles-container">
            <!-- Articles will be loaded dynamically -->
        </main>

        <!-- No Results Message -->
        <div id="no-results" class="hidden text-center py-12">
            <div class="text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <p class="text-lg font-medium">Tidak ada artikel ditemukan</p>
                <p class="text-sm">Coba kata kunci lain atau pilih kategori berbeda</p>
            </div>
        </div>
    </div>

    <!-- Article Modal -->
    <div id="articleModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden opacity-0 transition-all duration-300">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden transform scale-95 transition-all duration-300" id="modalContent">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600">
                    <div class="flex items-center">
                        <div id="modalIcon" class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 shadow-lg">
                            <!-- Icon will be set dynamically -->
                        </div>
                        <div>
                            <h2 id="modalTitle" class="text-xl font-bold text-gray-800 dark:text-white"></h2>
                            <div id="modalMeta" class="text-sm text-gray-500 dark:text-gray-400 mt-1"></div>
                        </div>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                    <div id="modalExcerpt" class="text-lg text-gray-600 dark:text-gray-300 mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border-l-4 border-blue-500"></div>
                    <div id="modalBody" class="article-content text-gray-700 dark:text-gray-300 space-y-6"></div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out;
    }
    
    .article-content {
        line-height: 1.8;
    }
    
    .article-content h3 {
        font-weight: 600;
        font-size: 1.25rem;
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .dark .article-content h3 {
        color: #f9fafb;
    }
    
    .article-content h4 {
        font-weight: 600;
        font-size: 1.125rem;
        color: #374151;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .dark .article-content h4 {
        color: #e5e7eb;
    }
    
    .article-content p {
        margin-bottom: 1rem;
        line-height: 1.75;
    }
    
    .article-card {
        transition: all 0.3s ease;
        border: 1px solid transparent;
        cursor: pointer;
        height: fit-content;
    }
    
    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border-color: rgba(59, 130, 246, 0.2);
    }
    
    .category-button {
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    
    .category-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .category-button.active {
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
    
    /* Modal Animations */
    #articleModal.show {
        opacity: 1;
    }
    
    #articleModal.show #modalContent {
        transform: scale(1);
    }
    
    /* Custom Scrollbar for Modal */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .dark .overflow-y-auto::-webkit-scrollbar-track {
        background: #374151;
    }
    
    .dark .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #6b7280;
    }
    
    .dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    
    /* Search Input Focus */
    #searchInput:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Font consistency */
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
    
    .text-lg {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }
    
    .text-xl {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 500;
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
        #modalContent {
            margin: 1rem;
            max-height: calc(100vh - 2rem);
        }
        
        .grid {
            grid-template-columns: 1fr;
        }
        
        h1 {
            font-size: 1.875rem;
        }
        
        h2 {
            font-size: 1.5rem;
        }
        
        .category-button {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
    }
</style>

<script>
    let articlesData = [];
    let filteredArticles = [];
    let currentCategory = 'Semua';
    let searchQuery = '';

    // Color mapping for different categories
    const colorMap = {
        'blue': { from: 'from-blue-400', to: 'to-blue-600', bg: 'bg-blue-100', hover: 'hover:bg-blue-200', text: 'text-blue-800', gradient: 'bg-gradient-to-br from-blue-400 to-blue-600' },
        'green': { from: 'from-green-400', to: 'to-green-600', bg: 'bg-green-100', hover: 'hover:bg-green-200', text: 'text-green-800', gradient: 'bg-gradient-to-br from-green-400 to-green-600' },
        'purple': { from: 'from-purple-400', to: 'to-purple-600', bg: 'bg-purple-100', hover: 'hover:bg-purple-200', text: 'text-purple-800', gradient: 'bg-gradient-to-br from-purple-400 to-purple-600' },
        'orange': { from: 'from-orange-400', to: 'to-orange-600', bg: 'bg-orange-100', hover: 'hover:bg-orange-200', text: 'text-orange-800', gradient: 'bg-gradient-to-br from-orange-400 to-orange-600' },
        'red': { from: 'from-red-400', to: 'to-red-600', bg: 'bg-red-100', hover: 'hover:bg-red-200', text: 'text-red-800', gradient: 'bg-gradient-to-br from-red-400 to-red-600' },
        'indigo': { from: 'from-indigo-400', to: 'to-indigo-600', bg: 'bg-indigo-100', hover: 'hover:bg-indigo-200', text: 'text-indigo-800', gradient: 'bg-gradient-to-br from-indigo-400 to-indigo-600' },
        'pink': { from: 'from-pink-400', to: 'to-pink-600', bg: 'bg-pink-100', hover: 'hover:bg-pink-200', text: 'text-pink-800', gradient: 'bg-gradient-to-br from-pink-400 to-pink-600' },
        'yellow': { from: 'from-yellow-400', to: 'to-yellow-600', bg: 'bg-yellow-100', hover: 'hover:bg-yellow-200', text: 'text-yellow-800', gradient: 'bg-gradient-to-br from-yellow-400 to-yellow-600' }
    };

    // Load articles from API
    async function loadArticles() {
        try {
            const response = await fetch('/api/articles-data');
            articlesData = await response.json();
            
            if (articlesData.length > 0) {
                renderCategoryFilter();
                filterArticles();
            } else {
                showNoArticlesMessage();
            }
        } catch (error) {
            console.error('Error loading articles:', error);
            showErrorMessage();
        }
    }

    function renderCategoryFilter() {
        const categoryFilter = document.getElementById('category-filter');
        
        // Get unique categories
        const categories = ['Semua', ...new Set(articlesData.map(article => article.category))];
        
        categoryFilter.innerHTML = categories.map(category => {
            const isActive = category === currentCategory;
            return `
                <button onclick="filterByCategory('${category}')" 
                        class="category-button px-4 py-2 rounded-lg transition duration-300 text-sm font-medium ${
                            isActive 
                                ? 'bg-blue-600 text-white shadow-lg' 
                                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600'
                        }">
                    ${category}
                </button>
            `;
        }).join('');
    }

    function filterByCategory(category) {
        currentCategory = category;
        renderCategoryFilter();
        filterArticles();
    }

    function handleSearch() {
        searchQuery = document.getElementById('searchInput').value.toLowerCase();
        filterArticles();
    }

    function filterArticles() {
        // Filter by category
        let filtered = currentCategory === 'Semua' 
            ? articlesData 
            : articlesData.filter(article => article.category === currentCategory);
        
        // Filter by search query
        if (searchQuery) {
            filtered = filtered.filter(article => 
                article.title.toLowerCase().includes(searchQuery) ||
                article.author.toLowerCase().includes(searchQuery)
            );
        }
        
        filteredArticles = filtered;
        renderArticles();
        updateArticlesCount();
    }

    function renderArticles() {
        const container = document.getElementById('articles-container');
        const noResults = document.getElementById('no-results');
        
        if (filteredArticles.length === 0) {
            container.innerHTML = '';
            noResults.classList.remove('hidden');
            return;
        }
        
        noResults.classList.add('hidden');
        
        container.innerHTML = filteredArticles.map(article => {
            const colors = colorMap[article.icon_color] || colorMap['blue'];
            
            return `
                <div class="article-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden animate-slide-up" onclick="openModal(${article.id})">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 ${colors.gradient} rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="inline-block px-2 py-1 text-xs font-medium ${colors.bg} ${colors.text} rounded-full mb-2">
                                    ${article.category}
                                </span>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white leading-tight mb-3 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            ${article.title}
                        </h3>
                        
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>${article.author}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-blue-600 dark:text-blue-400 text-sm font-medium">
                                <span>Baca artikel</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-400">${article.read_time} min</span>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
        
        // Re-initialize observer for new articles
        initializeObserver();
    }

    function updateArticlesCount() {
        const countElement = document.getElementById('articles-count');
        const total = articlesData.length;
        const showing = filteredArticles.length;
        
        if (currentCategory === 'Semua' && !searchQuery) {
            countElement.textContent = `Menampilkan ${total} artikel`;
        } else if (searchQuery) {
            countElement.textContent = `Ditemukan ${showing} artikel untuk "${searchQuery}"`;
        } else {
            countElement.textContent = `Menampilkan ${showing} artikel dalam kategori ${currentCategory}`;
        }
    }

    function openModal(articleId) {
        const article = articlesData.find(a => a.id === articleId);
        if (!article) return;

        const colors = colorMap[article.icon_color] || colorMap['blue'];
        const formattedDate = new Date(article.created_at).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        // Set modal content
        document.getElementById('modalIcon').className = `w-12 h-12 ${colors.gradient} rounded-lg flex items-center justify-center shadow-lg`;
        document.getElementById('modalIcon').innerHTML = `
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        `;
        
        document.getElementById('modalTitle').textContent = article.title;
        document.getElementById('modalMeta').innerHTML = `
            <span class="inline-block px-2 py-1 text-xs font-medium ${colors.bg} ${colors.text} rounded-full mr-2">${article.category}</span>
            ${article.author} • ${formattedDate} • ${article.read_time} min read
        `;
        document.getElementById('modalExcerpt').textContent = article.excerpt;
        document.getElementById('modalBody').innerHTML = article.content;

        // Show modal
        const modal = document.getElementById('articleModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('articleModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);

        // Restore body scroll
        document.body.style.overflow = 'auto';
    }

    function showNoArticlesMessage() {
        const container = document.getElementById('articles-container');
        container.innerHTML = `
            <div class="col-span-3 text-center py-12">
                <div class="text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-lg font-medium">Belum ada artikel tersedia</p>
                    <p class="text-sm">Artikel medis akan segera ditambahkan</p>
                </div>
            </div>
        `;
    }

    function showErrorMessage() {
        const container = document.getElementById('articles-container');
        container.innerHTML = `
            <div class="col-span-3 text-center py-12">
                <div class="text-red-400">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-lg font-medium">Gagal memuat artikel</p>
                    <p class="text-sm">Silakan refresh halaman atau coba lagi nanti</p>
                </div>
            </div>
        `;
    }

    function initializeObserver() {
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

        document.querySelectorAll('.article-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    }

    // Dark mode toggle functionality
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
    }

    // Load dark mode preference
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('articleModal');
        const modalContent = document.getElementById('modalContent');
        
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        loadArticles();
    });
</script>
