@extends('layout.general_layout')

@section('title', 'Manage Requests')

@section('content')     
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">

<div class="wrapper">
    <div class="content">


<!-- Request Dashboard Cards -->
<div class="container mt-4">
<div class="container mt-4">
  
   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    <div id="customAlertContainer"   ></div>



    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Requests Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
 <div class="dashboard-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">

  <!-- Total Requests -->
  <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; justify-content: space-between; align-items: center;">
         
          <h2 class="card-number text-dark" id="totalRequestsCount">{{ $totalCount }}</h2>
      
        <div class="bg-primary" style="  padding: 10px; border-radius: 50%;">
          <img src="{{ asset('clipboard.svg') }}" style="width: 40px; height: 40px;">
        </div>
      </div>
          <h5 class="card-title">Total Requests</h5>
      <p class="card-subtext">All kinds of request. </p>

      <div class="progress mt-3" style="height: 5px;">
        <div class="progress-bar bg-primary" style="width: 100%"></div>
      </div>
    </div>
  </div>

  <!-- Pending Requests -->
  <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; justify-content: space-between; align-items: center;">
       
          <h2 class="card-number text-dark" id="pendingRequestsCount">{{ $pendingCount }}</h2>
     
        <div style="background-color: rgb(255, 157, 0); padding: 10px; border-radius: 50%;">
          <img src="{{ asset('clock.svg') }}" style="width: 40px; height: 40px;">
        </div>
      </div>
          <h5 class="card-title">Pending Requests</h5>
      <p class="card-subtext">Waiting to view... </p>

      <div class="progress mt-3" style="height: 5px;">
        <div class="progress-bar bg-warning" style="width: <?= $totalCount > 0 ? ($pendingCount / $totalCount * 100) : 0 ?>%"></div>
      </div>
    </div>
  </div>

  <!-- Approved Requests -->
  <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        
          <h2 class="card-number text-dark" id="approvedRequestsCount">{{ $approvedCount }}</h2>
        
        <div style="background-color: #4CAF50; padding: 10px; border-radius: 50%;">
          <img src="{{ asset('check3.svg') }}" style="width: 40px; height: 40px;">
        </div>
      </div>
          <h5 class="card-title">Approved Requests</h5>
      <p class="card-subtext">Accepted </p>

      <div class="progress mt-3" style="height: 5px;">
        <div class="progress-bar bg-success" style="width: <?= $totalCount > 0 ? ($approvedCount / $totalCount * 100) : 0 ?>%"></div>
      </div>
    </div>
  </div>

  <!-- Rejected Requests -->
  <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        
          <h2 class="card-number text-dark" id="rejectedRequestsCount">{{ $rejectedCount }}</h2>
        
        <div style="background-color: #e53935; padding: 10px; border-radius: 50%;">
          <img src="{{ asset('cross2.svg') }}" style="width: 40px; height: 40px;">
        </div>
      </div>
          <h5 class="card-title">Rejected Requests</h5>
      <p class="card-subtext">Office request's rejected.</p>

      <div class="progress mt-3" style="height: 5px;">
        <div class="progress-bar bg-danger" style="width: <?= $totalCount > 0 ? ($rejectedCount / $totalCount * 100) : 0 ?>%"></div>
      </div>
    </div>
  </div>
</div>

  <!-- Request Dashboard Cards -->
<div class="container mt-4">
 
  
  <!-- Second Row with Additional Analytics -->
  <div class="row">
    <!-- Requests by Type (Existing) -->
    
    
    <!-- NEW: Requests by Office -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
     <div class="card-header bg-white border-0">
  <h5 class="fw-bold mb-0 d-flex align-items-center "
  style="
    font-family:Verdana, Geneva, Tahoma, sans-serif">
    
    Requests by Office
  </h5>
