@extends('layout.general_layout')

<title>@yield('title','Reports')</title>
@section('content')

<div class="wrapper"  > 
  
    <div class="content"> 
@if($total_responses !=0)  
<div class="container-fluid mt-3 mb-4">


  <!-- Enhanced Dashboard Cards for Response Rates -->
<div class="container-fluid mt-3 mb-4">
    <div class="row">
    <div class="col-12">
            <h4 class="mt-0  mb-3">Reponse Rate</h4>
        </div>
        <!-- Card 1 - Overall Response Rate -->
        <div class="col-md-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Overall Response Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="overall-response-rate">Loading...</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 - External Response Rate -->
        <div class="col-md-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                External Response Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="external-response-rate">Loading...</div>
                        </div>
                        <div class="col-auto">
                        <div style="background-color:rgb(7, 166, 49); padding: 10px; border-radius: 50%;">
 
<img src="{{ asset('external.svg') }}" style="width:30px; height:30px;">
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 - Internal Response Rate -->
        <div class="col-md-4 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Internal Response Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="internal-response-rate">Loading...</div>
                        </div>
                        <div class="col-auto">
                        <div style="background-color:rgb(7, 73, 166); padding: 10px; border-radius: 50%;">

<img src="{{ asset('internal.svg') }}" style="width:30px; height:30px;">
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SQD Score Overview Cards -->
    <div class="row">
        <div class="col-12">
            <h4 class="mt-4 mb-3">Service Quality Dimension Scores</h4>
        </div>
    </div>
    <div class="row">
        <!-- External Services SQD Overview Card -->
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                    <h6 class="text-xs font-weight-bold text-success text-uppercase   m-0">External Services SQD</h6>
                </div>
                <div class="card-body">
                    <div id="external-sqd-overview">
                        <!-- SQD Score Bars - External -->
                        <div class="sqd-progress-container">
                            <h4 class="small font-weight-bold">Responsiveness <span class="float-right" id="ext-sqd1-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar " role="progressbar" id="progress-ext-sqd1" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Reliability <span class="float-right" id="ext-sqd2-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-ext-sqd2" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Access & Facilities <span class="float-right" id="ext-sqd3-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-ext-sqd3" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Communication <span class="float-right" id="ext-sqd4-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-ext-sqd4" style="width: 0%"></div>
                            </div>
                            <!-- We'll only show 4 on this overview to save space -->
                        </div>
                        <div class="text-center mt-3">
                            <div class="btn btn-sm btn-primary " onclick="toggleExtSQDDetails()">Show All SQDs</div>
                        </div>
                        <!-- Hidden detailed SQDs -->
                        <div id="ext-sqd-details" style="display: none;">
                           <h4 class="small font-weight-bold">Costs <span class="float-right" id="ext-sqd5-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-ext-sqd5" style="width: 0%"></div>
                            </div> 
                            <h4 class="small font-weight-bold">Integrity <span class="float-right" id="ext-sqd6-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar " role="progressbar" id="progress-ext-sqd6" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Assurance <span class="float-right" id="ext-sqd7-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-ext-sqd7" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Outcome <span class="float-right" id="ext-sqd8-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar " role="progressbar" id="progress-ext-sqd8" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Internal Services SQD Overview Card -->
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                    <h6 class="text-xs font-weight-bold text-primary text-uppercase m-0">Internal Services SQD</h6>
                </div>
                <div class="card-body">
                    <div id="internal-sqd-overview">
                        <!-- SQD Score Bars - Internal -->
                        <div class="sqd-progress-container">
                            <h4 class="small font-weight-bold">Responsiveness <span class="float-right" id="int-sqd1-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-int-sqd1" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Reliability <span class="float-right" id="int-sqd2-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-int-sqd2" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Access & Facilities <span class="float-right" id="int-sqd3-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-int-sqd3" style="width: 0%"></div>
                            </div>
                            <!-- We'll only show 4 on this overview to save space -->
                          </div>
                          <h4 class="small font-weight-bold">Communication <span class="float-right" id="int-sqd5-score">0%</span></h4>
                          <div class="progress mb-2">
                              <div class="progress-bar  " role="progressbar" id="progress-int-sqd5" style="width: 0%"></div>
                          </div>
                          <div class="text-center mt-3">
                            <div class="btn btn-sm btn-primary" onclick="toggleIntSQDDetails()">Show All SQDs</div>
                          </div>
                          <!-- Hidden detailed SQDs -->
                          <div id="int-sqd-details" style="display: none;">
                          <h4 class="small font-weight-bold">Costs <span class="float-right" id="int-sqd4-score">0%</span></h4>
                          <div class="progress mb-2">
                              <div class="progress-bar" role="progressbar" id="progress-int-sqd4" style="width: 0%"></div>
                          </div>
                            <h4 class="small font-weight-bold">Integrity <span class="float-right" id="int-sqd6-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-int-sqd6" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Assurance <span class="float-right" id="int-sqd7-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-int-sqd7" style="width: 0%"></div>
                            </div>
                            <h4 class="small font-weight-bold">Outcome <span class="float-right" id="int-sqd8-score">0%</span></h4>
                            <div class="progress mb-2">
                                <div class="progress-bar  " role="progressbar" id="progress-int-sqd8" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall SQD Score Card -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                    <h6 class="text-xs font-weight-bold text-dark text-uppercase m-0">Overall SQD Performance</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="overallSqdChart" width="100%" height="400" style="border:1px solid black"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this script to update the new dashboard cards -->
