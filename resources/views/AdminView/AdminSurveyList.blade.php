@extends('layout.general_layout')
<title>@yield('title','Admin Dashboard')</title>
@yield('sidebar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_survey_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">

    <div class="wrapper">
        <div class="content">
            <div class="container ">



   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Survey Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>











    <div class="card p-3 mb-3 mt-3">
    <h5>Survey Response Counts</h5>

    <div class="row mb-3">
        <div class="col-md-3">
            <label for="modeSelect">Select Mode</label>
            <select id="modeSelect" class="form-select" onchange="loadResponseChart()">
                <option value="weekly">Weekly</option>
                <option value="monthly" selected>Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="yearSelect">Select Year</label>
            <select id="yearSelect" class="form-select" onchange="loadResponseChart()">
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div style="height: 400px;">
        <canvas id="responseChart" style="width: 100%; height: 100%;"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let responseChartInstance;

function loadResponseChart() {
    const year = document.getElementById('yearSelect').value;
    const mode = document.getElementById('modeSelect').value;

    fetch(`response-counts/${year}/${mode}`)
        .then(res => res.json())
        .then(data => {
            const labels = data.map(item => item.label);
            const counts = data.map(item => item.count);

            // Destroy old chart
            if (responseChartInstance) {
                responseChartInstance.destroy();
            }

            const ctx = document.getElementById('responseChart').getContext('2d');
            responseChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Survey Responses',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Responses'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: mode.charAt(0).toUpperCase() + mode.slice(1)
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: context => `${context.raw} responses`
                            }
                        }
                    }
                }
            });
        });
}
 
document.addEventListener('DOMContentLoaded', loadResponseChart);
</script>














  <div class="dashboard-container" style="  display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
      
<div class="dashboard-card" style="flex: 1 1 calc(20% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: center; justify-content: space-between;">
     
        <h2  class="card-number text-primary">{{ $overall_responses }}</h2>
      

       
     <div style="background-color: #2196F3; padding: 10px; border-radius: 50%;">
                    <svg viewBox="0 0 24 24" width="50 " hieght=" 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 4C16.93 4 17.395 4 17.7765 4.10222C18.8117 4.37962 19.6204 5.18827 19.8978 6.22354C20 6.60504 20 7.07003 20 8V17.2C20 18.8802 20 19.7202 19.673 20.362C19.3854 20.9265 18.9265 21.3854 18.362 21.673C17.7202 22 16.8802 22 15.2 22H8.8C7.11984 22 6.27976 22 5.63803 21.673C5.07354 21.3854 4.6146 20.9265 4.32698 20.362C4 19.7202 4 18.8802 4 17.2V8C4 7.07003 4 6.60504 4.10222 6.22354C4.37962 5.18827 5.18827 4.37962 6.22354 4.10222C6.60504 4 7.07003 4 8 4M9.6 6H14.4C14.9601 6 15.2401 6 15.454 5.89101C15.6422 5.79513 15.7951 5.64215 15.891 5.45399C16 5.24008 16 4.96005 16 4.4V3.6C16 3.03995 16 2.75992 15.891 2.54601C15.7951 2.35785 15.6422 2.20487 15.454 2.10899C15.2401 2 14.9601 2 14.4 2H9.6C9.03995 2 8.75992 2 8.54601 2.10899C8.35785 2.20487 8.20487 2.35785 8.10899 2.54601C8 2.75992 8 3.03995 8 3.6V4.4C8 4.96005 8 5.24008 8.10899 5.45399C8.20487 5.64215 8.35785 5.79513 8.54601 5.89101C8.75992 6 9.03995 6 9.6 6Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
         
</div>

    </div>
  <h5 class="card-title">Overall Total Responses</h5>
<p class="card-subtext">
    Responses collected as of {{ \Carbon\Carbon::now()->format('F j, Y') }}
</p>


  </div>
</div>
    <div class="dashboard-card" style="flex: 1 1 calc(20% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: center; justify-content: space-between;">
   
        <h2 id="totalRowsCount" class="card-number text-primary">0</h2>
      
       
     <div style="background-color: #2196F3; padding: 10px; border-radius: 50%;">
  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50 " fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
    <line x1="4" y1="6" x2="20" y2="6" />
    <line x1="4" y1="12" x2="20" y2="12" />
    <line x1="4" y1="18" x2="20" y2="18" />
  </svg>
</div>

    </div>
  <h5 class="card-title">Total Rows</h5>

    <p class="card-subtext  "  >Select to filter survey results</p>

  </div>
</div>

