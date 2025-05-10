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
        <h4 class="text-muted">Q<?= $quarter ?> <?= $year ?></h4>
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
                        <div style="background-color:rgb(253, 253, 253);   border-radius: 50%;">
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
                            <h6 class="text-muted mb-1">Concerns/Issues</h6>
                            <h3 class="fw-bold text-danger" id="negativeCount">0</h3>
                        </div>
                        <div style="  border-radius: 50%;">
                <img src="{{ asset('nega.svg') }}" style="width:70px; height: 70px;">
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
                            <h6 class="text-muted mb-1">Positive Rate </h6>
                            <h3 class="fw-bold text-success" id="satisfactionRate">0%</h3>
                        </div>
                        <div style="  border-radius: 50%;">
                <img src="{{ asset('like.svg') }}" style="width:70px; height: 70px;">
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
    
    <!-- Feedback Tabs -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white " style="border-bottom:1px solid #ccc">
            <ul class="nav nav-tabs card-header-tabs" id="feedbackTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="positive-tab" data-bs-toggle="tab" data-bs-target="#positive" type="button" role="tab" aria-controls="positive" aria-selected="true">
                        <i class="bi   text-success me-2"></i>Positive Remarks
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="negative-tab" data-bs-toggle="tab" data-bs-target="#negative" type="button" role="tab" aria-controls="negative" aria-selected="false">
                        <i class="  text-danger me-2"></i>Concerns/Issues
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="feedbackTabContent">
                <!-- Positive Feedback Tab -->
                <div class="tab-pane fade show active" id="positive" role="tabpanel" aria-labelledby="positive-tab">
                    <table class="table table-bordered " style="font-family: sans-serif;">
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
                
                <!-- Negative Feedback Tab -->
                <div class="tab-pane fade" id="negative" role="tabpanel" aria-labelledby="negative-tab">
                    <table class="table  table-bordered">
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
    let negativeData = [];
    
    // Add loading indicators
    document.getElementById('totalFeedback').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('positiveCount').innerHTML = '<div class="spinner-border spinner-border-sm text-success" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('negativeCount').innerHTML = '<div class="spinner-border spinner-border-sm text-danger" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.getElementById('satisfactionRate').innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    
    // Fetch positive sentiments
    fetch('/sentiments-data/positive')
        .then(response => response.json())
        .then(data => {
            positiveData = data;
            const tableBody = document.getElementById('positiveSentimentsTable');
            
            // Update statistics
            document.getElementById('positiveCount').textContent = data.length;
            updateStats();
            
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
            
            // Create charts after data is loaded
            if (negativeData.length > 0) {
                createCharts();
            }
        })
        .catch(error => {
            console.error('Error fetching Positive sentiments:', error);
        });
        
    // Fetch negative sentiments
    fetch('/sentiments-data/negative')
        .then(response => response.json())
        .then(data => {
            negativeData = data;
            const tableBody = document.getElementById('negativeSentimentsTable');
            
            // Update statistics
            document.getElementById('negativeCount').textContent = data.length;
            updateStats();
            
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
            
            // Create charts after data is loaded
            if (positiveData.length > 0) {
                createCharts();
            }
        })
        .catch(error => {
            console.error('Error fetching Negative sentiments:', error);
        });
    
    // Function to update overall statistics
    function updateStats() {
        const positiveCount = parseInt(document.getElementById('positiveCount').textContent) || 0;
        const negativeCount = parseInt(document.getElementById('negativeCount').textContent) || 0;
        const totalFeedback = positiveCount + negativeCount;
        
        document.getElementById('totalFeedback').textContent = totalFeedback;
        
        const satisfactionRate = totalFeedback > 0 ?  ((positiveCount / totalFeedback) * 100).toFixed(2) : 0;
        document.getElementById('satisfactionRate').textContent = satisfactionRate + '%';
    }
    
    // Function to create charts
    function createCharts() {
        // Combine data for office analysis
        const allData = [...positiveData, ...negativeData];
        
        // Count feedback by office
        const officeData = {};
        allData.forEach(item => {
            if (!officeData[item.main_office]) {
                officeData[item.main_office] = { positive: 0, negative: 0 };
            }
            
            if (positiveData.includes(item)) {
                officeData[item.main_office].positive++;
            } else {
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
        
        // Try to fetch historical data for trend chart
        try {
            // Attempt to fetch historical data
            Promise.all([
                fetch('/sentiments-data/historical/positive').then(res => res.json()).catch(() => []),
                fetch('/sentiments-data/historical/negative').then(res => res.json()).catch(() => [])
            ])
            .then(([historicalPositiveData, historicalNegativeData]) => {
                console.log("Historical data fetched:", { 
                    positive: historicalPositiveData?.length || 0, 
                    negative: historicalNegativeData?.length || 0 
                });
                
                // Create trend chart whether or not we got real historical data
                createTrendChart(historicalPositiveData || [], historicalNegativeData || []);
            })
            .catch(error => {
                console.error('Error in historical data promise chain:', error);
                // Fallback to simulated data
                createTrendChart([], []);
            });
        } catch (error) {
            console.error('Error attempting to fetch historical data:', error);
            // Fallback to simulated data  
            createTrendChart([], []);
        }
    }
    
    // Function to create the trend chart, with or without historical data
  // Function to create the trend chart, with or without historical data
// Function to create the trend chart with the monthly data from the backend
function createTrendChart() {
    // Try to fetch historical data for trend chart
    Promise.all([
        fetch('/sentiments-data/historical/positive').then(res => res.json()).catch(() => []),
        fetch('/sentiments-data/historical/negative').then(res => res.json()).catch(() => [])
    ])
    .then(([positiveMonthlyData, negativeMonthlyData]) => {
        console.log("Monthly data fetched:", { 
            positive: positiveMonthlyData?.length || 0, 
            negative: negativeMonthlyData?.length || 0 
        });
        
        // Extract labels and counts from the monthly data
        const labels = positiveMonthlyData.map(item => item.label);
        const positiveData = positiveMonthlyData.map(item => item.count);
        const negativeData = negativeMonthlyData.map(item => item.count);
        
        // Create the chart with the monthly counts
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
    })
    .catch(error => {
        console.error('Error fetching monthly data:', error);
        // Create an empty chart if the data fetch fails
        createEmptyChart();
    });
}

// Function to create an empty chart if data fetch fails
function createEmptyChart() {
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
    const trendChart = new Chart(
        document.getElementById('trendChart'),
        {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Positive Feedback',
                        data: [0, 0, 0, 0, 0, 0],
                        borderColor: 'rgb(20, 160, 88)',
                        backgroundColor: 'rgba(20, 160, 88, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Concerns/Issues',
                        data: [0, 0, 0, 0, 0, 0],
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
});
</script>
@endsection