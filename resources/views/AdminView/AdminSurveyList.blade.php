@extends('layout.general_layout')
<title>@yield('title','Admin Dashboard')</title>
@yield('sidebar')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_survey_list.css') }}">

    <div class="wrapper">
        <div class="content">
            <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mt-5 mb-3" 
    style="background-color: white; ">

<div style="background-color:rgb(20, 160, 88); width:fit-content;height:60px;
box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
color:white;
font-size:30px;
text-align:left;
padding:10px;
padding-right:20px;
transform:translateY(-20px);border-radius:5px;


margin-left:10px;margin-right:10px"> 
Survey List Response

</div>
<style>
    .content{
        font-family: sans-serif;
    }
</style>
<div class="d-flex me-5 gap-2" style="  width:40%" >
<div class=" " style="width: 100%; padding-left:0px">
    <input 
        type="text" 
        id="searchInput" 
        class="form-control custom-search-bar" 
        placeholder="Search responses..."
        @if($total_responses == 0) disabled @endif
    >
</div>
<div >
<button class="sort-button" id="sortButton" title="Sort">
    <i class="fas fa-sort"></i>
</button></div>
</div>

    </div>
    <div class="card p-3 mb-3">

      
<div class="d-flex gap-3">
 <div class="d-flex gap-5" style=" height:180px"> 
          <!-- <h3 class="text-center">Survey Responses</h3> -->
          
          
          
<div>
<img class="img_svg" src="{{asset('dropdown.svg')}}" alt="" style="width:200px;height:180px; ">
<div class="svg-container" style=" 
transform:translateX(90px);">  

<div id="totalRowsCount" style="flex: 0 0 50%; 
font-size: 16px;
 padding: 5px;  border:1px solid #ccc;
  border-radius: 3px;  display: flex;
 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
justify-content: space-between; align-items: center; 
width:fit-content;
transform:translateY(-60px);

color: #495057;">

    <span style="font-size: 18px; font-weight: bold;">Total Rows:</span>
    <span id="rowCountValue" style="font-size: 18px; font-weight: 500; color: #007bff;">0</span>
  </div>
</div></div>
          
          <form method="GET" action="{{ route('survey.responses') }}" class="filter-controls">
   
   <div>
          <div class="filter-group">
        <label style="width: 80px; text-align:left" for="quarter">Quarter:</label>
        <select name="quarter" id="quarter" class="select-control">
            <option value="1" {{ $selectedQuarter == 1 ? 'selected' : '' }}>Q1</option>
            <option value="2" {{ $selectedQuarter == 2 ? 'selected' : '' }}>Q2</option>
            <option value="3" {{ $selectedQuarter == 3 ? 'selected' : '' }}>Q3</option>
            <option value="4" {{ $selectedQuarter == 4 ? 'selected' : '' }}>Q4</option>
        </select>
    </div>

    <div class="filter-group">
        <label style="width: 80px; text-align:left" for="year">Year:</label>
        <select name="year" id="year" class="select-control">
            @for ($y = 2024; $y <= now()->year; $y++)
                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>
    </div>
    <div style= "margin-top:10px"> <button type="submit" class="data-btn">
        <i class="fas fa-filter"></i> Filter
    </button>
</div>
   
</form> 
</div>
<!-- Filter Section -->
<div class="row g-2" style=" width:80%;height:40%">
      <!-- Sex Filter -->
<div class="col-md-6 col-12">
<div class="apple-select-wrapper position-relative">
  
    <select id="sexFilter" class="select-control"
        @if($total_responses == 0) disabled @endif >
        <option value="" selected>All Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select> 
    </div>
</div>
<!-- Age Range Filter -->
<div class="col-md-3 col-6">
    <input type="number" id="ageFrom" class="select-control2"
        @if($total_responses == 0) disabled @endif
        placeholder="Age From">
</div>
<div class="col-md-3 col-6">
    <input type="number" id="ageTo" class="select-control2"
        @if($total_responses == 0) disabled @endif
        placeholder="Age To">
</div>
    <!-- Customer Type Filter -->
    <div class="col-md-6 col-12">
    <div class="apple-select-wrapper position-relative">
        <select id="customerTypeFilter" class="select-control"
            @if($total_responses == 0) disabled @endif>
            <option value="" selected>All Customer Types</option>
            <option value="Citizen (general public, learners, parents, former DepEd employees, researchers, NGOs etc.)">Citizen (general public, learners, parents, former DepEd employees, researchers, NGOs etc.)</option>
            <option value="Business (private school, corporations, etc.)">Business (private school, corporations, etc.)</option>
            <option value="Government (current DepEd employees or employees of other government agencies & LGUs)">Government (current DepEd employees or employees of other government agencies & LGUs)</option>
        </select>
        
    </div>
</div>











<style>
</style>

    <!-- Office Filter -->
    <div class="col-md-6 col-12">
    <div class="apple-select-wrapper position-relative">
  
        <select id="mainOfficeFilter" class="select-control" 
          @if($total_responses == 0) disabled @endif>
            <option value="" selected>All Offices</option>
            @foreach ($mainOffice as $mainOffices)
                <option value="{{ $mainOffices->office_name }}">{{ $mainOffices->office_name }}</option>
            @endforeach
        </select> 
        </div>
    </div>

    <div class="col-md-6 col-12">
    <div class="apple-select-wrapper position-relative">
  
        <select id="sectionFilter" class="select-control" 
          @if($total_responses == 0) disabled @endif>
            <option value="">All Sections</option>
            @foreach ($subOffice as $subOffices)
                <option value="{{ $subOffices->sub_office_name }}">{{ $subOffices->sub_office_name }}</option>
            @endforeach
        </select> 
        </div>
    </div>




    <div class="col-md-6 col-12">
    <div class="apple-select-wrapper position-relative">
  
        <select id="serviceFilter" class="select-control" 
          @if($total_responses == 0) disabled @endif>
            <option value="">All Service </option>
            @foreach ($service as $services)
                <option value="{{ $services->service_name }}">{{ $services->service_name }}</option>
            @endforeach
        </select> 
        </div>
    </div>
