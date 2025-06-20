@extends('layout.layout_office')
  <title>@yield('title','SDO-SCC Office')</title>
   
   
                                                                                          
@section('content')


<div class="container mb-5"  >  
    
    <style>
      
        .container{
            padding: 0px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;

        }
        .card-container{
            padding: 20px; 
           
        }
        .main-content{
            padding: 0px; 
        }
          /* Dashboard Layout */
          .dashboard-container {
              display: grid;
              grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
              gap: 16px;
              padding: 20px; 
              padding-bottom: 5px; 

          }
  
          /* Card Design */
          .dashboard-card {
              background: #fff;
              border-radius: 12px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              padding: 16px;
              border: 1px solid #ccc;
              text-align: left;
              position: relative;
              transition: all 0.3s ease-in-out;
          }
  
          /* Accent Lines */
          .card-top-line {
              height: 4px;
              width: 40px;
              background-color: #007bff;
              border-radius: 2px;
              margin-bottom: 5px;
          }
  
          .card-sub-line {
              height: 4px;
              width: 20px;
              background-color: #007bff;
              border-radius: 2px;
              margin-bottom: 8px;
          }
  
          /* Large Numbers */
          .card-number {
              font-size: 2rem;
              font-weight: bold;
              color: #111;
              transition: font-size 0.3s ease-in-out;
          }
  
          /* Subtext */
          .card-subtext {
              font-size: 0.9rem;
              color: #b0b0b0;
              font-weight: 500;
              transition: font-size 0.3s ease-in-out;
          }
  
          /* Responsive Styles */
          @media (max-width: 1200px) {
              .dashboard-container {
                  grid-template-columns: repeat(3, 1fr); /* 3 Columns */
              }
          }
  
          @media (max-width: 900px) {
              .dashboard-container {
                  grid-template-columns: repeat(3, 1fr); /* Still 3 columns */
              }
              .dashboard-card {
                  padding: 12px; /* Reduce padding */
              }
              .card-number {
                  font-size: 1.5rem; /* Shrink numbers */
              }
              .card-subtext {
                  font-size: 0.75rem; /* Shrink text */
              }
          }
  
          @media (max-width: 600px) {
              .dashboard-container {
                  grid-template-columns: repeat(3, 1fr); /* 2 columns */
              }
              .title{
                font-size: 0.9rem;
              }
          }
  
          @media (max-width: 400px) {
              .dashboard-container {
                  grid-template-columns: repeat(2 , 1fr); /* 1 column for small screens */
              }
          }
          </style>
   
    <div class="dashboard-container"   >
        <!-- Card 1 -->
        <div class="dashboard-card"> 
    <div class="icon-container">
        {!! getIconSVG($overall_score) !!}
    </div>
    <div class="card-subtext">Office Status</div>
</div>  
        <div class="dashboard-card">
            <div class="card-top-line"></div>
            <div class="card-sub-line"></div>
            <div class="card-number">{{$total_responses}}</div>
            <div class="card-subtext"> Responses for Q{{ now()->quarter }} {{ now()->year }}</div>

        </div>

        <!-- Card 2 -->
        <div class="dashboard-card">
            <div class="card-top-line"></div>
            <div class="card-sub-line"></div>
            <div class="card-number">{{$services_count}}</div>
            <div class="card-subtext">Total Services</div>
        </div>

        <!-- Card 3 -->
   

        <style>
  .icon-container {
    display: inline-block;
    padding: 1px;
    border-radius: 50%;
    background-color: white;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    transition: all 0.3s ease-in-out;
    margin: 0px;
    margin-bottom: 10px;
    
  }

  .icon-container:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
  }
  
  .icon-container i {
    transition: color 0.3s ease, font-size 0.3s ease;
  }
</style>
<?php

use App\Models\SubOffice;

