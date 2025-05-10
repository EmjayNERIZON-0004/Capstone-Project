<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">

    <title>Client Satisfaction Survey</title>
    <style>
        
        
        .option-box {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            background-color: white;
            font-weight: bold;
            margin: 5px; /* Add margin for spacing */
            flex: 1; /* Allow boxes to grow equally */
        }
        .option-container{
            width: 400px; 
        }
        /* .option-box:hover {
            background-color: #f1f1f1;
        } */
        input[type="radio"] {
            display: none; /* Hide radio buttons */
        }
        /* input[type="radio"]:checked + .option-box {
            background-color: rgb(4, 59, 125);
            color: white;
            border-color: rgb(4, 59, 125);
        } */

        /* Responsive Styling */
        @media (min-width: 768px) {
            .survey-table {
                display: table;
                width: 100%;
            }
            .survey-table th, .survey-table td {
                display: table-cell;
                text-align: center;
                padding: 12px;
            }
            
        }

        @media (max-width: 768px) {
            .survey-table {
                display: block; /* Change to block for mobile view */
            }
            .survey-table tr {
                display: flex;
                flex-direction: column;
                margin-bottom: 20px; /* Space between questions */
            }
            .survey-table td {
                display: block; /* Stack td elements */
                text-align: left; /* Align text to the left */
                width: 100%; /* Make the question column take full width */
            }
            .survey-table thead {
                display: none; /* Hide thead */
            }
            .option-container {
                display: flex; /* Use flexbox for horizontal alignment */
                justify-content: space-between; /* Space out the options */
                margin-top: 10px; /* Add some space above the options */
                
            }
        
        }

        @media (max-width: 600px) {
    /* Adjust table column widths */
    .survey-table td.title-td {
        width: 100%; /* More space for the question */
        word-wrap: break-word;
    }

    .survey-table td {
        width: 100%; /* Less space for options */
        padding: 3px; /* Compress padding */
        text-align: center; /* Center content */
    }

    /* Ensure option-container fits within the td */
    .option-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; /* Center the options */
        align-items: center;
 
        width: 100%; /* Ensure it fits the td */
    }
    
    /* Compress option boxes */
    .option-box {
        width:70%; /* Reduce width */
        height: 35px; /* Adjust height */
        line-height: 25px;
        text-align: center;
        font-size: 12px;
    }

    /* Floating modal adjustments */
    .floating-modal {
        width: 90%;
    }

    /* Make buttons more compact */
    .btnYN {
        width: 48%;
        padding: 5px;
    }
}

        .header-container {
    display: flex;
    justify-content: space-between; /* Distribute evenly */
    align-items: center; /* Align items in the center */
    flex-wrap: wrap; /* Allow wrapping for smaller screens */
    gap: 5px; /* Space between boxes */
    padding: 10px;
     border-radius: 8px;
}

.header-box {
    flex: 1; /* Distribute space equally */
    text-align: center;
    padding: 5px; 
    border-radius: 5px;
    font-size: 12px;
               box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);

    background-color: #eef5f7;
    min-width: 120px; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    
    /* Prevents text from squeezing */
}
/* Modal Styles */
/* Wrapper to position the modal above options */
.option-wrapper {
    position: relative;
    display: inline-block;
}/* Floating Modal */
.floating-modal {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* Ensures it fits within the div */
    background: rgba(255, 255, 255, 0.99); /* Slight transparency */
    border-radius: 8px;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
    text-align: center;
    z-index: 10;
}

/* Text inside modal */
.floating-modal p {
    margin: 5px 0;
    font-size: 14px;
}

/* Button group */
.button-group {
    display: flex;
    gap: 8px;
    margin-top: 0px;
}

/* Button Styling */
.btnYN {
    padding: 6px 12px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    height: 20px;
    padding: 0px;
    width: 50px;
    color:white;
}

 

