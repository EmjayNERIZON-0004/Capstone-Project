<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary: #2563eb;
            --primary-light:rgb(242, 248, 255);
            --secondary: #475569;
            --accent: #0284c7;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #0f172a;
            --text-light: #e2e8f0;
            --text-dark: #334155;
            --border: #e2e8f0;
            --hover: rgba(219, 234, 254, 0.3);
            --sidebar-bg: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            --navbar-bg: #ffffff;
            --active-bg: rgba(59, 130, 246, 0.15);
        }
body.light-mode {
    
    --sidebar-bg: #f0f0f0; 
background: var(--primary-light);
    color: #333;
      font-family:Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
            padding: 0;
    /* other light theme styles */
}

body.dark-mode {
    --sidebar-bg: #212a55;
    --primary-light: #1f58b3;


 
    background: var(--sidebar-bg);  


color: white;
      font-family:Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
            padding: 0;
    /* other dark theme styles */
}
     
.text{
    <?php
        if (session('mode') == 'dark') {
            
              echo 'color:white';
        } else {
          
            echo 'color:#333';
        }   
    ?>
}

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 280px;
            background: var(--sidebar-bg);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1040;
            overflow-y: auto;
            overflow-x: hidden;
            color: var(--text-light);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
           

            
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            height: 75px;
            min-height: 75px;
    <?php
        if (session('mode') == 'dark') {
            
              echo 'background: rgba(0, 0, 0, 0.2); ;';
        } else {
          
            echo 'background: #2563eb';
        }   
    ?>
        }

        .sidebar.collapsed .sidebar-header {
            padding: 2rem 0.5rem;
            justify-content: center;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            pointer-events: none;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            
   position: relative;
            z-index: 1;
            flex-shrink: 0;
    <?php
        if (session('mode') == 'dark') {
              echo 'box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);';
        } else {
          
            echo 'border:1px solid white; ';
        }   
    ?>

         
        }

        .sidebar.collapsed .sidebar-logo {
            margin-right: 0;
        }

        .sidebar-logo svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .sidebar-title {
            font-weight: 700;
            font-size: 1.1rem;
       
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
            opacity: 1;
            transition: opacity 0.2s ease;
             color:white;
        }

        .sidebar.collapsed .sidebar-title {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        /* Navigation Links */
        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-link {
            padding: 1rem 1.5rem;
           

        
            font-weight: 500;
            border-radius: 12px;
            margin: 0.25rem 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            white-space: nowrap;
            position: relative;
            backdrop-filter: blur(10px);
            text-decoration: none;
                 <?php
        if (session('mode') == 'dark') {
              echo 'color: white;';
        } else {
          
            echo 'color: #333;';
        }   
    ?>
        }

        .sidebar.collapsed .nav-link {
            margin: 0.25rem 0.5rem;
            padding: 1rem 0.75rem;
            justify-content: center;
        }

      

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
                    <?php
        if (session('mode') == 'dark') {
              echo 'color: white;';
        } else {
          
            echo 'color: #333;';
        }   
    ?>
        }

        .sidebar.collapsed .nav-link:hover {
            transform: none;
        }

        .nav-link:hover::before {
            height: 20px;
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.9) 0%, rgba(59, 130, 246, 0.8) 100%);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.4);
            transform: translateX(4px);
        }

        .sidebar.collapsed .nav-link.active {
            transform: none;
        }

        .nav-link.active::before {
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
        }

        .nav-link svg {
            margin-right: 14px;
            width: 22px;
            height: 22px;
            opacity: 0.9;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .sidebar.collapsed .nav-link svg {
            margin-right: 0;
        }

        .nav-link:hover svg,
        .nav-link.active svg {
            opacity: 1;
            transform: scale(1.1);
        }

        .nav-link-text {
            opacity: 1;
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed .nav-link-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        /* Main navbar */
        
        .main-navbar {
   
    box-shadow:
        0 0 10px rgba(37, 99, 235, 0.6), /* blue glow around */
        0 2px 20px rgba(0, 0, 0, 0.08);  /* subtle shadow */;
    height: 75px;
    position: fixed;
    top: 0;
    right: 0;
    left: 280px;
    z-index: 1030;
    transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(10px);
 <?php
        if (session('mode') == 'dark') {
            echo 'background: linear-gradient(135deg, rgb(33, 90, 213) 0%, rgb(31, 88, 179) 100%);';
            echo 'color: white;';
        } else {
            echo 'background: white;';
            echo 'color: #333;';
        }   
    ?>
} 


        .sidebar.collapsed ~ .main-navbar {
            left: 70px;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem; 
            letter-spacing: 0.5px;
               pointer-events: none;
            <?php
             echo session('mode') == 'dark'
        ? '  color: white;'
        : '  color: #333;';
?>
        }

        .navbar-brand img {
            height: 36px;
            margin-right: 12px;
        }

        /* Main content */
        .main-content {
            margin-left: 280px;
            padding: 95px 30px 30px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }

        /* Toggle Button */
        #sidebarToggle {
            background: none;
            border: none;
            padding: 12px;
         
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
               <?php
            echo session('mode') == 'dark'
        ? ' color: white;'
        : '  color: #333;';
?>
        }

        #sidebarToggle:hover {
         
            background: rgba(37, 99, 235, 0.1);
            transform: scale(1.05);
        }

        #sidebarToggle svg {
            width: 24px;
            height: 24px;
        }

        /* Clock */
    
