<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Survey</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .progress-bar {
            height: 5px;
            background-color: rgb(4, 59, 125);
            width: 50%;
            border-radius: 5px;
        }  .radio-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
            margin-left: 5px;
        }
        input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgb(4, 59, 125);
            border-radius: 50%;
            display: inline-block;
            position: relative;
        }
        input[type="radio"]:checked {
            background-color: rgb(4, 59, 125);
            border: 5px solid white;
            box-shadow: 0 0 0 2px rgb(4, 59, 125);
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
<!-- Inside .card-body -->
<form action="{{ route('citizens.charter.store') }}" method="POST">
    @csrf
<input type="hidden" name="mainOffice" value="{{ session('mainOffice') }}">
    <input type="hidden" name="subOffice" value="{{ session('subOffice') }}">
    <input type="hidden" name="services_id" value="{{ session('services_id') }}">
   

<h6 class="fw-bold">* Required</h6> 
<input style="background-color: #eef5f7;margin-bottom:5px;border:none" type="text" class="form-control" disabled value="Citizen's Charter">

<!-- Question 7 -->
<div class="p-3 rounded mb-3" style="background-color: #eef5f7;">
    <div class="d-flex align-items-start mb-2">
        <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            7
        </div>
        <div>
            <label class="m-0 d-block">Are you aware of the Citizen's Charter - document of the SDO services and requirements?<span class="text-danger">*</span></label>
            <small class="text-muted d-block">Alam mo ba ang Citizen’s Charter, isang dokumento na naglalahad ng mga serbisyo at kinakailangan ng SDO?</small>
        </div>
    </div>
    <div class="radio-container">
    <label>
    <input type="radio" name="citizens_charter_awarenessQ" value="yes" required
        {{ session('citizens_charter_awarenessQ') == 'yes' ? 'checked' : '' }}>
    Yes
</label>

<label>
    <input type="radio" name="citizens_charter_awarenessQ" value="no" required
        {{ session('citizens_charter_awarenessQ') == 'no' ? 'checked' : '' }}>
    No
</label>
</div>
</div>

<!-- Question 8 -->
<div class="p-3 rounded mb-3" style="background-color: #eef5f7;">
    <div class="d-flex align-items-start mb-2">
        <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            8
        </div>
        <div>
            <label class="m-0 d-block">Did you see the SDO Citizen's Charter (online or posted in the office)?<span class="text-danger">*</span></label>
            <small class="text-muted d-block">Nakita mo ba ang Citizen's Charter ng SDO (online o nakapaskil sa opisina)?</small>
        </div>
    </div>
    <div class="radio-container">
    <label>
    <input type="radio" name="citizens_charter_sawQ" value="Yes - it was easy to find" required
        {{ session('citizens_charter_sawQ') == 'Yes - it was easy to find' ? 'checked' : '' }}>
    Yes - it was easy to find
</label>

<label>
    <input type="radio" name="citizens_charter_sawQ" value="Yes - but it was hard to find" required
        {{ session('citizens_charter_sawQ') == 'Yes - but it was hard to find' ? 'checked' : '' }}>
    Yes - but it was hard to find
</label>

<label>
    <input type="radio" name="citizens_charter_sawQ" value="no" required
        {{ session('citizens_charter_sawQ') == 'no' ? 'checked' : '' }}>
    No
</label>
</div>
</div>

<!-- Question 9 -->
<div class="p-3 rounded mb-3" style="background-color: #eef5f7;">
    <div class="d-flex align-items-start mb-2">
        <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            9
        </div>
        <div>
            <label class="m-0 d-block">Did you use the SDO Citizen's Charter as a guide for the service you availed?<span class="text-danger">*</span></label>
            <small class="text-muted d-block">Ginamit mo ba ang Citizen's Charter ng SDO bilang gabay para sa serbisyong iyong tinanggap?</small>
        </div>
    </div>
    <div class="radio-container">
    <label>
    <input type="radio" name="citizens_charter_usedQ" value="Yes" required
        {{ session('citizens_charter_usedQ') == 'Yes' ? 'checked' : '' }}>
    Yes
</label>

<label>
    <input type="radio" name="citizens_charter_usedQ" value="no" required
        {{ session('citizens_charter_usedQ') == 'no' ? 'checked' : '' }}>
    No
</label>
 </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-4">
    <div>
<a href="javascript:history.back()" class="btn btn-outline-dark px-4"><i class="fas fa-chevron-left"></i></a>

<button  type="submit" class="btn text-white px-4" style="background-color: rgb(4, 59, 125)"><i class="fas fa-chevron-right"></i></button>
</div>
</form>

<style>
    .progress-container {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background-color:rgb(240, 238, 247);
        border-radius: 8px;
        width: fit-content;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .progress-text {
        color:rgb(32, 53, 132);
        font-weight: normal;
    }

    .progress {
        width: 120px;
        height: 6px;
        background-color: #ccc;
        border-radius: 3px;
        overflow: hidden;
        position: relative;
    }

    .progress-bar {
        height: 100%;
        width: 15%; /* Dynamic value */
        background: linear-gradient(90deg,rgb(15, 21, 109),rgb(20, 70, 146));
        border-radius: 3px;
        transition: width 0.5s ease-in-out;
    }
@media (max-width: 768px) {
    .action-container {
        flex-direction: column;
        align-items: center;
    }

    .progress-container {
        flex-direction: column;
        align-items: center;
        width: 100px;
        margin-top: 10px;
        font-size:12px;
    }

    .progress {
        width: 100%;
        height: 5px;
    }
}

</style>

<div class="progress-container">
    <span class="progress-text">Page 5 of 6</span>
    <div class="progress">
        <div class="progress-bar" style="width: 66%;"></div> <!-- Adjust width dynamically -->
    </div>
</div>
    </div>
  
    </div>  @include('components.footer')
</body>
</html>
