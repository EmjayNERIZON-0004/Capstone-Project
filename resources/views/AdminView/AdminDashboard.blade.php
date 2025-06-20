@extends('layout.general_layout')

<title>@yield('title','Admin Dashboard')</title>
 @yield('sidebar')
  @show
@section('content')
 
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
 

    <!-- Main Content --> 
    <div class="content" style="font-size:larger;font-weight:400" >
  <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <!-- <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold"> Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div> -->
<div class="container-fluid pt-0 pb-3 p-0" style="padding-left: 0px; padding-right:0px">
   





    <!-- Bottom Row: 2 Cards -->



    <div class="   dashboard-container m-0" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-top:5px ">
<!-- 
    
 <div class=" " style="flex: 1 1 calc(25% - 20px);
 "
 style="background:transparent"
 >
    <div class="card-body" style="display: flex; justify-content: center; align-items: flex-start; height: 100%;">
    <div style="
        display: flex;
        flex-direction: column;
        align-items: center;
    ">
        <p class="text" style="font-size: 30px; font-weight: 500;   margin-top: 10px;">San Carlos City</p>
      
     <div style="position: relative; width: 160px; height: 160px;">

    
    <div style="
        position: absolute;
        top: 0px;
        left: 60px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 0;
    ">
        <img src="{{ asset('psunian.jpg') }}" style="width: 140px; height: 140px; border-radius: 50%;">
    </div>
 
    <div style="
        position: absolute;
        top: 0;
        left: -60;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    ">
        <img src="{{ asset('logo.png') }}" style="width: 140px; height: 140px; border-radius: 50%;">
    </div>

</div>


    </div>
</div>
 </div> -->
 @php
    use Carbon\Carbon;

    $now = Carbon::now();
    $currentDate = $now->format('F j, Y'); // Example: June 13, 2025
    $quarter = ceil($now->month / 3);
    $quarterYear = "Q$quarter " . $now->year;
@endphp
<div class="dashboard-card" style="flex: 1 1 calc(100% - 20px); background: #fff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px;">
    <div class="card-body">
        
        <!-- Header Section: Date, Clock, Quarter -->
        <!-- <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;"> -->
            <!-- <div>
                <h5 class="mb-1 fw-bold" style="font-size: 26px;">{{ $currentDate }}</h5>

                <div id="realtimeClock"
                    style="font-size: 1.2rem; font-weight: 300; color: black; border-radius: 8px; display: inline-block; letter-spacing: 4px; text-transform: lowercase;">
                </div>
            </div> -->

            <!-- <p style="font-size: 26px; color: #333; font-weight: bold; margin: 0;">{{ $quarterYear }}</p> -->
        <!-- </div> -->

        <!-- Profile Info Section -->
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <!-- LEFT SIDE: Welcome Message -->
        <div style="    line-height: 1.6; max-width: 500px;">
    <h3 style="margin: 0; font-size: 1.8rem; color: #222;">Welcome to <span style="color: #007bff;">Administrator Panel</span></h3>
    
    
    
    <p style="margin: 4px 0; color: #666;">Schools Division Office, San Carlos City</p>
    
   <p style="font-size: 0.85rem; color: #333; margin: 0; transform: translateY(8px);">
  Status
</p>
<div class="d-flex align-items-center mt-1" style="font-size: 28px;">
  <span id="satisfactionText" style="font-weight: 600;"></span>
</div>

</div>


            <!-- RIGHT SIDE: Profile Image -->
            <div class="d-flex gap-3">
             <!-- <div style="
      width: 180px;
      height: 180px;
      background-color:rgb(255, 255, 255); /* Orange color */
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
  ">
    <svg height="150" width="150" fill="#ffffff" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
      <path d="M276.941 440.584v565.722c0 422.4 374.174 625.468 674.71 788.668l8.02 4.292 8.131-4.292c300.537-163.2 674.71-366.268 674.71-788.668V440.584l-682.84-321.657L276.94 440.584Zm682.73 1479.529c-9.262 0-18.523-2.372-26.993-6.89l-34.9-18.974C588.095 1726.08 164 1495.906 164 1006.306V404.78c0-21.91 12.65-41.788 32.414-51.162L935.727 5.42c15.134-7.228 32.866-7.228 48 0l739.313 348.2c19.765 9.374 32.414 29.252 32.414 51.162v601.525c0 489.6-424.207 719.774-733.779 887.943l-34.899 18.975c-8.47 4.517-17.731 6.889-27.105 6.889Zm467.158-547.652h-313.412l-91.595-91.482v-83.803H905.041v-116.78h-83.69l-58.503-58.504c-1.92.113-3.84.113-5.76.113-176.075 0-319.285-143.21-319.285-319.285 0-176.075 143.21-319.398 319.285-319.398 176.075 0 319.285 143.323 319.285 319.398 0 1.92 0 3.84-.113 5.647l350.57 350.682v313.412Zm-266.654-112.941h153.713v-153.713L958.462 750.155l3.953-37.27c1.017-123.897-91.595-216.621-205.327-216.621S550.744 588.988 550.744 702.72c0 113.845 92.612 206.344 206.344 206.344l47.21-5.309 63.811 63.7h149.873v116.78h116.781v149.986l25.412 25.299Zm-313.4-553.57c0 46.758-37.949 84.706-84.706 84.706-46.758 0-84.706-37.948-84.706-84.706s37.948-84.706 84.706-84.706c46.757 0 84.706 37.948 84.706 84.706" fill-rule="evenodd"/>
    </svg>
  </div> -->
  
          <div> 
                  

  <div style="
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background-color: rgb(255, 255, 255);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        ">
            <div id="faceIcon" style="width: 140px; height: 140px;"></div>
        
        </div>

                    
 

        </div> 
    </div>
 
    </div>
