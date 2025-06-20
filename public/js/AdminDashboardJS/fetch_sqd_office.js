 

function loadTopOfficesPerSQD() {
    
    fetch('top-offices-per-sqd')
        .then(response => response.json())
        .then(data => {
            if (!data.topOfficesPerSQD || Object.keys(data.topOfficesPerSQD).length === 0) {
                document.getElementById('topOfficesTableBody').innerHTML =
                    `<tr><td colspan="6" class="text-center">No data available</td></tr>`;
                return;
            }

            let tableBody = '';
            for (let sqd in data.topOfficesPerSQD) {
                const offices = data.topOfficesPerSQD[sqd];

                let rowCount = 0;
                let rowCount1 = offices.length;

                offices.forEach(office => {
                    let scorePercentage = (office.score * 100).toFixed(2);
                    let interpretation = getScoreInterpretation(office.score, office.office_name, sqd, "office");

                    tableBody += `
                        <tr>
                            ${rowCount === 0 ? `
                                <td rowspan="${rowCount1}" style="font-size:18px">${sqd.toUpperCase()}</td>
                                <td rowspan="${rowCount1}" style="font-size:18px;width:130px">
                                    ${getCategoryLabel(sqd)}
                                </td>
                                <td rowspan="${rowCount1}" style="font-size:18px;width:270px">
                                    ${getCategoryDescription(sqd)}
                                </td>
                            ` : ''}

                            <td style="font-size:18px">${office.office_name}</td>
                            <td style="font-size:18px">
                                <span class="score-value" style="font-size:18px">${scorePercentage}%</span>
                                <div class="score-bar-container">
                                    <div class="score-bar" style="width: ${scorePercentage}%; background-color: ${getColorForScore(scorePercentage)};"></div>
                                </div>
                            </td>

                            ${rowCount === 0 ? `<td rowspan="${rowCount1}" style="font-size:18px" class="analysis-text">${interpretation}</td>` : ''}
                        </tr>
                    `;

                    rowCount++;
                });
            }

            document.getElementById('topOfficesTableBody').innerHTML = tableBody;
        })
      
}

    function getColorForScore(score) {
        if (score < 60) return '#F44336'; 
            // Red
        else if (score >=60 && score <=79.9) return '#FF9800'; // Orange

        else if (score >=80 && score <=94.9) return '#8BC34A'; // Orange

         else if (score >= 95 && score <=100 ) return '#4CAF50'; 

    }

    // Function to provide interpretation based on score
    function getScoreInterpretation(score, officeName, sqd , type) {
        let categoryName = 
            sqd === 'sqd1' ? 'Responsiveness' :
            sqd === 'sqd2' ? 'Reliability' :
            sqd === 'sqd3' ? 'Access and Facilities' :
            sqd === 'sqd4' ? 'Communication' :
            sqd === 'sqd5' ? 'Costs' :
            sqd === 'sqd6' ? 'Integrity' :
            sqd === 'sqd7' ? 'Assurance' :
            sqd === 'sqd8' ? 'Outcome' : 
            'Unknown Category';

        let scorePercentage = (score * 100).toFixed(2);

        if (score <= 0.20) {
            return `Based on the data sample, the ${officeName} ${type} received a ${scorePercentage}% in the ${categoryName} category, indicating a very poor level of performance, requiring immediate improvement. <strong>Action Required</strong>`;
        } else if (score <= 0.40) {
            return `Based on the data sample, the ${officeName} ${type} received a ${scorePercentage}% in the ${categoryName} category, indicating below-average performance, with significant improvements needed. <strong>Priority Action</strong>`;
        } else if (score <= 0.60) {
            return `Based on the data sample, the ${officeName} ${type} received a ${scorePercentage}% in the ${categoryName} category, indicating average performance, but improvement is necessary. <strong>Monitor Performance</strong>`;
        } else if (score <= 0.80) {
            return `Based on the data sample, the ${officeName} ${type} received a ${scorePercentage}% in the ${categoryName} category, indicating above-average performance, with some room for growth. <strong>Good but room for growth</strong>`;
        } else {
            return `Based on the data sample, the ${officeName} ${type} received a ${scorePercentage}% in the ${categoryName} category, indicating excellent performance, addressing client needs effectively. <strong>Outstanding</strong>`;
        }
    } 
