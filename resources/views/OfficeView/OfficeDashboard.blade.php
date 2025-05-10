@extends('layout.layout_office')
  <title>@yield('title','SDO-SCC Office')</title>
   
   
                                                                                          
@section('content')


<div class="container mb-5"  >  
    
    <style>
        .container{
            padding: 0px;
        }
        .card-container{
            padding: 20px; 
           
        }
        .main-content{
            padding: 0px; 
        }
          /* Dashboard Layout */
          .dashboard-container {
              display: grid;
              grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
              gap: 16px;
              padding: 20px; 
              padding-bottom: 5px; 

          }
  
          /* Card Design */
          .dashboard-card {
              background: #fff;
              border-radius: 12px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              padding: 16px;
              border: 1px solid #ccc;
              text-align: left;
              position: relative;
              transition: all 0.3s ease-in-out;
          }
  
          /* Accent Lines */
          .card-top-line {
              height: 4px;
              width: 40px;
              background-color: #007bff;
              border-radius: 2px;
              margin-bottom: 5px;
          }
  
          .card-sub-line {
              height: 4px;
              width: 20px;
              background-color: #007bff;
              border-radius: 2px;
              margin-bottom: 8px;
          }
  
          /* Large Numbers */
          .card-number {
              font-size: 2rem;
              font-weight: bold;
              color: #111;
              transition: font-size 0.3s ease-in-out;
          }
  
          /* Subtext */
          .card-subtext {
              font-size: 0.9rem;
              color: #b0b0b0;
              font-weight: 500;
              transition: font-size 0.3s ease-in-out;
          }
  
          /* Responsive Styles */
          @media (max-width: 1200px) {
              .dashboard-container {
                  grid-template-columns: repeat(3, 1fr); /* 3 Columns */
              }
          }
  
          @media (max-width: 900px) {
              .dashboard-container {
                  grid-template-columns: repeat(3, 1fr); /* Still 3 columns */
              }
              .dashboard-card {
                  padding: 12px; /* Reduce padding */
              }
              .card-number {
                  font-size: 1.5rem; /* Shrink numbers */
              }
              .card-subtext {
                  font-size: 0.75rem; /* Shrink text */
              }
          }
  
          @media (max-width: 600px) {
              .dashboard-container {
                  grid-template-columns: repeat(3, 1fr); /* 2 columns */
              }
              .title{
                font-size: 0.9rem;
              }
          }
  
          @media (max-width: 400px) {
              .dashboard-container {
                  grid-template-columns: repeat(2 , 1fr); /* 1 column for small screens */
              }
          }
          </style>
   
    <div class="dashboard-container"   >
        <!-- Card 1 -->
        <div class="dashboard-card"> 
    <div class="icon-container">
        {!! getIconSVG($overall_score) !!}
    </div>
    <div class="card-subtext">Office Status</div>
</div>  
        <div class="dashboard-card">
            <div class="card-top-line"></div>
            <div class="card-sub-line"></div>
            <div class="card-number">{{$total_responses}}</div>
            <div class="card-subtext"> Responses for Q{{ now()->quarter }} {{ now()->year }}</div>

        </div>

        <!-- Card 2 -->
        <div class="dashboard-card">
            <div class="card-top-line"></div>
            <div class="card-sub-line"></div>
            <div class="card-number">{{$services_count}}</div>
            <div class="card-subtext">Total Services</div>
        </div>

        <!-- Card 3 -->
   

        <style>
  .icon-container {
    display: inline-block;
    padding: 1px;
    border-radius: 50%;
    background-color: white;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    transition: all 0.3s ease-in-out;
    margin: 0px;
    margin-bottom: 10px;
    
  }

  .icon-container:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
  }
  
  .icon-container i {
    transition: color 0.3s ease, font-size 0.3s ease;
  }
