 
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
            --primary: #2563eb;       /* Royal blue */
            --primary-light: #dbeafe; /* Light blue */
            --secondary: #475569;     /* Slate gray */
            --accent: #0284c7;        /* Sky blue */
            --success: #10b981;       /* Emerald */
            --warning: #f59e0b;       /* Amber */
            --danger: #ef4444;        /* Red */
            --light: #f8fafc;         /* Very light gray */
            --dark: #0f172a;          /* Dark slate blue */
            --text-light: #e2e8f0;    /* Light text for dark backgrounds */
            --text-dark: #334155;     /* Dark text for light backgrounds */
            --border: #e2e8f0;        /* Light gray for borders */
            --hover: rgba(219, 234, 254, 0.3); /* Light blue for hover states - semitransparent */
            --sidebar-bg: #1e293b;    /* Dark blue slate */
            --navbar-bg: #ffffff;     /* White */
            --active-bg: rgba(59, 130, 246, 0.15); /* Subtle blue highlight */
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f5f9;
            color: var(--text-dark);
        }
 
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            background: var(--sidebar-bg);
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1040;
            overflow-y: auto;
            overflow-x: hidden;
            color: var(--text-light);
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.15);
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar .nav-link {
            padding: 0.9rem 1.25rem;
            color: var(--text-light);
            font-weight: 500;
            border-radius: 8px;
            margin: 0.25rem 0.75rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .sidebar .nav-link.active {
            background-color: var(--primary);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(37, 99, 235, 0.3);
        }

        .sidebar .nav-link svg {
            margin-right: 12px;
            width: 20px;
            height: 20px;
            opacity: 0.85;
        }

        .sidebar-collapse {
            background-color: rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            margin: 0 0.75rem;
        }

        .collapse-icon {
            transition: transform 0.3s;
        }

        [aria-expanded="true"] .collapse-icon {
            transform: rotate(180deg);
        }

        /* Main navbar */
        .main-navbar {
            background-color: var(--navbar-bg);
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.08);
            height: 70px;
            position: fixed;
            top: 0;
            right: 0;
            left: 260px;
            z-index: 1030;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary);
            letter-spacing: 0.5px;
        }

        .navbar-brand img {
            height: 36px;
            margin-right: 12px;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 90px 30px 30px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Toggle Button */
        #sidebarToggle {
            background: none;
            border: none;
            padding: 10px;
            color: var(--secondary);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        #sidebarToggle:hover {
            color: var(--primary);
        }

        #sidebarToggle svg {
            width: 24px;
            height: 24px;
        }

        /* Clock */
        .clock-display {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            background-color: var(--light);
            border-radius: 6px;
            border: 1px solid var(--border);
            letter-spacing: 0.5px;
            font-weight: 500;
            color: var(--dark);
        }

        /* User menu */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            background-color: var(--primary-light);
            object-fit: cover;
        }

        .user-dropdown-btn {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            padding: 6px;
            border-radius: 30px;
            transition: all 0.2s;
        }

        .user-dropdown-btn:hover {
            background-color: var(--hover);
        }

        .user-dropdown-menu {
            padding: 0.5rem 0;
            min-width: 200px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .user-dropdown-menu .dropdown-item {
            padding: 0.6rem 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .user-dropdown-menu .dropdown-item svg {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .user-dropdown-menu .dropdown-item:hover {
            background-color: var(--hover);
            color: var(--primary);
        }

        /* Responsive adjustments */
        .sidebar.collapsed {
            width: 70px;
            overflow-x: hidden;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .sidebar-header span {
            display: none;
            opacity: 0;
            visibility: hidden;
            white-space: nowrap;
        }

        .sidebar.collapsed ~ .main-navbar {
            left: 70px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 992px) {
            .sidebar {
                margin-left: -260px;
            }
            
            .sidebar.collapsed {
                margin-left: 0;
                width: 260px;
            }
            
            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .sidebar-header span {
                display: inline;
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
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" height="36" class="me-2">
            <span class="fw-semibold">SDO-SCC Admin</span>
        </div>
        
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Main') ? 'active' : '' }}" href="{{ route('Main') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9"></rect>
                        <rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect>
                        <rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('mainOffice') ? 'active' : '' }}" href="{{ url('mainOffice') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    <span>Office Management</span>
                </a>
            </li>
            <li class="nav-item">
              
              
                        <a class="nav-link {{ Request::is('Admin/Surveys') ? 'active' : '' }}" href="{{ route('survey.responses') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 22V8M22 12l-4-4-4 4M6 2v14M2 12l4 4 4-4"></path>
                            </svg>
                            <span>Surveys</span>
                        </a>
                        <a class="nav-link {{ Request::is('Admin/Analytics') ? 'active' : '' }}" href="{{ route('survey_analytics') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="20" x2="18" y2="10"></line>
                                <line x1="12" y1="20" x2="12" y2="4"></line>
                                <line x1="6" y1="20" x2="6" y2="14"></line>
                            </svg>
                            <span>Analytics</span>
                        </a>
                   
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('reports_view') ? 'active' : '' }}" href="{{ route('AdminReports') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('requests.manage') ? 'active' : '' }}" href="{{ route('requests.manage') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account_list') ? 'active' : '' }}" href="{{ route('account_list') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Accounts</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('recent_activities') ? 'active' : '' }}" href="{{ route('recent_activities') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                    <span>Activity</span>
                </a>
            </li>
        </ul>
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
            <div class="navbar-brand d-none d-lg-block   " 
            style="font-family:sans-serif;
            color:#495057;
            font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            
            ">
               SCHOOLS DIVISION OFFICE - SAN CARLOS CITY
            </div>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="clock-display me-3" id="realtimeClock"></div>
                
                <div class="dropdown">
                    <button class="user-dropdown-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('avatar.svg') }}" alt="User" class="user-avatar me-md-2">
                        <span class="d-none d-md-inline fw-medium ms-2">Admin</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ms-1" style="width: 16px; height: 16px;">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu shadow" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('Main') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="9"></rect>
                                    <rect x="14" y="3" width="7" height="5"></rect>
                                    <rect x="14" y="12" width="7" height="9"></rect>
                                    <rect x="3" y="16" width="7" height="5"></rect>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('logout') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

    <!-- Content -->
    <div class="main-content" id="content">
        @yield('content')
    </div>

    <script>
        // Toggle sidebar with smooth transition
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            
            // Ensure text opacity changes are timed with the transition
            const navTexts = document.querySelectorAll('.sidebar .nav-link span, .sidebar-header span');
            if (sidebar.classList.contains('collapsed')) {
                navTexts.forEach(text => {
                    text.style.opacity = '0';
                    text.style.visibility = 'hidden';
                });
            } else {
                setTimeout(() => {
                    navTexts.forEach(text => {
                        text.style.opacity = '1';
                        text.style.visibility = 'visible';
                    });
                }, 50);
            }
        });
        
        // Real-time clock
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';

            // Convert hours from 24-hour to 12-hour format and pad with 0
            hours = hours % 12 || 12;
            hours = String(hours).padStart(2, '0');

            document.getElementById('realtimeClock').textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
        }
        
        // Initialize clock
        updateClock();
        setInterval(updateClock, 1000);
        
        // Handle responsive behavior
        function checkWidth() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 992) {
                sidebar.classList.remove('collapsed');
                // Reset any inline styles that might have been applied
                const navTexts = document.querySelectorAll('.sidebar .nav-link span, .sidebar-header span');
                navTexts.forEach(text => {
                    text.style.opacity = '1';
                    text.style.visibility = 'visible';
                });
            }
        }
        
        // Check on load and resize
        window.addEventListener('load', checkWidth);
        window.addEventListener('resize', checkWidth);
    </script>
</body>
</html>


