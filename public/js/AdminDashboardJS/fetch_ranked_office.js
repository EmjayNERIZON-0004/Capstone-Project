
function fetchRankedOffices() {
    const now = new Date();

    // Get the current year
    const currentYear = now.getFullYear();
    
    // Get the current quarter (1 to 4)
    const currentQuarter = Math.floor(now.getMonth() / 3) + 1;
 
    fetch(`/Admin/api/ranked-offices/${currentQuarter}/${currentYear}`)

        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Fetched data:", data); // Debugging

            // Ensure the data format is correct
            if (!data || !data.rankedOffices) {
                throw new Error("Invalid data format received");
            }

            // Update total offices
            
            document.getElementById("totalOffices").textContent = (data.totalOffices || 0) ;
            // Update total survey responses
            document.getElementById("totalResponses").textContent = data.totalSurveyResponses || 0;

            // Load ranked offices into the table
            let tableBody = document.getElementById('offices-table');
            tableBody.innerHTML = ''; // Clear previous data

            data.rankedOffices.forEach((office, index) => {
                let scorePercentage = (office.overall_score * 100).toFixed(2);
                let analysis = getAnalysisForScore(office, scorePercentage);

                let row = `
                    <tr >
                        <td style="font-size:18px"><strong>${index + 1}</strong></td>
                        <td style="font-size:18px">${office.office_name}</td>
                        <td style="font-size:18px">${office.total_responses}</td>
                        <td style="font-size:18px" class="text-primary fw-bold">${scorePercentage}%</td>
                        <td style="font-size:18px" class="analysis-text">${analysis}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Error fetching ranked offices:', error);
            // alert("Failed to load office rankings. Check console for details.");
        });
}


function fetchAndUpdateChart() {
    const now = new Date();

    // Get the current year
    const currentYear = now.getFullYear();
    
    // Get the current quarter (1 to 4)
    const currentQuarter = Math.floor(now.getMonth() / 3) + 1;

    fetch(`/Admin/api/ranked-offices/${currentQuarter}/${currentYear}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (!data || !data.rankedOffices) {
                throw new Error("Invalid data format received");
            }

            // Update totals
            document.getElementById("totalOffices").textContent = data.totalOffices || 0;
            document.getElementById("totalResponses").textContent = data.totalSurveyResponses || 0;

            // Prepare chart data
            const officeNames = data.rankedOffices.map(office => office.office_name);
            const officeScores = data.rankedOffices.map(office => office.overall_score * 100);
            const backgroundColors = officeScores.map(score => getColorForScore(score));

             // Create or update the chart
            const ctx = document.getElementById('officeRankChart').getContext('2d');
            if (!officeChart) {
                officeChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: officeNames,
                        datasets: [{
                            label: 'Satisfaction Rate (%)',
                            data: officeScores,
                            backgroundColor: backgroundColors,
                            borderColor: backgroundColors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    stepSize: 20
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            } else {
                // Update chart data
                officeChart.data.labels = officeNames;
                officeChart.data.datasets[0].data = officeScores;
                officeChart.data.datasets[0].backgroundColor = backgroundColors;
                officeChart.data.datasets[0].borderColor = backgroundColors;
                officeChart.update();
            }

           // Load ranked offices into the table
        let tableBody = document.getElementById('offices-table');
        tableBody.innerHTML = ''; // Clear previous data

        data.rankedOffices.forEach((office, index) => {
            let scorePercentage = (office.overall_score * 100).toFixed(2);
            let analysis = getAnalysisForScore(office, scorePercentage);

            let row = `
                <tr>
                    <td><strong>${index + 1}</strong></td>
                    <td>${office.office_name}</td>
                    <td>${office.total_responses}</td>
                    <td class="text-primary fw-bold">${scorePercentage}%</td>
                    <td class="analysis-text">${analysis}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
       
            });
        })
        .catch(error => {
            console.error('Error fetching ranked offices:', error);
        });
}