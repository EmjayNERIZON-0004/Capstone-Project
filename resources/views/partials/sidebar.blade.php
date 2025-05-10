<div class="sidebar">
    <h4 class="text-center"><i class="fas fa-tachometer-alt"></i> Admin Panel</h4>
    <a href="{{ route('Main') }}" class="{{ request()->routeIs('Main') ? 'active' : '' }}">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="{{ route('mainOffice') }}" class="{{ request()->routeIs('Office') ? 'active' : '' }}">
        <i class="fas fa-building"></i> Office Management
    </a>
    <a  >
            <i class="fas fa-users"></i> User Management
        </a>
    <a  >
        <i class="fas fa-chart-line"></i> Reports
    </a>
    <a  >
        <i class="fas fa-cog"></i> Settings
    </a>
</div>