</style>
<?php
function getIconSVG($score) {
    $color = '';

    if ($score < 0.60) {
        $color = '#F44336';
        $svg = view('components.svg.sad2')->render();
    }   
     else if ($score >= 0.60 && $score < 0.80) {
       $color = '#FF9800';
        $svg = view('components.svg.neutral')->render(); 
    } else if ($score >= 0.80 && $score < 0.95) {
        $color = '#8BC34A';
        $svg = view('components.svg.smile2')->render();
    } else if ($score >= 0.80 && $score < 0.95) {
       $color = ' #4CAF50';
        $svg = view('components.svg.smile')->render(); 
    } 
    
    else {
        return '';
    }

    // Wrap the SVG inside a div with dynamic color applied
    return "<div style='color: $color;'>$svg</div>";
}
?>



<div class="dashboard-card">
            <div class="card-top-line"></div>
            <div class="card-sub-line"></div>
            <div class="card-number">{{ number_format($overall_score * 100, 2) }}%
            </div>
            <div class="card-subtext">Strongly Agree & Agree</div>
        </div>





        <!-- Card 5 -->
        <!-- <div class="dashboard-card">
    <div class="card-top-line"></div>
    <div class="card-sub-line"></div>
    <div class="card-number">
        {{ $transaction ? $transaction->number_transaction : 'N/A' }}
    </div>
    <div class="card-subtext"> No. Of Transaction</div>
    @if($enableInput)
    <a href="{{ route('submit.transaction.form') }}" class="btn btn-primary w-100 mt-3 btn-sm">
        <b>Input</b>
    </a>
@endif


@if($shouldHighlight)
    <div class="warning-icon  " data-tooltip="  {{ $daysLeft }} days left.">
        <i class="fas fa-exclamation-circle zoom"></i>
    </div>
@endif


</div> -->
<style>
.warning-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: red;
    font-size: 22px;
    cursor: pointer;
}
/* Zoom In & Out Animation */
@keyframes zoomEffect {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
}

.zoom {
    animation: zoomEffect 1.6s infinite ease-in-out;
}


/* Shake Effect */
.shake {
    animation: shake 0.5s infinite;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-3px); }
    50% { transform: translateX(3px); }
    75% { transform: translateX(-3px); }
}