<script>
// Function to toggle visibility of extended SQD details
function toggleExtSQDDetails() {
    const detailsElement = document.getElementById('ext-sqd-details');
    const button = document.querySelector('div[onclick="toggleExtSQDDetails()"]');
    
    if (detailsElement.style.display === 'none') {
        detailsElement.style.display = 'block';
        button.textContent = 'Hide Additional SQDs';
    } else {
        detailsElement.style.display = 'none';
        button.textContent = 'Show All SQDs';
    }
}

// Function to toggle visibility of internal SQD details
function toggleIntSQDDetails() {
    const detailsElement = document.getElementById('int-sqd-details');
    const button = document.querySelector('div[onclick="toggleIntSQDDetails()"]');
    
    if (detailsElement.style.display === 'none') {
        detailsElement.style.display = 'block';
        button.textContent = 'Hide Additional SQDs';
    } else {
        detailsElement.style.display = 'none';
        button.textContent = 'Show All SQDs';
    }
}

// Fetch overall response rates for the dashboard cards
function fetchResponseRates() {
    // Fetch external service data for response rate
    fetch('/response-rate-per-service/external')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const overall = data.data[data.data.length - 1];
                const externalRate = overall.overall_total_rate;
                document.getElementById('external-response-rate').textContent = externalRate;
            }
        })
        .catch(err => {
            console.error('Error fetching external response rate:', err);
            document.getElementById('external-response-rate').textContent = 'Error loading';
        });

    // Fetch internal service data for response rate
    fetch('/response-rate-per-service/internal')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const overall = data.data[data.data.length - 1];
                const internalRate = overall.overall_total_rate;
                document.getElementById('internal-response-rate').textContent = internalRate;
            }
        })
        .catch(err => {
            console.error('Error fetching internal response rate:', err);
            document.getElementById('internal-response-rate').textContent = 'Error loading';
        });

    // Fetch overall total response rate
    fetch('/response-rate-per-service-all')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const overallRate = data.data[0].all_total_rate;
                document.getElementById('overall-response-rate').textContent = overallRate;
            }
        })
        .catch(err => {
            console.error('Error fetching overall response rate:', err);
            document.getElementById('overall-response-rate').textContent = 'Error loading';
        });
}

// Fetch SQD scores for the dashboard cards
function fetchSQDScores() {
    fetch('/report_score')
        .then(response => response.json())
        .then(data => {
            // Process external SQD scores// Process external SQD scores
for (let i = 1; i <= 8; i++) {
    const sqdKey = `sqd${i}`;
    const score = data.externalCounts[sqdKey].percentageScore || 0;

    const scoreElement = document.getElementById(`ext-${sqdKey}-score`);
    const progressBar = document.getElementById(`progress-ext-${sqdKey}`);

    if (scoreElement) scoreElement.textContent = score + '%';

    if (progressBar) {
        progressBar.style.width = score + '%';
        progressBar.style.backgroundColor = getColorForScore(score);
    }
}
function getColorForScore(score) {
    if (score < 60) return '#F44336';
    else if (score <= 79.9) return '#FF9800';
    else if (score <= 94.9) return '#8BC34A';
    else return '#4CAF50';
}
            
            // Process internal SQD scores
           // Process internal SQD scores
for (let i = 1; i <= 8; i++) {
    const sqdKey = `sqd${i}`;
    const score = data.internalCounts[sqdKey].percentageScore || 0;

    const scoreElement = document.getElementById(`int-${sqdKey}-score`);
    const progressBar = document.getElementById(`progress-int-${sqdKey}`);

    if (scoreElement) scoreElement.textContent = score + '%';

    if (progressBar) {
        progressBar.style.width = score + '%';
        progressBar.style.backgroundColor = getColorForScore(score);
    }
}

            
            // Create the overall SQD chart
            createOverallSQDChart(data);
        })
        .catch(error => {
            console.error('Error fetching SQD scores:', error);
        });
}

