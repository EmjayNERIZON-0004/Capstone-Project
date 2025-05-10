@extends('layout.general_layout')
    <title>@yield('title','Office Management')</title>

 


    <!-- Sidebar -->
    @yield('sidebar')
    @show

    <!-- Content -->
     @section('content')
     <div class="wrapper">
    <div class="content" >
        
        <h2 class="mb-4"><i class="fas fa-building"></i> Office Management</h2>

        <!-- Add Office Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addOfficeModal" onclick="resetForm()">
            <i class="fas fa-plus"></i> Add New Office
        </button>

        <!-- Office Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Office Name</th>
                    <th>Admin Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="officeTable">
                <!-- Offices will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Office Modal -->
<div class="modal fade" id="addOfficeModal" tabindex="-1" aria-labelledby="addOfficeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficeModalLabel"><i class="fas fa-plus"></i> Add Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="officeForm">
                    <input type="hidden" id="officeIndex">
                    <div class="mb-3">
                        <label class="form-label">Office Name</label>
                        <input type="text" class="form-control" id="officeName" placeholder="Enter Office Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Name</label>
                        <input type="text" class="form-control" id="adminName" placeholder="Enter Admin Name" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100"><i class="fas fa-save"></i> Save Office</button>
                </form>
            </div> 
        </div> 
    </div>
</div>
@endsection
<!-- Bootstrap & JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let offices = [];
    
    document.getElementById("officeForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let index = document.getElementById("officeIndex").value;
        let officeName = document.getElementById("officeName").value;
        let adminName = document.getElementById("adminName").value;

        if (index === "") {
            // Adding a new office
            offices.push({ officeName, adminName });
        } else {
            // Editing an existing office
            offices[index] = { officeName, adminName };
        }

        updateTable();
        document.getElementById("officeForm").reset();
        document.getElementById("officeIndex").value = "";
        let modal = bootstrap.Modal.getInstance(document.getElementById("addOfficeModal"));
        modal.hide();
    });

    function updateTable() {
        let table = document.getElementById("officeTable");
        table.innerHTML = "";
        offices.forEach((office, index) => {
            let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${office.officeName}</td>
                    <td>${office.adminName}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editOffice(${index})">  Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteOffice(${index})">  Delete</button>
                    </td>
                </tr>
            `;
            table.innerHTML += row;
        });
    }

    function editOffice(index) {
        let office = offices[index];
        document.getElementById("officeIndex").value = index;
        document.getElementById("officeName").value = office.officeName;
        document.getElementById("adminName").value = office.adminName;
        
        let modal = new bootstrap.Modal(document.getElementById("addOfficeModal"));
        modal.show();
    }

    function deleteOffice(index) {
        if (confirm("Are you sure you want to delete this office?")) {
            offices.splice(index, 1);
            updateTable();
        }
    }

    function resetForm() {
        document.getElementById("officeForm").reset();
        document.getElementById("officeIndex").value = "";
    }
</script>
 