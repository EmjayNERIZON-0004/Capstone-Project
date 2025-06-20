<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schools Division Office - Customer Satisfaction Measurement System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-color: #60a5fa;
            --light-blue: #dbeafe;
            --dark-color: #1e3a8a;
            --secondary-color: #bfdbfe;

            --dark-blue: #1e3a8a;
            --accent-blue: #60a5fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:rgb(255, 255, 255);
            min-height: 100vh;
        }

        .navbar {
            background:#1e3a8a;
            backdrop-filter: none;
            box-shadow: none;
            border-bottom: none;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 15px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: white;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        .hero-section {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(30, 64, 175, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            line-height: 1.2;
            margin-bottom: 2rem;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--dark-blue);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero-description {
            font-size: 1.1rem;
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 3rem;
        }

        .btn-get-started {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-get-started:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(30, 64, 175, 0.4);
            color: white;
        }

        .btn-get-started::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%);
            transition: left 0.5s ease;
        }

        .btn-get-started:hover::before {
            left: 100%;
        }

        .price-tag {
            background: white;
            border: 2px solid var(--secondary-blue);
            border-radius: 20px;
            padding: 15px 25px;
            box-shadow: 0 10px 30px rgba(30, 64, 175, 0.1);
            display: inline-block;
            margin-bottom: 2rem;
            animation: float 3s ease-in-out infinite;
        }

        .price-tag .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
        }

        .price-tag .period {
            font-size: 0.9rem;
            color: #6b7280;
            margin-left: 5px;
        }

        .hero-image {
            position: relative;
            border-radius: 50%;
            /* animation: float 6s ease-in-out infinite; */
        }

        .hero-image img {
            border-radius: 50%;
            box-shadow: 0 25px 60px rgba(30, 64, 175, 0.15);
            transition: all 0.3s ease;
        }

        .hero-image:hover img {
            transform: scale(1.02);
            box-shadow: 0 30px 70px rgba(30, 64, 175, 0.2);
        }

        .floating-card {
            position: absolute;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 15px 40px rgba(30, 64, 175, 0.1);
            animation: float 4s ease-in-out infinite;
        }

        .floating-card.satisfaction {
            top: 20%;
            right: -50px;
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            color: white;
        }

        .floating-card.rating {
            bottom: 30%;
            left: -40px;
            background: white;
            border: 2px solid var(--light-blue);
        }

        .stats-section {
            background: var(--primary-blue);
            color: white;
            padding: 80px 0;
            margin-top: 100px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            display: block;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .features-section {
            padding: 100px 0;
            background: white;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid rgba(30, 64, 175, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(30, 64, 175, 0.15);
            border-color: var(--secondary-blue);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 2rem;
            color: white;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .floating-card {
                display: none;
            }
            
            .hero-section {
                padding: 80px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <!-- Include Bootstrap CSS (v5) in your <head> if not already done -->
<!-- Example: <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<style>
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }
 

  .nav-link, .navbar-brand, .navbar-toggler {
    color: white !important;
  }

  .nav-link:hover {
    color: #ddd !important;
  }
</style>
<!-- Floating Assistant Button -->
  <a href="/SDO-SCC-Assistant" id="assistantBtn" title="Need Help? Chat with our AI Assistant" role="button" aria-label="Open chat assistant">
       <svg class="chat-icon"  width="80px" height="80px" viewBox="0 -77.5 1179 1179" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M597.215632 994.574713h403.714943s43.549425-8.945287 43.549425-114.64092 94.16092-577.677241-459.976092-577.677241-457.151264 541.425287-457.151264 541.425287-25.423448 160.77977 54.848735 157.013333 415.014253-6.12046 415.014253-6.120459z" fill="#06a24a"></path><path d="M1071.786667 712.798161h72.503908v136.297931h-72.503908zM36.016552 712.798161h72.503908v136.297931H36.016552z" fill="#ffffff"></path><path d="M305.68366 559.40926l556.254412-1.165018 0.398364 190.20464-556.254412 1.165018-0.398364-190.20464Z" fill="#ffffff"></path><path d="M1129.931034 680.312644h-59.556781c-3.295632-152.069885-67.56046-258.942529-172.079081-324.384368l115.347127-238.462529a47.08046 47.08046 0 1 0-42.372414-20.48l-114.640919 236.57931a625.934713 625.934713 0 0 0-269.30023-53.200919 625.228506 625.228506 0 0 0-270.006437 54.848736l-115.817931-235.402299a47.08046 47.08046 0 1 0-42.372414 20.715402l117.701149 238.462529c-103.812414 65.441839-167.135632 173.02069-169.960459 324.61977H47.786667a47.08046 47.08046 0 0 0-47.08046 47.08046v117.701149a47.08046 47.08046 0 0 0 47.08046 47.08046h58.615172v57.908965a70.62069 70.62069 0 0 0 70.62069 70.62069l823.908046-1.647816a70.62069 70.62069 0 0 0 70.620689-70.62069v-57.908965h59.085977a47.08046 47.08046 0 0 0 47.08046-47.08046v-117.701149A47.08046 47.08046 0 0 0 1129.931034 680.312644zM94.16092 847.212874H47.08046v-117.70115h47.08046v117.70115z m929.83908 103.106206a23.54023 23.54023 0 0 1-23.54023 23.54023l-823.908046 1.647816a23.54023 23.54023 0 0 1-23.54023-23.540229v-258.942529c0-329.563218 303.668966-365.57977 434.788046-365.815173s435.494253 34.604138 436.20046 363.931954z m105.46023-105.224827h-47.08046v-117.70115h47.08046v117.70115z" fill="#ffffff"></path><path d="M464.684138 135.827126l22.363218-19.53839 40.018391 62.381609a30.131494 30.131494 0 0 0 25.423448 13.888735h2.824828a30.131494 30.131494 0 0 0 25.188046-19.067586l20.715402-79.095172 21.186207 74.387126v2.118621a30.366897 30.366897 0 0 0 52.494713 6.826667l30.366896-57.202759 13.182529 12.947126a30.131494 30.131494 0 0 0 21.186207 8.709886h57.673563a23.54023 23.54023 0 0 0 23.54023-23.54023 23.54023 23.54023 0 0 0-23.54023-23.54023h-50.140689l-23.54023-23.54023a30.366897 30.366897 0 0 0-45.668046 3.766437l-21.42161 40.01839L629.465747 19.302989a30.131494 30.131494 0 0 0-28.012873-19.067587 30.131494 30.131494 0 0 0-28.012874 19.067587l-26.60046 101.693793-29.660689-47.08046a30.366897 30.366897 0 0 0-20.48-13.653333 30.837701 30.837701 0 0 0-23.54023 6.826666l-32.250115 28.248276h-60.027586a23.54023 23.54023 0 0 0-23.54023 23.54023 23.54023 23.54023 0 0 0 23.54023 23.54023h66.148046a31.308506 31.308506 0 0 0 17.655172-6.591265zM776.121379 532.950805H404.421149A121.232184 121.232184 0 0 0 282.482759 639.352644a117.701149 117.701149 0 0 0 117.701149 129.000459h371.70023a121.232184 121.232184 0 0 0 121.938391-106.401839 117.701149 117.701149 0 0 0-117.70115-129.000459z m0 188.321839H402.302529a72.503908 72.503908 0 0 1-72.268506-56.496552 70.62069 70.62069 0 0 1 68.972874-84.744828h373.81885a72.503908 72.503908 0 0 1 72.268506 56.496552 70.62069 70.62069 0 0 1-68.502069 84.744828z" fill="#ffffff"></path></g></svg>
        <div class="notification-dot"></div>
        <div class="message-bubble">Need help? I'm here!</div>
    </a>

    <script>
        // Add some interactive behavior
        document.addEventListener('DOMContentLoaded', function() {
            const assistantBtn = document.getElementById('assistantBtn');
            
            // Remove notification dot after first interaction
            assistantBtn.addEventListener('click', function() {
                const dot = this.querySelector('.notification-dot');
                if (dot) {
                    dot.style.animation = 'none';
                    dot.style.opacity = '0';
                    setTimeout(() => dot.remove(), 300);
                }
            });
            
            // Add ripple effect on click
            assistantBtn.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    left: 50%;
                    top: 50%;
                    width: 20px;
                    height: 20px;
                    margin-left: -10px;
                    margin-top: -10px;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
            
            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>

<!-- Styles -->
<style>
    #assistantBtn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg,rgb(25, 153, 238) 0%,rgb(5, 72, 174) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 8px 32px rgba(102, 126, 234, 0.3),
                0 4px 16px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            text-decoration: none;
            z-index: 9999;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: 2px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            animation: float 3s ease-in-out infinite;
        }

        #assistantBtn::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50%;
                  background: linear-gradient(135deg,rgb(25, 153, 238) 0%,rgb(5, 72, 174) 100%);

            background-size: 200% 200%;
            z-index: -1;
            animation: borderGlow 2s linear infinite;
        }

        #assistantBtn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        #assistantBtn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 
                0 16px 48px rgba(102, 126, 234, 0.4),
                0 8px 24px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        #assistantBtn:active {
            transform: translateY(-2px) scale(1.02);
        }

        .chat-icon {
            width: 45px;
            height: 45px;
            fill: white;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
            transition: transform 0.2s ease;
        }

        #assistantBtn:hover .chat-icon {
            transform: scale(1.1);
        }

        /* Notification dot */
        .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 12px;
            height: 12px;
            background:rgb(71, 255, 99);
            border-radius: 50%;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

        /* Message bubble animation */
        .message-bubble {
            position: absolute;
            top: -40px;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 16px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .message-bubble::after {
            content: '';
            position: absolute;
            bottom: -6px;
            right: 16px;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid rgba(0, 0, 0, 0.8);
        }

        #assistantBtn:hover .message-bubble {
            opacity: 1;
            transform: translateY(0);
        }

        /* Breathing animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        @keyframes pulse {
            0% { 
                transform: scale(1);
                opacity: 1;
            }
            50% { 
                transform: scale(1.2);
                opacity: 0.7;
            }
            100% { 
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes borderGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Responsive design */
       

       
        /* Accessibility */
        

     
</style>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <!-- <img src="logo.png" alt="SDO Logo" height="40" class="me-3"> -->
       
      <span>Schools Division Office</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Our Services</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <!-- <div class="price-tag">
                        <i class="fas fa-chart-line text-primary me-2"></i>
                        <span class="price">Free Access</span>
                        <span class="period">for all schools</span>
                    </div> -->
                    
                    <h1 class="hero-title">
                        We enhance
                        <span class="text-primary">education quality</span>
                        through feedback
                    </h1>
                    
                    <h2 class="hero-subtitle">Customer Satisfaction Measurement System</h2>
                    
                    <p class="hero-description">
                        Transform educational experiences through comprehensive feedback collection and analysis. 
                        Our advanced measurement system empowers schools to understand stakeholder satisfaction 
                        and drive continuous improvement in educational services.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <button class="btn btn-get-started">
                            <i class="fas fa-rocket me-2"></i>
                            Get Started
                        </button>
                        <div class="text-muted">
                            <small><i class="fas fa-users me-1"></i> Trusted by 46 schools</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5">
                    <div class="hero-image position-relative">
                        <img src="{{asset('logo.png')}}" 
                             alt="Educational Dashboard" class="img-fluid">
                        
                        <!-- Floating Cards -->
                     
                    </div>
                </div>
            </div>
        </div>
    </section>

<style>
           .custom-card {
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                border-top: 4px solid var(--accent-color);
            }
        
        .welcome-card {
            background-image: linear-gradient(to bottom right, white, var(--secondary-color));
            position: relative;
            overflow: hidden;
        }
        
</style>
     <div class="card custom-card welcome-card mb-4" style="margin: 0 10px;">
            <div class="card-body">
                <h2 class="card-title text-primary">Welcome to our Customer Satisfaction Portal</h2>
                <p>The Schools Division Office is committed to providing excellent service to our stakeholders. Your feedback helps us improve our services and operations.</p>
                <p>Please use our interactive chatbot or scan the QR code to provide your valuable feedback about our services.</p>
            </div>
        </div>


    <div class="card  welcome-card  "  style="margin: 0 10px;">
    <div class="card-body">
        <div class="row align-items-center justify-content-between">
            <!-- Left Side: Logo + Text + QR Code -->
            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                <div class="d-flex flex-column flex-lg-row align-items-center text-center text-lg-start">
                    <!-- Logo -->
                    <div class="me-lg-4 mb-4 mb-lg-0 d-none d-md-block">
                        <img src="{{ asset('logo.png') }}" alt="SDO Logo" class="img-fluid" style="max-height: 140px;">
                    </div>
                    <!-- Text + QR -->
                    <div>
                        <h2 class="display-6 fw-bold mb-1" style="color: var(--dark-blue);">HOW WAS YOUR</h2>
                        <h2 class="display-6 fw-bold mb-1" style="color: var(--secondary-blue);">EXPERIENCE</h2>
                        <h2 class="display-6 fw-bold mb-3" style="color: var(--dark-blue);">TODAY?</h2>

                        <p class="lead mb-2" style="color: var(--dark-color);">Your feedback helps us improve!</p>
                        <p class="fw-semibold" style="color: var(--primary-blue);">
                            Please scan the QR code and rate your experience.
                        </p>

                      
                    </div>
                      <div class="qr-section text-center p-3 mt-3">
                            <h6 class="fw-semibold mb-2">SDO SAN CARLOS CITY<br>PANGASINAN - R1</h6>
                            <a href="http://127.0.0.1:8000/CSM-SDO-SCC-Survey/Overview" target="_blank">
                                <div class="qr-code mx-auto mb-2">
                                    <img src="{{ asset('qr-code.png') }}" alt="QR Code" class="img-fluid">
                                </div>
                            </a>
                            <small>Client Satisfaction Measurement</small>
                        </div>
                </div>
            </div>

            <!-- Right Side: Carousel -->
          <!-- Right Side: Carousel -->
<div class="col-lg-6 col-md-12 mt-4 mt-lg-0">
    <div id="educationCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow-sm">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7" class="d-block w-100" alt="Filipino Students in Classroom">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643" class="d-block w-100" alt="Philippine Public School Students">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b" class="d-block w-100" alt="DepEd Students Learning">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#educationCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#educationCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

        </div>
    </div>
</div>
<style>
    .text-purple {
    color: var(--secondary-blue);
}

.qr-section {
    background-color: var(--dark-color);
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.qr-code {
    max-width: 150px;
    background-color: white;
    padding: 8px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.carousel-inner img {
    object-fit: cover;
    height: 100%;
    max-height: 350px;
    border-radius: 10px;
}

@media (max-width: 767.98px) {
    .welcome-card h2,
    .welcome-card h5,
    .welcome-card p {
        text-align: center !important;
    }

    .qr-section {
        margin-top: 1rem;
    }

    .carousel-inner img {
        max-height: 250px;
    }
}

</style>

<!-- Schools Division Office Organization Section -->
<section id="organization" class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="fw-bold text-primary">Schools Division Office Organization</h2>
                <p class="lead text-muted">Meet our dedicated team of education leaders</p>
            </div>
        </div>
<style>
    .rounded-circle{
        width: 100px;
        height: 100px;
    }
</style>
        <!-- Schools Division Superintendent -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <img src="{{asset('logo.png')}}" 
                                 class="rounded-circle mb-3" alt="Schools Division Superintendent">
                        </div>
                        <h5 class="card-title fw-bold text-primary">Name Placeholder</h5>
                        <h6 class="card-subtitle mb-2 text-success fw-semibold">Schools Division Superintendent</h6>
                        <p class="card-text text-muted small">Office of the Schools Division Superintendent</p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Leadership</span>
                            <span class="badge bg-secondary">Policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assistant Schools Division Superintendents -->
        <div class="row mb-5">
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <img src="{{asset('logo.png')}}" 
                                 class="rounded-circle mb-3" alt="ASDS">
                        </div>
                        <h5 class="card-title fw-bold text-primary">Name Placeholder</h5>
                        <h6 class="card-subtitle mb-2 text-success fw-semibold">Assistant Schools Division Superintendent</h6>
                        <p class="card-text text-muted small">Curriculum and Instruction Division</p>
                        <div class="mt-3">
                            <span class="badge bg-success">Curriculum</span>
                            <span class="badge bg-info">Instruction</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <img src="{{asset('logo.png')}}" 
                                 class="rounded-circle mb-3" alt="ASDS">
                        </div>
                        <h5 class="card-title fw-bold text-primary">Name Placeholder</h5>
                        <h6 class="card-subtitle mb-2 text-success fw-semibold">Assistant Schools Division Superintendent</h6>
                        <p class="card-text text-muted small">School Governance and Operations Division</p>
                        <div class="mt-3">
                            <span class="badge bg-warning">Operations</span>
                            <span class="badge bg-dark">Governance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Division Chiefs -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <h3 class="text-center fw-bold text-secondary mb-4">Division Chiefs & Section Heads</h3>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <img src="{{asset('logo.png')}}" 
                             class="rounded-circle mb-2" alt="Finance Officer">
                        <h6 class="card-title fw-bold text-primary mb-1">Name</h6>
                        <p class="card-subtitle text-success fw-semibold mb-1 small">Position</p>
                        <p class="card-text text-muted" style="font-size: 0.8rem;">Office</p>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <img src="{{asset('logo.png')}}" 
                             class="rounded-circle mb-2" alt="Finance Officer">
                        <h6 class="card-title fw-bold text-primary mb-1">Name</h6>
                        <p class="card-subtitle text-success fw-semibold mb-1 small">Position</p>
                        <p class="card-text text-muted" style="font-size: 0.8rem;">Office</p>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <img src="{{asset('logo.png')}}" 
                             class="rounded-circle mb-2" alt="Finance Officer">
                        <h6 class="card-title fw-bold text-primary mb-1">Name</h6>
                        <p class="card-subtitle text-success fw-semibold mb-1 small">Position</p>
                        <p class="card-text text-muted" style="font-size: 0.8rem;">Office</p>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <img src="{{asset('logo.png')}}" 
                             class="rounded-circle mb-2" alt="Finance Officer">
                        <h6 class="card-title fw-bold text-primary mb-1">Name</h6>
                        <p class="card-subtitle text-success fw-semibold mb-1 small">Position</p>
                        <p class="card-text text-muted" style="font-size: 0.8rem;">Office</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <!-- <div class="row mt-5">
            <div class="col-lg-12 text-center">
                <div class="card bg-primary text-white">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Get in Touch with Our Team</h5>
                        <p class="card-text">For inquiries and assistance, please contact the appropriate division or unit.</p>
                        <a href="#contact" class="btn btn-light btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- SDO San Carlos City Header -->

    </div>
</section>
    <!-- Features Section -->
    <section class="features-section" id="services">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold text-primary mb-4">Our Services</h2>
                    <p class="lead text-muted">Comprehensive tools and services designed to measure and improve educational satisfaction</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-poll"></i>
                        </div>
                        <h4 class="mb-3 text-primary">Survey Management</h4>
                        <p class="text-muted">Create, distribute, and manage comprehensive satisfaction surveys for students, parents, and staff with customizable templates.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4 class="mb-3 text-primary">Analytics Dashboard</h4>
                        <p class="text-muted">Real-time insights and detailed analytics with interactive charts and reports to track satisfaction trends over time.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-3 text-primary">Stakeholder Engagement</h4>
                        <p class="text-muted">Multi-channel feedback collection from students, parents, teachers, and community members with automated reminders.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="mb-3 text-primary">Data Security</h4>
                        <p class="text-muted">Enterprise-grade security with encrypted data storage, secure access controls, and compliance with privacy regulations.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="mb-3 text-primary">Mobile Accessibility</h4>
                        <p class="text-muted">Responsive design ensuring seamless access across all devices - desktop, tablet, and mobile phones.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4 class="mb-3 text-primary">Custom Solutions</h4>
                        <p class="text-muted">Tailored measurement tools and reporting features designed specifically for your school's unique needs and requirements.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold text-primary mb-4">About Customer Satisfaction Measurement</h2>
                    <p class="lead mb-4">
                        Our Customer Satisfaction Measurement System is a comprehensive platform designed specifically for educational institutions to gather, analyze, and act upon stakeholder feedback.
                    </p>
                    <p class="mb-4">
                        By leveraging advanced analytics and user-friendly interfaces, we help schools understand the needs and expectations of their community, enabling data-driven decisions that enhance educational quality and stakeholder satisfaction.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>Real-time Feedback Collection</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>Automated Report Generation</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>Multi-language Support</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>24/7 Technical Support</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Educational Team" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>
<!-- <div class="container-fluid" style="background:#1e3a8a;  color: white;">
    <div class="row align-items-center py-4"> 
        <div class="col-lg-8 col-md-7">
            <h2 class="fw-bold mb-3">Schools Division Office of San Carlos City Pangasinan</h2>
            
            <div class="contact-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-phone me-2"></i>
                    <span>075-523 4527 (OSDS Secretariat)</span>
                </div>
                
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <span>Roxas Blvd., San Carlos City, Pangasinan, Philippines, 2420</span>
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-envelope me-2"></i>
                    <span>sancarlos.city@deped.gov.ph</span>
                </div>
            </div>
              
    </div>
</div>
</div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

     

        // Animate stats on scroll
        const animateStats = () => {
            const stats = document.querySelectorAll('.stat-number');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = parseInt(entry.target.textContent);
                        let current = 0;
                        const increment = target / 100;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                current = target;
                                clearInterval(timer);
                            }
                            entry.target.textContent = Math.floor(current) + (entry.target.textContent.includes('+') ? '+' : entry.target.textContent.includes('%') ? '%' : '');
                        }, 20);
                    }
                });
            });
            
            stats.forEach(stat => observer.observe(stat));
        };

        // Initialize animations
        document.addEventListener('DOMContentLoaded', animateStats);
    </script>
</body>
</html>