
function loadTopSectionsPerSQD() {
    fetch('top-section-per-sqd')
        .then(response => response.json())
        .then(data => {
            if (!data.allOfficesPerSQD || Object.keys(data.allOfficesPerSQD).length === 0) {
                document.getElementById('topSectionsTableBody').innerHTML =
                    `<tr><td colspan="6" class="text-center">No data available</td></tr>`;
                return;
            }

            let tableBody = '';

            for (let sqd in data.allOfficesPerSQD) {
                const sections = data.allOfficesPerSQD[sqd];

                let rowCount = 0; // Initialize rowCount outside the loop

if (Array.isArray(sections)) {
let rowCount1 = 0;

    sections.forEach(section => {
        rowCount1++;
});
    sections.forEach(section => {
        let scorePercentage = (section.score * 100).toFixed(2);
        let averageScore = sections.reduce((sum, s) => sum + s.score, 0) / sections.length;
let interpretation = getScoreInterpretation(averageScore, sections.length, sqd, "section");

        tableBody += `
            <tr>
                <!-- Conditionally render these cells only for the first row -->
                ${rowCount === 0 ? `
                    <td rowspan="${rowCount1}" style="font-size:18px">${sqd.toUpperCase()}</td>
                    <td rowspan="${rowCount1}" style="font-size:18px;width:130px">${getCategoryLabel(sqd)}</td>
                    <td rowspan="${rowCount1}" style="font-size:18px;width:270px">${getCategoryDescription(sqd)}</td>
                ` : ` `}

                <!-- Sub-office and score columns (always present) -->
                <td style="font-size:18px">${section.sub_office_name}</td>
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

            document.getElementById('topSectionsTableBody').innerHTML = tableBody;
        })
        .catch(error => console.error("Error fetching data:", error));
}



  