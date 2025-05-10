@extends('layout.layout_office')
<title>@yield('title','Office Name')</title>

<style>
    /* Base styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Responsive font size and table styling */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 12px;
        text-align: center;
    }
    
    @media (max-width: 992px) {
        table {
            font-size: 14px;
        }
        th, td {
            padding: 10px;
        }
    }
    
    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }
        th, td {
            padding: 8px;
        }
    }
    
    @media (max-width: 576px) {
        table {
            font-size: 11px;
        }
        th, td {
            padding: 6px 4px;
        }
        .header-title {
            font-size: 24px !important;
            height: 50px !important;
        }
    }
    
    /* SQD Cards */
    .sqd-card {
        padding: 15px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        font-weight: bold;
        color: white;
    }
    
    /* Header styling */
    .header-title {
        background-color: rgb(20, 160, 88);
        width: fit-content;
        height: 60px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        color: white;
        font-size: 30px;
        text-align: left;
        padding: 10px 20px;
        transform: translateY(-20px);
        border-radius: 5px;
        margin-right: auto;
        margin-left: 10px;
    }
    
    /* Filter container */
    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    
    @media (max-width: 576px) {
        .filter-group {
            min-width: 100%;
        }
    }
    
    /* Stats and SVG container */
    .stats-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .dropdowns {
        display: flex;
        flex-direction: column;
        gap: 15px;
        flex: 1;
        min-width: 250px;
    }
    
    .svg-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-left: auto;
    }
    
    .img_svg {
        width: 180px;
        height: auto;
        transition: all 0.3s ease;
    }
    
    .count-badge {
        background-color: #f8f9fa;
        padding: 8px 15px;
        border-radius: 20px;
        border: 1px solid #dee2e6;
        margin-top: 10px;
        font-size: 14px;
    }
    
    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
    
    .empty-state img {
        width: 100px;
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .svg-container {
            margin: 0 auto;
            transform: translateY(0);
        }
        
        .img_svg {
            width: 140px;
        }
    }
</style>

@section('content')
<div class="container pt-4 pb-5 p-0">
<div style="
    background-color: #ffffff;
    color: #212529;
    padding: 20px 28px;
    border-left: 4px solid #0d6efd;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    border-radius: 8px;
    margin: 16px 0;
">
    <div style="font-size: 26px; font-weight: 600; margin-bottom: 6px;">
        Survey Responses List
    </div>
    <div style="font-size: 15px; color: #6c757d;">
        All recorded customer survey submissions within the selected period (Quarterly)
    </div>
