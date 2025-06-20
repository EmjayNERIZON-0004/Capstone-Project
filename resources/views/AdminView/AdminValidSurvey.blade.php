@extends('layout.general_layout')
<title>@yield('title','Valid   Surveys')</title>

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">


  <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Valid Service Transacted Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
<div class="dashboard-container" style="  display: flex; flex-wrap: wrap;  justify-content: space-between;padding-bottom:10px">
        
     
  <!-- Total Responses Card -->
  <div class="dashboard-card " style="flex: 1 1 calc(20% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; align-items: center; justify-content: space-between;">
      
          <h2   class="card-number text-success">{{$valid}}</h2>
          
          <div class="bg-success" style="padding: 10px; border-radius: 50%;">
       <svg viewBox="0 0 24 24" 
       width="50" height="50"
       fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.5283 1.5999C11.7686 1.29437 12.2314 1.29437 12.4717 1.5999L14.2805 3.90051C14.4309 4.09173 14.6818 4.17325 14.9158 4.10693L17.7314 3.3089C18.1054 3.20292 18.4799 3.475 18.4946 3.86338L18.6057 6.78783C18.615 7.03089 18.77 7.24433 18.9984 7.32823L21.7453 8.33761C22.1101 8.47166 22.2532 8.91189 22.0368 9.23478L20.4078 11.666C20.2724 11.8681 20.2724 12.1319 20.4078 12.334L22.0368 14.7652C22.2532 15.0881 22.1101 15.5283 21.7453 15.6624L18.9984 16.6718C18.77 16.7557 18.615 16.9691 18.6057 17.2122L18.4946 20.1366C18.4799 20.525 18.1054 20.7971 17.7314 20.6911L14.9158 19.8931C14.6818 19.8267 14.4309 19.9083 14.2805 20.0995L12.4717 22.4001C12.2314 22.7056 11.7686 22.7056 11.5283 22.4001L9.71949 20.0995C9.56915 19.9083 9.31823 19.8267 9.08421 19.8931L6.26856 20.6911C5.89463 20.7971 5.52014 20.525 5.50539 20.1366L5.39427 17.2122C5.38503 16.9691 5.22996 16.7557 5.00164 16.6718L2.25467 15.6624C1.88986 15.5283 1.74682 15.0881 1.96317 14.7652L3.59221 12.334C3.72761 12.1319 3.72761 11.8681 3.59221 11.666L1.96317 9.23478C1.74682 8.91189 1.88986 8.47166 2.25467 8.33761L5.00165 7.32823C5.22996 7.24433 5.38503 7.03089 5.39427 6.78783L5.50539 3.86338C5.52014 3.475 5.89463 3.20292 6.26857 3.3089L9.08421 4.10693C9.31823 4.17325 9.56915 4.09173 9.71949 3.90051L11.5283 1.5999Z" stroke="#ffffff" stroke-width="1.272"></path> <path d="M9 12L11 14L15 10" stroke="#ffffff" stroke-width="1.272" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
</div>

</div>
<h5 class="card-title">Valid Services Responded</h5>
      <p class="card-subtext">Count of Real Service Rendered</p>
      
    </div>
  </div>







  <div class="dashboard-card " style="flex: 1 1 calc(20% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; align-items: center; justify-content: space-between;">
      
          <h2   class="card-number text-secondary">{{$others_count}}</h2>
          
          <div class="bg-secondary" style=" padding: 10px; border-radius: 50%;">
            <svg width="50" height="50" fill="#fff" viewBox="0 0 24 24">
    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 
             2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 
             10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 
             3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
  </svg>
</div>

</div>
<h5 class="card-title">Other Transaction</h5>
      <p class="card-subtext">Count of Other requests/inquiries</p>
      
    </div>
  </div>



  
  <div class="dashboard-card " style="flex: 1 1 calc(20% - 20px);">
    <div class="card-body" style="border: none;">
      <div style="display: flex; align-items: center; justify-content: space-between;">
      
          <h2   class="card-number text-primary">{{$total}}</h2>
          
