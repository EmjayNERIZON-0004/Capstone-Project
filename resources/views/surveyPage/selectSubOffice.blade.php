<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Survey</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">

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
    <div class="container  mt-4">
    <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-center align-items-center flex-wrap text-center" style="border: none;padding-top:20px">
    <!-- Left Logo -->
    @include('components.header')

   
</div>
        <div class="card-body">
             <!-- <h6 class="fw-bold">* Required</h6>  -->
            <input style="background-color: #eef5f7;margin-bottom:5px;border:none" type="text" class="form-control" disabled value="Required *">
            <div class="p-3 rounded" style="background-color: #eef5f7;margin-bottom:7px">
            
            <div class="d-flex align-items-start">
            <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            5
        </div>
    
    <div>
    <label class="m-0 d-block">Which specific office did you transact with in the {{$selected_office['office_name']}} Office?<span class="text-danger">*</span></label>
<small class="text-muted d-block">Aling partikular na opisina ang iyong pinuntahan para sa iyong transaksyon?</small>
  </div>
</div></div>


 <form action="{{ route('submit-suboffice') }}" method="POST">
    @csrf
    <input type="hidden" name="main_office_id" value="{{ $selected_office['office_id']    }}">
    <input type="hidden" name="age" value="{{ session('age') }}">
<input type="hidden" name="sex" value="{{ session('sex') }}">
<input type="hidden" name="customerType" value="{{ session('customerType') }}">
<input type="hidden" name="mainOffice" value="{{ session('mainOffice') }}">



<select class="form-select mt-2" name="sub_office_id" style="border-bottom: 2px solid rgb(4, 59, 125);" required>
    @foreach ($sub_offices as $sub_office)
        <option 
            value="{{ $sub_office->id }}" 
            data-main="{{ $sub_office->main_office_id }}"
            {{ (!empty($subOffice) && $subOffice == $sub_office->id) ? 'selected' : '' }}
            {{ (!empty($subOffice) && $subOffice != $sub_office->id) ? 'disabled' : '' }}
        >
            {{ $sub_office->sub_office_name }}
        </option>
    @endforeach
</select>


  





            
<div class="d-flex justify-content-between align-items-center mt-4">
    <!-- Buttons -->
    <div>
    <a href="javascript:history.back()" class="btn btn-outline-dark px-4">
    <i class="fas fa-chevron-left"></i>
</a>
  <button type="submit" class="btn text-white px-4"  ><i class="fas fa-chevron-right"></i></button>
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
    <span class="progress-text">Page 3 of 6</span>
    <div class="progress">
        <div class="progress-bar" style="width: 44%;"></div> <!-- Adjust width dynamically -->
    </div>
</div>
</div>

<!-- Below text -->
 
</form>

    </div>
    @include('components.footer')   </div>
    </div>
</body>
</html>
