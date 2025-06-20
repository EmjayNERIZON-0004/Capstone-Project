@extends('layout.general_layout')

<title>@yield('title','Admin Dashboard')</title>
@yield('sidebar')
@show

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">

<div class="container  ">
    <!-- <h2 class="text-center mb-4">Overall Rating - Performing Categories per SQD</h2> -->
  <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">SQD Rating Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
<style>
    .dashboard-card{
        max-height: 180px;
        padding: 3px;
        
    }
</style>
       <div class="dashboard-container" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
        
      <!-- Overall Satisfaction Card -->
<div class="dashboard-card mb-1" style="flex: 1 1 calc(20% - 20px); ">

    <div class="card-body" style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 class="card-number" id="satisfactionRate">0%</h2>
                <h5 class="card-title" id="satisfactionText">Loading...</h5>
            </div>
          <div style="
            width: 92px;
            height: 92px;
            border-radius: 50%;
            background-color: rgb(255, 255, 255);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        ">
            <div id="faceIcon" style="width: 92px; height: 92px;"></div>
        
        </div>
        </div>
        <p class="card-subtext">Overall Satisfaction</p>
    </div>
</div>

<!-- Current Quarter Card -->
<div class="dashboard-card mb-1" style="flex: 1 1 calc(20% - 20px);  ">

    <div class="card-body " style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 class="card-number" id="currentQuarter">Loading...</h2>
            </div>
            <div style="background-color:#26A69A; padding: 10px; border-radius: 50%;">
                <svg  height="50" width="50"  fill="#ffffff" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H5V10h14v11zm0-13H5V5h14v3z"/></svg>
            </div>
        </div>
        <h5 class="card-title">Current Quarter</h5>
        <p class="card-subtext">Based on today's date</p>
    </div>
</div>

<!-- Current Year Card -->
<div class="dashboard-card mb-1" style="flex: 1 1 calc(20% - 20px);  ">

    <div class="card-body" style="border: none;">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 class="card-number" id="currentYear">0</h2>
            </div>
            <div style="background-color:#7E57C2; padding: 10px; border-radius: 50%;">
                <svg  height="50" width="50"  fill="#ffffff" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 
                10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 
                8-8 8 3.59 8 8-3.59 8-8 8z"/><path d="M11 16h2v2h-2zM11 
                6h2v8h-2z"/></svg>
            </div>
        </div>
        <h5 class="card-title">Current Year</h5>
        <p class="card-subtext">Calendar Year</p>
    </div>
</div>

       </div>

<script>
function loadOverallScore() {
    fetch('overall-total-score')
        .then(response => response.json())
        .then(data => {
            const score = data.overallScore;
            const satisfactionRate = (score * 100).toFixed(2);
            document.getElementById("satisfactionRate").textContent = satisfactionRate + "%";

            let satisfactionText = '';
            let iconPath = '';

            if (score < 0.60) {
                satisfactionText = 'Poor';
                iconPath = '{{ asset("poor.svg") }}';
                document.getElementById('satisfactionText').style.color = '#F44336';
            } else if (score >= 0.60 && score < 0.80) {
                satisfactionText = 'Fair';
                iconPath = '{{ asset("fair.svg") }}';
                document.getElementById('satisfactionText').style.color = '#FF9800';
            } else if (score >= 0.80 && score < 0.95) {
                satisfactionText = 'Satisfactory';
                iconPath = '{{ asset("smile2.svg") }}';
                document.getElementById('satisfactionText').style.color = '#4CAF50';
            } else {
                satisfactionText = 'Outstanding';
                iconPath = '{{ asset("smile.svg") }}';
                document.getElementById('satisfactionText').style.color = '#388E3C';
            }

            document.getElementById('satisfactionText').textContent = satisfactionText;

            fetch(iconPath)
                .then(res => res.text())
                .then(svg => {
                    document.getElementById("faceIcon").innerHTML = svg;
                    const insertedSvg = document.querySelector("#faceIcon svg");
                    if (insertedSvg) {
                        insertedSvg.setAttribute("width", "100%");
                        insertedSvg.setAttribute("height", "100%");
                        insertedSvg.style.width = "100%";
                        insertedSvg.style.height = "100%";
                    }
                });
        });
}

