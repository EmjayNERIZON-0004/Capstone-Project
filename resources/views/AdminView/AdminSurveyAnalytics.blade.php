@extends('layout.general_layout')

@section('title', 'Manage Requests')

@section('content')     
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
<div class="wrapper">


    <div class="content" >
   
   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Survey Analytics Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>


    


<style>
  
  
  label {
    font-weight: 600;
    color:rgb(62, 62, 63);
    margin-bottom: 0;
  }
  
  .select-control {
    border: 1px solid #ccc;
    border-radius: 4px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size:18px;
    padding: 8px 30px 8px 12px;
    background-color: white;
  
    color:black;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%235a5c69' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    min-width: 100px;
  }
  
  .data-btn {
    background-color: #4e73df;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 16px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-weight: 500;
    margin-left: auto; 
    align-items: center;
    gap: 8px;
  }
  
  .data-btn:hover {
    background-color: #2e59d9;
  }
  
  .data-btn i {
    font-size: 14px;
  }
  
  @media (max-width: 768px) {
    .filter-controls {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
    }
    
    .filter-group {
      width: 100%;
      justify-content: space-between;
    }
    
    .select-control {
      flex-grow: 1;
    }
    
    .data-btn {
      width: 100%;
      justify-content: center;
      margin-top: 10px;
      margin-left: 0;
    }
  }
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 
<script>
    // Get current date
const now = new Date();
const currentYear = now.getFullYear();
const currentMonth = now.getMonth(); // 0-11 (Jan-Dec)
const currentQuarter = Math.floor(currentMonth / 3) + 1; // Convert month to quarter (1-4)

// Set default selected values when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Set year dropdown to current year
    const yearDropdown = document.getElementById('yearDropdown');
    
    // Find the option with the current year, or default to the first option if not found
    let yearOption = yearDropdown.querySelector(`option[value="${currentYear}"]`);
    if (yearOption) {
        yearOption.selected = true;
    }
    
    // Set quarter dropdown to current quarter
    const quarterDropdown = document.getElementById('quarterDropdown');
    let quarterOption = quarterDropdown.querySelector(`option[value="${currentQuarter}"]`);
    if (quarterOption) {
        quarterOption.selected = true;
        getQuarterData();
        
    }
});
</script>

<style>
    .dashboard-card{
        max-height: 180px;
       
    }
</style>

  <div class="dashboard-container" style="  display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
        
     
  <!-- Total Responses Card -->
  <div class="dashboard-card " style="flex: 1 1 calc(20% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; align-items: center; justify-content: space-between;">
      
          <h2 id="totalResponses" class="card-number text-primary">0</h2>
          
          <div style="background-color: #2196F3; padding: 10px; border-radius: 50%;">
            <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 
             2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 
             10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 
             3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
  </svg>
</div>

</div>
<h5 class="card-title">Total Responses</h5>
      <p class="card-subtext">Survey forms submitted</p>
      
    </div>
  </div>

  <!-- Quarter & Year Card -->
  <div class="dashboard-card  " style="flex: 1 1 calc(20% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; align-items: center; justify-content: space-between;">
       
          <h2 id="quarterYear" class="card-number text-success">Q1 2025</h2>
         
        
        <div style="background-color: #4CAF50; padding: 10px; border-radius: 50%;">
          <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
            <path d="M3 4h18v2H3V4zm0 4h18v12H3V8zm2 2v8h14v-8H5z"/>
          </svg>
        </div>
      </div>
       <h5 class="card-title">Selected Period</h5>
      <p class="card-subtext">From selected filter</p>
    </div>
  </div>

  <!-- Quarter & Year Dropdown Card -->
<div class="dashboard-card" style="flex: 1 1 calc(30% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: flex-start; justify-content: space-between;">

      <!-- Left: Dropdowns + Button -->
      <div>
        <div class="filter-group mb-2">
          <label for="quarterDropdown" style="width: 80px; display: inline-block;">Quarter:</label>
          <select id="quarterDropdown" class="select-control" style="width: 250px;">
            <option value="1">Q1</option>
            <option value="2">Q2</option>
            <option value="3">Q3</option>
            <option value="4">Q4</option>
          </select>
        </div>

        <div class="filter-group mb-2">
          <label for="yearDropdown" style="width: 80px; display: inline-block;">Year:</label>
          <select id="yearDropdown" class="select-control" style="width: 250px;">
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
          </select>
        </div>
          <label for="yearDropdown" style="width: 80px; display: inline-block;"> </label>

        <button onclick="getQuarterData()" class="btn btn-primary" style="width: 250px;">Get Data</button>
      </div>

      <!-- Right: Icon -->
      <div style="background-color: #FF9800; padding: 10px; border-radius: 50%;">
        <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
          <path d="M4 4h16v2l-6 7v5l-4 2v-7L4 6V4z"/>
        </svg>
      </div>

    </div>
    
  </div>
</div>


  <!-- About this Page Card -->
  <div class="dashboard-card mb-3" style="flex: 1 1 calc(100% - 20px);">
    <div class="card-body d-flex justify-content-between" style="border: none;">
      <div>
        <h6 class="mb-2"><strong>About this page</strong></h6>
        <p class="mb-2 text-muted" style="max-width: 90%;">
          This dashboard presents analytics based on the <strong>survey data collected</strong> through forms. It highlights satisfaction rates, response counts, and breakdowns by quarter, year, and section performance.
        </p>
      </div>
     
  <div style="width: 50px; height: 50px;">
    <svg viewBox="0 0 24 24" fill="none" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      style="width: 100%; height: 100%;" xmlns="http://www.w3.org/2000/svg">
      <circle cx="12" cy="12" r="10"></circle>
      <line x1="12" y1="16" x2="12" y2="12"></line>
      <line x1="12" y1="8" x2="12.01" y2="8"></line>
    </svg>
  </div>
    </div>
  </div>

