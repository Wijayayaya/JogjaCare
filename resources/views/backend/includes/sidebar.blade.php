<?php
$notifications = optional(auth()->user())->unreadNotifications;
$notifications_count = optional($notifications)->count();
$notifications_latest = optional($notifications)->take(5);
?>

<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-sm-flex justify-content-center">
            <a href="/">
                <img class="sidebar-brand-full" src="{{ asset('img/JOGJACARE-blue.png') }}" alt="{{ app_name() }}"
                    height="46">
                <img class="sidebar-brand-narrow" src="{{ asset('img/logo-square.jpg') }}" alt="{{ app_name() }}"
                    height="46">
            </a>
        </div>
        <button class="btn-close d-lg-none" data-coreui-dismiss="offcanvas" data-coreui-theme="dark" type="button"
            aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.dashboard') }}">
                <i class="nav-icon fa-solid fa-cubes"></i>&nbsp;@lang('Dashboard')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.notifications.index') }}">
                <i class="nav-icon fa-regular fa-bell"></i>&nbsp;@lang('Notifications')
                @if ($notifications_count)
                    &nbsp;<span class="badge badge-sm bg-info ms-auto">{{ $notifications_count }}</span>
                @endif
            </a>
        </li>

        @can('view_services')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-concierge-bell"></i>&nbsp;@lang('Services')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.medicalcares.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> @lang('MedicalCare')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.medicalpoints.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> @lang('MedicalPoint')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.medicalcenters.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> @lang('MedicalCenter')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.medicalalters.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> @lang('MedicalAlter')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.medicalcosts.index') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> @lang('MedicalCost')
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @php
            $module_name = "destinations";
            $text = __('Destinations');
            $icon = "fa-solid fa-map-location-dot";
            $permission = "view_backend"; // Adjust permission as needed
            $url = route('backend.'.$module_name.'.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = "settings";
            $text = __('Settings');
            $icon = "fa-solid fa-gears";
            $permission = "edit_".$module_name;
            $url = route('backend.'.$module_name);
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        
        @php
            $module_name = "backups";
            $text = __('Backups');
            $icon = "fa-solid fa-box-archive";
            $permission = "view_".$module_name;
            $url = route('backend.'.$module_name.'.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        
        @php
            $module_name = "users";
            $text = __('Users');
            $icon = "fa-solid fa-user-group";
            $permission = "view_".$module_name;
            $url = route('backend.'.$module_name.'.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />
        
        @php
            $module_name = "roles";
            $text = __('Roles');
            $icon = "fa-solid fa-user-shield";
            $permission = "view_".$module_name;
            $url = route('backend.'.$module_name.'.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = "customer-service";
            $text = __('Customer Service');
            $icon = "fa-solid fa-comments";
            $permission = "view_backend";
            $url = route('backend.'.$module_name.'.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @can('view_logs')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-list-ul"></i>&nbsp;@lang('Logs')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::dashboard') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Log Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::logs.list') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Daily Log
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        

    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" data-coreui-toggle="unfoldable" type="button"></button>
    </div>
</div>
