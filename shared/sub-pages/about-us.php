<?php
require_once '../../font/font.php';
require_once '../../client/navbar.php';
require_once '../../database/database.php';

session_start();

$profile_image = '/gcc/img/profiles/default-profile.png';

$isLoggedIn = isset($_SESSION['email']) && in_array($_SESSION['role'], ['College Student', 'High School Student', 'Outside Client', 'Faculty']);

if ($isLoggedIn) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

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
}

// Fetch about content from the database
try {
    $stmt = $pdo->query("SELECT * FROM about_content ORDER BY display_order ASC");
    $aboutContents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Initialize variables with default values in case the database query fails
    $description = "The Guidance and Counseling Center at Western Mindanao State University is a vital support unit dedicated to addressing the psychological, emotional, and personal development needs of students and staff. It is one of the key services that contribute to the overall health and well-being of the WMSU community.";
    $vision = "By 2040, WMSU is a Smart Research University generating competent professionals and global citizens engendered by the knowledge from sciences and liberal education, empowering communities, promoting peace, harmony, and cultural diversity.";
    $mission = "WMSU commits to create a vibrant atmosphere of learning where science, technology, innovation, research, the arts and humanities, and community engagement flourish, and produce world-class professionals committed to sustainable development and peace.";
    $quality_policy = "The Western Mindanao State University is committed to deliver academic excellence, to produce globally competitive human resources, and to conduct innovative research for sustainable development beyond the ASEAN region. It is defined as a Smart Research University, that adapts to the changing landscape of the stakeholders' needs.\n\nWMSU also commits to continually enhance its Quality Management System by integrating risk-based thinking into all processes to achieve intended results and guarantee customer satisfaction in compliance with applicable quality assurance standards.";
    
    // Map database content to variables
    foreach ($aboutContents as $content) {
        switch ($content['title']) {
            case 'Description':
                $description = $content['content'];
                break;
            case 'Vision':
                $vision = $content['content'];
                break;
            case 'Mission':
                $mission = $content['content'];
                break;
            case 'Quality Policy':
                $quality_policy = $content['content'];
                break;
        }
    }
} catch (PDOException $e) {
    // If error, the default values will be used
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
    <link rel="stylesheet" type="text/css" href="../css/about-us.css">
    <script src="https://kit.fontawesome.com/3c9d5fece1.js" crossorigin="anonymous"></script>
    <!-- ABOUT US -->
</head>
<body>
    <!-- Navbar -->
    <?php 
    if ($isLoggedIn) {
        aboutNavbar($profile_image);
    } else {
        aboutPublicNavbar();
    }
    ?>       

       <div class="container">
         <div style="background-color: #16633F; width: 100%; height: 200px; font-size: 45px; font-weight: 500; color: white; display: flex; justify-content: left; align-items: center; padding-left: 70px;"> About Us </div>
         <div id="motto" class="motto" style="padding: 70px 0 70px;">
            <p style="margin: 0 20px; text-align: center; font-size: 26px; font-weight: 500;"><?php echo nl2br(htmlspecialchars($description)); ?></p>
         </div>
         <div class="dropdown-form">
        <button class="dropdown-btn-form" onclick="toggleDropdown(0)">
            Our vision 
            <i class="fas fa-chevron-down dropdown-icon"></i>
        </button>
        <div class="dropdown-content-form">
            <p><?php echo nl2br(htmlspecialchars($vision)); ?></p>
        </div>
    </div>

    <div class="dropdown-form">
        <button class="dropdown-btn-form" onclick="toggleDropdown(1)">
            Our mission 
            <i class="fas fa-chevron-down dropdown-icon"></i>
        </button>
        <div class="dropdown-content-form">
            <p><?php echo nl2br(htmlspecialchars($mission)); ?></p>
        </div>
    </div>

    <div class="dropdown-form">
        <button class="dropdown-btn-form" onclick="toggleDropdown(2)">
            Quality Policy 
            <i class="fas fa-chevron-down dropdown-icon"></i>
        </button>
        <div class="dropdown-content-form">
            <p><?php echo nl2br(htmlspecialchars($quality_policy)); ?></p>
        </div>
    </div>
    <div style="background-color:rgb(255, 255, 255); padding: 60px 0 60px;"> </div>
    <div style="background-image: url('/gcc/img/about-bg.png'); background-size: cover; width: 100%; height: 600px; border-top: solid 1px rgba(124, 124, 124, 0.91)"></div>
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

<script src="/gcc/js/descDropdown.js"></script>
<script src="/gcc/js/sidebar.js"></script>