.btn-secondary {
    background-color: #6c757d;
    color: white;
    height: 20px;
    padding: 0px;
    width: 50px;

}
.selected-5 { background-color:  #4CAF50;color:white } /* Green */
.selected-4 { background-color: #8BC34A;color:white } /* Light Green */
.selected-3 { background-color:  #FFC107;color: white;} /* Yellow */
.selected-2 { background-color:  #FF9800 ;color:white} /* Orange */
.selected-1 { background-color:  #F44336 ;color:white} /* Red */
.selected-na { background-color:  rgb(158, 158, 158) ;color:white} /* Gray */



    </style>
    @include('layout.survey_header')
</head>
<body>
    <div class="container">
        <div class="card" style="border:none">
        <div class="card-header d-flex justify-content-center align-items-center flex-wrap text-center" style="border: none;padding-top:20px">
    <!-- Left Logo -->
    @include('components.header')

   
</div>
            <div class="p-4">
            <style>
  /* .score-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100% ;
            height: 130px;
            border-radius: 10px;
            overflow: hidden;
            border: 3px solid #000;
            font-size: 30px;
            padding: 10px;
            background-color: #f0f0f0; 
        }

        .face {
            flex: 1;
            text-align: center;
            padding: 10px;
            font-size: 100px;
        } */
/* Responsive adjustments */
/* 📱 Mobile Screens (Small Width) */
.score-container {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    width: 100%;
    min-height: 160px;
    height: 160px;
    border-radius: 10px;
    overflow: hidden;
    font-size: 30px;
    padding: 5px;
    gap: 1px; /* Ensures only 1px spacing between child elements */
}

/* SVG styling */
.face svg {
    width: 147px;
    height: 147px; 
    border-radius: 50%;
    background-color: white;
             box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
             display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin: 0;
}

/* Color for each face */
.very-happy svg { color: #4CAF50; } /* Gold */
.happy svg { color: #8BC34A; } /* Yellow */
.neutral svg { color: #FFC107; } /* Gray */
.sad svg { color: #FF9800; } /* Orange */
.very-sad svg { color: #F44336; } /* Red */
 
 






 
@media (max-width: 480px) {
    .score-container {
        flex-direction: row;
        align-items: center;
         height: 60px; /* Adjust height */
        flex-wrap: nowrap; /* Prevent wrapping */
        min-height:60px;

    }

    .face svg {
        width: 80px; /* Even smaller */
        height: 80px;
         
    }
}

/* 📲 Tablet View (≤ 768px) */
@media (max-width: 768px) {
    .score-container {
        gap: 1px;
        min-height: 80px;
        height: 80px;
    }

  
    .face svg {
        width: 42px; /* Smaller than default */
        height: 42px;
    }
}

/* 🔎 Shrinks More at 400% Zoom */
 
/* Hover effect */
 

    </style> 
 

<script>
    function changeColor(element, color) {
    element.querySelector("svg").style.color = color;
}

</script>





<style>
  /* Default Text Size */
.sqd-title {
    font-size: 20px;
    text-align: center; 
        
        text-align: center;
        display: block; /* Ensures it spans full width */
        width: 100%;
}
.sqd-header{
        padding: 10px;
        border-radius: 10px;
        background-color: #eef5f7;
        color:black;
    }
/* 📱 Mobile View - Shrink Text */
@media (max-width: 600px) {
    .sqd-title {
        font-size: 16px; /* Smaller font */
        
        text-align: center;
        display: block; /* Ensures it spans full width */
        width: 100%;
    }
    .sqd-header{
        padding: 5px;
    }
}

</style>
            <div class="    sqd-header" style="margin-top:0px;margin-bottom:2px; ">
    <div class="d-flex align-items-center"  >
        <!-- <div class=" text-white   me-2 text-center" style="background-color:rgb(4, 59, 125);width:25px;height:25px;padding:0px">10</div> -->
        <label class="m-0 sqd-title" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;text-align:center "> Service Quality Dimension (SQD) </label>
    </div>
   
    </div>
     <div class="score-container " style="margin-bottom: 10px;">
    <div class="face very-happy">@include('components.svg.smile')</div>
    <div class="face happy">@include('components.svg.smile2')</div>
    <div class="face neutral">@include('components.svg.neutral')</div>
    <div class="face sad">@include('components.svg.sad2')</div>
    <div class="face very-sad">@include('components.svg.sad')</div>
</div>
                <form action="{{route('submitSQD')}}" method="POST">

                    @csrf <!-- CSRF Token for security -->
                         <input type="hidden" name="age" value="{{ session('age') }}">
            <input type="hidden" name="sex" value="{{ session('sex') }}">
            <input type="hidden" name="customerType" value="{{ session('customerType') }}">
            <input type="hidden" name="mainOffice" value="{{ session('mainOffice') }}">
            <input type="hidden" name="subOffice" value="{{ session('subOffice') }}">
       

              <input type="hidden" name="services_id" value="{{ session('services_id') }}">
              <input type="hidden" name="citizens_charter_awarenessQ" value="{{ session('citizens_charter_awarenessQ') }}">
              <input type="hidden" name="citizens_charter_sawQ" value="{{ session('citizens_charter_sawQ') }}">
              <input type="hidden" name="citizens_charter_usedQ" value="{{ session('citizens_charter_usedQ') }}">
            
              <style>
    .rating-table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
        margin-top: 10px;
    }
    .rating-table th, .rating-table td {
        border: 1px solid #ddd;
        padding: 10px;
        font-weight: bold;
    }
    </style>
              <!-- <table class="table-responsive table-bordered text-center ">
  
    <tr>
        <td style="width: 150px;">5 - Strongly Agree</td>
        <td style="width: 120px;">4 - Agree</td>
        <td style="width: 130px;">3 - Neutral</td>
        <td style="width: 130px;">2 - Disagree</td>
        <td style="width: 170px;">1 - Strongly Disagree</td>
        <td style="width: 170px;">N/A - Not Applicable</td>
    </tr>
</table> -->
                    <div class="table-responsive table-bordered">
                        <table class="table survey-table">
                            <thead>
                                <tr>
                              


                                    <th>SQD's</th>
                                    <th  >
           Remarks
        </th>
                                </tr>




                            </thead>
                            <tbody>
                                <tr>
                                <td class="title-td" style="text-align: left; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
  <b>SQD1</b> - I spent an acceptable amount of time to complete my transaction (Responsiveness)
  <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Makatwiran ang oras ang aking ginugol para sa pagproseso ng aking transaction.
</div>

</td>

                                    <td colspan="5">
                                        <div class="option-container" data-group="sqd1">
                                            <label><input type="radio" name="sqd1" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd1" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd1" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd1" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd1" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd1" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>SQD2</b> - The office accurately informed and followed the transaction’s requirements and steps (Reliability)
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Ang opisina ay sumusunod sa mga kinakailangan na dokumento at mga hakbang batay sa impormasyong ibinigay.
</div>

                                </td>
                                    <td>
                                        <div class="option-container" data-group="sqd2">
                                            <label><input type="radio" name="sqd2" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd2" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd2" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd2" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd2" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd2" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>SQD3</b> - My transaction (including steps and payment) was simple and convenient (Access and Facilities)
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Ang mga hakbang sa pagprosseso, kasama na ang pagbayad ay madali  at simple lamang.
</div>

                                </td>
                                    <td>
                                        <div class="option-container" idata-group="sqd3">
                                            <label><input type="radio" name="sqd3" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd3" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd3" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd3" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd3" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd3" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>SQD4</b> - I easily found information about my transaction from the office or its website (Communication)
                                
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Mabilis and madali akong nakahanap ng impormasyon tungkol sa aking transaksyon mula sa opisina o sa website nito.
</div>
</td>
                                    <td>
                                        <div class="option-container" data-group="sqd4">
                                            <label><input type="radio" name="sqd4" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd4" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd4" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd4" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd4" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd4" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>SQD5</b> - I paid an acceptable amount of fees for my transaction (Costs)
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
Nagbayad ako ng makatwirang halaga para sa aking transaksyon. (Kung ang serbisyo ay ibinigay ng libre maglagay ng tsek sa hanay ng N/A.)
</div>

                                
                                </td>
                                    <td>
                                          <!-- Open Modal Button --> 
                                      <!-- Payment Transaction Modal -->
<!-- Parent container for the question and options -->
<div class="option-wrapper">
    <!-- Floating Modal -->
  <!-- Floating Modal (Auto appears) -->
<div id="paymentModal" class="floating-modal">
    <p>Did you have a payment transaction?</p>
    <div class="button-group">
        <button type="button" class="btnYN btn-primary" style="background-color: rgb(4, 59, 125);" onclick="handlePayment(true)">Yes</button>
        <button type="button" class="btnYN btn-secondary" onclick="handlePayment(false)">No</button>
    </div>
</div>

 
    <!-- Question and Options -->
    <div class="option-container" data-group="sqd5">
        <label><input type="radio" name="sqd5" value="5"  ><div class="option-box">5</div></label>
        <label><input type="radio" name="sqd5" value="4"  ><div class="option-box">4</div></label>
        <label><input type="radio" name="sqd5" value="3"  ><div class="option-box">3</div></label>
        <label><input type="radio" name="sqd5" value="2"  ><div class="option-box">2</div></label>
        <label><input type="radio" name="sqd5" value="1"  ><div class="option-box">1</div></label>
        <label><input id="n/a" type="radio" name="sqd5" value="N/A" checked><div class="option-box">N/A</div></label>
    </div>

    <!-- Open Modal Button --> 
</div>
 
<script>window.onload = function() {
    document.getElementById("paymentModal").style.display = "flex";
};

function handlePayment(hasPayment) {
    let options = document.querySelectorAll('input[name="sqd5"]');
    let naOption = document.querySelector('input[name="sqd5"][value="N/A"]');
    let naBox = naOption.closest("label").querySelector(".option-box"); // Get the "N/A" box

    if (hasPayment === true) {
        options.forEach(option => {
            option.disabled = false;
        });

        // Remove the class when enabling all options
        if (naBox) naBox.classList.remove("selected-na");
    } else if (hasPayment === false) {
        options.forEach(option => {
            if (option.value !== "N/A") {
                option.disabled = true; // Disable all except "N/A"
            }
        });

        // Ensure "N/A" remains checked and gets the color
        setTimeout(() => {
            if (naOption) {
                naOption.checked = true;
                naOption.dispatchEvent(new Event("change")); // Trigger UI update

                // Add the class for gray color
                if (naBox) naBox.classList.add("selected-na");
            }
        }, 10);
    }

    // Close modal
    document.getElementById("paymentModal").style.display = "none";
}



function openModal() {
    if (!hasSelectedYes) {  // Only show modal if "Yes" has not been selected
        document.getElementById("paymentModal").style.display = "flex";
    }
}

// Attach event listener to all option buttons (1-5)
document.addEventListener("DOMContentLoaded", function () {
    let options = document.querySelectorAll('input[name="sqd5"]');
    
    options.forEach(option => {
        option.addEventListener("click", function () {
              openModal();
        });
    });

    // Show modal on page load
    document.getElementById("paymentModal").style.display = "flex";
});

 
</script>
<!-- 
let hasSelectedYes = false; // Track if the user selected "Yes"
let lastSelectedOption = null; // Track the last clicked option

function handlePayment(hasPayment) {
    let options = document.querySelectorAll('input[name="sqd5"]');

    if (hasPayment === true) {
        uncheckRadio();
        hasSelectedYes = true; // Stop showing the modal again
        if (lastSelectedOption) {
            lastSelectedOption.checked = true; // Select the last clicked option
        }
    } 
    else if (hasPayment === false) {
        hasSelectedYes = false; // Allow modal to show again when clicking options
        lastSelectedOption = null; // Reset last clicked option
        options.forEach(option => {
            if (option.value === "N/A") {
                option.checked = true; // Auto-select N/A
            }
        });
    }

    // Close modal
    document.getElementById("paymentModal").style.display = "none";
}

function openModal() {
    if (!hasSelectedYes) {  // Only show modal if "Yes" has not been selected
        document.getElementById("paymentModal").style.display = "flex";
    }
}

// Attach event listener to all option buttons (1-5)
document.addEventListener("DOMContentLoaded", function () {
    let options = document.querySelectorAll('input[name="sqd5"]');
    
    options.forEach(option => {
        option.addEventListener("click", function () {
            lastSelectedOption = this; // Store the last clicked option
            openModal();
        });
    });

    // Show modal on page load
    document.getElementById("paymentModal").style.display = "flex";
});


function uncheckRadio() {
    let checkedOption = document.querySelector('input[name="sqd5"]:checked');
    if (checkedOption) {
        checkedOption.checked = false; // Uncheck only the selected one
    }
}
</script> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>SQD6</b> - I am confident my transaction was secure (Integrity)
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Pakiramdam ko ay patas ang opisina    sa lahat, o "walang palakasan", sa aking transaksyon.
</div>

                                </td>
                                    <td>
                                        <div class="option-container"data-group="sqd6">
                                            <label><input type="radio" name="sqd6" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd6" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd6" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd6" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd6" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd6" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"> <b>SQD7</b> - The office's support was quick to respond (Assurance)
                                
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Magalang akong tinrato ng tauhan,at (kung sakali ako ay humingi ng tulong)alam ko na sila ay handang tumulong sa akin.
</div>
</td>
                                    <td>
                                        <div class="option-container" data-group="sqd7">
                                            <label><input type="radio" name="sqd7" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd7" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd7" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd7" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd7" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd7" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-td" style="text-align: left;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><b>SQD8</b> - I got what I needed from the government office (Outcome)
                                    <div class="text-muted" style="font-size: 1em; font-style: italic; font-family: 'Segoe UI', Arial, sans-serif;">
  Nakuha ko ang kinakailangan ko mula sa tanggapan ng gobyerno, kung tinaggihan man, ito ay sapat na ipaliwanag sa akin.
</div>

                                </td>
                                    <td>
                                        <div class="option-container" data-group="sqd8">
                                            <label><input type="radio" name="sqd8" value="5" required><div class="option-box">5</div></label>
                                            <label><input type="radio" name="sqd8" value="4"><div class="option-box">4</div></label>
                                            <label><input type="radio" name="sqd8" value="3"><div class="option-box">3</div></label>
                                            <label><input type="radio" name="sqd8" value="2"><div class="option-box">2</div></label>
                                            <label><input type="radio" name="sqd8" value="1"><div class="option-box">1</div></label>
                                            <label><input type="radio" name="sqd8" value="N/A"><div class="option-box">N/A</div></label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <script>
    document.querySelectorAll('.option-container').forEach(container => {
        container.addEventListener('change', function (e) {
            if (e.target.type === 'radio') {
                // Reset all option boxes in the same group
                let labels = this.querySelectorAll('label');
                labels.forEach(label => label.querySelector('.option-box').className = 'option-box');

                // Apply color to the selected option
                let selectedBox = e.target.closest('label').querySelector('.option-box');
                switch (e.target.value) {
                    case "5": selectedBox.classList.add('selected-5'); break;
                    case "4": selectedBox.classList.add('selected-4'); break;
                    case "3": selectedBox.classList.add('selected-3'); break;
                    case "2": selectedBox.classList.add('selected-2'); break;
                    case "1": selectedBox.classList.add('selected-1'); break;
                    case "N/A": selectedBox.classList.add('selected-na'); break;
                }
            }
        });
    });
</script>

                    <div class="mt-4 "  >



                    <div class=" sqd-header" style="   margin-bottom:10px">
    <div class="d-flex align-items-center"  >
        <!-- <div class=" text-white   me-2 text-center" style="background-color:rgb(4, 59, 125);width:25px;height:25px;padding:0px">10</div> -->
        <label class="m-0 sqd-title" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; "> Remarks </label>
    </div>

    </div>
    <!-- Dropdown for Selecting Type -->
<label for="remarksType" class="form-label">Select Type</label>
    <select class="form-select" id="remarksType"  name="remarksType" style="border-bottom:2px solid rgb(4, 59, 125);"  >
          <option value="" disabled selected>Choose...</option>   
          <option value="feedback">Feedback</option>
        <option value="complaint">Complaint</option>
        <option value="recommendation">Recommendation</option>
    </select>

    <!-- Example Suggestions (Hidden by Default) -->
    <div id="exampleTexts" class="mt-3 d-none">
        <label class="form-label">Comment Suggestions</label>
        <div id="examples" class="list-group"></div>
    </div>

    <!-- Textarea for Remarks -->
    <textarea class="form-control mt-3" id="remarksText" name="remarks" rows="4" placeholder="You can type manually..." style="border-bottom: 3px solid rgb(4, 59, 125);"></textarea>
</div>

<script>
    // Predefined Example Remarks
    const exampleRemarks = {
        feedback: ["Good Job!", "Will come back again.", "Very satisfied with the service.", "Excellent experience!"],
        complaint: ["Long waiting time.", "Unclear instructions.", "Staff was unhelpful.", "Service was not completed properly."],
        recommendation: ["Improve waiting area.", "Extend service hours.", "Provide better customer support.", "More payment options."]
    };

    const remarksType = document.getElementById("remarksType");
    const examplesDiv = document.getElementById("exampleTexts");
    const examplesList = document.getElementById("examples");
    const remarksText = document.getElementById("remarksText");

    remarksType.addEventListener("change", function() {
        const selectedType = this.value;
      remarksText.value = "";


        // Show Example Suggestions
        examplesDiv.classList.remove("d-none");
        examplesList.innerHTML = "";

        // Populate Example List
        exampleRemarks[selectedType].forEach(text => {
    const button = document.createElement("button");
    button.className = "btn btn-outline-secondary btn-sm mx-1 my-1"; // Small and subtle style
    button.style.borderRadius = "15px"; // Rounded for a tag-like appearance
    button.style.opacity = "0.8"; // Less emphasis
    button.style.cursor = "pointer"; // Indicate interactivity
    button.textContent = text;
    button.type = "button"; // Prevents the button from submitting the form
    button.onclick = () => remarksText.value = text;
    
    examplesList.appendChild(button);
});


    });
</script>


                    <br>
                    
                    <div class="d-flex justify-content-between align-items-center mt-4">
                     
                    <div class="d-flex align-items-center gap-2">
    <a href="javascript:history.back()" class="btn btn-outline-dark">
        <i class="fas fa-chevron-left"></i>
    </a>
    <button type="submit" class="btn btn-custom">Submit</button>
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
/* 📱 Mobile View - Move Progress Bar Below */
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
    <span class="progress-text">Page 6 of 6</span>
    <div class="progress">
        <div class="progress-bar" style="width: 100%;"></div> <!-- Adjust width dynamically -->
    </div>
</div>
                </div>
                </form>
            </div>
            @include('components.footer')
        </div>
    </div>
</body>
</html>