<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <style>
        
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .progress-bar {
            height: 5px;
            background-color: #027175;
            width: 50%;
            border-radius: 5px;
        }
    </style>
    @include('layout.survey_header')
</head>
<body>
    <div class="container mt-4">
    <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-center align-items-center flex-wrap text-center" style="border: none;padding-top:20px">
    <!-- Left Logo -->
    <img src="{{ asset('logo.png') }}" alt="Left Logo" class="logo "  >

    <!-- Centered Text -->
    <div  >
        <h4 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; " class="header-text">
            <b>SDO SAN CARLOS CITY PANGASINAN - R1</b>
        </h4>
        <h4>Client Satisfaction Measurement (CSM) </h5>
    </div>

   
</div>
        <div class="card-body">
             <!-- <h6 class="fw-bold">* Required</h6>  -->
            <input style="background-color: #eef5f7;margin-bottom:5px;border:none" type="text" class="form-control" disabled value="View Only">
            <div class="p-3 rounded" style="background-color: #eef5f7;margin-bottom:7px">
            
            <div class="d-flex align-items-start">
   
    <div>
    <label class="m-0 d-block">Citizen's Charter </label>
<small class="text-muted d-block">Narito ang Citizen's Charter ng SDO San Carlos City</small>
  </div> </div>
</div>

 

    








            
<div class="d-flex justify-content-between align-items-center mt-4">
    <!-- Buttons -->
    <div>

    <input type="text" name="mainOffice" value="{{ session('mainOffice') }}">

<input type="text" name="subOffice" value="{{ session('subOffice') }}">
<input type="text" name="citizens_charter_awarenessQ" 
       value="{{ session()->has('citizens_charter_awarenessQ') ? session('citizens_charter_awarenessQ') : null }}">

<input type="text" name="citizens_charter_sawQ" 
       value="{{ session()->has('citizens_charter_sawQ') ? session('citizens_charter_sawQ') : null }}">

<input type="text" name="citizens_charter_usedQ" 
       value="{{ session()->has('citizens_charter_usedQ') ? session('citizens_charter_usedQ') : null }}">




<input type="text" name="services_id" value="{{ session('services_id') }}">

   
    <a href="javascript:history.back()" class="btn btn-outline-dark px-4">
    <i class="fas fa-chevron-left"></i>
</a>
<a href="javascript:history.back()" class="btn btn-outline-dark px-4">
    <i class="fas fa-chevron-right"></i>
</a>
        <!-- <button  type="submit" class="btn text-white px-4" style="background-color: rgb(4, 59, 125);"><i class="fas fa-chevron-right"></i></button> -->
    </div>

    <!-- Progress bar -->
    <!-- <div class="d-flex align-items-center p-2 rounded" style="background-color: #eef5f7;">
        <span class="me-2" style="color: #0f6c6d;">Page 9 of 19</span>
        <div class="progress" style="width: 100px; height: 4px; background-color: #ccc;">
            <div class="progress-bar" style="width: 50%; background-color: #0f6c6d;"></div>
        </div>
    </div> -->
</div>

<!-- Below text -->
<p class="mt-2 text-muted small">
    Never give out your password. <a href="#" class="text-primary">Report abuse</a>
</p>
 

 
    </div>
    </div>
    </div>
</body>
</html>
