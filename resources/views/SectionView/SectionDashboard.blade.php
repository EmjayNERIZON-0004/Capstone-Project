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
            background-color: rgb(13, 111, 186);
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
            font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
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
    <nav class="navbar navbar-expand-lg bg-dark top-navbar shadow-sm sticky-top">
    <div class="container-fluid"> 
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <h4 class="mb-0 d-none d-sm-inline">Section Dashboard</h4>
            <h6 class="mb-0 d-inline d-sm-none">Section Dashboard</h6>
        </div>

        <!-- Right Side Icons -->
        <div class="d-flex align-items-center ms-auto">
            <!-- Date Display -->
            <div class="me-3 d-none d-md-flex align-items-center  text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1 text-primary">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                {{ \Carbon\Carbon::now()->toFormattedDateString() }}
            </div>

            <!-- User Dropdown -->
            <div class="dropdown user-dropdown">
                <button class="btn dropdown-toggle d-flex align-items-center bg-dark" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="avatar-container bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <span class="fw-semibold text-white d-none d-sm-inline">{{ $section->office_admin }}</span>
                    </div>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                    <li class="dropdown-header d-sm-none">{{ $section->office_admin }}</li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            Settings
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

<!-- Section Name Banner -->
<div class="container-fluid  mt-2">
    <div class="card bg-primary bg-gradient text-white shadow-sm">
        <div class="card-body py-3">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                <div>
                    <h3 class="mb-0 d-none d-md-block">{{ $section->sub_office_name }}</h3>
                    <h5 class="mb-0 d-md-none">{{ $section->sub_office_name }}</h5>
                </div>
            </div>
        </div>
    </div>
</div> 
    <div class="container  py-5"  >
    @php
            use Carbon\Carbon;
            $today = Carbon::now()->format('l');  
        @endphp

        @if ($today == "Monday")     <?php
                        function getIconSVG($score) {
                            $color = '';

                            if ($score < 0.60) {
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
                                return '';
                            }

                            return "<div style='color: $color;'>$svg</div>";
                        }

                        function getEquivalent($score) {
                            if ($score < 0.60) {
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
                        }
                        ?>
            <div class="section-dashboard ">
                <!-- Stats Section -->
               <div class="row">
    <div class="col-md-3 col-sm-6 mb-3">
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

    <div class="col-md-3 col-sm-6 mb-3">
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

    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card shadow rounded-1">
            <div class="card-body text-center d-flex">
                <div class="box" style="background-color:rgb(26, 104, 193);">
                    <img src="{{asset('office-building.svg')}}" style="height:40px; width:40px;">
                </div>
                <div class="stat-content">
                    <h5 class="card-title mb-0 text-muted fw-normal">Section Rating</h5>
                    <h2 style="color:rgb(53, 53, 53)"><b>{{ number_format($overallScore * 100, 2) }}%</b></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-3">
       

        <div class="card shadow rounded-1">
            <div class="card-body text-center d-flex">
                <div class="icon-container">
                    {!! getIconSVG($overallScore) !!}
                </div>
                <div class="stat-content">
                    <h5 class="card-title mb-0 text-muted fw-normal">Status</h5>
                    {!! getEquivalent($overallScore) !!}
                </div>
            </div>
        </div>
    </div>
</div>

                <input type="hidden" id="section_id" value="{{session('sub_office_id')}}">
                
                <!-- Ranked Services Chart -->
                <div class="card mt-4 shadow rounded-3">
                    <div class="card-header">
                        @php 
                            $now = Carbon::now();
                            $quarter = $now->quarter;
                            $year = $now->year;
                        @endphp
                        <h5 class="mb-0">Ranked Services - Quarter {{ $quarter }} of {{ $year }}</h5>
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
            <div class="card shadow text-center py-5 my-0">
                <div class="card-body">
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

        <!-- Transaction Submission Section -->
        @php 
            $now = Carbon::now();
            $currentQuarter = $now->quarter;
            $currentYear = $now->year;
            $startOfQuarter = $now->copy()->firstOfQuarter();
            $endOfQuarter = $now->copy()->lastOfQuarter();
            $startWindow = $endOfQuarter->copy()->subDays(60);
            $endWindow = $endOfQuarter->copy()->addDays(6);
            $isSubmissionWindowOpen = $now->between($startWindow, $endWindow);
        @endphp
        <div class="card p-3 mt-3 shadow rounded-3"> 
    <div class="d-flex align-items-center mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-primary">
            <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
            <line x1="3" y1="22" x2="21" y2="22"></line>
        </svg>
        <h4 class="mb-0">Submission of Total Transaction in every Services</h4>
    </div>
    <div class="card-body">
        <div class="alert alert-light mb-4 shadow-sm" style="border:1px solid #ccc">
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
                    <table class="table table-hover table-bordered table-striped">
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
                    <table class="table table-hover table-bordered table-striped">
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
                    <table class="table table-hover table-bordered table-striped">
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
</div>
</body>
</html>
