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
            --light-blue: #dbeafe;
            --dark-blue: #1e3a8a;
            --accent-blue: #60a5fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: rgb(255, 255, 255);
            min-height: 100vh;
        }

        .navbar {
            background: #1e3a8a;
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

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .nav-link, .navbar-brand, .navbar-toggler {
            color: white !important;
        }

        .nav-link:hover {
            color: #ddd !important;
        }

        /* Floating Assistant Button */
        #assistantBtn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, rgb(25, 153, 238) 0%, rgb(5, 72, 174) 100%);
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
            background: linear-gradient(135deg, rgb(25, 153, 238) 0%, rgb(5, 72, 174) 100%);
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

        .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 12px;
            height: 12px;
            background: rgb(71, 255, 99);
            border-radius: 50%;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

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

        /* Chatbot Section Styles */
        .chatbot-container {
            max-width: 100%;
            margin: 0 auto;
           margin-top: 0px;
        }

        .chatbot-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            text-align: center;
            justify-content: center;
        }

        .chatbot-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgb(25, 153, 238) 0%, rgb(5, 72, 174) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(25, 153, 238, 0.3);
            animation: float 3s ease-in-out infinite;
        }
        .chatbot-icon2 {
            width: 90px;
            height: 90px;
            border-radius: 50%;
             display: flex;
            align-items: center;
            justify-content: center; 
            animation:   3s ease-in-out infinite;
        }
