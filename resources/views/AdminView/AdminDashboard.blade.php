@extends('layout.general_layout')

<title>@yield('title','Admin Dashboard')</title>
 @yield('sidebar')
  @show
@section('content')
 
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
 

    <!-- Main Content --> 
    <div class="content"  style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size:larger;font-weight:400">
 
<div class="container pt-0 pb-3">
    <div class="dashboard-container" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
        
        <!-- Top Row: 4 Cards -->
        <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="card-header-flex">
                    <h2 class="card-number" id="totalOffices">0</h2>
                </div> 
                <div style="background-color:rgb(0, 170, 48); padding: 10px; border-radius: 50%;">
                <img src="{{ asset('office-building.svg') }}" style="width: 50px; height: 50px;">
            </div>
            </div>
            <div>
                <h5 class="card-title"><b>Our Offices</b></h5>
                <p class="card-subtext">Total number of offices</p>
                <a class="btn" href="{{ route('OfficeRemarks') }}"
                    style="background-color:rgb(0, 170, 48);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                    Office Status
                </a>
            </div>
        </div>

        <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
            <div class="card-body">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="card-header-flex">
                        <h2 class="card-number" id="totalResponses">0</h2>
                    </div> 
                    <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
                        <img src="{{ asset('survey.svg') }}" style="width: 50px; height: 50px;">
                    </div>
                </div>
                <div>
                    <h5 class="card-title">Surveys</h5>
                    <p class="card-subtext">Total number of surveys</p>
                </div>
                <a class="btn" href="{{route('survey.responses')}}" 
                    style="background-color:rgb(20, 135, 217);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                    Survey Responses
                </a>
            </div>
        </div>

    <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div class="card-header-flex">
                <h2 class="card-number">{{ $positiveCount }}</h2>
            </div>
            <div style="background-color:rgb(253, 253, 253);   border-radius: 50%;">
                <img src="{{ asset('positive-rate.svg') }}" style="width: 70px; height: 70px;">
            </div>
        </div>
        <div>
            <h5 class="card-title">Positive Feedback</h5>
            <p class="card-subtext">Total number of Positive Remarks</p>
        </div>
        <a class="btn" href="{{ route('positive_feedbacks') }}" 
           style="background-color: #4CAF50; color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
           More Details
        </a>
    </div>
</div>


    <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div class="card-header-flex">
                <h2 class="card-number">{{ $negativeCount }}</h2>
            </div>
            <div style="  border-radius: 50%;">
                <img src="{{ asset('nega.svg') }}" style="width:70px; height: 70px;">
            </div>
        </div>
        <div>
            <h5 class="card-title">Concerns/Issues</h5>
            <p class="card-subtext">Total number of Found Concerns</p>
        </div>
        <a class="btn btn-danger" href="{{ route('concerns_feedbacks') }}" 
           style="  color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
            View Concerns
        </a>
    </div>
</div>

    </div>

    <!-- Bottom Row: 2 Cards -->



    <div class="dashboard-container" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-top:5px ">



  <!-- Satisfaction Rate -->
  <div class="dashboard-card" style="flex: 1 1 calc(50% - 10px);">
                <div class="card-body">
                    <div style="display: flex; align-items: center; justify-content: space-between; height:50px">
                        <div class="card-header-flex">
                            <h2 class="card-number" id="satisfactionRate">0%</h2>
                        </div>
                        <div class="icon-container"  >
                            <div style="display: flex; justify-content: center; margin-top: 20px;">
                             <p id="satisfactionText" style="font-size: 30px; font-weight:500; color:rgb(8, 8, 8); margin-top: 10px; margin-right:10px"></p>
    <div style="
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color:rgb(255, 255, 255);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
       
    ">
        <div id="faceIcon" style="width: 50px; height: 50px;"></div>

    </div>
</div>
  </div>
       
                    </div>
                    <h5 class="card-title">Overall Rating</h5>
                    <p class="card-subtext">Percentage of satisfied users</p>
                    
                    <a class="btn btn-primary"
                        style="  border:1px solid #ccc; color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);"
                        href="#tableRating">Office Ratings</a>



                        <div id="mainOfficeProgressBars" class="mt-4"></div>
  
                </div>
            </div>

            <div class="dashboard-card pb-0" style="flex: 1 1 calc(25% - 20px);">
            <div class="card-body ">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="card-header-flex" >
                    <?php
    $month = date('n'); // Numeric representation of the month (1–12)
    $year = date('Y'); // Current year
    $quarter = ceil($month / 3); // Determine the quarter
