<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="d-flex flex-column">
        <!-- Sidebar Header -->
        <div class="sidebar-header tooltip-custom" data-toggle="tooltip" data-placement="right" title="Home">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-nut-fill"></i>
                </div>
                <span class="sidebar-text sidebar-brand-text">Admin Ocrecruiters</span>
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav">
            <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div>

            {{-- <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Profile">
                <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i>
                    <span class="sidebar-text">Recruiters</span>
                </a>
            </div> --}}

            {{-- <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Locations">
                <a href="{{ route('admin.locations.index') }}" class="sidebar-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                    <i class="bi bi-building-fill"></i>
                    <span class="sidebar-text">Location</span>
                </a>
            </div> --}}

            <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Category">
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-building-fill"></i>
                    <span class="sidebar-text">Category</span>
                </a>
            </div>
            <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Recruiters">
                <a href="{{ route('admin.recruiters.index') }}" class="sidebar-link {{ request()->routeIs('admin.recruiters.*') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i>
                    <span class="sidebar-text">Recruiters</span>
                </a>
            </div>

        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer mt-auto">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn tooltip-custom" data-toggle="tooltip" data-placement="right" title="Logout">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>
