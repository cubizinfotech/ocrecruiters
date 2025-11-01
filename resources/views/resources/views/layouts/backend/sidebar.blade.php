<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="d-flex flex-column">
        <!-- Sidebar Header -->
        <div class="sidebar-header tooltip-custom" data-toggle="tooltip" data-placement="right" title="Home">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-nut-fill"></i>
                </div>
                <span class="sidebar-text sidebar-brand-text">Recruiter Ocrecruiters</span>
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav">
            <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div>

            <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Profile">
                <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i>
                    <span class="sidebar-text">Account Details</span>
                </a>
            </div>

            <div class="tooltip-custom" data-toggle="tooltip" data-placement="right" title="Recruiters">
                <a href="{{ route('resume.edit') }}" class="sidebar-link {{ request()->routeIs('resume.*') ? 'active' : '' }}">
                    <i class="bi bi-building-fill"></i>
                    <span class="sidebar-text">Recruiters Area</span>
                </a>
            </div>

        </nav>

        <div class="m-4 d-flex justify-content-center">
            <a href="{{ route('recruiters.show', auth()->id()) }}" target="_blank">
                View Recruiter
            </a>

        </div>
        <!-- Sidebar Footer -->
        <div class="sidebar-footer mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn tooltip-custom" data-toggle="tooltip" data-placement="right" title="Logout">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>