</div>
</div>







  

 
        
        <!-- Satisfaction Rate -->
        <div class="dashboard-card" style="flex: 1 1 calc(20% - 20px);">
            <div class="card-body">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="card-header-flex">
                        
                        <h2 class="card-number" id="satisfactionRate">0%</h2>
                    </div> 
                    <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
                     <svg viewBox="0 0 24 24" width="50 " hieght=" 50"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 12H4.6C4.03995 12 3.75992 12 3.54601 12.109C3.35785 12.2049 3.20487 12.3578 3.10899 12.546C3 12.7599 3 13.0399 3 13.6V19.4C3 19.9601 3 20.2401 3.10899 20.454C3.20487 20.6422 3.35785 20.7951 3.54601 20.891C3.75992 21 4.03995 21 4.6 21H9M9 21H15M9 21L9 8.6C9 8.03995 9 7.75992 9.10899 7.54601C9.20487 7.35785 9.35785 7.20487 9.54601 7.10899C9.75992 7 10.0399 7 10.6 7H13.4C13.9601 7 14.2401 7 14.454 7.10899C14.6422 7.20487 14.7951 7.35785 14.891 7.54601C15 7.75992 15 8.03995 15 8.6V21M15 21H19.4C19.9601 21 20.2401 21 20.454 20.891C20.6422 20.7951 20.7951 20.6422 20.891 20.454C21 20.2401 21 19.9601 21 19.4V4.6C21 4.03995 21 3.75992 20.891 3.54601C20.7951 3.35785 20.6422 3.20487 20.454 3.10899C20.2401 3 19.9601 3 19.4 3H16.6C16.0399 3 15.7599 3 15.546 3.10899C15.3578 3.20487 15.2049 3.35785 15.109 3.54601C15 3.75992 15 4.03995 15 4.6V8" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
               
                        <!-- <div class="icon-container"  >
                            <div style="display: flex; justify-content: center; margin-top: 20px;">
                             <p id="satisfactionText" style="font-size: 30px; font-weight:500; color:rgb(8, 8, 8); margin-top: 10px; margin-right:10px"></p>
    <div style="
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color:rgb(255, 255, 255);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
       
    ">
        <div id="faceIcon" style="width: 50px; height: 50px;"></div>

    </div>
</div>
  </div> -->
       
                    </div>
                    
                    <h5 class="card-title">Overall Rating as of {{ \Carbon\Carbon::now()->year }}
</h5>
<p class="card-subtext">Percentage of satisfied users</p>

                    
                    <a class="btn btn-primary"
                        style="background-color:rgb(20, 135, 217);  border:1px solid #ccc; color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);"
                        href="#tableRating">Office Ratings</a>



                        <!-- <div id="mainOfficeProgressBars" class="mt-4"></div> -->
  
                </div>
            </div>

             <div class="dashboard-card mb-3" style="flex: 1 1 calc(20% - 20px);">
            <div class="card-body">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="card-header-flex">
                        <h2 class="card-number" id="totalResponses">0</h2>
                    </div> 
                    <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
                     <svg viewBox="0 0 24 24" width="50 " hieght=" 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 4C16.93 4 17.395 4 17.7765 4.10222C18.8117 4.37962 19.6204 5.18827 19.8978 6.22354C20 6.60504 20 7.07003 20 8V17.2C20 18.8802 20 19.7202 19.673 20.362C19.3854 20.9265 18.9265 21.3854 18.362 21.673C17.7202 22 16.8802 22 15.2 22H8.8C7.11984 22 6.27976 22 5.63803 21.673C5.07354 21.3854 4.6146 20.9265 4.32698 20.362C4 19.7202 4 18.8802 4 17.2V8C4 7.07003 4 6.60504 4.10222 6.22354C4.37962 5.18827 5.18827 4.37962 6.22354 4.10222C6.60504 4 7.07003 4 8 4M9.6 6H14.4C14.9601 6 15.2401 6 15.454 5.89101C15.6422 5.79513 15.7951 5.64215 15.891 5.45399C16 5.24008 16 4.96005 16 4.4V3.6C16 3.03995 16 2.75992 15.891 2.54601C15.7951 2.35785 15.6422 2.20487 15.454 2.10899C15.2401 2 14.9601 2 14.4 2H9.6C9.03995 2 8.75992 2 8.54601 2.10899C8.35785 2.20487 8.20487 2.35785 8.10899 2.54601C8 2.75992 8 3.03995 8 3.6V4.4C8 4.96005 8 5.24008 8.10899 5.45399C8.20487 5.64215 8.35785 5.79513 8.54601 5.89101C8.75992 6 9.03995 6 9.6 6Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                </div>
                <div>
                    <h5 class="card-title">Surveys as   of {{ \Carbon\Carbon::now()->year }}
</h5>
                    <p class="card-subtext">Total number of surveys</p>
                </div>
                <a class="btn" href="{{route('survey.responses')}}" 
                    style="background-color:rgb(20, 135, 217);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                    Survey Responses
                </a>
            </div>
        </div>

          <div class="dashboard-card" style="flex: 1 1 calc(20% - 20px);">
            <div class="card-body">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="card-header-flex">
                        <h2 class="card-number" id="totalResponses_wo_others">0</h2>
                    </div> 
                    <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