function setCurrentQuarterAndYear() {
    const now = new Date();
    const year = now.getFullYear();
    const quarter = Math.ceil((now.getMonth() + 1) / 3);

    document.getElementById('currentQuarter').textContent = `Quarter ${quarter}  `;
    document.getElementById('currentYear').textContent = year;
}

document.addEventListener("DOMContentLoaded", function () {
    loadOverallScore();
    setCurrentQuarterAndYear();
});
</script>




    <div class="dashboard-container" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
    
 <!-- Right stats (fill remaining space) -->
<div class="quarterly-stats mb-3" style="flex: 1 1 calc(40% - 20px); padding: 20px; border-radius: 8px; background: white; border: 1px solid #ccc;">
    
    <!-- Title and Icon -->
    <div class="d-flex align-items-center justify-content-between mb-2">
    <div>   
    <h5 style="margin: 0; font-weight: 600;color:#333">Quarterly Performance</h5>
    <p style="margin: 0; color: #666;">Yearly quarter comparison</p>
        </div>
        <!-- Graph Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
             stroke="#1976D2" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19h16M4 15h4v4H4zM10 11h4v8h-4zM16 7h4v12h-4z"/>
        </svg>
    </div>

    <!-- Description -->

    <!-- Data container -->
    <div id="quarters-container" class="mt-3"></div>
</div>


<div style="flex: 1 1 calc(40% - 20px); ">
 <div class="dashboard-card mb-1 d-flex p-4" style="flex: 1 1 calc(40% - 20px);   align-items: center; justify-content: space-between; padding: 16px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff;">
    
    <!-- Left: Legend Labels -->
    <div>
        <h6 class="mb-2"><strong>Legends</strong></h6>
        <div class="d-flex flex-column gap-2">
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #F44336;" class="me-2 rounded"></div>
                <span>Below 60.0% <small>(Poor)</small></span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #FF9800;" class="me-2 rounded"></div>
                <span>60.0% – 79.9% <small>(Fair)</small></span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #8BC34A;" class="me-2 rounded"></div>
                <span>80.0% – 94.9% <small>(Satisfactory)</small></span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #4CAF50;" class="me-2 rounded"></div>
                <span>95.0% – 100% <small>(Outstanding)</small></span>
            </div>
        </div>
    </div>

    
    <!-- Right: Icon -->
    <div style="padding: 10px; border-radius: 50%; background-color: rgb(20, 135, 217); display: flex; align-items: center; justify-content: center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 6h18M3 12h18M3 18h18"/>
        </svg>
    </div>
</div>
<div class="dashboard-card d-flex p-4 mb-3 mt-2  " style="flex: 1 1 calc(40% - 20px); align-items: flex-start; justify-content: space-between; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); background-color: #fff;">
  
  <!-- Left: About Text -->
  <div class="mt-0 me-3" style="max-width: 80%;">
    <h6 class="mb-2"><strong>About this page</strong></h6>
    <p class="mb-2 text-muted" style="font-size: 14px;">
      This section displays the <strong>top-performing offices, sections, and services</strong> in each Service Quality Dimension (SQD) for the year <strong>{{ \Carbon\Carbon::now()->year }}</strong>.
    </p>
    <p class="text-muted" style="font-size: 14px;">
      Use the color guide to quickly interpret how each section is performing across key service quality indicators.
    </p>
  </div>

  <!-- Right: Info Icon -->
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


<div class="text">Top Result of Service Quality Dimension</div>