function getIconSVG($score) {
    $color = '';

    if ($score < 0.60) {
        $color = '#F44336';
        $svg = view('components.svg.sad2')->render();
    }   
     else if ($score >= 0.60 && $score < 0.80) {
       $color = '#FF9800';
        $svg = view('components.svg.neutral')->render(); 
    } else if ($score >= 0.80 && $score < 0.95) {
        $color = '#8BC34A';
        $svg = view('components.svg.smile2')->render();
    } else if ($score >0.95) {
       $color = ' #4CAF50';
        $svg = view('components.svg.smile')->render(); 
    } 
    
    else {
        return '';
    }

    // Wrap the SVG inside a div with dynamic color applied
    return "<div style='color: $color;'>$svg</div>";
}
?>



<div class="dashboard-card">
            <div class="card-top-line"></div>
            <div class="card-sub-line"></div>
            <div class="card-number">{{ number_format($overall_score * 100, 2) }}%
            </div>
            <div class="card-subtext">Strongly Agree & Agree</div>
        </div>





        <!-- Card 5 -->
        <!-- <div class="dashboard-card">
    <div class="card-top-line"></div>
    <div class="card-sub-line"></div>
    <div class="card-number">
        {{ $transaction ? $transaction->number_transaction : 'N/A' }}
    </div>
    <div class="card-subtext"> No. Of Transaction</div>
    @if($enableInput)
    <a href="{{ route('submit.transaction.form') }}" class="btn btn-primary w-100 mt-3 btn-sm">
        <b>Input</b>
    </a>
@endif


@if($shouldHighlight)
    <div class="warning-icon  " data-tooltip="  {{ $daysLeft }} days left.">
        <i class="fas fa-exclamation-circle zoom"></i>
    </div>
@endif


</div> -->
<style>
.warning-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: red;
    font-size: 22px;
    cursor: pointer;
}
/* Zoom In & Out Animation */
@keyframes zoomEffect {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
}

.zoom {
    animation: zoomEffect 1.6s infinite ease-in-out;
}


/* Shake Effect */
.shake {
    animation: shake 0.5s infinite;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-3px); }
    50% { transform: translateX(3px); }
    75% { transform: translateX(-3px); }
}