</div>




        <div class="card-body p-0">
          <ul class="list-group list-group-flush" id="officeRequestsList">
            @if(count($officeRequests) > 0)
              @foreach($officeRequests as $office)
                <li class="list-group-item border-0 py-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                      <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
    
    style="width: 40px; height: 40px; 
    ">
      <img src="{{ asset('office-building.svg') }}" alt="Building Icon" style="width: 25px; height: 25px;">
    </div>
                      <span class="fw-semibold">{{ $office->main_office_id }}</span>
                    </div>
                    <div>
                      <span class="badge bg-primary rounded-pill "
                      style="font-size: 16px;"
                      >{{ $office->request_count }} Requests</span>
                    </div>
                  </div>
                  <div class="progress mt-2" style="height: 5px;">
                    <div class="progress-bar bg-primary" style="width: <?= ($office->request_count / $totalCount) * 100 ?>%"></div>
                  </div>
                </li>
              @endforeach
            @else
              <li class="list-group-item border-0 py-3 text-center">
                <p class="text-muted mb-0">No office data available</p>
              </li>
            @endif
        </ul>
    </div>
</div>
</div>

<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 d-flex align-items-center "
  style="
    font-family:Verdana, Geneva, Tahoma, sans-serif">
     
    Recent Activities
  </h5>
      
      
      
      
        <button id="refresh-activity" class="btn btn-sm btn-light" title="Refresh activities">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>
    <div class="card-body p-0">
        <ul id="recent-activity-list" class="list-group list-group-flush">
            <!-- Activity items will be dynamically inserted here -->
            <li class="list-group-item border-0 py-3">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="card-footer bg-white border-0 text-center">
    <a id="view-all-activities" class="text-decoration-none" style="cursor: pointer;">View All Activities</a>
</div>
  </div>
</div>
  </div>

<style>
  .card {
    border-radius: 10px;
    border: 1px solid #eee;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }
  
  .progress {
    border-radius: 10px;
    background-color: #f5f5f5;
  }
  
  .progress-bar {
    border-radius: 10px;
  }
  
  .card-header {
    padding: 1rem 1.25rem;
  }
  
  .rounded-circle {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .badge {
    font-weight: normal;
    padding: 0.5em 0.8em;
  }
</style>


</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const listElement = document.getElementById("recent-activity-list");
    const viewAllButton = document.getElementById("view-all-activities");
    const refreshButton = document.getElementById("refresh-activity");

    let allActivities = [];
    let isShowingAll = false;

    function showLoading() {
        listElement.innerHTML = `
            <li class="list-group-item border-0 py-3">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </li>
        `;
    }

    function renderActivities(limit = 2) {
        const activitiesToShow = isShowingAll ? allActivities : allActivities.slice(0, limit);
        if (activitiesToShow.length === 0) {
            listElement.innerHTML = `
                <li class="list-group-item border-0 py-3 text-center text-muted">
                    No recent activity found.
                </li>
            `;
            return;
        }

        listElement.innerHTML = activitiesToShow.map(activity => `
            <li class="list-group-item border-0 py-3">
                <div class="d-flex align-items-start">
                    <div class="me-3">
  <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
    <img src="{{ asset('clock.svg') }}" alt="Clock Icon" style="width: 30px; height: 30px;">
  </div>
</div>

                    <div>
                        <div class="fw-bold">${activity.title}</div>
                        <div class="text-muted small">${activity.description}</div>
                        <div class="text-muted small">${activity.time_ago}</div>
                    </div>
                </div>
            </li>
        `).join('');
    }

    function fetchActivities() {
        showLoading();
        fetch('/api/recent-activities')
            .then(response => response.json())
            .then(data => {
                allActivities = data.activities || [];
                isShowingAll = false;
                viewAllButton.textContent = "View All Activities";
                renderActivities();
            })
            .catch(err => {
                console.error("Error loading activities", err);
                listElement.innerHTML = `
                    <li class="list-group-item border-0 py-3 text-center text-danger">
                        Failed to load activities.
                    </li>
                `;
            });
    }

    // Event: Toggle view all
    viewAllButton.addEventListener("click", function () {
        isShowingAll = !isShowingAll;
        viewAllButton.textContent = isShowingAll ? "View Less" : "View All Activities";
        renderActivities();
    });

    // Event: Refresh
    refreshButton.addEventListener("click", function () {
        fetchActivities();
    });

    // Load on page ready
    fetchActivities();
});
</script>



