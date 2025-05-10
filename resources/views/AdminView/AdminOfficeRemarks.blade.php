@extends('layout.general_layout')

<title>@yield('title', 'Admin Dashboard')</title>
@section('content')

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
        
        .dashboard-card {
            border-radius: 10px;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.15);
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
            background-color: white;
            overflow: hidden;
        }
        
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 20px;
            font-weight: bold;
        }
        
        .stat-card {
            padding: 20px;
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
        }
        
        .total-icon {
            background-color: #3b7ddd;
        }
        
        .complaints-icon {
            background-color: #dc3545;
        }
        
        .feedbacks-icon {
            background-color: #28a745;
        }
        
        .recommendations-icon {
            background-color: #ffc107;
        }
        
        .stat-info {
            flex-grow: 1;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0;
            line-height: 1;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
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
        <div class="d-flex justify-content-between align-items-center mb-2 mt-5 p-2" style="background-color: white;
        
        border:1px solid #ddd;
        ">
            <div class="dashboard-header"  >Offices Status</div>
            <h5 style="margin-right: 20px; margin-top: 5px; font-family: sans-serif;
           font-size:1.5rem;
            "
            class="stat-label" 
            id="quarter-display"></h5>
             
      
        </div>

        <div class="row">
            <!-- Total Responses Card -->
            <style>
    .icon {
      width: 2.5em;
      height: 2.5em;
      color: #000; /* Change color as needed */
    }
  </style>
            <div class="col-6">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon total-icon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white">
    <path d="M32 32C14.3 32 0 46.3 0 64V448c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V416c0-8.8-7.2-16-16-16s-16 7.2-16 16v32H48V64H464V96c0 8.8 7.2 16 16 16s16-7.2 16-16V64c0-17.7-14.3-32-32-32H32zM96 384H160c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H96c-8.8 0-16 7.2-16 16V368c0 8.8 7.2 16 16 16zm128 0h64c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H224c-8.8 0-16 7.2-16 16V368c0 8.8 7.2 16 16 16zm128 0h64c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H352c-8.8 0-16 7.2-16 16V368c0 8.8 7.2 16 16 16z"/>
  </svg>
                        </div>
                        <div class="stat-info">
                            <p class="stat-value" id="total-responses">0</p>
                            <span class="stat-label">Total Responses</span>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon total-icon">
                        <svg  class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
  <path d="M3 4h18v2l-7 8v5l-4 1v-6L3 6V4z"/>
</svg>


                        </div>
                          <form id="surveyForm" class="row g-3 align-items-end">
                        <div class="col-md-4 col-sm-6" style=" width:190px">
                            <div class="form-group d-flex gap-2">
                            <label for="year" class="stat-label" >Year</label>

                                <select name="year" id="year" class="form-select form-select-lg">
                                     @foreach($years_cb as $year)
                                        <option value="{{ $year }}" 
                                            {{ (request('year') ?? $currentYear) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-8   " style=" width:230px; ">
                            <div class="form-group d-flex gap-2">
                               <label for="quarter" class="stat-label" >Quarter</label> 
                               <select name="quarter" id="quarter" class="form-select form-select-lg">
                                   
                                    @foreach($quarter_cb as $quarter)
                                    <option value="{{ $quarter }}" 
                                    {{ (request('quarter') ?? $currentQuarter) == $quarter ? 'selected' : '' }}>
                                     Q{{ $quarter }}
                                </option>
                                @endforeach
                            </select>
                            
                            </div>
                        </div>
                        
                        
                    </form>
                    
                    </div>
                </div>
            </div>
              
            <!-- Complaints Card -->
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon complaints-icon">
                        <svg class="feedback-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#dc3545">
                                            <circle cx="12" cy="12" r="10" fill="#ffffff"/>
                                            <line x1="12" y1="7" x2="12" y2="14" stroke="#dc3545" stroke-width="2" stroke-linecap="round"/>
                                            <circle cx="12" cy="17" r="1.5" fill="#dc3545"/>
                                        </svg>
                        </div>
                        <div class="stat-info">
                            <p class="stat-value" id="complaints-count">0</p>
                            <span class="stat-label">Complaints</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feedbacks Card -->
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon feedbacks-icon">
                        <svg class="feedback-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        </div>
                        <div class="stat-info">
                            <p class="stat-value" id="feedbacks-count">0</p>
                            <span class="stat-label">Feedbacks</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recommendations Card -->
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon recommendations-icon">
                        <svg class="feedback-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7z" fill="white"/>
                                            <rect x="9" y="18" width="6" height="3" rx="1" fill="#fffff"/>
                                            <line x1="10" y1="13" x2="14" y2="13" stroke="black" stroke-width="1.5"/>
                                        </svg>
                        </div>
                        <div class="stat-info">
                            <p class="stat-value" id="recommendations-count">0</p>
                            <span class="stat-label">Recommendations</span>
                        </div>
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

            // Generate the HTML structure for each office
            officeCard.innerHTML = `
                <div class="card shadow-sm border-0 rounded-3 bg-light w-100 mb-4">
                    <div class="card-body bg-light d-flex flex-column flex-md-row align-items-start p-3" style="margin-bottom: 10px;border: 1px solid #ddd; border-radius: 10px; box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.1);">
                        <div class="d-flex flex-column flex-shrink-0" style="min-width: 300px; max-width: 300px;">
                            <h5 class="text-dark fw-bold px-3 py-2 rounded" style="background-color: #f8f9fa; text-align: left; font-size: 28px;">
                                ${office.office_name} Office
                            </h5>
                            <p class="text-muted mt-1 px-3" style="font-size: 16px; font-weight: bold;">
                                Total Responses: ${office.total_responses}
                            </p>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-3 w-100 w-md-auto">
                            <div class="feedback-item">
                                <svg class="feedback-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#dc3545">
                                    <circle cx="12" cy="12" r="10" fill="#dc3545"/>
                                    <line x1="12" y1="7" x2="12" y2="14" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="12" cy="17" r="1.5" fill="white"/>
                                </svg>
                                <span class="feedback-count">${office.complaints}</span>
                                <small class="feedback-label">Complaints</small>
                             <button class="btn btn-sm btn-danger feedback-button notify-btn"
        data-office-id="${office.office_id}"
        data-complaint-count="${office.complaints}"
        ${!isCurrentPeriod ? 'disabled' : ''}>
        Alert
    </button>
                            </div>
                            <div class="feedback-item">
                                <svg class="feedback-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#28a745">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <span class="feedback-count">${office.feedbacks}</span>
                                <small class="feedback-label">Feedbacks</small>
                                <a href="/view_feedbacks?office_name=${office.office_name}" class="btn btn-sm btn-success feedback-button">View</a>
                            </div>
                            <div class="feedback-item">
                                <svg class="feedback-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7z" fill="orange"/>
                                    <rect x="9" y="18" width="6" height="3" rx="1" fill="#b5651d"/>
                                    <line x1="10" y1="13" x2="14" y2="13" stroke="yellow" stroke-width="1.5"/>
                                </svg>
                                <span class="feedback-count">${office.recommendations}</span>
                                <small class="feedback-label">Recommendations</small>
                                <a href="#" class="btn btn-sm btn-warning feedback-button">Show</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                    <div class="d-flex">
                         <img class="svg" src="{{ asset('analysis-title.svg') }}" alt="SVG Image"> 
                        <h5 class="card-title pt-3">Remarks Type - Responses</h5>
                        </div>
                        <div class="chart-container" style="height: 150px;">
                            <canvas id="responseTypeChart-${office.office_id}"></canvas>
                        </div>
                    </div>
                    
                    <div class="card-body">
                       <div class="d-flex">
                         <img class="svg" src="{{ asset('analysis-title.svg') }}" alt="SVG Image"> 
                        <h5 class="card-title pt-3">Section - Responses</h5>
                        </div>  <div class="chart-container" style="height: ${office.sub_offices.length * 25 + 100}px;">
                            <canvas id="subOfficesChart-${office.office_id}"></canvas>
                        </div>
                    </div>
                    
                    <div class="card-body">
                      <div class="d-flex">
                         <img class="svg" src="{{ asset('analysis-title.svg') }}" alt="SVG Image"> 
                        <h5 class="card-title pt-3">Services - Responses</h5>
                        </div>
                        <div class="chart-container" style="height: ${getServiceCount(office) * 25 + 100}px;">
                            <canvas id="servicesChart-${office.office_id}"></canvas>
                        </div>
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
            createResponseTypeChart(office.office_id, office);
            createSubOfficesChart(office.office_id, office);
            createServicesChart(office.office_id, office);
        });
    }
});

// Helper function to count total services across all sub-offices (keeping your original function)
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

// Function to create response type horizontal bar chart with end labels (keeping your original function)
function createResponseTypeChart(officeId, office) {
    const ctx = document.getElementById('responseTypeChart-' + officeId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Complaints', 'Feedbacks', 'Recommendations'],
            datasets: [{
                data: [office.complaints, office.feedbacks, office.recommendations],
                backgroundColor: ['#dc3545', '#28a745', '#ffc107'],
                borderColor: ['#dc3545', '#28a745', '#ffc107'],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',  // This makes the bars horizontal
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
                    // Optional: rounded corners for bars
                    barThickness: 20  // Set the bar thickness here (pixels)
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "rgba(0,0,0,0.05)"
                    },
                    // Add padding to make room for labels
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
            // Add padding to the right for labels
            layout: {
                padding: {
                    right: 40
                }
            }
        }
    });
}

// Function to create sub-offices chart with end labels (keeping your original function)
function createSubOfficesChart(officeId, office) {
    const ctx = document.getElementById('subOfficesChart-' + officeId).getContext('2d');
    
    // Extract sub-office names and count their total responses
    const subOfficeLabels = [];
    const subOfficeData = [];
    const serviceColors = [];
    const colorMap = {};
    
    // Generate a color map for each sub-office
    office.sub_offices.forEach((subOffice, index) => {
        // Generate a color based on index
        const predefinedHues = [ 140, 220, 0, 55]; // red, orange, green, blue
        const hue = predefinedHues[index % predefinedHues.length];  // cycle through colors
        colorMap[subOffice.sub_office_name] = `hsl(${hue}, 70%, 50%)`;
        // Use golden angle approximation for color distribution
        colorMap[subOffice.sub_office_name] = `hsl(${hue}, 60%, 50%)`;
    });
    
    office.sub_offices.forEach(subOffice => {
        serviceColors.push(colorMap[subOffice.sub_office_name]);
    });
    
    office.sub_offices.forEach(subOffice => {
        subOfficeLabels.push(subOffice.sub_office_name);
        
        // Calculate total responses for this sub-office
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
            indexAxis: 'y',  // This makes the bars horizontal
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
                    // Optional: rounded corners for bars
                    barThickness: 20  // Set the bar thickness here (pixels)
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "rgba(0,0,0,0.05)"
                    },
                    // Add padding to make room for labels
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
            // Add padding to the right for labels
            layout: {
                padding: {
                    right: 40
                }
            }
        }
    });
}

// Function to create services chart with end labels (keeping your original function)
function createServicesChart(officeId, office) {
    const ctx = document.getElementById('servicesChart-' + officeId).getContext('2d');
    
    // Extract all services across all sub-offices
    const serviceLabels = [];
    const serviceData = [];
    const serviceColors = [];
    const colorMap = {};
    
    // Generate a color map for each sub-office
    office.sub_offices.forEach((subOffice, index) => {
        // Generate a color based on index
        const predefinedHues = [ 140, 220, 0, 55]; // red, orange, green, blue
        const hue = predefinedHues[index % predefinedHues.length];  // cycle through colors 
        colorMap[subOffice.sub_office_name] = `hsl(${hue}, 60%, 50%)`;
    });
    
    // Collect all services and their data
    office.sub_offices.forEach(subOffice => {
        subOffice.services.forEach(service => {
            // Format the label to include sub-office
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
            indexAxis: 'y',  // This makes the bars horizontal
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
                    // Optional: rounded corners for bars
                    barThickness: 20  // Set the bar thickness here (pixels)
                }
            },  
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: "rgba(0,0,0,0.05)"
                    },
                    // Add padding to make room for labels
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
            // Add padding to the right for labels
            layout: {
                padding: {
                    right: 45
                }
            }
        }
    });
}
    </script>










 


        <div class="container my-4"> 
 
    
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