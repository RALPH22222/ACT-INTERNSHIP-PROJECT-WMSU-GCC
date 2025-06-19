<?php
session_start();

if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'College Student':
            header("Location: /gcc/client/inside/student/college.php");
            exit();
        case 'High School Student':
            header("Location: /gcc/client/inside/student/high-school.php");
            exit(); 
        case 'Outside Client':
            header("Location: /gcc/client/outside/outside.php");
            exit();
        case "Faculty":
            header("Location: /gcc/client/inside/faculty/faculty.php"); 
            exit();
        case 'Director':
            header("Location: /gcc/users/director/director-dashboard.php");
            exit();
        case 'Admin':
            header("Location: /gcc/users/admin/dashboard.php"); 
            exit();
        case 'Staff':
            header("Location: /gcc/users/staff/staff-dashboard.php"); 
            exit();
    }
}

require_once 'client/navbar.php';
require_once 'font/font.php';
require_once 'database/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM services ORDER BY display_order ASC");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $services = [];
    error_log("Error fetching services: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" sizes="96x96" href="/gcc/img/favicon.ico">
<link rel="icon" type="image/x-icon" href="/gcc/img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GCC Website</title>  
    <?php includeGoogleFonts(); ?>
    <link rel="stylesheet" type="text/css" href="public/css/public-page.css">
    <script src="https://kit.fontawesome.com/3c9d5fece1.js" crossorigin="anonymous"></script>
    <!-- PUBLIC PAGE -->
</head>
<body>
  <!-- Navbar -->
    <?php renderPublicNavbar(); ?>  

    <div class="main-content">
        <div id="carousel" class="carousel">
            <div class="carousel-inner"> 
             <div class="carousel-item active"> 
                 <div style="position: relative; text-align: center;">
                     <img src="/gcc/img/carousel-img/test.png" alt="Slide 1">
                 </div>
             </div>
             <div class="carousel-item active">
                 <div style="position: relative; text-align: center;">
                     <img src="/gcc/img/carousel-img/test2.png" alt="Slide 2">
                 </div>
             </div>
             <div class="carousel-item active">
                 <img src="/gcc/img/carousel-img/test3.png" alt="Slide 3">
             </div>
          </div>
            <div class="carousel-overlay"></div>
            <div class="welcome-text">
                <span>Welcome to GCC Website!</span>
            </div>
        </div>

        <div class="motto" style="background-color: #F1F1F1; padding: 5rem 0 5rem;">
            <p style="margin: 0 1.25rem; text-align: center; font-size: 1.75rem; font-weight: 500;">
                The <span style="color: #095D36; font-weight: 600;">Guidance and Counseling Center</span> at Western Mindanao State University offers free, 
                confidential counseling, student assessments, and support for the shifting exam, along with workshops for academic and personal growth.
            </p>
        </div>

        <div class="container-sign">
            <div class="content-sign" style="align-items: baseline;">
                <div class="floating-heading">
                    Getting Started with GCC!
                </div>
                <p style="font-size: 1.25rem; color: #ffffff; font-weight: 500; text-align: center; margin: 0 2rem 2rem;">
                    In order to access the full features of the <a href="https://www.facebook.com/WMSUGCC" class="gcc-link" target="_blank">Guidance and Counseling Center</a> website, including setting appointments for counseling, assessments, and shifting examinations, users are required to log in to their respective accounts. This ensures that all services are personalized, securely documented, and handled with confidentiality. If you already have an account, please proceed to sign in. Otherwise, kindly register to create one and gain access to our wide range of support services.
                </p>
                <div style="display: flex; justify-content: center; gap: 1.875rem; align-items:last baseline;">
                    <div class="card">
                        <div style="font-size: 1.875rem; font-weight: 600;">Sign In Here</div>
                        <div style="font-size: 1.25rem;">Sign In, If you already have an existing account.</div>
                        <button class="btn-hi-col" onclick="location.href='auth/sign-in.php'" style="background-color: #11AD64; color: white; border: 0.125rem solid rgb(14, 121, 73); padding: 0.9375rem 0; margin-bottom: -1.25rem; border-radius: 0.3125rem; cursor: pointer; font-size: 1.375rem; font-weight: 500; transition: background-color 0.3s, transform 0.3s;">
                            <i class="fas fa-arrow-right" style="margin-right: 0.625rem;"></i>Continue 
                        </button>
                    </div>

                    <div class="card">
                        <div style="font-size: 1.875rem; font-weight: 600;">Sign Up Here</div>
                        <div style="font-size: 1.25rem;">Sign Up, If you still don't have an account.</div>
                        <button class="btn-hi-col" onclick="location.href='auth/sign-up.php'" style="background-color: #11AD64; color: white; border: 0.125rem solid rgb(14, 121, 73); padding: 0.9375rem 0; margin-bottom: -1.25rem; border-radius: 0.3125rem; cursor: pointer; font-size: 1.375rem; font-weight: 500; transition: background-color 0.3s, transform 0.3s;">
                            <i class="fas fa-arrow-right" style="margin-right: 0.625rem;"></i>Get Started
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="contents">
            <div class="gallery-intro">
                <h2>Need Help? Start Here</h2>
                <p class="intro-text">We provide comprehensive support services to help students navigate their academic journey and personal development.</p>
            </div>
            <div class="image-gallery">
                <?php foreach ($services as $service): ?>
                <div class="image-item">
                    <img src="<?php echo htmlspecialchars($service['image_path']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>">
                    <p style="margin: 0.9375rem 0.3125rem 1.25rem; cursor: pointer;">
                        <a href="#" class="h" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-angle-right" style="margin-right: 0.3125rem; color:rgb(14, 72, 45);"></i>
                            <?php echo htmlspecialchars($service['title']); ?>
                        </a>
                    </p>
                    <span class="description"><?php echo htmlspecialchars($service['description']); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- LAST 3 CARDS -->
        <div class="about-section">
            <div class="section-header">
                <h2>Know More About GCC!</h2>
                <p class="section-intro">Discover what makes GCC team special and how we can support your journey.</p>
            </div>
            
            <div class="about-cards">
                <!-- Card 1 -->
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Our Team</h3>
                    <p>Meet our dedicated professionals committed to your growth and well-being.</p>
                    <a href="shared/sub-pages/our-team.php" class="card-link">Meet Us →</a>
                </div>
                
                <!-- Card 2 -->
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3>About Us</h3>
                    <p>Learn about our commitment to student development and mental health.</p>
                    <a href="shared/sub-pages/about-us.php" class="card-link">Learn More →</a>
                </div>
                
                <!-- Card 3 -->
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Contact Us</h3>
                    <p>Have questions? Reach out to our team for assistance.</p>
                    <a href="shared/sub-pages/contact-us.php" class="card-link">Get in Touch →</a>
                </div>
            </div>
        </div>
        <!-- <div class="gcc-pages">
            <div class="pages-to-go">
                <div class="pages"><a href="about.php" style="color: white; text-decoration: none;">About Us</a></div>
                <div class="pages"><a href="team.php" style="color: white; text-decoration: none;">Our Team</a></div>
                <div class="pages"><a href="../shared/sub-pages/contact-us.php" style="color: white; text-decoration: none;">Contact Us</a></div>
            </div>
        </div> -->
        <footer style="font-family: 'Arial', sans-serif; position: relative; overflow: hidden; background: #111;">
    <!-- Animated Background Container -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0;">
        <!-- WMSU Background (Crimson) -->
        <div style="position: absolute; width: 100%; height: 100%; background: rgba(220, 20, 60, 0.08); animation: bgFade 10s ease-in-out infinite;">
            <div style="position: absolute; top: 75%; left: 58%; transform: translate(-50%, -50%); width: 280px; height: 280px; display: flex; justify-content: center; align-items: center;">
                <img src="/gcc/img/wmsu-logo.png" alt="WMSU Logo" style="width: 100%; height: 100%; object-fit: contain; opacity: 0.1; animation: logoFloat 8s ease-in-out infinite; filter: drop-shadow(0 0 10px rgba(220, 20, 60, 0.3));">
            </div>
        </div>
        <!-- GCC Background (Green) -->
        <div style="position: absolute; width: 100%; height: 100%; background: rgba(17, 173, 100, 0.08); animation: bgFade 10s ease-in-out infinite 5s;">
            <div style="position: absolute; top: 75%; left: 58%; transform: translate(-50%, -50%); width: 280px; height: 280px; display: flex; justify-content: center; align-items: center;">
                <img src="/gcc/img/gcc-logo.png" alt="GCC Logo" style="width: 100%; height: 100%; object-fit: contain; opacity: 0.1; animation: logoFloat 8s ease-in-out infinite 5s; filter: drop-shadow(0 0 10px rgba(17, 173, 100, 0.3));">
            </div>
        </div>
    </div>

    <!-- Content Container -->
    <div style="position: relative; z-index: 1; display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; color: white;">
        <!-- Contact Information Column -->
        <div style="flex: 1; min-width: 250px; margin-bottom: 1.5rem; padding: 0 1.5rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem; border-bottom: 2px solid #DC143C; padding-bottom: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Contact Information</h3>
            <div style="display: flex; align-items: center; margin: 1rem 0; transition: transform 0.3s ease;">
                <div style="background: rgba(220, 20, 60, 0.2); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                    <span style="font-size: 1rem; color: #DC143C;">📞</span>
                </div>
                <p style="margin: 0; font-size: 0.95rem; line-height: 1.5;">(062) 955-4567</p>
            </div>
            <div style="display: flex; align-items: center; margin: 1rem 0; transition: transform 0.3s ease;">
                <div style="background: rgba(220, 20, 60, 0.2); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                    <span style="font-size: 1rem; color: #DC143C;">✉️</span>
                </div>
                <p style="margin: 0; font-size: 0.95rem; line-height: 1.5;">info@wmsu.edu.ph</p>
            </div>
            <div style="display: flex; align-items: flex-start; margin: 1rem 0; transition: transform 0.3s ease;">
                <div style="background: rgba(220, 20, 60, 0.2); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                    <span style="font-size: 1rem; color: #DC143C;">📍</span>
                </div>
                <p style="margin: 0; font-size: 0.95rem; line-height: 1.5;">Normal Road, Baliwasan, Zamboanga City, 7000, Philippines</p>
            </div>
        </div>

        <!-- Quick Links Column -->
        <div style="flex: 1; min-width: 250px; margin-bottom: 1.5rem; padding: 0 1.5rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem; border-bottom: 2px solid #11AD64; padding-bottom: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Quick Links</h3>
            <div style="display: flex; align-items: center; margin: 0.75rem 0; transition: all 0.3s ease;">
                <span style="margin-right: 8px; font-size: 1.1rem; color: #11AD64;">→</span>
                <a href="../auth/sign-up.php" style="color: white; text-decoration: none; font-size: 1rem;">Book Appointment</a>
            </div>
            <div style="display: flex; align-items: center; margin: 0.75rem 0; transition: all 0.3s ease;">
                <span style="margin-right: 8px; font-size: 1.1rem; color: #11AD64;">→</span>
                <a href="../auth/sign-up.php" style="color: white; text-decoration: none; font-size: 1rem;">Create Account</a>
            </div>
        </div>

        <!-- Social Media Column -->
        <div style="flex: 1; min-width: 250px; margin-bottom: 1.5rem; padding: 0 1.5rem;">
            <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem; border-bottom: 2px solid #DC143C; padding-bottom: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Connect With Us</h3>
            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                <a href="https://www.facebook.com/wmsugcc" style="color: white; width: 42px; height: 42px; background: rgba(220, 20, 60, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; transition: all 0.3s ease;">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </div>
            <div style="background: rgba(17, 173, 100, 0.1); padding: 1rem; border-radius: 8px; border-left: 3px solid #11AD64;">
                <p style="font-size: 0.9rem; margin: 0; line-height: 1.5; color: rgba(255,255,255,0.9);">
                    <i class="fa-regular fa-clock" style="margin-right: 8px; color: #11AD64;"></i>
                    Office Hours: Mon-Fri, 8:00 AM - 5:00 PM
                </p>
            </div>
        </div>
    </div>

    <!-- Copyright and Logo -->
    <div style="position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 1rem; padding: 2rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); color: white; text-align: center;">
        <div style="display: flex; gap: 2rem; margin-bottom: 1.5rem; justify-content: center;">
            <img src="/gcc/img/wmsu-logo.png" alt="WMSU Logo" style="height: 3rem; ">
            <img src="/gcc/img/gcc-logo.png" alt="GCC Logo" style="height: 3rem; ">
        </div>
        <div style="text-align: center; font-size: 0.85rem; color: rgba(255,255,255,0.7); max-width: 800px; line-height: 1.5; margin: 0 auto;">
            Copyright © 2025 Western Mindanao State University. All rights reserved. 
            <span style="display: block; margin-top: 0.5rem; font-size: 0.8rem;">The premier university in Western Mindanao committed to academic excellence and social transformation.</span>
        </div>
    </div>

    <!-- Animation Style -->
    <style>
        @keyframes logoFloat {
            0% { transform: translate(-50%, -50%) scale(1) rotate(0deg); opacity: 0.1; }
            50% { transform: translate(-50%, -52%) scale(1.02) rotate(2deg); opacity: 0.15; }
            100% { transform: translate(-50%, -50%) scale(1) rotate(0deg); opacity: 0.1; }
        }
        @keyframes bgFade {
            0% { opacity: 0; }
            20% { opacity: 1; }
            50% { opacity: 1; }
            70% { opacity: 0; }
            100% { opacity: 0; }
        }
        .dropdown-content {
            display: none;
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-content a:hover {
            background: rgba(17, 173, 100, 0.3);
            border-left: 3px solid #DC143C !important;
            padding-left: 20px !important;
        }
        .dropbtn:hover {
            opacity: 0.8;
            transform: translateX(5px);
        }
    </style>
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Dropdown JavaScript -->
    <script>
        // Get the dropdown button and content
        const dropdownBtn = document.querySelector('.dropbtn');
        const dropdownContent = document.getElementById('dropdownContent');

        // Toggle dropdown when clicking the button
        dropdownBtn.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent event from bubbling up
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                dropdownContent.style.display = 'none';
            }
        });

        // Prevent dropdown from closing when clicking inside it
        dropdownContent.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
</footer>
    </div> 
</body>
</html>

<script src="/gcc/js/carousel.js"></script>
<script src="/gcc/js/sidebar.js"></script>
<script src="/gcc/js/card-animation.js"></script>
<script src="/gcc/js/slide-to-sign.js"></script>