.clock-display {
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-size: 1rem;
    padding: 0.75rem 1.25rem;
    background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    letter-spacing: 0.3px;
    font-weight: 600;
    color: #1f2937; /* dark slate */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    display: inline-block;
    min-width: 100px;
    text-align: center;
    transition: all 0.3s ease;
}

.clock-display:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

 

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                margin-left: -280px;
            }
            
            .sidebar.collapsed {
                margin-left: 0;
                width: 280px;
            }
            
            .sidebar.collapsed .nav-link-text,
            .sidebar.collapsed .sidebar-title {
                opacity: 1;
                width: auto;
                overflow: visible;
            }

            .sidebar.collapsed .nav-link {
                margin: 0.25rem 1rem;
                padding: 1rem 1.5rem;
                justify-content: flex-start;
            }

            .sidebar.collapsed .nav-link svg {
                margin-right: 14px;
            }

            .sidebar.collapsed .sidebar-header {
                padding: 2rem 1.5rem;
                justify-content: flex-start;
            }

            .sidebar.collapsed .sidebar-logo {
                margin-right: 12px;
            }
            
            .main-navbar,
            .main-content {
                left: 0;
                margin-left: 0;
            }
            
            .sidebar.collapsed ~ .main-navbar,
            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
            }
        }

        /* Scrollbar styling for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="{{ session('mode', 'light') }}-mode">


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
            <span class="sidebar-title">ADMIN PANEL</span>
        </div>
        
        <nav class="sidebar-nav">
            <a class="nav-link {{ Request::is('AdminDashboard') ? 'active' : '' }}" href="{{ route('Main') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="9"></rect>
                    <rect x="14" y="3" width="7" height="5"></rect>
                    <rect x="14" y="12" width="7" height="9"></rect>
                    <rect x="3" y="16" width="7" height="5"></rect>
                </svg>
                <span class="nav-link-text">Dashboard</span>
            </a>

            <a class="nav-link {{ Request::is('mainOffice') ? 'active' : '' }}" href="{{ url('mainOffice') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
                <span class="nav-link-text">Office Management</span>
            </a>



<a class="nav-link {{ Request::is('rating-history') ? 'active' : '' }}" href="{{ url('rating-history') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
         viewBox="0 0 24 24" fill="none" stroke="currentColor"
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="3 17 9 11 13 15 21 7"></polyline>
        <circle cx="3" cy="17" r="1"></circle>
        <circle cx="9" cy="11" r="1"></circle>
        <circle cx="13" cy="15" r="1"></circle>
        <circle cx="21" cy="7" r="1"></circle>
    </svg>
    <span class="nav-link-text">Quarterly Rating</span>
</a>



<a class="nav-link {{ Request::is('Admin/OverallRating') ? 'active' : '' }}" href="{{ route('SQDDashboard') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
         viewBox="0 0 24 24" fill="none" stroke="currentColor"
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 3v18h18" />
        <rect x="6" y="14" width="2" height="4" />
        <rect x="10" y="10" width="2" height="8" />
        <rect x="14" y="6" width="2" height="12" />
    </svg>
    <span class="nav-link-text">SQD Rating</span>
</a>



            <a class="nav-link {{ Request::is('Admin/Surveys') ? 'active' : '' }}" href="{{ route('survey.responses') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 22V8M22 12l-4-4-4 4M6 2v14M2 12l4 4 4-4"></path>
                </svg>
                <span class="nav-link-text">Surveys</span>
            </a>
         <a class="nav-link {{ Request::is('Admin/valid-survey') ? 'active' : '' }}" href="{{ route('valid_surveys') }}">
    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 7H20C21.1 7 22 7.9 22 9V19C22 20.1 21.1 21 20 21H4C2.9 21 2 20.1 2 19V9C2 7.9 2.9 7 4 7Z" stroke="currentColor" stroke-width="1.5"/>
        <path d="M16 7V5C16 3.9 15.1 3 14 3H10C8.9 3 8 3.9 8 5V7" stroke="currentColor" stroke-width="1.5"/>
        <path d="M2 12H22" stroke="currentColor" stroke-width="1.5"/>
    </svg>

    <span class="nav-link-text">Valid Service</span>
</a>



            <a class="nav-link {{ Request::is('Admin/Analytics') ? 'active' : '' }}" href="{{ route('survey_analytics') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                <span class="nav-link-text">Analytics</span>
            </a>

          <a class="nav-link {{ (Request::is('reports_view') || Request::is('reports')) ? 'active' : '' }}" href="{{ route('AdminReports') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span class="nav-link-text">Reports</span>
            </a>

            <a class="nav-link {{ Request::is('Admin/requests') ? 'active' : '' }}" href="{{ route('requests.manage') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span class="nav-link-text">Requests</span>
            </a>

            <a class="nav-link {{ Request::is('accounts/activation-status') ? 'active' : '' }}" href="{{ route('account_list') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span class="nav-link-text">Accounts</span>
            </a>

            <a class="nav-link {{ Request::is('Admin/Recent-Activities') ? 'active' : '' }}" href="{{ route('recent_activities') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
                <span class="nav-link-text">Activity</span>
            </a>
        </nav>
    </div>

    <!-- Navbar -->
    <nav class="main-navbar navbar navbar-expand">
        <div class="container-fluid">
            <button id="sidebarToggle" class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <!-- <div class="avatar-wrapper me-2">
            <img src="{{ asset('logo.png') }}" alt="User" class="user-avatar">
        </div> -->
            <div class="navbar-brand d-none d-lg-block  " 
            style="font-family:sans-serif;
       
            font-family:Verdana, Geneva, Tahoma, sans-serif ">
               SCHOOLS DIVISION OFFICE - SAN CARLOS CITY
            </div>
            
            <div class="ms-auto d-flex align-items-center">
                <!-- <div class="clock-display me-3" id="realtimeClock"></div> -->
                
              <div class="dropdown">


    <button class="user-dropdown-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="avatar-wrapper">
            <img src="{{ asset('avatar.svg') }}" alt="User" class="user-avatar">
        </div>

        <!-- <div class="user-text">
            <div class="name">Norman  A. Flores</div>
            <div class="email">SDO SCC - Admin</div>
        </div> -->

      
    </button>


    <div class="dropdown-menu dropdown-menu-end user-dropdown-menu">
        <div class="user-info">
            <img src="{{ asset('avatar.svg') }}" alt="Avatar">
            <div>
                <div class="name">Norman A. Flores</div>
                <div class="email">IT Officer - Administrator</div>
            </div>
        </div>

        

        <a class="dropdown-item" href="{{ route('Main') }}">  Dashboard</a>
        <a class="dropdown-item" href="{{ route('overview') }}">  Visit Form</a>
        <a class="dropdown-item" href="{{ route('landing_page') }}">  Open Page</a>
       <div class="dropdown-item d-flex justify-content-between align-items-center">
    <span>Dark Mode</span>
    <form action="{{ session('mode') == 'dark' ? route('change_mode_light') : route('change_mode_dark') }}" method="GET">
        <label class="switch">
            <input type="checkbox" onchange="this.form.submit()" {{ session('mode') == 'dark' ? 'checked' : '' }}>
            <span class="slider round"></span>
        </label>
    </form>
</div>
<style>
    /* Toggle Switch Style */
