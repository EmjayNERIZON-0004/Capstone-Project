<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Ratings Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f8961e;
            --danger: #f94144;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-light: #e9ecef;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: var(--dark);
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            color: var(--dark);
            font-size: 24px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        }

        .stat-card .title {
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-card .value {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stat-card .indicator {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .indicator.up {
            color: #22c55e;
        }

        .indicator.down {
            color: #ef4444;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .period-selector {
            display: flex;
            gap: 10px;
        }

        .period-btn {
            background: none;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            color: var(--gray);
        }

        .period-btn.active {
            background-color: var(--primary);
            color: white;
        }

        .bottom-charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        @media (max-width: 768px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            width: 100%;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: var(--primary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .no-data {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 200px;
            width: 100%;
            color: var(--gray);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Office Ratings Dashboard</h1>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="title">Current Quarter Score</div>
                <div class="value" id="current-score">--</div>
                <div class="indicator" id="score-trend"></div>
            </div>
            <div class="stat-card">
                <div class="title">Total Survey Responses</div>
                <div class="value" id="total-responses">--</div>
                <div class="indicator" id="responses-trend"></div>
            </div>
            <div class="stat-card">
                <div class="title">5-Star Ratings</div>
                <div class="value" id="five-stars">--</div>
                <div id="five-stars-percent" class="indicator"></div>
            </div>
            <div class="stat-card">
                <div class="title">4-Star Ratings</div>
                <div class="value" id="four-stars">--</div>
                <div id="four-stars-percent" class="indicator"></div>
            </div>
        </div>

        <div class="chart-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Quarterly Score Trend</div>
                    <div class="period-selector">
                        <button class="period-btn active" data-period="4">4 Quarters</button>
                        <button class="period-btn" data-period="8">8 Quarters</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="score-trend-chart"></canvas>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Rating Distribution</div>
                </div>
                <div class="chart-container">
                    <canvas id="rating-distribution-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="bottom-charts">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Responses by Quarter</div>
                </div>
                <div class="chart-container">
                    <canvas id="responses-by-quarter-chart"></canvas>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Performance by Quarter</div>
                </div>
                <div class="chart-container">
                    <canvas id="performance-by-quarter-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Variables
    let quarterlyScores = [];
    let selectedPeriod = 4;
    
    // Chart instances
    let scoreTrendChart;
    let ratingDistributionChart;
    let responsesByQuarterChart;
    let performanceByQuarterChart;

    // DOM Elements
    const currentScoreEl = document.getElementById('current-score');
    const scoreTrendEl = document.getElementById('score-trend');
    const totalResponsesEl = document.getElementById('total-responses');
    const responsesTrendEl = document.getElementById('responses-trend');
    const fiveStarsEl = document.getElementById('five-stars');
    const fiveStarsPercentEl = document.getElementById('five-stars-percent');
    const fourStarsEl = document.getElementById('four-stars');
    const fourStarsPercentEl = document.getElementById('four-stars-percent');

    // Show loading
    document.querySelectorAll('.chart-container').forEach(container => {
        container.innerHTML = '<div class="loading"><div class="spinner"></div></div>';
    });
    
    // Fetch data
    fetch('/api/section-performance/OSDS-OFC')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                quarterlyScores = data.quarterly_scores || [];
                
                // Sort data by year and quarter in descending order
                quarterlyScores.sort((a, b) => {
                    if (a.year !== b.year) return b.year - a.year;
                    return parseInt(b.quarter.substring(1)) - parseInt(a.quarter.substring(1));
                });
                
                updateDashboard();
                renderCharts();
            } else {
                showNoData('Error: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            showNoData('Failed to load data');
        });

    // Update dashboard with the latest data
    function updateDashboard() {
        if (quarterlyScores.length === 0) {
            showNoData('No data available');
            return;
        }

        // Get the most recent quarter data
        const latestQuarter = quarterlyScores[0];
        const prevQuarter = quarterlyScores[1] || null;

        // Update current score
        currentScoreEl.textContent = formatPercentage(latestQuarter.overallScore);
        
        // Calculate score trend
        if (prevQuarter) {
            const scoreDiff = latestQuarter.overallScore - prevQuarter.overallScore;
            const trend = scoreDiff / prevQuarter.overallScore * 100;
            
            scoreTrendEl.innerHTML = trend >= 0 ? 
                `<span style="color:#22c55e">▲ ${Math.abs(trend).toFixed(1)}%</span> vs previous quarter` : 
                `<span style="color:#ef4444">▼ ${Math.abs(trend).toFixed(1)}%</span> vs previous quarter`;
        } else {
            scoreTrendEl.textContent = 'No previous data';
        }

        // Update total responses
        totalResponsesEl.textContent = latestQuarter.totalSurveyResponses.toLocaleString();
        
        // Calculate responses trend
        if (prevQuarter) {
            const responsesDiff = latestQuarter.totalSurveyResponses - prevQuarter.totalSurveyResponses;
            const responsesTrendPct = prevQuarter.totalSurveyResponses === 0 ? 100 : 
                (responsesDiff / prevQuarter.totalSurveyResponses * 100);
            
            responsesTrendEl.innerHTML = responsesDiff >= 0 ? 
                `<span style="color:#22c55e">▲ ${Math.abs(responsesTrendPct).toFixed(1)}%</span> vs previous quarter` : 
                `<span style="color:#ef4444">▼ ${Math.abs(responsesTrendPct).toFixed(1)}%</span> vs previous quarter`;
        } else {
            responsesTrendEl.textContent = 'No previous data';
        }

        // Update 5-star ratings
        fiveStarsEl.textContent = latestQuarter.total5s.toLocaleString();
        const fiveStarPercent = latestQuarter.totalValidResponses > 0 ? 
            (latestQuarter.total5s / latestQuarter.totalValidResponses * 100) : 0;
        fiveStarsPercentEl.textContent = `${fiveStarPercent.toFixed(1)}% of total`;

        // Update 4-star ratings
        fourStarsEl.textContent = latestQuarter.total4s.toLocaleString();
        const fourStarPercent = latestQuarter.totalValidResponses > 0 ? 
            (latestQuarter.total4s / latestQuarter.totalValidResponses * 100) : 0;
        fourStarsPercentEl.textContent = `${fourStarPercent.toFixed(1)}% of total`;
    }

    // Render all charts
    function renderCharts() {
        renderScoreTrendChart();
        renderRatingDistributionChart();
        renderResponsesByQuarterChart();
        renderPerformanceByQuarterChart();
    }

    // Render score trend chart
    function renderScoreTrendChart() {
        const ctx = document.getElementById('score-trend-chart').getContext('2d');
        
        // Get data based on selected period
        const data = quarterlyScores.slice(0, selectedPeriod).reverse();
        
        if (scoreTrendChart) {
            scoreTrendChart.destroy();
        }
        
        scoreTrendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(d => `${d.quarter} ${d.year}`),
                datasets: [{
                    label: 'Overall Score',
                    data: data.map(d => d.overallScore),
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        min: Math.max(0, Math.min(...data.map(d => d.overallScore)) - 0.1),
                        max: 1,
                        ticks: {
                            callback: function(value) {
                                return formatPercentage(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Score: ' + formatPercentage(context.raw);
                            }
                        }
                    }
                }
            }
        });
    }

    // Render rating distribution chart
    function renderRatingDistributionChart() {
        const ctx = document.getElementById('rating-distribution-chart').getContext('2d');
        
        // Get the most recent quarter data
        const latestQuarter = quarterlyScores[0];
        
        if (ratingDistributionChart) {
            ratingDistributionChart.destroy();
        }
        
        // Calculate other responses (not 4 or 5 stars)
        const total5s = latestQuarter.total5s;
        const total4s = latestQuarter.total4s;
        const totalOthers = latestQuarter.totalValidResponses - total5s - total4s;
        
        ratingDistributionChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['5 Stars', '4 Stars', 'Other Ratings'],
                datasets: [{
                    data: [total5s, total4s, totalOthers],
                    backgroundColor: [
                        '#4cc9f0',
                        '#4361ee',
                        '#e9ecef'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const percentage = (value / latestQuarter.totalValidResponses * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Render responses by quarter chart
    function renderResponsesByQuarterChart() {
        const ctx = document.getElementById('responses-by-quarter-chart').getContext('2d');
        
        // Take the last 6 quarters
        const data = quarterlyScores.slice(0, 6).reverse();
        
        if (responsesByQuarterChart) {
            responsesByQuarterChart.destroy();
        }
        
        responsesByQuarterChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => `${d.quarter} ${d.year}`),
                datasets: [{
                    label: 'Survey Responses',
                    data: data.map(d => d.totalSurveyResponses),
                    backgroundColor: '#4895ef'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Render performance by quarter chart
    function renderPerformanceByQuarterChart() {
        const ctx = document.getElementById('performance-by-quarter-chart').getContext('2d');
        
        // Take the last 6 quarters
        const data = quarterlyScores.slice(0, 6).reverse();
        
        if (performanceByQuarterChart) {
            performanceByQuarterChart.destroy();
        }
        
        performanceByQuarterChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => `${d.quarter} ${d.year}`),
                datasets: [
                    {
                        label: 'Overall Score',
                        data: data.map(d => d.overallScore),
                        type: 'line',
                        fill: false,
                        borderColor: '#4361ee',
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        tension: 0.3,
                        yAxisID: 'y1'
                    },
                    {
                        label: '5-Star Ratings',
                        data: data.map(d => d.total5s),
                        backgroundColor: '#4cc9f0',
                        stack: 'Stack 0',
                        yAxisID: 'y'
                    },
                    {
                        label: '4-Star Ratings',
                        data: data.map(d => d.total4s),
                        backgroundColor: '#3f37c9',
                        stack: 'Stack 0',
                        yAxisID: 'y'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Rating Count'
                        }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: false,
                        min: 0,
                        max: 1,
                        title: {
                            display: true,
                            text: 'Overall Score'
                        },
                        grid: {
                            drawOnChartArea: false
                        },
                        ticks: {
                            callback: function(value) {
                                return formatPercentage(value);
                            }
                        }
                    }
                }
            }
        });
    }

    // Helper function to show no data message
    function showNoData(message = 'No data available') {
        document.querySelectorAll('.chart-container').forEach(container => {
            container.innerHTML = `<div class="no-data">${message}</div>`;
        });
    }

    // Format number as percentage
    function formatPercentage(value) {
        return (value * 100).toFixed(1) + '%';
    }

    // Event listeners for period selector buttons
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            selectedPeriod = parseInt(this.dataset.period);
            renderScoreTrendChart();
        });
    }); 
    </script>
</body>
</html>