.warning-icon::after {
    content: attr(data-tooltip);
    position: absolute;
    right: 120%;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    font-size: 12px;
    padding: 5px 8px;
    border-radius: 5px;
    white-space: nowrap;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.warning-icon:hover::after {
    visibility: visible;
    opacity: 1;
}
</style>
 @include('components.alert')
        <!-- Card 6 -->
     
    </div>
   
  
@if($total_responses != 0)
<div class="container mb-3" style=" padding-left:20px;padding-right:20px;">


    <div class="card shadow-sm mt-3 card-container"  >
       <header class="header" style="width:100%;top:0">
    <!-- <img src="{{ asset('logo.png') }}" alt="Logo" class="logo"> -->
    <h4 class="office-name">Data of {{ session('office_name') }} Responses</h4>
 
     
   
</header> 



<!-- <div style="width: 500px; height: 500px;">
    <canvas id="sqdPieChart" style="width: 100%; height: 100%;"></canvas>
</div> -->

 
<!-- Include Chart.js and the Data Labels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

  <div style="width: 100%; height: auto;">
    <canvas id="sqdBarChart" style="width: 100%; height: 100%;"></canvas>
</div>
<div id="dataInterpretation"></div>

<!-- Include Chart.js and the Data Labels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    // Parse SQD Scores from Blade
    var sqd_scores = JSON.parse('{!! $sqd_scores !!}');

    console.log("SQD Scores from Blade:", sqd_scores);

    // Extract labels and scores
    const labels = Object.keys(sqd_scores);
    const scores = Object.values(sqd_scores);

    // Function to get color based on score
    function getColorForScore(score) {
        if (score < 60) return '#F44336'; 
        
        else if (score >=60 && score <=79.9) return '#FF9800'; // Orange
    
        else if (score >=80 && score <=94.9) return '#8BC34A'; // Orange
    
         else if (score >= 95 && score <=100 ) return '#4CAF50'; 
    }

    // Map scores to colors based on their values
    const backgroundColors = scores.map(score => getColorForScore(score));

    // Calculate dynamic font size based on window width
    function getFontSize() {
        const width = window.innerWidth;
        if (width <= 480) {  // Small devices like mobile
            return 10;
        } else if (width <= 768) {  // Medium devices like tablets
            return 12;
        } else {  // Larger devices like desktops
            return 14;
        }
    }

    // Calculate average score
    const averageScore = scores.reduce((sum, score) => sum + score, 0) / scores.length;
    let interpretation = "";

    // Add data interpretation using if-else logic
    if (averageScore <= 0.20) {
        interpretation = "The overall performance is very poor. Immediate attention is needed to improve scores across all SQDs.";
    } else if (averageScore <= 0.40) {
        interpretation = "The performance is below average. Some SQDs need improvement, especially in areas like responsiveness and reliability.";
    } else if (averageScore <= 0.60) {
        interpretation = "The performance is average. Some SQDs show improvement potential, but the overall score needs further enhancement.";
    } else if (averageScore <= 0.80) {
        interpretation = "The performance is above average. Most areas are doing well, but there's still room for improvement in specific SQDs.";
    } else {
        interpretation = "The performance is excellent! Most SQDs are performing at a high level, and the focus should be on maintaining this level.";
    }

    console.log("Data Interpretation:", interpretation);  // You can also display this on the page

    // Display interpretation on the page (if needed)
    document.getElementById('dataInterpretation').textContent = interpretation;

    // Chart Configuration
    const ctx = document.getElementById('sqdBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',  // Change to 'bar' for a bar chart
        data: {
            labels: labels,
            datasets: [{
                data: scores,
                backgroundColor: backgroundColors,  // Dynamic background color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,  // Make the chart responsive
            maintainAspectRatio: false,  // Allow the chart to scale as needed
            plugins: {
                legend: {
                    display: false  // Hide the legend for the bar chart
                },
                datalabels: {  // Display values inside the bars
                    color: 'white',  // Adjust text color for contrast
                    anchor: 'center',
                    align: 'center',
                    font: {
                        weight: 'bold',
                        size: getFontSize()  // Use dynamic font size based on window width
                    },
                    formatter: function(value, ctx) {
                        return value.toFixed(1);  // Display score value inside the bars
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,  // Ensure bars start at zero
                },
                y: {
                    ticks: {
                        beginAtZero: true,  // Ensure y-axis starts at zero
                        stepSize: 10,  // Adjust based on your data
                    },
                    min: 0,
                    max: 100
                }
            }
        },
        plugins: [ChartDataLabels]  // Register Data Labels Plugin
    });
</script>

 </div>

</div>
<div class="container" style=" padding-left:20px;padding-right:20px;">
    <div class="row">
        <!-- Left Panel: Scrollable Sub-Office Table -->
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 h-100 "  >
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="title mb-0">Service Quality Dimensions per Section</h3>
                </div>
                <div class="card-body"  >
                    <div id="subOfficeTableContainer"></div>
                </div>
            </div>
        </div>

        <!-- Right Panel: Scrollable Additional Info -->
        <div class="col-lg-5">
        <div class="card shadow-lg border-0 ">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="title mb-0">Section Status</h4>
                </div>
                <div class="card-body" style="max-height: 800px;  ">
                    <!-- <p class="text-muted">This section can contain any other details like statistics, graphs, or summaries.</p> -->
                    <div class="mb-3">
    <h6 class="fw-bold">Score Guide</h6>
    <div class="table-responsive">
        <table class="table table-bordered text-center small mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">Color</th>
                    <th>Score Range</th>
                    <th>Equivalent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color: #F44336;"></td>
                    <td>Below 60%</td>
                    <td>Poor</td>
                </tr>
                <tr>
                    <td style="background-color: #FF9800;"></td>
                    <td>60% - 79%</td>
                    <td>Fair</td>
                </tr>
                <tr>
                    <td style="background-color: #8BC34A;"></td>
                    <td>80% - 94%</td>
                    <td>Satisfactory</td>
                </tr>
                <tr>
                    <td style="background-color: #4CAF50;"></td>
                    <td>95% - 100%</td>
                    <td>Outstanding</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

                  
                    <canvas id="sectionScoreBarChart" height="400" width="500"></canvas>
<div id="customLegend" class="mt-3"></div>

                    <!-- <img src="{{ asset('undraw_spreadsheet_g2tr.svg') }}" alt="SVG Image" style="width: 300px;"> -->

                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const officeId = "{{ session('office_id') }}"; // Get the session-based office ID
        fetch(`/api/ranked-section/${officeId}`)
            .then(response => response.json())
            .then(data => {
            // Filter out offices with 0 responses
            const validOffices = data.rankedOffices.filter(o => o.total_responses > 0);

            const labels = validOffices.map(o => o.office_name);
            const scores = validOffices.map(o => (o.overall_score * 100).toFixed(2));
            const backgroundColors = validOffices.map(o => {
                const score = o.overall_score;
                if (score < 0.60) return '#F44336';       // Red
                else if (score < 0.80) return '#FF9800';   // Orange
                else if (score < 0.95) return '#8BC34A';   // Light Green
                else return '#4CAF50';                     // Green
            });

            // Custom plugin to draw wrapped labels
            const customLabelPlugin = {
                id: 'customLabelPlugin',
                afterDatasetsDraw(chart) {
                    const ctx = chart.ctx;
                    ctx.save();

                    chart.data.labels.forEach((label, i) => {
                        const meta = chart.getDatasetMeta(0).data[i];
                        const x = chart.chartArea.left - 10;
                        const y = meta.y;

                        const lines = label.match(/.{1,20}/g); // Wrap every 20 characters
                        lines.forEach((line, j) => {
                            ctx.font = "12px Arial";
                            ctx.fillStyle = "#333";
                            ctx.textAlign = "right";
                            ctx.textBaseline = "middle";
                            ctx.fillText(line, x, y + j * 12 - ((lines.length - 1) * 6));
                        });
                    });

                    ctx.restore();
                }
            };

            const ctx = document.getElementById('sectionScoreBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Overall Score (%)',
                        data: scores,
                        backgroundColor: backgroundColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    layout: {
                        padding: {
                            left: 150
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function (value) {
                                    return value + "%";
                                }
                            }
                        },
                        y: {
                            ticks: { display: false },
                            grid: { drawTicks: false }
                        }
                    }
                },
                plugins: [customLabelPlugin]
            });

                // Custom Legend
                const legendContainer = document.getElementById('customLegend');
                let legendHTML = '';
                validOffices.forEach((o, index) => {
                    legendHTML += `
                        <div class="d-flex align-items-center mb-1">
                            <span class="me-2" style="width: 16px; height: 16px; background-color: ${backgroundColors[index]}; display: inline-block; border-radius: 2px;"></span>
                            <span>${o.office_name}</span>
                        </div>`;
                });
                legendContainer.innerHTML = legendHTML;
            })
            .catch(error => {
                console.error('Error loading section chart:', error);
            });
    });