.icon_chatbot {
            width: 50px;
            height: 50px;
            min-width: 50px;
            padding:5px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgb(25, 153, 238) 0%, rgb(5, 72, 174) 100%);
            display: flex;
            margin-right: 10px;
            align-items: center;
            justify-content: center;
             
        }
        .chatbot-title {
            margin: 0;
            color: var(--primary-blue);
            font-size: 2rem;
            font-weight: 700;
        }

        .chatbot-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
            margin-top: 5px;
        }

        .custom-card {
            max-width: 100%;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(30, 64, 175, 0.15);
            transition: all 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(30, 64, 175, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
            border: none;
            padding: 20px 25px;
        }

        .card-header h3 {
            font-weight: 600;
            font-size: 1.3rem;
        }

        .card-body {
            padding: 0;
            background:rgb(255, 255, 255);
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chatbot-placeholder {
            text-align: center;
            color: #6b7280;
            padding: 40px 20px;
        }

        .chatbot-placeholder i {
            font-size: 3rem;
            color: var(--secondary-blue);
            margin-bottom: 20px;
        }

        /* Animations */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .chatbot-container {
                padding: 15px;
               
            }
            
            .chatbot-header {
                flex-direction: column;
                gap: 15px;
            }
            
             
            
            .chatbot-title {
                font-size: 1.5rem;
            }
            
            .custom-card {
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>
 

    <!-- Floating Assistant Button -->
    <a href="{{url('HomePage')}}" id="returnHomeBtn" title="Return to Landing Page" role="button" aria-label="Return to Home">
    <svg class="chat-icon" width="60px" height="60px" viewBox="0 0 24 24" fill="#1E90FF" xmlns="http://www.w3.org/2000/svg">
        <path d="M15 18l-6-6 6-6" stroke="#1E90FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>


    <!-- Main Chatbot Section -->
    <div class="container-fluid chatbot-container">
        <!-- Chatbot Header with Icon -->
        <div class="chatbot-header">
            <div class="chatbot-icon">
                <svg width="65px" height="65px" viewBox="0 -77.5 1179 1179" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M597.215632 994.574713h403.714943s43.549425-8.945287 43.549425-114.64092 94.16092-577.677241-459.976092-577.677241-457.151264 541.425287-457.151264 541.425287-25.423448 160.77977 54.848735 157.013333 415.014253-6.12046 415.014253-6.120459z" fill="#06a24a"></path>
                        <path d="M1071.786667 712.798161h72.503908v136.297931h-72.503908zM36.016552 712.798161h72.503908v136.297931H36.016552z" fill="#ffffff"></path>
                        <path d="M305.68366 559.40926l556.254412-1.165018 0.398364 190.20464-556.254412 1.165018-0.398364-190.20464Z" fill="#ffffff"></path>
                        <path d="M1129.931034 680.312644h-59.556781c-3.295632-152.069885-67.56046-258.942529-172.079081-324.384368l115.347127-238.462529a47.08046 47.08046 0 1 0-42.372414-20.48l-114.640919 236.57931a625.934713 625.934713 0 0 0-269.30023-53.200919 625.228506 625.228506 0 0 0-270.006437 54.848736l-115.817931-235.402299a47.08046 47.08046 0 1 0-42.372414 20.715402l117.701149 238.462529c-103.812414 65.441839-167.135632 173.02069-169.960459 324.61977H47.786667a47.08046 47.08046 0 0 0-47.08046 47.08046v117.701149a47.08046 47.08046 0 0 0 47.08046 47.08046h58.615172v57.908965a70.62069 70.62069 0 0 0 70.62069 70.62069l823.908046-1.647816a70.62069 70.62069 0 0 0 70.620689-70.62069v-57.908965h59.085977a47.08046 47.08046 0 0 0 47.08046-47.08046v-117.701149A47.08046 47.08046 0 0 0 1129.931034 680.312644zM94.16092 847.212874H47.08046v-117.70115h47.08046v117.70115z m929.83908 103.106206a23.54023 23.54023 0 0 1-23.54023 23.54023l-823.908046 1.647816a23.54023 23.54023 0 0 1-23.54023-23.540229v-258.942529c0-329.563218 303.668966-365.57977 434.788046-365.815173s435.494253 34.604138 436.20046 363.931954z m105.46023-105.224827h-47.08046v-117.70115h47.08046v117.70115z" fill="#ffffff"></path>
                        <path d="M464.684138 135.827126l22.363218-19.53839 40.018391 62.381609a30.131494 30.131494 0 0 0 25.423448 13.888735h2.824828a30.131494 30.131494 0 0 0 25.188046-19.067586l20.715402-79.095172 21.186207 74.387126v2.118621a30.366897 30.366897 0 0 0 52.494713 6.826667l30.366896-57.202759 13.182529 12.947126a30.131494 30.131494 0 0 0 21.186207 8.709886h57.673563a23.54023 23.54023 0 0 0 23.54023-23.54023 23.54023 23.54023 0 0 0-23.54023-23.54023h-50.140689l-23.54023-23.54023a30.366897 30.366897 0 0 0-45.668046 3.766437l-21.42161 40.01839L629.465747 19.302989a30.131494 30.131494 0 0 0-28.012873-19.067587 30.131494 30.131494 0 0 0-28.012874 19.067587l-26.60046 101.693793-29.660689-47.08046a30.366897 30.366897 0 0 0-20.48-13.653333 30.837701 30.837701 0 0 0-23.54023 6.826666l-32.250115 28.248276h-60.027586a23.54023 23.54023 0 0 0-23.54023 23.54023 23.54023 23.54023 0 0 0 23.54023 23.54023h66.148046a31.308506 31.308506 0 0 0 17.655172-6.591265zM776.121379 532.950805H404.421149A121.232184 121.232184 0 0 0 282.482759 639.352644a117.701149 117.701149 0 0 0 117.701149 129.000459h371.70023a121.232184 121.232184 0 0 0 121.938391-106.401839 117.701149 117.701149 0 0 0-117.70115-129.000459z m0 188.321839H402.302529a72.503908 72.503908 0 0 1-72.268506-56.496552 70.62069 70.62069 0 0 1 68.972874-84.744828h373.81885a72.503908 72.503908 0 0 1 72.268506 56.496552 70.62069 70.62069 0 0 1-68.502069 84.744828z" fill="#ffffff"></path>
                    </g>
                </svg>
            </div>
            <div>
                <h1 class="chatbot-title">Customer Support</h1>
                <p class="chatbot-subtitle">How can I help you today?</p>
            </div>
             <div>
             <img class="chatbot-icon2" src="{{asset('logo.png')}}" alt="">
            </div>
        </div>

        <!-- Chatbot Card -->
        <div class=" card custom-card mb-4 p-0" id="chat_me">
            <div class="card-header bg-primary text-white">
                <h3 class="h5 mb-0">
                    <i class="fas fa-robot me-2"></i>
                    Chat with Abraska
                </h3>
            </div>
            <div class="card-body   p-0">
                <!-- Placeholder for chatbot interface -->
                <!-- <div class="chatbot-placeholder">
                    <i class="fas fa-comments"></i>
                    <h4>Welcome to our AI Assistant!</h4>
                    <p>Start a conversation to get help with your inquiries.</p>
                    <small class="text-muted">Your chatbot interface will be integrated here</small>
                </div> -->
                <div style=" width:100%">
               @include('chatbot')   </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add interactive behavior for floating button
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
</body>
</html>