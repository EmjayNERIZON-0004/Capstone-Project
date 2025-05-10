 

    function loadTopOfficesPerSQD() {
        fetch('Admin/top-offices-per-sqd')
            .then(response => response.json())
            .then(data => {
                if (!data.topOfficesPerSQD || Object.keys(data.topOfficesPerSQD).length === 0) {
                    document.getElementById('topOfficesTableBody').innerHTML =
                        `<tr><td colspan="5" class="text-center">No data available</td></tr>`;
                    return;
                }

                let tableBody = '';
                for (let sqd in data.topOfficesPerSQD) {
                    let office = data.topOfficesPerSQD[sqd];
                    if (office) {
                        let scorePercentage = (office.score * 100).toFixed(2);
                        let interpretation = getScoreInterpretation(office.score, office.office_name, sqd, " ");

                        tableBody += `
                        <tr>
                            <td style="font-size:18px">${sqd.toUpperCase()}</td>
                            <td style="font-size:18px;width:130px">
                                ${ 
                                    sqd === 'sqd1' ? 'Responsiveness' :
                                    sqd === 'sqd2' ? 'Reliability' :
                                    sqd === 'sqd3' ? 'Access and Facilities' :
                                    sqd === 'sqd4' ? 'Communication' :
                                    sqd === 'sqd5' ? 'Costs' :
                                    sqd === 'sqd6' ? 'Integrity' :
                                    sqd === 'sqd7' ? 'Assurance' :
                                    sqd === 'sqd8' ? 'Outcome' :
                                    sqd.toUpperCase()
                                }
                            </td>
                                <td style="font-size:18px;width:270px">
                                ${ 
                                    sqd === 'sqd1' ? 'The willingness to help, assist, and provide prompt service to citizens/clients.' :
                                    sqd === 'sqd2' ? 'The provision of what is needed and what was is promised, following the policy and standards, with zero to a minimal error rate.' :
                                    sqd === 'sqd3' ? 'The convinience of location, sample ammenities for comfortable transactions, use of clear signages, and modes of techhnology.' :
                                    sqd === 'sqd4' ? 'The act of keeping citizens and clients informed in a language they can easilty understand, as well as listening to their feedback.' :
                                    sqd === 'sqd5' ? 'The satisfaction with timeliness of the billing, billing process/es, preffered methods of payment, reasonable payment period, value of money, the acceptable range of costs adn qualitative information on the cost of each service.' :
                                    sqd === 'sqd6' ? 'The assurance that there is honestly, justice, fairness, and trust in each service while dealing with the citizens/clients.' :
                                    sqd === 'sqd7' ? 'The capability  of frontline staff to perform their duties, product and service knowledge, understand citizen/client needs, helpfulnesss, and good work relationships.' :
                                    sqd === 'sqd8' ? 'The externt of achieving outcomes or realizing the intended benefits of government services.' :
                                    sqd.toUpperCase()
                                }
                            </td>
                            <td style="font-size:18px">${office.office_name}</td>
                            <td style="font-size:18px">
                                <span class="score-value" style="font-size:18px">${scorePercentage}%</span>
                                <div class="score-bar-container">
                                    <div class="score-bar" style="width: ${scorePercentage}%; background-color: ${getColorForScore(scorePercentage)};"></div>
                                </div>
                            </td>
                            <td style="font-size:18px" class="analysis-text">${interpretation}</td>  <!-- Interpretation Column -->
                        </tr>`;
                    }
                }
                document.getElementById('topOfficesTableBody').innerHTML = tableBody;
            })
            .catch(error => console.error("Error fetching data:", error));
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