</div>

    <div class="card shadow-sm">
         

        <div class="card-body">
            <form id="surveyForm">
                <div class="filter-container">
                    <div class="filter-group">
                        <label for="year">Select Year</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">Select Year</option>
                            @foreach($years_cb as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="quarter">Select Quarter</label>
                        <select name="quarter" id="quarter" class="form-select">
                            <option value="">Select Quarter</option>
                            @foreach($quarter_cb as $quarter)
                                <option value="{{ $quarter }}" {{ request('quarter') == $quarter ? 'selected' : '' }}>
                                    Quarter {{ $quarter }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="getData()">Get Data</button>
                    </div>
                </div>
            </form>

            <div class="stats-container">
                <div class="dropdowns">
                    <div>
                        <label for="subOfficeFilter" class="form-label"><b>Filter by Section:</b></label>
                        <select id="subOfficeFilter" class="form-select">
                            <option value="all">All Offices</option>
                            @foreach ($subOffices as $subOffice)
                                <option value="{{ $subOffice }}">{{ $subOffice }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="serviceFilter" class="form-label"><b>Filter by Service:</b></label>
                        <select id="serviceFilter" class="form-select">
                            <option value="all">All Services</option>
                            <option value="Other requests/inquiries">Other requests/inquiries</option>
                        </select>
                    </div>
                </div>

                <div class="svg-container">
                    <!-- SVG replaced with a more modern data analytics illustration -->
                    <svg class="img_svg" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background -->
                        <rect x="50" y="80" width="400" height="300" rx="15" fill="#f0f4f8" />
                        
                        <!-- Document/paper -->
                        <rect x="100" y="130" width="300" height="220" rx="5" fill="#ffffff" stroke="#dde6ed" stroke-width="2" />
                        
                        <!-- Lines representing text -->
                        <line x1="130" y1="160" x2="370" y2="160" stroke="#b3cde0" stroke-width="8" stroke-linecap="round" />
                        <line x1="130" y1="190" x2="320" y2="190" stroke="#b3cde0" stroke-width="8" stroke-linecap="round" />
                        <line x1="130" y1="220" x2="370" y2="220" stroke="#b3cde0" stroke-width="8" stroke-linecap="round" />
                        <line x1="130" y1="250" x2="290" y2="250" stroke="#b3cde0" stroke-width="8" stroke-linecap="round" />
                        <line x1="130" y1="280" x2="370" y2="280" stroke="#b3cde0" stroke-width="8" stroke-linecap="round" />
                        <line x1="130" y1="310" x2="340" y2="310" stroke="#b3cde0" stroke-width="8" stroke-linecap="round" />
                        
                        <!-- Magnifying glass -->
                        <circle cx="320" cy="220" r="60" fill="none" stroke="#14a058" stroke-width="12" opacity="0.7" />
                        <line x1="360" y1="270" x2="400" y2="310" stroke="#14a058" stroke-width="12" stroke-linecap="round" />
                        
                        <!-- Check marks -->
                        <path d="M140,380 l20,20 l40,-40" stroke="#14a058" stroke-width="8" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M240,380 l20,20 l40,-40" stroke="#14a058" stroke-width="8" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M340,380 l20,20 l40,-40" stroke="#14a058" stroke-width="8" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    
                    <div class="count-badge">
                        Total Responses: <b><span id="countNumber">0</span></b>
                    </div>
                </div>
            </div>

            @if($responses_count != 0)
                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="surveyTable">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Office</th>
                                <th>Service Availed</th>
                                <th>SQD1</th>
                                <th>SQD2</th>
                                <th>SQD3</th>
                                <th>SQD4</th>
                                <th>SQD5</th>
                                <th>SQD6</th>
                                <th>SQD7</th>
                                <th>SQD8</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($responses as $response)
                                <tr class="response-row" data-office="{{ $response->office_transacted_with }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $response->office_transacted_with }}</td>
                                    <td>{{ $response->service_availed }}</td>

                                    @php
                                        $values = [
                                            $response->sqd1, $response->sqd2, $response->sqd3, 
                                            $response->sqd4, $response->sqd5, $response->sqd6, 
                                            $response->sqd7, $response->sqd8
                                        ];
                                        $numericValues = array_filter($values, fn($v) => is_numeric($v) && $v !== 'N/A');
                                    @endphp

                                    @foreach ($values as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <img src="{{ asset('not-found.svg') }}" alt="No data found">
                    <h5 class="mb-2 text-secondary">No Data Found</h5>
                    <p class="mb-0 text-muted">There were no recorded survey responses matching your selection.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
    // Function to get data based on selected quarter and year
    function getData() {
        var quarter = document.getElementById('quarter').value;
        var year = document.getElementById('year').value;

        if (quarter && year) {
            window.location.href = '/Office/SurveyList/' + quarter + '/' + year;
        } else {
            alert('Please select both a quarter and a year.');
        }
    }

    // DOM ready function
    document.addEventListener("DOMContentLoaded", function() {
        const subOfficeDropdown = document.getElementById("subOfficeFilter");
        const serviceDropdown = document.getElementById("serviceFilter");
        const rows = document.querySelectorAll(".response-row");
        const countNumber = document.getElementById("countNumber");

        // Function to update row count
        function updateRowCount() {
            const visibleRows = Array.from(rows).filter(row => row.style.display !== "none");
            countNumber.textContent = visibleRows.length;
        }

        // Office filter change event
        subOfficeDropdown.addEventListener("change", function() {
            const selectedOffice = this.value;

            // Reset service dropdown
            serviceDropdown.innerHTML = '<option value="all">All Services</option>';

            // Add "Other requests/inquiries" option
            const otherOption = document.createElement("option");
            otherOption.value = "Other requests/inquiries";
            otherOption.textContent = "Other requests/inquiries";
            serviceDropdown.appendChild(otherOption);

            // Fetch services for selected office
            if (selectedOffice !== "all") {
                fetch(`/get-services/${selectedOffice}`)
                    .then(response => response.json())
                    .then(services => {
                        services.forEach(service => {
                            const option = document.createElement("option");
                            option.value = service;
                            option.textContent = service;
                            serviceDropdown.appendChild(option);
                        });
                    });
            }

            // Filter table rows based on selected office
            rows.forEach(row => {
                const office = row.getAttribute("data-office");
                row.style.display = (selectedOffice === "all" || office === selectedOffice) ? "" : "none";
            });

            // Update row count
            updateRowCount();
        });

        // Service filter change event
        serviceDropdown.addEventListener("change", function() {
            const selectedService = this.value;
            const selectedOffice = subOfficeDropdown.value;

            // Handle "Other requests/inquiries" special case
            if (selectedService === "Other requests/inquiries") {
                rows.forEach(row => {
                    const office = row.getAttribute("data-office");
                    const service = row.children[2].textContent; // Assuming service is in the third column

                    if (office === selectedOffice || selectedOffice === "all") {
                        row.style.display = (service === "Other requests/inquiries") ? "" : "none";
                    } else {
                        row.style.display = "none";
                    }
                });
                updateRowCount();
                return;
            }

            // Regular service filtering
            rows.forEach(row => {
                const office = row.getAttribute("data-office");
                const service = row.children[2].textContent;

                if (office === selectedOffice || selectedOffice === "all") {
                    row.style.display = (selectedService === "all" || service === selectedService) ? "" : "none";
                } else {
                    row.style.display = "none";
                }
            });

            updateRowCount();
        });

        // Initialize row count on page load
        updateRowCount();
    });
</script>