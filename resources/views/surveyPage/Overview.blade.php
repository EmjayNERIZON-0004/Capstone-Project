<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Satisfaction Measurement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">

   <style>
      
       
       
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
    <div class="card-header d-flex justify-content-center align-items-center flex-wrap text-center"
     style="border: none;padding-top:20px">
    <!-- Left Logo -->
    
   
   @include('components.header')
</div>
<div class="container text-center" style="width: 80%; max-width: 800px; margin: 0 auto; padding: 2rem 0;">
    <h2 style="color: #333; margin-bottom: 1.5rem; font-weight: 500;">Important Information</h2>
    
    <p style="color: #555; line-height: 1.6; margin-bottom: 1.5rem; font-size: 1.05rem;">
        The Client Satisfaction Measurement (CSM) tracks the quality of service in government offices. Your feedback on your recent transaction will help us improve our services. All personal information shared will remain confidential, and participation in this survey is entirely voluntary.
    </p>
    
    <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
        <p style="color: #555; line-height: 1.6; margin-bottom: 1rem; font-size: 1.05rem; text-align: left;">
            Before proceeding, please note that:
        </p>
        <ul style="text-align: left; color: #555; line-height: 1.6;">
            <li style="margin-bottom: 0.5rem;">This survey collects no personal information and all responses are anonymous.</li>
            <li style="margin-bottom: 0.5rem;">Your feedback will be used solely for service improvement purposes.</li>
            <li style="margin-bottom: 0.5rem;">No personal identifiers will be linked to your responses.</li>
        </ul>
    </div>
    <?php
if (isset($_GET['qrcode'])) {
    echo '<button class="btn btn-primary" id="survey_value" style="padding: 0.6rem 2rem; font-size: 1rem; border-radius: 4px; background-color: #0d6efd; border: none;">Proceed to Survey from office</button>';
} else {
    echo '<button class="btn btn-primary" id="startSurveyBtn" style="padding: 0.6rem 2rem; font-size: 1rem; border-radius: 4px; background-color: #0d6efd; border: none;">Proceed to Survey</button>';
}
?>

<div style="margin-top: 1.5rem;">
    <p style="color: #777; font-size: 0.9rem;">
        By clicking "Proceed to Survey," you acknowledge that you understand how your feedback will be used.
    </p>
</div>

<script>
    const currentParams = window.location.search; // includes ? and all query params
    const targetUrlWithParams = `Page1${currentParams}`; // pass all query params to Page1

    const surveyValueBtn = document.getElementById('survey_value');
    const startSurveyBtn = document.getElementById('startSurveyBtn');

    if (surveyValueBtn) {
        surveyValueBtn.addEventListener('click', function () {
            window.location.href = targetUrlWithParams;
        });
    }

    if (startSurveyBtn) {
        startSurveyBtn.addEventListener('click', function () {
            window.location.href = 'Page1'; // Plain link for non-QR
        });
    }
</script>

 
 
 
</div>    
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

