@extends('layout.general_layout')

<title>@yield('title','Main Office Directory')</title>

@section('content')
<div class="wrapper">
    <div class="content">
        <div class="container mt-4">
            @include('components.alert')
            
          
   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Office Management Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
            <!-- Dashboard Header -->
            <!-- <div class="dashboard-header mb-4">
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
                             
                            
                        </div>
                    </div>
                </div>
            </div> -->
            
            <!-- Stats Cards -->
            <div class="row mb-0">

        





                <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100" style="border: none;">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
             
            <div class="bg-primary" style="background-color:rgb(36, 36, 36); padding: 10px; border-radius: 50%;">

<img src="{{ asset('office-building.svg') }}" style="width:30px; height:30px;">
</div>
           
          </div>
          <h3 class="fw-bold">{{ count($main) }}</h3>
          <h6 class="text-muted">Main Offices of SDO </h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-primary" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>



     <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100" style="border: none;">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2"> 
            <div class="bg-secondary" style="background-color:rgb(36, 36, 36); padding: 10px; border-radius: 50%;">

<img src="{{ asset('user_admin.svg') }}" style="width:30px; height:30px;">
</div>
           
          </div>
          <h3 class="fw-bold">{{ count($main) > 0 ? count($main) : 0 }}</h3>
          <h6 class="text-muted">Office Admins</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-secondary" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
          
    
    
     <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100" style="border: none;">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
             <div class="bg-success" style="background-color:rgb(36, 36, 36); padding: 10px; border-radius: 50%;">

<img src="{{ asset('office_link.svg') }}" style="width:30px; height:30px;">
</div>
          
          </div>
          <h3 class="fw-bold">{{ $main->sum('subOfficeCount') }}</h3>
          <h6 class="text-muted">Sections</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-success" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
                
            </div>




           <div class="card shadow-sm " style="background: white; border: 1px solid #ddd;height:200px">
    <div class="row" style="height: 200px;">
        <!-- Left Panel -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="border-right: 1px solid #dee2e6;">
            <div class="text-center py-3 w-100">
            
                <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 120px; height: 120px; object-fit: contain;">
             <h2 class="fw-bold text-primary"  >Add New Office</h2>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-md-6">
            <div class="p-3">
                <form action="{{ route('mainOffice.store') }}" method="POST">
                    @csrf

                    <div class="row  align-items-center">
                        <label for="office_id" class="col-sm-4 col-form-label">Main Office ID:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm @error('office_id') is-invalid @enderror"
                                   id="office_id" name="office_id" value="{{ old('office_id') }}" required>
                            @error('office_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row   align-items-center">
                        <label for="office_name" class="col-sm-4 col-form-label">Office Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm @error('office_name') is-invalid @enderror"
                                   id="office_name" name="office_name" value="{{ old('office_name') }}" required>
                            @error('office_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row   align-items-center">
                        <label for="office_admin" class="col-sm-4 col-form-label">Office Admin:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm @error('office_admin') is-invalid @enderror"
                                   id="office_admin" name="office_admin" value="{{ old('office_admin') }}" required>
                            @error('office_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
 

                     <div class="row  mt-3 align-items-center">
                          <div class="col-sm-4">

                          </div>
                        <div class="col-sm-8">
                             <button type="submit" class="btn btn-sm btn-primary me-2 w-100">Add Office</button>
                       
                        </div>
                    </div>

                     
                </form>
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
          
             @php
    $count = $main->count();
    $colClass = match(true) {
        $count === 1 => 'col-12',
        $count === 2 => 'col-md-6',
        $count === 3 => 'col-md-4',
        default => 'col-md-4',
    };
@endphp
 <div class="d-flex justify-content-between align-items-center mt-3">
        <h2 class="fw-bold">Offices of Schools Division Office SCC</h2>
       
    </div>
<div class="row  ">
    @forelse($main as $mainOffice)
        <div class="{{ $colClass }} mb-4">
                 
                {{-- Top Section --}}
              <div class="card h-100 shadow-sm text-center p-3">
    {{-- Profile Image --}}
    
    
    {{-- Office Details --}}
    <div class="fw-bold text-primary" style="font-size: 20px;">
        {{ $mainOffice->office_id }}
    </div>
    <div class="text-muted" style="font-size: 14px;">
        {{ $mainOffice->office_name }}
    </div>
    <div class="mb-2" style="float: right;">
     <img
         src="{{ $mainOffice->image_path ? asset('images/' . $mainOffice->image_path) : asset('logo.png') }}"
         alt="Profile Image"
         class="rounded-circle"
         style="width: 80px; height: 80px; object-fit: cover; 
                border: 3px solid rgb(255, 255, 255); 
                padding: 1px;
                box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);"
     >
 </div>
    <div class="text-dark mt-1" style="font-size: 14px;">
        Admin: <span class="fw-semibold">{{ $mainOffice->office_admin }}</span>
    </div>
 

                {{-- Divider --}}
                <hr class="my-3">

                {{-- Button Section --}}
              {{-- Button Section --}}
<div class="d-flex justify-content-center gap-2 flex-wrap">
    <a href="{{ route('mainOffice.edit', $mainOffice->id) }}" 
       class="btn btn-sm btn-primary d-flex align-items-center justify-content-center text-nowrap"
       style="min-width: 90px; height: 38px; font-size: 14px;">
        Edit
    </a>

    <form action="{{ route('mainOffice.destroy', $mainOffice->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-sm btn-danger d-flex align-items-center justify-content-center text-nowrap"
                style="min-width: 90px; height: 38px; font-size: 14px;">
            Delete
        </button>
    </form>

    <div class="position-relative">
        <a href="{{ route('subOffices.show', $mainOffice->office_id) }}" 
           class="btn btn-sm btn-success d-flex align-items-center justify-content-center text-nowrap"
           style="min-width: 90px; height: 38px; font-size: 14px;">
            Sections
        </a>


        @if($mainOffice->subOfficeCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $mainOffice->subOfficeCount }}
            </span>
        @endif
    </div>
</div>

            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted py-5">
            No offices found.
        </div>
    @endforelse
</div>



            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
body {
 
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