?>
<h5>Q<?= $quarter ?> <?= $year ?></h5>
                    </div> 
                    <div style="background-color:rgb(106, 106, 106); padding: 10px; border-radius: 50%;">
                        <img src="{{ asset('history.svg') }}" style="width: 50px; height: 50px;">
                    </div>
                </div>
                <div style=" transform:translateY(-20px)">
                <h5 class="card-title">Quarterly Rating</h5>

                   <p class="card-subtext">View History of Ratings</p>
                
                   <div class="quarterly-stats mt-4">
    <!-- Previous Quarter -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span>Previous Quarter:</span>
        <span class="fw-bold" id="prev-quarter-label">Loading...</span>
    </div>
    <div class="progress mb-1" style="height: 8px;">
        <div class="progress-bar" id="prev-quarter-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="text-end mb-3">
        <small id="prev-quarter-score" class="text-muted">0%</small>
    </div>

    <!-- Current Quarter -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span>Current Quarter:</span>
        <span class="fw-bold" id="current-quarter-label">Loading...</span>
    </div>
    <div class="progress mb-1" style="height: 8px;">
        <div class="progress-bar" id="current-quarter-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="text-end">
        <small id="current-quarter-score" class="text-muted">0%</small>
    </div>
</div>

 

<script>
function getColorForScore(score) {
    if (score < 60) return '#F44336';      // Red
    else if (score <= 79.9) return '#FF9800'; // Orange
    else if (score <= 94.9) return '#8BC34A'; // Light Green
    else return '#4CAF50';                  // Green
}

document.addEventListener("DOMContentLoaded", function () {
    const currentQuarter = <?php echo $quarter   ?>;
    const currentYear = <?php echo $year   ?>;
    const prevQuarter = currentQuarter > 1 ? currentQuarter - 1 : 4;
    const prevYear = currentQuarter > 1 ? currentYear : currentYear - 1;

    const quarterLabel = q => 'Q' + q;

    fetch('/Admin/api/quarterly-survey-scores')
        .then(res => res.json())
        .then(data => {
            if (!data.success) return;

            const scores = data.quarterly_scores;

            const prevScore = scores.find(s => s.year == prevYear && s.quarter == quarterLabel(prevQuarter));
            const currScore = scores.find(s => s.year == currentYear && s.quarter == quarterLabel(currentQuarter));

            if (prevScore) {
                const percent = (prevScore.overallScore * 100).toFixed(2);
                const color = getColorForScore(percent);
                const prevBar = document.getElementById('prev-quarter-bar');
                prevBar.style.width = percent + '%';
                prevBar.setAttribute('aria-valuenow', percent);
                prevBar.style.backgroundColor = color;
                document.getElementById('prev-quarter-label').innerText = `Q${prevQuarter} ${prevYear}`;
                document.getElementById('prev-quarter-score').innerText = percent + '%';
            }

            if (currScore) {
                const percent = (currScore.overallScore * 100).toFixed(2);
                const color = getColorForScore(percent);
                const currBar = document.getElementById('current-quarter-bar');
                currBar.style.width = percent + '%';
                currBar.setAttribute('aria-valuenow', percent);
                currBar.style.backgroundColor = color;
                document.getElementById('current-quarter-label').innerText = `Q${currentQuarter} ${currentYear}`;
                document.getElementById('current-quarter-score').innerText = percent + '%';
            }
        });
});

</script>

                <a class="btn" href="{{url('rating-history')}}" 
                    style="background-color:rgb(106, 106, 106);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                    More Details
                </a>  </div>
            </div>
        </div>



        

        <!-- Date, Quarter, Year -->
        <div class="dashboard-card" style="flex: 1 1 calc(25% - 10px);">
            <div class="card-body">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="card-header-flex">
                        <h5 id="currentDate" class="mb-1 fw-bold" style="font-size: 1.2rem;"></h5>
                    </div>
                    <div style="background-color:rgb(254, 254, 254); padding: 10px; border-radius: 50%;">
                        <img src="{{ asset('calendar.svg') }}" style="width: 70px; height: 70px;">
                    </div>
                </div>
                <p id="currentQuarterYear" style="font-size: 1rem; color: #555;"></p>
                <div id="realtimeClock"
                    style="font-size: 1.3rem; font-weight: 500; color: black; border-radius: 8px; display: inline-block; letter-spacing: 4px; text-transform:lowercase;">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SQD Dimensions Overview Card -->
