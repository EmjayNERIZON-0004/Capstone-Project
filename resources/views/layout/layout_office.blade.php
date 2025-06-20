<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ebebeb;
            padding-top: 50px;  
        }
        
        /* Navbar Styling */
        .top-navbar {
            background-color: #27548A;
            color: white;
            position: fixed;
            top: 0;
            color:white;
        
            width: 100%;
            z-index: 1030;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            padding: 0.5rem 1rem;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color:white;
        }
        
        /* Notification bell */
        .notification-bell {
            position: relative;
            cursor: pointer;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff5722;
            color: white;
            border-radius: 50%;
        }
        
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            background: #343a40;
            color: white;
            padding-top: 20px;
            left: -250px; /* Initially hidden */
            transition: left 0.3s ease-in-out;
            z-index: 1025;
            top: 50px; /* Position below navbar */
            height: calc(100vh - 50px); /* Adjust height to account for navbar */
            overflow-y: auto;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background: #495057;
            padding-left: 20px;
        }
        
        .sidebar a.active {
            background: #007bff;
            border-left: 4px solid #ffffff;
        }

        /* Sidebar Open State */
        .sidebar.active {
            left: 0;
        }

        /* Hamburger Button */
        .hamburger-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.375rem 0.75rem;
        }

        /* Main Content */
        .main-content {
            transition: margin-left 0.3s ease-in-out;
            padding: 20px;
        }

        .main-content.shifted {
            margin-left: 250px;
        }
        
        /* Logo */
        .sidebar-logo {
            display: block;
            width: 120px;
            margin: 10px auto;
        }
        
        /* User Dropdown */
        .user-dropdown {
            cursor: pointer;
        }
        
        .dropdown-menu {
            right: 0;
            left: auto;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border: none;
            margin-top: 10px;
            padding: 0;
            overflow: hidden;
        }
        
        .dropdown-item {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: background-color 0.2s;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item svg {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            vertical-align: -3px;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-item:active {
            background-color: #e9ecef;
            color: #212529;
        }
        
        .dropdown-divider {
            margin: 0;
        }
        
        /* Enhanced User Profile Button */
        .user-profile-btn {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 30px;
            color: white;
            display: flex;
            align-items: center;
            padding: 5px 15px 5px 5px;
            transition: all 0.2s;
        }
        
        .user-profile-btn:hover {
            background: rgba(255,255,255,0.25);
        }
        
        .user-profile-btn img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid rgba(255,255,255,0.5);
        }
        
        .user-profile-btn .user-name {
            font-weight: 500;
            margin-right: 5px;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Office Logo with Badge */
        .logo-container {
            display: inline-block;
            position: relative;
            margin-bottom: 15px;
        }

        .office-icon {
            position: absolute;
            bottom: 0;
            right: 10px;
            border: 3px solid rgb(14, 168, 50);
            background-color: #31A24C;
            border-radius: 50%;
            padding: 4px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        .office-icon svg {
            width: 22px;
            height: 22px;
            color: white;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content.shifted {
                margin-left: 0;
            }
            
            .sidebar.active {
                box-shadow: 0 0 10px rgba(0,0,0,0.5);
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .user-profile-btn .user-name {
                display: none;
            }
            
            .user-profile-btn {
                padding: 5px;
            }
        }
         
        .office-title {
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            font-size: 1.25rem; /* default */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 50vw;
        }

        @media (max-width: 768px) {
            .office-title {
                font-size: 1rem;       /* shrink font on tablet */
                max-width: 40vw;
            }
        }

        @media (max-width: 576px) {
            .office-title {
                font-size: 0.9rem;      /* further shrink on mobile */
                max-width: 30vw;
            }
        }
    </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg top-navbar">
    <div class="container-fluid">
        <!-- Hamburger Button -->
        <button class="hamburger-btn me-2" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        <!-- Title (Shrinks on smaller screens) -->
        <h4 class="mb-0 flex-grow-1 text-truncate office-title">
            {{ session('office_name') }}
        </h4>

        <!-- Right Side Icons -->
        <div class="d-flex align-items-center ms-auto">
            <!-- Notification Bell -->
            <div class="notification-bell me-3">
                <!-- Bell button -->
                @php
                use App\Models\Notification;

                $office_id = session('office_id');

                $notifications = Notification::where('office_id', $office_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
                @endphp

                <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#notificationModal" style="position: relative; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    @if ($notifications->count() > 0)
                        <span class="notification-badge" style="position: absolute;
                         top: -5px; right: -5px; background-color: #ff5722; 
                         color: white; border-radius: 50%; font-size: 10px;
                          width: 15px; height: 15px; text-align: center; line-height: 20px;
                         display: flex; justify-content: center; align-items: center;">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown user-dropdown">
                @php
                    use App\Models\MainOffice;

                    $officeAdmin = null;
                    if (session()->has('office_id')) {
                        $office = MainOffice::where('office_id', session('office_id'))->first();
                        $officeAdmin = $office ? $office->office_admin : 'Unknown Admin';
                    }
                @endphp
                

                <?php

use App\Models\MainOffice as main;

 $officeId = session('office_id');

    $office = main::where('office_id', $officeId)->first();
 

                ?>
                <button class="user-profile-btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                    style="object-fit: cover;"
                    src="{{ $office->image_path ? asset('images/' . $office->image_path) : asset('logo.png') }}" alt="User Icon">
                    <span class="user-name">{{ $officeAdmin }}</span>
                   
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ url('Office/Dashboard')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Dashboard
                    </a></li>
                    <li><a class="dropdown-item" href="OfficeProfile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        My Profile
                    </a></li>
                    <li><a class="dropdown-item" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Change Password
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ url('logout') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Logout
                    </a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Notifications Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="notificationModalLabel" aria-hidden="true" 
style="background-color:rgba(0, 0, 0, 0.45)"
>
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel" style="color:black;font-size:22px;font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @if ($notifications->count() > 0)
          <div class="list-group">
            @foreach ($notifications as $notification)
              <a href="#" class="list-group-item list-group-item-action" 
              style="background-color: rgb(255, 255, 255);
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border:1px solid #ccc;
              
              ">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">{{ $notification->title ?? 'No Title' }}</h6>
                  <small>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>

                </div>
                <p class="mb-1">{{ $notification->message ?? '' }}</p>
                <small>{{ \Carbon\Carbon::parse($notification->created_at)->format('F j, Y, g:i A') }}</small>

              </a>
            @endforeach
          </div>
        @else
          <p class="text-center text-muted">No notifications found.</p>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="text-center">
        <div class="logo-container">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="sidebar-logo">
            <div class="office-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="6" x2="12" y2="6"></line>
                    <line x1="12" y1="12" x2="12" y2="12"></line>
                    <line x1="12" y1="18" x2="12" y2="18"></line>
                </svg>
            </div>
        </div>
        <h5 class="mb-4">{{ session('office_name') }}</h5>
    </div>

    <a href="{{ route('dashboard_with_score') }}" class="{{ Request::is('dashboard*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
        </svg>
        Dashboard
    </a>
    <a href="{{ route('viewTransactionCount') }}" class="{{ Request::is('submit-transaction*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <line x1="12" y1="20" x2="12" y2="10"></line>
            <line x1="18" y1="20" x2="18" y2="4"></line>
            <line x1="6" y1="20" x2="6" y2="16"></line>
        </svg>
        Transaction Counts Status
    </a>
    <a href="{{ route('showSurveys', ['quarter' => now()->quarter, 'year' => now()->year]) }}" class="{{ Request::is('surveys*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
            <path d="M9 14h6"></path>
            <path d="M9 18h6"></path>
            <path d="M9 10h6"></path>
        </svg>
        Surveys
    </a>
    <a href="{{ route('OfficePerformance') }}" class="{{ Request::is('Office-Performance*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
            <polyline points="13 2 13 9 20 9"></polyline>
        </svg>
        Quarterly Performance   
    </a>
    <a href="{{ route('office.notifications') }}" class="{{ Request::is('office.notifications*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        Notifications
    </a>
    <a href="{{ route('office.qrcodes') }}" class="{{ Request::is('office.qrcodes*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <rect x="7" y="7" width="3" height="3"></rect>
            <rect x="14" y="7" width="3" height="3"></rect>
            <rect x="7" y="14" width="3" height="3"></rect>
            <rect x="14" y="14" width="3" height="3"></rect>
        </svg>
        Office QR Codes
    </a>
</div>

<!-- Main Content -->
<div class="main-content" id="mainContent">
    @yield('content')
</div>
 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');
        
        // Always ensure sidebar starts closed by removing any active class
        sidebar.classList.remove('active');
        mainContent.classList.remove('shifted');
        
        // Always reset localStorage state to closed on page load
        localStorage.setItem('sidebarState', 'closed');
        
        // Toggle sidebar function
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('shifted');
            
            // Save sidebar state to localStorage
            if (sidebar.classList.contains('active')) {
                localStorage.setItem('sidebarState', 'open');
            } else {
                localStorage.setItem('sidebarState', 'closed');
            }
        }
        
        // Event listener for sidebar toggle button
        sidebarToggle.addEventListener('click', toggleSidebar);
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggleBtn = sidebarToggle.contains(event.target);
            
            if (!isClickInsideSidebar && !isClickOnToggleBtn && window.innerWidth < 768 && sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        });
    });
</script>
 
 
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>