

fetch('Admin/api/getOverallScoreByMainOffice')
.then(res => res.json())
        .then(data => {
            const container = document.getElementById("mainOfficeProgressBars");
            container.innerHTML = ' '; // Clear previous

            data.data.forEach(item => {
                const scorePercent = (item.overallScore * 100).toFixed(2);
                const color = getColorForScore(scorePercent);

                const barHTML = `
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span> ${item.main_office} </span>
                            <span style="font-size: 14px;">${scorePercent}% - <span style="color:${color}; font-weight: bold;">${item.grade}</span></span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: ${scorePercent}%; background-color: ${color};"
                                aria-valuenow="${scorePercent}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', barHTML);
            });
        }); 













function fetchSQDData() {
    fetch('/Admin/api/getServicePerformanceChart')
        .then(response => response.json())
        .then(data => {
            const dimensions = data.data || data; // Fallback if 'data' is the array itself

            if (!Array.isArray(dimensions)) {
                throw new Error('Invalid response format');
            }

            dimensions.forEach(dimension => {
                const dimensionId = dimension.sqd.toLowerCase(); // e.g., "sqd1", "sqd2"
                const score = dimension.score;

                if (document.getElementById(`sqd-${dimensionId}`)) {
                    updateDimensionScore(dimensionId, score);
                }
            });
        })
        .catch(error => {
            console.error('Error fetching SQD data:', error);
            alert('Failed to load SQD data. Please try again later.');
        });
}

function updateDimensionScore(dimensionId, score) {
    const percentage = (score * 100).toFixed(2);
    const progressBar = document.getElementById(`sqd-${dimensionId}`);
    const progressText = document.getElementById(`sqd-${dimensionId}-text`);

    progressBar.style.width = `${percentage}%`;
    progressBar.setAttribute('aria-valuenow', percentage);
    progressText.textContent = `${percentage}%`;

    if (score < 0.60) {
        progressBar.style.backgroundColor = '#F44336'; // Poor - Red
    } else if (score < 0.80) {
        progressBar.style.backgroundColor = '#FF9800'; // Fair - Orange
    } else if (score < 0.95) {
        progressBar.style.backgroundColor = '#8BC34A'; // Good - Light Green
    } else {
        progressBar.style.backgroundColor = '#4CAF50'; // Excellent - Dark Green
    }
}

fetchSQDData();