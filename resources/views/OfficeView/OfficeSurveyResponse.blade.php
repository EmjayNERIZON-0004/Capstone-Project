@extends('layout.layout_office')
<title>@yield('title', session('office_name'))</title>


<style>
    /* Base styles */
    .container {
       font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    
    /* Responsive font size and table styling */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 12px;
        text-align: center;
    }
    
    @media (max-width: 992px) {
        table {
            font-size: 14px;
        }
        th, td {
            padding: 10px;
        }
    }
    
    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }
        th, td {
            padding: 8px;
        }
    }
    
    @media (max-width: 576px) {
        table {
            font-size: 11px;
        }
        th, td {
            padding: 6px 4px;
        }
        .header-title {
            font-size: 24px !important;
            height: 50px !important;
        }
    }
    
    /* SQD Cards */
    .sqd-card {
        padding: 15px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        font-weight: bold;
        color: white;
    }
    
    /* Header styling */
    .header-title {
        background-color: rgb(20, 160, 88);
        width: fit-content;
        height: 60px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        color: white;
        font-size: 30px;
        text-align: left;
        padding: 10px 20px;
        transform: translateY(-20px);
        border-radius: 5px;
        margin-right: auto;
        margin-left: 10px;
    }
    
    /* Filter container */
    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    
    @media (max-width: 576px) {
        .filter-group {
            min-width: 100%;
        }
    }
    
    /* Stats and SVG container */
    .stats-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .dropdowns {
        display: flex;
        flex-direction: column;
        gap: 15px;
        flex: 1;
        min-width: 250px;
    }
    
    .svg-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-left: auto;
    }
    
    .img_svg {
        width: 180px;
        height: auto;
        transition: all 0.3s ease;
    }
    
    .count-badge {
        background-color: #f8f9fa;
        padding: 8px 15px;
        border-radius: 20px;
        border: 1px solid #dee2e6;
        margin-top: 10px;
        font-size: 14px;
    }
    
    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
    
    .empty-state img {
        width: 100px;
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .svg-container {
            margin: 0 auto;
            transform: translateY(0);
        }
        
        .img_svg {
            width: 140px;
        }
    }
     
    
    .text-gray-800 {
        color: #5a5c69 !important;
    }
    
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    }
</style>

@section('content')
<div class="container pt-4 pb-5 p-0">
<div style="
    background-color: #ffffff;
    color: #212529;
    padding: 20px 28px;
    border-left: 4px solid #0d6efd;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    border-radius: 8px;
    margin: 16px 0;
">
    <div style="font-size: 26px; font-weight: 600; margin-bottom: 6px;">
        Survey Responses List
    </div>
    <div style="font-size: 15px; color: #6c757d;">
        All recorded customer survey submissions within the selected period (Quarterly)
    </div>
</div>



   <div class="row mb-1">
        <!-- Submitted Services Card -->
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card border-left-success h-100 shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters  ">
                        <div class="col-auto"  >
                      <div class="col-auto align-self-start"  >
  <div style="background-color:rgb(10, 148, 63);border-radius:50px;padding:10px">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-check-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
    </svg>
  </div>