// Create the overall SQD chart comparing external and internal services
function createOverallSQDChart(data) {
    const ctx = document.getElementById('overallSqdChart').getContext('2d');
    
    // Prepare data for the chart
    const externalScores = [];
    const internalScores = [];
    const labels = [
        'Responsiveness', 'Reliability', 'Access & Facilities', 'Communication',
        'Costs', 'Integrity', 'Assurance', 'Outcome'
    ];
    
    for (let i = 1; i <= 8; i++) {
        const sqdKey = `sqd${i}`;
        externalScores.push(data.externalCounts[sqdKey].percentageScore || 0);
        internalScores.push(data.internalCounts[sqdKey].percentageScore || 0);
    }
    
    // Create the chart
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'External Services',
                    data: externalScores,
                    backgroundColor: 'rgb(0, 139, 232)',
                    
                },
                {
                    label: 'Internal Services',
                    data: internalScores,
                    backgroundColor: 'rgb(0, 170, 88)',
                   
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            scale: {
                ticks: {
                    beginAtZero: true,
                    max: 100
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.value + '%';
                    }
                }
            }
        }
    });
}

// Initialize dashboard data
document.addEventListener('DOMContentLoaded', function() {
    fetchResponseRates();
    fetchSQDScores();
});
</script>
   

     
</div>
<div class="container-fluid " style="width: 100%; background-color:white;

border:1px solid #ddd;
">
   

    
<div style="background-color:rgb(20, 160, 88); width:fit-content;height:60px;
box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
color:white;
font-size:30px;
text-align:left;
padding:10px;
padding-right:20px;
transform:translateY(-20px);border-radius:5px;


margin-left:10px;margin-right:10px"> 
Printable Document Report
 
    </div>
 
 <style>
      .office-header {
          font-weight: bold;
          font-size: 16px;
          color: white !important;
          background-color: rgb(22, 36, 123) !important;
          text-transform: uppercase;
      }

      .column-header th {
          background-color: rgb(220, 223, 225); /* Light gray (optional column title background) */
          font-weight: bold;
          color: black;
          height: fit-content;
      }

      .overall_total_row_internal td{
        background-color: rgba(29, 174, 94, 0.56);; /* Yellow-orange */
        font-weight: bold;
    
        text-transform: uppercase;  
        border-top: none;
        border-bottom: #000000;
      }
      .overall_total_row_external td{
        background-color: rgba(18, 135, 244, 0.47);; /* Yellow-orange */
      font-weight: bold;
       
        text-transform: uppercase;  
        border-top: none;
        border-bottom: #000000;
      }
      .total-row td {
          background-color: rgba(243, 202, 82, 0.7); /* Yellow-orange */
      font-weight: bold;
        
          text-transform: uppercase;
      }
      .all-overall-row td{
        background-color: rgba(255, 187, 0, 0.68);; /* Yellow-orange */
      font-weight: bold;
        text-transform: uppercase;  
        border-top: none;
        border-bottom: #000000;
      }

      th, td {
    padding: 10px !important;
    border: 0.2px solid #333 !important;
  }

      table {
          text-align: start;
      }

      .overall-score-cell {
        background-color: rgba(0, 112, 248, 0.25)!important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;/* Light blue */
        font-weight: bold;
    }
    .service-type-cell {
        background-color: rgba(144, 238, 144, 0.5)!important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;/* Light green */
    }
    .overall_total_cell {
        background-color: rgba(221, 225, 221, 0.25)!important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;/* Light blue */
        font-weight: bold;
    }

    
  
      @media print {
  body * {
    visibility: hidden;
  }
  .office-header,
  .column-header th,


  .total-row td {
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }

  .all-overall-row td{
        background-color: rgba(255, 187, 0, 0.68) !important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    
        text-transform: uppercase;  
        border-top: none;
        border-bottom: #000000;
      }


.internal-header {
    background-color: #FFD966 !important;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
}
      .service-type-cell {
        background-color: rgba(144, 238, 144, 0.5)!important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;/* Light green */
    }
 .overall_total_cell {
        
    background-color: rgba(221, 225, 221, 0.25)!important; 
    
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;/* Light blue */
        font-weight: bold;
    }

   
    .overall-score-cell {
        background-color: rgba(0, 112, 248, 0.25)!important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;/* Light blue */
        font-weight: bold;
    }





    .all-overall-row td {
        background-color: rgba(252, 187, 56, 0.7)!important; /* Optional for ALL OVERALL row if you use it */
        font-weight: bold;
    }
  .overall_total_row_internal td{
        background-color: rgba(29, 174, 94, 0.56)!important; 
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        font-weight: bold;
        text-transform: uppercase;  
        border-top: none;
        border-bottom: #000000;
      }
      .overall_total_row_external td{
        background-color: rgba(18, 135, 244, 0.47)!important; /* Yellow-orange */
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        font-weight: bold;
        text-transform: uppercase;  
        border-top: none;
        border-bottom: #000000;
      }
  .office-header {
              background-color: rgb(21, 34, 119) !important;
              font-weight: normal !important;
              font-size: 20px !important;
              color: #ffffff !important;
           color:  #fff !important;
          }
          .column-header th {
              background-color: rgb(220, 223, 225) !important;
            font-weight: normal !important;
           color: #000000;
          }
          .total-row td {
              background-color: #FFD966 !important;  
          }
  #printableArea, #printableArea * {
    visibility: visible;
  }

  #printableArea {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
  }

  .print-button {
    display: none !important;
  }

  table {
    width: 100% !important;
    border-collapse: collapse !important; 

  }

  th, td {
    padding: 10px !important;
    border: 0.2px solid #333 !important;
  }

  
 

  .overall-row {
    background-color: rgba(173, 216, 230, 0.3) !important; /* Light blue with opacity */
    color: white !important;
    font-weight: bold;
  }
}

  </style>

