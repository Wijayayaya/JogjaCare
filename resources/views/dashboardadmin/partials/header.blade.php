<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            <p class="text-sm text-gray-600">@yield('page-description', 'Welcome to Medical Services Dashboard')</p>
        </div>

        <!-- Header Actions -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative hidden md:block">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" 
                       placeholder="Search..." 
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button class="p-2 text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('dashboardadmin.services.medicalcare.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add Service
                </a>
            </div>

            <!-- User Menu -->
            <div class="relative">
                <button onclick="toggleUserMenu()" 
                        class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-600 text-sm"></i>
                    </div>
                    <span class="ml-2 text-gray-700 font-medium hidden md:block">Admin</span>
                    <i class="fas fa-chevron-down ml-1 text-gray-400 text-xs hidden md:block"></i>
                </button>

                <!-- User Dropdown Menu -->
                <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 hidden">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user-circle mr-2"></i>Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i>Settings
                    </a>
                    <div class="border-t border-gray-100"></div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2"></i>Sign out
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    @if(isset($breadcrumbs) || View::hasSection('breadcrumb'))
    <div class="px-6 py-2 bg-gray-50 border-t border-gray-200">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('dashboardadmin.index') }}" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-home"></i>
                        <span class="sr-only">Home</span>
                    </a>
                </li>
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
    @endif
</header>

<script>
function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('hidden');
}

// Close user menu when clicking outside
document.addEventListener('click', function(event) {
    const userMenu = document.getElementById('userMenu');
    const userButton = event.target.closest('button');
    
    if (!userButton || !userButton.onclick || userButton.onclick.toString().indexOf('toggleUserMenu') === -1) {
        userMenu.classList.add('hidden');
    }
});
</script>