.switch {
  position: relative;
  display: inline-block;
  width: 44px;
  height: 24px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0;
  right: 0; bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px; width: 18px;
  left: 3px; bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:checked + .slider:before {
  transform: translateX(20px);
}

</style>
        <hr class="dropdown-divider">

        <a class="dropdown-item " href="{{ url('logout') }}">  Log Out</a>
    </div>
</div>
<style>
.user-dropdown-btn {
    display: flex;
    align-items: center;
    background: none;
    border: none;
    padding: 8px 12px;
    /* border-bottom: 2px solid var(--primary); */
    border-radius: 12px;
    border-bottom-right-radius: 0; /* removes radius on bottom-right corner */
    cursor: pointer;
    border-bottom-left-radius: 0;  /* removes radius on bottom-left corner */
    transition: background 0.3s ease;
    width: 100%;
}

.user-dropdown-btn:hover {
    background-color: rgba(0, 0, 0, 0.04);
}

.avatar-wrapper img.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.user-text {
    margin-left: 12px;
    margin-right: auto;
    text-align: left;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    line-height: 1.2;
    color: white;
}

.user-text .name {
    font-weight: bold; 
    
}

.user-text .email {
    font-size: 0.875rem; 
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.icon-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
}

.notification {
    position: relative;
    font-size: 1.2rem;
    color: #6b7280;
}

.notification .badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: #3b82f6;
    color: white;
    font-size: 0.7rem;
    padding: 2px 5px;
    border-radius: 999px;
    font-weight: bold;
}

