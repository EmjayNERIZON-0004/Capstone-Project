@extends('layout.general_layout')

<title>@yield('title','Concerns List')</title>
 @yield('sidebar')
  @show
@section('content')
   <br><br>
 <div class="container mt-5 p-2" 
 style="background-color: white;
 
 border:1px solid #ddd;
 "

 >
 <?php
    $month = date('n'); // Numeric representation of the month (1–12)
    $year = date('Y'); // Current year
    $quarter = ceil($month / 3); // Determine the quarter
?>
 <div class="d-flex justify-content-between align-items-center " 
    style="background-color: white; ">

<div class="bg-danger" style="  width:fit-content;height:60px;
box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
color:white;
font-size:30px;
text-align:left;
padding:10px;
padding-right:20px;
transform:translateY(-20px);border-radius:5px;


margin-left:10px;margin-right:10px"> 
Concerns/Issues  

</div>
<h5 class="text" style="font-family:sans-serif;"> Q<?= $quarter ?> <?= $year ?></h5>

    </div>
         <table class="table table-bordered">
            <thead>
                <tr>
                <th class="bg-danger" style="  color: white; padding: 10px; text-align: center;">Office Name</th> 
            <th class="bg-danger" style=" color: white; padding: 10px; text-align: center;">Section Name</th> 
            <th class="bg-danger" style="  color: white; padding: 10px; text-align: center;">Service Name</th>  
            <th class="bg-danger" style="  color: white; padding: 10px; text-align: center;">Comment</th>
      
                </tr>
            </thead>
            <tbody id="negativeSentimentsTable">
                <!-- Data will be injected here by JavaScript -->
            </tbody>
        </table>
    
</div>
    <!-- Include Bootstrap JS -->
 
    <!-- Script to fetch and display data -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch the negative sentiments data from the API
        fetch('/sentiments-data/negative')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('negativeSentimentsTable');

                // Group data by main_office -> office_transacted_with
                const grouped = {};
                data.forEach(item => {
                    if (!grouped[item.main_office]) {
                        grouped[item.main_office] = {};
                    }
                    if (!grouped[item.main_office][item.office_transacted_with]) {
                        grouped[item.main_office][item.office_transacted_with] = [];
                    }
                    grouped[item.main_office][item.office_transacted_with].push(item);
                });

                for (const mainOffice in grouped) {
                    const sections = grouped[mainOffice];
                    const mainOfficeRowspan = Object.values(sections).reduce((sum, remarks) => sum + remarks.length, 0);
                    let mainOfficeRendered = false;

                    for (const section in sections) {
                        const remarksList = sections[section];
                        const sectionRowspan = remarksList.length;
                        let sectionRendered = false;

                        remarksList.forEach((item, index) => {
                            const row = document.createElement('tr');

                            row.innerHTML = `
                                ${!mainOfficeRendered ? `<td rowspan="${mainOfficeRowspan}">${mainOffice}</td>` : ''}
                                ${!sectionRendered ? `<td rowspan="${sectionRowspan}">${section}</td>` : ''}
                                <td>${item.service_availed}</td>
                                <td>${item.remarks || 'No Comment'}</td>
                            `;

                            tableBody.appendChild(row);
                            mainOfficeRendered = true;
                            sectionRendered = true;
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching Negative sentiments:', error);
            });
    });
</script>


    @endsection