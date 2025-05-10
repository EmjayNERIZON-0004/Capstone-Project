<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Measurement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
    @include('layout.survey_header')
   <style>
        
        .form-section {
            padding: 20px;
        }
        .form-check-input:checked {
            background-color: rgb(4, 59, 125);
            border-color: rgb(4, 59, 125);
        }
        .btn-primary {
            background-color: rgb(4, 59, 125);
            border: none;
        }
        .btn-primary:hover {
            background-color: rgb(63, 63, 63);
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-center align-items-center flex-wrap text-center" style="border: none; padding-top:20px">
            <!-- Left Logo -->
            <img src="{{ asset('logo.png') }}" alt="Left Logo" class="logo"  >

            <!-- Centered Text -->
            <div>
                <h4 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; " class="header-text">
                    <b>SDO SAN CARLOS CITY PANGASINAN - R1</b>
                </h4>
                <h4>Client Satisfaction Measurement (CSM)</h4>
            </div>
        </div>

        <p style="background: rgb(4, 59, 125); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:14px; padding:25px; color:white">
            The Client Satisfaction (CSM) tracks the customer experience of government offices. Your feedback on your recently concluded transaction will help this office provide better service. Personal information shared will be kept confidential, and you always have the option to not answer this form.
        </p>
         
        <div class="form-section">
            <form action="{{ route('verifyTransaction') }}" method="POST">
            
            @csrf
            <h5 class="mb-3">Client Information</h5>

                <!-- Transaction Number -->
                <div class="mb-3">
                    <div class="p-3 rounded" style="background-color: #eef5f7; margin-bottom:10px">
                        <div class="d-flex align-items-center">
                            <div class="text-white fw-bold me-2 text-center" style="background-color: rgb(4, 59, 125); width:25px; height:25px; padding:0px">?</div>
                            <label class="m-0">Transaction Number<span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <input style="border-bottom: 2px solid rgb(4, 59, 125);" name="transaction_number" type="text" class="form-control" placeholder="Enter Transaction Number" required value="{{ session('transaction_number', '') }}">
                </div>

                <!-- Age Field -->
                
              

                <!-- Customer Type Field -->
                

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="submit" class="btn text-white px-4" style="background-color: rgb(4, 59, 125);">Next</button>
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
    <span class="progress-text">Page 1 of 9</span>
    <div class="progress">
        <div class="progress-bar" style="width: 11%;"></div> <!-- Adjust width dynamically -->
    </div>
</div>

                </div><p class="mt-2 text-muted small" style="margin-left: 20px;">
    Satisfied with our survey form?  <a href="#" class="text-primary">Rate Us</a>
</p>
            </form>
            
        </div>
         
    </div>






</div>
 
<!-- Error Modal -->
@if(session('error'))
    <!-- Custom Modal -->
    <div id="customModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h4>The Transaction Number is not Identified</h4>
                 
            </div>
            <div class="modal-body">
                <p>{{ session('error') }}</p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
