<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SDO San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
        body {
            background-color: rgb(133, 133, 133);
        }

        /* Ensure the card takes up full width on smaller screens */
        

        
       

        /* Media query for larger screens (md and above) */
        @media (min-width: 768px) {
            

            .logo-container {
                width: 50%;
                margin-bottom: 0;
            }

            .form-container {
                width: 50%;
            }
        }

        /* On small screens, stack logo/title and form vertically */
        @media (max-width: 767px) {
           

            .logo-container, .form-container {
                width: 100%;
                text-align: center;
                margin-bottom: 20px;
            }
        }

        .login-container {
            background: #343a40;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

         
        
        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        
.collage-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-wrap: wrap;
    overflow: hidden;
    z-index: -1; /* Keeps it behind the form */
}

/* Grid-style Image Placement (3x3) */
.collage-bg img {
    width: 33.33%; /* 3 images per row */
    height: 33.33vh; /* 3 rows */
    object-fit: cover; /* Ensures images fit */
}

/* Bluish Overlay */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(11, 75, 139, 0.5);/* Adjust opacity for effect */
}

/* Centered Login Form */
.login-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 300px;
}

/* Form Styling */
.login-container h2 {
    margin-bottom: 15px;
}

.login-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

 

 
/* Header Styling */
.header {
    background-color:rgb(4, 59, 125);
    color:white;
    padding: 10px 20px;
}

.header-logo {
    width: 60px; /* Adjust logo size */
    margin-right: 15px;
}

.header-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 0;
}

.header-subtitle {
    font-size: 18px;
    margin-bottom: 0;
}

/* Ensures form and logo align properly */
.logo-container {
    width: 40%;
}

.form-container {
    width: 60%;
}
@media (max-width: 767px) {
        .header-logo {
            width: 40px; /* Shrink the logo size on mobile */
        }

        .header-title {
            font-size: 16px; /* Shrink the title size on mobile */
        }
        .header-subtitle {
            font-size: 14px; /* Shrink the title size on mobile */
        }
     
        .header h1,
        .header h2 {
            margin: 2px 0;
        } 
         
    }
    </style>
</head>
<body>
<div class="collage-bg">
    <img src="{{ asset('img/1.png') }}" alt="Image 1">
    <img src="{{ asset('img/2.png') }}" alt="Image 2">
    <img src="{{ asset('img/3.png') }}" alt="Image 3">
    <img src="{{ asset('img/4.png') }}" alt="Image 4">
    <img src="{{ asset('img/5.png') }}" alt="Image 5">
    <img src="{{ asset('img/6.png') }}" alt="Image 6">
    <img src="{{ asset('img/7.png') }}" alt="Image 7">
    <img src="{{ asset('img/8.png') }}" alt="Image 8">
    <img src="{{ asset('img/9.png') }}" alt="Image 9">
    <div class="overlay"></div> <!-- Bluish overlay -->
</div>
<header class="header">
    <div class="container d-flex align-items-center py-2">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="header-logo">
        <div>
            <h1 class="header-title">Schools Division Office</h1>
            <h2 class="header-subtitle">San Carlos City</h2>
        </div>
    </div>
</header>
<div class="container d-flex justify-content-center align-items-center mt-3 "  >
    <div class="card shadow-lg" style="width: 440px;">
        
        <div class="card-body" >
        
       
    <form action="{{ route('office.login') }}" method="POST">
        @csrf
        <div style="display: flex; justify-content: center; align-items: center; width: 100%; gap: 10px; position: relative;">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="mb-3 mt-3" style="width: 120px;">
    
    <!-- Use user.svg from the public directory, positioned at the bottom-right of the logo -->
    <img src="{{ asset('user.svg') }}" alt="User Icon" width="40" height="40" style="position: absolute; bottom: 0; right: 0;">
</div>

