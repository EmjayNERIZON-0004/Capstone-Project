@extends('layout.general_layout')

@section('title', 'Sub Offices of ' . $mainOffice->office_name)

@section('content')
<div class="wrapper">
    <div class="content" > 
        <div class="container mt-4">
      @include('components.alert')      
      <style>
.btn-custom{
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: sans-serif;
}
       
table{
font-size: 1rem;
font-family: sans-serif;
} 
.dashboard-header {
    position: relative;
    padding-bottom: 12px;
}

.header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background-color: #043b7d;
    color: white;
    font-size: 20px;
    margin-right: 16px;
}

.header-title .subtitle {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.header-title .title {
    font-size: 28px;
    font-weight: 600;
    margin: 0;
    color: #212529;
}

.btn-custom1 {
    background-color: #043b7d;
    border-color: #043b7d;
    color:white;
}

.btn-custom1:hover, .btn-custom1:focus {
    background-color: #032c5e;
    color:white;
    border-color: #032c5e;
}

.search-bar-container {
    max-width: 800px;
    width: 100%;
}

.search-input { 
    border: 1px solid #d0d7de;
    padding: 12px 20px;
    font-size: 16px;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    background-color: #fff;
    font-family: 'Segoe UI', sans-serif;
}

.search-input::placeholder {
    color: #9ca3af;
}

.search-input:focus {
    outline: none;
    border-color: #043b7d;
    box-shadow: 0 0 0 3px rgba(4, 59, 125, 0.15);
}  .btn-custom-circle {
    display: flex;
    justify-content: center;
    align-items: center;
    border:none;
    width: 50px; /* Circle width */
    height: 50px; /* Circle height */
    border-radius: 50%; /* Making it circular */    background-color: #5a6268; /* Change color on hover */

    color: white; /* Icon color */
    font-size: 20px; /* Adjust icon size */
    text-decoration: none; /* Remove underline */ 
    transition: all 0.3s ease; /* Smooth transition on hover */
}

.btn-custom-circle:hover {
    background-color: #5a6268; /* Change color on hover */
    transform: scale(1.1); /* Slight zoom effect on hover */
}

</style>     
            <!-- <h3 style="border: 1px solid   rgb(4, 59, 125);width:fit-content;padding:3px 0px 3px 10px;border-radius:5px;font-size:35px"  > Sections of<b> 
    <span style="background-color: rgb(4, 59, 125);color:white; padding:10px;border-radius:5px">    
    {{ $mainOffice->office_name }}</span ></b></h3>
    <br>
            <a href="/subOffice/create/{{ $mainOffice->id }}"

              class="btn btn-custom mb-3" 
              style="border: 1px solid #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2), 0 4px 10px rgba(0, 0, 0, 0.1);background-color:white; border-radius:60px;padding:0px;
              font-size:18px;transition: transform 0.3s ease-in-out;font-family:sans-serif;font-size:1.3rem" 
      onmouseover="this.style.transform='scale(1.05)'" 
      onmouseout="this.style.transform='scale(1)'">&nbsp; Add Section   <span><i class="fas fa-plus" style="background-color:rgb(4, 59, 125);padding:10px;color:white;border-radius:100%;margin:2px"></i></span></a>
    -->
      <!-- <div class="dashboard-header mb-4">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="header-icon">
                                <i class="fas fa-sitemap    "></i>
                            </div>
                            <div class="header-title">
                                <h6 class="subtitle">{{ $mainOffice->office_name }} (Section)</h6>
                                <h2 class="title">Sub Offices / Sections</h2>
                            </div>
                        </div>
                        <p class="text-muted mt-2">Managing Sections for {{ $mainOffice->office_name }}</p>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                             
                            <a href="/subOffice/create/{{ $mainOffice->id }}" class="btn btn-custom1 d-flex align-items-center">
                                <i class="fas fa-plus me-2" style="font-size:20px"></i>
                                <span>Add New Section</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                    <a href="{{ route('mainOffice.index') }}"
                     class="btn btn-secondary btn-custom-circle">
                    <i class="fas fa-arrow-left"></i>
                    </a>

                    <div class="search-bar-container mb-4">
    <input type="text" id="officeSearch" class="form-control search-input" placeholder="Search for sub offices...">
</div>

</div>
                </div>
            </div> -->

   <?php
        $month = date('n'); // Numeric representation of the month (1–12)
        $year = date('Y'); // Current year
        $quarter = ceil($month / 3); // Determine the quarter
    ?>
      
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold">Office Management Dashboard</h2>
        <h4 class="text">Q<?= $quarter ?> <?= $year ?></h4>
    </div>
           <div class="row  ">

           
 <div class="col-md-8 mb-3">
     <div class="card shadow-sm " style="background: white; border: 1px solid #ddd;height:200px">
    <div class="row" style="height: 200px;">
         
<div class="col-md-4 d-flex align-items-center justify-content-center" style="border-right: 1px solid #dee2e6;">
            <div class="text-center py-3 w-100">
            
                <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 120px; height: 120px; object-fit: contain;">
             <h2 class="fw-bold text-primary"  >Add Section  </h2>
            </div>
        </div>


        <div class="col-md-8">
            <div class="p-3">
                <h2 class="fw-bold text-primary text-center"  > Section/Sub Office  </h2>
               <form action="{{ route('subOffice.store') }}" method="POST">
                    @csrf

                

                    <div class="row align-items-center">
                        
                        <label for="office_name" class="col-sm-4 col-form-label">Section Name:</label>
                        <div class="col-sm-8">
                      
                        <input type="text" class="form-control" id="sub_office_name" name="sub_office_name" required>
            <input type="hidden" class="form-control" id="main_office_id" name="main_office_id"  value=" {{ $mainOffice->office_id }}"  >
      
                        </div>
                    </div>

                    <div class="row align-items-center mt-2">
                        <label for="office_admin" class="col-sm-4 col-form-label"> Section Admin:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="sub_office_admin" name="sub_office_admin" required>

                        </div>
                    </div>
 

                     <div class="row  mt-3 align-items-center">
                          <div class="col-sm-4">

                          </div>
                        <div class="col-sm-8">
                             <button type="submit" class="btn btn-sm btn-primary me-2 mb-1 w-100">Add Office</button>
                       
                        </div>
                    </div>

                     
                </form>
            </div>
        </div>
    </div>
</div>
 </div>




         <div class="col-md-4 mb-3">
  <div class="card shadow-sm h-100" style="max-height: 220px;"> <!-- Set your preferred max height -->
    <div class="card-body text-center overflow-auto"> <!-- Allows scrolling if content exceeds max height -->
      <div class="d-flex justify-content-center mb-2"></div>


      <div class="fw-bold" style="font-size: 27px;min-height: 125px;">{{ $mainOffice->office_name }}</div>
      <a href="{{ route('mainOffice.index') }}" class="btn btn-secondary d-flex align-items-center justify-content-center">
        Manage Offices 
      </a>
    </div>
  </div>
</div>


</div><div class="col-md-12 mb-4">
  <div class="card shadow-sm" style="height: auto;">
    <div class="card-body py-2 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center w-100" style="max-width: 100%;">
        <!-- Icon -->
        <div style="background-color: rgb(1, 129, 52); padding: 8px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
          <img src="{{ asset('search_icon.svg') }}" style="width: 24px; height: 24px;">
        </div>

        <!-- Search input -->
        <input type="text" id="officeSearch" class="form-control" placeholder="Search for sub offices...">
      </div>
    </div>
  </div>
</div>

@if($subOffices->isEmpty())
    <a href="{{ route('servicesAvailed.createForMainOffice', $mainOffice->id) }}" 
       class="btn btn-success btn-custom mb-3">
        Add Service to {{ $mainOffice->office_id }}
    </a>
@endif
 <?php
   use SimpleSoftwareIO\QrCode\Facades\QrCode;
$qrCode = " ";
   ?>
<div class="row">
    @forelse($subOffices as $subOffice)
      
            <?php
            $mainOffice = $subOffice->main_office_id;
            // $localIp = getHostByName(getHostName());
            $url = "https://csm-project.wuaze.com/CSM-SDO-SCC-Survey/Overview?qrcode=yes&mainOffice=$mainOffice&subOffice={$subOffice->id}";
            $qrCode = base64_encode(QrCode::format('svg')->size(100)->generate($url));

              $qrCode_blue = base64_encode(
        QrCode::format('svg')
            ->size(900)
            ->color(70, 130, 180) // Blue color
            ->generate($url)
    );
      ?>

        <div class="col-md-{{ count($subOffices) == 2 ? '6' : '4' }} mb-4 searchable-card">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3 text-center">

<div class="mt-3   align-items-center" id="qr-container-{{ $subOffice->id }}">
    <!-- On-screen QR code (small, normal use) -->
  <div class="d-print-none text-center">
    <div>
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" 
             alt="QR Code" 
             style="width: 100px; height: 100px;" />
    </div>

    <div class="mt-2">
        <button onclick="printQRCode('{{ $subOffice->id }}')" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-print"></i> Print QR
        </button>
    </div>
</div>



<!-- Enhanced Printable QR code with modern design -->
<!-- Enhanced Printable QR code with modern design -->
<div id="print-area-{{ $subOffice->id }}" class="d-none d-print-block">
    <div class="print-container">
        <!-- Header with decorative elements -->
        <div class="header-section">
              <div class="logo-section">
            <div class="logo-container">
                <div class="logo-frame">
                    <img src="{{ asset('logo.png') }}" alt="Logo" />
                </div>
            </div>
        </div>
            <svg class="corner-decoration top-left" viewBox="0 0 100 100">
                <path d="M0,0 Q50,25 100,0 L100,50 Q75,25 100,100 L50,100 Q25,75 0,100 L0,50 Q25,25 0,0 Z" fill="#0066cc" opacity="0.1"/>
            </svg>
            <svg class="corner-decoration top-right" viewBox="0 0 100 100">
                <path d="M0,0 Q50,25 100,0 L100,50 Q75,25 100,100 L50,100 Q25,75 0,100 L0,50 Q25,25 0,0 Z" fill="#0066cc" opacity="0.1"/>
            </svg>
            
          
           
        </div>

        <!-- Main Office Name with Icon -->
        <div class="main-office-section">
          
            <div class="main-office-name">
                @php
                $subOffice = \App\Models\SubOffice::findOrFail($subOffice->id);
                $mainOfficeName = \App\Models\MainOffice::where('office_id', $subOffice->main_office_id)->value('office_name');
                @endphp
                {{ $mainOfficeName }}
            </div>
        </div>

        <!-- Sub Office Name with Icon -->
        <div class="sub-office-section">
            <svg class="location-icon" width="30" height="30" viewBox="0 0 24 24" fill="#4a90e2">
                <path d="M12 2C15.31 2 18 4.66 18 7.95C18 12.41 12 22 12 22S6 12.41 6 7.95C6 4.66 8.69 2 12 2Z"/>
                <circle cx="12" cy="8" r="2.5" fill="white"/>
            </svg>
            <div class="sub-office-name">
                {{ $subOffice->sub_office_name }}
            </div>
        </div>

       
        <!-- Logo Section at Top Center -->
      

        <!-- Large QR Code Section -->
        <div class="qr-section">
            <div class="qr-container">
                <div class="qr-frame">
                    <img src="data:image/svg+xml;base64,{{ $qrCode_blue }}" alt="QR Code" class="qr-large" />
                </div>
            </div>
        </div>

        <!-- Instructions Section -->
      

        <!-- Footer decorative elements -->
       
    </div>
</div>



</div>
<script>
function printQRCode(id) {
    const printArea = document.getElementById('print-area-' + id).innerHTML;
    const win = window.open('', '', 'width=1200,height=1200');
    win.document.write(`
        <html>
        <head>
            <title>Print QR Code</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    background: linear-gradient(135deg, #e3f2fd 0%, #f0f8ff 100%);
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    padding: 20px;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .print-container {
                    background: white;
                    border-radius: 20px;
                    box-shadow: 0 20px 40px rgba(0, 102, 204, 0.1);
                    border: 3px dashed #0066cc;
                    padding: 50px;
                    max-width: 950px;
                    width: 100%;
                    position: relative;
                    overflow: hidden;
                }
                
                .print-container::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: repeating-linear-gradient(
                        45deg,
                        transparent,
                        transparent 10px,
                        rgba(0, 102, 204, 0.02) 10px,
                        rgba(0, 102, 204, 0.02) 20px
                    );
                    z-index: -1;
                }
                
                .header-section {
                    position: relative;
                    margin-bottom: 0px;
                }
                
                .corner-decoration {
                    position: absolute;
                    width: 80px;
                    height: 80px;
                }
                
                .top-left { top: -40px; left: -40px; }
                .top-right { top: -40px; right: -40px; transform: rotate(90deg); }
                .bottom-left { bottom: -40px; left: -40px; transform: rotate(-90deg); }
                .bottom-right { bottom: -40px; right: -40px; transform: rotate(180deg); }
                
                .office-icon {
                    text-align: center;
                    margin-bottom: 0px;
                }
                
                .main-office-section {
                    text-align:center;
                    margin-bottom: 5px;
                }
                
                .main-office-name {
                    font-size: 38px;
                    text-align:center;
                    font-weight: 800;
                    color: #0066cc;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                    text-shadow: 2px 2px 4px rgba(0, 102, 204, 0.1);
                }
                
                .sub-office-section {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0px;
                    margin-bottom: 5px;
                }
                
                .sub-office-name {
                    font-size: 32px;
                    font-weight: 600;
                    color: #4a90e2;
                    text-transform: capitalize;
                    letter-spacing: 1px;
                }
                
                .divider-line {
                    text-align: center;
                    margin: 40px 0;
                }
                
                .logo-section {
                    text-align: center;
                    margin: 10px 0 10px 0;
                }
                
                .logo-container {
                    display: inline-block;
                }
                
                .logo-frame {
                    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
                    border: 3px solid #0066cc;
                    border-radius: 50%;
                    padding: 2px;
                    box-shadow: 0 10px 20px rgba(0, 102, 204, 0.1);
                    position: relative;
                }
                
                .logo-frame::before {
                    content: '';
                    position: absolute;
                    top: -3px;
                    left: -3px;
                    right: -3px;
                    bottom: -3px;
                    background: linear-gradient(45deg, #0066cc, #4a90e2);
                    border-radius: 23px;
                    z-index: -1;
                }
                
                .logo-frame img {
                    width: 300px;
                    height: 300px;
                    object-fit: contain;
                    border-radius: 15px;
                }
                
                .qr-section {
                    text-align: center;
                    margin: 0px 0;
                }
                
                 
                
                .qr-frame {
                    background: white;
                    border: 6px solid #0066cc;
                    border-radius: 30px;
                    padding: 20px;
                    box-shadow: 0 20px 40px rgba(0, 102, 204, 0.2);
                    position: relative;
                    display: inline-block;
                }
                
                .qr-frame::before {
                    content: '';
                    position: absolute;
                    top: -6px;
                    left: -6px;
                    right: -6px;
                    bottom: -6px;
                    background: linear-gradient(45deg, #0066cc, #4a90e2, #87ceeb);
                    border-radius: 36px;
                    z-index: -1;
                }
                
                .qr-large {
                    width: 850px;
                    height: 850px;
                    border-radius: 20px;
                    
                }
                
              
                  
                
                /* Print-specific styles */
                @media print {
                    body {
                        background: white;
                        padding: 0;
                    }
                    
                    .print-container {
                        box-shadow: none;
                        border-radius: 0;
                        max-width: none;
                        width: 100%;
                        height: 100vh;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                    }
                    
                    .qr-large {
                        width: 850px;
                        height: 850px;
                        border-radius: 20px;
                    }
                    
                    .logo-frame img {
                        width: 300px;
                        height: 300px;
                    }
                    
                   
                   
                }
                
                /* Animation for better visual appeal */
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                
                .print-container > * {
                    animation: fadeIn 0.6s ease-out forwards;
                }
                
                .print-container > *:nth-child(2) { animation-delay: 0.1s; }
                .print-container > *:nth-child(3) { animation-delay: 0.2s; }
                .print-container > *:nth-child(4) { animation-delay: 0.3s; }
                .print-container > *:nth-child(5) { animation-delay: 0.4s; }
            </style>
        </head>
        <body onload="window.print(); window.close();">
            ${printArea}
        </body>
        </html>
    `);
    win.document.close();
}
</script>


                        <div class="fw-bold sub-office-name" style="font-size: 20px;">
                            {{ $subOffice->sub_office_name }}
                        </div>
                        <div class="text-muted office-admin" style="font-size: 14px;">
                            Admin: {{ $subOffice->office_admin }}
                        </div>

                        {{-- QR Code --}}



                        <hr class="my-3">
                    </div>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('subOffice.edit', $subOffice->id) }}" 
                           class="btn btn-sm btn-primary d-flex align-items-center justify-content-center text-nowrap"
                           style="min-width: 90px; height: 38px; font-size: 14px;">
                            Edit
                        </a>

                        <form action="{{ route('subOffice.destroy', $subOffice->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-danger d-flex align-items-center justify-content-center text-nowrap"
                                    style="min-width: 90px; height: 38px; font-size: 14px;">
                                Delete
                            </button>
                        </form>

                        <div class="position-relative">
                            <a href="{{ route('servicesAvailed.show', $subOffice->id) }}" 
                               class="btn btn-sm btn-success d-flex align-items-center justify-content-center text-nowrap"
                               style="min-width: 90px; height: 38px; font-size: 14px;">
                                Services
                            </a>
                            @if($subOffice->servicesCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $subOffice->servicesCount }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted" id="no-suboffices">No sub-offices found for this main office.</div>
    @endforelse
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('officeSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.searchable-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const subOfficeName = card.querySelector('.sub-office-name').textContent.toLowerCase();
                const officeAdmin = card.querySelector('.office-admin').textContent.toLowerCase();

                if (subOfficeName.includes(searchTerm) || officeAdmin.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide "no results" message
            const noSubOfficesMessage = document.getElementById('no-suboffices');
            if (noSubOfficesMessage) {
                if (visibleCount === 0 && searchTerm !== '') {
                    noSubOfficesMessage.textContent = 'No sub-offices match your search.';
                    noSubOfficesMessage.style.display = '';
                } else if (visibleCount === 0 && searchTerm === '') {
                    noSubOfficesMessage.textContent = 'No sub-offices found for this main office.';
                    noSubOfficesMessage.style.display = '';
                } else {
                    noSubOfficesMessage.style.display = 'none';
                }
            }
        });
    }
});
</script>
@endsection
