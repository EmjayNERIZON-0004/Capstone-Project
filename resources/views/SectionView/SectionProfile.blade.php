<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Section Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 70px;
        }
        
         .top-navbar {  
            position: fixed;
            top: 0;
            background-color: rgb(1, 55, 142);
            color: white;
            width: 100%;
            z-index: 1030;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 0.5rem 1rem;
        }
        
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 3px solid #dee2e6;
        }
        
        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: white;
        }
        
        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            font-weight: 600;
            border-radius: 8px 8px 0 0 !important;
        }
        
        .profile-card {
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .service-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 15px;
            background-color: white;
            cursor: pointer;
        }
        
        .service-card:hover {
            background-color: #f8f9fa;
            border-color: #007bff;
        }
        
        .service-icon {
            width: 50px;
            height: 50px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .stat-card {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
        }
        
        .btn-change-image {
            background-color: #007bff;
            border: 1px solid #007bff;
            border-radius: 6px;
            padding: 0.5rem 1.5rem;
            color: white;
            font-weight: 500;
            margin-top: 1rem;
        }
        
        .btn-change-image:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: white;
        }
        
        .badge-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .badge-active {
            background-color: #28a745;
            color: white;
        }
        
        .badge-inactive {
            background-color: #6c757d;
            color: white;
        }
        
        .dropdown-menu {
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-img {
                width: 100px;
                height: 100px;
            }
            
            .profile-card {
                padding: 1.5rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
        }
        
        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top-color: #007bff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg top-navbar">
        <div class="container-fluid"> 
            <div class="d-flex align-items-center">
                <i class="fas fa-home me-2" style="font-size: 1.5rem;"></i>
                <h4 class="mb-0 d-none d-sm-inline">Section Dashboard</h4>
                <h6 class="mb-0 d-inline d-sm-none">Section Dashboard</h6>
            </div>

            <!-- Right Side Icons -->
            <div class="d-flex align-items-center ms-auto">
                <!-- Date Display -->
             

                <!-- User Dropdown -->
                <div class="dropdown">
                       <button class="btn dropdown-toggle text-white  d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <div class="d-flex align-items-center text-white">
      Menu
        <!-- Optional: User name or other text -->
        <!-- <span class="fw-semibold text-white d-none d-sm-inline">{{ $section->office_admin }}</span> -->
    </div>
</button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                    <li class="dropdown-header d-sm-none">{{ $section->office_admin }}</li>
                 
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="Dashboard">
                           <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6.5 6.5A.5.5 0 0 0 1.5 8.5H2v5.5A1.5 1.5 0 0 0 3.5 15h3A.5.5 0 0 0 7 14.5V11a1 1 0 0 1 2 0v3.5a.5.5 0 0 0 .5.5h3A1.5 1.5 0 0 0 14 14V8.5h.5a.5.5 0 0 0 .354-.854l-6.5-6.5z"/>
        </svg>
                            Dashboard
                        </a>
                    </li>
                     <li>
                        <a class="dropdown-item d-flex align-items-center" href="Services">
             <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"   fill="currentColor"  class="me-2 text-primary" viewBox="0 0 24 24">
  <path d="M10 2a2 2 0 0 0-2 2v3H5a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-9a3 3 0 0 0-3-3h-3V4a2 2 0 0 0-2-2h-4zm0 2h4v3h-4V4z"/>
</svg>

 
                            Submission
                        </a>
                    </li>
                       <li>
                        <a class="dropdown-item d-flex align-items-center" href="Profile">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>

                            Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-danger">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Logout
                        </a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-lg-4 mb-4">
                <div class="profile-card" style="border:1px solid #ddd">
                    <!-- Profile Image -->
                    <div class="mb-3">
                        <h4 class="fw-bold mb-2 text-dark">Office Administrator</h4>
                        @php
    $profileImage = $section->image_path ? 'images/' . $section->image_path : 'logo.png';
@endphp

<img src="{{ asset($profileImage) }}" 
                        
alt="Profile Image" class="rounded-circle profile-img">

                        <!-- Hidden Upload Form -->
                      <form id="imageUploadForm" action="{{ route('section.profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profile_image" id="imageInput" accept="image/*" hidden>
                </form>
                
                        <!-- Change Image Button -->
                        <button type="button" class="btn btn-change-image" onclick="document.getElementById('imageInput').click()">
                            <i class="fas fa-camera me-2"></i>Edit Image
                        </button>
                    </div>
 <script>
        document.getElementById('imageInput').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                document.getElementById('imageUploadForm').submit();
            }
        });
    </script>

                    <!-- Profile Info -->