</div>

                        </div>
                        <div class="col ml-3">
                    <div class="text-lg   text-success   mb-1" style="font-size:24px;  ">Row Count</div>
                    <div class="text-muted" id="output">  </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" style="font-weight: bold;" id="countNumber"> </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- a --> 
    <div class="col-md-4 col-sm-6 mb-3">
            <div class="card border-left-success h-100 shadow-sm">
                    <div class="card-body">
                        <div class="row no-gutters  ">
                            <div class="col-auto"  >
                        <div class="col-auto align-self-start"  >
    <div style="background-color:#0d6efd;border-radius:50px;padding:10px">
    <svg fill="#ffffff" 
    width="50" height="50"
    viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M 12.6952 4.6562 L 43.3280 4.6562 C 43.1874 2.6875 42.0624 1.6328 39.9062 1.6328 L 16.1171 1.6328 C 13.9609 1.6328 12.8358 2.6875 12.6952 4.6562 Z M 8.1015 11.1484 L 47.9454 11.1484 C 47.5936 9.0156 46.5625 7.8438 44.2187 7.8438 L 11.8046 7.8438 C 9.4609 7.8438 8.4531 9.0156 8.1015 11.1484 Z M 10.2343 54.3672 L 45.7888 54.3672 C 50.6641 54.3672 53.1251 51.9297 53.1251 47.1016 L 53.1251 22.2109 C 53.1251 17.3828 50.6641 14.9453 45.7888 14.9453 L 10.2343 14.9453 C 5.3358 14.9453 2.8749 17.3594 2.8749 22.2109 L 2.8749 47.1016 C 2.8749 51.9297 5.3358 54.3672 10.2343 54.3672 Z M 10.3046 50.5938 C 7.9609 50.5938 6.6484 49.3281 6.6484 46.8906 L 6.6484 22.3984 C 6.6484 19.9609 7.9609 18.7187 10.3046 18.7187 L 45.7187 18.7187 C 48.0390 18.7187 49.3513 19.9609 49.3513 22.3984 L 49.3513 46.8906 C 49.3513 49.3281 48.0390 50.5938 45.7187 50.5938 L 42.8124 50.5938 C 40.8905 46.2813 35.9218 41.5703 27.9765 41.5703 C 20.0546 41.5703 15.0624 46.2813 13.1640 50.5938 Z M 27.9765 38.3125 C 31.9374 38.3360 35.1249 34.7266 35.1249 30.4609 C 35.1249 26.2656 31.9374 22.8438 27.9765 22.8438 C 24.0155 22.8438 20.8280 26.2656 20.8280 30.4609 C 20.8515 34.7266 24.0155 38.2656 27.9765 38.3125 Z"></path></g></svg>

    </div>
    </div>

                            </div>
                            <div class="col ml-3">
                                <div class="text-lg   text-primary   " style="font-size:24px;  ">Overall Responses  </div>
                        <div class="text-muted mb-1"  >  as of {{$currentYear}}</div>
                            
                                <div class="h4 mb-0   text-gray-800" id="submitted-count"><b>{{$overall_responses_count}}</b></div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>    <div class="col-md-4 col-sm-6 mb-3">
            <div class="card border-left-success h-100 shadow-sm">
                    <div class="card-body">
                        <div class="row no-gutters  ">
                            <div class="col-auto"  >
                        <div class="col-auto align-self-start"  >
    <div style="background-color:#0d6efd;border-radius:50px;padding:10px">
    <svg fill="#ffffff" 
    width="50" height="50"
    viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M 12.6952 4.6562 L 43.3280 4.6562 C 43.1874 2.6875 42.0624 1.6328 39.9062 1.6328 L 16.1171 1.6328 C 13.9609 1.6328 12.8358 2.6875 12.6952 4.6562 Z M 8.1015 11.1484 L 47.9454 11.1484 C 47.5936 9.0156 46.5625 7.8438 44.2187 7.8438 L 11.8046 7.8438 C 9.4609 7.8438 8.4531 9.0156 8.1015 11.1484 Z M 10.2343 54.3672 L 45.7888 54.3672 C 50.6641 54.3672 53.1251 51.9297 53.1251 47.1016 L 53.1251 22.2109 C 53.1251 17.3828 50.6641 14.9453 45.7888 14.9453 L 10.2343 14.9453 C 5.3358 14.9453 2.8749 17.3594 2.8749 22.2109 L 2.8749 47.1016 C 2.8749 51.9297 5.3358 54.3672 10.2343 54.3672 Z M 10.3046 50.5938 C 7.9609 50.5938 6.6484 49.3281 6.6484 46.8906 L 6.6484 22.3984 C 6.6484 19.9609 7.9609 18.7187 10.3046 18.7187 L 45.7187 18.7187 C 48.0390 18.7187 49.3513 19.9609 49.3513 22.3984 L 49.3513 46.8906 C 49.3513 49.3281 48.0390 50.5938 45.7187 50.5938 L 42.8124 50.5938 C 40.8905 46.2813 35.9218 41.5703 27.9765 41.5703 C 20.0546 41.5703 15.0624 46.2813 13.1640 50.5938 Z M 27.9765 38.3125 C 31.9374 38.3360 35.1249 34.7266 35.1249 30.4609 C 35.1249 26.2656 31.9374 22.8438 27.9765 22.8438 C 24.0155 22.8438 20.8280 26.2656 20.8280 30.4609 C 20.8515 34.7266 24.0155 38.2656 27.9765 38.3125 Z"></path></g></svg>

    </div>
    </div>

                            </div>
                            <div class="col ml-3">
                                <div class="text-lg   text-primary   " style="font-size:24px;  ">Overall Responses  </div>
                        <div class="text-muted mb-1"  >  as of {{$currentYear}}</div>
                            
                                <div class="h4 mb-0   text-gray-800" id="submitted-count"><b>{{$overall_responses_count}}</b></div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

