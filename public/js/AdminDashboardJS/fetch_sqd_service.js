

function loadTopServicePerSQD() {
    fetch('Admin/top-service-per-sqd')
        .then(response => response.json())
        .then(data => {
            if (!data.allOfficesPerSQD || Object.keys(data.allOfficesPerSQD).length === 0) {
                document.getElementById('topServiceTableBody').innerHTML =
                    `<tr><td colspan="6" class="text-center">No data available</td></tr>`;
                return;
            }

            let tableBody = '';

            for (let sqd in data.allOfficesPerSQD) {
                const services = data.allOfficesPerSQD[sqd];

                let rowCount = 0; // Initialize rowCount outside the loop

if (Array.isArray(services)) {
let rowCount1 = 0;

services.forEach(service => {
        rowCount1++;
});
services.forEach(service => {
        let scorePercentage = (service.score * 100).toFixed(2);
        let averageScore = services.reduce((sum, s) => sum + s.score, 0) / services.length;
let interpretation = getScoreInterpretation(averageScore, services.length, sqd, "service");

        tableBody += `
            <tr>
                <!-- Conditionally render these cells only for the first row -->
                ${rowCount === 0 ? `
                    <td rowspan="${rowCount1}" style="font-size:18px">${sqd.toUpperCase()}</td>
                    <td rowspan="${rowCount1}" style="font-size:18px;width:130px">${getCategoryLabel(sqd)}</td>
                    <td rowspan="${rowCount1}" style="font-size:18px;width:270px">${getCategoryDescription(sqd)}</td>
                ` : ` `}

                <!-- Sub-office and score columns (always present) -->
                <td style="font-size:18px">${service.service_name}</td>
                <td style="font-size:18px">
                    <span class="score-value" style="font-size:18px">${scorePercentage}%</span>
                    <div class="score-bar-container">
                        <div class="score-bar" style="width: ${scorePercentage}%; background-color: ${getColorForScore(scorePercentage)};"></div>
                    </div>
                </td>
                
                <!-- Conditionally render the interpretation only for the first row -->
                ${rowCount === 0 ? `<td rowspan="${rowCount1}" style="font-size:18px" class="analysis-text">${interpretation}</td>` : ` `}
            </tr>
        `;

        rowCount++; // Increment rowCount for each section
    });
}

            }

            document.getElementById('topServiceTableBody').innerHTML = tableBody;
        })
        .catch(error => console.error("Error fetching data:", error));
}