.arrow {
    font-size: 1.1rem;
    color: #6b7280;
}

.user-dropdown-btn:hover {
    background-color: rgba(0, 0, 0, 0.05);
}

.user-avatar {
    border-radius: 50%;
    border: 2px solid white;
    width: 50px;
    height: 50px;
    box-shadow: 0 2px 6px rgba(37, 37, 37, 0.3); /* Sharper shadow */
}


.user-dropdown-menu {
    min-width: 280px;
    border: none;
    border-radius: 16px;
    
    
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    padding: 1rem;
    font-family: 'Inter', sans-serif;
    <?php
        if (session('mode') == 'dark') {
              echo 'background: rgba(22, 22, 22, 1);';
        } else {
          
            echo 'background: rgba(255, 255, 255, 0.95);';
        }   
    ?>
}

.user-info {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
       <?php
        if (session('mode') == 'dark') {
              echo 'color: #ffffff;';
        } else {
          
            echo 'color: #6b7280;';
        }   
    ?>
}

.user-info img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    margin-right: 12px;
}

.user-info .name {
    font-weight: 600;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 1rem;
      <?php
        if (session('mode') == 'dark') {
              echo 'color: #ffffff;';
        } else {
          
            echo 'color: #333;';
        }   
    ?>
}

.user-info .email {
    font-size: 0.875rem;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    
 
}

.theme-toggle {
    display: flex;
    justify-content: space-between;
    margin: 0.75rem 0;
    background: #f3f4f6;
    border-radius: 12px;
    padding: 4px;
}

.theme-btn {
    flex: 1;
    background: none;
    border: none;
    padding: 6px 0;
    border-radius: 10px;
    font-size: 1.1rem;
    color: #6b7280;
    transition: 0.3s;
}

.theme-btn.active,
.theme-btn:hover {
    background: white;
    color: #4f46e5;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.6rem 0.75rem;
    font-size: 0.95rem;
    font-weight: 500;
    

     
    border-radius: 10px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    transition: 0.2s ease;
      <?php
        if (session('mode') == 'dark') {
              echo 'color: #ffffff;';
        } else {
          
            echo 'color: #374151;';
        }   
    ?>
}

.dropdown-item i {
    font-size: 1.1rem;
    margin-right: 12px;
}

.dropdown-item:hover {
    background: rgba(37, 99, 235, 0.06);
    color: #2563eb;
}

.dropdown-divider {
    margin: 0.75rem 0;
    border-top: 1px solid #e5e7eb;
}

</style>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="main-content" id="content">
        @yield('content')
    </div>

    <script>
        // Toggle sidebar functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        });
        
      
        // Handle navigation link clicks
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all links
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
            });
        });
        
        // Responsive behavior
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 992) {
                // On mobile, reset collapsed state when window is resized
                if (sidebar.classList.contains('collapsed')) {
                    // Keep collapsed class for mobile slide-in behavior
                } else {
                    sidebar.classList.remove('collapsed');
                }
            }
        }
        
        window.addEventListener('resize', handleResize);
        window.addEventListener('load', handleResize);
    </script>
</body>
</html>