<svg viewBox="0 0 24 24" width="50" height="50" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 15L8 17L12.5 12.5M8 8V5.2C8 4.0799 8 3.51984 8.21799 3.09202C8.40973 2.71569 8.71569 2.40973 9.09202 2.21799C9.51984 2 10.0799 2 11.2 2H18.8C19.9201 2 20.4802 2 20.908 2.21799C21.2843 2.40973 21.5903 2.71569 21.782 3.09202C22 3.51984 22 4.0799 22 5.2V12.8C22 13.9201 22 14.4802 21.782 14.908C21.5903 15.2843 21.2843 15.5903 20.908 15.782C20.4802 16 19.9201 16 18.8 16H16M5.2 22H12.8C13.9201 22 14.4802 22 14.908 21.782C15.2843 21.5903 15.5903 21.2843 15.782 20.908C16 20.4802 16 19.9201 16 18.8V11.2C16 10.0799 16 9.51984 15.782 9.09202C15.5903 8.71569 15.2843 8.40973 14.908 8.21799C14.4802 8 13.9201 8 12.8 8H5.2C4.0799 8 3.51984 8 3.09202 8.21799C2.71569 8.40973 2.40973 8.71569 2.21799 9.09202C2 9.51984 2 10.0799 2 11.2V18.8C2 19.9201 2 20.4802 2.21799 20.908C2.40973 21.2843 2.71569 21.5903 3.09202 21.782C3.51984 22 4.07989 22 5.2 22Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                </div>
                <div>
                    <h5 class="card-title">Surveys ({{ \Carbon\Carbon::now()->year }})</h5>
                    <p class="card-subtext">Total number of valid transaction</p>
                </div>
                <a class="btn" href="{{route('valid_surveys')}}" 
                    style="background-color:rgb(20, 135, 217);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                    Valid Survey Responses
                </a>
            </div>
        </div>

           
  <div class="dashboard-card" style="flex: 1 1 calc(20% - 20px);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="card-header-flex">
                    <h2 class="card-number" id="totalOffices">0</h2>
                </div> 
                <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
          <svg height="50" width="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 7H10.25M7.5 11H10.25M7.5 15H10.25M13.75 7H16.5M13.75 11H16.5M13.75 15H16.5M20 21V6.2C20 5.0799 20 4.51984 19.782 4.09202C19.5903 3.71569 19.2843 3.40973 18.908 3.21799C18.4802 3 17.9201 3 16.8 3H7.2C6.07989 3 5.51984 3 5.09202 3.21799C4.71569 3.40973 4.40973 3.71569 4.21799 4.09202C4 4.51984 4 5.0799 4 6.2V21M22 21H2" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
            </div>
            <div>
                <h5 class="card-title"><b>Our Offices</b></h5>
                <p class="card-subtext">Total number of offices</p>
                <a class="btn" href="{{ route('OfficeRemarks') }}"
                    style="background-color:rgb(20, 135, 217);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                    Office Remarks
                </a>
            </div>
        </div>


    </div>


     <div class="dashboard-container" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
        
     
     
           <?php
                    $month = date('n');
                    $year = date('Y');
                    $quarter = ceil($month / 3);
                ?>
     
   <div class="dashboard-card p-2" style="flex: 1 1 calc(50% - 20px);">
    <div class="card-body">
     
      <div style="display: flex; justify-content: space-between; align-items: stretch; gap: 0px;">
 
    <div style="width: fit-content; padding: 10px; border-radius: 8px;">
        <div style="
           background: linear-gradient(to bottom right, #4CAF50,rgb(63, 169, 66));
;
            width: 70px;
            height: 70px;
            padding: 10px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 0px;
        ">
           <svg viewBox="0 0 24 24" width="50" height="50" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 20V13M12 20V10M4 20L4 16M13.4067 5.0275L18.5751 6.96567M10.7988 5.40092L5.20023 9.59983M21.0607 6.43934C21.6464 7.02513 21.6464 7.97487 21.0607 8.56066C20.4749 9.14645 19.5251 9.14645 18.9393 8.56066C18.3536 7.97487 18.3536 7.02513 18.9393 6.43934C19.5251 5.85355 20.4749 5.85355 21.0607 6.43934ZM5.06066 9.43934C5.64645 10.0251 5.64645 10.9749 5.06066 11.5607C4.47487 12.1464 3.52513 12.1464 2.93934 11.5607C2.35355 10.9749 2.35355 10.0251 2.93934 9.43934C3.52513 8.85355 4.47487 8.85355 5.06066 9.43934ZM13.0607 3.43934C13.6464 4.02513 13.6464 4.97487 13.0607 5.56066C12.4749 6.14645 11.5251 6.14645 10.9393 5.56066C10.3536 4.97487 10.3536 4.02513 10.9393 3.43934C11.5251 2.85355 12.4749 2.85355 13.0607 3.43934Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </div>
        <h5 class="card-title" style="margin: 0 0 0px 0;">Quarterly Rating</h5>
        <p class="card-subtext" style="margin-bottom: 10px;">View History of Ratings</p>
        <a class="btn" href="{{ url('rating-history') }}" 
           style=" background: linear-gradient(to bottom right, #4CAF50,rgb(63, 169, 66)); color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
            More Details
        </a>
    </div>

    <!-- Right stats (fill remaining space) -->
    <div class="quarterly-stats" style="flex: 1; padding: 10px; border-radius: 8px;">
    <!-- Title and Description -->
    <div style="margin-bottom: 0px;">
        <h5 style="margin: 0; font-weight: 600;">Quarterly Performance</h5>
        <p style="margin: 0; color: #666;">Comparison quarterly ratings</p>
    </div>

    <!-- Previous Quarter -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span>Previous: <small id="prev-quarter-score" class="text-muted">0%</small></span>
        <span class="fw-bold" id="prev-quarter-label">Loading...</span>
    </div>
    <div class="progress mb-3" style="height: 8px;">
        <div class="progress-bar" id="prev-quarter-bar" role="progressbar" style="width: 0%" 
             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- Current Quarter -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span>Current: <small id="current-quarter-score" class="text-muted">0%</small></span>
        <span class="fw-bold" id="current-quarter-label">Loading...</span>
    </div>
    <div class="progress" style="height: 8px;">
        <div class="progress-bar" id="current-quarter-bar" role="progressbar" style="width: 0%" 
             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>

</div>
    </div>
   </div>

     
    
<script>
function getColorForScore(score) {
    if (score < 60) return '#F44336';      // Red
    else if (score <= 79.9) return '#FF9800'; // Orange
    else if (score <= 94.9) return '#8BC34A'; // Light Green
    else return '#4CAF50';                  // Green
}

document.addEventListener("DOMContentLoaded", function () {
    const currentQuarter = <?php echo $quarter   ?>;
    const currentYear = <?php echo $year   ?>;
    const prevQuarter = currentQuarter > 1 ? currentQuarter - 1 : 4;
    const prevYear = currentQuarter > 1 ? currentYear : currentYear - 1;

    const quarterLabel = q => 'Q' + q;

    fetch('/Admin/api/quarterly-survey-scores')
        .then(res => res.json())
        .then(data => {
            if (!data.success) return;

            const scores = data.quarterly_scores;

            const prevScore = scores.find(s => s.year == prevYear && s.quarter == quarterLabel(prevQuarter));
            const currScore = scores.find(s => s.year == currentYear && s.quarter == quarterLabel(currentQuarter));

            if (prevScore) {
                const percent = (prevScore.overallScore * 100).toFixed(2);
                const color = getColorForScore(percent);
                const prevBar = document.getElementById('prev-quarter-bar');
                prevBar.style.width = percent + '%';
                prevBar.setAttribute('aria-valuenow', percent);
                prevBar.style.backgroundColor = color;
                document.getElementById('prev-quarter-label').innerText = `Q${prevQuarter} ${prevYear}`;
                document.getElementById('prev-quarter-score').innerText = percent + '%';
            }

            if (currScore) {
                const percent = (currScore.overallScore * 100).toFixed(2);
                const color = getColorForScore(percent);
                const currBar = document.getElementById('current-quarter-bar');
                currBar.style.width = percent + '%';
                currBar.setAttribute('aria-valuenow', percent);
                currBar.style.backgroundColor = color;
                document.getElementById('current-quarter-label').innerText = `Q${currentQuarter} ${currentYear}`;
                document.getElementById('current-quarter-score').innerText = percent + '%';
            }
        });
});

</script>

               
        <!-- Top Row: 4 Cards -->
    

 <!--      
<div style="flex: 1 1 calc(20% - 20px); background: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center;">
    
    <div style="
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: rgb(255, 255, 255);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    ">
        <div id="faceIcon" style="width: 150px; height: 150px;"></div>
    </div>

    <span id="satisfactionText" style="font-weight: 600; font-size: 30px; margin-top: 10px;"></span>
</div>
-->
    <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div class="card-header-flex">
                <h2 class="card-number">{{ $positiveCount }}</h2>
            </div>
            <div style="background-color:rgb(253, 253, 253);   border-radius: 50%;">
                <img src="{{ asset('positive-rate.svg') }}" style="width: 70px; height: 70px;">
            </div>
        </div>
        <div>
            <h5 class="card-title">Positive Feedback</h5>
            <p class="card-subtext">Total number of Positive Remarks</p>
        </div>
        <a class="btn" href="{{ route('positive_feedbacks') }}" 
           style="background-color: #4CAF50; color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
           More Details
        </a>
    </div>
</div>

  <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div class="card-header-flex">
                <h2 class="card-number">{{ $negativeCount }}</h2>
            </div>
            <div style="  border-radius: 50%;">
                <img src="{{ asset('nega.svg') }}" style="width:70px; height: 70px;">
            </div>
        </div>
        <div>
            <h5 class="card-title">Concerns/Issues</h5>
            <p class="card-subtext">Total number of Found Concerns</p>
        </div>
        <a class="btn btn-danger" href="{{ route('concerns_feedbacks') }}" 
           style="  color:white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
            View Concerns
        </a>
    </div>
</div> 

  
     <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="card-header-flex">
                    <h2 class="card-number" id="sqd">SQD 1-8</h2>
                </div> 
                <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
          <svg height="50" width="50"  viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4964 14.6178C11.215 15.4901 9.66706 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 9.66706 15.4901 11.215 14.6178 12.4964L16.0607 13.9393L13.9393 16.0607L12.4964 14.6178ZM10.3128 12.4341C9.62116 12.7956 8.83445 13 8 13C5.23858 13 3 10.7614 3 8C3 5.23858 5.23858 3 8 3C10.7614 3 13 5.23858 13 8C13 8.83445 12.7956 9.62116 12.4341 10.3128L11.0607 8.93934L8.93934 11.0607L10.3128 12.4341Z" fill="#ffffff"></path> </g></svg>
        </div>
            </div>
            <div>
                <h5 class="card-title"><b>SQD Rating</b></h5>
                <p class="card-subtext">Service Quality Dimension</p>
                <a class="btn" href="{{ route('SQDDashboard') }}"
                    style="background-color:rgb(20, 135, 217);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                   View
                </a>
            </div>
        </div>
        <!-- <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="card-header-flex">
                    <h2 class="card-number" id="sqd">SQD 1-8</h2>
                </div> 
                <div style="background-color:rgb(20, 135, 217); padding: 10px; border-radius: 50%;">
          <svg height="50" width="50"  viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4964 14.6178C11.215 15.4901 9.66706 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 9.66706 15.4901 11.215 14.6178 12.4964L16.0607 13.9393L13.9393 16.0607L12.4964 14.6178ZM10.3128 12.4341C9.62116 12.7956 8.83445 13 8 13C5.23858 13 3 10.7614 3 8C3 5.23858 5.23858 3 8 3C10.7614 3 13 5.23858 13 8C13 8.83445 12.7956 9.62116 12.4341 10.3128L11.0607 8.93934L8.93934 11.0607L10.3128 12.4341Z" fill="#ffffff"></path> </g></svg>
        </div>
            </div>
            <div>
                <h5 class="card-title"><b>SQD Rating</b></h5>
                <p class="card-subtext">Service Quality Dimension</p>
                <a class="btn" href="{{ route('OfficeRemarks') }}"
                    style="background-color:rgb(20, 135, 217);color:white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                   View
                </a>
            </div>
        </div> -->




<!-- <div class="dashboard-card" style="flex: 1 1 calc(25% - 20px);">
    <div class="card-body">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div class=" ">
                <h5 class="mb-1 fw-bold" style="font-size: 26px;">{{ $currentDate }}</h5>
                <div id="realtimeClock"
            style="font-size: 1.2rem; font-weight: 300; color: black; border-radius: 8px; display: inline-block; letter-spacing: 4px; text-transform:lowercase;">
        </div>
            </div>
            <div style="background-color:rgb(254, 254, 254); padding: 10px; border-radius: 50%;">
                <img src="{{ asset('calendar.svg') }}" style="width: 70px; height: 70px;">
            </div>
        </div>
        <p style="font-size: 26px; color: #333; font-weight:bold">{{ $quarterYear }}</p>
        
    </div>
</div> -->
<div class="dashboard-card d-flex p-4 mb-3 mt-2  " style="flex: 1 1 calc(100% - 20px); align-items: flex-start; justify-content: space-between; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); background-color: #fff;">
  



    <div class="mt-0 me-3" style="max-width: 95%;">
    <h6 class="mb-2"><strong>About this page</strong></h6>
    <p class="mb-2 card-subtext text-muted" style="font-size: 16px;  ">
       This dashboard provides a comprehensive overview of the <strong>survey data</strong>  collected from various sections and timeframes. 
        It visualizes and summarizes critical metrics such as the <strong> overall satisfaction rating, total number of survey responses, 
        and the count of valid surveys.</strong> Additionally, it presents performance ratings across quarters and years. The dashboard also highlights the results of each <strong> Service Quality Dimension (SQD)</strong>, 
        showing percentage scores for satisfaction, as well as the number of positive feedback entries and identified concerns. 
        </p>
     
  </div>

  <!-- Right: Info Icon -->
  <div style="width: 50px; height: 50px;">
    <svg viewBox="0 0 24 24" fill="none" stroke="#1976D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      style="width: 100%; height: 100%;" xmlns="http://www.w3.org/2000/svg">
      <circle cx="12" cy="12" r="10"></circle>
      <line x1="12" y1="16" x2="12" y2="12"></line>
      <line x1="12" y1="8" x2="12.01" y2="8"></line>
    </svg>
  </div>
  
  </div>



    </div>
    
</div>


<!-- SQD Dimensions Overview Card -->


<style>
.card-dimension {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>


 



    @if($total_responses != 0)

    <style>
        .card{
            padding:10px;
           
            margin-bottom: 20px;
            background-color: white;
          
        }
    </style>

 <div class="text" style="font-size: 16px;">   

    Overview of Result</div>

    <div class="card">
    <h4 class="csm-title text-center m-3">
  <i></i>  
  
  
  <style>
    .svg {
        width: 100%;
        max-width: 50px;
        height: auto;
    }

    @media (max-width: 576px) {
        .svg {
            max-width: 50px;  /* Smaller image for mobile */
        }
    }
</style>

    <img class="svg" src="{{ asset('title-rating2.svg') }}" alt="SVG Image" >
 &nbsp; Customer Satisfaction Measurement Office Rankings
</h4>
<div id="tableRating" style="width: 100%; ">
    <!-- Legend on top -->
    <div class="mb-3">
        <h6 class="mb-2"><strong> Legend</strong></h6>
        <div class="d-flex flex-wrap gap-3">
      
          
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #F44336;" class="me-2 border rounded"></div>
                <span>Below 60.0%% (Poor)</span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #FF9800;" class="me-2 border rounded"></div>
                <span>60.0% - 79.9% (Fair)</span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #8BC34A;" class="me-2 border rounded"></div>
                <span>80.0% - 94.9% (Satisfactory)</span>
            </div>
            <div class="d-flex align-items-center">
                <div style="width: 20px; height: 20px; background-color: #4CAF50;" class="me-2 border rounded"></div>
                <span>95.0% - 100% (Outstanding)</span>
            </div>
        </div>
    </div>

    <!-- Graph -->
    <div  style="height: 200px; width:100%; ">
        <canvas id="officeRankChart" style="width: 100%;" height="200"></canvas>
    </div>
</div>
 

    <div class="table-responsive">
        <table class="table table-bordered text-start"   style="font-size:18px">
            <thead class="table-dark" >
                <tr>
                    <th style="background-color: rgb(3, 45, 95);border:non;font-size:18px">Rank</th>
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px">Office Name</th>
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px">Responses</th>
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px"> Score</th> 
                    <th style="background-color: rgb(3, 45, 95);border:none;font-size:18px">Analysis</th> 
                </tr>
            </thead>
            <tbody id="offices-table" style="font-size:18px">
                <!-- Data will be loaded here -->
            </tbody>
        </table>
    </div>
 
</div>
   <div class="card shadow-sm mt-4">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <p> Overall Survey Score by Quarter</p>
            
       <select id="periodSelect" class="form-select form-select-sm w-auto">
    <!-- <option value="weekly">Weekly</option> -->
    <option value="monthly">Monthly</option>
    <option value="quarterly" selected>Quarterly</option>
    <option value="yearly">Yearly</option>
</select>

    </div>
    <div class="card-body">
        <div id="chartContainer" style="position: relative; height: 300px;">
            <canvas id="quarterlyLineChart"></canvas>
            <div id="chartLoading" class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="noDataMessage" class="d-none d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100">
                <div class="text-center text-muted">
                    <i class="fas fa-chart-bar fa-3x mb-3"></i>
                    <p>No survey data available for this period</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white border-0 p-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="badge bg-success p-2" id="currentScore">--</span>
                    </div>
                    <div>
                        <h6 class="mb-0 small fw-bold">Current Quarter Score</h6>
                        <p class="text-muted mb-0 small" id="scoreChange">
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            <span>--% from previous quarter</span>
                        </p>
                    </div>
                </div>
            </div>
             
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () { 
    // Chart configuration
    let chartInstance = null;
    const chartColors = {
        primary: 'rgb(20, 135, 217)', // Blue
        primaryLight: 'rgba(54, 162, 235, 0.5)',
        success: 'rgba(1, 238, 52, 0.66)', // Green
        warning: 'rgba(245, 158, 11, 1)', // Amber
        danger: 'rgba(239, 68, 68, 1)',   // Red
        grid: 'rgba(203, 213, 225, 0.5)'  // Slate gray
    };
    
    // Initial load
    loadChartData('quarterly');
    
    // Period selector buttons
  document.getElementById('periodSelect').addEventListener('change', function () {
    let selectedPeriod = this.value;
    loadChartData(selectedPeriod);
});

    
    // Chart style selector
 
    
  function loadChartData(period) {
    // Show loading indicator
    document.getElementById('chartLoading').classList.remove('d-none');
    document.getElementById('noDataMessage').classList.add('d-none');

    // Determine endpoint
    let endpoint = '';
    switch (period) {
        case 'yearly':
            endpoint = 'Admin/api/yearly-survey-scores';
            break;
        case 'monthly':
            endpoint = 'Admin/api/monthly-survey-scores';
            break;
        case 'quarterly':
        default:
            endpoint = 'Admin/api/quarterly-survey-scores';
            break;
    }

    // Fetch data from API
    fetch(endpoint)
        .then(response => response.json())
        .then(data => {
            const keyMap = {
                yearly: 'yearly_scores',
                quarterly: 'quarterly_scores',
                monthly: 'monthly_scores'
            };
            const scoresKey = keyMap[period] || 'quarterly_scores';

            if (data.success && Array.isArray(data[scoresKey]) && data[scoresKey].length > 0) {
                renderChart(data[scoresKey], period);
                updateStatistics(data[scoresKey]);
            } else {
                document.getElementById('noDataMessage').classList.remove('d-none');
                if (chartInstance) {
                    chartInstance.destroy();
                    chartInstance = null;
                }
            }
        })
        .catch(error => {
            console.error("Failed to load chart data:", error);
            document.getElementById('noDataMessage').classList.remove('d-none');
        })
        .finally(() => {
            document.getElementById('chartLoading').classList.add('d-none');
        });
}

 function renderChart(data, period) {
    // Generate labels based on selected period
    let labels = [];
    let labelPrefix = '';
    switch (period) {
        case 'monthly':
            labels = data.map(item => `${item.month} ${item.year}`); // "March 2025"
            labelPrefix = 'Monthly';
            break;
        case 'quarterly':
            labels = data.map(item => `${item.quarter} ${item.year}`); // "Q1 2025"
            labelPrefix = 'Quarterly';
            break;
        case 'yearly':
        default:
            labels = data.map(item => `${item.year}`); // "2025"
            labelPrefix = 'Yearly';
            break;
    }

    const scores = data.map(item => item.overallScore);

    const ctx = document.getElementById('quarterlyLineChart').getContext('2d');

    if (chartInstance) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: `${labelPrefix} Score`,
                data: scores,
                backgroundColor: chartColors.primary,
                borderColor: chartColors.primary,
                tension: 0.3,
                pointBackgroundColor: chartColors.primary,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1,
                    grid: {
                        color: chartColors.grid
                    },
                    ticks: {
                        callback: function(value) {
                            return (value * 100) + '%';
                        }
                    }
                },
                x: {
                    grid: {
                        color: chartColors.grid
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            return `Score: ${(context.raw * 100).toFixed(1)}%`;
                        }
                    }
                }
            }
        }
    });
}

    
    function updateChartStyle(style) {
        if (!chartInstance) return;
        
        const data = chartInstance.data;
        
        // Update chart type and styling
        if (style === 'area') {
            chartInstance.config.type = 'line';
            chartInstance.data.datasets[0].fill = true;
            chartInstance.data.datasets[0].backgroundColor = chartColors.primaryLight;
        } else {
            chartInstance.config.type = style;
            chartInstance.data.datasets[0].fill = false;
            chartInstance.data.datasets[0].backgroundColor = style === 'line' ? 
                chartColors.primary : chartColors.primary;
        }
        
        chartInstance.update();
    }
    
    function updateStatistics(data) {
    if (!Array.isArray(data) || data.length < 1) return;

    // Get current and previous scores
    const currentScore = data[data.length - 1].overallScore;
    const previousScore = data.length > 1 ? data[data.length - 2].overallScore : 0;

    // Calculate percent change
    let percentChange = 0;
    let changeDirection = 'equal';

    if (previousScore > 0) {
        percentChange = ((currentScore - previousScore) / previousScore) * 100;
        changeDirection = percentChange > 0 ? 'up' : (percentChange < 0 ? 'down' : 'equal');
    }

    // Format values
    const formattedCurrent = `${(currentScore * 100).toFixed(1)}%`;
    const formattedChange = `${Math.abs(percentChange).toFixed(1)}%`;

    // Period label (e.g., quarter, month, year)
    const period = document.getElementById('periodSelect').value;
    const periodText = period === 'yearly' ? 'year' :
                       period === 'quarterly' ? 'quarter' :
                       period === 'monthly' ? 'month' :
                       period === 'weekly' ? 'week' : 'period';

    // Update current score badge
    const scoreElement = document.getElementById('currentScore');
    scoreElement.textContent = formattedCurrent;

    if (currentScore >= 0.75) {
        scoreElement.className = 'badge bg-success p-2';
    } else if (currentScore >= 0.5) {
        scoreElement.className = 'badge bg-warning p-2';
    } else {
        scoreElement.className = 'badge bg-danger p-2';
    }

    // Update change description
    const scoreChangeEl = document.getElementById('scoreChange');
    if (changeDirection === 'up') {
        scoreChangeEl.innerHTML = `
            <i class="fas fa-arrow-up text-success me-1"></i>
            <span>${formattedChange} from previous ${periodText}</span>
        `;
    } else if (changeDirection === 'down') {
        scoreChangeEl.innerHTML = `
            <i class="fas fa-arrow-down text-danger me-1"></i>
            <span>${formattedChange} from previous ${periodText}</span>
        `;
    } else {
        scoreChangeEl.innerHTML = `
            <i class="fas fa-equals text-muted me-1"></i>
            <span>No change from previous ${periodText}</span>
        `;
    }
}

});
</script>

 <div class="text" style="font-size: 16px;">   
 Overview of SQD Performance Percentage

 </div>
