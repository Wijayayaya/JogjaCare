<div class="w-64 bg-white shadow-lg sidebar-transition">
    <div class="p-6">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-heartbeat text-white text-xl"></i>
            </div>
            <div class="ml-3">
                <h1 class="text-xl font-bold text-gray-800">Medical</h1>
                <p class="text-sm text-gray-500">Dashboard</p>
            </div>
        </div>
    </div>

    <nav class="mt-6">
        <div class="px-6">
            <!-- Dashboard -->
            <a href="{{ route('dashboardadmin.index') }}" 
               class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.index') ? 'bg-blue-50 text-blue-600' : '' }}">
                <i class="fas fa-tachometer-alt w-5 h-5"></i>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>

            <!-- Services Section -->
            <div class="mt-6">
                <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Services</h3>
                
                <!-- Medical Care -->
                <div class="mt-3">
                    <button onclick="toggleDropdown('medical-care-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.services.medicalcare.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-heartbeat w-5 h-5"></i>
                            <span class="ml-3 font-medium">Medical Care</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="medical-care-icon"></i>
                    </button>
                    <div id="medical-care-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.services.medicalcare.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.services.medicalcare.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalcare.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalcare.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalcare.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Medical Alter -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('medical-alter-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.services.medicalalter.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-pills w-5 h-5"></i>
                            <span class="ml-3 font-medium">Medical Alter</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="medical-alter-icon"></i>
                    </button>
                    <div id="medical-alter-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.services.medicalalter.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.services.medicalalter.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalalter.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalalter.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalalter.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Medical Point -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('medical-point-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.services.medicalpoint.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt w-5 h-5"></i>
                            <span class="ml-3 font-medium">Medical Point</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="medical-point-icon"></i>
                    </button>
                    <div id="medical-point-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.services.medicalpoint.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.services.medicalpoint.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalpoint.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalpoint.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalpoint.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Medical Center -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('medical-center-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.services.medicalcenter.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-hospital w-5 h-5"></i>
                            <span class="ml-3 font-medium">Medical Center</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="medical-center-icon"></i>
                    </button>
                    <div id="medical-center-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.services.medicalcenter.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalcenter.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalcenter.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalcenter.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Medical Cost -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('medical-cost-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.services.medicalcost.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-dollar-sign w-5 h-5"></i>
                            <span class="ml-3 font-medium">Medical Cost</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="medical-cost-icon"></i>
                    </button>
                    <div id="medical-cost-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.services.medicalcost.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalcost.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalcost.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.services.medicalcost.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Medical Education - Parent with Sub-items -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('medical-education-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.services.medicaleducation') || request()->routeIs('dashboardadmin.quiz.*') || request()->routeIs('dashboardadmin.articles.*') || request()->routeIs('dashboardadmin.health-information.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap w-5 h-5"></i>
                            <span class="ml-2 font-medium">Medical Education</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="medical-education-icon"></i>
                    </button>
                    <div id="medical-education-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.services.medicaleducation') || request()->routeIs('dashboardadmin.quiz.*') || request()->routeIs('dashboardadmin.articles.*') || request()->routeIs('dashboardadmin.health-information.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">

                            <!-- Quiz Management -->
                            <button onclick="toggleDropdown('quiz-sub-dropdown')" 
                                    class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.quiz.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-question-circle w-4 h-4"></i>
                                    <span class="ml-2 font-medium">Quiz Management</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="quiz-sub-icon"></i>
                            </button>
                            <div id="quiz-sub-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.quiz.*') ? 'active' : '' }}">
                                <div class="ml-6 mt-1 space-y-1">
                                    <a href="{{ route('dashboardadmin.quiz.index') }}" 
                                       class="block px-3 py-1.5 text-xs text-gray-500 rounded hover:bg-gray-50 hover:text-gray-700 {{ request()->routeIs('dashboardadmin.quiz.index') ? 'bg-gray-50 text-gray-700' : '' }}">
                                        <i class="fas fa-list w-3 h-3 mr-2"></i>View All Quiz
                                    </a>
                                    <a href="{{ route('dashboardadmin.quiz.create') }}" 
                                       class="block px-3 py-1.5 text-xs text-gray-500 rounded hover:bg-gray-50 hover:text-gray-700 {{ request()->routeIs('dashboardadmin.quiz.create') ? 'bg-gray-50 text-gray-700' : '' }}">
                                        <i class="fas fa-plus w-3 h-3 mr-2"></i>Add New Quiz
                                    </a>
                                </div>
                            </div>

                            <!-- Article Management -->
                            <button onclick="toggleDropdown('articles-sub-dropdown')" 
                                    class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.articles.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-newspaper w-4 h-4"></i>
                                    <span class="ml-2 font-medium">Article Management</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="articles-sub-icon"></i>
                            </button>
                            <div id="articles-sub-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.articles.*') ? 'active' : '' }}">
                                <div class="ml-6 mt-1 space-y-1">
                                    <a href="{{ route('dashboardadmin.articles.index') }}" 
                                       class="block px-3 py-1.5 text-xs text-gray-500 rounded hover:bg-gray-50 hover:text-gray-700 {{ request()->routeIs('dashboardadmin.articles.index') ? 'bg-gray-50 text-gray-700' : '' }}">
                                        <i class="fas fa-list w-3 h-3 mr-2"></i>View All Articles
                                    </a>
                                    <a href="{{ route('dashboardadmin.articles.create') }}" 
                                       class="block px-3 py-1.5 text-xs text-gray-500 rounded hover:bg-gray-50 hover:text-gray-700 {{ request()->routeIs('dashboardadmin.articles.create') ? 'bg-gray-50 text-gray-700' : '' }}">
                                        <i class="fas fa-plus w-3 h-3 mr-2"></i>Add New Article
                                    </a>
                                </div>
                            </div>

                            <!-- Health Information Management -->
                            <button onclick="toggleDropdown('health-info-sub-dropdown')" 
                                    class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.health-information.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-heartbeat w-4 h-4"></i>
                                    <span class="ml-2 font-medium">Health Information</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="health-info-sub-icon"></i>
                            </button>
                            <div id="health-info-sub-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.health-information.*') ? 'active' : '' }}">
                                <div class="ml-6 mt-1 space-y-1">
                                    <a href="{{ route('dashboardadmin.health-information.index') }}" 
                                       class="block px-3 py-1.5 text-xs text-gray-500 rounded hover:bg-gray-50 hover:text-gray-700 {{ request()->routeIs('dashboardadmin.health-information.index') ? 'bg-gray-50 text-gray-700' : '' }}">
                                        <i class="fas fa-list w-3 h-3 mr-2"></i>View All Health Info
                                    </a>
                                    <a href="{{ route('dashboardadmin.health-information.create') }}" 
                                       class="block px-3 py-1.5 text-xs text-gray-500 rounded hover:bg-gray-50 hover:text-gray-700 {{ request()->routeIs('dashboardadmin.health-information.create') ? 'bg-gray-50 text-gray-700' : '' }}">
                                        <i class="fas fa-plus w-3 h-3 mr-2"></i>Add New Health Info
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="mt-8">
                <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</h3>
                
                

                <!-- Destination -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('destination-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.management.destination.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-map-location-dot w-5 h-5"></i>
                            <span class="ml-3 font-medium">Destination</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="destination-icon"></i>
                    </button>
                    <div id="destination-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.management.destination.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.management.destination.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.management.destination.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.management.destination.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.management.destination.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Destination -->
                <div class="mt-2">
                    <button onclick="toggleDropdown('ambulance-dropdown')" 
                            class="w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.management.destination.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-map-location-dot w-5 h-5"></i>
                            <span class="ml-3 font-medium">Ambulance</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200" id="destination-icon"></i>
                    </button>
                    <div id="ambulance-dropdown" class="dropdown-menu {{ request()->routeIs('dashboardadmin.ambulance.*') ? 'active' : '' }}">
                        <div class="ml-8 mt-2 space-y-1">
                            <a href="{{ route('dashboardadmin.ambulance.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.ambulance.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-list w-4 h-4 mr-2"></i>View All
                            </a>
                            <a href="{{ route('dashboardadmin.ambulance.create') }}" 
                               class="block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('dashboardadmin.ambulance.create') ? 'bg-gray-100 text-gray-900' : '' }}">
                                <i class="fas fa-plus w-4 h-4 mr-2"></i>Add New
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Customer Service Chat -->
                <a href="{{ route('dashboardadmin.chat.index') }}" 
                   class="flex items-center px-4 py-3 mt-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request()->routeIs('dashboardadmin.chat.*') ? 'bg-blue-50 text-blue-600 shadow-md' : '' }}">
                    <div class="relative">
                        <i class="fas fa-comments w-5 h-5"></i>
                        @php
                            try {
                                $unreadCount = \App\Models\ChatMessage::where('sender_type', 'user')
                                    ->where('is_read', false)
                                    ->count();
                            } catch (\Exception $e) {
                                $unreadCount = 0;
                            }
                        @endphp
                        @if($unreadCount > 0)
                            <span class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold animate-pulse shadow-lg">
                                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                            </span>
                        @endif
                    </div>
                    <span class="ml-3 font-medium">Customer Chat</span>
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-sm">
                            New
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>
</div>

<style>
.dropdown-menu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

.dropdown-menu.active {
    max-height: 500px;
}

.sidebar-transition {
    transition: all 0.3s ease;
}
</style>

<script>
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    const icon = document.getElementById(dropdownId.replace('-dropdown', '-icon'));
    
    dropdown.classList.toggle('active');
    
    if (dropdown.classList.contains('active')) {
        icon.style.transform = 'rotate(180deg)';
    } else {
        icon.style.transform = 'rotate(0deg)';
    }
}

// Auto-open dropdown if current route is active
document.addEventListener('DOMContentLoaded', function() {
    const activeDropdowns = document.querySelectorAll('.dropdown-menu.active');
    activeDropdowns.forEach(dropdown => {
        const iconId = dropdown.id.replace('-dropdown', '-icon');
        const icon = document.getElementById(iconId);
        if (icon) {
            icon.style.transform = 'rotate(180deg)';
        }
    });
});
</script>