<div class="dashboard-card mb-3" style="flex: 1 1 100%; margin-top: 10px;">
    <div class="card-body">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h5 class="card-title mb-3">SQD Overall Performance by Dimension</h5>
            <div style=" border-radius: 50%; ">
                        <img src="{{ asset('progress2.svg') }}" style="width:70px; height: 70px;">
                    </div>
        </div>

        <div class="row">
            <!-- SQD Dimension Cards -->
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Responsiveness</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd1" role="progressbar" style="width: 0%; background-color: #4CAF50;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd1-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Reliability</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd2" role="progressbar" style="width: 0%; background-color: #2196F3;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd2-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Access & Facilities</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd3" role="progressbar" style="width: 0%; background-color: #FF9800;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd3-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Communication</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd4" role="progressbar" style="width: 0%; background-color: #9C27B0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd4-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Costs</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd5" role="progressbar" style="width: 0%; background-color: #F44336;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd5-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Integrity</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd6" role="progressbar" style="width: 0%; background-color: #F44336;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd6-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Assurance</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd7" role="progressbar" style="width: 0%; background-color: #795548;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd7-text">0%</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card-dimension">
                    <h6>Outcome</h6>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar" id="sqd-sqd8" role="progressbar" style="width: 0%; background-color: #8BC34A;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0" id="sqd-sqd8-text">0%</p>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a class="btn" href=" " 
                style="background-color:rgb(153, 102, 255); color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                Full SQD Analysis
            </a>
        </div>
    </div>
</div>

