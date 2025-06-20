@extends('layout.general_layout')

@section('title', 'Admin Dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
<div class="container-fluid p-0">
    <!-- Dashboard Header -->


   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Rating History Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>

 


    <!-- <div class="row mb-4">
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
    </div> -->

<br>


<div class="dashboard-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; padding-bottom: 10px;">

  <!-- Filters Card (1st) -->
<div class="dashboard-card" style="flex: 1 1 calc(15% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: flex-start; justify-content: space-between;">
      <div style="flex: 1;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
     
        <h2 class="card-number text-secondary mb-2">Filter</h2>
   
      <div style="background-color: #6c757d; padding: 10px; border-radius: 50%; margin-left: 15px;">
            <svg  height="50" width="50"  fill="#ffffff" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V10h14v11zm0-13H5V5h14v3z"/></svg>
            
    <path d="M4 4h16l-6 8v5l-4 3v-8l-6-8z"></path>
    <!-- Dropdown arrow -->
    <polyline points="9 17 12 20 15 17"></polyline>
  </svg>
      </div>
    </div>
        <h5 class="card-title mb-0">Data Selection</h5>

        <div class="mb-3">
          <label for="year" class="form-label">Year</label>
          <select name="year" id="year" class="form-select form-select-sm">
            <option value="">Select Year</option>
            @foreach($years_cb as $year)
              <option value="{{ $year }}" {{ (request('year') ?? $currentYear) == $year ? 'selected' : '' }}>
                {{ $year }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="quarter" class="form-label">Quarter</label>
          <select name="quarter" id="quarter" class="form-select form-select-sm">
            <option value="">Select Quarter</option>
            @foreach($quarter_cb as $quarter)
              <option value="{{ $quarter }}" {{ (request('quarter') ?? $currentQuarter) == $quarter ? 'selected' : '' }}>
                Quarter {{ $quarter }}
              </option>
            @endforeach
          </select>
        </div>

        <button type="button" class="btn btn-primary btn-sm w-100 mt-2" onclick="getData()">
          Get Ratings
        </button>
      </div>

     
    </div>

    <!-- <p class="card-subtext mt-3">Filter by quarter and year</p> -->
  </div>
</div>


  <!-- Total Offices Card (2nd) -->
<!-- Total Offices -->
<div style="flex: 1 1 calc(50% - 20px);">
    <div class="d-flex mb-3 gap-3"> 

<div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: center; justify-content: space-between;">
      
        <h2 id="totalOffices" class="card-number text-primary">0</h2>
     
      <div style="background-color: #007bff; padding: 10px; border-radius: 50%;">
        <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
          <path d="M3 21v-2h18v2H3zm16-4V5H5v12h14zM7 11h2v2H7v-2zm0-4h2v2H7V7zm4 4h2v2h-2v-2zm0-4h2v2h-2V7zm4 4h2v2h-2v-2zm0-4h2v2h-2V7z"/>
        </svg>
      </div>
    </div>
        <h5 class="card-title">Total Offices</h5>
    <p class="card-subtext">Offices handling services</p>
  </div>
</div>

<!-- Total Responses -->
<div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: center; justify-content: space-between;">
     
        <h2 id="totalResponses" class="card-number text-success">0</h2>
     
      <div style="background-color: #28a745; padding: 10px; border-radius: 50%;">
        <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
          <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0
                   c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2
                   c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0
                   c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 
                   3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
        </svg>
      </div>
    </div>
        <h5 class="card-title">Total Responses</h5>

    <p class="card-subtext">Survey forms submitted</p>
  </div>
</div>

<div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
  <div class="card-body" style="border: none;">
    <div style="display: flex; align-items: center; justify-content: space-between;">
     
              <h2 class="card-number" id="satisfactionRate">0%</h2>
        <!-- <h5 class="card-title">Overall</h5> -->
     
    <div style="background-color: #28a745; padding: 10px; border-radius: 50%;">
           <svg viewBox="0 0 24 24" width="50" height="50" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 20V13M12 20V10M4 20L4 16M13.4067 5.0275L18.5751 6.96567M10.7988 5.40092L5.20023 9.59983M21.0607 6.43934C21.6464 7.02513 21.6464 7.97487 21.0607 8.56066C20.4749 9.14645 19.5251 9.14645 18.9393 8.56066C18.3536 7.97487 18.3536 7.02513 18.9393 6.43934C19.5251 5.85355 20.4749 5.85355 21.0607 6.43934ZM5.06066 9.43934C5.64645 10.0251 5.64645 10.9749 5.06066 11.5607C4.47487 12.1464 3.52513 12.1464 2.93934 11.5607C2.35355 10.9749 2.35355 10.0251 2.93934 9.43934C3.52513 8.85355 4.47487 8.85355 5.06066 9.43934ZM13.0607 3.43934C13.6464 4.02513 13.6464 4.97487 13.0607 5.56066C12.4749 6.14645 11.5251 6.14645 10.9393 5.56066C10.3536 4.97487 10.3536 4.02513 10.9393 3.43934C11.5251 2.85355 12.4749 2.85355 13.0607 3.43934Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>

</div>

    </div>
                <h5 class="card-title" id="satisfactionText">Loading...</h5>    

    <p class="card-subtext">Overall Rating</p>
  </div>
</div>

<script>
    function loadOverallScore() {
    fetch('Admin/overall-total-score')
        .then(response => response.json())
        .then(data => {
            const score = data.overallScore;
            const satisfactionRate = (score * 100).toFixed(2);
            document.getElementById("satisfactionRate").textContent = satisfactionRate + "%";
 

            let satisfactionText = '';
            let iconPath = '';

            if (score < 0.60) {
                satisfactionText = 'Poor'; 
                document.getElementById('satisfactionText').style.color = '#F44336';
            } else if (score >= 0.60 && score < 0.80) {
                satisfactionText = 'Fair'; 
                document.getElementById('satisfactionText').style.color = '#FF9800';
            } else if (score >= 0.80 && score < 0.95) {
                satisfactionText = 'Satisfactory'; 
                document.getElementById('satisfactionText').style.color = '#4CAF50';
            } else {
                satisfactionText = 'Outstanding'; 
                document.getElementById('satisfactionText').style.color = '#388E3C';
            }

            document.getElementById('satisfactionText').textContent = satisfactionText;
        });

}
document.addEventListener("DOMContentLoaded", function () {
    loadOverallScore(); 
});
</script>

</div>

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


</div>

<div class="text mb-2">Result</div>
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