.warning-icon::after {
    content: attr(data-tooltip);
    position: absolute;
    right: 120%;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    font-size: 12px;
    padding: 5px 8px;
    border-radius: 5px;
    white-space: nowrap;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.warning-icon:hover::after {
    visibility: visible;
    opacity: 1;
}
</style>
 @include('components.alert')
        <!-- Card 6 -->
     
    </div>
   
  
@if($total_responses != 0)
<div class="container mb-3" style=" padding-left:20px;padding-right:20px;">


    <div class="card shadow-sm mt-3 card-container"  >
       <header class="header" style="width:100%;top:0">
    <!-- <img src="{{ asset('logo.png') }}" alt="Logo" class="logo"> -->
    <h4 class="office-name">Data of {{ session('office_name') }} Responses</h4>
 
     
   
</header> 



<!-- <div style="width: 500px; height: 500px;">
    <canvas id="sqdPieChart" style="width: 100%; height: 100%;"></canvas>
</div> -->

 
<!-- Include Chart.js and the Data Labels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

  <div style="width: 100%; height: auto;">
    <canvas id="sqdBarChart" style="width: 100%; height: 100%;"></canvas>
</div>
<div id="dataInterpretation"></div>

<!-- Include Chart.js and the Data Labels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    // Parse SQD Scores from Blade
    var sqd_scores = JSON.parse('{!! $sqd_scores !!}');

    console.log("SQD Scores from Blade:", sqd_scores);

    // Extract labels and scores
    const labels = Object.keys(sqd_scores);
    const scores = Object.values(sqd_scores);

    // Function to get color based on score
    function getColorForScore(score) {
        if (score < 60) return '#F44336'; 
        
        else if (score >=60 && score <=79.9) return '#FF9800'; // Orange
    
        else if (score >=80 && score <=94.9) return '#8BC34A'; // Orange
    
         else if (score >= 95 && score <=100 ) return '#4CAF50'; 
    }

    // Map scores to colors based on their values
    const backgroundColors = scores.map(score => getColorForScore(score));

    // Calculate dynamic font size based on window width
    function getFontSize() {
        const width = window.innerWidth;
        if (width <= 480) {  // Small devices like mobile
            return 10;
        } else if (width <= 768) {  // Medium devices like tablets
            return 12;
        } else {  // Larger devices like desktops
            return 14;
        }
    }

    // Calculate average score
    const averageScore = scores.reduce((sum, score) => sum + score, 0) / scores.length;
    let interpretation = "";

    // Add data interpretation using if-else logic
    if (averageScore <= 0.20) {
        interpretation = "The overall performance is very poor. Immediate attention is needed to improve scores across all SQDs.";
    } else if (averageScore <= 0.40) {
        interpretation = "The performance is below average. Some SQDs need improvement, especially in areas like responsiveness and reliability.";
    } else if (averageScore <= 0.60) {
        interpretation = "The performance is average. Some SQDs show improvement potential, but the overall score needs further enhancement.";
    } else if (averageScore <= 0.80) {
        interpretation = "The performance is above average. Most areas are doing well, but there's still room for improvement in specific SQDs.";
    } else {
        interpretation = "The performance is excellent! Most SQDs are performing at a high level, and the focus should be on maintaining this level.";
    }

    console.log("Data Interpretation:", interpretation);  // You can also display this on the page

    // Display interpretation on the page (if needed)
    document.getElementById('dataInterpretation').textContent = interpretation;

    // Chart Configuration
    const ctx = document.getElementById('sqdBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',  // Change to 'bar' for a bar chart
        data: {
            labels: labels,
            datasets: [{
                data: scores,
                backgroundColor: backgroundColors,  // Dynamic background color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,  // Make the chart responsive
            maintainAspectRatio: false,  // Allow the chart to scale as needed
            plugins: {
                legend: {
                    display: false  // Hide the legend for the bar chart
                },
                datalabels: {  // Display values inside the bars
                    color: 'white',  // Adjust text color for contrast
                    anchor: 'center',
                    align: 'center',
                    font: {
                        weight: 'bold',
                        size: getFontSize()  // Use dynamic font size based on window width
                    },
                    formatter: function(value, ctx) {
                        return value.toFixed(1);  // Display score value inside the bars
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,  // Ensure bars start at zero
                },
                y: {
                    ticks: {
                        beginAtZero: true,  // Ensure y-axis starts at zero
                        stepSize: 10,  // Adjust based on your data
                    },
                    min: 0,
                    max: 100
                }
            }
        },
        plugins: [ChartDataLabels]  // Register Data Labels Plugin
    });
</script>

 </div>

</div>
<!-- <div class="container" style=" padding-left:20px;padding-right:20px;">
    <div class="row">
         
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 h-100 "  >
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="title mb-0">Service Quality Dimensions per Section</h3>
                </div>
                <div class="card-body"  >
                    <div id="subOfficeTableContainer"></div>
                </div>
            </div>
        </div>

       
        <div class="col-lg-5">
        <div class="card shadow-lg border-0 ">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="title mb-0">Section Status</h4>
                </div>
                <div class="card-body" style="max-height: 800px;  ">
                       <div class="mb-3">
    <h6 class="fw-bold">Score Guide</h6>
    <div class="table-responsive">
        <table class="table table-bordered text-center small mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">Color</th>
                    <th>Score Range</th>
                    <th>Equivalent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color: #F44336;"></td>
                    <td>Below 60%</td>
                    <td>Poor</td>
                </tr>
                <tr>
                    <td style="background-color: #FF9800;"></td>
                    <td>60% - 79%</td>
                    <td>Fair</td>
                </tr>
                <tr>
                    <td style="background-color: #8BC34A;"></td>
                    <td>80% - 94%</td>
                    <td>Satisfactory</td>
                </tr>
                <tr>
                    <td style="background-color: #4CAF50;"></td>
                    <td>95% - 100%</td>
                    <td>Outstanding</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

                  
                    <canvas id="sectionScoreBarChart" height="400" width="500"></canvas>
<div id="customLegend" class="mt-3"></div>
 
                </div>
            </div>
        </div>
    </div>
</div> -->








@php
    $subOffices = \App\Models\SubOffice::where('main_office_id', session('office_id'))
                    ->orderBy('sub_office_name') // <-- Sort alphabetically
                    ->get();

    // Get survey response counts for each sub office
    $surveyResponseCounts = [];
    foreach ($subOffices as $subOffice) {
        $count = \App\Models\survey_responses::where('office_transacted_with', $subOffice->sub_office_name)->count();
        $surveyResponseCounts[$subOffice->id] = $count;
    }
@endphp


<div class="container  mb-3"  style=" padding-left:20px;padding-right:20px;">
        <div class="row ">
            <div class="col-12">
                <p class="display-4 fw-bold text-dark mb-0">Sub Offices</p>
                <p class="text-muted">Under the {{session('office_name')}}</p>
            </div>
        </div>
        
        <div class="row g-4" id="subOfficesGrid">
            <!-- Cards will be inserted here by JavaScript -->
        </div>
    </div>
  <div id="data-container" 
         data-sub-offices='{!! json_encode($subOffices) !!}'
         data-survey-response-counts='{!! json_encode($surveyResponseCounts) !!}'
         style="display: none;">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
            const dataContainer = document.getElementById('data-container');
        
         const subOfficesData = JSON.parse(dataContainer.getAttribute('data-sub-offices'));
        const surveyResponseCounts = JSON.parse(dataContainer.getAttribute('data-survey-response-counts'));
        
        function renderSubOffices() {
            const grid = document.getElementById('subOfficesGrid');
            
            subOfficesData.forEach(office => {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-12 col-sm-8 col-lg-6 col-xl-4';
                
                // Fix the image source issue
                const imageSrc = office.image_path  ;

                // Updated card structure with flex layout for consistent height
             colDiv.innerHTML = `
    <div class="card h-100 shadow-sm border-0 d-flex flex-column" style="transition: all 0.3s ease;">
        <div class="card-body p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex align-items-center mb-3">
                <img src="{{asset('images/${imageSrc}')}}" 
                     alt="${office.sub_office_name} Admin" 
                     class="rounded-circle me-3 border"
                     style="width: 100px; height: 100px; object-fit: cover; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);"
                     onerror="this.src='{{ asset('logo.png') }}'">
                <div class="flex-grow-1">
                    <h5 class="card-title mb-1 fw-bold text-dark">${office.sub_office_name}</h5>
                    <small class="text-muted">
                        <i class="fas fa-id-badge me-1"></i>ID: ${office.id}
                    </small>
                </div>
            </div>
            
            <div class="mb-3 flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                            <path d="M3 21h18M5 21V7l8-4v18M13 9v12M13 9h6v12"/>
                        </svg>
                        Main Office ID:
                    </span>
                    <span class="badge bg-primary">${office.main_office_id}</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Admin:
                    </span>
                    <span class="fw-medium text-dark">${office.office_admin || 'N/A'}</span>
                </div>
            </div>

            <hr class="my-3">

            <!-- Highlighted footer for survey responses -->
            <div class="bg-white p-3 border-2 rounded border d-flex justify-content-between align-items-center shadow-sm mt-auto" style="background-color: #eaf4ff;">
                <span class="text-muted small d-flex align-items-center">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14,2 14,8 20,8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10,9 9,9 8,9"/>
                    </svg>
                    <div class="text-muted" style="font-size:18px">Survey Responses</div>
                </span>
                <span class="badge bg-success fs-6 px-3 py-2">${surveyResponseCounts[office.id] || 0}</span>
            </div>
        </div>
    </div>
`;

                
                // Add hover effect
                const card = colDiv.querySelector('.card');
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '';
                });
                
                grid.appendChild(colDiv);
            });
        }
        
        function viewDetails(officeId) {
            // Add your view details functionality here
            console.log('Viewing details for office ID:', officeId);
            alert('View details for office ID: ' + officeId);
        }

        // Render cards when page loads
        document.addEventListener('DOMContentLoaded', renderSubOffices);
    </script>







<style>
  
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .service-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .service-name {
            font-size: 18px;
            font-weight: normal;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .service-details {
            color: #666;
            font-size: 14px;
        }
        .sub-office-badge {
            background: #007bff;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            display: inline-block;
            margin-top: 8px;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 20px;
            background:rgb(255, 255, 255);
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        .no-services {
            text-align: center;
            color: #666;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
            margin: 20px 0;
        }
        .services-list {
            list-style: none;
            padding: 0;
        }
        .services-list li {
            background: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .view-toggle {
            text-align: center;
            margin: 20px 0;
        }
        .btn {
            background: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn.active {
            background: #28a745;
        }
    </style>
<?php
    // Fetch services for the current office, sorted alphabetically
    $services = App\Models\Service::where('main_office_id', session('office_id'))
                ->orderBy('service_name') // <-- alphabetical sort
                ->get();

    // Convert to array for JavaScript usage
    $servicesArray = $services->toArray();

    // Calculate statistics
    $totalServices = $services->count();
    $subOfficesCount = $services->pluck('sub_office_id')->unique()->count();

    // Group services by sub_office_id
    $groupedServices = $services->groupBy('sub_office_id');
?>
    <div class="container " style="  margin-left:20px;margin-right:20px">
     
  <div class="col-12">
                <p class="display-4 fw-bold text-dark mb-0">  Service Offered</p>
                <p class="text-muted">Under the {{session('office_name')}}</p>
            </div>
        <!-- Statistics -->
      

 

        @if($services->isEmpty())
            <div class="no-services">
                <h3>No Services Found</h3>
                <p>There are currently no services available for this office.</p>
            </div>
        @else
            <!-- Card View -->
              




            <div id="grouped-view  " style="display: block; margin-top: 0px; ">


             
              @foreach($groupedServices as $subOfficeId => $officeServices)
    <div style="margin: 20px 0; padding: 20px; background:rgba(248, 249, 250, 0); border-radius: 8px;">
        <h4 style="color: #333; margin-bottom: 15px;">
            <?php
              
                $subOfficeName = SubOffice::where("id", $subOfficeId)->value("sub_office_name");
                $image = SubOffice::where("id", $subOfficeId)->value("image_path");
          
          ?>

            {{ $subOfficeName ? "  $subOfficeName" : "Main Office" }}

            <span style="background: #007bff; color: white; padding: 2px 8px; border-radius: 10px; font-size: 18px; margin-left: 10px;">
                {{ $officeServices->count() }} services
            </span>
        </h4>

        <div class="services-grid">
            @foreach($officeServices as $service)
                <div class="service-card" style="margin: 0;border:1px solid #ccc">
                    <div class="service-name">{{ $service->service_name }}</div>
                    <div class="service-details">
                        <strong>Service Type:</strong> {{ $service->services_type }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
            </div>
        @endif
    </div>

    <!-- Pass data to JavaScript for additional functionality -->
    <div id="data-container" 
         data-services='{!! json_encode($servicesArray) !!}'
         data-office-id="{{ session('office_id') }}"
         style="display: none;">
    </div>

    <script>
        // Get services data for JavaScript usage
        const servicesData = JSON.parse(document.getElementById('data-container').getAttribute('data-services'));
        const officeId = document.getElementById('data-container').getAttribute('data-office-id');
        
        console.log('Services Data:', servicesData);
        console.log('Office ID:', officeId);

     

     

        function updateActiveButton(activeIndex) {
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach((btn, index) => {
                btn.classList.remove('active');
                if (index === activeIndex) {
                    btn.classList.add('active');
                }
            });
        }

        // Additional JavaScript functionality for filtering, searching, etc.
        function filterServices(searchTerm) {
            const filteredServices = servicesData.filter(service => 
                service.service_name.toLowerCase().includes(searchTerm.toLowerCase())
            );
            console.log('Filtered services:', filteredServices);
            // You can implement dynamic filtering here
        }

        // Example of using the services data
        function getServicesBySubOffice(subOfficeId) {
            return servicesData.filter(service => service.sub_office_id == subOfficeId);
        }

        function getServiceById(serviceId) {
            return servicesData.find(service => service.id == serviceId);
        }
    </script>
















<style>
    img {
        width: 100%;
        max-width: 400px;
        height: auto;
    }

    @media (max-width: 576px) {
        img {
            max-width: 200px;  /* Smaller image for mobile */
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadSubOfficeScores(); // Load immediately
        setInterval(loadSubOfficeScores, 100000); // Refresh every 10 seconds
    });

    function loadSubOfficeScores() {
    fetch('/scores-sub_offices')
        .then(response => response.json())
        .then(data => {
            const rankedSubOfficesPerSQD = data.rankedSubOfficesPerSQD;
            const tableContainer = document.querySelector('#subOfficeTableContainer');
            tableContainer.innerHTML = ''; // Clear old content

            const sqdNames = {
                sqd1: "Responsiveness",
                sqd2: "Reliability",
                sqd3: "Access and Facilities",
                sqd4: "Communication",
                sqd5: "Costs",
                sqd6: "Integrity",
                sqd7: "Assurance",
                sqd8: "Outcome"
            };

            for (const sqd in rankedSubOfficesPerSQD) {
                const subOffices = rankedSubOfficesPerSQD[sqd];
                const subOfficeNames = Object.keys(subOffices);
                const scores = subOfficeNames.map(name => (subOffices[name].score * 100).toFixed(2));

                const canvasId = `chart-${sqd}`;
                const sqdDisplayName = `${sqd.toUpperCase()} - ${sqdNames[sqd] || sqd}`;

                tableContainer.innerHTML += `
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">${sqdDisplayName}</h6>
                            <canvas id="${canvasId}" height="${subOfficeNames.length * 40}"></canvas>
                        </div>
                    </div>
                `;

                // Wait for DOM to render before initializing Chart
                setTimeout(() => {
                    const ctx = document.getElementById(canvasId).getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: subOfficeNames,
                            datasets: [{
                                label: 'Score (%)',
                                data: scores,
                                backgroundColor: '#198754' // Bootstrap success green
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            scales: {
                                x: {
                                    min: 0,
                                    max: 100,
                                    title: {
                                        display: true,
                                        text: 'Score %'
                                    }
                                },
                                y: {
                                    ticks: {
                                        autoSkip: false,
                                        maxTicksLimit: 100
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => `${ctx.raw}%`
                                    }
                                }
                            }
                        }
                    });
                }, 50);
            }
        })
        .catch(error => {
            console.error('Error fetching sub-office scores:', error);
        });
}

</script>


<!-- Bootstrap JS (optional for functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>






         
    @else
    <style>
    img {
        width: 100%;
        max-width: 400px;
        height: auto;
    }

    @media (max-width: 576px) {
        img {
            max-width: 200px;  /* Smaller image for mobile */
        }
    }
</style>

<img src="{{ asset('undraw_users-per-minute_eg97.svg') }}" alt="SVG Image">

     <div class="card-subtext">No responses for {{ now()->format('F Y') }}.</div>

@endif

    <!-- Graphs -->
    <!-- <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="text-center">Average Scores for Each SQD</h5>
            <canvas id="sqdChart"></canvas>
        </div>
    </div> -->
</div> 

<?php
    $sqdCounts = isset($sqd_counts) ? implode(',', $sqd_counts) : '';
    $sqdTotals = isset($sqd_totals) ? implode(',', $sqd_totals) : '';
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('sqdChart').getContext('2d');

    // PHP values injected here
    var sqdCounts = [<?= $sqdCounts ?>];
    var sqdTotals = [<?= $sqdTotals ?>];

    // Compute averages
    const avgScores = sqdCounts.map((count, index) => count ? (sqdTotals[index] / count).toFixed(2) : 0);

    // Function to return color based on score
    function getColorForScore(score) {
        if (score < 0.60)  return '#F44336';     
        else if (score >= 0.60 && score < 0.80)  return '#FF9800'; // Orange
        else if (score >= 0.80 && score < 0.95)  return '#8BC34A'; // Amber
    else if (score > 0.95) return '#4CAF50';  
              
}
 


    // Convert all to floats and map to colors
    const backgroundColors = avgScores.map(score => getColorForScore(parseFloat(score)));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'SQD1 - Responsiveness', 'SQD2 - Reliability', 'SQD3 - Facilities', 'SQD4 - Communication', 
                'SQD5 - Costs', 'SQD6 - Integrity', 'SQD7 - Assurance', 'SQD8 - Outcome'
            ],
            datasets: [{
                label: 'Average Score',
                data: avgScores,
                backgroundColor: backgroundColors
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
