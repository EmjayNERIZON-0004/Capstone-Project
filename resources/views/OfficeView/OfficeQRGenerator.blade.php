@extends('layout.layout_office')

@section('title', 'Office QR Codes')

@section('content')
<div class="container pt-3 pb-5">
    <div class="card shadow-lg p-4 border-0">
        <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
            <!-- <img src="{{ asset('image.png') }}" alt="QR Code Banner" class="img-fluid" style="max-width: 100px;"> -->
           
            <style>
    img {
        width: 100%;
        max-width: 100px;
        height: auto;
    }

    @media (max-width: 576px) {
        img {
            max-width: 70px;  /* Smaller image for mobile */
        }
    }
</style>

    <img src="{{ asset('undraw_confirmed_c5lo.svg') }}" alt="SVG Image" >

            <div>
                <h3 class="fw-bold text-primary mb-0">Office Sections QR Codes</h3>
                <p class="text-muted">Select a Section to generate or manage QR codes.</p>
            </div>  
        </div>
        <hr>
   <?php
   use SimpleSoftwareIO\QrCode\Facades\QrCode;

   ?>
        <div class="container mt-4">
            <div class="row d-flex justify-content-evenly g-3">
                @foreach ($subOffices as $subOffice)
                    <div class="col-12 col-sm-6 col-md-4">
                        <?php
                            // Get the main office and sub office IDs
                            $mainOffice = session('office_id');
                            $subOfficeId = $subOffice->id;
                            $localIp = getHostByName(getHostName());
                            
                            // Get the local IP address
                            $url = "http://$localIp:8080/CSM-SDO-SCC-Survey/Overview?qrcode=yes&mainOffice=$mainOffice&subOffice=$subOffice->id"; // Adjust the URL if needed
                            $base64QrCode = base64_encode(QrCode::format('svg')->generate($url));
                            $subOfficeName = $subOffice->sub_office_name;
                                ?>

                        <!-- Button for each sub-office -->
                        <a 
            class="btn qr-btn shadow-lg d-flex flex-column align-items-center justify-content-center p-3"
            onclick="showQrCode('{{ $base64QrCode }}', '{{ $subOffice->sub_office_name  }}')"
        >
                            <i class="fas fa-qrcode mb-2" style="font-size: 2rem;"></i> 
                            <span class="fw-bold">{{ $subOffice->sub_office_name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Floating QR Code Modal -->
    <div id="qrCodeModal" class="qr-modal" style="display: none;">
        <div class="qr-modal-content">
            <span class="qr-close" onclick="closeQrCode()">&times;</span>
            <h4 id="qrSectionTitle" class="text-primary mb-3"></h4> <!-- Title section -->
            <div id="qrCodeContainer"></div>
        </div>
    </div>
</div>

<script>
    // Function to show the QR Code
    function showQrCode(base64QrCode, sectionName) {
        // Set the title for the QR code modal
        const sectionTitle = document.getElementById('qrSectionTitle');
        sectionTitle.innerHTML = sectionName;  // Set the section name as the title

        // Set the QR code image source
        const qrCodeContainer = document.getElementById('qrCodeContainer');
        qrCodeContainer.innerHTML = `<img src="data:image/svg+xml;base64,${base64QrCode}" alt="QR Code">`;

        // Display the modal
        document.getElementById('qrCodeModal').style.display = "flex"; // Use 'flex' to ensure it's centered
    }

    // Function to close the QR Code Modal
    function closeQrCode() {
        document.getElementById('qrCodeModal').style.display = "none";
    }
</script>

<style> 
/* Modal container */
/* Modal container */
.qr-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Modal content */
.qr-modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    width: 90%;
    max-width: 600px;
    position: relative;
    box-sizing: border-box;
}

/* Title of the modal (section name) */
#qrSectionTitle {
    font-size: 1.5rem; /* Size of the title */
    font-weight: bold; /* Make the text bold */
    color: #007bff; /* Blue color */
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
    margin-bottom: 10px; /* Add margin below the title */
    text-transform: uppercase; /* Make the text uppercase */
    letter-spacing: 2px; /* Add some letter spacing for clarity */
    font-family: 'Arial', sans-serif; /* Use a clean font family */
    border-bottom: 2px solid #007bff; /* Add a blue border below the title */
    padding-bottom: 5px; /* Add padding below the text to separate it from the border */
}
    

/* Close button */
.qr-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
    color: #333;
}

/* QR code image styling - Make it larger */
#qrCodeContainer img {
    max-width: 100%;
    height: auto;
    width: 100%; /* Make the image width responsive */
    max-height: 400px; /* Ensure it doesn’t get too large */
}

/* QR button styles */
.qr-btn {
    padding: 5px;
    background-color: #343a40;
    color: white;
    border-radius: 10px;
    text-align: center;
    width: 80%;
    height: 120px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
    position: relative;
}

.qr-btn:hover {
    color: white;
    background-color: #1d2124;
    transform: translateY(-5px);
    box-shadow: 4px 8px 15px rgba(0, 0, 0, 0.4);
}

@media (max-width: 768px) {
    .qr-modal-content {
        width: 90%; /* Make the modal width smaller on mobile */
        padding: 20px; /* Reduce padding */
    }

    #qrSectionTitle {
        font-size: 1.2rem; /* Make the title smaller on mobile */
    }

    #qrCodeContainer img {
        max-height: 300px; /* Reduce the max height for the QR code on mobile */
    }

    .qr-btn {
        height: 100px; /* Make the button smaller on mobile */
        width: 100%; /* Full width on mobile */
    }
}

</style>
@endsection