</script>


<style>
    img {
        width: 100%;
        max-width: 400px;
        height: auto;
    }

    @media (max-width: 576px) {
        img {
            max-width: 200px;  /* Smaller image for mobile */
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadSubOfficeScores(); // Load immediately
        setInterval(loadSubOfficeScores, 100000); // Refresh every 10 seconds
    });

    function loadSubOfficeScores() {
    fetch('/scores-sub_offices')
        .then(response => response.json())
        .then(data => {
            const rankedSubOfficesPerSQD = data.rankedSubOfficesPerSQD;
            const tableContainer = document.querySelector('#subOfficeTableContainer');
            tableContainer.innerHTML = ''; // Clear old content

            const sqdNames = {
                sqd1: "Responsiveness",
                sqd2: "Reliability",
                sqd3: "Access and Facilities",
                sqd4: "Communication",
                sqd5: "Costs",
                sqd6: "Integrity",
                sqd7: "Assurance",
                sqd8: "Outcome"
            };

            for (const sqd in rankedSubOfficesPerSQD) {
                const subOffices = rankedSubOfficesPerSQD[sqd];
                const subOfficeNames = Object.keys(subOffices);
                const scores = subOfficeNames.map(name => (subOffices[name].score * 100).toFixed(2));

                const canvasId = `chart-${sqd}`;
                const sqdDisplayName = `${sqd.toUpperCase()} - ${sqdNames[sqd] || sqd}`;

                tableContainer.innerHTML += `
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">${sqdDisplayName}</h6>
                            <canvas id="${canvasId}" height="${subOfficeNames.length * 40}"></canvas>
                        </div>
                    </div>
                `;

                // Wait for DOM to render before initializing Chart
                setTimeout(() => {
                    const ctx = document.getElementById(canvasId).getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: subOfficeNames,
                            datasets: [{
                                label: 'Score (%)',
                                data: scores,
                                backgroundColor: '#198754' // Bootstrap success green
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            scales: {
                                x: {
                                    min: 0,
                                    max: 100,
                                    title: {
                                        display: true,
                                        text: 'Score %'
                                    }
                                },
                                y: {
                                    ticks: {
                                        autoSkip: false,
                                        maxTicksLimit: 100
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => `${ctx.raw}%`
                                    }
                                }
                            }
                        }
                    });
                }, 50);
            }
        })
        .catch(error => {
            console.error('Error fetching sub-office scores:', error);
        });
}

