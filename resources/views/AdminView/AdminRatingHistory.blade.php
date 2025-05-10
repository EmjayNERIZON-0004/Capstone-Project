@extends('layout.general_layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid p-0">
    <!-- Dashboard Header -->



    <div class="card shadow-sm mt-4">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-chart-line text-primary me-2"></i>Overall Survey Score by Quarter
        </h6>
        <div class="btn-group btn-group-sm" role="group" aria-label="Chart period selector">
            <button type="button" class="btn btn-outline-primary active" data-period="quarterly">Quarterly</button>
            <button type="button" class="btn btn-outline-primary" data-period="yearly">Yearly</button>
        </div>
    </div>
    <div class="card-body">
        <div id="chartContainer" style="position: relative; height: 300px;">
            <canvas id="quarterlyLineChart"></canvas>
            <div id="chartLoading" class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="noDataMessage" class="d-none d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100">
                <div class="text-center text-muted">
                    <i class="fas fa-chart-bar fa-3x mb-3"></i>
                    <p>No survey data available for this period</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white border-0 p-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="badge bg-success p-2" id="currentScore">--</span>
                    </div>
                    <div>
                        <h6 class="mb-0 small fw-bold">Current Quarter Score</h6>
                        <p class="text-muted mb-0 small" id="scoreChange">
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            <span>--% from previous quarter</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <select class="form-select form-select-sm d-inline-block w-auto" id="chartStyle">
                    <option value="line">Line Chart</option>
                    <option value="bar">Bar Chart</option>
                    <option value="area">Area Chart</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Chart configuration
    let chartInstance = null;
    const chartColors = {
        primary: 'rgba(59, 130, 246, 1)', // Blue
        primaryLight: 'rgba(59, 130, 246, 0.2)',
        success: 'rgba(16, 185, 129, 1)', // Green
        warning: 'rgba(245, 158, 11, 1)', // Amber
        danger: 'rgba(239, 68, 68, 1)',   // Red
        grid: 'rgba(203, 213, 225, 0.5)'  // Slate gray
    };
    
    // Initial load
    loadChartData('quarterly');
    
    // Period selector buttons
    document.querySelectorAll('[data-period]').forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            document.querySelectorAll('[data-period]').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
            
            // Load data for selected period
            loadChartData(this.dataset.period);
        });
    });
    
    // Chart style selector
    document.getElementById('chartStyle').addEventListener('change', function() {
        if (chartInstance) {
            updateChartStyle(this.value);
        }
    });
    
    function loadChartData(period) {
        // Show loading indicator
        document.getElementById('chartLoading').classList.remove('d-none');
        document.getElementById('noDataMessage').classList.add('d-none');
        
        // Fetch data from API
        const endpoint = period === 'yearly' ? 
            'Admin/api/yearly-survey-scores' : 
            'Admin/api/quarterly-survey-scores';
            
        fetch(endpoint)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Check the correct data key based on the period
                    const scoresKey = period === 'yearly' ? 'yearly_scores' : 'quarterly_scores';
                    
                    if (data[scoresKey] && data[scoresKey].length > 0) {
                        renderChart(data[scoresKey], period);
                        updateStatistics(data[scoresKey]);
                    } else {
                        // Show no data message
                        document.getElementById('noDataMessage').classList.remove('d-none');
                        if (chartInstance) {
                            chartInstance.destroy();
                            chartInstance = null;
                        }
                    }
                } else {
                    // Show no data message
                    document.getElementById('noDataMessage').classList.remove('d-none');
                }
            })
            .catch(error => {
                console.error("Failed to load chart data:", error);
                document.getElementById('noDataMessage').classList.remove('d-none');
            })
            .finally(() => {
                // Hide loading indicator
                document.getElementById('chartLoading').classList.add('d-none');
            });
    }
    
    function renderChart(data, period) {
        // Generate labels based on period type
        const labels = period === 'yearly' 
            ? data.map(item => `${item.year}`)
            : data.map(item => `${item.quarter} ${item.year}`);
           
        const scores = data.map(item => item.overallScore);
        
        const ctx = document.getElementById('quarterlyLineChart').getContext('2d');
        
        // Determine chart type
        const chartStyle = document.getElementById('chartStyle').value;
        
        // Destroy previous chart if exists
        if (chartInstance) {
            chartInstance.destroy();
        }
        
        // Create new chart
        chartInstance = new Chart(ctx, {
            type: chartStyle === 'area' ? 'line' : chartStyle,
            data: {
                labels: labels,
                datasets: [{
                    label: period === 'yearly' ? 'Yearly Score' : 'Quarterly Score',
                    data: scores,
                    fill: chartStyle === 'area',
                    backgroundColor: chartStyle === 'area' ? chartColors.primaryLight : chartColors.primary,
                    borderColor: chartColors.primary,
                    tension: 0.3,
                    pointBackgroundColor: chartColors.primary,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1,
                        grid: {
                            color: chartColors.grid
                        },
                        ticks: {
                            callback: function(value) {
                                return (value * 100) + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: chartColors.grid
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        display: true,
                        position: 'top' 
                    },
                    tooltip: { 
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return `Score: ${(context.raw * 100).toFixed(1)}%`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateChartStyle(style) {
        if (!chartInstance) return;
        
        const data = chartInstance.data;
        
        // Update chart type and styling
        if (style === 'area') {
            chartInstance.config.type = 'line';
            chartInstance.data.datasets[0].fill = true;
            chartInstance.data.datasets[0].backgroundColor = chartColors.primaryLight;
        } else {
            chartInstance.config.type = style;
            chartInstance.data.datasets[0].fill = false;
            chartInstance.data.datasets[0].backgroundColor = style === 'line' ? 
                chartColors.primary : chartColors.primary;
        }
        
        chartInstance.update();
    }
    
    function updateStatistics(data) {
        if (data.length < 1) return;
        
        // Get current and previous scores
        const currentScore = data[data.length - 1].overallScore;
        const previousScore = data.length > 1 ? data[data.length - 2].overallScore : 0;
        
        // Calculate percent change
        let percentChange = 0;
        let changeDirection = 'equal';
        
        if (previousScore > 0) {
            percentChange = ((currentScore - previousScore) / previousScore) * 100;
            changeDirection = percentChange > 0 ? 'up' : (percentChange < 0 ? 'down' : 'equal');
        }
        
        // Update UI elements
        document.getElementById('currentScore').textContent = `${(currentScore * 100).toFixed(1)}%`;
        
        const scoreChangeEl = document.getElementById('scoreChange');
        const period = document.querySelector('[data-period].active').dataset.period;
        const periodText = period === 'yearly' ? 'year' : 'quarter';
        
        if (changeDirection === 'up') {
            scoreChangeEl.innerHTML = `
                <i class="fas fa-arrow-up text-success me-1"></i>
                <span>${Math.abs(percentChange).toFixed(1)}% from previous ${periodText}</span>
            `;
        } else if (changeDirection === 'down') {
            scoreChangeEl.innerHTML = `
                <i class="fas fa-arrow-down text-danger me-1"></i>
                <span>${Math.abs(percentChange).toFixed(1)}% from previous ${periodText}</span>
            `;
        } else {
            scoreChangeEl.innerHTML = `
                <i class="fas fa-equals text-muted me-1"></i>
                <span>No change from previous ${periodText}</span>
            `;
        }
        
        // Set color of current score badge based on value
        const scoreElement = document.getElementById('currentScore');
        if (currentScore >= 0.75) {
            scoreElement.className = 'badge bg-success p-2';
        } else if (currentScore >= 0.5) {
            scoreElement.className = 'badge bg-warning p-2';
        } else {
            scoreElement.className = 'badge bg-danger p-2';
        }
    }
});
</script>


    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
            <div class="card-body">
    <h4 class="card-title mb-3">
        <i class="fas fa-chart-line text-primary me-2"></i>
        Quarterly Ratings Overview
    </h4>
    <p class="text-muted">View and analyze the previous ratings for offices across different quarters.</p>
</div>

            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-filter text-secondary me-2"></i>
                        Data Filters
                    </h5>
                    
                    <form id="surveyForm" class="row g-3 align-items-end">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="year" class="form-label">Year</label>
                                <select name="year" id="year" class="form-select form-select-lg">
                                    <option value="">Select Year</option>
                                    @foreach($years_cb as $year)
                                        <option value="{{ $year }}" 
                                            {{ (request('year') ?? $currentYear) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="quarter" class="form-label">Quarter</label>
                                <select name="quarter" id="quarter" class="form-select form-select-lg">
                                    <option value="">Select Quarter</option>
                                    @foreach($quarter_cb as $quarter)
                                        <option value="{{ $quarter }}" 
                                            {{ (request('quarter') ?? $currentQuarter) == $quarter ? 'selected' : '' }}>
                                            Quarter {{ $quarter }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-12">
                            <button type="button" class="btn btn-primary btn-lg w-100" onclick="getData()">
                                <i class="fas fa-history me-2"></i>Get Ratings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-subtitle text-muted">Total Offices</h6>
                        <span class="badge bg-primary rounded-pill"><i class="fas fa-building"></i></span>
                    </div>
                    <h2 class="card-title mb-0" id="totalOffices">0</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-subtitle text-muted">Total Responses</h6>
                        <span class="badge bg-success rounded-pill"><i class="fas fa-clipboard-check"></i></span>
                    </div>
                    <h2 class="card-title mb-0" id="totalResponses">0</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar text-primary me-2"></i>
                        Customer Satisfaction Measurement Office Rankings
                    </h5>
                </div>
                
                <div class="card-body">
                    <!-- Legend -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Performance Categories</h6>
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            <div class="d-flex align-items-center">
                                <div style="width: 16px; height: 16px; background-color: #F44336;" class="me-2 rounded-circle"></div>
                                <span class="small">Below 60.0% (Poor)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div style="width: 16px; height: 16px; background-color: #FF9800;" class="me-2 rounded-circle"></div>
                                <span class="small">60.0% - 79.9% (Fair)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div style="width: 16px; height: 16px; background-color: #8BC34A;" class="me-2 rounded-circle"></div>
                                <span class="small">80.0% - 94.9% (Satisfactory)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div style="width: 16px; height: 16px; background-color: #4CAF50;" class="me-2 rounded-circle"></div>
                                <span class="small">95.0% - 100% (Outstanding)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Canvas -->
                    <div class="chart-container" style="position: relative; height: 350px; width: 100%;">
                        <canvas id="officeRankChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table text-primary me-2"></i>
                        Detailed Office Performance
                    </h5>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3">Rank</th>
                                    <th class="py-3">Main Office</th>
                                    <th class="py-3">Responses</th>
                                    <th class="py-3">Score</th>
                                    <th class="py-3">Analysis</th>
                                </tr>
                            </thead>
                            <tbody id="offices-table">
                                <!-- Data will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let officeChart = null;

document.addEventListener("DOMContentLoaded", function () {
    getData(); // already handles default year/quarter
});

function fetchRankedOfficesAndChart(quarter, year) {
    fetch(`/Admin/api/ranked-offices/${quarter}/${year}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (!data || !data.rankedOffices) throw new Error("Invalid data format received");

            // Update totals
            document.getElementById("totalOffices").textContent = data.totalOffices || 0;
            document.getElementById("totalResponses").textContent = data.totalSurveyResponses || 0;

            // Fill Table
            const tableBody = document.getElementById('offices-table');
            tableBody.innerHTML = '';
            data.rankedOffices.forEach((office, index) => {
                const score = (office.overall_score * 100).toFixed(2);
            
                let analysis = getAnalysisForScore(office, score);
                
                // Add color classes based on score
                let scoreClass = "";
                
                if (score < 60) scoreClass = "background-color:#F44336;color:white";
                else if (score < 80) scoreClass = "background-color:#FF9800;color:white";
                else if (score < 95) scoreClass = "background-color:#8BC34A;color:white";
                else scoreClass = "background-color:#4CAF50;color:white";

                const row = `
                    <tr>
                        <td class="fw-bold text-center">${index + 1}</td>
                        <td>${office.office_name}</td>
                        <td>${office.total_responses}</td>
                        <td style="${scoreClass};font-weight:bold;">${score}%</td>
                        <td>${analysis}</td>
                    </tr>`;
                tableBody.innerHTML += row;
            });

            // Prepare Chart
            const labels = data.rankedOffices.map(o => o.office_name);
            const scores = data.rankedOffices.map(o => o.overall_score * 100);
            const colors = scores.map(score => getColorForScore(score));

            const ctx = document.getElementById('officeRankChart2').getContext('2d');
            if (officeChart) {
                officeChart.data.labels = labels;
                officeChart.data.datasets[0].data = scores;
                officeChart.data.datasets[0].backgroundColor = colors;
                officeChart.update();
            } else {
                officeChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Satisfaction Rate (%)',
                            data: scores,
                            backgroundColor: colors, 
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: { stepSize: 20 }
                            },
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 0
                                }
                            }
                        },
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error fetching ranked offices:', error);
        });
}

function getData() {
    const year = document.getElementById('year').value;
    const quarter = document.getElementById('quarter').value;

    if (!year || !quarter) {
        alert('Please select both year and quarter');
        return;
    } 
    fetchRankedOfficesAndChart(quarter, year); 
}

function getColorForScore(score) {
    if (score < 60) return '#F44336';
    if (score < 80) return '#FF9800';
    if (score < 95) return '#8BC34A';
    return '#4CAF50';
}

function getAnalysisForScore(office, scorePercentage) {
    let analysis = '';

    if (scorePercentage == 100) {
        analysis = `Based on the data sample, the ${office.office_name} received a <strong> 100.00% </strong> in the content category, indicating an excellent level of performance in addressing the needs and concerns of clients.`;
    } else if (scorePercentage <= 20) {
        analysis = `The ${office.office_name} received a <strong> ${scorePercentage}% </strong>  in the content category, showing a significant underperformance and highlighting the need for immediate improvement.`;
    } else if (scorePercentage <= 40) {
        analysis = `The ${office.office_name} scored <strong> ${scorePercentage}%  </strong> in the content category, indicating below expectations. Efforts should be made to enhance performance.`;
    } else if (scorePercentage <= 60) {
        analysis = `The ${office.office_name} achieved a <strong> ${scorePercentage}% </strong> in the content category, meeting expectations. However, further improvement is recommended for optimal performance.`;
    } else if (scorePercentage <= 80) {
        analysis = `The ${office.office_name} received a <strong>  ${scorePercentage}% </strong> in the content category, indicating above expectations. It's a good performance, but there's still room for further improvement.`;
    } else {
        analysis = `The ${office.office_name} received a <strong> ${scorePercentage}% </strong> in the content category, demonstrating outstanding performance and exceeding expectations.`;
    }

    return analysis;
}
</script>
@endsection