<!-- Add this if you still want to refresh the data dynamically via AJAX -->
<script>
// Function to update dashboard when request status changes
function refreshDashboard() {
    fetch("{{ route('dashboard.data') }}")
        .then(response => response.json())
        .then(data => {
            // Update status counts
            document.getElementById('totalRequestsCount').textContent = data.total;
            document.getElementById('pendingRequestsCount').textContent = data.pending;
            document.getElementById('approvedRequestsCount').textContent = data.approved;
            document.getElementById('rejectedRequestsCount').textContent = data.rejected;
            
            // You could also update the office requests list here if needed
            // updateOfficeRequestsList(data.officeRequests);
        })
        .catch(error => {
            console.error("Error fetching dashboard data:", error);
        });
}

// Call this function after approving/rejecting a request to refresh data without page reload
// Example: In your updateRequest function, call refreshDashboard() after success
</script>
  <!-- Second Row with Additional Analytics -->


  
</div>

<style>
  .card {
    border-radius: 10px;
    border: 1px solid #eee;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }
  
  .progress {
    border-radius: 10px;
    background-color: #f5f5f5;
  }
  
  .progress-bar {
    border-radius: 10px;
  }
  
  .card-header {
    padding: 1rem 1.25rem;
  }
  
  .rounded-circle {
    height: 50px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>





        <div class="container mt-3" >
            <div class="card shadow-sm  " style=" border:1px solid #ddd;">
              
            <!-- <h5 class="fw-bold mb-0"><i class="fas fa-tasks text-secondary"></i>  Request Approval</h5> -->
            
            
            <div class="d-flex justify-content-between align-items-center   " style="background-color: white;">

            <div style="background-color:rgb(20, 160, 88); width:fit-content;height:60px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
color:white;
font-size:30px;
text-align:left;
padding:10px;
padding-right:20px;
            transform:translateY(-20px);border-radius:5px;


            margin-left:10px;margin-right:10px"> 
Requests Approval 

            </div>
                </div>






                <style>
.btn-custom{
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 4px 10px rgba(0, 0, 0, 0.1);
    letter-spacing: 1.1px;
}
    table{
        font-family: sans-serif;
    }
    .card{
        font-family: sans-serif;
    }
</style>

                <div class="card-body">

                
                <div>
                        <!-- Buttons to View History -->
                        <button class="btn btn-primary btn-custom" onclick="fetchRequests('approved')">
                              Approved Requests
                        </button>
                        <button class="btn btn-secondary btn-custom" onclick="fetchRequests('rejected')">
                              Rejected Requests
                        </button>
                    </div>
                    @if($requests->isEmpty())
                    <div class="alert alert-light border text-center p-4 mx-auto mt-3" role="alert" style="max-width: 100%;">
    <div class="mb-3">
    <img class="svg" src="{{ asset('not-found.svg') }}" alt="SVG Image" style="width:70px">
    </div>
    <h5 class="mb-2 text-secondary">No Data Found</h5>
    <p class="mb-0 text-muted">There are currently no pending requests to display.</p>

    <!-- Optional SVG (replace src with your actual SVG path) -->
    <!--
    <img src="/path/to/empty-state.svg" alt="No data" class="svg mt-3" />
    -->
</div>

 
                    @else
                        <div class="table-responsive mt-3">
                            <table class="table align-middle table-bordered">
                                <thead class="table-secondary">
                                    <tr>
                                        <th > </th>
                                        <th>Office</th>
                                        <th>Request Type</th>
                                        <th>Date Requested</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $index => $request)
                                        <tr id="request-row-{{ $request->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $request->main_office_id ?? 'N/A' }}</td>
                                            <td>{{ $request->request_type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($request->created_at)->format('F d, Y - h:i A') }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-custom" onclick="updateRequest(<?php echo $request->id;?>, 'approved')">
                                                      Approve
                                                </button>
                                                <button class="btn btn-danger btn-custom" onclick="updateRequest(<?php echo $request->id;?>, 'rejected')">
                                                      Reject
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="modal_title" style="text-transform: uppercase;font-size:1rem"><i class="fas fa-history"></i> Request History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="historyContent" class="text-center">
                    <i class="fas fa-spinner fa-spin"></i> Loading...
                </div>
            </div>
        </div>
    </div>
</div>



 
  <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

              <div class="modal-body text-center p-2">
                  <!-- Success Icon -->
                  <div class="mb-3 pt-3">
                      <i class="fas fa-check fa-3x text-success"  ></i>
                  </div>

                  <!-- Title -->
                  <h5 class="fw-bold mb-3">Request Action Completed</h5>

                  <!-- Message -->
                  <p id="modalMessage" class="text-muted mb-4">
                      The request has been successfully approved.
                  </p>
              </div>

              <!-- Close Button (X) -->
              <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
      </div>
  </div>


<script>function showAlert(type, message) {
    const colorMap = {
        success: '#28a745',
        warning: '#fd7e14',
        error: '#dc3545',
        info: '#007bff'
    };

    const iconMap = {
        success: '✓',
        warning: '!',
        error: '×',
        info: 'i'
    };

    const alertHtml = `
        <div class="alert d-flex align-items-center p-3 mb-3 shadow-sm"
             style="border-left: 6px solid ${colorMap[type]}; background-color: #fff; border-radius: 6px;">
            <div class="me-3 d-flex align-items-center justify-content-center"
                 style="width: 32px; height: 32px; background-color: ${colorMap[type]}; border-radius: 50%; color: #fff; font-weight: bold;">
                ${iconMap[type]}
            </div>
            <div>
                <strong class="d-block" style="color: ${colorMap[type]}">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                <span class="text-muted">${message}</span>
            </div>
        </div>
    `;

    const container = document.getElementById('customAlertContainer');
    container.innerHTML = alertHtml;

    setTimeout(() => container.innerHTML = '', 3000);
}

// Update Request Status
function updateRequest(requestId, status) {
    if (!confirm("Are you sure you want to " + status + " this request?")) return;

    fetch("{{ route('requests.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id: requestId, status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close the history modal if it's open
            var historyModalInstance = bootstrap.Modal.getInstance(document.getElementById('historyModal'));
            if (historyModalInstance) historyModalInstance.hide();

            // Show success modal
            document.getElementById('modalMessage').innerHTML = `Request has been <strong>${status}</strong>!`;
           showAlert('success', `Request has been <strong>${status}</strong>!`);
 setTimeout(() => location.reload(), 2000);
            // Refresh the page after the success modal is closed
           
        } else {
            alert("Something went wrong. Please try again.");
        }
    })
    .catch(error => console.error("Error:", error));
}


