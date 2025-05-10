// Define chart variable in a broader scope
let customerTypeChart = null;

function getCustomerData(selectedQuarter, selectedYear) {
    fetch(`/survey-analytics/data?quarter=${selectedQuarter}&year=${selectedYear}`)
        .then(res => res.json())
        .then(data => {  
            // Update the chart and legend
            updateCustomerTypeChart(data.customerTypes);
            
            // Update interpretation
            document.getElementById('customerTypeInterpretation').innerHTML = 
                generateCustomerTypeInterpretation(data.customerTypes);
        });
}

function updateCustomerTypeChart(customerTypesData) {
    // Destroy existing chart if it exists
    if (customerTypeChart) {
        customerTypeChart.destroy();
    }
    
    // Create new chart
    customerTypeChart = new Chart(document.getElementById('customerTypeChart'), {
        type: 'doughnut',
        data: {
            labels: customerTypesData.map(item => item.customerType),
            datasets: [{
                data: customerTypesData.map(item => item.total),
                backgroundColor: ['#36b9cc', '#1cc88a', '#f6c23e']
            }]
        },
        options: {
            cutout: '80%',
            responsive: true,
            plugins: {
                legend: {
                    display: false // hide built-in legend
                }
            }
        }
    });
    
    // Update custom legend
    const legendContainer = document.getElementById('customLegend');
    legendContainer.innerHTML = `
        <table style="border-collapse: collapse; width:550px;">
            <tbody>
                ${customerTypesData.map((item, index) => `
                    <tr>
                        <td style="padding: 6px;">
                            <div style="width: 12px; height: 12px; background-color: ${customerTypeChart.data.datasets[0].backgroundColor[index]}; border-radius: 50%;"></div>
                        </td>
                        <td style="padding: 6px; word-wrap: break-word; max-width: 500px;">${item.customerType}</td>
                        <td style="padding: 6px; text-align: right;">${item.total}</td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
}

// Keep the interpretation function as is
function generateCustomerTypeInterpretation(data) {
    const total = data.reduce((sum, item) => sum + item.total, 0);
    const sorted = [...data].sort((a, b) => b.total - a.total);
    const dominant = sorted[0];
    const percentage = ((dominant.total / total) * 100).toFixed(1);

    return `
        <div class="p-3 rounded" style="background: #f8f9fc; border-left: 5px solid #36b9cc;">
            <strong>Customer Type Insight:</strong><br>
            The most engaged customer group was <strong>${dominant.customerType}</strong>, 
            contributing <strong>${dominant.total}</strong> out of <strong>${total}</strong> responses 
            (<strong>${percentage}%</strong> of total).
        </div>
    `;
}