@extends('layout.general_layout')

<title>@yield('title','Feedback Sentiment')</title>
@yield('sidebar')
@show
@section('content')
<div class="container-fluid mt-4">
    <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Feedback Sentiment Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
    
    <!-- Stats Cards Section -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Valid Feedback</h6>
                            <h3 class="fw-bold" id="totalFeedback">0</h3>
                        </div>
                        <div class="mb-2" style="background-color:rgb(253, 253, 253);border-radius: 50%;padding-top:10px">
                            <img src="{{ asset('feedback.svg') }}" style="width:50px; height: 50px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Positive Feedback</h6>
                            <h3 class="fw-bold text-success" id="positiveCount">0</h3>
                        </div>
                        <div style="background-color:rgb(253, 253, 253); border-radius: 50%;  ">
                            <img src="{{ asset('positive-rate.svg') }}" style="width: 70px; height: 70px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Neutral Feedback</h6>
                            <h3 class="fw-bold text-primary" id="neutralCount">0</h3>
                        </div>
                        <div style="background-color:rgb(253, 253, 253); border-radius: 50%;  ">
                            <img src="{{ asset('neutral_feedback.svg') }}" style="width: 70px; height: 70px; ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Concerns/Issues</h6>
                            <h3 class="fw-bold text-danger" id="negativeCount">0</h3>
                        </div>
                        <div style="border-radius: 50%;">
                            <img src="{{ asset('nega.svg') }}" style="width:70px; height: 70px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Second Row Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Positive Rate</h6>
                            <h3 class="fw-bold text-success" id="positiveRate">0%</h3>
                        </div>
                          <div style="background-color:rgb(8, 188, 86); padding: 10px; border-radius: 50%;">
                     <svg viewBox="0 0 24 24" width="50 " hieght=" 50"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 12H4.6C4.03995 12 3.75992 12 3.54601 12.109C3.35785 12.2049 3.20487 12.3578 3.10899 12.546C3 12.7599 3 13.0399 3 13.6V19.4C3 19.9601 3 20.2401 3.10899 20.454C3.20487 20.6422 3.35785 20.7951 3.54601 20.891C3.75992 21 4.03995 21 4.6 21H9M9 21H15M9 21L9 8.6C9 8.03995 9 7.75992 9.10899 7.54601C9.20487 7.35785 9.35785 7.20487 9.54601 7.10899C9.75992 7 10.0399 7 10.6 7H13.4C13.9601 7 14.2401 7 14.454 7.10899C14.6422 7.20487 14.7951 7.35785 14.891 7.54601C15 7.75992 15 8.03995 15 8.6V21M15 21H19.4C19.9601 21 20.2401 21 20.454 20.891C20.6422 20.7951 20.7951 20.6422 20.891 20.454C21 20.2401 21 19.9601 21 19.4V4.6C21 4.03995 21 3.75992 20.891 3.54601C20.7951 3.35785 20.6422 3.20487 20.454 3.10899C20.2401 3 19.9601 3 19.4 3H16.6C16.0399 3 15.7599 3 15.546 3.10899C15.3578 3.20487 15.2049 3.35785 15.109 3.54601C15 3.75992 15 4.03995 15 4.6V8" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Neutral Rate</h6>
                            <h3 class="fw-bold text-primary" id="neutralRate">0%</h3>
                        </div>
                        <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
                     <svg viewBox="0 0 24 24" width="50 " hieght=" 50"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 12H4.6C4.03995 12 3.75992 12 3.54601 12.109C3.35785 12.2049 3.20487 12.3578 3.10899 12.546C3 12.7599 3 13.0399 3 13.6V19.4C3 19.9601 3 20.2401 3.10899 20.454C3.20487 20.6422 3.35785 20.7951 3.54601 20.891C3.75992 21 4.03995 21 4.6 21H9M9 21H15M9 21L9 8.6C9 8.03995 9 7.75992 9.10899 7.54601C9.20487 7.35785 9.35785 7.20487 9.54601 7.10899C9.75992 7 10.0399 7 10.6 7H13.4C13.9601 7 14.2401 7 14.454 7.10899C14.6422 7.20487 14.7951 7.35785 14.891 7.54601C15 7.75992 15 8.03995 15 8.6V21M15 21H19.4C19.9601 21 20.2401 21 20.454 20.891C20.6422 20.7951 20.7951 20.6422 20.891 20.454C21 20.2401 21 19.9601 21 19.4V4.6C21 4.03995 21 3.75992 20.891 3.54601C20.7951 3.35785 20.6422 3.20487 20.454 3.10899C20.2401 3 19.9601 3 19.4 3H16.6C16.0399 3 15.7599 3 15.546 3.10899C15.3578 3.20487 15.2049 3.35785 15.109 3.54601C15 3.75992 15 4.03995 15 4.6V8" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Concern Rate</h6>
                            <h3 class="fw-bold text-danger" id="negativeRate">0%</h3>
                        </div>
                          <div style="background-color:rgb(210, 60, 60); padding: 10px; border-radius: 50%;">
                     <svg viewBox="0 0 24 24" width="50 " hieght=" 50"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 12H4.6C4.03995 12 3.75992 12 3.54601 12.109C3.35785 12.2049 3.20487 12.3578 3.10899 12.546C3 12.7599 3 13.0399 3 13.6V19.4C3 19.9601 3 20.2401 3.10899 20.454C3.20487 20.6422 3.35785 20.7951 3.54601 20.891C3.75992 21 4.03995 21 4.6 21H9M9 21H15M9 21L9 8.6C9 8.03995 9 7.75992 9.10899 7.54601C9.20487 7.35785 9.35785 7.20487 9.54601 7.10899C9.75992 7 10.0399 7 10.6 7H13.4C13.9601 7 14.2401 7 14.454 7.10899C14.6422 7.20487 14.7951 7.35785 14.891 7.54601C15 7.75992 15 8.03995 15 8.6V21M15 21H19.4C19.9601 21 20.2401 21 20.454 20.891C20.6422 20.7951 20.7951 20.6422 20.891 20.454C21 20.2401 21 19.9601 21 19.4V4.6C21 4.03995 21 3.75992 20.891 3.54601C20.7951 3.35785 20.6422 3.20487 20.454 3.10899C20.2401 3 19.9601 3 19.4 3H16.6C16.0399 3 15.7599 3 15.546 3.10899C15.3578 3.20487 15.2049 3.35785 15.109 3.54601C15 3.75992 15 4.03995 15 4.6V8" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Office Feedback Breakdown -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Office Feedback Breakdown</h5>
                </div>
                <div class="card-body">
                    <canvas id="officeChart" height="240"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Feedback Trend</h5>
                </div>
                <div class="card-body">
                    <canvas id="trendChart" height="240"></canvas>
                </div>
            </div>
        </div>
    </div>
  <style>
    /* Make tab nav look like folder tabs */
    .nav-tabs {
        border-bottom: none;
    }

    .nav-tabs .nav-link {
        background: #f1f1f1;
        color: #444;
        border: 1px solid #ccc;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        margin-right: 4px;
        padding: 8px 16px;
        font-weight: 500;
        position: relative;
        top: 6px;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link:hover {
        background: #e0e0e0;
        color: #000;
    }

    .nav-tabs .nav-link.active {
        background: #fff;
        color: #000;
        font-weight: 600;
        top: 0;
        z-index: 2;
        border-bottom: 1px solid #fff;
    }

    /* Card content below tabs */
    .card-body {
        border: 1px solid #ccc;
        border-top: none;
        border-radius: 0 0 8px 8px;
        background: #fff;
        padding: 16px;
        z-index: 1;
    }

    .card-header {
        background-color: transparent;
        border: none;
    }

    .card {
        border: none;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    .nav-link{
        box-shadow: none !important;
    }
</style>


    <!-- Feedback Tabs -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header  " style="border-bottom:1px solid #ccc;  ">
            <ul class="nav nav-tabs card-header-tabs" id="feedbackTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button  class="nav-link active" id="positive-tab" data-bs-toggle="tab" data-bs-target="#positive" type="button" role="tab" aria-controls="positive" aria-selected="true">
                        <i class="bi text-success me-2"></i>Positive Remarks
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="neutral-tab" data-bs-toggle="tab" data-bs-target="#neutral" type="button" role="tab" aria-controls="neutral" aria-selected="false">
                        <i class="bi text-primary me-2"></i>Neutral Remarks
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="negative-tab" data-bs-toggle="tab" data-bs-target="#negative" type="button" role="tab" aria-controls="negative" aria-selected="false">
                        <i class="bi text-danger me-2"></i>Concerns/Issues
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="feedbackTabContent">
                <!-- Positive Feedback Tab -->
                <div class="tab-pane fade show active" id="positive" role="tabpanel" aria-labelledby="positive-tab">
                    <table class="table table-bordered" style="font-family: sans-serif;">
                        <thead>
                            <tr>
                                <th style="background-color:rgb(20, 160, 88); color: white; padding: 10px;">Office Name</th> 
                                <th style="background-color:rgb(20, 160, 88); color: white; padding: 10px;">Section Name</th> 
                                <th style="background-color: rgb(20, 160, 88); color: white; padding: 10px;">Service Name</th>  
                                <th style="background-color: rgb(20, 160, 88); color: white; padding: 10px;">Comment</th>
                            </tr>
                        </thead>
                        <tbody id="positiveSentimentsTable">
                            <!-- Data will be injected here by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Neutral Feedback Tab -->
                <div class="tab-pane fade" id="neutral" role="tabpanel" aria-labelledby="neutral-tab">
                    <table class="table table-bordered" style="font-family: sans-serif;">
                        <thead>
                            <tr>
                                <th style="background-color:rgb(25, 137, 229); color: white; padding: 10px;">Office Name</th> 
                                <th style="background-color:rgb(25, 137, 229); color: white; padding: 10px;">Section Name</th> 
                                <th style="background-color:rgb(25, 137, 229); color: white; padding: 10px;">Service Name</th>  
                                <th style="background-color:rgb(25, 137, 229); color: white; padding: 10px;">Comment</th>
                            </tr>
                        </thead>
                        <tbody id="neutralSentimentsTable">
                            <!-- Data will be injected here by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Negative Feedback Tab -->
                <div class="tab-pane fade" id="negative" role="tabpanel" aria-labelledby="negative-tab">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-danger" style="color: white; padding: 10px;">Office Name</th> 
                                <th class="bg-danger" style="color: white; padding: 10px;">Section Name</th> 
                                <th class="bg-danger" style="color: white; padding: 10px;">Service Name</th>  
                                <th class="bg-danger" style="color: white; padding: 10px;">Comment</th>
                            </tr>
                        </thead>
                        <tbody id="negativeSentimentsTable">
                            <!-- Data will be injected here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Required JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Store data globally for chart creation
    let positiveData = [];
    let neutralData = [];
    let negativeData = [];
    
    // Add loading indicators
    document.getElementById('totalFeedback').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('positiveCount').innerHTML = '<div class="spinner-border spinner-border-sm text-success" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('neutralCount').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('negativeCount').innerHTML = '<div class="spinner-border spinner-border-sm text-danger" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('positiveRate').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('neutralRate').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('negativeRate').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    
    // Function to populate table with grouped data
    function populateTable(data, tableId) {
        const tableBody = document.getElementById(tableId);
        
        // Group data by main_office -> office_transacted_with
        const grouped = {};
        data.forEach(item => {
            if (!grouped[item.main_office]) {
                grouped[item.main_office] = {};
            }
            if (!grouped[item.main_office][item.office_transacted_with]) {
                grouped[item.main_office][item.office_transacted_with] = [];
            }
            grouped[item.main_office][item.office_transacted_with].push(item);
        });

        // Populate table
        for (const mainOffice in grouped) {
            const sections = grouped[mainOffice];
            const mainOfficeRowspan = Object.values(sections).reduce((sum, remarks) => sum + remarks.length, 0);
            let mainOfficeRendered = false;

            for (const section in sections) {
                const remarksList = sections[section];
                const sectionRowspan = remarksList.length;
                let sectionRendered = false;

                remarksList.forEach((item, index) => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        ${!mainOfficeRendered ? `<td rowspan="${mainOfficeRowspan}">${mainOffice}</td>` : ''}
                        ${!sectionRendered ? `<td rowspan="${sectionRowspan}">${section}</td>` : ''}
                        <td>${item.service_availed}</td>
                        <td>${item.remarks || 'No Comment'}</td>
                    `;

                    tableBody.appendChild(row);
                    mainOfficeRendered = true;
                    sectionRendered = true;
                });
            }
        }
    }
    
    // Fetch positive sentiments
    fetch('/sentiments-data/positive')
        .then(response => response.json())
        .then(data => {
            positiveData = data;
            document.getElementById('positiveCount').textContent = data.length;
            populateTable(data, 'positiveSentimentsTable');
            updateStats();
            checkChartsReady();
        })
        .catch(error => {
            console.error('Error fetching Positive sentiments:', error);
            document.getElementById('positiveCount').textContent = '0';
            updateStats();
        });
    
    // Fetch neutral sentiments
    fetch('/sentiments-data/neutral')
        .then(response => response.json())
        .then(data => {
            neutralData = data;
            document.getElementById('neutralCount').textContent = data.length;
            populateTable(data, 'neutralSentimentsTable');
            updateStats();
            checkChartsReady();
        })
        .catch(error => {
            console.error('Error fetching Neutral sentiments:', error);
            document.getElementById('neutralCount').textContent = '0';
            updateStats();
        });
        
    // Fetch negative sentiments
    fetch('/sentiments-data/negative')
        .then(response => response.json())
        .then(data => {
            negativeData = data;
            document.getElementById('negativeCount').textContent = data.length;
            populateTable(data, 'negativeSentimentsTable');
            updateStats();
            checkChartsReady();
        })
        .catch(error => {
            console.error('Error fetching Negative sentiments:', error);
            document.getElementById('negativeCount').textContent = '0';
            updateStats();
        });
    
    // Function to update overall statistics
    function updateStats() {
        const positiveCount = parseInt(document.getElementById('positiveCount').textContent) || 0;
        const neutralCount = parseInt(document.getElementById('neutralCount').textContent) || 0;
        const negativeCount = parseInt(document.getElementById('negativeCount').textContent) || 0;
        const totalFeedback = positiveCount + neutralCount + negativeCount;
        
        document.getElementById('totalFeedback').textContent = totalFeedback;
        
        if (totalFeedback > 0) {
            const positiveRate = ((positiveCount / totalFeedback) * 100).toFixed(2);
            const neutralRate = ((neutralCount / totalFeedback) * 100).toFixed(2);
            const negativeRate = ((negativeCount / totalFeedback) * 100).toFixed(2);
            
            document.getElementById('positiveRate').textContent = positiveRate + '%';
            document.getElementById('neutralRate').textContent = neutralRate + '%';
            document.getElementById('negativeRate').textContent = negativeRate + '%';
        } else {
            document.getElementById('positiveRate').textContent = '0%';
            document.getElementById('neutralRate').textContent = '0%';
            document.getElementById('negativeRate').textContent = '0%';
        }
    }
    
    // Check if all data is loaded and create charts
    function checkChartsReady() {
        // Simple check - if any of the count elements don't have loading spinners, we can create charts
        const positiveElement = document.getElementById('positiveCount');
        const neutralElement = document.getElementById('neutralCount');
        const negativeElement = document.getElementById('negativeCount');
        
        if (!positiveElement.innerHTML.includes('spinner') && 
            !neutralElement.innerHTML.includes('spinner') && 
            !negativeElement.innerHTML.includes('spinner')) {
            createCharts();
        }
    }
    
    // Function to create charts
    function createCharts() {
        // Combine data for office analysis
        const allData = [...positiveData, ...neutralData, ...negativeData];
        
        // Count feedback by office
        const officeData = {};
        allData.forEach(item => {
            if (!officeData[item.main_office]) {
                officeData[item.main_office] = { positive: 0, neutral: 0, negative: 0 };
            }
            
            if (positiveData.includes(item)) {
                officeData[item.main_office].positive++;
            } else if (neutralData.includes(item)) {
                officeData[item.main_office].neutral++;
            } else if (negativeData.includes(item)) {
                officeData[item.main_office].negative++;
            }
        });
        
        // Create office chart
        const officeChart = new Chart(
            document.getElementById('officeChart'),
            {
                type: 'bar',
                data: {
                    labels: Object.keys(officeData),
                    datasets: [
                        {
                            label: 'Positive',
                            data: Object.values(officeData).map(d => d.positive),
                            backgroundColor: 'rgba(20, 160, 88, 0.7)',
                            borderColor: 'rgb(20, 160, 88)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: Object.values(officeData).map(d => d.neutral),
                            backgroundColor: 'rgba(25, 137, 229, 0.7)',
                            borderColor: 'rgb(25, 137, 229)',
                            borderWidth: 1
                        },
                        {
                            label: 'Concerns',
                            data: Object.values(officeData).map(d => d.negative),
                            backgroundColor: 'rgba(220, 53, 69, 0.7)',
                            borderColor: 'rgb(220, 53, 69)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: false,
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }
        );
        
        // Create trend chart
        createTrendChart();
    }
    
    // Function to create the trend chart with the monthly data from the backend
    function createTrendChart() {
        // Fetch historical data for trend chart
        Promise.all([
            fetch('/sentiments-data/historical/positive').then(res => res.json()).catch(() => []),
            fetch('/sentiments-data/historical/neutral').then(res => res.json()).catch(() => []),
            fetch('/sentiments-data/historical/negative').then(res => res.json()).catch(() => [])
        ])
        .then(([positiveMonthlyData, neutralMonthlyData, negativeMonthlyData]) => {
            console.log("Monthly data fetched:", { 
                positive: positiveMonthlyData?.length || 0,
                neutral: neutralMonthlyData?.length || 0,
                negative: negativeMonthlyData?.length || 0 
            });
            
            // If we have data, use it; otherwise create empty chart
            if (positiveMonthlyData.length > 0 || neutralMonthlyData.length > 0 || negativeMonthlyData.length > 0) {
                // Extract labels and counts from the monthly data
                const labels = positiveMonthlyData.map(item => item.label);
                const positiveData = positiveMonthlyData.map(item => item.count);
                const neutralData = neutralMonthlyData.map(item => item.count);
                const negativeData = negativeMonthlyData.map(item => item.count);
                
                createTrendChartWithData(labels, positiveData, neutralData, negativeData);
            } else {
                createEmptyTrendChart();
            }
        })
        .catch(error => {
            console.error('Error fetching monthly data:', error);
            createEmptyTrendChart();
        });
    }
    
    // Function to create trend chart with actual data
    function createTrendChartWithData(labels, positiveData, neutralData, negativeData) {
        const trendChart = new Chart(
            document.getElementById('trendChart'),
            {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Positive Feedback',
                            data: positiveData,
                            borderColor: 'rgb(20, 160, 88)',
                            backgroundColor: 'rgba(20, 160, 88, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Neutral Feedback',
                            data: neutralData,
                            borderColor: 'rgb(25, 137, 229)',
                            backgroundColor: 'rgba(25, 137, 229, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Concerns/Issues',
                            data: negativeData,
                            borderColor: 'rgb(220, 53, 69)',
                            backgroundColor: 'rgba(220, 53, 69, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }
        );
    }
    
    // Function to create an empty chart if data fetch fails
    function createEmptyTrendChart() {
        // Set up 6 months of labels
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const today = new Date();
        const labels = [];
        
        // Generate last 6 months of labels
        for (let i = 5; i >= 0; i--) {
            const d = new Date(today.getFullYear(), today.getMonth() - i, 1);
            labels.push(monthNames[d.getMonth()]);
        }
        
        // Create chart with zeros for all data points
        createTrendChartWithData(labels, [0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0]);
    }
});
</script>
@endsection