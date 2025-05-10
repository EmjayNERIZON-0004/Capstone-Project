@extends('layout.layout_office')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
  <style>
    :root {
      --primary: #3498db;
      --success: #2ecc71;
      --warning: #f39c12;
      --danger: #e74c3c;
      --info: #1abc9c;
      --dark: #34495e;
      --light: #f8f9fa;
    }
    
   
    
    .dashboard-container {
      max-width: 1200px;
      margin: auto;
    }
    
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .header h1 {
      font-size: 24px;
      margin: 0;
      color: var(--dark);
    }
    
    .time-period {
      background: white;
      border-radius: 20px;
      padding: 8px 15px;
      font-size: 14px;
      color: var(--dark);
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .cards-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    
    .card {
      flex: 1;
      min-width: 180px;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }
    
    .card h4 {
      margin: 0 0 10px;
      font-size: 14px;
      color: #777;
      font-weight: 500;
    }
    
    .card p {
      font-size: 28px;
      margin: 0;
      color: #333;
      font-weight: 600;
    }
    
    .card .trend {
      font-size: 12px;
      margin-top: 10px;
    }
    
    .card .positive {
      color: var(--success);
    }
    
    .card .negative {
      color: var(--danger);
    }
    
    .chart-container {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      margin-bottom: 20px;
      height:500px;
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
      color: var(--dark);
      margin: 0;
    }
    
    .chart-container canvas {
      width: 100%;
    }
    
    .two-column {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }
    
    .two-column > div {
      flex: 1;
    }
    
    .primary-card {
      background: rgb(255, 255, 255) ;
      color: black;
    }
    
    .primary-card h4, .primary-card p {
      color: black;
    }
    
    .loader {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 200px;
    }
    
    .spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border-left-color: var(--primary);
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .legend {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      margin-top: 10px;
    }
    
    .legend-item {
      display: flex;
      align-items: center;
      font-size: 12px;
    }
    
    .legend-color {
      width: 12px;
      height: 12px;
      border-radius: 2px;
      margin-right: 5px;
    }
    
    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    
    .data-table th {
      background: #f1f4f9;
      padding: 10px;
      text-align: left;
      font-weight: 500;
    }
    
    .data-table td {
      padding: 10px;
      border-bottom: 1px solid #eee;
    }
    
    .badge {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .badge-success {
      background: rgba(46, 204, 113, 0.15);
      color: var(--success);
    }
    
    .badge-warning {
      background: rgba(243, 156, 18, 0.15);
      color: var(--warning);
    }
    
    .badge-danger {
      background: rgba(231, 76, 60, 0.15);
      color: var(--danger);
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="header">
      <h1>Section Performance Dashboard</h1>
      <div class="time-period" id="timePeriod">Last Updated: --</div>
    </div>
    
    <!-- Key performance indicators -->
    <div class="cards-row">
      <div class="card primary-card">
        <h4>Current Overall Score</h4>
        <p id="currentScore">--</p>
        <div class="trend" id="scoreTrend"></div>
      </div>
      
      <div class="card">
        <h4>Total Survey Responses</h4>
        <p id="totalResponses">--</p>
        <div class="trend" id="responseTrend"></div>
      </div>
      
      <div class="card">
        <h4>Response Rate</h4>
        <p id="responseRate">--</p>
        <div class="trend" id="rateChange"></div>
      </div>
      
      <div class="card">
        <h4>Average Rating</h4>
        <p id="avgRating">--</p>
        <div class="trend" id="avgRatingChange"></div>
      </div>
    </div>
    
    <!-- Rating distribution cards -->
    <div class="cards-row">
      <div class="card">
        <h4>5-Star Ratings</h4>
        <p id="total5s">--</p>
        <div class="trend" id="trend5s"></div>
      </div>
      
      <div class="card">
        <h4>4-Star Ratings</h4>
        <p id="total4s">--</p>
        <div class="trend" id="trend4s"></div>
      </div>
      
       
    </div>
    
    <!-- Chart row 1 -->
    <div class="container two-column">
      <div class="chart-container">
        <div class="chart-header">
          <h3 class="chart-title">Overall Score Trend</h3>
        </div>
        <canvas id="scoreChart"  style="height: 500px;"></canvas>
      </div>
      
      <div class="chart-container">
        <div class="chart-header">
          <h3 class="chart-title">Rating Distribution</h3>
        </div>
        <canvas id="ratingDistribution" height="250"></canvas>
      </div>
    </div>
    <style>
  .container.two-column {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: space-between;
  }

  .chart-container {
    flex: 1 1 50%; /* Two columns on larger screens */
    background: #fff;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    min-width: 300px;
  }

  /* Responsive stacking for smaller screens */
  @media (max-width: 768px) {
    .chart-container {
      flex: 1 1 100%;
    }
  }

  .chart-header {
    margin-bottom: 1rem;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
  }

  .data-table th, .data-table td {
    padding: 0.6rem;
    border: 1px solid #ddd;
    text-align: center;
  }

  .data-table th {
    background-color: #f5f5f5;
  }

  #historicalTableContainer {
    overflow-x: auto;
  }
</style>

    <!-- Chart row 2 -->
    <div class="container two-column">
      <div class="chart-container">
        <div class="chart-header">
          <h3 class="chart-title">Response Volume by Quarter</h3>
        </div>
        <canvas id="responseVolume" height="250"></canvas>
      </div>
      
       <div class="chart-container">
      <div class="chart-header">
        <h3 class="chart-title">Historical Performance</h3>
      </div>
      <div id="historicalTableContainer">
        <table class="data-table" id="historicalTable">
          <thead>
            <tr>
              <th>Quarter</th>
              <th>Overall Score</th>
              <th>Total Responses</th>
              
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <!-- Data will be inserted here -->
          </tbody>
        </table>
      </div>
    </div>
    </div>
    <!-- <div class="chart-container">
        <div class="chart-header">
          <h3 class="chart-title">Performance by Category</h3>
        </div>
        <canvas id="categoryPerformance" height="250"></canvas>
      </div>
      
          const categoryCtx = document.getElementById('categoryPerformance').getContext('2d');
        new Chart(categoryCtx, {
          type: 'line',
          data: {
            labels: ['Communication', 'Timeliness', 'Quality', 'Support', 'Professionalism'],
            datasets: [{
              label: 'Current Quarter',
              data: [
                latest.communicationScore || (latest.overallScore * 100 * 0.95).toFixed(1),
                latest.timelinessScore || (latest.overallScore * 100 * 1.05).toFixed(1),
                latest.qualityScore || (latest.overallScore * 100 * 0.98).toFixed(1),
                latest.supportScore || (latest.overallScore * 100 * 1.02).toFixed(1),
                latest.professionalismScore || (latest.overallScore * 100 * 1.01).toFixed(1)
              ],
              backgroundColor: 'rgba(46, 204, 113, 0.2)',
              borderColor: '#2ecc71',
              pointBackgroundColor: '#2ecc71',
              pointRadius: 4
            }, {
              label: 'Previous Quarter',
              data: previousQuarter ? [
                previousQuarter.communicationScore || (previousQuarter.overallScore * 100 * 0.93).toFixed(1),
                previousQuarter.timelinessScore || (previousQuarter.overallScore * 100 * 1.03).toFixed(1),
                previousQuarter.qualityScore || (previousQuarter.overallScore * 100 * 0.96).toFixed(1),
                previousQuarter.supportScore || (previousQuarter.overallScore * 100 * 1.00).toFixed(1),
                previousQuarter.professionalismScore || (previousQuarter.overallScore * 100 * 0.99).toFixed(1)
              ] : [0, 0, 0, 0, 0],
              backgroundColor: 'rgba(52, 152, 219, 0.2)',
              borderColor: '#3498db',
              pointBackgroundColor: '#3498db',
              pointRadius: 4
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
              line: {
                borderWidth: 2
              }
            },
            scales: {
              r: {
                angleLines: {
                  display: true
                },
                suggestedMin: 0,
                suggestedMax: 100
              }
            }
          }
        });

      -->
    <!-- Table with historical data -->
   
  </div>

  <script>
    // Register Chart.js plugin
    Chart.register(ChartDataLabels);
    
    // Helper function to calculate percentage change
    function percentChange(current, previous) {
      if (!previous) return 0;
      return ((current - previous) / previous) * 100;
    }
    
    // Helper function to format trend display
    function formatTrend(change) {
      if (change > 0) {
        return `<span class="positive">↑ ${change.toFixed(1)}%</span>`;
      } else if (change < 0) {
        return `<span class="negative">↓ ${Math.abs(change).toFixed(1)}%</span>`;
      }
      return `<span>0%</span>`;
    }
    
    // Helper function for status badges
    function getStatusBadge(score) {
  let label = '';
  let color = '';

  if (score < 60) {
    label = 'Poor';
    color = '#F44336'; // Red
  } else if (score >=60 && score <=79.9){
    label = 'Fair';
    color = '#FF9800'; // Orange
  } else if (score >=80 && score <=94.9) {
    label = 'Satisfactoy';
    color = '#8BC34A'; // Light Green
  } else if(score >= 95 && score <=100 ) {
    label = 'Outstanding';
    color = '#4CAF50'; // Dark Green
  }

  return `<div style="padding: 4px 10px; width:150px;text-align:center; border-radius: 4px; background-color: ${color}; color: white; font-weight: bold;">${label}</div>`;
}

    
    async function fetchPerformance(officeId) {
      try {
        const res = await fetch(`/api/section-performance/${officeId}`);
        const data = await res.json();

        if (!data.success || !data.quarterly_scores.length) {
          alert('No data available');
          return;
        }

        const scores = data.quarterly_scores.slice(-6); // Last 6 quarters for more historical data
        const labels = scores.map(q => `${q.quarter} ${q.year}`);
        const latest = scores[scores.length - 1];
        const previousQuarter = scores.length > 1 ? scores[scores.length - 2] : null;
        
        // Current date for the dashboard header
        const now = new Date();
        document.getElementById('timePeriod').textContent = `Last Updated: ${now.toLocaleDateString()} ${now.toLocaleTimeString()}`;

        // Calculate trends if we have previous quarter data
        let scoreTrend = 0;
        let responseTrend = 0;
        let rating5Trend = 0;
        let rating4Trend = 0;
        
        if (previousQuarter) {
          scoreTrend = percentChange(latest.overallScore, previousQuarter.overallScore);
          responseTrend = percentChange(latest.totalSurveyResponses, previousQuarter.totalSurveyResponses);
          rating5Trend = percentChange(latest.total5s, previousQuarter.total5s);
          rating4Trend = percentChange(latest.total4s, previousQuarter.total4s);
        }

        // Update KPI cards
        document.getElementById('currentScore').textContent = `${(latest.overallScore * 100).toFixed(1)}%`;
        document.getElementById('scoreTrend').innerHTML = formatTrend(scoreTrend);
        
        document.getElementById('totalResponses').textContent = latest.totalSurveyResponses;
        document.getElementById('responseTrend').innerHTML = formatTrend(responseTrend);
        
        // Calculate response rate (assuming we have a total sent number, using 500 as an example)
        const totalSent = latest.totalSurveyResponses * 2; // Just an example, replace with actual data
        const responseRate = (latest.totalSurveyResponses / totalSent) * 100;
        document.getElementById('responseRate').textContent = `${responseRate.toFixed(1)}%`;
        document.getElementById('rateChange').innerHTML = formatTrend(percentChange(responseRate, previousQuarter ? (previousQuarter.totalSurveyResponses / (previousQuarter.totalSurveyResponses * 2)) * 100 : 0));
        
        // Calculate average rating
        const totalRatings = latest.total5s + latest.total4s + (latest.total3s || 0) + (latest.total2s || 0) + (latest.total1s || 0);
        const weightedSum = 5 * latest.total5s + 4 * latest.total4s + 
                            3 * (latest.total3s || 0) + 2 * (latest.total2s || 0) + 
                            1 * (latest.total1s || 0);
        const avgRating = weightedSum / totalRatings;
        document.getElementById('avgRating').textContent = avgRating.toFixed(1);
        
        // Previous average rating (if available)
        let prevAvgRating = 0;
        if (previousQuarter) {
          const prevTotalRatings = previousQuarter.total5s + previousQuarter.total4s + 
                                 (previousQuarter.total3s || 0) + (previousQuarter.total2s || 0) + 
                                 (previousQuarter.total1s || 0);
          const prevWeightedSum = 5 * previousQuarter.total5s + 4 * previousQuarter.total4s + 
                                3 * (previousQuarter.total3s || 0) + 2 * (previousQuarter.total2s || 0) + 
                                1 * (previousQuarter.total1s || 0);
          prevAvgRating = prevWeightedSum / prevTotalRatings;
        }
        document.getElementById('avgRatingChange').innerHTML = formatTrend(percentChange(avgRating, prevAvgRating));
        
        // Update ratings distribution cards
        document.getElementById('total5s').textContent = latest.total5s;
        document.getElementById('trend5s').innerHTML = formatTrend(rating5Trend);
        
        document.getElementById('total4s').textContent = latest.total4s;
        document.getElementById('trend4s').innerHTML = formatTrend(rating4Trend);
        
        // Add more cards for 3-star and 1-2 star ratings
         
        // Primary Line Chart for Overall Score
        const scoreCtx = document.getElementById('scoreChart').getContext('2d');
        new Chart(scoreCtx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: 'Overall Score',
              data: scores.map(q => (q.overallScore * 100).toFixed(1)),
              borderColor: '#3498db',
              backgroundColor: 'rgba(52, 152, 219, 0.1)',
              fill: true,
              tension: 0.3,
              pointRadius: 4,
              pointBackgroundColor: '#3498db',
              pointHoverRadius: 6
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              datalabels: {
                align: 'top',
                anchor: 'end',
                color: '#3498db',
                formatter: (value) => `${value}%`
              },
              legend: { display: false },
              tooltip: {
                callbacks: {
                  label: context => `Score: ${context.parsed.y}%`
                }
              }
            },
            scales: {
              y: {
                min: 0,
                max: 100,
                ticks: {
                  callback: value => `${value}%`
                }
              }
            }
          }
        });

        // Donut Chart for Rating Distribution
        const ratingDistCtx = document.getElementById('ratingDistribution').getContext('2d');
        new Chart(ratingDistCtx, {
          type: 'doughnut',
          data: {
            labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
            datasets: [{
              data: [
                latest.total5s,
                latest.total4s,
                
                latest.total2s || 0,
                latest.total1s || 0
              ],
              backgroundColor: [
                '#2ecc71',  // Green for 5 stars
                '#3498db',  // Blue for 4 stars
                '#f39c12',  // Orange for 3 stars
                '#e67e22',  // Darker orange for 2 stars
                '#e74c3c'   // Red for 1 star
              ],
              borderWidth: 2,
              borderColor: '#ffffff'
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              datalabels: {
                color: '#fff',
                font: {
                  weight: 'bold'
                },
                formatter: (value, context) => {
                  const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                  const percentage = ((value / total) * 100).toFixed(1);
                  return percentage > 5 ? `${percentage}%` : '';
                }
              },
              legend: {
                position: 'right'
              }
            },
            cutout: '60%'
          }
        });

        // Bar Chart for Response Volume
        const responseVolumeCtx = document.getElementById('responseVolume').getContext('2d');
        new Chart(responseVolumeCtx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Total Responses',
              data: scores.map(q => q.totalSurveyResponses),
              backgroundColor: 'rgba(52, 152, 219, 0.7)',
              borderColor: '#3498db',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              datalabels: {
                align: 'top',
                anchor: 'end',
                color: '#333'
              },
              legend: { display: false }
            },
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        // Radar Chart for Category Performance
        // Example categories - adjust based on your actual data
    
        // Populate historical data table
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';
        
        scores.forEach(quarter => {
          const row = document.createElement('tr');
          
          // Calculate 5-star percentage
          const totalResponses = quarter.totalSurveyResponses;
          const fiveStarPercentage = ((quarter.total5s / totalResponses) * 100).toFixed(1);
          
          // Calculate average rating for this quarter
          const quarterTotalRatings = quarter.total5s + quarter.total4s  ;
          const quarterWeightedSum = 5 * quarter.total5s + 4 * quarter.total4s  ;
          const quarterAvgRating = (quarterWeightedSum / quarterTotalRatings).toFixed(1);
          
          row.innerHTML = `
            <td>${quarter.quarter} ${quarter.year}</td>
            <td>${(quarter.overallScore * 100).toFixed(1)}%</td>
            <td>${quarter.totalSurveyResponses}</td>
             <td>${getStatusBadge(quarter.overallScore * 100)}</td>
          `;
          tableBody.appendChild(row);
        });

      } catch (err) {
        console.error(err);
        alert('Failed to load data');
      }
    }

    // Fetch data for specific office ID
    fetchPerformance("{{session('office_id')}}"); // replace with dynamic ID if needed
  </script>
@endsection