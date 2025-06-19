<?php
require_once '../../../client/navbar.php';
require_once '../../../font/font.php';
require_once '../../../database/database.php';

// Get carousel images
$carousel_images = array_diff(scandir("../../../img/carousel-img"), array('.', '..'));

session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Faculty') {
    header("Location: ../../../auth/sign-in.php");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$profile_image = '/gcc/img/profiles/default-profile.png'; 

if ($user) {
    $user_id = $user['id'];
    $profileQuery = "SELECT profile_image FROM profiles WHERE user_id = :user_id";
    $profileStmt = $pdo->prepare($profileQuery);
    $profileStmt->execute(['user_id' => $user_id]);
    $profile = $profileStmt->fetch(PDO::FETCH_ASSOC);

    if ($profile && !empty($profile['profile_image'])) {
        $profile_image = '/gcc/img/profiles/' . htmlspecialchars($profile['profile_image']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" sizes="96x96" href="/gcc/img/favicon.ico">
<link rel="icon" type="image/x-icon" href="/gcc/img/favicon.ico">
    <title>GCC Website</title>
    <?php includeGoogleFonts(); ?>
    <link rel="stylesheet" type="text/css" href="css/faculty.css">
    <script src="https://kit.fontawesome.com/3c9d5fece1.js" crossorigin="anonymous"></script>
    <!-- FACULTY -->
</head>
<body>
    <!-- Navbar -->
    <?php renderNavbar($profile_image); ?>

    <div class="container">
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
              <span class="typing-container">Welcome to GCC Website, <span class="first-name"><?php echo htmlspecialchars($user['first_name']); ?></span>!</span>
          </div>
    </div>
      <div id="motto" class="motto" style="background-color: #F1F1F1; padding: 80px 0 80px;">
       <p style="margin: 0 20px; text-align: center; font-size: 28px; font-weight: 500;">The <span style="color: #095D36; font-weight: 600;">Guidance and Counseling Center</span> at Western Mindanao State University provides free, confidential counseling services for outside clients, 
       ensuring a respectful and professional environment for personal support and guidance.</p>
      </div>
      <div class="contents">
       <div class="image-gallery">
          <div class="image-item">
          <img src="/gcc/img/counseling-img.png" alt="Image 1">
             <p style="margin: 15px 5px 20px; cursor: pointer;">
              <a href="../../../shared/main/counseling.php" class="counsel-text-link" style="text-decoration: none; color: inherit; cursor: pointer;">
               <i class="fas fa-angle-right" style="margin-right: 5px; color:rgb(14, 72, 45);"></i>Counseling
                </a>
                  </p>
                   <span class="description"> Counseling services are available for both students and outside clients. Appointments are required for consultations, which include the completion of the Personal Data Form and Counseling Form before sessions.</span>
            </div>
            <div class="image-item">
            <img src="/gcc/img/assessment-img.png" alt="Image 1" style="filter: grayscale(90%);">
            <p class="clickable-text" style="margin: 15px 5px 20px; cursor: pointer;">
              <a class="text-link" style="text-decoration: none; color: inherit; user-select: none; color:rgba(0, 0, 0, 0.59);">
               <i class="fas fa-angle-right" style="margin-right: 5px; color:rgba(0, 0, 0, 0.59);"></i>Assessment for Students
               <span class="tooltip-custom">
               <i class="fa-solid fa-circle-exclamation mr-1" style="margin-right: 3px;"></i>
                Only applicable for students in WMSU.
                <span class="arrow"></span>
                </span>
                </a>
                  </p>
                   <span class="description" style="color:rgba(0, 0, 0, 0.59);"> Conducts assessments for students taking the DASS-21 Test (College) and DASS-Y Test (High School). Students must schedule an appointment and complete the required forms before the assessment.</span>
            </div>
            <div class="image-item">
               <img src="/gcc/img/shifting-img.png" alt="Image 1" style="filter: grayscale(90%);">
               <p class="clickable-text" style="margin: 15px 5px 20px; cursor: pointer;">
                   <a class="text-link" style="text-decoration: none; color: inherit; user-select: none; color:rgba(0, 0, 0, 0.59);">
                       <i class="fas fa-angle-right" style="margin-right: 5px; color:rgba(0, 0, 0, 0.59);"></i>
                       Shifting Exam
                       <span class="tooltip-custom">
                       <i class="fa-solid fa-circle-exclamation mr-1" style="margin-right: 3px;"></i>
                           Only applicable for students in WMSU.
                           <span class="arrow"></span>
                       </span>
                   </a>
               </p>
               <span class="description" style="color:rgba(0, 0, 0, 0.59);">
                   Students changing programs. Applicants must schedule an appointment and complete the required forms before taking the exam.
               </span>
           </div>
        </div>
      </div>

         <div class="gcc-pages">
            <div class="pages-to-go">
                <div class="pages"><a href="../../../shared/sub-pages/about-us.php" style="color: white; text-decoration: none;">About Us</a></div>
                <div class="pages"><a href="../../../shared/sub-pages/our-team.php" style="color: white; text-decoration: none;">Our Team</a></div>
                <div class="pages"><a href="../../../shared/sub-pages/contact-us.php" style="color: white; text-decoration: none;">Contact Us</a></div>
            </div>
         </div>
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
                <a href="#contents" style="color: white; text-decoration: none; font-size: 1rem;">Book Appointment</a>
            </div>
            <div style="display: flex; align-items: center; margin: 0.75rem 0; transition: all 0.3s ease;">
                <span style="margin-right: 8px; font-size: 1.1rem; color: #11AD64;">→</span>
                <a href="../../../shared/sub-pages/about-us.php" style="color: white; text-decoration: none; font-size: 1rem;">About Us</a>
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
        a:hover {
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


