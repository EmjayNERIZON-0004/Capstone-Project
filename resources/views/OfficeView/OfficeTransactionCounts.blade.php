@extends('layout.layout_office')

@section('content')
<style>
    .container{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>
<div class="container p-2 mt-4" style="background-color: none;">
<div style="
    background-color: #f8f9fa;
    color: #343a40;
    padding: 16px 24px;
    border-left: 5px solid #0d6efd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    margin: 10px 0px;
">
    <div style="font-size: 28px; font-weight: 600; margin-bottom: 4px;">
        Transaction Count Status
    </div>
    <div style="font-size: 14px; color: #6c757d;">
        Overview of service transaction counts and performance metrics
    </div>
</div>


    <input type="hidden" id="main-office-id" value="{{ session('office_id') }}">
    
    <!-- Dashboard Cards -->
    <div class="row mb-1">
        <!-- Submitted Services Card -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-success h-100 shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters  ">
                        <div class="col-auto"  >
                      <div class="col-auto align-self-start"  >
  <div style="background-color:rgb(10, 148, 63);border-radius:50px;padding:10px">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-check-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
    </svg>
  </div>
</div>

                        </div>
                        <div class="col ml-3">
                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">Submitted Services</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="submitted-count">0</div>
                            <div class="progress mt-2" style="height: 8px;">
                                <div id="submitted-progress" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pending Services Card -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-secondary h-100 shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters ">
                        <div class="col-auto">
                        <div style="background-color:#5a5c69;border-radius:50px;padding:10px">  
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                            </svg>
                        </div> 
                        </div>
                        <div class="col ml-3">
                            <div class="text-lg font-weight-bold text-secondary text-uppercase mb-1">Pending Services</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="pending-count">0</div>
                            <div class="progress mt-2" style="height: 8px;">
                                <div id="pending-progress" class="progress-bar bg-secondary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Completed Sections Card -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-primary h-100 shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters  ">
                        <div class="col-auto">
                              <div style="background-color:#0d6efd;border-radius:50px;padding:10px">  


                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-building" viewBox="0 0 16 16">
                                <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z"/>
                            </svg>
                        </div>
                        </div>
                        <div class="col ml-3">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Completed Sections</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><span id="completed-sections">0</span>/<span id="total-sections">0</span></div>
                            <div class="progress mt-2" style="height: 8px;">
                                <div id="section-progress" class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Transactions Card -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-left-success h-100 shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters  ">
                        <div class="col-auto">
                              <div style="background-color:rgb(10, 148, 63);border-radius:50px;padding:10px">  

                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                            </svg>
                              </div>
                        </div>
                        <div class="col ml-3">
                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">Total Transactions</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="total-transactions">0</div>
                            <div class="mt-2 small text-muted" id="avg-transactions"  style="display: none;">Avg: 0 per service</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Services Submission Status -->
        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm h-100" style="border:1px solid #ddd">
                                   <div class="m-0 font-weight-normal text-muted text-center pt-3">Submission Status by Service</div>

                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="services-chart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Transaction Completion by Section -->
        <div class="col-lg-8 mb-3">
            <div class="card shadow-sm h-100" style="border:1px solid #ddd">
                                                     <div class="m-0 font-weight-normal text-muted text-center pt-3">Section Completion Rate</div>

                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="sections-completion-chart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Transaction Trend & Distribution -->
    <div class="row mb-4">
        <!-- Transaction Count by Sub Office -->
        <div class="col-lg-8 mb-3">
            <div class="card shadow-sm h-100" style="border:1px solid #ddd">
                                                 <div class="m-0 font-weight-normal text-muted text-center pt-3">Transaction Count by Section</div>

                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="transaction-by-section-chart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Service Distribution -->
        <div class="col-lg-4 mb-3">
          <div class="card shadow-sm h-100" style="border:1px solid #ddd;">
  <div class="d-flex align-items-center justify-content-center pt-3">
    <!-- SVG Icon -->
                                <!-- <div style="background-color:rgb(10, 148, 63);border-radius:50px;padding:10px">  

    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-bar-chart" viewBox="0 0 16 16">
      <path d="M0 0h1v15h15v1H0V0z"/>
      <path d="M10 10h1v3h-1v-3zM6 6h1v7H6V6zM2 3h1v10H2V3z"/>
    </svg>
                                </div> -->
    <!-- Title -->
    <span class="ms-2 text-muted fw-bold">Most Transaction Count</span>
  </div>

  <div class="card-body">
    <div id="top-services-container"></div>
  </div>
</div>

        </div>
    </div>
    
    <!-- Responsive table wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="transaction-table">
                    <thead>
                        <tr>
                            <th>Sub Office</th>
                            <th>Service Name</th>
                            <th>Status</th>
                            <th style="width: 80px;text-align:center">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style> 
    /* General styling */
    .card {
        border: none;
        border-radius: 8px;
    }
    
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .text-xs {
        font-size: 0.7rem;
    }
    
      
    
    .font-weight-bold {
        font-weight: 700 !important;
    }
    
    .text-gray-800 {
        color: #5a5c69 !important;
    }
    
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    }
    
    /* Table styles */
    td, th {
        padding: 0.5rem !important;
        font-size: 0.85rem;
    }

    .badge {
        font-size: 0.8rem;
        font-weight: normal; 
        width: 100px;
        color: white;
    }
    
    /* Progress bars */
    .progress {
        background-color: #eaecf4;
        border-radius: 0.25rem;
    }
    
    /* Service progress item */
    .service-progress-item {
        margin-bottom: 1rem;
    }
    
    .service-name {
        margin-bottom: 0.25rem;
        display: flex;
        justify-content: space-between;
    }

    @media (max-width: 576px) {
        table, td, th {
            font-size: 0.75rem;
        }
        .badge { 
            font-size: 0.7rem;    
            width: 60px;
            text-align: center;
            padding: 3px;
        }
        
        .card-body {
            padding: 1rem;
        }
    } 
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainId = document.getElementById('main-office-id').value;

    if (!mainId) {
        alert('Main office ID is not available.');
        return;
    }

    fetch(`/transaction-status/${mainId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not OK');
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.querySelector('#transaction-table tbody');
            tableBody.innerHTML = '';  // Clear existing rows

            const subOffices = data.sub_offices;
            let submittedCount = 0;
            let pendingCount = 0;
            let totalTransactions = 0;
            let sectionData = [];
            let topServices = [];
            
            // Update sections progress
            document.getElementById('completed-sections').textContent = data.completed_sub_offices;
            document.getElementById('total-sections').textContent = data.total_sub_offices;
            
            // Calculate section completion percentage
            const sectionCompletionPercentage = data.total_sub_offices > 0 ? 
                (data.completed_sub_offices / data.total_sub_offices * 100).toFixed(0) : 0;
            
            document.getElementById('section-progress').style.width = `${sectionCompletionPercentage}%`;
            document.getElementById('section-progress').setAttribute('aria-valuenow', sectionCompletionPercentage);

            // Process suboffices data
            if (Array.isArray(subOffices) && subOffices.length > 0) {
                subOffices.forEach(subOffice => {
                    const services = subOffice.services;
                    let subOfficeTransactionTotal = 0;
                    let subOfficeSubmittedCount = 0;
                    let subOfficePendingCount = 0;

                    if (Array.isArray(services) && services.length > 0) {
                        services.forEach((service, index) => {
                            // Count submitted and pending services
                            if (service.transaction_saved) {
                                submittedCount++;
                                subOfficeSubmittedCount++;
                                if (service.count !== null) {
                                    totalTransactions += service.count;
                                    subOfficeTransactionTotal += service.count;
                                    
                                    // Add to top services array
                                    topServices.push({
                                        name: service.service_name,
                                        count: service.count,
                                        section: subOffice.sub_office
                                    });
                                }
                            } else {
                                pendingCount++;
                                subOfficePendingCount++;
                            }

                            // Create table rows
                            const row = document.createElement('tr');
                            if (index === 0) {
                                row.innerHTML = `
                                    <td rowspan="${services.length}">${subOffice.sub_office}</td>
                                    <td>${service.service_name}</td>
                                    <td>
                                        <span class="badge ${service.transaction_saved ? 'bg-primary' : 'bg-secondary'}">
                                            ${service.transaction_saved ? 'Submitted' : 'Pending'}
                                        </span>
                                    </td>
                                    <td style="text-align:center">${service.count !== null ? service.count : ''}</td>
                                `;
                            } else {
                                row.innerHTML = `
                                    <td>${service.service_name}</td>
                                    <td>
                                        <span class="badge ${service.transaction_saved ? 'bg-primary' : 'bg-secondary'}">
                                            ${service.transaction_saved ? 'Submitted' : 'Not Yet'}
                                        </span>
                                    </td>
                                    <td style="text-align:center">${service.count !== null ? service.count : ''}</td>
                                `;
                            }
                            tableBody.appendChild(row);
                        });
                        
                        // Add section data for chart
                        sectionData.push({
                            name: subOffice.sub_office,
                            total: subOfficeTransactionTotal,
                            submitted: subOfficeSubmittedCount,
                            pending: subOfficePendingCount,
                            completion: services.length > 0 ? 
                                (subOfficeSubmittedCount / services.length * 100).toFixed(0) : 0
                        });
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${subOffice.sub_office}</td>
                            <td colspan="3">No services found</td>
                        `;
                        tableBody.appendChild(row);
                        
                        // Add empty section data
                        sectionData.push({
                            name: subOffice.sub_office,
                            total: 0,
                            submitted: 0,
                            pending: 0,
                            completion: 0
                        });
                    }
                });
            }

            // Calculate total services
            const totalServices = submittedCount + pendingCount;
            
            // Calculate percentages for progress bars
            const submittedPercentage = totalServices > 0 ? 
                (submittedCount / totalServices * 100).toFixed(0) : 0;
            const pendingPercentage = totalServices > 0 ? 
                (pendingCount / totalServices * 100).toFixed(0) : 0;
            
            // Update card counts
            document.getElementById('submitted-count').textContent = submittedCount;
            document.getElementById('pending-count').textContent = pendingCount;
            document.getElementById('total-transactions').textContent = totalTransactions;
            
            // Calculate average transactions per submitted service
            const avgTransactions = submittedCount > 0 ? 
                (totalTransactions / submittedCount).toFixed(1) : 0;
            document.getElementById('avg-transactions').textContent = `Avg: ${avgTransactions} per service`;
            
            // Update progress bars
            document.getElementById('submitted-progress').style.width = `${submittedPercentage}%`;
            document.getElementById('submitted-progress').setAttribute('aria-valuenow', submittedPercentage);
            
            document.getElementById('pending-progress').style.width = `${pendingPercentage}%`;
            document.getElementById('pending-progress').setAttribute('aria-valuenow', pendingPercentage);

            // Create services status chart
            const servicesCtx = document.getElementById('services-chart').getContext('2d');
            new Chart(servicesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Submitted', 'Pending'],
                    datasets: [{
                        data: [submittedCount, pendingCount],
                        backgroundColor: ['#4e73df', '#e0e0e0'],
                        hoverBackgroundColor: ['#3e62c7', '#d1d1d1'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    },
                    cutout: '70%'
                }
            });

            // Create sections completion chart
            const sectionsCompletionCtx = document.getElementById('sections-completion-chart').getContext('2d');
            new Chart(sectionsCompletionCtx, {
                type: 'bar',
                data: {
                    labels: sectionData.map(section => section.name),
                    datasets: [{
                        label: 'Completion Percentage',
                        data: sectionData.map(section => section.completion),
                        backgroundColor: '#4e73df',
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const section = sectionData[context.dataIndex];
                                    return [
                                        `Completion: ${section.completion}%`,
                                        `Submitted: ${section.submitted}`,
                                        `Pending: ${section.pending}`
                                    ];
                                }
                            }
                        }
                    }
                }
            });
            
            // Create transaction by section chart
            const transactionBySubOfficeCtx = document.getElementById('transaction-by-section-chart').getContext('2d');
            new Chart(transactionBySubOfficeCtx, {
                type: 'bar',
                data: {
                    labels: sectionData.map(section => section.name),
                    datasets: [{
                        label: 'Transaction Count',
                        data: sectionData.map(section => section.total),
                        backgroundColor: '#198754   ',
                        barPercentage: 0.6,
                        categoryPercentage: 0.7
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
            
            // Create top services visualization
            // Sort services by count and take top 5
            topServices.sort((a, b) => b.count - a.count);
            const topFiveServices = topServices.slice(0, 5);
            
            const topServicesContainer = document.getElementById('top-services-container');
            topServicesContainer.innerHTML = '';
            
            topFiveServices.forEach(service => {
                const progressItem = document.createElement('div');
                progressItem.className = 'service-progress-item';
                
                const maxCount = topFiveServices[0].count;
                const percentage = (service.count / maxCount * 100).toFixed(0);
                
                progressItem.innerHTML = `
                    <div class="service-name">
                        <span class="text-truncate" style="max-width: 70%;">${service.name}</span>
                        <span class="small text-gray-800">${service.count}</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: ${percentage}%" 
                            aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="small text-muted mt-1">${service.section}</div>
                `;
                
                topServicesContainer.appendChild(progressItem);
            });
            
            // Show "No data available" if no services found
            if (topFiveServices.length === 0) {
                topServicesContainer.innerHTML = '<div class="text-center text-muted">No data available</div>';
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Failed to fetch transaction data.');
        });
});
</script>
@endsection