<div class="dashboard-card p-4 rounded-4 mb-4" style=" background:white;border:1px solid #ccc">
    <div class="d-flex justify-content-between align-items-center mb-0 mt-0">
    <div>  
    <h5 class="fw-semibold mb-0" style="color:#333">SQD Overall Performance by Dimension</h5>
            <p class="card-subtext mb-0" style="font-size: 14px;">
        Summary of scores across each service quality dimension based on survey feedback.
    </p>
    </div>
    <div style="width: 60px; height: 60px; border-radius: 50%; background-color: #1976D2; display: flex; align-items: center; justify-content: center;">
        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" stroke-opacity="0.3" stroke-width="2.5"></circle>
            <path d="M12 2a10 10 0 0 1 0 20" stroke="#fff" stroke-width="2.5"></path>
        </svg>
    </div>
    </div>

    <div class="table-responsive">
        <table class="table table-borderless text-white align-middle">
            <thead class="text-light" style="border-bottom: 1px solid rgba(255,255,255,0.2);">
                <tr>
                    <th style="width: 25%;">Dimension</th>
                    <th style="width: 55%;">Progress</th>
                    <th style="width: 20%;">Score</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                <tr>
                    <td>Responsiveness</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd1" class="progress-bar" style="width: 0%; background-color: #4CAF50;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd1-text">0%</span></td>
                </tr>
                <tr>
                    <td>Reliability</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd2" class="progress-bar" style="width: 0%; background-color: #2196F3;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd2-text">0%</span></td>
                </tr>
                <tr>
                    <td>Access & Facilities</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd3" class="progress-bar" style="width: 0%; background-color: #FF9800;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd3-text">0%</span></td>
                </tr>
                <tr>
                    <td>Communication</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd4" class="progress-bar" style="width: 0%; background-color: #9C27B0;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd4-text">0%</span></td>
                </tr>
                <tr>
                    <td>Costs</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd5" class="progress-bar" style="width: 0%; background-color: #F44336;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd5-text">0%</span></td>
                </tr>
                <tr>
                    <td>Integrity</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd6" class="progress-bar" style="width: 0%; background-color: #E91E63;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd6-text">0%</span></td>
                </tr>
                <tr>
                    <td>Assurance</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd7" class="progress-bar" style="width: 0%; background-color: #795548;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd7-text">0%</span></td>
                </tr>
                <tr>
                    <td>Outcome</td>
                    <td>
                        <div class="progress" style="height: 10px;">
                            <div id="sqd-sqd8" class="progress-bar" style="width: 0%; background-color: #8BC34A;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td><span id="sqd-sqd8-text">0%</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Toggle Logic -->
