@extends('layout.general_layout')

<title>@yield('title','Main Office Directory')</title>

@section('content')
<div class="wrapper">
    <div class="content">
        <div class="container mt-4">
            @include('components.alert')
            
            <!-- Dashboard Header -->
            <div class="dashboard-header mb-4">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="header-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="header-title">
                                <h6 class="subtitle">Directory</h6>
                                <h2 class="title">Main Offices</h2>
                            </div>
                        </div>
                        <p class="text-muted mt-2">Managing offices for Schools Division Office San Carlos City</p>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                             
                            <a href="mainOffice/create" class="btn btn-custom1 d-flex align-items-center">
                                <i class="fas fa-plus me-2" style="font-size:20px"></i>
                                <span>Add New Office</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-card-body">
                            <div class="stats-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stats-info">
                                <h3>{{ count($main) }}</h3>
                                <p>Total Offices</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-card-body">
                            <div class="stats-icon blue">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stats-info">
                                <h3>{{ count($main) > 0 ? count($main) : 0 }}</h3>
                                <p>Office Administrators</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-card-body">
                            <div class="stats-icon green">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <div class="stats-info">
                                <h3>{{ $main->sum('subOfficeCount') }}</h3>
                                <p>Total Sections</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Search Bar -->
            <!-- <div class="card search-card mb-4">
                <div class="card-body">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="officeSearch" class="form-control form-control-lg border-0" placeholder="Search offices...">
                    </div>
                </div>
            </div> -->
            
            <!-- Main Content -->
            <div class="card main-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Office Directory</h5>
                     
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="officeTable">
        <thead class="table-dark">
            <tr>
                <th scope="col">Main Office ID</th>
                <th scope="col">Office Name</th> 
                <!-- <th scope="col">Office Admin</th> -->
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($main as $mainOffice)
                <tr>
                    <td >{{ $mainOffice->office_id }}</td>
                    <td >{{ $mainOffice->office_name }}</td>
                    <!-- <td>{{ $mainOffice->office_admin }}</td> -->

                    <td class="text-center">
                        <a href="{{ route('mainOffice.edit', $mainOffice->id) }}" class="btn btn-primary btn-custom mb-1 mt-1">
                            Edit
                        </a>
                        <form action="{{ route('mainOffice.destroy', $mainOffice->id) }}" method="POST" class="d-inline ">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-custom mb-1 mt-1" onclick="return confirm('Are you sure?');">
                                 Delete
                            </button>
                        </form>
                        <a href="{{ route('subOffices.show', $mainOffice->office_id) }}" class="btn btn-success btn-custom position-relative mb-1 mt-1">
     Sections
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ $mainOffice->subOfficeCount }}
    </span>
</a>



                    </td>
                </tr>
                @endforeach
                @if($main->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No offices found</td>
    </tr>
@endif

            
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
body {
    background-color: #f5f7fa;
    color: #343a40;
font-family: sans-serif;     
}

.content {
    min-height: 100vh;
}

/* Dashboard Header */
.dashboard-header {
    position: relative;
    padding-bottom: 12px;
}

.header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background-color: #043b7d;
    color: white;
    font-size: 20px;
    margin-right: 16px;
}

.header-title .subtitle {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.header-title .title {
    font-size: 28px;
    font-weight: 600;
    margin: 0;
    color: #212529;
}

/* Stats Cards */
.stats-card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
    height: 100%;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.stats-card-body {
    display: flex;
    align-items: center;
    padding: 20px;
}

.stats-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 10px;
    background-color: #043b7d;
    color:rgb(255, 255, 255);
    font-size: 24px;
    margin-right: 20px;
}

.stats-icon.blue {
    background-color: rgb(7, 149, 231);
    color:rgb(255, 255, 255);
}

.stats-icon.green {
    background-color: rgb(7, 145, 80);
    color:rgb(255, 255, 255);
}

.stats-info h3 {
    font-size: 28px;
    font-weight: 600;
    margin: 0;
    line-height: 1.2;
}

.stats-info p {
    color: #6c757d;
    margin: 0;
    font-size: 14px;
}

/* Search Card */
.search-card {
    border-radius: 10px;
    background-color: #ffffff;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.search-card .input-group {
    background-color: #f8f9fa;
    border-radius: 8px;
}

#officeSearch {
    padding: 12px;
    background-color: transparent;
}

#officeSearch:focus {
    box-shadow: none;
}

/* Main Card */
.main-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.main-card .card-header {
    background-color: #ffffff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding: 15px 20px;
}
 
.office-id {
    font-family: 'Roboto Mono', monospace;
    font-size: 13px;
    color: #6c757d;
    background-color: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
}

.office-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background-color: rgba(4, 59, 125, 0.1);
    color: #043b7d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: #f8f9fa;
    color: #6c757d;
    font-size: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.empty-state h4 {
    margin-bottom: 10px;
    font-weight: 500;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 20px;
}

/* Buttons */
.btn-custom1 {
    background-color: #043b7d;
    border-color: #043b7d;
    color:white;
}

.btn-custom1:hover, .btn-custom1:focus {
    background-color: #032c5e;
    border-color: #032c5e;
    color:white;

}

.btn-outline-primary {
    color: #043b7d;
    border-color: #043b7d;
}

.btn-outline-primary:hover {
    background-color: #043b7d;
    border-color: #043b7d;
}

/* Badges */
 

/* Responsive adjustments */
@media (max-width: 768px) {
    .stats-card-body {
        flex-direction: column;
        text-align: center;
    }
    
    .stats-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .header-icon {
        margin-bottom: 10px;
    }
    
    .dashboard-header .row {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('officeSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#officeTable tbody tr:not(.no-data)');
            
            rows.forEach(row => {
                const officeName = row.querySelector('h6').textContent.toLowerCase();
                const officeId = row.querySelector('.office-id').textContent.toLowerCase();
                
                if (officeName.includes(searchTerm) || officeId.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});  function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';

// Convert hours from 24-hour to 12-hour format and pad with 0
hours = hours % 12 || 12;
hours = hours.toString().padStart(2, '0');

document.getElementById('realtimeClock').textContent = `${hours}:${minutes}:${seconds} ${ampm}`;  }
        
        // Initialize clock
        updateClock();
        setInterval(updateClock, 1000);
        
</script>
@endsection