<!-- Username -->
<p class="text-muted mb-1 d-flex align-items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 text-secondary" viewBox="0 0 16 16">
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
    </svg>
    Username: {{ $section->accountID }}
</p>

<!-- Sub Office Section -->
<p class="text-muted mb-3 d-flex align-items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 text-secondary" viewBox="0 0 16 16">
        <path d="M4 0a2 2 0 0 0-2 2v1h12V2a2 2 0 0 0-2-2H4zM14 4H2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4z"/>
    </svg>
    Sub Office Section
</p>

<!-- Status Badge -->
<span class="badge bg-success d-inline-flex align-items-center px-3 py-2 rounded-pill">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.707 10.707l5-5-1.414-1.414L6 8.586 4.707 7.293 3.293 8.707 6.707 12.121z"/>
    </svg>
    Active
</span>

                </div>

                <!-- Quick Stats -->
              <div class="row g-3">
    <div class="col-6" >
        <div class="bg-white shadow-sm rounded-3 p-3 d-flex align-items-center justify-content-between " style="border:1px solid #ddd">
            <div>
                <div class="fs-4 fw-bold text-dark"  >
    {{ \App\Models\Service::where('sub_office_id', $section->id)->count()
        
    }}
</div>

                <div class="text-muted">Services</div>
            </div>
            <!-- Briefcase Icon -->
                 <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"   fill="currentColor"  class="me-2 text-primary" viewBox="0 0 24 24">
  <path d="M10 2a2 2 0 0 0-2 2v3H5a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-9a3 3 0 0 0-3-3h-3V4a2 2 0 0 0-2-2h-4zm0 2h4v3h-4V4z"/>
</svg>

        </div>
    </div>
    <div class="col-6">
        <div class="bg-white shadow-sm rounded-3 p-3 d-flex align-items-center justify-content-between" style="border:1px solid #ddd">
            <div>
                <div class="fs-4 fw-bold text-dark">
                      {{ \App\Models\survey_responses::where('office_transacted_with', $section->sub_office_name)
                        
                        ->count()
        
    }}

                </div>
                <div class="text-muted">Q2   Surveys </div>
            </div>
            <!-- File Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="text-success" viewBox="0 0 16 16">
                <path d="M0 1a1 1 0 0 1 1-1h5.5a.5.5 0 0 1 .354.146l1 1A.5.5 0 0 0 8.5 1H15a1 1 0 0 1 1 1v2H0V1zm0 4h16v10a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm4 2a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H4z"/>
            </svg>
        </div>
    </div>
</div>

            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Office Information -->
                <div class="card  ">
                <div class="card-header p-2 d-flex align-items-center fw-semibold text-white" style="font-size:20px">
   Office Information
</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="info-item d-flex align-items-start gap-3">
    <div class="info-icon">
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19.5119 5.85L13.5719 2.42C12.6019 1.86 11.4019 1.86 10.4219 2.42L4.49187 5.85C3.52187 6.41 2.92188 7.45 2.92188 8.58V15.42C2.92188 16.54 3.52187 17.58 4.49187 18.15L10.4319 21.58C11.4019 22.14 12.6019 22.14 13.5819 21.58L19.5219 18.15C20.4919 17.59 21.0919 16.55 21.0919 15.42V8.58C21.0819 7.45 20.4819 6.42 19.5119 5.85ZM12.0019 7.34C13.2919 7.34 14.3319 8.38 14.3319 9.67C14.3319 10.96 13.2919 12 12.0019 12C10.7119 12 9.67188 10.96 9.67188 9.67C9.67188 8.39 10.7119 7.34 12.0019 7.34ZM14.6819 16.66H9.32187C8.51187 16.66 8.04187 15.76 8.49187 15.09C9.17187 14.08 10.4919 13.4 12.0019 13.4C13.5119 13.4 14.8319 14.08 15.5119 15.09C15.9619 15.75 15.4819 16.66 14.6819 16.66Z" fill="#ffffff"></path> </g></svg>
    </div>
    <div>
        <strong>Administrator</strong><br>
        <span class="text-muted">{{ $section->office_admin }}</span>
    </div>