<style>
  .print-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
  }
</style>

<button class="btn btn-primary mb-3 print-button" onclick="window.print()">Print as PDF</button>

  <!-- <h2 class="mb-4">Response Rate Per Service</h2> -->
  
  <!-- External Service Section -->
<div id="printableArea">
  <!-- External Service Section -->
  <h2 id="externalServiceTitle" class="mb-1"></h2>
  <table class="table table-bordered">
    <tbody id="tableBodyExternal">
        
    </tbody>
  

</table>

  <style>
    .officeSummaries{
        margin:0px; 
    }
    .summary{
        margin-top: 20px; ;
    }
</style>

<div id="summary" class="summary"> 
</div> 
<div id="officeSummaries" class="officeSummaries"></div>


  <h2 id="internalServiceTitle" class="mb-1"></h2>



  <table class="table table-bordered">
    <tbody id="tableBodyInternal"></tbody>
  </table>

  <div id="summary1" class="summary"> 
</div> 
<div id="officeSummaries1" class="officeSummaries"></div>
<div id="overallSummaryContainer"></div>



  
<h3>External Services Service Quality Dimension Summary</h3>
<table class="table table-bordered text-center" id="externalTable" style="border: 1px solid black;">
        <thead>
            <tr>
                <th class="internal-header"   style="background-color: #FFD966;text-align:center">Service</th>   
                <th> Service Quality Dimension</th>

                <th>1 (Strongly Disagree)</th>
                <th>2 (Disagree)</th>
                <th>3 (Neutral)</th>
                <th>4 (Agree)</th>
                <th>5 (Strongly Agree)</th>
                <th> N/A </th>
                <th> Total Responses</th>
                <th class="overall_total_cell"> Overall</th>
            </tr>
        </thead>
        <tbody id="externalTableBody"></tbody>
        <tfoot id="externalOverallTotal"></tfoot>
    </table>
    
    <!-- Internal Services Survey Summary -->
    <h3>Internal Services Service Quality Dimension Summary</h3>
    <table class="table table-bordered text-center" id="internalTable"  style="border: 1px solid black;"> 
        <thead>
            <tr>
                <th class="internal-header" style="background-color: #FFD966;text-align:center">Service</th>  <!-- Add Service column -->
                <th> Service Quality Dimension</th>

                <th>1 (Strongly Disagree)</th>
                <th>2 (Disagree)</th>
                <th>3 (Neutral)</th>
                <th>4 (Agree)</th>
                <th>5 (Strongly Agree)</th>
                <th> N/A </th>
                <th> Total Responses</th>
                <th class="overall_total_cell"> Overall</th>


            </tr>
        </thead>
        <tbody id="internalTableBody"></tbody>
        <tfoot id="internalOverallTotal"></tfoot>
    </table>

</div>
</div>

