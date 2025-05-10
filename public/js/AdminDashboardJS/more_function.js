
function getColorForScore(score) {
    if (score < 60) return '#F44336';
    else if (score <= 79.9) return '#FF9800';
    else if (score <= 94.9) return '#8BC34A';
    else return '#4CAF50';
}

function getCategoryLabel(sqd) {
    return {
        sqd1: 'Responsiveness',
        sqd2: 'Reliability',
        sqd3: 'Access and Facilities',
        sqd4: 'Communication',
        sqd5: 'Costs',
        sqd6: 'Integrity',
        sqd7: 'Assurance',
        sqd8: 'Outcome'
    }[sqd] || 'Unknown';
}

function getCategoryDescription(sqd) {
    return {
        sqd1: 'The willingness to help, assist, and provide prompt service to citizens/clients.',
        sqd2: 'The provision of what is needed and promised, following policy and standards, with minimal error.',
        sqd3: 'Convenience of location, amenities, clear signage, and technology use.',
        sqd4: 'Keeping citizens informed clearly, and listening to feedback.',
        sqd5: 'Satisfaction with billing timeliness, payment options, and cost transparency.',
        sqd6: 'Honesty, justice, fairness, and trust in service delivery.',
        sqd7: 'Capability of staff to serve, with knowledge and helpfulness.',
        sqd8: 'Extent of achieving outcomes and benefits from government services.'
    }[sqd] || 'No description available.';
}

function getScoreInterpretation(score, serviceCount, sqd) {
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
    return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, indicating a very poor performance level. <strong>Action Required</strong>`;
} else if (score <= 0.40) {
    return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, indicating below-average performance. <strong>Priority Action</strong>`;
} else if (score <= 0.60) {
    return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, reflecting average service delivery. <strong>Monitor Performance</strong>`;
} else if (score <= 0.80) {
    return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, reflecting above-average results. <strong>Good but room for growth</strong>`;
} else {
    return `Among the top ${serviceCount} services in the ${categoryName} category, the average score was ${scorePercentage}%, reflecting excellent performance and responsiveness. <strong>Outstanding</strong>`;
}
}

function getAnalysisForScore(office, scorePercentage) {
    let analysis = '';

    if (scorePercentage == 100) {
        analysis = `Based on the data sample, the ${office.office_name} received a <strong> 100.00% </strong> in the content category, indicating an excellent level of performance in addressing the needs and concerns of clients.`;
    } else if (scorePercentage <= 20) {
        analysis = `The ${office.office_name} received a <strong> ${scorePercentage}% </strong>  in the content category, showing a significant underperformance and highlighting the need for immediate improvement.`;
    } else if (scorePercentage <= 40) {
        analysis = `The ${office.office_name} scored <strong> ${scorePercentage}%  </strong> in the content category, indicating below expectations. Efforts should be made to enhance performance.`;
    } else if (scorePercentage <= 60) {
        analysis = `The ${office.office_name} achieved a <strong> ${scorePercentage}% </strong> in the content category, meeting expectations. However, further improvement is recommended for optimal performance.`;
    } else if (scorePercentage <= 80) {
        analysis = `The ${office.office_name} received a <strong>  ${scorePercentage}% </strong> in the content category, indicating above expectations. It’s a good performance, but there's still room for further improvement.`;
    } else {
        analysis = `The ${office.office_name} received a <strong> ${scorePercentage}% </strong> in the content category, demonstrating outstanding performance and exceeding expectations.`;
    }

    return analysis;
}

function getColorForScore(score) {
    if (score < 60) return '#F44336'; 
        
    else if (score >=60 && score <=79.9) return '#FF9800'; // Orange

    else if (score >=80 && score <=94.9) return '#8BC34A'; // Orange

     else if (score >= 95 && score <=100 ) return '#4CAF50'; 

             }


             function updateClock() {
                const clock = document.getElementById('realtimeClock');
                const now = new Date();
                const time = now.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                clock.textContent = time;
            }
        
            setInterval(updateClock, 1000);
            updateClock(); 
        
            function getQuarter(month) {
                return Math.floor(month / 3) + 1;
            }
        
            function updateDateCard() {
                const now = new Date();
                
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const formattedDate = now.toLocaleDateString('en-US', options);
        
                const quarter = getQuarter(now.getMonth());
                const year = now.getFullYear();
        
                document.getElementById('currentDate').textContent = formattedDate;
                document.getElementById('currentQuarterYear').textContent = `Quarter ${quarter} of ${year}`;
            }
        
           


            function updateDateTime() {
                const now = new Date();
            
                // Format Date (e.g., "Sunday, March 17, 2025")
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById("realDate").textContent = now.toLocaleDateString('en-US', options);
            
                // Format Time in 12-hour format with AM/PM
                let hours = now.getHours();
                const minutes = now.getMinutes().toString().padStart(2, "0");
                const seconds = now.getSeconds().toString().padStart(2, "0");
                const ampm = hours >= 12 ? "PM" : "AM";
                hours = hours % 12 || 12; // Convert 24-hour format to 12-hour format
            
                document.getElementById("realTimeClock").textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
            }
              