<div class="mb-3" style="text-align: left;">
    <label for="office_id" class="form-label">Account ID:</label>
    <div class="input-group">
        <input 
            style="border: 2px solid rgb(4, 59, 125); padding: 10px; width: 100%; border-radius: 5px;" 
            type="text" 
            id="office_id" 
            name="office_id" 
            class="form-control @error('error') is-invalid @enderror" 
            value="{{ old('office_id') }}" 
            
         >
         @error('office_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3" style="text-align: left;">
    <label for="password" class="form-label">Password</label>
    <div class="input-group">
        <input 
            style="border: 2px solid rgb(4, 59, 125); padding: 10px; width: 100%; border-radius: 5px;" 
            type="password" 
            id="password" 
            name="password" 
            class="form-control @error('error') is-invalid @enderror" 
             minlength="6"
             maxlength="6"  >
        @error('password')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
 
<!-- @if($errors->has('error'))
    <div class="alert alert-danger mt-2">
        {{ $errors->first('error') }}
    </div>
@endif -->

<!-- Modal --> 
<!-- Trigger the modal based on error -->
@if($errors->has('error'))
<div id="floating-alert" class="position-fixed top-50 start-50 translate-middle d-flex align-items-center justify-content-center" 
         style="width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.4); z-index: 1100;">
        <div class="rounded-4 shadow-lg p-4 text-center" 
             style="background: white; width: 300px; max-width: 90%;">

            <!-- Alert Icon -->
            <div class="mb-3">
                <i class="fas  fa-exclamation-circle text-danger  " 
                   style="font-size: 48px;">
                </i>
            </div>

            <!-- Alert Title -->
            <h5 class="fw-bold text-danger">
               Incorrect Credentials
            </h5>

            <!-- Alert Message -->
            <p class="text-muted">
        Please Try Again    
        </p>

            <!-- Countdown Timer -->
             
            <!-- OK Button -->
            <button type="button" id="close-alert" class="btn btn-danger px-4 py-1">OK</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
               let closeBtn = document.getElementById("close-alert");
               let alertBox = document.getElementById("floating-alert");
           
            // Close Alert on Button Click
            closeBtn.addEventListener("click", function() {
                
                fadeOutAlert();
            });

            function fadeOutAlert() {
                alertBox.style.display = "none";
                alertBox.style.visibility = "hidden";
                   
            }
     
        });
    </script>
@endif

        <button type="submit" class="btn btn-primary w-100 btn-lg"   >
    Login
</button>
<a href="{{ url('create-account') }}" style="text-align:center; font-size: 16px; color:rgb(105, 116, 127); text-decoration: none;   ">
    Do you already activate your account? <b>Activate First</b>
</a>

<style>
    a:hover {
        color:rgb(12, 62, 114); /* Darker shade of blue on hover */
        scale: 1.2rem;
    }
</style>


 
   
        <!-- <a href="{{ url('create-account') }}" class="btn btn-link" style="margin-top: 10px; color: #007bff;">Create an Account</a> -->
    </form>
</div>

 
    </div>
</div>
@if(session('success') || session('error') || session('warning'))
<div id="floating-alert" class="position-fixed top-50 start-50 translate-middle d-flex align-items-center justify-content-center" 
     style="width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.4); z-index: 1100;">
    <div class="rounded-4 shadow-lg p-4 text-center" 
         style="background: white; width: 300px; max-width: 90%;">

        <!-- Alert Icon -->
        <div class="mb-3">
            @if(session('success'))
                <i class="fas fa-check-circle text-success" 
                   style="font-size: 48px;"></i>
            @elseif(session('error'))
                <i class="fas fa-exclamation-circle text-danger" 
                   style="font-size: 48px;"></i>
            @endif
        </div>

        <!-- Alert Title -->
        <h5 class="fw-bold 
            @if(session('success')) text-success 
            @elseif(session('error')) text-danger 
            @endif">
            @if(session('success')) 
            {{session('error')}}

            @elseif(session('error')) 
                {{session('error')}}
            @endif
        </h5>

        <!-- Alert Message -->
        <p class="text-muted">
            @if(session('success'))
                Your account has been successfully activated.
            @elseif(session('error'))
                Please Try Again    
            @endif
        </p>

        <!-- OK Button -->
        <button type="button" id="close-alert" class="btn 
            @if(session('success')) btn-success 
            @elseif(session('error')) btn-danger 
            @endif px-4 py-1">OK</button>
      
    </div>
</div>
@endif
<script>
        document.addEventListener("DOMContentLoaded", function() {
            let alertBox = document.getElementById("floating-alert");
            let closeBtn = document.getElementById("close-alert");
           

            // Close Alert on Button Click
            closeBtn.addEventListener("click", function() {
              
                fadeOutAlert();
            });

            // Fade Out and Remove Alert from DOM
            function fadeOutAlert() {
                alertBox.style.display = "none";
                alertBox.style.visibility = "hidden";
            }
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