<div style="background-color: #2196F3; padding: 10px; border-radius: 50%;">
<svg fill="#ffffff" 
width="50" height="50"
viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M 12.6952 4.6562 L 43.3280 4.6562 C 43.1874 2.6875 42.0624 1.6328 39.9062 1.6328 L 16.1171 1.6328 C 13.9609 1.6328 12.8358 2.6875 12.6952 4.6562 Z M 8.1015 11.1484 L 47.9454 11.1484 C 47.5936 9.0156 46.5625 7.8438 44.2187 7.8438 L 11.8046 7.8438 C 9.4609 7.8438 8.4531 9.0156 8.1015 11.1484 Z M 10.2343 54.3672 L 45.7888 54.3672 C 50.6641 54.3672 53.1251 51.9297 53.1251 47.1016 L 53.1251 22.2109 C 53.1251 17.3828 50.6641 14.9453 45.7888 14.9453 L 10.2343 14.9453 C 5.3358 14.9453 2.8749 17.3594 2.8749 22.2109 L 2.8749 47.1016 C 2.8749 51.9297 5.3358 54.3672 10.2343 54.3672 Z M 10.3046 50.5938 C 7.9609 50.5938 6.6484 49.3281 6.6484 46.8906 L 6.6484 22.3984 C 6.6484 19.9609 7.9609 18.7187 10.3046 18.7187 L 45.7187 18.7187 C 48.0390 18.7187 49.3513 19.9609 49.3513 22.3984 L 49.3513 46.8906 C 49.3513 49.3281 48.0390 50.5938 45.7187 50.5938 L 42.8124 50.5938 C 40.8905 46.2813 35.9218 41.5703 27.9765 41.5703 C 20.0546 41.5703 15.0624 46.2813 13.1640 50.5938 Z M 27.9765 38.3125 C 31.9374 38.3360 35.1249 34.7266 35.1249 30.4609 C 35.1249 26.2656 31.9374 22.8438 27.9765 22.8438 C 24.0155 22.8438 20.8280 26.2656 20.8280 30.4609 C 20.8515 34.7266 24.0155 38.2656 27.9765 38.3125 Z"></path></g></svg>
</div>



</div>
<h5 class="card-title">Overall Total as of {{$currentYear}}</h5>
      <p class="card-subtext">Total responses  collected</p>
      
    </div>
  </div>
</div>



<div class="text">Percentage of Valid Service Acquired</div>




<div class="card p-2 mt-2 mb-2">
<div class="mb-3">
    <!-- <label for="modeSelect">View Mode:</label> -->
    <select id="modeSelect" class="form-select" style="width: 200px;" onchange="loadChart()">
        <option value="quarterly">Quarterly</option>
        <option value="monthly">Monthly</option>
    </select>
</div>

<canvas id="validChart" style="height: 400px; max-height: 400px;"></canvas>


<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</div>
<script>
function loadChart() {
    const year = new Date().getFullYear(); // current year
    const mode = document.getElementById('modeSelect').value;
    const currentMonth = new Date().getMonth() + 1; // 1–12
    const currentQuarter = Math.ceil(currentMonth / 3); // 1–4

    fetch(`/Admin/valid-survey-analytics/${year}/${mode}`)
        .then(res => res.json())
        .then(data => {
            // Filter data to current month or quarter
            const filteredData = data.filter(item => {
                if (mode === 'monthly') {
                    const monthNames = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];
                    const monthIndex = monthNames.indexOf(item.label);
                    return monthIndex < currentMonth;
                } else {
                    const quarterNumber = parseInt(item.label.replace('Q', ''));
                    return quarterNumber <= currentQuarter;
                }
            });

            const labels = filteredData.map(item => item.label);
            const percentages = filteredData.map(item => item.percentage);

            // Destroy old chart if exists
            if (window.validChartInstance) {
                window.validChartInstance.destroy();
            }

            const ctx = document.getElementById('validChart').getContext('2d');
            window.validChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Valid Response %',
                        data: percentages,
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        tension: 0.3,
                        pointRadius: 5,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Percentage (%)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: mode === 'monthly' ? 'Month' : 'Quarter'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: context => context.raw + '%'
                            }
                        }
                    }
                }
            });
        });
}

// Auto-load on page load
document.addEventListener('DOMContentLoaded', () => {
    loadChart();
});
</script>



<br>
<div class="text">Percentage of Valid Services</div>

