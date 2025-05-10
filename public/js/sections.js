// Store chart references globally so we can update them
let sectionCharts = [];

function getSection(selectedQuarter, selectedYear) {
    // Clear existing charts and container
    sectionCharts.forEach(chart => chart.destroy());
    sectionCharts = [];
    document.getElementById('subOfficeChartsContainer').innerHTML = '';
    
    fetch(`/get-quarter-data?quarter=${selectedQuarter}&year=${selectedYear}`)
        .then(res => res.json())
        .then(data => {
            const subOffices = data.subOffices;

            // Group subOffices by main_office
            const grouped = {};
            subOffices.forEach(item => {
                if (!grouped[item.main_office]) {
                    grouped[item.main_office] = [];
                }
                grouped[item.main_office].push(item);
            });

            const container = document.getElementById('subOfficeChartsContainer');

            Object.entries(grouped).forEach(([mainOffice, sections], index) => {
                const chartId = `subOfficeChart${index}`;
                const legendId = `subOfficeLegend${index}`;

                // Create wrapper div with flex display
                const wrapper = document.createElement('div');
                wrapper.style.display = 'flex';
                wrapper.style.gap = '20px';
                wrapper.style.paddingTop = '20px';
                wrapper.style.marginLeft = '10px';
                wrapper.style.marginBottom = '40px';

                // Legend section (left)
                const legendDiv = document.createElement('div');
                legendDiv.id = legendId;
                legendDiv.style.flex = '1';
                legendDiv.style.width = '600px';
                legendDiv.classList.add('mt-3');

                // Chart section (right)
                const chartDiv = document.createElement('div');
                chartDiv.style.flex = '1';
                chartDiv.innerHTML = `
                    <h5 style="margin-bottom: 5px;">${mainOffice}</h5>
                
                    <canvas id="${chartId}" height="${sections.length * 30}" style="border: 1px solid #ccc;"></canvas>
               
               
                    `;

                wrapper.appendChild(legendDiv);
                wrapper.appendChild(chartDiv);
                container.appendChild(wrapper);

                // Extract labels and counts
                const labels = sections.map(s => s.office_transacted_with);
                const counts = sections.map(s => s.total);

                const barColors = [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                    '#858796', '#5a5c69', '#20c997', '#fd7e14', '#6f42c1'
                ];

                // Create chart after DOM elements are added
                setTimeout(() => {
                    const ctx = document.getElementById(chartId).getContext('2d');
                    const newChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Number of Responses',
                                data: counts,
                                backgroundColor: barColors.slice(0, labels.length),
                                borderRadius: 0,
                                barThickness: 35,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return `${context.label}: ${context.parsed.x} responses`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: { stepSize: 10 }
                                },
                                y: {
                                    ticks: {
                                        display: false // Hides office names on the left
                                    },
                                    grid: {
                                        drawTicks: false // Optional: hides the small tick lines too
                                    }
                                }
                            }
                        }
                    });
                    
                    // Store reference to chart for future updates
                    sectionCharts.push(newChart);
                    
                    // Custom Legend in table format
                    let tableHTML = `
                        <h5 style="margin-bottom: 10px;">Sections / Areas / Unit</h5>
                        <table style="border-collapse: collapse; width:400px;">
                            <tbody>
                    `;
                    labels.forEach((label, i) => {
                        tableHTML += `
                            <tr>
                                <td style="padding: 6px;">
                                    <div style="width: 12px; height: 12px; background-color: ${barColors[i % barColors.length]}; border-radius: 50%;"></div>
                                </td>
                                <td style="padding: 6px;">${label}</td>
                                <td style="padding: 6px; text-align: right;">${counts[i]}</td>
                            </tr>
                        `;
                    });
                    tableHTML += '</tbody></table>';
                    legendDiv.innerHTML = tableHTML;
                }, 0);
            });
        });
}