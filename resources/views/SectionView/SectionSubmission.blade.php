<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $section->sub_office_name }} Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
        <!-- Transaction Submission Section -->
        @php 
       
            use Carbon\Carbon;
            $today = Carbon::now()->format('l');  
       
            $now = Carbon::now();
            $currentQuarter = $now->quarter;
            $currentYear = $now->year;
            $startOfQuarter = $now->copy()->firstOfQuarter();
            $endOfQuarter = $now->copy()->lastOfQuarter();
            $startWindow = $endOfQuarter->copy()->subDays(60);
            $endWindow = $endOfQuarter->copy()->addDays(6);
            $isSubmissionWindowOpen = $now->between($startWindow, $endWindow);
        @endphp

 <style>
        body {
            background-color: #ebebeb;
            font-family: sans-serif;
            padding-top: 70px;
        }
        
        .top-navbar {  
            position: fixed;
            top: 0;
            background-color: rgb(1, 55, 142);
            color: white;
            width: 100%;
            z-index: 1030;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 0.5rem 1rem;
        }
        
        .office-title {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
            font-weight: 600;
            background-color: white;
        }
        
        .box {
            width: 80px;
            padding: 20px; 
            border-radius: 50%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); 
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .icon-container {
            padding: 1px;
            border-radius: 50%;
            background-color: white;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5); 
            margin: 0px;
        }
        
        .stat-content {
            width: calc(100% - 80px);
            padding-left: 15px;
          }
        
        .user-dropdown .dropdown-toggle {
            background-color: white;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .dropdown-menu {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .dropdown-item {
            padding: 0.75rem 1.5rem;
        }
        
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table th {
            background-color: rgba(0, 0, 0, 0.03);
            font-weight: 600;
        }
        
        .btn-submit {
            background-color: rgb(13, 111, 186);
            color: white;
            border: none;
        }
        
        .transaction-count {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            text-align: center;
            white-space: nowrap;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
        }
        
        .transaction-na {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            text-align: center;
            white-space: nowrap;
            border-radius: 4px;
            background-color: #6c757d;
            color: white;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            margin-right: 1rem;
            font-size: 0.8rem;
            white-space: nowrap;
        }
        
        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            margin-right: 6px;
            display: inline-block;
        }
        
        .section-title {
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .office-title {
                font-size: 1.1rem;
                max-width: 150px;
            }
            
            .box {
                width: 60px;
                height: 60px;
                padding: 12px;
            }
            
            .box img {
                width: 30px !important;
                height: 30px !important;
            }
            
            .card-body h2 {
                font-size: 1.5rem;
            }
            
            .card-body h5 {
                font-size: 0.9rem;
            }
            
            .stat-content {
                width: calc(100% - 60px);
            }
            
            .legend-container {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .legend-item {
                margin-bottom: 5px;
            }
            
            .table-responsive {
                border-radius: 8px;
                overflow: hidden;
            }
        }
        
        @media (max-width: 576px) {
            .top-navbar {
                padding: 0.5rem;
            }
            
            .office-title {
                font-size: 1rem;
                max-width: 120px;
            }
            
            .user-dropdown .dropdown-toggle span {
                display: none;
            }
            
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
<body>
     <nav class="navbar navbar-expand-lg  top-navbar shadow-sm sticky-top">
    <div class="container-fluid"> 
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-white">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <h4 class="mb-0 d-none d-sm-inline">Section Dashboard</h4>
            <h6 class="mb-0 d-inline d-sm-none">Section Dashboard</h6>
        </div>

        <!-- Right Side Icons -->
        <div class="d-flex align-items-center ms-auto">
        

            <!-- User Dropdown -->
            <div class="dropdown text-white ">
               <button class="btn dropdown-toggle text-white  d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <div class="d-flex align-items-center text-white">
     Menu
        <!-- Optional: User name or other text -->
        <!-- <span class="fw-semibold text-white d-none d-sm-inline">{{ $section->office_admin }}</span> -->
    </div>
</button>


                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                    <li class="dropdown-header d-sm-none">{{ $section->office_admin }}</li>
                 
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="Dashboard">
                           <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6.5 6.5A.5.5 0 0 0 1.5 8.5H2v5.5A1.5 1.5 0 0 0 3.5 15h3A.5.5 0 0 0 7 14.5V11a1 1 0 0 1 2 0v3.5a.5.5 0 0 0 .5.5h3A1.5 1.5 0 0 0 14 14V8.5h.5a.5.5 0 0 0 .354-.854l-6.5-6.5z"/>
        </svg>
                            Dashboard
                        </a>
                    </li>
                     <li>
                        <a class="dropdown-item d-flex align-items-center" href="Services">
             <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"   fill="currentColor"  class="me-2 text-primary" viewBox="0 0 24 24">
  <path d="M10 2a2 2 0 0 0-2 2v3H5a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-9a3 3 0 0 0-3-3h-3V4a2 2 0 0 0-2-2h-4zm0 2h4v3h-4V4z"/>
</svg>

 
                            Submission
                        </a>
                    </li>
                       <li>
                        <a class="dropdown-item d-flex align-items-center" href="Profile">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>

                            Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-danger">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>



 <style>
        .welcome-card {
            background: white;
            border-radius: 5px;
            padding: 2rem;
            color: #333;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .welcome-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        .welcome-text {
            position: relative;
            z-index: 2;
        }
        
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }
        
        .welcome-subtitle {
            font-size: 1.2rem;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 1rem;
        }
        
        .admin-name {
            font-size: 1.8rem;
            font-weight: 600;
            color: #007bff;
        }
        
        .profile-image-container {
            position: relative;
            z-index: 2;
            
        }
        
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }
        
        .profile-image:hover {
            transform: scale(1.05);
            border-color: #007bff;
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
        }
        
        .profile-image-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #f9fafb;
            border: 3px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .profile-image-placeholder:hover {
            transform: scale(1.05);
            background: #f3f4f6;
            border-color: #007bff;
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
        }
        
        .current-date {
            font-size: 1rem;
            color: #6b7280;
            font-weight: 400;
            margin-top: 0.5rem;
        }
        
        .decorative-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            z-index: 1;
        }
        
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .decorative-circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20px;
            left: 20px;
            animation: float 8s ease-in-out infinite;
        }
        
        .decorative-circle:nth-child(2) {
            width: 60px;
            height: 60px;
            bottom: 30px;
            left: 50px;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        .decorative-circle:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 50%;
            left: 30px;
            animation: float 10s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .welcome-card {
                padding: 1.5rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .admin-name {
                font-size: 1.5rem;
            }
            
            .profile-image,
            .profile-image-placeholder {
                width: 100px;
                height: 100px;
            }
        }
        
        @media (max-width: 576px) {
            .welcome-title {
                font-size: 1.8rem;
            }
            
            .welcome-subtitle {
                font-size: 1.1rem;
            }
            
            .admin-name {
                font-size: 1.3rem;
            }
            
            .profile-image,
            .profile-image-placeholder {
                width: 80px;
                height: 80px;
            }
        }
        .custom-container{
            border-radius: 5px;
        }
    </style>
 
        <div class="container customer-container py-4"  >

        <div class="row">
            <div class="col-12">
                <div class="welcome-card">
                     <div class="section-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    {{$section->sub_office_name}}
                                </div>
                    
                    
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-7">
                            <div class="welcome-text">
                                <h1 class="welcome-title">Transaction Count</h1>
                                <p class="welcome-subtitle">Please submit the complete number in every service at the end of the Quarter.</p>
                                <h2 class="admin-name">{{$section->office_admin}}</h2>
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 text-center">
                            <div class="profile-image-container">
                                <!-- Option 1: With actual image -->
                                                        @php
    $profileImage = $section->image_path ? 'images/' . $section->image_path : 'logo.png';
@endphp

<img src="{{ asset($profileImage) }}" 
                                     alt="Office Admin Profile" 
                                     class="profile-image"
                                     id="profileImage"
                                     style="object-fit:cover" >
                                
                                
                            </div>
                        </div>
                         
                        
                        <div class="alert alert-light mt-2  " style="border:1px solid #ccc;margin-bottom:0px">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 text-dark">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <div>
                    <strong>Current Quarter:</strong> Q{{ $currentQuarter }} of {{ $currentYear }}<br>
                    <strong>Submission Window:</strong> {{ $startWindow->format('M d, Y') }} to {{ $endWindow->format('M d, Y') }}<br>
                    <strong>Status:</strong> 
                    <span class="badge {{ $isSubmissionWindowOpen ? 'bg-success' : 'bg-danger' }}">
                        {{ $isSubmissionWindowOpen ? 'Open for Submission' : 'Closed for Submission' }}
                    </span>
                </div>
            </div>
        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container"> 
        <div class="card p-1  shadow rounded-3" > 
    
    
    <div class="card-body">

<div class="d-flex align-items-center mb-3 p-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
            <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
            <line x1="3" y1="22" x2="21" y2="22"></line>
        </svg>
        <h4 class="mb-0">Submission of Total Transaction in every Services</h4>
    </div>

      



<!-- Analytics Dashboard Section -->
<div class="row mb-4">
    <!-- Summary Cards -->
    <div class="col-md-3 mb-0">
        <div class="card  shadow-sm" style="border: 1px solid #ccc;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary  rounded-circle p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" class="text-primary">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">External Services</h6>
                        <h4 class="mb-0 text-primary">{{ count($externalServices) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-0">
        <div class="card shadow-sm"  style="border: 1px solid #ccc;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-secondary rounded-circle p-3">
                         <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" class="text-primary">
  <!-- Box or container -->
  <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="#ffffff" fill="none"/>
  
  <!-- Inward arrow -->
  <line x1="12" y1="8" x2="12" y2="16" stroke="#ffffff"/>
  <polyline points="8 12 12 16 16 12" fill="none" stroke="#ffffff"/>
</svg>

                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">Internal Services</h6>
                        <h4 class="mb-0 text-secondary">{{ count($internalServices) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-0">
        <div class="card  shadow-sm"  style="border: 1px solid #ccc;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning   rounded-circle p-3">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
  <path d="M16 7V4a2 2 0 0 0-2-2H10a2 2 0 0 0-2 2v3" />
</svg>

                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">Both Services</h6>
                        <h4 class="mb-0 text-warning">{{ count($bothServices) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-0">
        <div class="card  shadow-sm"  style="border: 1px solid #ccc;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success rounded-circle p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" class="text-success">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">Total Transactions</h6>
                        <h4 class="mb-0 text-success">
                            @php
                                $totalTransactions = \App\Models\ServiceTransactionCount::where('quarter', $currentQuarter)
                                    ->where('year', $currentYear)
                                     ->whereHas('service', function ($query) {
            $query->where('sub_office_id', session('sub_office_id'));
        })
                                    ->sum('transaction_count');
                            @endphp
                            {{ number_format($totalTransactions) }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Progress & Completion Stats -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card  " style="border:1px solid #ddd">
            <div class="card-header bg-transparent border-0 pb-0">
                <h6 class="mb-0">Submission Progress</h6>
            </div>
            <div class="card-body">
             @php
    $totalServices = count($externalServices) + count($internalServices) + count($bothServices);

    $submittedCount = \App\Models\ServiceTransactionCount::where('quarter', $currentQuarter)
        ->where('year', $currentYear)
        ->whereHas('service', function ($query) {
            $query->where('sub_office_id', session('sub_office_id'));
        })
        ->count();

    $progressPercentage = $totalServices > 0 ? round(($submittedCount / $totalServices) * 100) : 0;
@endphp

                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Completed</span>
                    <span class="fw-bold">{{ $submittedCount }}/{{ $totalServices }} ({{ $progressPercentage }}%)</span>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $progressPercentage ?>%"></div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-4 text-center">
                        <div class="text-success fw-bold fs-5">{{ $submittedCount }}</div>
                        <small class="text-muted">Submitted</small>
                    </div>
                    <div class="col-4 text-center">
                        <div class="text-secondary fw-bold fs-5">{{ $totalServices - $submittedCount }}</div>
                        <small class="text-muted">Pending</small>
                    </div>
                    <div class="col-4 text-center">
                        <div class="text-primary fw-bold fs-5">{{ $totalServices }}</div>
                        <small class="text-muted">Total</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card  " style="border:1px solid #ccc">
            <div class="card-header bg-transparent border-0 pb-0">
                <h6 class="mb-0">Service Distribution</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-muted small">External</span>
                        <span class="fw-bold">{{ count($externalServices) }}</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: <?= $totalServices > 0 ? (count($externalServices) / $totalServices) * 100 : 0 ?>%"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-muted small">Internal</span>
                        <span class="fw-bold">{{ count($internalServices) }}</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: <?= $totalServices > 0 ? (count($internalServices) / $totalServices) * 100 : 0 ?>%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-muted small">Both</span>
                        <span class="fw-bold">{{ count($bothServices) }}</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: <?= $totalServices > 0 ? (count($bothServices) / $totalServices) * 100 : 0 ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Services by Transaction Count -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card  " style="border:1px solid #ccc">
            <div class="card-header bg-transparent border-0 pb-0">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2 text-primary">
                        <line x1="12" y1="20" x2="12" y2="10"></line>
                        <line x1="18" y1="20" x2="18" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="16"></line>
                    </svg>
                    <h6 class="mb-0">Top 5 Services by Transaction Volume</h6>
                </div>
            </div>
            <div class="card-body">
            @php
    $topServices = \App\Models\ServiceTransactionCount::with('service')
        ->whereHas('service', function ($query) {
            $query->where('sub_office_id', session('sub_office_id'));
        })
        ->where('quarter', $currentQuarter)
        ->where('year', $currentYear)
        ->orderBy('transaction_count', 'desc')
        ->limit(5)
        ->get();

    $maxCount = $topServices->first()?->transaction_count ?? 1;
@endphp

                
                @if($topServices->count() > 0)
                    @foreach($topServices as $index => $transaction)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                                    <span class="fw-medium">{{ $transaction->service->service_name ?? 'Unknown Service' }}</span>
                                </div>
                                <span class="fw-bold text-primary">{{ number_format($transaction->transaction_count) }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-gradient" 
                                     style="background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%);width: <?= ($transaction->transaction_count / $maxCount) * 100 ?>%; ">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="mb-2 opacity-50">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <p class="mb-0">No transaction data available for this quarter</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>











        <!-- External Services Section -->
        @if(count($externalServices) > 0)
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    <h5 class="mb-0">External Services</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="table-primary">
                            <tr>
                                <th>Service Name</th>
                                <th width="15%">Transaction Count</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($externalServices as $service)
                                <tr>
                                    <td class="align-middle">{{ $service->service_name }}</td>
                                    <td class="align-middle">
                                        @php
                                            $existing = \App\Models\ServiceTransactionCount::where('service_id', $service->id)
                                                ->where('quarter', $currentQuarter)
                                                ->where('year', $currentYear)
                                                ->first();
                                        @endphp

                                        @if (!$existing && $isSubmissionWindowOpen)
                                            <form method="POST" action="{{ route('submit.transaction') }}" class="d-flex gap-2">
                                                @csrf
                                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                <input type="number" name="transaction_count" class="form-control" min="0" required placeholder="Enter count">
                                        @elseif ($existing)
                                            <span class="badge bg-success fs-6 w-100 py-2" style="font-weight:normal">{{ $existing->transaction_count }}</span>
                                        @else
                                            <span class="text-dark text-center fs-6 w-100 py-2" style="font-weight:normal">Not Available</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if (!$existing && $isSubmissionWindowOpen)
                                            <button type="submit" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                Submit
                                            </button>
                                            </form>
                                        @elseif ($existing)
                                            <button class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-center" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg>
                                                Submitted
                                            </button>
                                        @else
                                            <button class="btn btn-secondary btn-sm w-100 d-flex align-items-center justify-content-center" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg>
                                                Closed
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Internal Services Section -->
        @if(count($internalServices) > 0)
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <h5 class="mb-0">Internal Services</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="table-info">
                            <tr>
                                <th>Service Name</th>
                                <th width="15%">Transaction Count</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internalServices as $service)
                                <tr>
                                    <td class="align-middle">{{ $service->service_name }}</td>
                                    <td class="align-middle">
                                        @php
                                            $existing = \App\Models\ServiceTransactionCount::where('service_id', $service->id)
                                                ->where('quarter', $currentQuarter)
                                                ->where('year', $currentYear)
                                                ->first();
                                        @endphp

                                        @if (!$existing && $isSubmissionWindowOpen)
                                            <form method="POST" action="{{ route('submit.transaction') }}" class="d-flex gap-2">
                                                @csrf
                                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                <input type="number" name="transaction_count" class="form-control" min="0" required placeholder="Enter count">
                                        @elseif ($existing)
                                            <span class="badge bg-success fs-6 w-100 py-2" style="font-weight:normal">{{ $existing->transaction_count }}</span>
                                        @else
                                            <span class="text-dark text-center fs-6 w-100 py-2" style="font-weight:normal">Not Available</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">   
                                        @if (!$existing && $isSubmissionWindowOpen)
                                            <button type="submit" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                Submit
                                            </button>
                                            </form>
                                        @elseif ($existing)
                                            <button class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-center" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg>
                                                Submitted
                                            </button>
                                        @else
                                            <button class="btn btn-secondary btn-sm w-100 d-flex align-items-center justify-content-center" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg>
                                                Closed
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Both Services Section -->
        @if(count($bothServices) > 0)
            <div>
                <div class="d-flex align-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <h5 class="mb-0">Services Offered</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead class="table-warning">
                            <tr>
                                <th>Service Name</th>
                                <th width="15%">Transaction Count</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bothServices as $service)
                                <tr>
                                    <td class="align-middle">{{ $service->service_name }}</td>
                                    <td class="align-middle">
                                        @php
                                            $existing = \App\Models\ServiceTransactionCount::where('service_id', $service->id)
                                                ->where('quarter', $currentQuarter)
                                                ->where('year', $currentYear)
                                                ->first();
                                        @endphp

                                        @if (!$existing && $isSubmissionWindowOpen)
                                            <form method="POST" action="{{ route('submit.transaction') }}" class="d-flex gap-2">
                                                @csrf
                                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                <input type="number" name="transaction_count" class="form-control" min="0" required placeholder="Enter count">
                                        @elseif ($existing)
                                            <span class="badge bg-success fs-6 w-100 py-2">{{ $existing->transaction_count }}</span>
                                        @else
                                            <span class="text-dark text-center fs-6 w-100 py-2" style="font-style: normal;">Not Available</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if (!$existing && $isSubmissionWindowOpen)
                                            <button type="submit" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                Submit
                                            </button>
                                            </form>
                                        @elseif ($existing)
                                            <button class="btn btn-success btn-sm w-100 d-flex align-items-center justify-content-center" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg>
                                                Submitted
                                            </button>
                                        @else
                                            <button class="btn btn-secondary btn-sm w-100 d-flex align-items-center justify-content-center" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg>
                                                Closed
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div></div>
</body>
</html>
