// Define chart variable at a broader scope
let mainOfficeChart = null;

function getOffice(selectedQuarter, selectedYear) {
    fetch(`/survey-analytics/data?quarter=${selectedQuarter}&year=${selectedYear}`)
        .then(res => res.json())
        .then(data => {
            // Destroy existing chart if it exists
            if (mainOfficeChart) {
                mainOfficeChart.destroy();
            }

            const offices = data.mainOffices;
            const labels = offices.map(item => item.main_office);
            const counts = offices.map(item => item.total);
            const total = counts.reduce((sum, val) => sum + val, 0);
            const percentages = counts.map(val => ((val / total) * 100).toFixed(2));

            const ctx = document.getElementById('mainOfficeChart').getContext('2d');

            // Define bar colors
            const barColors = [
                '#f6c23e', '#e74a3b',
                '#5a5c69', '#20c997', '#fd7e14', '#6f42c1'
            ];

            // Combine all data into an array of objects
            const combinedData = labels.map((label, index) => ({
                label,
                percentage: percentages[index],
                count: counts[index],
                color: barColors[index % barColors.length]
            }));

            // Sort by percentage in descending order
            combinedData.sort((a, b) => b.percentage - a.percentage);

            // Unpack the sorted data back into arrays
            const sortedLabels = combinedData.map(item => item.label);
            const sortedPercentages = combinedData.map(item => item.percentage);
            const sortedCounts = combinedData.map(item => item.count);
            const sortedColors = combinedData.map(item => item.color);

            // Create new chart
            mainOfficeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: sortedLabels,
                    datasets: [{
                        label: 'Percentage of Responses',
                        data: sortedPercentages,
                        maintainAspectRatio: false, 
                        backgroundColor: sortedColors,
                        borderRadius: 0,
                        borderSkipped: false
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false // hide default legend
                        },
                        datalabels: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const index = context.dataIndex;
                                    return `${sortedLabels[index]}: ${sortedPercentages[index]}% (${sortedCounts[index]} responses)`;
                                }
                            }
                        },
                        datalabels: {
                            color: '#000',
                            anchor: 'end',
                            align: 'right',
                            formatter: function (value, context) {
                                const count = sortedCounts[context.dataIndex];
                                return `${value}% (${count})`;
                            }
                        }
                    },
                    scales: {
                        x: {
                            max: 100,
                            ticks: {
                                callback: function (value) {
                                    return value + '%';
                                }
                            }
                        },
                        y: {
                            ticks: {
                                display: false // hides office names on the left
                            },
                            grid: {
                                drawTicks: false // optional: hides the small tick lines too
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Create custom legend
            let legendHTML = `
                <table style="border-collapse: collapse; width: 470px;">
                    <tbody>
                        ${sortedLabels.map((label, index) => `
                            <tr>
                                <td style="padding: 6px;">
                                    <div style="width: 12px; height: 12px; background-color: ${sortedColors[index]}; border-radius: 50%;"></div>
                                </td>
                                <td style="padding: 6px; word-wrap: break-word; max-width: 900px;">${label}</td>
                                <td style="padding: 6px; text-align: right;">${sortedCounts[index]}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;

            // Inject into the page
            document.getElementById('mainOfficeLegend').innerHTML = legendHTML;

            // Sort for interpretation
            let interpretation = `
                <div class="p-3 rounded" >
                    <strong>Office Survey Data Interpretation:</strong><br>
                    <p>The survey responses were collected across multiple offices. Below is the analysis of response rates:</p>
            `;

            sortedCounts.forEach((count, index) => {
                const percent = ((count / total) * 100).toFixed(2);
                interpretation += `
                    <p><strong>${index + 1}. ${sortedLabels[index]}:</strong><br>
                    Received <strong>${count}</strong> responses, accounting for <strong class="text-primary">${percent}%</strong> of the total responses.<br>
                    ${index === 0 ? "This office had the highest number of responses, indicating strong engagement." : ""}
                    ${index === sortedLabels.length - 1 ? "This office had the lowest number of responses, signaling potential areas for improvement." : ""}
                    </p>
                `;
            });

            interpretation += `
                <p><strong>Summary and Recommendations:</strong><br>
                - <strong>${sortedLabels[0]}</strong> stands out with the highest responses, possibly due to strong local engagement or prior outreach.<br>
                - Focus should be placed on improving responses from <strong>${sortedLabels[sortedLabels.length - 1]}</strong>, which received the least engagement.<br>
                - Other offices fall in between, so targeted campaigns may be required to boost participation across the board.
                </p>
                </div>`;

            // Inject interpretation into the page
            document.getElementById("mainOfficeInterpretation").innerHTML = interpretation;
        });
}