</div>

                                <div class="info-item">
                                    <div class="info-icon" >
                                                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2083 7.82141L12.5083 12.2814C12.1983 12.4614 11.8083 12.4614 11.4883 12.2814L3.78826 7.82141C3.23826 7.50141 3.09826 6.75141 3.51826 6.28141C3.80826 5.95141 4.13826 5.68141 4.48826 5.49141L9.90826 2.49141C11.0683 1.84141 12.9483 1.84141 14.1083 2.49141L19.5283 5.49141C19.8783 5.68141 20.2083 5.96141 20.4983 6.28141C20.8983 6.75141 20.7583 7.50141 20.2083 7.82141Z" fill="#ffffff"></path> <path d="M11.4305 14.1389V20.9589C11.4305 21.7189 10.6605 22.2189 9.98047 21.8889C7.92047 20.8789 4.45047 18.9889 4.45047 18.9889C3.23047 18.2989 2.23047 16.5589 2.23047 15.1289V9.9689C2.23047 9.1789 3.06047 8.6789 3.74047 9.0689L10.9305 13.2389C11.2305 13.4289 11.4305 13.7689 11.4305 14.1389Z" fill="#ffffff"></path> <path d="M12.5703 14.1389V20.9589C12.5703 21.7189 13.3403 22.2189 14.0203 21.8889C16.0803 20.8789 19.5503 18.9889 19.5503 18.9889C20.7703 18.2989 21.7703 16.5589 21.7703 15.1289V9.9689C21.7703 9.1789 20.9403 8.6789 20.2603 9.0689L13.0703 13.2389C12.7703 13.4289 12.5703 13.7689 12.5703 14.1389Z" fill="#ffffff"></path> </g></svg>
  </div>
                                    <div>
                                        <strong>Office Name</strong><br>
                                        <span class="text-muted">{{$section->sub_office_name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                     <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2083 7.82141L12.5083 12.2814C12.1983 12.4614 11.8083 12.4614 11.4883 12.2814L3.78826 7.82141C3.23826 7.50141 3.09826 6.75141 3.51826 6.28141C3.80826 5.95141 4.13826 5.68141 4.48826 5.49141L9.90826 2.49141C11.0683 1.84141 12.9483 1.84141 14.1083 2.49141L19.5283 5.49141C19.8783 5.68141 20.2083 5.96141 20.4983 6.28141C20.8983 6.75141 20.7583 7.50141 20.2083 7.82141Z" fill="#ffffff"></path> <path d="M11.4305 14.1389V20.9589C11.4305 21.7189 10.6605 22.2189 9.98047 21.8889C7.92047 20.8789 4.45047 18.9889 4.45047 18.9889C3.23047 18.2989 2.23047 16.5589 2.23047 15.1289V9.9689C2.23047 9.1789 3.06047 8.6789 3.74047 9.0689L10.9305 13.2389C11.2305 13.4289 11.4305 13.7689 11.4305 14.1389Z" fill="#ffffff"></path> <path d="M12.5703 14.1389V20.9589C12.5703 21.7189 13.3403 22.2189 14.0203 21.8889C16.0803 20.8789 19.5503 18.9889 19.5503 18.9889C20.7703 18.2989 21.7703 16.5589 21.7703 15.1289V9.9689C21.7703 9.1789 20.9403 8.6789 20.2603 9.0689L13.0703 13.2389C12.7703 13.4289 12.5703 13.7689 12.5703 14.1389Z" fill="#ffffff"></path> </g></svg>
                                      
                              </div>
                                    <div>
                                        <strong>Main Office</strong><br>
                                    <span class="text-muted">
    {{
        \App\Models\MainOffice::where('office_id', $section->main_office_id)->value('office_name') ?? 'N/A'
    }}
</span>

                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                     <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.2083 7.82141L12.5083 12.2814C12.1983 12.4614 11.8083 12.4614 11.4883 12.2814L3.78826 7.82141C3.23826 7.50141 3.09826 6.75141 3.51826 6.28141C3.80826 5.95141 4.13826 5.68141 4.48826 5.49141L9.90826 2.49141C11.0683 1.84141 12.9483 1.84141 14.1083 2.49141L19.5283 5.49141C19.8783 5.68141 20.2083 5.96141 20.4983 6.28141C20.8983 6.75141 20.7583 7.50141 20.2083 7.82141Z" fill="#ffffff"></path> <path d="M11.4305 14.1389V20.9589C11.4305 21.7189 10.6605 22.2189 9.98047 21.8889C7.92047 20.8789 4.45047 18.9889 4.45047 18.9889C3.23047 18.2989 2.23047 16.5589 2.23047 15.1289V9.9689C2.23047 9.1789 3.06047 8.6789 3.74047 9.0689L10.9305 13.2389C11.2305 13.4289 11.4305 13.7689 11.4305 14.1389Z" fill="#ffffff"></path> <path d="M12.5703 14.1389V20.9589C12.5703 21.7189 13.3403 22.2189 14.0203 21.8889C16.0803 20.8789 19.5503 18.9889 19.5503 18.9889C20.7703 18.2989 21.7703 16.5589 21.7703 15.1289V9.9689C21.7703 9.1789 20.9403 8.6789 20.2603 9.0689L13.0703 13.2389C12.7703 13.4289 12.5703 13.7689 12.5703 14.1389Z" fill="#ffffff"></path> </g></svg>
                                    </div>
                                    <div>
                                        <strong>Created</strong><br>
                                        <span class="text-muted">Jan 15, 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Services Section -->
                    <div class="card">
                    <div class="card-header p-2 d-flex align-items-center fw-semibold text-white" style="font-size:20px">
    Service Offered
    </div>
      @php
use App\Models\Service;

$subOfficeId = session('sub_office_id');

$services = Service::where('sub_office_id', $subOfficeId)
    ->get(['id', 'main_office_id', 'sub_office_id', 'service_name', 'created_at', 'updated_at', 'services_type'])
    ->toArray();
@endphp

                        <div class="card-body">
                            <div id="servicesContainer" data-services="{{ json_encode($services) }}">
                                <!-- Services will be loaded here -->
                            <div class="text-center py-4">
                                <div class="loading"></div>
                                <p class="mt-2 text-muted">Loading services...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        

        // Image upload functionality
        document.getElementById('imageInput').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const button = document.querySelector('.btn-change-image');
                const originalText = button.innerHTML;
                button.innerHTML = '<div class="loading"></div> Uploading...';
                button.disabled = true;
                
                // Simulate upload - replace with actual form submission
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    alert('Image uploaded successfully!');
                }, 2000);
            }
        });

        // Load services
       
    </script>
  
<script>
  
const servicesFromBackend = JSON.parse(document.getElementById('servicesContainer').dataset.services);
    function loadServices() {
        const servicesContainer = document.getElementById('servicesContainer');
        
        setTimeout(() => {
            let servicesHTML = '';

            if (servicesFromBackend.length === 0) {
                servicesHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Services Available</h5>
                        <p class="text-muted">There are currently no services configured for this office.</p>
                    </div>
                `;
            } else {
                servicesFromBackend.forEach(service => {
                    servicesHTML += `
                        <div class="service-card" onclick="showServiceDetails(${service.id})">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1 fw-bold">${service.service_name}</h5>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-tag me-1"></i> ${service.services_type}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            Created: ${new Date(service.created_at).toLocaleDateString()}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            servicesContainer.innerHTML = servicesHTML;
            document.getElementById('serviceCount').textContent = servicesFromBackend.length;
        }, 500);
    }

    function showServiceDetails(serviceId) {
        alert(`Service details for ID: ${serviceId}`);
    }

    document.addEventListener('DOMContentLoaded', function () {
        loadServices();
    });
</script>

</body>
</html>