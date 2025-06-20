<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schools Division Office - Customer Satisfaction Measurement System</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" href="{{asset('logo.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: rgb(37, 83, 157);
            --secondary-color: #bfdbfe;
            --accent-color: #60a5fa;
            --light-color: rgb(247, 247, 247);
            --dark-color: #1e3a8a;
        }
        
        body {
            background-color: var(--light-color);
            font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;

        }
        
        .header-bg {
            background-color: var(--primary-color);
            color: white;
        }
        
        .logo-circle {
            background-color: white;
            color: var(--primary-color);
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;

            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Carousel styling */
        .carousel-container {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        
        .carousel-controls {
            background-color: rgba(255,255,255,0.9);
            padding: 0.5rem 1rem;
        }
        
        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #e5e7eb;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .carousel-dot.active {
            background-color: var(--accent-color);
        }
        
        .carousel-arrow {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background-color: var(--accent-color);
            color: white;
        }
        
        /* Card styling */
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
        
        .background-circle {
            position: absolute;
            width: 300px;
            height: 300px;
            background-color: rgba(255, 200, 200, 0.2);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            z-index: 0;
        }
        
        /* QR section */
        .qr-section {
            background-color: var(--dark-color);
            color: white;
            border-radius: 8px;
        }
        
        .qr-code {
            max-width: 200px;
            background-color: white;
            padding: 5px;
            border-radius: 8px;
        }
        
        /* Stats */
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--accent-color);
        }
        
        /* Testimonials */
        .testimonial-card {
            border-left: 4px solid var(--accent-color);
            position: relative;
        }
        
        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 3rem;
            color: var(--secondary-color);
            font-family: Georgia, serif;
            line-height: 1;
        }
        
        /* Footer */
        .footer-bg {
            background-color: var(--primary-color);
            color: white;
        }
        
        .footer-heading::after {
            content: '';
            display: block;
            width: 40px;
            height: 2px;
            background-color: var(--accent-color);
            margin-top: 0.5rem;
        }
        
        .footer-links {
            padding-left: 0;
            list-style: none;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        @media (max-width: 768px) {
            .logo-circle {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
            
            .header-text h1 {
                font-size: 1.2rem;
            }
            
            .header-text p {
                font-size: 0.9rem;
            }
            
            .stat-value {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header-bg">
    <div class="container py-2 py-md-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <!-- Logo and Title (will stack on very small devices) -->
            <div class="d-flex align-items-center mb-2 mb-sm-0">
                <div class="logo-circle me-2 me-md-3">
                    
                <img src="{{asset('logo.png')}}"  alt="SDO" style="width: 55px;">    

                </div>
                <div class="header-text">
                    <h1 class="  mb-0">Schools Division Office</h1>
                    <p class="mb-0 small d-none d-sm-block">Customer Satisfaction Measurement System</p>
                </div>
            </div>
            
            <!-- Navigation Controls -->
            <div class="d-flex align-items-center">
                       <!-- Chatbot Icon Button -->
          

                       <button 
                       type="button"
                       class="btn btn-sm btn-md-md p-1 p-md-2" id="chatbotButton" aria-label="Open Chatbot" style="background: transparent; border: none;">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
        <!-- Main chatbot body -->
        <rect x="4" y="5" width="16" height="12" rx="2" fill="white" />
        
        <!-- Chat bubble tail -->
        <path d="M10 17L7 21V17H4" fill="white" />
        
        <!-- Face elements -->
        <circle cx="9" cy="10" r="1.5" fill="rgb(37, 83, 157)" />
        <circle cx="15" cy="10" r="1.5" fill="rgb(37, 83, 157)" />
        <path d="M9 13.5 C9 16, 15 16, 15 13.5" stroke="rgb(37, 83, 157)" stroke-width="1.5" fill="none" />
        
        <!-- Antenna -->
        <circle cx="12" cy="3" r="1" fill="white" />
        <line x1="12" y1="3" x2="12" y2="5" stroke="white" stroke-width="1.5" />
    </svg>
</button>  <!-- Dropdown Menu -->
                <div class="dropdown me-2 me-md-3">
                    <button class="btn btn-sm btn-md-md btn-light dropdown-toggle" type="button" id="navDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navDropdown">
                        <li><a class="dropdown-item" href="#">About</a></li>
                        <li><a class="dropdown-item" href="#">Our Services</a></li>
                    </ul>
                </div>
                
       
            </div>
        </div>
    </div>
</header>
<script>
    document.getElementById("chatbotButton").addEventListener("click", function () {
        document.getElementById("chat_me").scrollIntoView({ behavior: "smooth" });
    });
</script>
    <!-- Main content -->
    <div class="container py-4">
        <!-- Carousel Section -->
        <div class="carousel-container shadow">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row g-0 bg-primary text-white">
                            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                                <h2>Welcome to our Customer Satisfaction Portal</h2>
                                <p>The Schools Division Office is committed to providing excellent service to our stakeholders.</p>
                                <button class="btn btn-light text-primary mt-2 align-self-start">Learn More</button>
                            </div>
                            <div class="col-md-6 bg-opacity-10 bg-light">
                                <img src="{{asset('img/9.png')}}" class="d-block w-100 h-100 object-fit-cover" alt="Education">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-0 bg-primary text-white">
                            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                                <h2>Your Feedback Matters</h2>
                                <p>Help us improve our services by sharing your experience with the Schools Division Office.</p>
                                <button class="btn btn-light text-primary mt-2 align-self-start">Give Feedback</button>
                            </div>
                            <div class="col-md-6 bg-opacity-10 bg-light">
                                <img src="{{asset('img/8.png')}}"  class="d-block w-100 h-100 object-fit-cover" alt="Feedback">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-0 bg-primary text-white">
                            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                                <h2>Excellence in Education</h2>
                                <p>We are dedicated to providing quality education and administrative services.</p>
                                <button class="btn btn-light text-primary mt-2 align-self-start">Our Services</button>
                            </div>
                            <div class="col-md-6 bg-opacity-10 bg-light">
                                <img src="{{asset('img/7.png')}}"  class="d-block w-100 h-100 object-fit-cover" alt="Quality Education">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-controls d-flex justify-content-between align-items-center">
                    <div class="carousel-indicators mb-0">
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="carousel-dot active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" class="carousel-dot" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" class="carousel-dot" aria-label="Slide 3"></button>
                    </div>
                    <div>
                        <button class="carousel-arrow" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">❮</button>
                        <button class="carousel-arrow" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">❯</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Welcome Card -->
        <div class="card custom-card welcome-card mb-4">
            <div class="card-body">
                <h2 class="card-title text-primary">Welcome to our Customer Satisfaction Portal</h2>
                <p>The Schools Division Office is committed to providing excellent service to our stakeholders. Your feedback helps us improve our services and operations.</p>
                <p>Please use our interactive chatbot or scan the QR code to provide your valuable feedback about our services.</p>
            </div>
        </div>
        
        <!-- Chatbot Container -->
        <div class="card custom-card mb-4 p-0" id="chat_me">
            <div class="card-header bg-primary text-white">
                <h3 class="h5 mb-0">Customer Support Chatbot</h3>
            </div>
            <div class="card-body bg-light p-0"  >
              @include('chatbot')
                <!-- <p class="text-center py-5">Chatbot interface will appear here</p> -->
            </div>
        </div>
        
        <!-- Experience Feedback Section -->
        <div class="card custom-card welcome-card mb-4">
            <div class="background-circle"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="text-center text-lg-start">
                            <div class="d-lg-flex align-items-center">
                                <div class="mb-4 mb-lg-0 d-none d-md-block me-lg-4">
                                    <img class="img-fluid" src="{{asset('logo.png')}}"  alt="SDO San Carlos City Logo" style="max-height: 200px; width:auto;">
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <h2 class="h1 mb-0">HOW WAS YOUR</h2>
                                        <h2 class="h1 text-purple mb-0">EXPERIENCE</h2>
                                        <h2 class="h1 mb-0">TODAY?</h2>
                                    </div>
                                    
                                    <div class="h4 mb-3">
                                        YOUR FEEDBACK HELP US IMPROVE!
                                    </div>
                                    
                                    <div class="fw-bold text-primary">
                                        PLEASE SCAN CODE AND RATE YOUR EXPERIENCE!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-5 mt-3 mt-md-0">
                        <div class="qr-section h-100 p-3 text-center">
                            <h3 class="fs-5 mb-3">SDO SAN CARLOS CITY <br>PANGASINAN - R1</h3>
                            <a href="http://127.0.0.1:8000/CSM-SDO-SCC-Survey/Overview" target="_blank">
                            <div class="qr-code mx-auto mb-3">
                                <img src="{{asset('qr-code.png')}}"  alt="QR Code" class="img-fluid">
                            </div>
                            </a>
                            <h3 class="fs-5">Client Satisfaction Measurement</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats Section -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
            <div class="col">
                <div class="card h-100 stat-card text-center">
                    <div class="card-body">
                        <div class="stat-value">98%</div>
                        <div class="small fw-bold">Customer Satisfaction</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 stat-card text-center">
                    <div class="card-body">
                        <div class="stat-value">45+</div>
                        <div class="small fw-bold">Schools Served</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 stat-card text-center">
                    <div class="card-body">
                        <div class="stat-value">5,000+</div>
                        <div class="small fw-bold">Feedback Responses</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 stat-card text-center">
                    <div class="card-body">
                        <div class="stat-value">24/7</div>
                        <div class="small fw-bold">Support Available</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Announcement Bar -->
        <div class="alert bg-secondary text-dark d-flex align-items-center mb-4">
            <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div>
                <strong>Important Notice:</strong> We are continuously improving our services based on your feedback. Thank you for your participation!
            </div>
        </div>
        
        <!-- Testimonials Section -->
        <div class="mb-4">
            <h2 class="h3 mb-3">What Our Stakeholders Say</h2>
            <div class="card testimonial-card mb-3">
                <div class="card-body ps-5">
                    <div class="fst-italic mb-2">
                        The Schools Division Office has been extremely responsive to our needs. The new customer satisfaction system makes it easy to provide feedback and see results.
                    </div>
                    <div class="text-end fw-bold">- Maria Santos, School Principal</div>
                </div>
            </div>
            <div class="card testimonial-card">
                <div class="card-body ps-5">
                    <div class="fst-italic mb-2">
                        I appreciate how quickly the SDO responds to our concerns. The chatbot feature is particularly helpful for immediate assistance.
                    </div>
                    <div class="text-end fw-bold">- Juan Cruz, Teacher</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer-bg pt-5 mt-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <h3 class="h5 footer-heading">Schools Division Office</h3>
                    <p class="text-white-50">Committed to excellence in educational administration and support services.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="h5 footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        <li class="mb-2"><a href="#">Home</a></li>
                        <li class="mb-2"><a href="#">About Us</a></li>
                        <li class="mb-2"><a href="#">Services</a></li>
                        <li class="mb-2"><a href="#">FAQs</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="h5 footer-heading">Contact Information</h3>
                    <ul class="footer-links">
                        <li class="mb-2">Email: sdo@education.gov</li>
                        <li class="mb-2">Phone: (123) 456-7890</li>
                        <li class="mb-2">Address: 123 Education Boulevard</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="h5 footer-heading">Follow Us</h3>
                    <ul class="footer-links">
                        <li class="mb-2"><a href="#">Facebook</a></li>
                        <li class="mb-2"><a href="#">Twitter</a></li>
                        <li class="mb-2"><a href="#">Instagram</a></li>
                        <li class="mb-2"><a href="#">LinkedIn</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center py-4 mt-4 border-top border-white border-opacity-10">
                <p class="text-white-50 small mb-0">&copy; 2025 Schools Division Office - Customer Satisfaction Measurement System. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>