<style>
.card-dimension {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>



<script>



fetch('Admin/api/getOverallScoreByMainOffice')
.then(res => res.json())
        .then(data => {
            const container = document.getElementById("mainOfficeProgressBars");
            container.innerHTML = ''; // Clear previous

            data.data.forEach(item => {
                const scorePercent = (item.overallScore * 100).toFixed(2);
                const color = getColorForScore(scorePercent);

                const barHTML = `
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span> ${item.main_office} </span>
                            <span style="font-size: 14px;">${scorePercent}% - <span style="color:${color}; font-weight: bold;">${item.grade}</span></span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: ${scorePercent}%; background-color: ${color};"
                                aria-valuenow="${scorePercent}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', barHTML);
            });
        }); 













function fetchSQDData() {
    fetch('/Admin/api/getServicePerformanceChart')
        .then(response => response.json())
        .then(data => {
            const dimensions = data.data || data; // Fallback if 'data' is the array itself

            if (!Array.isArray(dimensions)) {
                throw new Error('Invalid response format');
            }

            dimensions.forEach(dimension => {
                const dimensionId = dimension.sqd.toLowerCase(); // e.g., "sqd1", "sqd2"
                const score = dimension.score;

                if (document.getElementById(`sqd-${dimensionId}`)) {
                    updateDimensionScore(dimensionId, score);
                }
            });
        })
        .catch(error => {
            console.error('Error fetching SQD data:', error);
            alert('Failed to load SQD data. Please try again later.');
        });
}

function updateDimensionScore(dimensionId, score) {
    const percentage = (score * 100).toFixed(2);
    const progressBar = document.getElementById(`sqd-${dimensionId}`);
    const progressText = document.getElementById(`sqd-${dimensionId}-text`);

    progressBar.style.width = `${percentage}%`;
    progressBar.setAttribute('aria-valuenow', percentage);
    progressText.textContent = `${percentage}%`;

    if (score < 0.60) {
        progressBar.style.backgroundColor = '#F44336'; // Poor - Red
    } else if (score < 0.80) {
        progressBar.style.backgroundColor = '#FF9800'; // Fair - Orange
    } else if (score < 0.95) {
        progressBar.style.backgroundColor = '#8BC34A'; // Good - Light Green
    } else {
        progressBar.style.backgroundColor = '#4CAF50'; // Excellent - Dark Green
    }
}

fetchSQDData();
</script>




    @if($total_responses != 0)

    <style>
        .card{
            padding:10px;
           
            margin-bottom: 20px;
            background-color: white;
          
        }
    </style>

 

    <div class="card">
    <h4 class="csm-title text-center m-3">
  <i></i>  
  
  
  <style>
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

    <img class="svg" src="{{ asset('title-rating2.svg') }}" alt="SVG Image" >
 &nbsp; Customer Satisfaction Measurement Office Rankings
</h4>
<div id="tableRating" style="width: 100%; ">
    <!-- Legend on top -->
    <div class="mb-3">
        <h6 class="mb-2"><strong> Legend</strong></h6>
        <div class="d-flex flex-wrap gap-3">
      
          
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #F44336;" class="me-2 border rounded"></div>
                <span>Below 60.0%% (Poor)</span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #FF9800;" class="me-2 border rounded"></div>
                <span>60.0% - 79.9% (Fair)</span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #8BC34A;" class="me-2 border rounded"></div>
                <span>80.0% - 94.9% (Satisfactory)</span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #4CAF50;" class="me-2 border rounded"></div>
                <span>95.0% - 100% (Outstanding)</span>
            </div>
        </div>
    </div>

    <!-- Graph -->
    <div  style="height: 200px; width:100%; ">
        <canvas id="officeRankChart" style="width: 100%;" height="200"></canvas>
    </div>
</div>
 

    <div class="table-responsive">
        <table class="table table-bordered text-start"   style="font-size:18px">
            <thead class="table-dark" >
                <tr>
                    <th style="background-color: rgb(3, 45, 95);border:non;font-size:18px">Rank</th>
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px">Office Name</th>
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px">Responses</th>
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px"> Score</th> 
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px">Analysis</th> 
                </tr>
            </thead>
            <tbody id="offices-table" style="font-size:18px">
                <!-- Data will be loaded here -->
            </tbody>
        </table>
    </div>
 
</div>
 

<!-- Toggle Logic -->
<script>
    function showTable(type) {
        const sections = ['office', 'section', 'service'];

        sections.forEach(section => {
            const sectionId = section + 'TableSection';
            const buttonId = 'btn-' + section;

            document.getElementById(sectionId).style.display = (section === type) ? 'block' : 'none';
            document.getElementById(buttonId).classList.toggle('active', section === type);
        });
    }
</script>

<!-- Optional Styling -->
<style>
    .btn.active {
        background-color: #0d6efd !important;
        border:none;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);
    }
   

</style>


<script>
    
    let officeChart;  
       document.addEventListener("DOMContentLoaded", function () {
        loadTopServicePerSQD();
        setInterval(loadTopSectionsPerSQD, 10000);
   
        loadTopSectionsPerSQD();
        setInterval(loadTopSectionsPerSQD, 10000);
   
        loadTopOfficesPerSQD();  
        setInterval(loadTopOfficesPerSQD, 10000);  
  
        loadOverallScore(); // Initial load of overall score
        setInterval(loadOverallScore, 10000); // Refresh every 10 seconds (10,000 ms)
        
        fetchAndUpdateChart(); // Initial fetch
        setInterval(fetchAndUpdateChart, 5000); // Fetch every 5 seconds
  
        fetchRankedOffices();
        setInterval(fetchRankedOffices, 5000); // Refresh every 5 seconds
             });
        setInterval(updateClock, 1000);
        updateClock(); 
        updateDateCard(); 

        setInterval(updateDateTime, 1000);
        updateDateTime();
       
        


 // CHART FOR THE OFFICE RANKINGS
       
        const ctx = document.getElementById('satisfactionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Satisfaction Rate (%)',
                    data: [80, 85, 83, 87, 90],
                    borderColor: 'blue',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
            }
        });
 
  
  // LOAD THE STATUS ICON

   function loadOverallScore() {
    fetch('Admin/overall-score2')
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

        // Fetch and insert the SVG
        fetch(iconPath)
            .then(res => res.text())
            .then(svg => {
                document.getElementById("faceIcon").innerHTML = svg;
            });
    });
}
    
</script>
        
    </div>



  @else
  <div class="alert alert-light border text-center p-4 mx-auto mt-3" role="alert" style="max-width: 100%;">
    <div class="mb-3">
    <img class="svg" src="{{ asset('not-found.svg') }}" alt="SVG Image" style="width:70px">
    </div>
    <h5 class="mb-2 text-secondary">No Data Found</h5>
    @php
    $month = now()->month;
    $quarter = ceil($month / 3);
@endphp

<p class="mb-0 text-muted">No responses for Q{{ $quarter }} {{ now()->year }}.</p>

</div> 
 
@endif
 
@endsection
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/AdminDashboardJS/more_function.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_ranked_office.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_overall_score.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_office.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_section.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_service.js') }}"></script>

 