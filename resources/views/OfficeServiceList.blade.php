@extends('layout.general_layout')

@section('title', 'Services in ' . $subOffice->sub_office_name)

@section('content')
<div class="wrapper">
    <div class="content" > 
        <div class="container mt-4">
        @include('components.alert')  

        <style>
.btn-custom{
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 4p   10px rgba(0, 0, 0, 0.1);
   
}
      
table{
font-family: sans-serif;
font-size: 1rem;
}  
.dashboard-header {
    position: relative;
    padding-bottom: 12px;
}

.header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background-color: #043b7d;
    color: white;
    font-size: 20px;
    margin-right: 16px;
}

.header-title .subtitle {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.header-title .title {
    font-size: 28px;
    font-weight: 600;
    margin: 0;
    color: #212529;
}

.btn-custom1 {
    background-color: #043b7d;
    border-color: #043b7d;
    color:white;
}

.btn-custom1:hover, .btn-custom1:focus {
    background-color: #032c5e;
    color:white;
    border-color: #032c5e;
}

.search-bar-container {
    max-width: 400px;
    width: 100%;
}

.search-input { 
    border: 1px solid #d0d7de;
    padding: 12px 20px;
    font-size: 16px;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    background-color: #fff;
    font-family: 'Segoe UI', sans-serif;
}

.search-input::placeholder {
    color: #9ca3af;
}

.search-input:focus {
    outline: none;
    border-color: #043b7d;
    box-shadow: 0 0 0 3px rgba(4, 59, 125, 0.15);
}

</style>       
            <!-- <h3 style="border: 1px solid   rgb(4, 59, 125);width:fit-content;padding:3px 0px 3px 10px;border-radius:5px;font-size:30px"  >Services in <b> 
    <span style="background-color: rgb(4, 59, 125);color:white; padding:10px;border-radius:5px;">    
    {{ $subOffice->sub_office_name }}</span ></b></h3>
    <br>
            <a href="{{ route('officeService.create', $subOffice->id) }}" 
            class="btn btn-custom mb-3" 
            style="border: 1px solid #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 4px 10px rgba(0, 0, 0, 0.1);background-color:white; border-radius:60px;padding:0px;font-size:18px; 
            transition: transform 0.3s ease-in-out;font-family:sans-serif;font-size:1.3rem" 
      onmouseover="this.style.transform='scale(1.05)'" 
      onmouseout="this.style.transform='scale(1)'">
            &nbsp; Add Service   <span><i class="fas fa-plus" style="background-color:rgb(4, 59, 125);padding:10px;color:white;border-radius:100%;margin:2px"></i></span></a>
    -->



  
<style>
    .btn-custom-circle {
    display: flex;
    justify-content: center;
    align-items: center;
    border:none;
    width: 50px; /* Circle width */
    height: 50px; /* Circle height */
    border-radius: 50%; /* Making it circular */    background-color: #5a6268; /* Change color on hover */

    color: white; /* Icon color */
    font-size: 20px; /* Adjust icon size */
    text-decoration: none; /* Remove underline */ 
    transition: all 0.3s ease; /* Smooth transition on hover */
}

.btn-custom-circle:hover {
    background-color: #5a6268; /* Change color on hover */
    transform: scale(1.1); /* Slight zoom effect on hover */
}

</style>

            <div class="dashboard-header mb-0">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="header-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="header-title">
                                <h6 class="subtitle">{{ $subOffice->sub_office_name }} (Services)</h6>
                                <h2 class="title">Services Offered</h2>
                            </div>
                        </div>
                        <p class="text-muted mt-2">Managing Services for {{ $subOffice->sub_office_name }}</p>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                             
                            <a href="{{ route('officeService.create', $subOffice->id) }}" class="btn btn-custom1 d-flex align-items-center">
                                <i class="fas fa-plus me-2" style="font-size:20px"></i>
                                <span>Add New Service</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex  gap-2">
                    <a href="{{ route('subOffices.show', $subOffice->main_office_id) }}" class="btn btn-secondary btn-custom-circle">
    <i class="fas fa-arrow-left"></i>
</a>
                    <div class="search-bar-container mb-4">




    <input type="text" id="officeSearch" class="form-control search-input" placeholder="Search for services">
</div></div>
                </div>
            </div>









            <table class="table table-bordered" id="officeTable">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Service Name</th> 
                        <th  scope="col">Service Type</th> 
                        <th   scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($services->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No services found for this sub-office.</td>
                        </tr>
                    @else
                        @foreach($services as $service)
                        <tr class="searchable-row">
                        
                                <td class="service-name" style="max-width:500px">{{ $service->service_name }}</td>
                                <td>{{ $service->services_type }}</td>
                                   <td class="text-center">
                                    <a href="{{ route('servicesAvailed.edit', $service->id) }}" class="btn btn-primary btn-custom">
                                        Edit
                                    </a>
                                    <form action="{{ route('servicesAvailed.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('Are you sure?');">
                                              Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('officeSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#officeTable tbody tr.searchable-row');

            rows.forEach(row => {
                const name = row.querySelector('.service-name').textContent.toLowerCase(); 

                if (name.includes(searchTerm)  ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});
</script>

@endsection
