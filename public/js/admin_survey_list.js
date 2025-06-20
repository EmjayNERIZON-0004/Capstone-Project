// Floating loading modal functions
function showLoadingModal() {
    if (!document.getElementById('loading-modal')) {
        const modal = document.createElement('div');
        modal.id = 'loading-modal';
        modal.innerHTML = `
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading data...</div>
        `;
        document.body.appendChild(modal);
    }
    document.getElementById('loading-modal').style.display = 'flex';
    const table = document.getElementById('responsesTable');
    if (table) table.style.visibility = 'hidden';
}

function hideLoadingModal() {
    const modal = document.getElementById('loading-modal');
    if (modal) modal.style.display = 'none';
    const table = document.getElementById('responsesTable');
    if (table) table.style.visibility = 'visible';
}

function updateRowNumbers() {
    const allRows = document.querySelectorAll(".response-row");
    let count = 1;
    let visibleRowCount = 0;
    allRows.forEach(row => {
        if (row.style.display !== "none") {
            const numberCell = row.querySelector(".row-number");
            if (numberCell) numberCell.textContent = count++;
            visibleRowCount++;
        }
    });
    const totalRowsElement = document.getElementById("totalRowsCount");
    if (totalRowsElement) {
        totalRowsElement.textContent = `${visibleRowCount}`;
    }
}
 
function checkIfNoData() {
    const rows = document.querySelectorAll("#responsesTable tbody tr");
    const hasVisible = Array.from(rows).some(row => row.style.display !== 'none');
    document.getElementById("responsesTable").style.display = hasVisible ? '' : 'none';
    document.getElementById("noDataContainer").style.display = hasVisible ? 'none' : 'block';
}

// This function wraps the original filterTable with loading modal
function applyFiltering() {
    showLoadingModal();
    setTimeout(function() {
        hideLoadingModal();

        const searchValue = document.getElementById("searchInput").value.toLowerCase().trim();
        const selectedCustomerType = document.getElementById("customerTypeFilter").value.toLowerCase().trim();
        const selectedOffice = document.getElementById("mainOfficeFilter").value.toLowerCase().trim();
        const selectedSection = document.getElementById("sectionFilter").value.toLowerCase().trim();
        const selectedService = document.getElementById("serviceFilter").value.toLowerCase().trim();
        const selectedSex = document.getElementById("sexFilter").value.toLowerCase().trim();
        const ageFrom = parseInt(document.getElementById("ageFrom").value);
        const ageTo = parseInt(document.getElementById("ageTo").value);

        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            const textContent = row.innerText.toLowerCase();
            const customerType = row.querySelector(".customer-type").innerText.toLowerCase();
            const office = row.querySelector(".office-transacted").innerText.toLowerCase();
            const section = row.querySelector(".section").innerText.toLowerCase();
            const service = row.querySelector(".service").innerText.toLowerCase();
            const sex = row.cells[2].innerText.toLowerCase();
            const age = parseInt(row.cells[1].innerText);

            const matchesSearch = textContent.includes(searchValue);
            const matchesCustomerType = selectedCustomerType === "" || customerType === selectedCustomerType;
            const matchesOffice = selectedOffice === "" || office === selectedOffice;
            const matchesSection = selectedSection === "" || section === selectedSection;
            const matchesService = selectedService === "" || service === selectedService;
            const matchesSex = selectedSex === "" || sex === selectedSex;
            const matchesAgeFrom = isNaN(ageFrom) || age >= ageFrom;
            const matchesAgeTo = isNaN(ageTo) || age <= ageTo;

            const showRow = matchesSearch && matchesCustomerType && matchesOffice && matchesService && matchesSection && matchesSex && matchesAgeFrom && matchesAgeTo;
            row.style.display = showRow ? "" : "none";
        });

        updateRowNumbers();
        checkIfNoData(); // ✅ check if there are visible rows
    }, 800);
}

document.addEventListener("DOMContentLoaded", function () {
    showLoadingModal();

    setTimeout(function() {
        updateRowNumbers();
        checkIfNoData(); // ✅ on load
        hideLoadingModal();
    }, 2000);

    document.getElementById("searchInput").addEventListener("keyup", applyFiltering);
    document.getElementById("customerTypeFilter").addEventListener("change", applyFiltering);
    document.getElementById("mainOfficeFilter").addEventListener("change", applyFiltering);
    document.getElementById("sectionFilter").addEventListener("change", applyFiltering);
    document.getElementById("serviceFilter").addEventListener("change", applyFiltering);
    document.getElementById("sexFilter").addEventListener("change", applyFiltering);
    document.getElementById("ageTo").addEventListener("input", applyFiltering);

    var sortButton = document.getElementById("sortButton");
    var sortOrder = "asc";

    sortButton.addEventListener("click", function () {
        showLoadingModal();
        setTimeout(function () {
            sortTable(0, sortOrder);
            sortOrder = sortOrder === "asc" ? "desc" : "asc";
            updateRowNumbers();
            checkIfNoData(); // ✅ after sort
            hideLoadingModal();
        }, 2000);
    });

    function sortTable(n, order) {
        var table = document.getElementById("responsesTable");
        var tbody = table.querySelector("tbody");
        var rows = Array.from(tbody.querySelectorAll("tr"));

        rows.sort(function (rowA, rowB) {
            var cellA = rowA.cells[n].innerText.trim();
            var cellB = rowB.cells[n].innerText.trim();
            var numA = parseFloat(cellA);
            var numB = parseFloat(cellB);
            var isNumeric = !isNaN(numA) && !isNaN(numB);
            return isNumeric ? (order === "asc" ? numA - numB : numB - numA) : (order === "asc" ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA));
        });

        rows.forEach(row => tbody.appendChild(row));
    }
});
