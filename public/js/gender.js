// Define chart variables in global scope or appropriate scope
let ageSexChart = null;

function getGender(selectedQuarter, selectedYear) {
    fetch(`/get-quarter-data?quarter=${selectedQuarter}&year=${selectedYear}`)
        .then(res => res.json())
        .then(data => {  
            // Update interpretations
            document.getElementById('ageSexInterpretation').innerHTML = generateAgeSexInterpretation(data.ageSex);
            document.getElementById('customerTypeInterpretation').innerHTML = generateCustomerTypeInterpretation(data.customerTypes);
            
            // Handle Age-Sex Chart
            updateAgeSexChart(data.ageSex);
        });
}

// Move chart logic outside the fetch callback
function updateAgeSexChart(ageSexData) {
    // Destroy existing chart if it exists
    if (ageSexChart) {
        ageSexChart.destroy();
    }
    
    // Create new chart
    ageSexChart = new Chart(document.getElementById('ageSexChart'), {
        type: 'doughnut',
        data: {
            labels: ageSexData.map(item => item.sex),
            datasets: [{
                data: ageSexData.map(item => item.total),
                backgroundColor: ['#4e73df', '#e74a3b']
            }]
        },
        options: {
            cutout: '80%',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    
    // Update legend
    const ageSexLegend = document.getElementById('ageSexLegend');
    ageSexLegend.innerHTML = `
        <table style="border-collapse: collapse; width: 150px;">
            <tbody>
                ${ageSexData.map((item, index) => `
                    <tr>
                        <td style="padding: 6px;">
                            <div style="width: 12px; height: 12px; background-color: ${ageSexChart.data.datasets[0].backgroundColor[index]}; border-radius: 50%;"></div>
                        </td>
                        <td style="padding: 6px; word-wrap: break-word; max-width: 300px;">${item.sex}</td>
                        <td style="padding: 6px; text-align: right;">${item.total}</td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
}

// Define interpretation function outside if it's used elsewhere
function generateAgeSexInterpretation(data) {
    const total = data.reduce((sum, item) => sum + item.total, 0);
    const sorted = [...data].sort((a, b) => b.total - a.total);
    const dominant = sorted[0];
    const percentage = ((dominant.total / total) * 100).toFixed(1);

    return `
        <div class="p-3 rounded" style="background: #f8f9fc; border-left: 5px solid #4e73df;">
            <strong>Sex Insight:</strong><br>
            The majority of responses came from <strong>${dominant.sex}</strong>, 
            with <strong>${dominant.total}</strong> out of <strong>${total}</strong> responses 
            (<strong>${percentage}%</strong> of total). 
            This indicates a higher engagement from this group in the survey.
        </div>
    `;
}