@extends('layout.general_layout')

@section('title', 'Sub Offices of ' . $mainOffice->office_name)

@section('content')
<div class="wrapper">
    <div class="content" > 
        <div class="container mt-4">
      @include('components.alert')      
      <style>
.btn-custom{
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: sans-serif;
}
       
table{
font-size: 1rem;
font-family: sans-serif;
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
}  .btn-custom-circle {
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
            <!-- <h3 style="border: 1px solid   rgb(4, 59, 125);width:fit-content;padding:3px 0px 3px 10px;border-radius:5px;font-size:35px"  > Sections of<b> 
    <span style="background-color: rgb(4, 59, 125);color:white; padding:10px;border-radius:5px">    
    {{ $mainOffice->office_name }}</span ></b></h3>
    <br>
            <a href="/subOffice/create/{{ $mainOffice->id }}"

              class="btn btn-custom mb-3" 
              style="border: 1px solid #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 4px 10px rgba(0, 0, 0, 0.1);background-color:white; border-radius:60px;padding:0px;
              font-size:18px;transition: transform 0.3s ease-in-out;font-family:sans-serif;font-size:1.3rem" 
      onmouseover="this.style.transform='scale(1.05)'" 
      onmouseout="this.style.transform='scale(1)'">&nbsp; Add Section   <span><i class="fas fa-plus" style="background-color:rgb(4, 59, 125);padding:10px;color:white;border-radius:100%;margin:2px"></i></span></a>
    -->
      <div class="dashboard-header mb-4">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="header-icon">
                                <i class="fas fa-sitemap    "></i>
                            </div>
                            <div class="header-title">
                                <h6 class="subtitle">{{ $mainOffice->office_name }} (Section)</h6>
                                <h2 class="title">Sub Offices / Sections</h2>
                            </div>
                        </div>
                        <p class="text-muted mt-2">Managing Sections for {{ $mainOffice->office_name }}</p>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                             
                            <a href="/subOffice/create/{{ $mainOffice->id }}" class="btn btn-custom1 d-flex align-items-center">
                                <i class="fas fa-plus me-2" style="font-size:20px"></i>
                                <span>Add New Section</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                    <a href="{{ route('mainOffice.index') }}"
                     class="btn btn-secondary btn-custom-circle">
                    <i class="fas fa-arrow-left"></i>
                    </a>

                    <div class="search-bar-container mb-4">
    <input type="text" id="officeSearch" class="form-control search-input" placeholder="Search for sub offices...">
</div></div>
                </div>
            </div>
            @if($subOffices->isEmpty())
            
            <a href="{{ route('servicesAvailed.createForMainOffice', $mainOffice->id) }}" 
   class="btn btn-success btn-custom mb-3">
    Add Service to {{ $mainOffice->office_name }}
</a>



@endif




<table class="table table-bordered" id="officeTable">
    <thead class="table-dark">
        <tr>
            <th scope="col" style="min-width: 460px;">Sub Office Name</th>
            <th scope="col">Office Admin</th>
            <th scope="col">Actions</th>
        </tr>
                </thead>
                <tbody>
                    @if($subOffices->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No sub-offices found for this main office.</td>
                        </tr>
                    @else
                        @foreach($subOffices as $subOffice)
                        <tr class="searchable-row">
                                
                        <td class="sub-office-name">{{ $subOffice->sub_office_name }}</td>
                    <td class="office-admin">{{ $subOffice->office_admin }}</td>
                  
                                <td class="text-center">
                                    <a href="{{ route('subOffice.edit', $subOffice->id) }}" class="btn btn-primary btn-custom">
                                     Edit
                                    </a>
                                    <form action="{{ route('subOffice.destroy', $subOffice->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('Are you sure?');">
                                            Delete
                                        </button>
                                    </form>
                                  
                                    <a href="{{ route('servicesAvailed.show', $subOffice->id) }}" class="btn btn-success btn-custom position-relative">
                   Services
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $subOffice->servicesCount }}
                </span>
            </a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div><script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('officeSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#officeTable tbody tr.searchable-row');

            rows.forEach(row => {
                const name = row.querySelector('.sub-office-name').textContent.toLowerCase();
                const admin = row.querySelector('.office-admin').textContent.toLowerCase();

                if (name.includes(searchTerm) || admin.includes(searchTerm)) {
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
