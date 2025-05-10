<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Measurement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">

   <style>
      
        .form-section {
            padding: 20px;
         
        }
        
        .form-check-input:checked {
            background-color:rgb(4, 59, 125);
            border-color:rgb(4, 59, 125);
        }
        .btn-primary {
            background-color:rgb(4, 59, 125);
            border: none;
        }
        .btn-primary:hover {
            background-color:rgb(63, 63, 63);
        }
        .form-check-input[type="radio"] {
        width: 20px;
        height: 20px;
        border: 2px solid rgb(4, 59, 125); /* Thicker border */
        border-radius: 50%;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
        position: relative;
        margin-top: 3px;
    }

    </style>
    @include('layout.survey_header')
</head>
<body>




<div class="container mt-4">
    <div class="card shadow-sm"  >
    <div class="card-header d-flex justify-content-center align-items-center flex-wrap text-center" style="border: none;padding-top:20px">
    <!-- Left Logo -->
    
   
   @include('components.header')
</div>


    <p style=" background:rgb(4, 59, 125);font-family:'Segoe UI',
     Tahoma, Geneva, Verdana, sans-serif;font-size:14px; padding:25px;color:white">
        The Client Satisfaction (CSM) tracks the customer experience of government offices. Your feedback on your recently concluded transaction will help this office provide better service. Personal information shared will be kept confidential and you always have the option to not answer this form.</p>
         
    
        <div class="form-section" style=" margin-bottom:0px">
        <form action="{{ route('selectOffice') }}" >

   
       <h5 class="mb-3">Client Information</h5>
                 <input type="hidden" name="mainOffice" value="{{ request()->query('mainOffice') ?? '' }}">
<input type="hidden" name="subOffice" value="{{ request()->query('subOffice') ?? '' }}">
    


              <!-- Age Field -->
    <div class="mb-3">
    <div class="p-3 rounded" style="background-color: #eef5f7;margin-bottom:10px">
   
    <div class="d-flex align-items-center">
    <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            1
        </div>
        <label class="  m-0">Age<span class="text-danger">*</span></label>
    </div>
</div>
<input 
    style="border-bottom: 2px solid rgb(4, 59, 125);" 
    name="age" 
    type="number" 
    class="form-control" 
    placeholder="Enter your age" 
    required 
    min="12" 
    max="100"
    value="{{ session('age', '') }}">

    </div>
    
                
    <!-- Sex Field -->
    <div class="mb-3">
    <div class="p-3 rounded" style="background-color: #eef5f7;margin-bottom:10px">
   
    <div class="d-flex align-items-center">
    <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            2
        </div>
        <label class="  m-0">Sex<span class="text-danger">*</span></label>
    </div>
    </div>
    <div class="form-check" style="margin-left: 20px;">
            <input class="form-check-input" type="radio" name="sex" id="male" value="Male" required
                {{ session('sex') == 'Male' ? 'checked' : '' }}>
            <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check" style="margin-left: 20px;">
            <input class="form-check-input" type="radio" name="sex" id="female" value="Female"
                {{ session('sex') == 'Female' ? 'checked' : '' }}>
            <label class="form-check-label" for="female">Female</label>
        </div>
    </div>

    <!-- Customer Type Field -->
    <div class="mb-3">
    <div class="p-3 rounded" style="background-color: #eef5f7;margin-bottom:10px">
   
   <div class="d-flex align-items-center">
   <div class="text-white fw-bold me-2 text-center d-flex justify-content-center align-items-center"
            style="background-color: rgb(4, 59, 125); width: 30px; height: 30px; border-radius: 50%;">
            3
        </div>
       <label class="  m-0">Customer Type<span class="text-danger">*</span></label>
   </div> 
   </div>
        <div class="form-check" style="margin-left: 20px;">
            <input value="Business (private school, corporations, etc.)" class="form-check-input" type="radio" 
                   name="customerType" id="business" required
                   {{ session('customerType') == 'Business (private school, corporations, etc.)' ? 'checked' : '' }}>
            <label class="form-check-label" for="business">Business (private school, corporations, etc.)</label>
        </div>
        <div class="form-check" style="margin-left: 20px;">
            <input value="Citizen (general public, learners, parents, former DepEd employees, researchers, NGOs etc.)" class="form-check-input" type="radio" 
                   name="customerType" id="citizen"
                   {{ session('customerType') == 'Citizen Citizen (general public, learners, parents, former DepEd employees, researchers, NGOs etc.)' ? 'checked' : '' }}>
            <label class="form-check-label" for="citizen">Citizen (general public, learners, parents, former DepEd employees, researchers, NGOs etc.)</label>
        </div>
        <div class="form-check" style="margin-left: 20px;">
            <input value="Government (current DepEd employees or employees of other government agencies & LGUs)" class="form-check-input" type="radio" 
                   name="customerType" id="government"
                   {{ session('customerType') == 'Government (current DepEd employees or employees of other government agencies & LGUs)' ? 'checked' : '' }}>
            <label class="form-check-label" for="government">Government (current DepEd employees or employees of other government agencies & LGUs)</label>
        </div>
   
               
            
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
    <!-- Buttons -->
    <div>
          <button type="submit" class="btn text-white px-4" style="background-color: rgb(4, 59, 125);">Next</button>
    </div>
    </form>
    <!-- Progress bar -->
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
    <span class="progress-text">Page 1 of 6</span>
    <div class="progress">
        <div class="progress-bar" style="width: 22%;"></div> <!-- Adjust width dynamically -->
    </div>
</div>
 
</div>
 </div>

<!-- <p class="mt-2 text-muted small" style="margin-left: 20px;">
    Satisfied with our survey form?  <a href="#" class="text-primary">Rate Us Now</a>
</p> -->

@include('components.footer')

    </div>
     <br><br>

 

@if(session('success'))
    <!-- Custom Modal -->
    <div id="customModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h4>Transaction Number has been Verified.</h4>
                 
            </div>
             
            <div class="modal-footer">
                <button class="btn btn-primary w-100" onclick="closeModal()">OK</button>
            </div>
        </div>
    </div>

    <script>
        // Show modal on page load
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("customModal").style.display = "flex";
        });

        // Close modal function
        function closeModal() {
            document.getElementById("customModal").style.display = "none";
        }
    </script>

    <style>
        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        /* Modal Box */
        .modal-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        /* Modal Header */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }

        /* Close Button */
        .close-btn {
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
        }

        /* Modal Footer */
        .modal-footer {
            margin-top: 10px;
        }
    </style>
@endif
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
