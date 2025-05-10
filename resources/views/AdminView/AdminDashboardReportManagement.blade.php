@extends('layout.general_layout')

<title>@yield('title','Admin Reports')</title>
 @yield('sidebar')
  @show
@section('content') 
<!-- <div class="wrapper">
<div class="content" >
        <h2 class="text-center">Quarterly Customer Satisfaction Report</h2>
        
        <label for="quarterFilter" class="form-label">Select Quarter:</label>
        <select id="quarterFilter" class="form-select" onchange="filterQuarter()">
            <option value="All">All</option>
            <option value="Q1">Q1</option>
            <option value="Q2">Q2</option>
            <option value="Q3">Q3</option>
            <option value="Q4">Q4</option>
        </select>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Quarter</th>
                    <th>Responsiveness</th>
                    <th>Reliability</th>
                    <th>Access & Facilities</th>
                    <th>Communication</th>
                    <th>Costs</th>
                    <th>Integrity</th>
                    <th>Assurance</th>
                    <th>Outcome</th>
                    <th>Average Score</th>
                </tr>
            </thead>
            <tbody id="reportTable">
                <!-- Data will be inserted dynamically -->
            </tbody>
        </table>

        <canvas id="satisfactionChart"></canvas>
    
</div></div> -->

    <script>
        const data = [
            { quarter: "Q1", responsiveness: 4.2, reliability: 4.0, access: 4.1, communication: 4.3, costs: 4.0, integrity: 4.2, assurance: 4.1, outcome: 4.3 },
            { quarter: "Q2", responsiveness: 4.0, reliability: 4.1, access: 4.2, communication: 4.0, costs: 3.9, integrity: 4.1, assurance: 4.0, outcome: 4.2 },
            { quarter: "Q3", responsiveness: 4.3, reliability: 4.2, access: 4.1, communication: 4.3, costs: 4.0, integrity: 4.2, assurance: 4.1, outcome: 4.4 },
            { quarter: "Q4", responsiveness: 4.1, reliability: 4.0, access: 4.2, communication: 4.1, costs: 4.0, integrity: 4.1, assurance: 4.0, outcome: 4.2 }
        ];
        
        function loadTable(filter) {
            const tableBody = document.getElementById("reportTable");
            tableBody.innerHTML = "";
            
            data.forEach(row => {
                if (filter === "All" || row.quarter === filter) {
                    const avg = ((row.responsiveness + row.reliability + row.access + row.communication + row.costs + row.integrity + row.assurance + row.outcome) / 8).toFixed(2);
                    tableBody.innerHTML += `
                        <tr>
                            <td>${row.quarter}</td>
                            <td>${row.responsiveness}</td>
                            <td>${row.reliability}</td>
                            <td>${row.access}</td>
                            <td>${row.communication}</td>
                            <td>${row.costs}</td>
                            <td>${row.integrity}</td>
                            <td>${row.assurance}</td>
                            <td>${row.outcome}</td>
                            <td><strong>${avg}</strong></td>
                        </tr>
                    `;
                }
            });
        }
        
        function filterQuarter() {
            const selectedQuarter = document.getElementById("quarterFilter").value;
            loadTable(selectedQuarter);
            updateChart(selectedQuarter);
        }

        function updateChart(filter) {
            const labels = [];
            const averages = [];

            data.forEach(row => {
                if (filter === "All" || row.quarter === filter) {
                    labels.push(row.quarter);
                    const avg = ((row.responsiveness + row.reliability + row.access + row.communication + row.costs + row.integrity + row.assurance + row.outcome) / 8).toFixed(2);
                    averages.push(avg);
                }
            });

            chart.data.labels = labels;
            chart.data.datasets[0].data = averages;
            chart.update();
        }

        // Initialize the table and chart
        loadTable("All");
        
        const ctx = document.getElementById("satisfactionChart").getContext("2d");
        const chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: data.map(row => row.quarter),
                datasets: [{
                    label: "Average Satisfaction Score",
                    data: data.map(row => ((row.responsiveness + row.reliability + row.access + row.communication + row.costs + row.integrity + row.assurance + row.outcome) / 8).toFixed(2)),
                    borderColor: "blue",
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    </script>
 
@endsection