</script>


<!-- Bootstrap JS (optional for functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>






         
    @else
    <style>
    img {
        width: 100%;
        max-width: 400px;
        height: auto;
    }

    @media (max-width: 576px) {
        img {
            max-width: 200px;  /* Smaller image for mobile */
        }
    }
</style>

<img src="{{ asset('undraw_users-per-minute_eg97.svg') }}" alt="SVG Image">

     <div class="card-subtext">No responses for {{ now()->format('F Y') }}.</div>

@endif

    <!-- Graphs -->
    <!-- <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="text-center">Average Scores for Each SQD</h5>
            <canvas id="sqdChart"></canvas>
        </div>
    </div> -->
</div> 

<?php
    $sqdCounts = isset($sqd_counts) ? implode(',', $sqd_counts) : '';
    $sqdTotals = isset($sqd_totals) ? implode(',', $sqd_totals) : '';
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('sqdChart').getContext('2d');

    // PHP values injected here
    var sqdCounts = [<?= $sqdCounts ?>];
    var sqdTotals = [<?= $sqdTotals ?>];

    // Compute averages
    const avgScores = sqdCounts.map((count, index) => count ? (sqdTotals[index] / count).toFixed(2) : 0);

    // Function to return color based on score
    function getColorForScore(score) {
        if (score < 0.60)  return '#F44336';     
        else if (score >= 0.60 && score < 0.80)  return '#FF9800'; // Orange
        else if (score >= 0.80 && score < 0.95)  return '#8BC34A'; // Amber
    else if (score > 0.95) return '#4CAF50';  
              
}
 


    // Convert all to floats and map to colors
    const backgroundColors = avgScores.map(score => getColorForScore(parseFloat(score)));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'SQD1 - Responsiveness', 'SQD2 - Reliability', 'SQD3 - Facilities', 'SQD4 - Communication', 
                'SQD5 - Costs', 'SQD6 - Integrity', 'SQD7 - Assurance', 'SQD8 - Outcome'
            ],
            datasets: [{
                label: 'Average Score',
                data: avgScores,
                backgroundColor: backgroundColors
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
