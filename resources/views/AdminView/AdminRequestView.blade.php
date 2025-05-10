@extends('layout.general_layout')

@section('title', 'Manage Requests')

@section('content')     
<div class="wrapper">
    <div class="content">




<!-- Request Dashboard Cards -->
<div class="container mt-4">
<div class="container mt-4">
  <div class="row">
    <!-- Total Requests Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
              <i class="fas fa-clipboard-list text-primary" style="font-size: 24px;"></i>
            </div>
          </div>
          <h3 class="fw-bold" id="totalRequestsCount">{{ $totalCount }}</h3>
          <h6 class="text-muted">Total Requests</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-primary" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Pending Requests Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
              <i class="fas fa-clock text-warning" style="font-size: 24px;"></i>
            </div>
          </div>
          <h3 class="fw-bold" id="pendingRequestsCount">{{ $pendingCount }}</h3>
          <h6 class="text-muted">Pending Requests</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-warning" style="width: <?= $totalCount > 0 ? ($pendingCount / $totalCount * 100) : 0 ?>%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Approved Requests Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-success bg-opacity-10 p-3">
              <i class="fas fa-check-circle text-success" style="font-size: 24px;"></i>
            </div>
          </div>
          <h3 class="fw-bold" id="approvedRequestsCount">{{ $approvedCount }}</h3>
          <h6 class="text-muted">Approved Requests</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-success" style="width: <?= $totalCount > 0 ? ($approvedCount / $totalCount * 100) : 0 ?>%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Rejected Requests Card -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body text-center">
          <div class="d-flex justify-content-center mb-2">
            <div class="rounded-circle bg-danger bg-opacity-10 p-3">
              <i class="fas fa-times-circle text-danger" style="font-size: 24px;"></i>
            </div>
          </div>
          <h3 class="fw-bold" id="rejectedRequestsCount">{{ $rejectedCount }}</h3>
          <h6 class="text-muted">Rejected Requests</h6>
          <div class="progress mt-3" style="height: 5px;">
            <div class="progress-bar bg-danger" style="width: <?= $totalCount > 0 ? ($rejectedCount / $totalCount * 100) : 0 ?>%"></div>
          </div>
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
          <h6 class="fw-bold mb-0"><i class="fas fa-building text-secondary me-2"></i>Requests by Office</h6>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush" id="officeRequestsList">
            @if(count($officeRequests) > 0)
              @foreach($officeRequests as $office)
                <li class="list-group-item border-0 py-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3" style="height: 40px; width: 40px;">
                        <i class="fas fa-building text-primary" style="font-size: 18px;"></i>
                      </div>
                      <span class="fw-semibold">{{ $office->main_office_id }}</span>
                    </div>
                    <div>
                      <span class="badge bg-primary rounded-pill">{{ $office->request_count }} Requests</span>
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
        <h6 class="fw-bold mb-0"><i class="fas fa-history text-secondary me-2"></i>Recent Activity</h6>
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
                        <i class="fas fa-${activity.icon.class} text-${activity.icon.color} fs-4"></i>
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


<script>
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
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Refresh the page after the success modal is closed
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                location.reload();
            });
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