<script>
    let serviceType1 = 'internal'; // or 'internal'
    let serviceType2 = 'external'; // or 'internal'

    // Fetch and display External Service data
    fetch(`/response-rate-per-service/${serviceType2}`) // External service endpoint
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {

            const tableBody = document.getElementById('tableBodyExternal');
            document.getElementById('externalServiceTitle').textContent = 'External Service Response Rate'; // Set dynamic title

            // Iterate through the main offices
            data.data.forEach(mainOffice => {
                if (mainOffice.main_office) {  // Only process main office data if it's not the overall total row
                    // Main Office header
                    const mainOfficeRow = document.createElement('tr');
                    const mainOfficeCell = document.createElement('td');
                    mainOfficeCell.setAttribute('colspan', '5');
                    mainOfficeCell.className = 'office-header';
                    mainOfficeCell.textContent = mainOffice.main_office;
                    mainOfficeRow.appendChild(mainOfficeCell);
                    tableBody.appendChild(mainOfficeRow);

                    // Column headers
                 const headerRow = document.createElement('tr');
headerRow.className = 'column-header';

['Sub Office', 'Service', 'Clients who used the CSM', 'Transactions', 'Response Rate'].forEach(text => {
    const th = document.createElement('th');
    th.textContent = text;

    // Check if the column should be centered
    if (text === 'Clients who used the CSM' || text === 'Transactions' || text === 'Response Rate') {
        th.style.textAlign = 'center'; // Center the text for these columns
    }

    headerRow.appendChild(th);
});

tableBody.appendChild(headerRow);

                    // Sub Offices and Services
                    mainOffice.sub_offices.forEach(sub => {
                        const serviceCount = sub.services.length;
                        sub.services.forEach((service, index) => {
                            const row = document.createElement('tr');

                            // Only add sub office cell on the first service row
                            if (index === 0) {
                                const subOfficeCell = document.createElement('td');
                                subOfficeCell.textContent = sub.sub_office;
                                subOfficeCell.setAttribute('rowspan', serviceCount);
                                row.appendChild(subOfficeCell);
                            }

                            // Service Name
                            const serviceCell = document.createElement('td');
                            serviceCell.textContent = service.service_name;
                            row.appendChild(serviceCell);

                            // Survey Responses
                            const surveyResponsesCell = document.createElement('td');
                            surveyResponsesCell.textContent = service.survey_responses;
                            surveyResponsesCell.style.textAlign = 'center';
                            row.appendChild(surveyResponsesCell);

                            // Transactions
                            const transactionsCell = document.createElement('td');
                            transactionsCell.textContent = service.transactions;
                            transactionsCell.style.textAlign = 'center';
                            row.appendChild(transactionsCell);

                            // Rate
                            const rateCell = document.createElement('td');
                            rateCell.textContent = service.rate;
                            rateCell.style.textAlign = 'center';
                            row.appendChild(rateCell);

                            tableBody.appendChild(row);
                        });
                    });

                    // Total row
                    const totalRow = document.createElement('tr');
                    totalRow.className = 'total-row';

                    const totalLabel = document.createElement('td');
                    totalLabel.setAttribute('colspan', '2');
                    totalLabel.textContent = 'Total';
                    totalLabel.style.textAlign = 'left';

                    totalRow.appendChild(totalLabel);

                    const totalSurvey = document.createElement('td');
                    totalSurvey.textContent = mainOffice.total_survey_responses;
                    totalRow.appendChild(totalSurvey);
                    totalRow.style.textAlign = 'center';

                    const totalTrans = document.createElement('td');
                    totalTrans.textContent = mainOffice.total_transactions;
                    totalRow.appendChild(totalTrans);
                    totalTrans.style.textAlign = 'center';

                    const totalRate = document.createElement('td');
                    totalRate.textContent = mainOffice.total_rate;
                    totalRate.style.textAlign = 'center';
                    
                    totalRow.appendChild(totalRate);

                    tableBody.appendChild(totalRow);
                }
            });

            // Handle the "OVERALL" row separately
            const overallRow = document.createElement('tr');
            overallRow.className = 'overall_total_row_external';
           
            const overallLabel = document.createElement('td');
            overallLabel.setAttribute('colspan', '2');
            overallLabel.textContent = 'TOTAL FOR EXTERNAL SERVICES';
            overallRow.appendChild(overallLabel);

            // Append the "OVERALL" totals
            const overallSurvey = document.createElement('td');
            overallSurvey.textContent = data.data[data.data.length - 1].overall_total_survey_responses; // Last item is OVERALL
            overallSurvey.style.textAlign = 'center';
           
            overallRow.appendChild(overallSurvey);

            const overallTrans = document.createElement('td');
            overallTrans.textContent = data.data[data.data.length - 1].overall_total_transactions;
            overallTrans.style.textAlign = 'center';
          
            overallRow.appendChild(overallTrans);

            const overallRate = document.createElement('td');
            overallRate.textContent = data.data[data.data.length - 1].overall_total_rate;
            overallRate.style.textAlign = 'center';
          
            overallRow.appendChild(overallRate);

            tableBody.appendChild(overallRow);

// Create the summary container 

const summary = document.getElementById('summary');
  
const overall = data.data[data.data.length - 1];
const totalTrans = parseInt(overall.overall_total_transactions) || 0;
const totalResponses = parseInt(overall.overall_total_survey_responses) || 0;
const overallRate2 = parseFloat(overall.overall_total_rate) || 0;
  
// Build the summary content
summary.innerHTML = `
    The table above shows that out of <strong>${totalTrans.toLocaleString()}</strong> transactions for <strong>${serviceType2}</strong>, 
    <strong>${totalResponses.toLocaleString()}</strong> clients were able to use and accomplish both the printed and digital (online) versions, 
    with a total response rate of <strong>${overallRate2.toFixed(2)}%</strong>.<br><br>

    
`;

const summaryContainer = document.getElementById('officeSummaries');
summaryContainer.innerHTML = ''; // Clear old content

// Loop through the data and create summaries
data.data.forEach(item => {
  const officeName = item.main_office;
  const totalResponses = item.total_survey_responses;
  const totalTransactions = item.total_transactions;
  const totalRate = item.total_rate;

  // If any of the necessary values are undefined, skip this item and do not display it
  if (totalResponses !== undefined && totalTransactions !== undefined && totalRate !== undefined) {
    const summary = document.createElement('p'); 

    // Set the content of the summary
    summary.innerHTML = `For <strong>${officeName}</strong>, was able to attain
      <strong>${totalRate}</strong> CSM Ratings.`;

    // Append the summary to the container
    summaryContainer.appendChild(summary);
  }
});


// Append summary below the table 
        }
    })
    .catch(err => console.error('Error:', err));


   