<?php
    $month = date('n'); // 1–12
    $year = date('Y');
    $quarter = ceil($month / 3);
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const currentYear = <?php echo $year ?>;
    const quarters = [1, 2, 3, 4];
    const quarterLabel = q => 'Q' + q;

    fetch('/Admin/api/quarterly-survey-scores')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('quarters-container');
            if (!data.success) return;

            const scores = data.quarterly_scores;

            quarters.forEach(q => {
                const label = `Q${q} ${currentYear}`;
                const quarterKey = quarterLabel(q);
                const scoreData = scores.find(s => s.year == currentYear && s.quarter == quarterKey);

                const percent = scoreData ? (scoreData.overallScore * 100).toFixed(2) : null;
                const barColor = percent ? getColorForScore(percent) : '#ccc';

                const html = `
                    <div class="mb-2 d-flex justify-content-between align-items-center">
                        <span style="color:#333">${label}</span>
                        <span class="fw-bold text-muted">${percent !== null ? percent + '%' : 'Data not available'}</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar ${percent === null ? 'bg-secondary' : ''}" role="progressbar"
                            style="width: ${percent !== null ? percent + '%' : '100%'}; background-color: ${percent !== null ? barColor : '#ccc'}"
                            aria-valuenow="${percent !== null ? percent : 0}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', html);
            });
        });
});

// Score color logic
function getColorForScore(score) {
    const s = parseFloat(score);
    if (s >= 90) return '#2e7d32';     // Green
    if (s >= 75) return '#fbc02d';     // Yellow
    if (s >= 50) return '#fb8c00';     // Orange
    return '#d32f2f';                  // Red
}
</script>

    <!-- Folder-style tabs -->
 <ul class="nav nav-tabs" id="sqdTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button style="text-transform: uppercase;"   class="nav-link active" id="office-tab" data-bs-toggle="tab" data-bs-target="#topOffices" type="button" role="tab">
           Top Offices
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button style="text-transform: uppercase;"    class="nav-link" id="section-tab" data-bs-toggle="tab" data-bs-target="#topSections" type="button" role="tab">
              Top Sections
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button style="text-transform: uppercase;"    class="nav-link" id="service-tab" data-bs-toggle="tab" data-bs-target="#topServices" type="button" role="tab">
           Top Services
        </button>
    </li>
</ul>

    <div class="tab-content card-body" id="sqdTabsContent">
        <!-- Top Offices -->
        <div class="tab-pane fade show active" id="topOffices" role="tabpanel">
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="table  text-center">
                        <tr>
                            <th  style="background-color:rgb(20, 160, 88); color: white;">SQD</th>
                            <th  style="background-color:rgb(20, 160, 88); color: white;">Category</th>
                            <th  style="background-color:rgb(20, 160, 88); color: white;">Description</th>
                            <th  style="background-color:rgb(20, 160, 88); color: white;">Top Section</th>
                            <th  style="background-color:rgb(20, 160, 88); color: white;">Score</th>
                            <th  style="background-color:rgb(20, 160, 88); color: white;">Interpretation</th>
                        </tr>
                    </thead>
                    <tbody id="topOfficesTableBody">
                        <tr>
                            <td colspan="6" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Sections -->
        <div class="tab-pane fade" id="topSections" role="tabpanel">
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="table text-center">
                        <tr>
                            <th style="background-color:rgb(25, 137, 229); color: white;">SQD</th>
                            <th style="background-color:rgb(25, 137, 229); color: white;">Category</th>
                            <th style="background-color:rgb(25, 137, 229); color: white;">Description</th>
                            <th style="background-color:rgb(25, 137, 229); color: white;">Section</th>
                            <th style="background-color:rgb(25, 137, 229); color: white;">Score</th>
                            <th style="background-color:rgb(25, 137, 229); color: white;">Interpretation</th>
                        </tr>
                    </thead>
                    <tbody id="topSectionsTableBody">
                        <tr>
                            <td colspan="6" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Services -->
        <div class="tab-pane fade" id="topServices" role="tabpanel">
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="table  text-center">
                        <tr>
                            <th class="bg-secondary" style="color:white">SQD</th>
                            <th class="bg-secondary" style="color:white">Category</th>
                            <th class="bg-secondary" style="color:white">Description</th>
                            <th class="bg-secondary" style="color:white">Service</th>
                            <th class="bg-secondary" style="color:white">Score</th>
                            <th class="bg-secondary" style="color:white">Interpretation</th>
                        </tr>
                    </thead>
                    <tbody id="topServiceTableBody">
                        <tr>
                            <td colspan="6" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Folder Tabs Styling -->
<style> 
    .nav-tabs {
        border-bottom: none;
        box-shadow: none !important;
    }

    .nav-tabs .nav-link {
        background: #f1f1f1;
        color: #444;
        border: 1px solid #ccc;
        ;
        border-radius: 8px 8px 0 0;
        margin-right: 4px;
        padding: 8px 16px;
        font-weight: 500;
        position: relative;
        top: 6px;
        transition: all 0.2s ease;
    }
   .nav-tabs .nav-link:hover {
        box-shadow: none;
       
        border: 1px solid #ccc;
       
    }

    .nav-tabs .nav-link.active {
        background: #fff;
        color: #000;
        font-weight: 600;
        border: 1px solid #ccc;
        
        box-shadow: none;
    }

    .nav-tabs + .card-body {
        border-top: 1px solid #ccc;
    }

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

    .score-bar-container {
        background-color: #f0f0f0;
        border-radius: 4px;
        height: 10px;
        width: 100%;
        margin-top: 4px;
    }

    .score-bar {
        height: 100%;
        border-radius: 4px;
    }

    .score-value {
        font-weight: bold;
    }

    .analysis-text {
        font-size: 16px;
    }
</style> 

<!-- Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadTopServicePerSQD();
    loadTopSectionsPerSQD();
    loadTopOfficesPerSQD();
});

function getColorForScore(score) {
    if (score < 60) return '#F44336';
    else if (score <= 79.9) return '#FF9800';
    else if (score <= 94.9) return '#8BC34A';
    else return '#4CAF50';
}

function getCategoryLabel(sqd) {
    return {
        sqd1: 'Responsiveness',
        sqd2: 'Reliability',
        sqd3: 'Access and Facilities',
        sqd4: 'Communication',
        sqd5: 'Costs',
        sqd6: 'Integrity',
        sqd7: 'Assurance',
        sqd8: 'Outcome'
    }[sqd] || 'Unknown';
}

function getCategoryDescription(sqd) {
    return {
        sqd1: 'The willingness to help, assist, and provide prompt service to citizens/clients.',
        sqd2: 'The provision of what is needed and promised, following policy and standards, with minimal error.',
        sqd3: 'Convenience of location, amenities, clear signage, and technology use.',
        sqd4: 'Keeping citizens informed clearly, and listening to feedback.',
        sqd5: 'Satisfaction with billing timeliness, payment options, and cost transparency.',
        sqd6: 'Honesty, justice, fairness, and trust in service delivery.',
        sqd7: 'Capability of staff to serve, with knowledge and helpfulness.',
        sqd8: 'Extent of achieving outcomes and benefits from government services.'
    }[sqd] || 'No description available.';
}

function getScoreInterpretation(score, serviceCount, sqd) {
    let categoryName = getCategoryLabel(sqd);
    let scorePercentage = (score * 100).toFixed(2);
    if (score <= 0.20) {
        return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, indicating a very poor performance level. <strong>Action Required</strong>`;
    } else if (score <= 0.40) {
        return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, indicating below-average performance. <strong>Priority Action</strong>`;
    } else if (score <= 0.60) {
        return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, reflecting average service delivery. <strong>Monitor Performance</strong>`;
    } else if (score <= 0.80) {
        return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, reflecting above-average results. <strong>Good but room for growth</strong>`;
    } else {
        return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, reflecting excellent performance and responsiveness. <strong>Outstanding</strong>`;
    }
}

function getAnalysisForScore(office, scorePercentage) {
    let analysis = '';
    if (scorePercentage == 100) {
        analysis = `Based on the data sample, the ${office.office_name} received a <strong>100.00%</strong> in the content category, indicating an excellent level of performance.`;
    } else if (scorePercentage <= 20) {
        analysis = `The ${office.office_name} received a <strong>${scorePercentage}%</strong>, showing a significant underperformance and the need for immediate improvement.`;
    } else if (scorePercentage <= 40) {
        analysis = `The ${office.office_name} scored <strong>${scorePercentage}%</strong>, indicating below expectations. Enhance performance needed.`;
    } else if (scorePercentage <= 60) {
        analysis = `The ${office.office_name} achieved a <strong>${scorePercentage}%</strong>, meeting expectations. Further improvement recommended.`;
    } else if (scorePercentage <= 80) {
        analysis = `The ${office.office_name} received a <strong>${scorePercentage}%</strong>, indicating above expectations. Good performance with room for growth.`;
    } else {
        analysis = `The ${office.office_name} received a <strong>${scorePercentage}%</strong>, demonstrating outstanding performance.`;
    }
    return analysis;
}
</script>

<!-- External Scripts -->
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_office.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_section.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_service.js') }}"></script>

@endsection