<script>
    function showTable(type) {
        const sections = ['office', 'section', 'service'];

        sections.forEach(section => {
            const sectionId = section + 'TableSection';
            const buttonId = 'btn-' + section;

            document.getElementById(sectionId).style.display = (section === type) ? 'block' : 'none';
            document.getElementById(buttonId).classList.toggle('active', section === type);
        });
    }
</script>

<!-- Optional Styling -->
<style>
    .btn.active {
        background-color: #0d6efd !important;
        border:none;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);
    }
   

</style>


<script>
    
    let officeChart;  
       document.addEventListener("DOMContentLoaded", function () {
     
        loadOverallScore();  
        setInterval(loadOverallScore, 10000);  
        
        fetchAndUpdateChart();  
        setInterval(fetchAndUpdateChart, 10000);  
  
        fetchRankedOffices();
        setInterval(fetchRankedOffices, 10000); 
             });
     
       
        


 // CHART FOR THE OFFICE RANKINGS
       
        // const ctx = document.getElementById('satisfactionChart').getContext('2d');
        // new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        //         datasets: [{
        //             label: 'Satisfaction Rate (%)',
        //             data: [80, 85, 83, 87, 90],
        //             borderColor: 'blue',
        //             borderWidth: 2
        //         }]
        //     },
        //     options: {
        //         responsive: true
        //     }
        // });
 
  
  // LOAD THE STATUS ICON

   function loadOverallScore() {
    fetch('Admin/overall-total-score')
    .then(response => response.json())
    .then(data => {
        const score = data.overallScore;
        const satisfactionRate = (score * 100).toFixed(2);
        document.getElementById("satisfactionRate").textContent = satisfactionRate + "%";

        let satisfactionText = '';
        let iconPath = '';

        if (score < 0.60) {
            satisfactionText = 'Poor';
            iconPath = '{{ asset("poor.svg") }}';
            document.getElementById('satisfactionText').style.color =   '#F44336' ;
        } else if (score >= 0.60 && score < 0.80) {
            satisfactionText = 'Fair';
            iconPath = '{{ asset("fair.svg") }}';
            document.getElementById('satisfactionText').style.color =   '#FF9800' ;
        } else if (score >= 0.80 && score < 0.95) {
            satisfactionText = 'Satisfactory';
            iconPath = '{{ asset("smile2.svg") }}';
            document.getElementById('satisfactionText').style.color =   '#4CAF50' ;
        } else {
            satisfactionText = 'Outstanding';
            iconPath = '{{ asset("smile.svg") }}';
            document.getElementById('satisfactionText').style.color =   '#388E3C' ;
        }

        document.getElementById('satisfactionText').textContent = satisfactionText; 
        // Fetch and insert the SVG
    fetch(iconPath)
    .then(res => res.text())
    .then(svg => {
        document.getElementById("faceIcon").innerHTML = svg;

        const insertedSvg = document.querySelector("#faceIcon svg");
        if (insertedSvg) {
            insertedSvg.setAttribute("width", "100%");
            insertedSvg.setAttribute("height", "100%");
            insertedSvg.style.width = "100%";
            insertedSvg.style.height = "100%";
        }
    });

    });
}
    
