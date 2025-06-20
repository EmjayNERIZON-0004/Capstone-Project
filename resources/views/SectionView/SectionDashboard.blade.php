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
</head>
<body>
    <!-- Top Navbar -->
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
                                <h1 class="welcome-title">Welcome Back!</h1>
                                <p class="welcome-subtitle">Ready to manage your section efficiently</p>
                                <h2 class="admin-name">{{$section->office_admin}}</h2>
                                <p class="current-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span id="currentDate">Tuesday, June 10, 2025</span>
                                </p>
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
     style="object-fit: cover;">

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update current date
        function updateDate() {
            const now = new Date();
            const options = { 
                weekday: 'long',
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
        }
        
        // Initialize date
        updateDate();
        
        // Update date every minute
        setInterval(updateDate, 60000);
       
        
        // Demo: Click to toggle image
   
     </script>


<!-- Section Name Banner -->

    <div class="container"  >
    @php
            use Carbon\Carbon;
            $today = Carbon::now()->format('l');  
        @endphp

        @if ($today == "Tuesday")     <?php
                        function getIconSVG($score) {
                            $color = '';

                            if ($score < 0.60 && $score > 0) {
                                $color = '#F44336';
                                $svg = view('components.svg.sad2')->render();
                            } else if ($score >= 0.60 && $score < 0.80) {
                                $color = '#FF9800';
                                $svg = view('components.svg.neutral')->render(); 
                            } else if ($score >= 0.80 && $score < 0.95) {
                                $color = '#8BC34A';
                                $svg = view('components.svg.smile2')->render();
                            } else if ($score > 0.95) {
                                $color = '#4CAF50';
                                $svg = view('components.svg.smile')->render(); 
                            } else {
                                $color = 'rgb(154, 154, 154)'; 
                                $svg = view('components.svg.neutral')->render(); 

                            }

                            return "<div style='color: $color;'>$svg</div>";
                        }

                        function getEquivalent($score) {
                            if ($score < 0.60 && $score > 0.0) {
                                return '<h2>Poor</h2>';
                            } else if ($score >= 0.60 && $score < 0.80) {
                                return '<h2>Fair</h2>';
                            } else if ($score >= 0.80 && $score < 0.95) {
                                return '<h2>Satisfactory</h2>';
                            } else if ($score > 0.95) {
                                return '<h2>Satisfactory</h2>';
                            } else if($score > 96) {
                                return '<h2>Outstanding</h2>';
                            }
                            else{
                                return '<h2>None</h2>';

                            }
                        }
                        ?>
            <div class="section-dashboard" >
                <!-- Stats Section -->
               <div class="row"  >
    <div class="col-md-3 col-sm-6 ">
        <div class="card shadow rounded-1">
            <div class="card-body text-center d-flex">
                <div class="box" style="background-color:rgb(108, 108, 108);">
                    <img src="{{asset('people.svg')}}" style="height:40px; width:40px;">
                </div>
                <div class="stat-content">
                    <h5 class="card-title mb-0 text-muted fw-normal">Total Responses</h5>
                    <h2>{{ $totalResponses }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="card shadow rounded-1">
            <div class="card-body text-center d-flex">
                <div class="box" style="background-color:rgb(12, 120, 77);">
                    <img src="{{asset('briefcase.svg')}}" style="height:40px; width:40px;">
                </div>
                <div class="stat-content">
                    <h5 class="card-title mb-0 text-muted fw-normal">Services Offered</h5>
                    <h2>{{ $servicesCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="card shadow rounded-1">
            <div class="card-body text-center d-flex">
                <div class="box" style="background-color:rgb(26, 104, 193);">
                    <img src="{{asset('office-building.svg')}}" style="height:40px; width:40px;">
                </div>
                <div class="stat-content">
                    <h5 class="card-title mb-0 text-muted fw-normal">Section Rating</h5>
                        @if($totalResponses !=0)
                     <h2 style="color:rgb(53, 53, 53)"><b>{{ number_format($overallScore * 100, 2) }}%</b></h2>
                        @else
                     <h2 style="color:rgb(53, 53, 53)"><b>None</b></h2>

                        @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6   ">
       

        <div class="card shadow rounded-1">
            <div class="card-body text-center d-flex">
                <div class="icon-container">
                    @if($totalResponses  != 0)
                    {!! getIconSVG($overallScore) !!}
                 
                        @else
                    {!! getIconSVG(-1) !!}
                        
                        @endif
                </div>
                <div class="stat-content">
                    <h5 class="card-title mb-0 text-muted fw-normal">Status</h5>
                         @if($totalResponses  != 0)
                    {!! getEquivalent($overallScore) !!}
                        @else
                    {!! getEquivalent(-1) !!}

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

                <input type="hidden" id="section_id" value="{{session('sub_office_id')}}">
                
                <!-- Ranked Services Chart -->
                <div class="card  shadow rounded-3">
                    <div class="card-header">
                        @php 
                            $now = Carbon::now();
                            $quarter = $now->quarter;
                            $year = $now->year;
                        @endphp
                        <h5 class="mb-0">  Services Offered Ranking - Quarter {{ $quarter }} of {{ $year }}</h5>
                    </div>
                    
                    <div class="card-body" style="height: 400px">
                        <div class="d-flex justify-content-center align-items-center mb-0 small legend-container flex-wrap">
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #F44336;"></span>
                                <span>Below 60% (Poor)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #FF9800;"></span>
                                <span>60% - 79% (Fair)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #8BC34A;"></span>
                                <span>80% - 94% (Satisfactory)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #4CAF50;"></span>
                                <span>95% - 100% (Outstanding)</span>
                            </div>
                        </div>
                        <canvas id="rankedServicesChart" height="200"></canvas>
                    </div>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    let subOfficeId = document.getElementById('section_id').value;
                    
                    fetch(`/api/ranked-services/${subOfficeId}`)
                        .then(res => res.json())
                        .then(data => {
                            const labels = data.rankedServices.map(s => s.office_name);
                            const scores = data.rankedServices.map(s => (s.overall_score * 100).toFixed(2));
                            const feedbacks = data.rankedServices.map(s => s.feedbacks);
                            const complaints = data.rankedServices.map(s => s.complaints);
                            const recommendations = data.rankedServices.map(s => s.recommendations);
                            const backgroundColors = data.rankedServices.map(s => {
                                const score = s.overall_score;
                                if (score < 0.60) return '#F44336';       // Red
                                else if (score >= 0.60 && score < 0.80) return '#FF9800'; // Orange
                                else if (score >= 0.80 && score < 0.95) return '#8BC34A'; // Light Green
                                else if (score >= 0.95) return '#4CAF50';  // Green
                            });

                            new Chart(document.getElementById('rankedServicesChart'), {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Overall Score (%)',
                                        data: scores,
                                        backgroundColor: backgroundColors,
                                        borderRadius: 1,
                                        barThickness: 30
                                    }]
                                },
                                options: {
                                    indexAxis: 'y',
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        tooltip: {
                                            callbacks: {
                                                label: function (context) {
                                                    return `Score: ${context.raw}%`;
                                                },
                                                afterBody: function (tooltipItems) {
                                                    const i = tooltipItems[0].dataIndex;
                                                    return [
                                                        `Feedbacks: ${feedbacks[i]}`,
                                                        `Complaints: ${complaints[i]}`,
                                                        `Recommendations: ${recommendations[i]}`
                                                    ];
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            min: 0,
                                            max: 100,
                                            title: {
                                                display: true,
                                                text: 'Score (%)'
                                            }
                                        },
                                        y: {
                                            ticks: {
                                                autoSkip: false,
                                                callback: function(value, index) {
                                                    const label = labels[index];
                                                    return wrapText(label, 70);
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        });
               
                    // Improved text wrapping function
                    function wrapText(text, maxChars) {
                        if (!text) return '';
                        const words = text.split(' ');
                        let lines = [];
                        let currentLine = '';
                        
                        words.forEach(word => {
                            if ((currentLine + word).length > maxChars) {
                                lines.push(currentLine.trim());
                                currentLine = word + ' ';
                            } else {
                                currentLine += word + ' ';
                            }
                        });
                        
                        if (currentLine) {
                            lines.push(currentLine.trim());
                        }
                        
                        return lines;
                    }
                });
                </script>

                <div class="row mt-4">
                    <!-- Notifications -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow rounded-3">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                    Notifications
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center p-3 bg-light rounded mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 text-primary">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    No new notifications
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow rounded-3">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                    Recent Transactions Count
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center p-3 bg-light rounded mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 text-primary">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    No recent transactions
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="    text-center   my-0 mb-3">
                <div class=" ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="rgb(13, 111, 186)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-3">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <h4 class="text-muted">
                        Come back every <strong>Monday</strong> to view your progress dashboard
                    </h4>
                </div>
            </div>
        @endif

</body>
</html>