<div class="col-md-6 col-sm-12 mb-3">
  <div class="card border-left-success h-100 shadow-sm"   >
    <div class="card-body">
      <div style="display: flex;   gap: 1rem;">
        <!-- Icon fixed size -->
        <div style="flex: 0 0 auto;">
          <div style="background-color: rgb(12, 173, 98); padding: 10px; border-radius: 50%;">
            <svg viewBox="0 0 24 24" width="50" height="50" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M16 4C16.93 4 17.395 4 17.7765 4.10222C18.8117 4.37962 19.6204 5.18827 19.8978 6.22354C20 6.60504 20 7.07003 20 8V17.2C20 18.8802 20 19.7202 19.673 20.362C19.3854 20.9265 18.9265 21.3854 18.362 21.673C17.7202 22 16.8802 22 15.2 22H8.8C7.11984 22 6.27976 22 5.63803 21.673C5.07354 21.3854 4.6146 20.9265 4.32698 20.362C4 19.7202 4 18.8802 4 17.2V8C4 7.07003 4 6.60504 4.10222 6.22354C4.37962 5.18827 5.18827 4.37962 6.22354 4.10222C6.60504 4 7.07003 4 8 4M9.6 6H14.4C14.9601 6 15.2401 6 15.454 5.89101C15.6422 5.79513 15.7951 5.64215 15.891 5.45399C16 5.24008 16 4.96005 16 4.4V3.6C16 3.03995 16 2.75992 15.891 2.54601C15.7951 2.35785 15.6422 2.20487 15.454 2.10899C15.2401 2 14.9601 2 14.4 2H9.6C9.03995 2 8.75992 2 8.54601 2.10899C8.35785 2.20487 8.20487 2.35785 8.10899 2.54601C8 2.75992 8 3.03995 8 3.6V4.4C8 4.96005 8 5.24008 8.10899 5.45399C8.20487 5.64215 8.35785 5.79513 8.54601 5.89101C8.75992 6 9.03995 6 9.6 6Z"
                stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
        </div>

        <!-- Chart, flexible and shrinks -->
        <div style="flex: 1 1 auto; min-width: 0;">
          <div class="text-muted mb-2">Survey Responses as of {{ $currentYear }}</div>
          <div style="position: relative; width: 100%; height: 80%; max-width: 100%;">
            <canvas id="surveyQuarterChart" style="width: 100%; height: 80%; display: block;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-6 col-sm-12 mb-3">
  <div class="card border-left-success h-100 shadow-sm">
    <div class="card-body">
      <div style="display: flex; gap: 1rem;   ">
        <!-- Icon fixed size -->
        <div style="flex: 0 0 auto;">
          <div style="background-color:#0d6efd; padding: 10px; border-radius: 50%;   display: flex; align-items: center; justify-content: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                            </svg>
          </div>
        </div>
<style>@media (max-width: 576px) {
  
  .responsive-description {
    font-size: 14px !important;
  }
}
</style>
        <!-- Text content -->
        <div style="flex: 1 1 auto; min-width: 0;">
          <div class="text-lg text-primary" style="font-size: 24px; font-weight: normal;">
            About this page
          </div>
        <div class="text-muted mb-1 responsive-description">
  This dashboard for <strong>{{ session('office_name') }}</strong> shows the survey responses collected as of <strong>{{ $currentYear }}</strong>.  
  You can filter the surveys and view the total counts of responses.
</div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const labels = ['Q1', 'Q2', 'Q3', 'Q4'];
    const data = @json($quarterCounts);

    new Chart(document.getElementById('surveyQuarterChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Survey Responses',
                data: data,
                backgroundColor: 'rgba(40, 167, 69, 0.6)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
      options: {
          responsive: true,
    plugins: {
        legend: {
            display: false // ❌ Hides the dataset label box
        },
        tooltip: {
            enabled: true // ❌ Hides the hover tooltip
        }
    },
    scales: {
        y: { beginAtZero: true }
    }
}

    });
});
</script>

        </div>