</script>
        



  <div class="  dashboard-container m-0" style="display: flex; flex-wrap: wrap;  justify-content: space-between;padding-top:5px ">

    
 <div class=" " style="flex: 1 1 calc(100% - 20px);
 "
 style="background:transparent"
 >
    <div class="card-body" style="display: flex; justify-content: center; align-items: flex-start; height: 100%;">
    <div style="
        display: flex;
        flex-direction: column;
        align-items: center;
    ">
        <!-- <p class="text" style="font-size: 30px; font-weight: 500;   margin-top: 10px;">San Carlos City</p> -->
      
     <div style="position: relative; width: 200px; height: 200px;">

    
    <div style="
        position: absolute;
        top: 0px;
        left: 60px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 0;
    ">
        <img src="{{ asset('psunian.jpg') }}" style="width: 200px; height: 200px; border-radius: 50%;">
    </div>
 
    <div style="
        position: absolute;
        top: 0;
        left: -60;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    ">
        <img src="{{ asset('logo.png') }}" style="width: 200px; height: 200px; border-radius: 50%;">
    </div>

</div>


    </div>
</div>
 </div>


  </div>

@php
    $isDark = session('mode') === 'dark';
    $bgColor = $isDark ? 'rgba(10, 162, 227, 0.55)' : 'rgba(30, 144, 255, 0.2)'; // lighter blue when light mode
    $textColor = $isDark ? '#ffffff' : '#333333';
    $subTextColor = $isDark ? '#d0e7ff' : '#555555';
@endphp

<div style="
    color: <?=  $textColor ?>;
    background: <?= $bgColor ?>;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 20px 30px;
    margin-top: 40px;
    font-family: 'Segoe UI', sans-serif;
    text-align: center;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
">
    <strong style="font-size: 18px;">Enhancing Service Quality Together</strong><br>
    Powered by <span style="font-weight: 600;">SDO San Carlos City</span> & <span style="font-weight: 600;">PSU San Carlos City</span><br>
    Striving for <em>Mabilis</em> (efficiency), <em>Malinis</em> (integrity), and <em>Maayos</em> (organization)<br>
    <span style="font-size: 13px; color: <?=  $subTextColor ?>;">© 2025 All Rights Reserved</span>
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

<p class="mb-0 text-muted">No responses for Q{{ $quarter }} {{ now()->year }}.</p>

</div> 
 
@endif
 
@endsection
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/AdminDashboardJS/more_function.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_ranked_office.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_overall_score.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_office.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_section.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_sqd_service.js') }}"></script>
<script src="{{ asset('js/AdminDashboardJS/fetch_service_performance.js') }}"></script>

 