</script>



<style>
.summary-paragraph {
    margin-top: 15px;
    padding: 10px; 
    border: 1px solid #d3d3d3;
    border-radius: 5px;
    font-size: 18px;
    line-height: 1.6;
    width: 1000px;
}
</style>













<script>
       fetch(`/response-rate-per-service/${serviceType1}`) // External service endpoint
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {

            const tableBody = document.getElementById('tableBodyInternal');
            document.getElementById('internalServiceTitle').textContent = 'Internal Service Response Rate'; // Set dynamic title

            // Iterate through the main offices
            data.data.forEach(mainOffice => {
                if (mainOffice.main_office) {  // Only process main office data if it's not the overall total row
                    // Main Office header
                    const mainOfficeRow = document.createElement('tr');
                    const mainOfficeCell = document.createElement('td');
                    mainOfficeCell.setAttribute('colspan', '5');
                    mainOfficeCell.className = 'office-header';
                    mainOfficeCell.textContent = mainOffice.main_office;
                    mainOfficeRow.appendChild(mainOfficeCell);
                    tableBody.appendChild(mainOfficeRow);

                    // Column headers
                    const headerRow = document.createElement('tr');
                    headerRow.className = 'column-header';
                    ['Sub Office', 'Service', 'Clients who used the CSM', 'Transactions', 'Response Rate'].forEach(text => {
                        const th = document.createElement('th');
                        th.textContent = text;
                        headerRow.appendChild(th);
                    });
                    tableBody.appendChild(headerRow);

                    // Sub Offices and Services
                    mainOffice.sub_offices.forEach(sub => {
                        const serviceCount = sub.services.length;
                        sub.services.forEach((service, index) => {
                            const row = document.createElement('tr');

                            // Only add sub office cell on the first service row
                            if (index === 0) {
                                const subOfficeCell = document.createElement('td');
                                subOfficeCell.textContent = sub.sub_office;
                                subOfficeCell.setAttribute('rowspan', serviceCount);
                                row.appendChild(subOfficeCell);
                            }

                            // Service Name
                            const serviceCell = document.createElement('td');
                            serviceCell.textContent = service.service_name;
                            row.appendChild(serviceCell);

                            // Survey Responses
                            const surveyResponsesCell = document.createElement('td');
                            surveyResponsesCell.textContent = service.survey_responses;
                            surveyResponsesCell.style.textAlign = 'center';

                            row.appendChild(surveyResponsesCell);

                            // Transactions
                            const transactionsCell = document.createElement('td');
                            transactionsCell.textContent = service.transactions;
                            transactionsCell.style.textAlign = 'center';

                            row.appendChild(transactionsCell);

                            // Rate
                            const rateCell = document.createElement('td');
                            rateCell.textContent = service.rate;
                            rateCell.style.textAlign = 'center';

                            row.appendChild(rateCell);

                            tableBody.appendChild(row);
                        });
                    });

                    // Total row
                    const totalRow = document.createElement('tr');
                    totalRow.className = 'total-row';

                    const totalLabel = document.createElement('td');
                    totalLabel.setAttribute('colspan', '2');
                    totalLabel.textContent = 'Total';
                    totalLabel.style.textAlign = 'left';
                    
                    totalRow.appendChild(totalLabel);

                    const totalSurvey = document.createElement('td');
                    totalSurvey.textContent = mainOffice.total_survey_responses;
                    totalSurvey.style.textAlign = 'center';

                    totalRow.appendChild(totalSurvey);

                    const totalTrans = document.createElement('td');
                    totalTrans.textContent = mainOffice.total_transactions;
                    totalTrans.style.textAlign = 'center';

                    totalRow.appendChild(totalTrans);

                    const totalRate = document.createElement('td');
                    totalRate.textContent = mainOffice.total_rate;
                    totalRate.style.textAlign = 'center';

                    totalRow.appendChild(totalRate);

                    tableBody.appendChild(totalRow);
                }
            });

            // Handle the "OVERALL" row separately
            const overallRow = document.createElement('tr');
            overallRow.className = 'overall_total_row_internal';
           
            const overallLabel = document.createElement('td');
            overallLabel.setAttribute('colspan', '2');
            overallLabel.textContent = 'TOTAL FOR INTERNAL SERVICES';
            overallRow.appendChild(overallLabel);

            // Append the "OVERALL" totals
            const overallSurvey = document.createElement('td');
            overallSurvey.textContent = data.data[data.data.length - 1].overall_total_survey_responses; // Last item is OVERALL
            overallSurvey.style.textAlign = 'center';
           
            overallRow.appendChild(overallSurvey);

            const overallTrans = document.createElement('td');
            overallTrans.textContent = data.data[data.data.length - 1].overall_total_transactions;
            overallTrans.style.textAlign = 'center';
           
            overallRow.appendChild(overallTrans);

            const overallRate = document.createElement('td');
            overallRate.textContent = data.data[data.data.length - 1].overall_total_rate;
            overallRate.style.textAlign = 'center';
           
            overallRow.appendChild(overallRate);

            tableBody.appendChild(overallRow);

            
const summary = document.getElementById('summary1');
  
  const overall = data.data[data.data.length - 1];
  const totalTrans = parseInt(overall.overall_total_transactions) || 0;
  const totalResponses = parseInt(overall.overall_total_survey_responses) || 0;
  const overallRate2 = parseFloat(overall.overall_total_rate) || 0;
    
  // Build the summary content
  summary.innerHTML = `
      The table above shows that out of <strong>${totalTrans.toLocaleString()}</strong> transactions for <strong>${serviceType1}</strong>, 
      <strong>${totalResponses.toLocaleString()}</strong> clients were able to use and accomplish both the printed and digital (online) versions, 
      with a total response rate of <strong>${overallRate2.toFixed(2)}%</strong>.<br><br>
  
      
  `;
  
  const summaryContainer = document.getElementById('officeSummaries1');
  summaryContainer.innerHTML = ''; // Clear old content
  
  // Loop through the data and create summaries
  data.data.forEach(item => {
    const officeName = item.main_office;
    const totalResponses = item.total_survey_responses;
    const totalTransactions = item.total_transactions;
    const totalRate = item.total_rate;
  
    // If any of the necessary values are undefined, skip this item and do not display it
    if (totalResponses !== undefined && totalTransactions !== undefined && totalRate !== undefined) {
      const summary = document.createElement('p'); 
  
      // Set the content of the summary
      summary.innerHTML = `For <strong>${officeName}</strong>, was able to attain
        <strong>${totalRate}</strong> CSM Ratings.`;
  
      // Append the summary to the container
      summaryContainer.appendChild(summary);
    }
  });
  
        }
    })
    .catch(err => console.error('Error:', err));


