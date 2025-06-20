@extends('layout.general_layout')

<title>@yield('title','Reports')</title>
@section('content')

<div class="wrapper">
    <div class="content">
        @if($total_responses !=0)
        <style>
            .container {
                max-width: 1200px;
                margin: 0 auto;
                background-color: white;
                padding: 20px;
                color: #333;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            h1 {
                text-align: center;
                color: #333;
                margin-bottom: 30px;
            }
            
            .table-container {
                overflow-x: auto;
                margin-bottom: 20px;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 14px;
                color: #333;
            }
            
            th, td {
                border: 1px solid #333;
                padding: 10px;
                text-align: center;
                vertical-align: middle;
            }
            
            th {
                background-color: #7B9BD1;
                color: white;
                font-size: 13px;
                font-weight: bold;
            }
            
            td:first-child {
                background-color: #7B9BD1;
                color: white;
                font-weight: bold;
                text-align: left;
                padding-left: 15px;
            }
            
            .loading {
                text-align: center;
                padding: 20px;
                color: #666;
            }
            
            .error {
                color: #d32f2f;
                background-color: #ffebee;
                padding: 10px;
                border-radius: 4px;
                margin: 10px 0;
            }
            
            .refresh-btn {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                margin-bottom: 20px;
            }
            
            .refresh-btn:hover {
                background-color: #45a049;
            }
            
            .last-updated {
                text-align: center;
                color: #666;
                font-size: 12px;
                margin-top: 10px;
            }

            /* Print Button Styles */
            .print-button {
                position: fixed;
                bottom: 30px;
                right: 30px;
                background-color: #2196F3;
                color: white;
                border: none;
                border-radius: 50px;
                padding: 15px 20px;
                font-size: 16px;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
                transition: all 0.3s ease;
                z-index: 1000;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .print-button:hover {
                background-color: #1976D2;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(33, 150, 243, 0.4);
            }

            .print-icon {
                width: 20px;
                height: 20px;
            }

            /* Print Styles */
            @media print {
                /* Hide everything first */
                body * {
                    visibility: hidden;
                }
                
                /* Show only printable content */
                .printable-area,
                .printable-area * {
                    visibility: visible !important;
                }
                
                .printable-area {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
                
                /* Hide print button */
                .print-button {
                    display: none !important;
                }
                
                .container {
                    box-shadow: none;
                    border-radius: 0;
                    max-width: none;
                    margin: 0;
                    padding: 15px;
                    background-color: white !important;
                }
                
                table {
                    font-size: 11px;
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                    color: #333 !important;
                    visibility: visible !important;
                    display: table !important;
                }
                
                th, td {
                    padding: 6px;
                    border: 1px solid #333 !important;
                    text-align: center;
                    vertical-align: middle;
                }
                
                th {
                    background-color: #7B9BD1 !important;
                    color: white !important;
                    font-weight: bold;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                
                td:first-child {
                    background-color: #7B9BD1 !important;
                    color: white !important;
                    font-weight: bold;
                    text-align: left;
                    padding-left: 10px;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                
                .table-container {
                    overflow: visible;
                }
                
                h1, h2 {
                    font-size: 16px;
                    margin-bottom: 15px;
                    color: #333 !important;
                }
                
                .description {
                    font-size: 11px;
                    margin-bottom: 15px;
                    color: #333 !important;
                }
                
                .last-updated {
                    font-size: 10px;
                    color: #666 !important;
                }
                
                /* Optional page breaks - only if content is too long */
                .page-break {
                    page-break-before: auto;
                    margin-top: 30px;
                }
                
                /* Prevent page breaks inside tables */
                table {
                    page-break-inside: avoid;
                }
                
                tr {
                    page-break-inside: avoid;
                }
                
                /* Hide loading and error states in print */
                .loading, .error {
                    display: none !important;
                }
                
                /* Ensure all table rows are visible */
                tbody, tbody tr, thead, thead tr {
                    visibility: visible !important;
                    display: table-row-group !important;
                }
                
                tbody tr, thead tr {
                    display: table-row !important;
                }
                
                /* Make sure second table specifically is visible */
                #rating-table,
                #rating-table *,
                #table-body,
                #table-body * {
                    visibility: visible !important;
                    display: revert !important;
                }
                
                /* Ensure table structure is maintained */
                #rating-table thead,
                #rating-table tbody {
                    display: table-header-group !important;
                }
                
                #rating-table tbody {
                    display: table-row-group !important;
                }
            }
        </style>@php
    $month = date('n');
    $year = date('Y');
    $quarter = ceil($month / 3);
    $isDark = session('mode') === 'dark';
@endphp

<div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="dropdown">
            <button 
                class="btn btn-link dropdown-toggle fw-bold fs-3 text-decoration-none" 
                type="button" 
                id="reportsDropdown" 
                data-bs-toggle="dropdown" 
                aria-expanded="false"
                style="color: <?= $isDark ? '#fff' : '#333' ?>;"
            >
                Reports <i class="bi bi-chevron-down"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                <li><a class="dropdown-item" style="color:#333" href="{{asset(url('reports_view'))}}">Back</a></li>
            </ul>
        </div>
        <h4 class="text" style="color: <?= $isDark ? '#fff' : '#333' ?>;">
            Q{{ $quarter }} {{ $year }}
        </h4>
    </div>
</div>


        <!-- Print Button -->
        <button class="print-button" onclick="printReport()">
            <svg class="print-icon" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"></path>
            </svg>
            Print
        </button>

        <!-- Printable Area Start -->
        <div class="printable-area">
            <div class="container">
                <h2>Table 1: Overall Satisfaction Tally and Score</h2>
                
                <div id="error-container"></div>
                
                <div class="table-container">
                    <table id="satisfaction-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Strongly<br>Agree</th>
                                <th>Agree</th>
                                <th>Neither<br>Agree nor<br>Disagree</th>
                                <th>Disagree</th>
                                <th>Strongly<br>Disagree</th>
                                <th>NA</th>
                                <th>Total<br>Responses</th>
                                <th>Overall<br>(Ave.)</th>
                                <th>Overall<br>(Per.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="external-row">
                                <td>SQD0: Overall<br>Satisfaction<br>(External)</td>
                                <td class="loading" colspan="9">Loading...</td>
                            </tr>
                            <tr id="internal-row">
                                <td>SQD0: Overall<br>Satisfaction<br>(Internal)</td>
                                <td class="loading" colspan="9">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="last-updated" id="last-updated"></div>
            </div>
<br>
            <div class="container page-break">
             @php
    $now = \Carbon\Carbon::now();
    $year = $now->year;
    $month = $now->month;
    $quarter = ceil($month / 3);

    $startMonth = (($quarter - 1) * 3) + 1;
    $endMonth = $startMonth + 2;

    $startDate = \Carbon\Carbon::create($year, $startMonth)->format('F');
    $endDate = \Carbon\Carbon::create($year, $endMonth)->format('F');

    $quarterLabel = "Q$quarter $year ($startDate – $endDate)";
@endphp

<h2>Table 2: Overall Customer Rating for {{ $quarterLabel }}</h2>

                
                <div class="description">
                    Weighted average was used to get the overall score per Service Quality Dimension with the number of respondents as weights. For this quarter, PNR1 got an overall rating (external and internal) of <span id="overall-score">loading...</span> which corresponds to a <strong id="overall-rating">loading...</strong> rating.
                </div>
                
                <div class="table-container">
                    <table id="rating-table">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th>Responsiveness</th>
                                <th>Reliability<br>(Quality)</th>
                                <th>Access &<br>Facilities</th>
                                <th style="width: 30px;">Communication</th>
                                <th>Costs</th>
                                <th>Integrity</th>
                                <th>Assurance</th>
                                <th>Outcome</th>
                                <th>Score</th>
                                <th>Remarks</th>
                                <th>No. of<br>Respondents</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <tr class="loading">
                                <td colspan="11">Loading data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Printable Area End -->

        <script>
            const BASE_URL = '/service-overall-satisfaction';
            
            async function fetchSatisfactionData(serviceType) {
                try {
                    const response = await fetch(`${BASE_URL}/${serviceType}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const data = await response.json();
                    return data;
                } catch (error) {
                    console.error(`Error fetching ${serviceType} data:`, error);
                    throw error;
                }
            }

            function calculateLeftBlank(data) {
                const totalCategorized = data['Strongly Agree'] + 
                                       data['Agree'] + 
                                       data['Neither Agree nor Disagree'] + 
                                       data['Disagree'] + 
                                       data['Strongly Disagree'] + 
                                       data['NA'];
                return data['Total Responses'] - totalCategorized;
            }

            function populateRow(rowId, data) {
                const row = document.getElementById(rowId);
                
                row.innerHTML = `
                    <td>SQD0: Overall<br>Satisfaction<br>(${rowId === 'external-row' ? 'External' : 'Internal'})</td>
                    <td>${data['Strongly Agree']}</td>
                    <td>${data['Agree']}</td>
                    <td>${data['Neither Agree nor Disagree']}</td>
                    <td>${data['Disagree']}</td>
                    <td>${data['Strongly Disagree']}</td>
                    <td>${data['NA']}</td>
                    <td>${data['Total Responses']}</td>
                    <td>${data['Overall (Ave.)']}</td>
                    <td>${data['Overall (Per.)']}</td>
                `;
            }

            function showError(message) {
                const errorContainer = document.getElementById('error-container');
                errorContainer.innerHTML = `<div class="error">Error: ${message}</div>`;
            }

            function clearError() {
                const errorContainer = document.getElementById('error-container');
                errorContainer.innerHTML = '';
            }

            function updateLastUpdated() {
                const now = new Date();
                const timeString = now.toLocaleString();
                document.getElementById('last-updated').textContent = `Last updated: ${timeString}`;
            }

            async function loadData() {
                clearError();
                
                document.getElementById('external-row').innerHTML = `
                    <td>SQD0: Overall<br>Satisfaction<br>(External)</td>
                    <td class="loading" colspan="9">Loading...</td>
                `;
                document.getElementById('internal-row').innerHTML = `
                    <td>SQD0: Overall<br>Satisfaction<br>(Internal)</td>
                    <td class="loading" colspan="9">Loading...</td>
                `;

                try {
                    const [externalData, internalData] = await Promise.all([
                        fetchSatisfactionData('external'),
                        fetchSatisfactionData('internal')
                    ]);

                    populateRow('external-row', externalData);
                    populateRow('internal-row', internalData);
                    
                    updateLastUpdated();
                    
                } catch (error) {
                    showError(`Failed to load satisfaction data. Please check if the server is running and try again. Details: ${error.message}`);
                    
                    document.getElementById('external-row').innerHTML = `
                        <td>SQD0: Overall<br>Satisfaction<br>(External)</td>
                        <td class="error" colspan="9">Failed to load</td>
                    `;
                    document.getElementById('internal-row').innerHTML = `
                        <td>SQD0: Overall<br>Satisfaction<br>(Internal)</td>
                        <td class="error" colspan="9">Failed to load</td>
                    `;
                }
            }

            document.addEventListener('DOMContentLoaded', loadData);
            setInterval(loadData, 5 * 60 * 1000);
        </script>

        <script>
            // Configuration
           
            
            let externalData = null;
            let internalData = null;
            let isLoading = false;
            
            async function fetchServiceData(serviceType) {
                try {
                    const response = await fetch(`/service-weighted_average/${serviceType}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const data = await response.json();
                    return data.weighted_averages;
                } catch (error) {
                    console.error(`Error fetching ${serviceType} data:`, error);
                    throw error;
                }
            }
            
            async function loadWeightedData(type) {
                if (isLoading) return;
                
                isLoading = true;
                showWeightedLoading();
                
                try {
                    if (type === 'external' || type === 'both') {
                        if (!externalData) {
                            externalData = await fetchServiceData('external');
                        }
                    }
                    
                    if (type === 'internal' || type === 'both') {
                        if (!internalData) {
                            internalData = await fetchServiceData('internal');
                        }
                    }
                    
                    renderWeightedTable(type);
                    updateOverallInfo();
                    
                } catch (error) {
                    showWeightedError('Failed to load data. Please try again.');
                } finally {
                    isLoading = false;
                }
            }
            
            function renderWeightedTable(type) {
                const tbody = document.getElementById('table-body');
                let html = '';
                
                if (type === 'external' && externalData) {
                    html += generateTableRow('External', externalData);
                } else if (type === 'internal' && internalData) {
                    html += generateTableRow('Internal', internalData);
                } else if (type === 'both' && externalData && internalData) {
                    html += generateTableRow('External', externalData);
                    html += generateTableRow('Internal', internalData);
                    
                    const overall = calculateOverallAverages();
                    html += generateTableRow('Overall', overall, true);
                }
                
                tbody.innerHTML = html;
            }
            
            function generateTableRow(label, data, isOverall = false) {
                const rowClass = isOverall ? 'overall-row' : 'service-type';
                return `
                    <tr class="${rowClass}">
                        <td>${label}</td>
                        <td>${data.Responsiveness}</td>
                        <td>${data.Reliability}</td>
                        <td>${data.Access_Facilities}</td>
                        <td >${data.Communication}</td>
                        <td>${data.Costs}</td>
                        <td>${data.Integrity}</td>
                        <td>${data.Assurance}</td>
                        <td>${data.Outcome}</td>
                        <td>${data.Overall_Score}</td>
                        <td>${data.Rating}</td>
                        <td>${data.Total_Respondents}</td>
                    </tr>
                `;
            }
            
            function calculateOverallAverages() {
                if (!externalData || !internalData) return null;
                
                const totalRespondents = externalData.Total_Respondents + internalData.Total_Respondents;
                const extWeight = externalData.Total_Respondents / totalRespondents;
                const intWeight = internalData.Total_Respondents / totalRespondents;
                
                const overall = {
                    Responsiveness: ((externalData.Responsiveness * extWeight) + (internalData.Responsiveness * intWeight)).toFixed(2),
                    Reliability: ((externalData.Reliability * extWeight) + (internalData.Reliability * intWeight)).toFixed(2),
                    Access_Facilities: ((externalData.Access_Facilities * extWeight) + (internalData.Access_Facilities * intWeight)).toFixed(2),
                    Communication: ((externalData.Communication * extWeight) + (internalData.Communication * intWeight)).toFixed(2),
                    Costs: ((externalData.Costs * extWeight) + (internalData.Costs * intWeight)).toFixed(2),
                    Integrity: ((externalData.Integrity * extWeight) + (internalData.Integrity * intWeight)).toFixed(2),
                    Assurance: ((externalData.Assurance * extWeight) + (internalData.Assurance * intWeight)).toFixed(2),
                    Outcome: ((externalData.Outcome * extWeight) + (internalData.Outcome * intWeight)).toFixed(2),
                    Overall_Score: ((externalData.Overall_Score * extWeight) + (internalData.Overall_Score * intWeight)).toFixed(2),
                    Total_Respondents: totalRespondents
                };
                
                const score = parseFloat(overall.Overall_Score);
                if (score >= 4.5) {
                    overall.Rating = 'VS';
                } else if (score >= 3.5) {
                    overall.Rating = 'S';
                } else {
                    overall.Rating = 'U';
                }
                
                return overall;
            }
            
            function updateOverallInfo() {
                if (externalData && internalData) {
                    const overall = calculateOverallAverages();
                    document.getElementById('overall-score').textContent = overall.Overall_Score;
                    document.getElementById('overall-rating').textContent = getRatingText(overall.Rating);
                }
            }
            
            function getRatingText(rating) {
                switch(rating) {
                    case 'VS': return 'Very Satisfactory';
                    case 'S': return 'Satisfactory';
                    case 'U': return 'Unsatisfactory';
                    default: return rating;
                }
            }
            
            function showWeightedLoading() {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = '<tr class="loading"><td colspan="11">Loading data...</td></tr>';
            }
            
            function showWeightedError(message) {
                const tbody = document.getElementById('table-body');
                tbody.innerHTML = `<tr><td colspan="11" class="error">${message}</td></tr>`;
            }
            
            document.addEventListener('DOMContentLoaded', function() {
                loadWeightedData('both');
            });

            // Custom print function to ensure data is loaded
            function printReport() {
                // Check if data is loaded for both tables
                const satisfactionTable = document.getElementById('satisfaction-table');
                const ratingTable = document.getElementById('rating-table');
                const tableBody = document.getElementById('table-body');
                
                const satisfactionLoaded = satisfactionTable && !satisfactionTable.querySelector('.loading');
                const ratingLoaded = tableBody && !tableBody.querySelector('.loading') && !tableBody.innerHTML.includes('Loading data...');
                
                if (!satisfactionLoaded || !ratingLoaded) {
                    alert('Please wait for all data to load completely before printing.');
                    return;
                }
                
                // Small delay to ensure everything is rendered
                setTimeout(() => {
                    window.print();
                }, 100);
            }
        </script>

        @else
        <div class="alert alert-light border text-center p-4 mx-auto mt-3" role="alert" style="max-width: 100%;">
            <div class="mb-3">
                <img class="svg" src="{{ asset('not-found.svg') }}" alt="SVG Image" style="width:70px">
            </div>
            <h5 class="mb-2 text-secondary">No Data Found</h5>
            @php
            $month = now()->month;
            $quarter = ceil($month / 3);
            @endphp
            <p class="mb-0 text-muted">Cannot view report without data. No responses were recorded for Q{{ $quarter }} {{ now()->year }}.</p>
        </div>
        @endif
    </div>
</div>

@endsection