@php
    // Group valid responses by main_office > section
    $validGrouped = collect($valid_responses_list)
        ->groupBy('main_office')
        ->map(fn($group) =>
            $group->groupBy('office_transacted_with')->map(fn($s) => $s->count())
        );

    // Group total responses by main_office > section
    $totalGrouped = collect($responses)
        ->groupBy('main_office')
        ->map(fn($group) =>
            $group->groupBy('office_transacted_with')->map(fn($s) => $s->count())
        );
@endphp
<div class="card p-3 mt-2">
     <h3>Result</h3>
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Main Office</th>
            <th>Section</th>
            <th>  Valid  </th>
            <th>  Total  </th>
            <th>  %  </th>
        </tr>
    </thead>
    <tbody>
    @foreach($totalGrouped as $mainOffice => $sections)
    @php
        $mainOfficeRowspan = $sections->count();
        $mainOfficePrinted = false;

        $officeValidTotal = 0;
        $officeResponseTotal = 0;
    @endphp

    @foreach($sections as $section => $totalCount)
        @php
            $validCount = $validGrouped[$mainOffice][$section] ?? 0;
            $percent = $totalCount > 0 ? round(($validCount / $totalCount) * 100, 2) . '%' : '0%';

            $officeValidTotal += $validCount;
            $officeResponseTotal += $totalCount;
        @endphp
        <tr>
            @if (!$mainOfficePrinted)
                <td rowspan="{{ $mainOfficeRowspan + 1 }}">{{ $mainOffice }}</td> {{-- +1 for the total row --}}
                @php $mainOfficePrinted = true; @endphp
            @endif

            <td>{{ $section }}</td>
            <td style="background-color: rgba(40, 167, 69, 0.2);">{{ $validCount }}</td>
            <td>{{ $totalCount }}</td>
            <td>{{ $percent }}</td>
        </tr>
    @endforeach

    {{-- Totals row --}}
    @php
        $officePercent = $officeResponseTotal > 0
            ? round(($officeValidTotal / $officeResponseTotal) * 100, 2) . '%'
            : '0%';
    @endphp
    <tr class="fw-bold table-secondary">
        <td colspan="1" class="text-start">Overall by Office</td>
        <td>{{ $officeValidTotal }}</td>
        <td>{{ $officeResponseTotal }}</td>
        <td>{{ $officePercent }}</td>
    </tr>
@endforeach

    </tbody>
</table>
</div>

@php
    // Group the data: main_office > section > service, and sort services by count (desc)
    $grouped = collect($responses)
        ->groupBy('main_office')
        ->map(function ($mainGroup) {
            return $mainGroup->groupBy('office_transacted_with')->map(function ($sectionGroup) {
                return $sectionGroup
                    ->groupBy('service_availed')
                    ->map(fn($services) => $services->count())
                    ->sortByDesc(fn($count) => $count); // 🔥 sort here
            });
        });
@endphp

<div class="text  mt-5">List of Count of Services Survey Responses</div>
<div class="card p-3 mt-2"> 
    
<h3>Data Acquired</h3>
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Office</th>
            <th>Section</th>
            <th>Service</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grouped as $mainOffice => $sections)
            @php
                // Total number of rows under this main office
                $mainOfficeRowspan = $sections->flatten(2)->count();
                $mainOfficePrinted = false;
            @endphp

            @foreach($sections as $section => $services)
                @php
                    $sectionRowspan = $services->count();
                    $sectionPrinted = false;
                @endphp

                @foreach($services as $service => $count)
                    <tr>
                        @if (!$mainOfficePrinted)
                            <td rowspan="{{ $mainOfficeRowspan }}">{{ $mainOffice }}</td>
                            @php $mainOfficePrinted = true; @endphp
                        @endif

                        @if (!$sectionPrinted)
                            <td rowspan="{{ $sectionRowspan }}">{{ $section }}</td>
                            @php $sectionPrinted = true; @endphp
                        @endif

                      <td style="color: <?= $service == 'Other requests/inquiries' ? 'red' : '#333' ?>">
    {{ $service }}
</td>

     <td class="text-center  "
    style="background-color: <?= $service == 'Other requests/inquiries' ? 'rgba(220, 53, 70, 0.65);color:white' : 'white' ?>">
    {{ $count }}
</td>


                @endforeach

            @endforeach
        @endforeach
    </tbody>
</table>
</div>
@endsection