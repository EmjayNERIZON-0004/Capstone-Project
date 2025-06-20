@extends('layout.general_layout')

<title>@yield('title', 'Admin Dashboard')</title>
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">

<div class="wrapper">
    
    <div class="content">
        
        <style>
            @media (max-width: 768px) {
                .feedback-card {
                    flex-direction: column;
                    text-align: center;
                }
                .feedback-item {
                    width: 100%;
                }
            }

            .feedback-item {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: #f8f9fa;
                border-radius: 10px;
                box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.15);
                padding: 20px;
                width: 150px;
                height: 150px;
                flex-basis: 150px;
                text-align: center;
                border: 1px solid #dee2e6;
            }

            .feedback-count {
                position: absolute;
                top: 8px;
                right: 8px;
                background: #dc3545;
                color: #fff;
                font-size: 0.85rem;
                font-weight: bold;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .feedback-label {
                font-size: 1rem;
                color: #6c757d;
                margin-top: 4px;
            }

            .feedback-button {
                margin-top: 10px;
                font-size: 0.8rem;
                padding: 6px 12px;
                background: #e9ecef;
                color: #495057;
                border: 1px solid #ced4da;
                border-radius: 5px;
                transition: all 0.2s ease-in-out;
                letter-spacing: 2px;
            }

            .feedback-icon {
                width: 40px;
                height: 40px;
                display: block;
                margin: 0 auto;
            }

            .chart-container {
                width: 100%;
                height: 300px;
                margin-top: 20px;
            }
        </style>

<style>
         
        .dashboard-header {
            background-color: rgb(20, 160, 88);
            color: white;
            font-size: 30px;
            text-align: left;
            padding: 10px 20px 10px 10px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            width: fit-content;
            transform: translateY(-40px);
            margin-left: 10px;
            margin-right: 10px;
        }
        
       
        
        .svg {
        width: 100%;
        max-width: 50px;
        height: auto;
    }
    
    @media (max-width: 576px) {
        .svg {
            max-width: 50px;  /* Smaller image for mobile */
        }
    }
    </style>
 <div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Office Remarks Dashboard</h2>
    <h4 class="text" id="quarter-display"> </h4>
  </div>

  <!-- Dashboard Cards Container -->
  <div class="dashboard-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 15px;">

    <!-- Total Responses -->
    <div class="dashboard-card" style="flex: 1 1 calc(25% - 15px);">
      <div class="card-body" style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
       
            <h2 id="total-responses" class="card-number text-primary">0</h2>
      
          <div style="background-color: #2196F3; padding: 10px; border-radius: 50%;">
            <svg width="50" height="50" fill="#fff" viewBox="0 0 512 512">
              <path d="M32 32C14.3 32 0 46.3 0 64V448c0 17.7 14.3 32 32 
                32H480c17.7 0 32-14.3 32-32V416c0-8.8-7.2-16-16-16s-16 
                7.2-16 16v32H48V64H464V96c0 8.8 7.2 16 16 
                16s16-7.2 16-16V64c0-17.7-14.3-32-32-32H32zM96 
                384H160c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H96c-8.8 
                0-16 7.2-16 16V368c0 8.8 7.2 16 16 
                16zm128 0h64c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H224c-8.8 
                0-16 7.2-16 16V368c0 8.8 7.2 16 16 
                16zm128 0h64c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H352c-8.8 
                0-16 7.2-16 16V368c0 8.8 7.2 16 16 16z"/>
            </svg>
          </div>
        </div>

            <h5 class="card-title">Total Responses</h5>

        <p class="card-subtext">Survey forms submitted</p>
      </div>
    </div>

    <!-- Complaints -->
    <div class="dashboard-card" style="flex: 1 1 calc(25% - 15px);">
      <div class="card-body" style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h2 id="complaints-count" class="card-number text-danger">0</h2>
           
        
          <div style="background-color: #dc3545; padding: 10px; border-radius: 50%;">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="#fff">
              <circle cx="12" cy="12" r="10" fill="#ffffff"/>
              <line x1="12" y1="7" x2="12" y2="14" stroke="#dc3545" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12" cy="17" r="1.5" fill="#dc3545"/>
            </svg>
          </div>
        </div>
            <h5 class="card-title">Complaints</h5>

        <p class="card-subtext">Negative feedback received</p>
      </div>
    </div>

    <!-- Feedbacks -->
    <div class="dashboard-card" style="flex: 1 1 calc(25% - 15px);">
      <div class="card-body" style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
         
            <h2 id="feedbacks-count" class="card-number text-success">0</h2>
         
          <div style="background-color: #4CAF50; padding: 10px; border-radius: 50%;">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="#fff">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 
                2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
          </div>
        </div>
            <h5 class="card-title">Feedbacks</h5>

        <p class="card-subtext">General feedback</p>
      </div>
    </div>

    <!-- Recommendations -->
    <div class="dashboard-card" style="flex: 1 1 calc(25% - 15px);">
      <div class="card-body" style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
         
            <h2 id="recommendations-count" class="card-number text-warning">0</h2>
           
          <div style="background-color: #FFC107; padding: 10px; border-radius: 50%;">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="white">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 
                1.19 4.47 3 5.74V17a2 2 0 0 0 2 
                2h4a2 2 0 0 0 2-2v-2.26c1.81-1.27 
                3-3.36 3-5.74 0-3.87-3.13-7-7-7z"/>
              <rect x="9" y="18" width="6" height="3" rx="1" fill="#ffffff"/>
              <line x1="10" y1="13" x2="14" y2="13" stroke="black" stroke-width="1.5"/>
            </svg>
          </div>
        </div>
            <h5 class="card-title">Recommendations</h5>

        <p class="card-subtext">Suggestions for improvement</p>
      </div>
    </div>

  </div>


  <div class="dashboard-container mt-3" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 15px;">

  <div class="dashboard-card" style="flex: 1 1 calc(50% - 20px);">
      <div class="card-body" style="border: none;">
    <div class="  d-flex align-items-center justify-content-between flex-wrap gap-3">
        
        <!-- Left: Titles and Form -->
        <div class="d-flex flex-column">
            <h2 class="card-number text-success mb-1">Filter</h2>
            <h5 class="card-title ">Select the quarter and year  </h5>

          <p class="card-subtext">Fetching the Data</p>
        </div>

        <!-- Right: Icon -->
        <div class="stat-icon total-icon d-flex align-items-center justify-content-center" style="padding: 10px; background-color: #28a745; border-radius: 50%; min-width: 60px; min-height: 60px;">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="50" height="50">
                <path d="M3 4h18v2l-7 8v5l-4 1v-6L3 6V4z"/>
            </svg>
        </div>
    </div>

       
      </div>


       <!-- Filter Form -->
                <form id="surveyForm" class="d-flex flex-wrap gap-3 align-items-center m-0">
                    <!-- Year -->
                    <div class="form-group d-flex align-items-center gap-2" style="min-width: 180px;">
                        <label for="year" class="stat-label mb-0">Year</label>
                        <select name="year" id="year" class="form-select form-select-sm">
                            @foreach($years_cb as $year)
                                <option value="{{ $year }}" {{ (request('year') ?? $currentYear) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quarter -->
                    <div class="form-group d-flex align-items-center gap-2" style="min-width: 200px;">
                        <label for="quarter" class="stat-label mb-0">Quarter</label>
                        <select name="quarter" id="quarter" class="form-select form-select-sm">
                            @foreach($quarter_cb as $quarter)
                                <option value="{{ $quarter }}" {{ (request('quarter') ?? $currentQuarter) == $quarter ? 'selected' : '' }}>
                                    Q{{ $quarter }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form> 
</div>


    <div class="dashboard-card mb-3" style="flex: 1 1 calc(50% - 20px);">
    <div class="card-body d-flex justify-content-between" style="border: none;">
      <div>
        <h6 class="mb-2"><strong>About this page</strong></h6>
        <p class="mb-0 text-muted  " style="max-width: 85%;font-size:14px">
      This dashboard presents insights based on the remarks
       submitted by clients,
        including <b>feedback</b>, <b>complaints</b>, and <b>recommendations</b>. 
       It visualizes response counts and distribution across offices, sections, and services, 
      offering a clearer view of engagement and public sentiment.
      </div>
     
  <div style="width: 100px; height: 100px;  ">
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

</div>

 <script>
    document.addEventListener("DOMContentLoaded", function() {
    // Set default values for dropdown selectors
    const yearSelect = document.getElementById('year');
    const quarterSelect = document.getElementById('quarter');
    
    // Initial fetch with current values
    fetchAndUpdateDashboard();
    
    // Add event listeners to dropdowns
    yearSelect.addEventListener('change', function() {
        fetchAndUpdateDashboard();
    });
    
    quarterSelect.addEventListener('change', function() {
        fetchAndUpdateDashboard();
    });
    
    // Function to fetch data and update the dashboard
    function fetchAndUpdateDashboard() {
        const selectedYear = yearSelect.value || new Date().getFullYear();
        const selectedQuarter = quarterSelect.value || Math.ceil((new Date().getMonth() + 1) / 3);
        
        // Update the quarter display
        document.getElementById('quarter-display').textContent = `Q${selectedQuarter} ${selectedYear}`;
           const resultDiv = document.getElementById('result');
        if (resultDiv) {
            resultDiv.textContent = `Q${selectedQuarter} ${selectedYear} Result`;
        }
        // Clear previous office cards
        document.getElementById('offices-container').innerHTML = '';
        
        // Fetch data with selected quarter and year
        fetch(`/Admin/OfficesRemarks/${selectedQuarter}/${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                let totalResponses = 0;
                let totalComplaints = 0;
                let totalFeedbacks = 0;
                let totalRecommendations = 0;
                
                // Calculate totals from all offices
                data.forEach(office => {
                    totalResponses += office.total_responses;
                    totalComplaints += office.complaints;
                    totalFeedbacks += office.feedbacks;
                    totalRecommendations += office.recommendations;
                });
                
                // Update the dashboard
                document.getElementById('total-responses').textContent = totalResponses;
                document.getElementById('complaints-count').textContent = totalComplaints;
                document.getElementById('feedbacks-count').textContent = totalFeedbacks;
                document.getElementById('recommendations-count').textContent = totalRecommendations;
                
                // Generate office cards
                renderOfficeCards(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                // For demo purposes, set some example data if fetch fails
                document.getElementById('total-responses').textContent = '245';
                document.getElementById('complaints-count').textContent = '78';
                document.getElementById('feedbacks-count').textContent = '124';
                document.getElementById('recommendations-count').textContent = '43';
            });
    }
    
    // Variable storage for notification functionality
    let selectedOfficeId = null;
    let selectedComplaintCount = null;
    
    // Set up notification confirmation button event listener
    const confirmNotifyBtn = document.getElementById("confirmNotifyBtn");
    confirmNotifyBtn.addEventListener('click', function() {
        if (!selectedOfficeId || !selectedComplaintCount) return;

        fetch('/notifications/send-complaint', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                office_id: selectedOfficeId,
                title: "Complaint Alert ",
                message: `You have ${selectedComplaintCount} complaint(s) for this quarter.  `
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("✅ Response Received:", data);
            showSuccessMessage("Alert Notification sent to the Office successfully!");
        })
        .catch(error => {
            console.error('❌ Error:', error);
            alert("❌ Failed to send notification.");
        });

        // Close the confirmation modal after action
        var confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        confirmModal.hide();
    });
    
    // Function to render office cards
    function renderOfficeCards(data) {
        const officesContainer = document.getElementById('offices-container');
        
        data.forEach(office => {
            // Create the office card
            const officeCard = document.createElement('div');
            officeCard.classList.add('col-12');
            const selectedYear = parseInt(yearSelect.value) || new Date().getFullYear();
            const selectedQuarter = parseInt(quarterSelect.value) || Math.ceil((new Date().getMonth() + 1) / 3);

            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear();
            const currentQuarter = Math.ceil(currentMonth / 3);

            // Inside your rendering loop
            const isCurrentPeriod = selectedQuarter === currentQuarter && selectedYear === currentYear;

            // Generate the HTML structure for each office in table format
           officeCard.innerHTML = `
<div class="card mb-4 shadow-sm  " style="border:1px solid #ccc">
 <div class="card-header d-flex justify-content-between align-items-center  bg-white"  >
  <div>
    <h5 class="mb-1 card-number" style="letter-spacing: 0.5px;">${office.office_name} Office</h5>
   <!-- <small class="opacity-90 card-title">Total Responses: ${office.total_responses}</small> -->
  </div>
  <div class="p-2 bg-white    text-center" style="min-width: 100px; border-radius: 10px; border:1px solid #ccc">
    <div class="text-muted" style="font-size: 16px;">Total Responses</div>
    <div class="fw-bold text-primary" style="font-size: 24px;">${office.total_responses}</div>
</div>

</div>

  <div class="card-body p-3">
    Remarks Types Overview
    <!-- Feedback Dashboard Cards -->
    <div class="row g-3 mb-4">
      <!-- Complaints -->
      <div class="col-md-4">
        <div class="  rounded p-3 h-100 shadow-sm bg-white"style="border:1px solid#ccc">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
            <div class="card-number text-danger">${office.complaints}</div>
              <h6 class=" card-title mb-1">Complaints</h6>
            </div>
            <svg viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              width="32" height="32" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 9v2m0 4h.01M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/>
            </svg>
          </div>
          <button class="btn btn-sm btn-danger w-100 notify-btn"
            data-office-id="${office.office_id}"
            data-complaint-count="${office.complaints}"
            ${!isCurrentPeriod ? 'disabled' : ''}>
            Alert
          </button>
        </div>
      </div>

      <!-- Feedbacks -->
      <div class="col-md-4">
        <div class="  rounded p-3 h-100 shadow-sm bg-white"style="border:1px solid#ccc">

          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
            <div class="card-number  text-success">${office.feedbacks}</div>
            <h6 class="card-title mb-1">Feedbacks</h6>
            </div>
            <svg viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              width="32" height="32" xmlns="http://www.w3.org/2000/svg">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2z"/>
            </svg>
          </div>
          <a href="/view_feedbacks?office_name=${office.office_name}" class="btn btn-sm btn-success w-100">View</a>
        </div>
      </div>

      <!-- Recommendations -->
      <div class="col-md-4">
              <div class="  rounded p-3 h-100 shadow-sm bg-white"style="border:1px solid#ccc">

          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
            <div class="card-number   text-secondary">${office.recommendations}</div>
              <h6 class="card-title mb-1">Recommendations</h6>
            </div>
            <svg viewBox="0 0 24 24" fill="none" stroke="#404040" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              width="32" height="32" xmlns="http://www.w3.org/2000/svg">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
              <polyline points="7 10 12 15 17 10"/>
              <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
          </div>
          <a href="#" class="btn btn-sm btn-secondary w-100">Show</a>
        </div>
      </div>
    </div>

  
    <!-- Section Chart -->
    <table class="table table-bordered">
      <thead class="table-light">
         Section - Response Count Distribution
         <p class="text-muted">
This data presented show the count of survey responses in every sections.
         </p>
      </thead> 
      <tbody>
        <tr>
          <td>
            <div class="chart-container" style="height: ${office.sub_offices.length * 25 + 100}px;">
              <canvas id="subOfficesChart-${office.office_id}"></canvas>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Services Chart -->
    <table class="table table-bordered">
      <thead class="table-light">
              Service - Response Count Distribution
 <p class="text-muted">
This data presented show the count of survey responses in every services.
         </p>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="chart-container" style="height: ${getServiceCount(office) * 25 + 100}px;">
              <canvas id="servicesChart-${office.office_id}"></canvas>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
`;

            officesContainer.appendChild(officeCard);

            // Add event listener to the Alert button
            const alertButton = officeCard.querySelector('.notify-btn');
            alertButton.addEventListener('click', function() {
                selectedOfficeId = this.getAttribute("data-office-id");
                selectedComplaintCount = this.getAttribute("data-complaint-count");
       
                var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            });
             
            // Create charts
         
            createSubOfficesChart(office.office_id, office);
            createServicesChart(office.office_id, office);
        });
    }
});

// Helper function to count total services across all sub-offices
function getServiceCount(office) {
    let count = 0;

    if (office.sub_offices && Array.isArray(office.sub_offices)) {
        office.sub_offices.forEach(sub => {
            if (sub.services) count += sub.services.length;
        });
    }

    if (office.other_requests && Array.isArray(office.other_requests)) {
        count += office.other_requests.length;
    }

    return count;
}
 

// Function to create sub-offices chart
function createSubOfficesChart(officeId, office) {
    const ctx = document.getElementById('subOfficesChart-' + officeId).getContext('2d');
    
    const subOfficeLabels = [];
    const subOfficeData = [];
    const serviceColors = [];
    const colorMap = {};
    
    office.sub_offices.forEach((subOffice, index) => {
        const predefinedHues = [140, 220, 0, 55];
        const hue = predefinedHues[index % predefinedHues.length];
        colorMap[subOffice.sub_office_name] = `hsl(${hue}, 70%, 50%)`;
        colorMap[subOffice.sub_office_name] = `hsl(${hue}, 60%, 50%)`;
    });
    
    office.sub_offices.forEach(subOffice => {
        serviceColors.push(colorMap[subOffice.sub_office_name]);
    });
    
    office.sub_offices.forEach(subOffice => {
        subOfficeLabels.push(subOffice.sub_office_name);
        
        let totalResponses = 0;
        subOffice.services.forEach(service => {
            totalResponses += service.responses;
        });
        
        subOfficeData.push(totalResponses);
    });
  
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: subOfficeLabels,
            datasets: [{
                label: 'Total Responses',
                data: subOfficeData,
                backgroundColor: serviceColors,
                borderColor: '#ccc',
                borderWidth: 1,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            },
            elements: {
                bar: {
                    barThickness: 20
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "rgba(0,0,0,0.05)"
                    },
                    ticks: {
                        padding: 10
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            },
            layout: {
                padding: {
                    right: 40
                }
            }
        }
    });
}

// Function to create services chart
function createServicesChart(officeId, office) {
    const ctx = document.getElementById('servicesChart-' + officeId).getContext('2d');
    
    const serviceLabels = [];
    const serviceData = [];
    const serviceColors = [];
    const colorMap = {};
    
    office.sub_offices.forEach((subOffice, index) => {
        const predefinedHues = [140, 220, 0, 55];
        const hue = predefinedHues[index % predefinedHues.length];
        colorMap[subOffice.sub_office_name] = `hsl(${hue}, 60%, 50%)`;
    });
    
    office.sub_offices.forEach(subOffice => {
        subOffice.services.forEach(service => {
            serviceLabels.push(`${service.service_name} (${subOffice.sub_office_name})`);
            serviceData.push(service.responses);
            serviceColors.push(colorMap[subOffice.sub_office_name]);
        });
    });
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: serviceLabels,
            datasets: [{
                label: 'Responses',
                data: serviceData,
                backgroundColor: serviceColors,
                borderColor: serviceColors,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            },        
            elements: {
                bar: {
                    barThickness: 20
                }
            },  
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "rgba(0,0,0,0.05)"
                    },
                    ticks: {
                        padding: 10
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            },
            layout: {
                padding: {
                    right: 45
                }
            }
        }
    });
}
 </script>










 


        <div class="container my-1"> 
 <div class="text" id="result">Result</div>
    
            <div class="row g-3" id="offices-container"></div>




        </div>


<!-- Plain Success Message Modal with X Close Button -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">

            <!-- Top-right Close Button -->
            <div class="text-end p-2" >
                <button type="button" class="btn-close" id="closeSuccessModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="transform: translateY(-15px);">
                <i class="fas fa-check fa-3x text-success mb-2"></i>
                <h5 id="successMessage">Action completed successfully!</h5>
            </div>

        </div>
    </div>
</div>

<script>
    function showSuccessMessage(message) {
        document.getElementById('successMessage').innerText = message;

        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        // Automatically close the modal when OK button is clicked
        document.getElementById('closeSuccessModal').addEventListener('click', function() {
            successModal.hide(); // Explicitly hide the modal
        });
    }
</script><div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">

            <div class="modal-body p-3">
            <i class="fas fa-bell fa-2x text-danger mb-2"></i>
                <h5 class="fw-bold mb-2">Sending alert notification...</h5>
                <p class="text-muted mb-4">
                   Are you sure to send an alert notification ?
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button style="border:1px solid #ccc" type="button" class="btn btn-light px-3 " data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary px-3" id="confirmNotifyBtn">
                        Confirm
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@include('components.alert')
<!-- <script>
      document.addEventListener("DOMContentLoaded", function() {
    let selectedOfficeId = null;
    let selectedComplaintCount = null;

    document.querySelectorAll(".notify-btn").forEach(button => {
        button.addEventListener("click", function() {
               alert("button click"); 
               selectedOfficeId = this.getAttribute("data-office-id");
            selectedComplaintCount = this.getAttribute("data-complaint-count");

            console.log("✅ Button Clicked! Office ID:", selectedOfficeId, "Complaints:", selectedComplaintCount);
        
            // Show confirmation modal
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        });
    });

    // When user confirms notification
    document.getElementById("confirmNotifyBtn").addEventListener("click", function() {
        if (!selectedOfficeId || !selectedComplaintCount) return;

        fetch('/notifications/send-complaint', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                office_id: selectedOfficeId,
                title: "Complaint Alert ",
                message: `You have received ${selectedComplaintCount} complaint(s).  `
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("✅ Response Received:", data);
            showSuccessMessage("Notification sent to the Office successfully!");
        })
        .catch(error => {
            console.error('❌ Error:', error);
            alert("❌ Failed to send notification.");
        });

        // Close the confirmation modal after action
        var confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        confirmModal.hide();
    });
  });
</script> -->

    </div>
</div>
 
@endsection