<!-- Filter Form Dashboard Card -->
<div class="dashboard-card" style="flex: 1 1 calc(30% - 20px);">
  <div class="card-body" style="border: none;">
<div class="d-flex justify-content-between align-items-center">
<div>
<h2 class="card-number text-primary mb-0">Filter</h2>
    <p class="card-title " >Load the data selected</p>

    <p class="card-subtext " >Select   to filter survey results</p>
  </div>
     <div style="background-color: #2196F3; padding: 10px; border-radius: 50%;">

    <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
          <path d="M4 4h16v2l-6 7v5l-4 2v-7L4 6V4z"/>
        </svg>
  </div>
</div>

  
<form method="GET" action="{{ route('survey.responses') }}" id="surveyForm" class="d-flex flex-wrap gap-3 align-items-center m-0">
    <!-- Quarter -->
    <div class="form-group d-flex align-items-center gap-2" style="min-width: 150px;">
        <label for="quarter" class="stat-label mb-0">Quarter</label>
        <select name="quarter" id="quarter" class="form-select form-select-sm">
            <option value="1" {{ $selectedQuarter == 1 ? 'selected' : '' }}>Q1</option>
            <option value="2" {{ $selectedQuarter == 2 ? 'selected' : '' }}>Q2</option>
            <option value="3" {{ $selectedQuarter == 3 ? 'selected' : '' }}>Q3</option>
            <option value="4" {{ $selectedQuarter == 4 ? 'selected' : '' }}>Q4</option>
        </select>
    </div>

    <!-- Year -->
    <div class="form-group d-flex align-items-center gap-2" style="min-width: 150px;">
        <label for="year" class="stat-label mb-0">Year</label>
        <select name="year" id="year" class="form-select form-select-sm ">
            @for ($y = 2024; $y <= now()->year; $y++)
                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>

    <!-- Filter Button -->
    <div>
        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
          
            Get Data
        </button>
    </div>
</form>

   
  </div>


  
</div>



            </div>





<div class="text">More Selection</div>

           <div class="card p-3 mt-2 mb-3">
  <form class="row g-3 align-items-end">
    <!-- Sex Filter -->
    <div class="col-md-4">
      <label for="sexFilter" class="form-label">Sex</label>
      <select id="sexFilter" class="form-select" @if($total_responses == 0) disabled @endif>
        <option value="" selected>All Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>

    <!-- Age Range Filter -->
    <div class="col-md-2">
      <label for="ageFrom" class="form-label">Age From</label>
      <input type="number" id="ageFrom" class="form-control" placeholder="From" @if($total_responses == 0) disabled @endif>
    </div>

    <div class="col-md-2">
      <label for="ageTo" class="form-label">Age To</label>
      <input type="number" id="ageTo" class="form-control" placeholder="To" @if($total_responses == 0) disabled @endif>
    </div>

    <!-- Customer Type Filter -->
    <div class="col-md-4">
      <label for="customerTypeFilter" class="form-label">Customer Type</label>
      <select id="customerTypeFilter" class="form-select" @if($total_responses == 0) disabled @endif>
        <option value="" selected>All Customer Types</option>
        <option value="Citizen (general public, learners, parents, former DepEd employees, researchers, NGOs etc.)">Citizen</option>
        <option value="Business (private school, corporations, etc.)">Business</option>
        <option value="Government (current DepEd employees or employees of other government agencies & LGUs)">Government</option>
      </select>
    </div>

    <!-- Main Office Filter -->
    <div class="col-md-4">
      <label for="mainOfficeFilter" class="form-label">Office</label>
      <select id="mainOfficeFilter" class="form-select" @if($total_responses == 0) disabled @endif>
        <option value="" selected>All Offices</option>
        @foreach ($mainOffice as $mainOffices)
          <option value="{{ $mainOffices->office_name }}">{{ $mainOffices->office_name }}</option>
        @endforeach
      </select>
    </div>

    <!-- Section Filter -->
    <div class="col-md-4">
      <label for="sectionFilter" class="form-label">Section</label>
      <select id="sectionFilter" class="form-select" @if($total_responses == 0) disabled @endif>
        <option value="" selected>All Sections</option>
        @foreach ($subOffice as $subOffices)
          <option value="{{ $subOffices->sub_office_name }}">{{ $subOffices->sub_office_name }}</option>
        @endforeach
      </select>
    </div>

    <!-- Service Filter -->
    <div class="col-md-4">
      <label for="serviceFilter" class="form-label">Service</label>
      <select id="serviceFilter" class="form-select" @if($total_responses == 0) disabled @endif>
        <option value="" selected>All Services</option>
        @foreach ($service as $services)
          <option value="{{ $services->service_name }}">{{ $services->service_name }}</option>
        @endforeach
      </select>
    </div>

    <!-- Search and Sort -->
    <div class="col-md-8 d-flex gap-2">
      <input type="text" id="searchInput" class="form-control" placeholder="Search responses..." @if($total_responses == 0) disabled @endif>
      <button type="button" class="btn btn-outline-secondary" id="sortButton" title="Sort">
        <i class="fas fa-sort"></i>
      </button>
    </div>
  </form>