</script>





<script>
fetch('/response-rate-per-service-all')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const rowData = data.data[0]; // Only one row
            
            // CREATE ROW for overall data
            const allOverallRow = document.createElement('tr');
            allOverallRow.className = 'all-overall-row';

            const labelCell = document.createElement('td');
            labelCell.setAttribute('colspan', '2');
            labelCell.textContent = 'OVER-ALL TOTAL FOR EXTERNAL AND INTERNAL SERVICES';
            allOverallRow.appendChild(labelCell);

            const totalResponses = document.createElement('td');
            totalResponses.textContent = rowData.all_total_responses;
            totalResponses.style.textAlign = 'center';
            
            allOverallRow.appendChild(totalResponses);

            const totalTransactions = document.createElement('td');
            totalTransactions.textContent = rowData.all_total_transactions;
            totalTransactions.style.textAlign = 'center';
            
            allOverallRow.appendChild(totalTransactions);

            const totalRate = document.createElement('td');
            totalRate.textContent = rowData.all_total_rate;
            totalRate.style.textAlign = 'center';
           
            allOverallRow.appendChild(totalRate);

            // APPEND to the internal and external tables
            document.getElementById('tableBodyInternal').appendChild(allOverallRow);

            // Create the overall summary message
            const overallSummaryContainer = document.getElementById('overallSummaryContainer');
            overallSummaryContainer.innerHTML = ''; // Clear any previous content
            
            const currentYear = new Date().getFullYear();
            const currentQuarter = Math.ceil((new Date().getMonth() + 1) / 3); // Get current quarter
            
            // Overall summary text
            const overallSummaryText = `For the overall rate of external and internal services, SDO San Carlos City Pangasinan was able to attain 
            <strong>${rowData.all_total_rate} CSM Rating</strong>, out of <strong>${rowData.all_total_transactions}</strong> responses 
            within the <strong>Q${currentQuarter} ${currentYear}</strong>, 
            <strong>${rowData.all_total_responses}</strong> of clients were able to use and accomplish the digital version.`;
            
            const overallSummary = document.createElement('p');
            overallSummary.innerHTML = overallSummaryText;
            overallSummaryContainer.appendChild(overallSummary);

        }
    })
    .catch(err => console.error('Error fetching ALL OVERALL row:', err));
