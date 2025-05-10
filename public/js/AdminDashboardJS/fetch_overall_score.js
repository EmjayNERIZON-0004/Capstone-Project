
function loadOverallScore() {
    fetch('Admin/overall-score2')
    .then(response => response.json())
    .then(data => {
        const score = data.overallScore;
        const satisfactionRate = (score * 100).toFixed(2);
        document.getElementById("satisfactionRate").textContent = satisfactionRate + "%";

        let satisfactionText = '';
        let iconPath = '';

        if (score < 0.60) {
            satisfactionText = 'Poor';
            iconPath = '{{ asset("poor.svg") }}';
            document.getElementById('satisfactionText').style.color = '#F44336';
        } else if (score >= 0.60 && score < 0.80) {
            satisfactionText = 'Fair';
            iconPath = '{{ asset("fair.svg") }}';
            document.getElementById('satisfactionText').style.color = '#FF9800';
        } else if (score >= 0.80 && score < 0.95) {
            satisfactionText = 'Satisfactory';
            iconPath = '{{ asset("smile2.svg") }}';
            document.getElementById('satisfactionText').style.color = '#4CAF50';
        } else {
            satisfactionText = 'Outstanding';
            iconPath = '{{ asset("smile.svg") }}';
            document.getElementById('satisfactionText').style.color = '#388E3C';
        }

        document.getElementById('satisfactionText').textContent = satisfactionText;

        // Fetch and insert the SVG
        fetch(iconPath)
            .then(res => res.text())
            .then(svg => {
                document.getElementById("faceIcon").innerHTML = svg;
            });
    });
}

