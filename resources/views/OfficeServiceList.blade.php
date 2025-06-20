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

            <!-- <div class="dashboard-header mb-0">
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
            </div> -->




   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Services Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
             <div class="row mb-3">
       
 <div class="col-md-8 mb-3">
     <div class="card shadow-sm " style="background: white; border: 1px solid #ddd;height:200px">
    <div class="row" style="height: 200px;">
         
<div class="col-md-4 d-flex align-items-center justify-content-center" style="border-right: 1px solid #dee2e6;">
            <div class="text-center py-3 w-100">
            
                <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 120px; height: 120px; object-fit: contain;">
             <h2 class="fw-bold text-primary"  >Add Service  </h2>
            </div>
        </div>


        <div class="col-md-8">
            <div class="p-3">
                <h2 class="fw-bold text-primary text-center"  > Service  </h2>
             <form action="{{ route('servicesAvailed.store') }}" method="POST">
                    @csrf
                
         
                    
<input type="hidden" name="sub_office_id" value="{{ $subOffice->id }}">
    <input type="hidden" name="main_office_id" value="{{ $subOffice->main_office_id }}">

                

                    <div class="row align-items-center">
                        
                        <label for="service_name" class="col-sm-4 col-form-label">Service Name:</label>
                        <div class="col-sm-8">
                      
                        <input type="text" class="form-control" id="service_name" name="service_name" required>
                        </div>
                    </div>

                    <div class="row align-items-center mt-2">
                        <label for="service_type" class="col-sm-4 col-form-label"> Service Type:</label>
                        <div class="col-sm-8">
                           <select class="form-control" id="service_type" name="service_type" required>
            <option value="None" selected>None</option>
            
            <option value="External">External</option>
            <option value="Internal">Internal</option>
            <option value="Both">Both</option>

        </select>
                        </div>
                    </div>
 

                     <div class="row  mt-3 align-items-center">
                          <div class="col-sm-4">

                          </div>
                        <div class="col-sm-8">
                             <button type="submit" class="btn btn-sm btn-primary me-2 mb-1 w-100">Add Office</button>
                       
                        </div>
                    </div>

                     
                </form>
            </div>
        </div>
    </div>
</div>
 </div>
           

 <div class="col-md-4 mb-3">
  <div class="card shadow-sm h-100" style="max-height: 220px;"> <!-- Set your preferred max height -->
    <div class="card-body text-center overflow-auto"> <!-- Allows scrolling if content exceeds max height -->
      <div class="d-flex justify-content-center mb-2"></div>


      <div class="fw-bold" style="font-size: 27px;min-height: 125px;">{{ $subOffice->sub_office_name }}</div>
      <a href="{{ route('subOffices.show', $subOffice->main_office_id) }}" class="btn btn-secondary d-flex align-items-center justify-content-center">
        Manage Sections 
      </a>
    </div>
  </div>
</div>



<div class="col-md-12 mb-2">
  <div class="card shadow-sm" style="height: auto;">
    <div class="card-body py-2 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center w-100" style="max-width: 100%;">
        <!-- Icon -->
        <div style="background-color: rgb(1, 129, 52); padding: 8px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
          <img src="{{ asset('search_icon.svg') }}" style="width: 24px; height: 24px;">
        </div>

        <!-- Search input -->
        <input type="text" id="officeSearch" class="form-control" placeholder="Find service...">
      </div>
    </div>
  </div>
</div>

<div class="row">
    @forelse($services as $service)
        <div class="col-md-{{ count($services) == 2 ? '6' : '4' }} mb-4 searchable-card">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <div class="fw-bold service-name" style="font-size: 20px;">
                            {{ $service->service_name }}
                        </div>
                        <div class="text-muted service-type" style="font-size: 14px;">
                            Type: {{ ucfirst($service->services_type) }}
                        </div>
                        <hr class="my-3">
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('servicesAvailed.edit', $service->id) }}"
                           class="btn btn-sm btn-primary d-flex align-items-center justify-content-center text-nowrap"
                           style="min-width: 90px; height: 38px; font-size: 14px;">
                            Edit
                        </a>

                        <form action="{{ route('servicesAvailed.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-danger d-flex align-items-center justify-content-center text-nowrap"
                                    style="min-width: 90px; height: 38px; font-size: 14px;">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted" id="no-services">No services found for this sub-office.</div>
    @endforelse
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('officeSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.searchable-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const serviceName = card.querySelector('.service-name').textContent.toLowerCase();
                const serviceType = card.querySelector('.service-type').textContent.toLowerCase();

                if (serviceName.includes(searchTerm) || serviceType.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide "no results" message
            const noServicesMessage = document.getElementById('no-services');
            if (noServicesMessage) {
                if (visibleCount === 0 && searchTerm !== '') {
                    noServicesMessage.textContent = 'No services match your search.';
                    noServicesMessage.style.display = '';
                } else if (visibleCount === 0 && searchTerm === '') {
                    noServicesMessage.textContent = 'No services found for this sub-office.';
                    noServicesMessage.style.display = '';
                } else {
                    noServicesMessage.style.display = 'none';
                }
            }
        });
    }
});
</script>
@endsection