</script>












<script>fetch('/report_score')
    .then(response => response.json())
    .then(data => {
        function createTableRows(counts, serviceType, tableBodyId) {
            const tableBody = document.getElementById(tableBodyId);
            const sqdLabels = {
                1: 'Responsiveness',
                2: 'Reliability',
                3: 'Access & Facilities',
                4: 'Communication',
                5: 'Costs',
                6: 'Integrity',
                7: 'Assurance',
                8: 'Outcome'
            };

            const serviceRow = document.createElement('tr');
            const serviceCell = document.createElement('td');
            serviceCell.setAttribute('rowspan', '9');
            serviceCell.classList.add('service-type-cell');
            serviceCell.textContent = serviceType;
            serviceRow.appendChild(serviceCell);
            tableBody.appendChild(serviceRow);

            for (let i = 1; i <= 8; i++) {
                const sqdKey = `sqd${i}`;
                const row = document.createElement('tr');

                const sqdCell = document.createElement('td');
                sqdCell.textContent = sqdLabels[i];
                row.appendChild(sqdCell);

                // Scores 1–5
                for (let score = 1; score <= 5; score++) {
                    const cell = document.createElement('td');
                    cell.textContent = counts[sqdKey][score] || 0;
                    row.appendChild(cell);
                }

                // N/A count
                const naCell = document.createElement('td');
                naCell.textContent = counts[sqdKey]['na'] || 0;
                naCell.classList.add('na-cell');
                row.appendChild(naCell);

                // Total Responses
                const totalCell = document.createElement('td');
                totalCell.textContent = counts[sqdKey]['totalResponses'] || 0;
                totalCell.classList.add('overall_responses_cell');
                row.appendChild(totalCell);

                // % Score
                const percentCell = document.createElement('td');
                percentCell.textContent = (counts[sqdKey]['percentageScore'] || 0) + '%';
                percentCell.classList.add('overall_total_cell');
                row.appendChild(percentCell);

                tableBody.appendChild(row);
            }

            // OVERALL TOTAL ROW - Append to same tableBody
            const overallRow = document.createElement('tr');
            const overallLabelCell = document.createElement('td');
            overallLabelCell.setAttribute('colspan', '2');
            overallLabelCell.textContent = 'Overall Total';
            overallLabelCell.classList.add('overall-score-cell');
            overallRow.appendChild(overallLabelCell);

            let combined4 = 0;
            let combined5 = 0;
            let validTotal = 0;
            let grandTotal = 0;
            let totalNA = 0;

            // Calculate totals for each score (1-5)
            for (let score = 1; score <= 5; score++) {
                let total = 0;
                for (let i = 1; i <= 8; i++) {
                    const sqdKey = `sqd${i}`;
                    total += counts[sqdKey][score] || 0;
                    
                    // Add to combined counts for percentage calculation
                    if (score === 4) combined4 += counts[sqdKey][score] || 0;
                    if (score === 5) combined5 += counts[sqdKey][score] || 0;
                }
                
                const totalCell = document.createElement('td');
                totalCell.textContent = total;
                totalCell.classList.add('overall-score-cell');
                overallRow.appendChild(totalCell);
            }

            // Calculate N/A Total
            for (let i = 1; i <= 8; i++) {
                const sqdKey = `sqd${i}`;
                totalNA += counts[sqdKey]['na'] || 0;
                grandTotal += counts[sqdKey]['totalResponses'] || 0;
                validTotal += counts[sqdKey]['validResponses'] || 0;
            }

            // N/A Total Cell
            const naCell = document.createElement('td');
            naCell.textContent = totalNA;
            naCell.classList.add('overall-score-cell');
            overallRow.appendChild(naCell);

            // Grand Total Cell
            const totalResponsesCell = document.createElement('td');
            totalResponsesCell.textContent = grandTotal;
            totalResponsesCell.classList.add('overall-score-cell');
            overallRow.appendChild(totalResponsesCell);

            // Overall Percentage Cell
            const percentCell = document.createElement('td');
            const overallPercent = validTotal > 0 ? (((combined4 + combined5) / validTotal) * 100).toFixed(2) : '0.00';
            percentCell.textContent = `${overallPercent}%`;
            percentCell.classList.add('overall-score-cell');
            overallRow.appendChild(percentCell);

            // Append overall row to the same table body
            tableBody.appendChild(overallRow);
        }

        createTableRows(data.externalCounts, 'External Service', 'externalTableBody');
        createTableRows(data.internalCounts, 'Internal Service', 'internalTableBody');
    })
    .catch(error => console.error('Error fetching data:', error));
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    </div>
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

<p class="mb-0 text-muted">Cannot view report without data. No responses were recorded for Q{{ $quarter }} {{ now()->year }}.</p>

</div> 
@endif
@endsection