<div class="text-muted">Filtering Survey</div>
    <div class="card shadow-sm">
         

        <div class="card-body">
            <form id="surveyForm">
                <div class="filter-container">
                    <div class="filter-group">
                        <label for="year">Select Year</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">Select Year</option>
                            @foreach($years_cb as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="quarter">Select Quarter</label>
                        <select name="quarter" id="quarter" class="form-select">
                            <option value="">Select Quarter</option>
                            @foreach($quarter_cb as $quarter)
                                <option value="{{ $quarter }}" {{ request('quarter') == $quarter ? 'selected' : '' }}>
                                    Quarter {{ $quarter }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="getData()">Get Data</button>
                    </div>
                </div>
            </form>

            <div class="stats-container">
                <div class="dropdowns">
                    <div>
                        <label for="subOfficeFilter" class="form-label"><b>Filter by Section:</b></label>
                        <select id="subOfficeFilter" class="form-select">
                            <option value="all">All Offices</option>
                            @foreach ($subOffices as $subOffice)
                                <option value="{{ $subOffice }}">{{ $subOffice }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="serviceFilter" class="form-label"><b>Filter by Service:</b></label>
                        <select id="serviceFilter" class="form-select">
                            <option value="all">All Services</option>
                            <option value="Other requests/inquiries">Other requests/inquiries</option>
                        </select>
                    </div>
                </div>

               
            </div>
        </div>
    </div>

                 <div class="text-muted mt-2">Filtered Result</div>

            @if($responses_count != 0)
                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table class="table table-bordered  " id="surveyTable">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Office</th>
                                <th>Service Availed</th>
                                <th>SQD1</th>
                                <th>SQD2</th>
                                <th>SQD3</th>
                                <th>SQD4</th>
                                <th>SQD5</th>
                                <th>SQD6</th>
                                <th>SQD7</th>
                                <th>SQD8</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($responses as $response)
                                <tr class="response-row" data-office="{{ $response->office_transacted_with }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $response->office_transacted_with }}</td>
                                    <td>{{ $response->service_availed }}</td>

                                    @php
                                        $values = [
                                            $response->sqd1, $response->sqd2, $response->sqd3, 
                                            $response->sqd4, $response->sqd5, $response->sqd6, 
                                            $response->sqd7, $response->sqd8
                                        ];
                                        $numericValues = array_filter($values, fn($v) => is_numeric($v) && $v !== 'N/A');
                                    @endphp

                                    @foreach ($values as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <img src="{{ asset('not-found.svg') }}" alt="No data found">
                    <h5 class="mb-2 text-secondary">No Data Found</h5>
                    <p class="mb-0 text-muted">There were no recorded survey responses matching your selection.</p>
                </div>
            @endif
        
</div>
@endsection

<script>
    // Function to get data based on selected quarter and year
    function getData() {
        var quarter = document.getElementById('quarter').value;
        var year = document.getElementById('year').value;
         
        if (quarter && year) {
            window.location.href = '/Office/SurveyList/' + quarter + '/' + year;
        } else {
            alert('Please select both a quarter and a year.');
        }
    }

    // DOM ready function
    document.addEventListener("DOMContentLoaded", function() {
        const subOfficeDropdown = document.getElementById("subOfficeFilter");
        const serviceDropdown = document.getElementById("serviceFilter");
        const rows = document.querySelectorAll(".response-row");
        const countNumber = document.getElementById("countNumber");
        var quarter = document.getElementById('quarter').value;
        var year = document.getElementById('year').value;
  var outputDiv = document.getElementById('output');
  outputDiv.innerText = "Q" + quarter + " " + year;
        // Function to update row count
        function updateRowCount() {
            const visibleRows = Array.from(rows).filter(row => row.style.display !== "none");
            countNumber.textContent = visibleRows.length;
        }

        // Office filter change event
        subOfficeDropdown.addEventListener("change", function() {
            const selectedOffice = this.value;

            // Reset service dropdown
            serviceDropdown.innerHTML = '<option value="all">All Services</option>';

            // Add "Other requests/inquiries" option
            const otherOption = document.createElement("option");
            otherOption.value = "Other requests/inquiries";
            otherOption.textContent = "Other requests/inquiries";
            serviceDropdown.appendChild(otherOption);

            // Fetch services for selected office
            if (selectedOffice !== "all") {
                fetch(`/get-services/${selectedOffice}`)
                    .then(response => response.json())
                    .then(services => {
                        services.forEach(service => {
                            const option = document.createElement("option");
                            option.value = service;
                            option.textContent = service;
                            serviceDropdown.appendChild(option);
                        });
                    });
            }

            // Filter table rows based on selected office
            rows.forEach(row => {
                const office = row.getAttribute("data-office");
                row.style.display = (selectedOffice === "all" || office === selectedOffice) ? "" : "none";
            });

            // Update row count
            updateRowCount();
        });

        // Service filter change event
        serviceDropdown.addEventListener("change", function() {
            const selectedService = this.value;
            const selectedOffice = subOfficeDropdown.value;

            // Handle "Other requests/inquiries" special case
            if (selectedService === "Other requests/inquiries") {
                rows.forEach(row => {
                    const office = row.getAttribute("data-office");
                    const service = row.children[2].textContent; // Assuming service is in the third column

                    if (office === selectedOffice || selectedOffice === "all") {
                        row.style.display = (service === "Other requests/inquiries") ? "" : "none";
                    } else {
                        row.style.display = "none";
                    }
                });
                updateRowCount();
                return;
            }

            // Regular service filtering
            rows.forEach(row => {
                const office = row.getAttribute("data-office");
                const service = row.children[2].textContent;

                if (office === selectedOffice || selectedOffice === "all") {
                    row.style.display = (selectedService === "all" || service === selectedService) ? "" : "none";
                } else {
                    row.style.display = "none";
                }
            });

            updateRowCount();
        });

        // Initialize row count on page load
        updateRowCount();
    });
</script>