</div>

 





<script>function getQuarterData() {
    const selectedQuarter = document.getElementById('quarterDropdown').value;
    const selectedYear = document.getElementById('yearDropdown').value;
 
      // Update UI with the fetched data
         
    fetch(`/get-quarter-data?quarter=${selectedQuarter}&year=${selectedYear}`)
        .then(response => response.json())
        .then(data => {
            
    document.getElementById('totalResponses').innerText = data.totalResponses.toLocaleString();
             document.getElementById('quarterYear').innerText = `${data.quarter} ${data.year}`;
             getGender(selectedQuarter,selectedYear);
    getCustomerData(selectedQuarter, selectedYear);
    getSection(selectedQuarter, selectedYear);
    getOffice(selectedQuarter, selectedYear);
    getService(selectedQuarter, selectedYear);
           
            // Check if the data is empty or no responses found
            if (data.totalResponses === 0 || !data.ageSex.length || !data.customerTypes.length || !data.mainOffices.length || !data.subOffices.length || !data.services.length) {
                // Hide all the cards
                document.getElementById('dataContainer').style.display = 'none';

                // Display the "No data found" message
                document.getElementById('noDataContainer').style.display = 'block';
            } else {
                // Hide "No data found" message
                document.getElementById('noDataContainer').style.display = 'none';

                // Show all the cards
                document.getElementById('dataContainer').style.display = 'block';

                // Call function to update charts or other elements with the fetched data
                }
        })
        .catch(error => console.log(error));
}
 

</script>

<!-- This container will be shown when no data is found -->
<div id="noDataContainer" style="display: none;margin-top:50px; text-align: center; font-size: 18px; color: red;">
   

<div class="alert alert-light border text-center p-4 mx-auto mt-3" role="alert" style="max-width: 100%;">
    <div class="mb-3">
    <img class="svg" src="{{ asset('not-found.svg') }}" alt="SVG Image" style="width:70px">
    </div>
    <h5 class="mb-2 text-secondary">No data found for the selected quarter and year.</h5>
    
<p class="mb-0 text-muted">There were no recorded survey responses.</p>

</div> 


</div>


<!-- This container will hold your charts and data, initially hidden if no data is available -->
 <div class="text">Result</div>
<div id="dataContainer">
        <!-- Gender Section -->
        <div class="card p-4 mt-3">
            <h3>Gender</h3>
            <div id="ageSexInterpretation" class="mt-4"></div>

            <div style="width: 300px; height: 300px;">
                <div style="display: flex; padding-top: 20px;">
                    <div style="margin-right: 550px; padding-top: 50px;">
                        <div id="ageSexLegend" style="margin-left: 20px; max-width: 200px;"></div>
                    </div>
                    <canvas id="ageSexChart" width="400" height="400"></canvas>
                </div>
            </div>
            <br>
        </div>

        <!-- Customer Type Section -->
        <div class="card p-4 mt-4">
            <h3>Customer Type</h3>
            <div id="customerTypeInterpretation" class="mt-4"></div>

            <div style="width: 300px; height: 300px;">
                <div style="display: flex; padding-top: 20px;">
                    <div style="width: 800px; margin-right: 200px;">
                        <div id="customLegend" style="margin-left: 20px; margin-top: 50px; width: 500px;"></div>
                    </div>
                    <canvas id="customerTypeChart" width="400" height="400"></canvas>
                </div>
            </div>
            <br>
        </div>

        <!-- Main Office Section -->
        <div class="card p-4 mt-4">
            <h3>Main Office Responses</h3>

            <div style="width: 1100px; padding: 10px;">
                <div style="display: flex; padding-top: 20px; gap: 20px; margin-left: 10px;">
                    <div id="mainOfficeLegend" class="mt-3" style="flex: 1; width: 600px;"></div>
                    <div style="flex: 1;">
                        <canvas id="mainOfficeChart" width="600" height="200" style="border: 1px solid #ccc;"></canvas>
                    </div>
                </div>
                <div id="mainOfficeInterpretation" style="margin-top: 20px;"></div>

            </div>
        </div>

        <!-- Sub Office Section -->
        <div class="card p-4 mt-4">
            <h3>Office Responses</h3>
            <div style="width: 1100px; padding: 10px;">
                <div id="subOfficeChartsContainer" style="display: flex; flex-direction: column; gap: 40px;"></div>
            </div>
        </div>

        <!-- Service Responses Section -->
        <div class="card p-4 mt-4">
            <h3>Service Responses</h3>
            <div style="width: 1100px; padding: 10px;">
                <div id="serviceChartContainer" style="display: flex; flex-direction: column; gap: 40px;"></div>
            </div>
        </div>
</div>
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script src="{{ asset('js/gender.js') }}"></script>
        <script src="{{ asset('js/main_office.js') }}"></script>
        <script src="{{ asset('js/customer_type.js') }}"></script>
        <script src="{{ asset('js/sections.js') }}"></script>
        <script src="{{ asset('js/services.js') }}"></script>
    </div>
</div>
@endsection