<!--    
<div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px; border:1px solid black">
  

  
  <select id="officeDropdown" class="apple-select" style="flex: 0 0 23%; padding: 10px; font-size: 16px; border-radius: 8px; border: 1px solid #ced4da; background-color: #fff; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
    <option value="">Select Office</option>
    
  </select>

   
  <select id="sectionDropdown" class="apple-select" style="flex: 0 0 23%; padding: 10px; font-size: 16px; border-radius: 8px; border: 1px solid #ced4da; background-color: #fff; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);" disabled>
    <option value="">Select Section</option>
     
  </select> -->
  <!-- <img src="{{asset('search.svg')}}" alt="" style="width:200px;height:200px"> -->
  <!-- <div class="svg-container">
<div id="totalRowsCount" style="flex: 0 0 50%; 
font-size: 16px;
 padding: 5px;  border:1px solid #ccc;
  border-radius: 3px;  display: flex;
 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
justify-content: space-between; align-items: center; 
width:fit-content;
transform:translateX(-130px);
color: #495057;">

    <span style="font-size: 18px; font-weight: bold;">Total Rows:</span>
    <span id="rowCountValue" style="font-size: 18px; font-weight: 500; color: #007bff;">0</span>
  </div>
</div> -->
</div>

</div>



</div>
</div><style>
 #loading-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px 40px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
    z-index: 1000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 200px;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #14a058; /* Green to match your site color */
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 15px;
}

.loading-text {
    font-size: 16px;
    font-weight: 500;
    color: #333;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
 
                <div class="card  " style="border-radius: 5px;">
                    
                    <div class="card-body" style="padding:0px;border-radius: 20px; ">
                        <div class="table-responsive" id="dataContainer">
                       

                        
                        <table class="table table-bordered" id="responsesTable">

                            <thead class="table">
                                    <tr>
        
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(0)">No.</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(1)">Age</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none"onclick="sortTable(2)">Sex</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none;width:300px;"onclick="sortTable(3)">Customer Type</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none;width:300px;"onclick="sortTable(4)">Office</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none;width:300px;" onclick="sortTable(4)"    >Section</th>

        <th style="background-color: rgb(4, 59, 125);color:white;border:none;" onclick="sortTable(5)">Service Availed</th>
        <!-- <th style="background-color: rgb(4, 59, 125);color:white;border:none"onclick="sortTable(6)">SQD1</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(7)">SQD2</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(8)">SQD3</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(9)">SQD4</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(10)">SQD5</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(11)">SQD6</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(12)">SQD7</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(13)">SQD8</th> -->
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(14)">Remarks</th>
        <th style="background-color: rgb(4, 59, 125);color:white;border:none" onclick="sortTable(15)">Average </th>
                                    </tr>
                                </thead>
                              
                            
                                <tbody>  
                            
                                @php
                                                    $count = 0;
                                            @endphp

                                    @foreach ($responses as $response)
                                    <tr class="response-row" data-office="{{ $response->office_transacted_with }}">
                                            @php
                                                    $count++;
                                            @endphp
                                            <td class="row-number"> </td> <!-- Row number --> 
                                            <td>{{ $response->age }}</td>
                                            <td>{{ $response->sex }}</td>
                                            <td class="customer-type">{{ $response->customerType }}</td>
                                            <td  class="office-transacted">{{ $response->main_office }}</td>
                                            <td class="section">{{ $response->office_transacted_with }}</td>
                                           
                                            <td class="service">{{ $response->service_availed }}</td>
                                            <!-- <td>{{ $response->sqd1 }}</td>
                                            <td>{{ $response->sqd2 }}</td>
                                            <td>{{ $response->sqd3 }}</td>
                                            <td>{{ $response->sqd4 }}</td>
                                            <td>{{ $response->sqd5 }}</td>
                                            <td>{{ $response->sqd6 }}</td>
                                            <td>{{ $response->sqd7 }}</td>
                                            <td>{{ $response->sqd8 }}</td> -->
                                            <td>{{ $response->remarks }}</td>
                                            <td>
                                                @php
                                                    $values = [
                                                        $response->sqd1, $response->sqd2, $response->sqd3,
                                                        $response->sqd4, $response->sqd5, $response->sqd6,
                                                        $response->sqd7, $response->sqd8
                                                    ];
                                                    $numericValues = array_filter($values, fn($val) => is_numeric($val) && $val !== 'N/A');
                                                    $average = count($numericValues) ? round(array_sum($numericValues) / count($numericValues), 2) : 'N/A';
                                                @endphp
                                                {{ $average }}
                                            </td>
                                        </tr>
                                    @endforeach  

                                </tbody>


                     
                            </table>
</div>
                            <div id="noDataContainer" style="display: none;margin-top:50px; text-align: center; font-size: 18px; color: red;">
   

<div class="alert alert-light border text-center p-4 mx-auto mt-3" role="alert" style="max-width: 98%;">
    <div class="mb-3">
    <img class="svg" src="{{ asset('not-found.svg') }}" alt="SVG Image" style="width:70px">
    </div>
    <h5 class="text-secondary mb-2">No data found for the selected filters.</h5>
    <p class="text-muted mb-0">There were no recorded survey responses matching your selection.</p>
</div> 


</div>
                        
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




<script src="{{ asset('js/admin_survey_list.js') }}"></script>