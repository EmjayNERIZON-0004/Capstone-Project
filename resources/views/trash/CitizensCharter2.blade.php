<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">
 
    <style>
        
      
      
         .radio-container {
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
    @include('components.header')
   
</div>
        <div class="card-body">
             <h6 class="fw-bold">* Required</h6> 
            <input style="background-color: #eef5f7;margin-bottom:5px;border:none" type="text" class="form-control" disabled value="Citizen's Charter">
            
            <div class="p-3 rounded" style="background-color: #eef5f7;margin-bottom:7px">
                <div class="d-flex align-items-start">
    <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
        style="background-color: rgb(4, 59, 125); width: 25px; height: 25px;">
        8
    </div>
    <div>
        <label class="m-0 d-block">Did you see the SDO Citizen's Charter (online or posted in the office)?<span class="text-danger">*</span></label>
        <small class="text-muted d-block">Nakita mo ba ang Citizen's Charter ng SDO (online o nakapaskil sa opisina)?</small>
    </div>
</div>

    </div>



    <form action="{{route('sawQ')}}" method="POST">
@csrf <!-- CSRF protection token -->
    <input type="hidden" name="mainOffice" value="{{ session('mainOffice') }}">

    <input type="hidden" name="subOffice" value="{{ session('subOffice') }}">
    <input type="hidden" name="citizens_charter_awarenessQ" value="{{ session('citizens_charter_awarenessQ') }}">



    <input type="hidden" name="services_id" value="{{ session('services_id') }}">

    <div class="radio-container">
  <label>  <input type="radio" name="citizen_charter"   value="Yes - it was easy to find"  required >
                Yes - it was easy to find</label>
          
          
                <label>
    <input   type="radio" name="citizen_charter"   value="Yes - but it was hard to find" required>
    Yes - but it was hard to find           
</label>
         <label>
                         <input type="radio" name="citizen_charter" value="no" required>
                         No
                     </label>
                    
                 </div>   
<div class="d-flex justify-content-between align-items-center mt-4">
    <!-- Buttons -->
    <div>
        <a href="javascript:history.back()" class="btn btn-outline-dark px-4"><i class="fas fa-chevron-left"></i></a>

        <button  type="submit" class="btn text-white px-4" style="background-color: rgb(4, 59, 125);"><i class="fas fa-chevron-right"></i></button>
    </div>


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
    <span class="progress-text">Page 6 of 8</span>
    <div class="progress">
        <div class="progress-bar" style="width:77%;"></div> <!-- Adjust width dynamically -->
    </div>
</div>
</div>
    </form>
<!-- Below text -->
 
    </div>
    @include('components.footer')
    </div>
    </div>
</body>
</html>