</div>



<style>
 #loading-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px 40px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
    z-index: 1000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 200px;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #14a058; /* Green to match your site color */
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 15px;
}

.loading-text {
    font-size: 16px;
    font-weight: 500;
    color: #333;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
 


<div class="text">Filtered Result  - Table</div>

                <div class="card  " style="border-radius: 5px;">
                    
                    <div class="card-body" style="padding:0px;border-radius: 20px; ">
                        <div class="table-responsive" id="dataContainer">
                       

                        
                        <table class="table table-bordered" id="responsesTable">

                            <thead class="table">
                                    <tr>
        
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(0)">No.</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(1)">Age</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none"onclick="sortTable(2)">Sex</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none;width:300px;"onclick="sortTable(3)">Customer Type</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none;width:300px;"onclick="sortTable(4)">Office</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none;width:300px;" onclick="sortTable(4)"    >Section</th>

        <th style="background-color: rgb(4, 59, 125);color:white;border:none;" onclick="sortTable(5)">Service Availed</th>
        <!-- <th style="background-color: rgb(4, 59, 125);color:white;border:none"onclick="sortTable(6)">SQD1</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(7)">SQD2</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(8)">SQD3</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(9)">SQD4</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(10)">SQD5</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(11)">SQD6</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(12)">SQD7</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(13)">SQD8</th> -->
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(14)">Remarks</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(15)">Average </th>
                                    </tr>
                                </thead>
                              
                            
                                <tbody>  
                            
                                @php
                                                    $count = 0;
                                            @endphp

                                    @foreach ($responses as $response)
                                    <tr class="response-row" data-office="{{ $response->office_transacted_with }}">
                                            @php
                                                    $count++;
                                            @endphp
                                            <td class="row-number"> </td> <!-- Row number --> 
                                            <td>{{ $response->age }}</td>
                                            <td>{{ $response->sex }}</td>
                                            <td class="customer-type">{{ $response->customerType }}</td>
                                            <td  class="office-transacted">{{ $response->main_office }}</td>
                                            <td class="section">{{ $response->office_transacted_with }}</td>
                                           
                                            <td class="service">{{ $response->service_availed }}</td>
                                            <!-- <td>{{ $response->sqd1 }}</td>
                                            <td>{{ $response->sqd2 }}</td>
                                            <td>{{ $response->sqd3 }}</td>
                                            <td>{{ $response->sqd4 }}</td>
                                            <td>{{ $response->sqd5 }}</td>
                                            <td>{{ $response->sqd6 }}</td>
                                            <td>{{ $response->sqd7 }}</td>
                                            <td>{{ $response->sqd8 }}</td> -->
                                            <td>{{ $response->remarks }}</td>
                                            <td>
                                                @php
                                                    $values = [
                                                        $response->sqd1, $response->sqd2, $response->sqd3,
                                                        $response->sqd4, $response->sqd5, $response->sqd6,
                                                        $response->sqd7, $response->sqd8
                                                    ];
                                                    $numericValues = array_filter($values, fn($val) => is_numeric($val) && $val !== 'N/A');
                                                    $average = count($numericValues) ? round(array_sum($numericValues) / count($numericValues), 2) : 'N/A';
                                                @endphp
                                                {{ $average }}
                                            </td>
                                        </tr>
                                    @endforeach  

                                </tbody>


                     
                            </table>
</div>
                            <div id="noDataContainer" style="display: none;margin-top:50px; text-align: center; font-size: 18px; color: red;">
   

<div class="alert alert-light border text-center p-4 mx-auto mt-3" role="alert" style="max-width: 98%;">
    <div class="mb-3">
    <img class="svg" src="{{ asset('not-found.svg') }}" alt="SVG Image" style="width:70px">
    </div>
    <h5 class="text-secondary mb-2">No data found for the selected filters.</h5>
    <p class="text-muted mb-0">There were no recorded survey responses matching your selection.</p>
</div> 


</div>
                        
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




<script src="{{ asset('js/admin_survey_list.js') }}"></script>