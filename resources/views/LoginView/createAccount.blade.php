<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Basic styling for background */
        body {
            background-color: rgb(133, 133, 133);
        }

        /* Ensure the card takes up full width on smaller screens */
 
        /* Styles for logo and title */
        .logo-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-container {
            width: 100%;
        }

        /* Media query for larger screens (md and above) */
        @media (min-width: 768px) {
            .card-body {
                flex-direction: row;
                justify-content: space-between;
            }

            .logo-container {
                width: 50%;
                margin-bottom: 0;
            }

            .form-container {
                width: 50%;
            }
        }

        /* Basic styling for inputs and form controls */
        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            border: 2px solid rgb(4, 59, 125);
        }

        
        /* Header Styling */
        .header {
            background-color: rgb(4, 59, 125);
            color: white;
            padding: 10px 20px;
        }

        .header-logo {
            width: 60px;
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

        .login-container {
            background: #343a40;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
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

        /* Additional Margin for the Title */
        .title-container {
            margin-bottom: 20px;
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

<!-- Bluish Collage Background -->
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
    <div class="overlay"></div>
</div>

<!-- Header -->
<header class="header">
    <div class="container d-flex align-items-center py-2 ">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="header-logo">
        <div  >
            <h1 class="header-title">Schools Division Office</h1>
            <h2 class="header-subtitle">San Carlos City</h2>
        </div>
    </div>
</header>

<!-- Registration Form -->
<div class="container d-flex justify-content-center align-items-center mt-3 mb-3">
    <div class="card shadow-lg" style="width: 600px;">
        <!-- <h3 class="card-title text-center mb-4" style="font-size: 20px; padding: 10px; margin-top: 10px;">Register Office/Admin Account</h3>     -->
        <div class="card-body ">

            <!-- Left Column (Logo and Title) -->
           

            <!-- Right Column (Form Inputs) -->
           
                <form action="{{ route('accounts.store') }}" method="POST">
                    @csrf
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; gap: 10px; position: relative;">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="mb-3 mt-3" style="width: 120px;">
    
    <!-- Use user.svg from the public directory, positioned at the bottom-right of the logo -->
    <img src="{{ asset('activate.svg') }}" alt="User Icon" width="40" height="40" style="position: absolute; bottom: 0; right: 0;">
</div>

                    <div class="mb-3">
                        <label for="main_office_id" class="form-label">Main Office ID</label>
                        <input type="text" class="form-control" id="main_office_id" name="main_office_id" >
                    </div>

                    <div class="mb-3">
                        <label for="passcode" class="form-label">6-Digit Passcode</label>
                        <input type="password" class="form-control" id="passcode" name="passcode"  placeholder="Please enter exactly 6 digits."  minlength="6" maxlength="6" pattern="\d{6}">
                    </div>

                   

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                    <a href="{{ url('Login') }}" style="text-align:center; font-size: 16px; color:rgb(105, 116, 127); text-decoration: none;   ">
    Done activating your accounts? <b>Login Now</b>
</a>
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