// Fetch Request History (Approved or Rejected)
function fetchRequests(status) {
    let modalContent = document.getElementById('historyContent');
     
    const modalTitle = document.getElementById('modal_title');
    modalTitle.innerHTML = `<i class="fas fa-history"></i> ${status} Request `;
 
    modalContent.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

    fetch("{{ route('requests.history') }}?status=" + status)
        .then(response => response.json())
        .then(data => {
            if (data.requests.length === 0) {
                modalContent.innerHTML = '<div class="alert alert-secondary"><i class="fas fa-primary-circle"></i> No ' + status + ' requests found.</div>';
                return;
            }

            let tableHTML = `
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Office</th>
                            <th>Request Type</th>
                            <th>Date</th>
                            ${status === 'rejected' ? '<th>Action</th>' : ''}
                        </tr>
                    </thead>
                    <tbody>`;

            data.requests.forEach((request, index) => {
                tableHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${request.main_office_id}</td>
                        <td>${request.request_type}</td>
                        <td>${request.created_at}</td>
                        ${status === 'rejected' ? `
                            <td>
                                <button class="btn btn-custom btn-primary" onclick="updateRequest(${request.id}, 'approved')">
                                    <i class="fas fa-check-circle"></i> Re-Approve
                                </button>
                            </td>
                        ` : ''}
                    </tr>`;
            });

            tableHTML += `</tbody></table>`;
            modalContent.innerHTML = tableHTML;
        })
        .catch(error => {
            console.error("Error:", error);
            modalContent.innerHTML = '<div class="alert alert-danger">Failed to load data.</div>';
        });

    var historyModal = new bootstrap.Modal(document.getElementById('historyModal'));
    historyModal.show();
}
</script>

@endsection
