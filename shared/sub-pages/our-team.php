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

// Fetch team members from the database
try {
    // Get main campus team members
    $mainStmt = $pdo->prepare("SELECT * FROM team_members WHERE campus = 'main' ORDER BY category, display_order");
    $mainStmt->execute();
    $mainTeamMembers = $mainStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Group main campus members by category
    $mainDirectors = [];
    $mainCounselors = [];
    $mainStaff = [];
    $mainCoordinators = [];
    
    foreach ($mainTeamMembers as $member) {
        switch ($member['category']) {
            case 'director':
                $mainDirectors[] = $member;
                break;
            case 'counselor':
                $mainCounselors[] = $member;
                break;
            case 'staff':
                $mainStaff[] = $member;
                break;
            case 'coordinator':
                $mainCoordinators[] = $member;
                break;
        }
    }
    
    // Get ESU campus team members
    $esuStmt = $pdo->prepare("SELECT * FROM team_members WHERE campus = 'esu' ORDER BY display_order");
    $esuStmt->execute();
    $esuTeamMembers = $esuStmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Handle error silently - empty arrays will show "No team members found" messages
    $mainDirectors = $mainCounselors = $mainStaff = $mainCoordinators = $esuTeamMembers = [];
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
    <link rel="stylesheet" type="text/css" href="../css/our-team.css">
    <script src="https://kit.fontawesome.com/3c9d5fece1.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Navbar -->
    <?php 
    if ($isLoggedIn) {
        ourTeamNavbar($profile_image);
    } else {
        teamPublicNavbar();
    }
    ?>          

    <div class="container">
        <div style="background-color: #16633F; width: 100%; height: 200px; font-size: 45px; font-weight: 500; color: white; display: flex; justify-content: left; align-items: center; padding-left: 70px;"> 
            Meet Our Team 
        </div>

        <!-- Main Campus -->
        <div id="main-campus" class="page active">
        <div style="padding: 40px 0 40px;">
            <p style="color: #16633F; display: flex; justify-content: center; align-items: center; font-size: 35px; font-weight: 600; margin: 0;">
                Guidance, Coordinators, & Support Staff
            </p>     
            <p style="color: #727070; display: flex; justify-content: center; align-items: center; font-size: 25px; font-weight: 600; margin: 0;">
                (Main Campus)
            </p>     
        </div>

        <!-- Director Section -->
        <?php if (!empty($mainDirectors)): ?>
        <div style="justify-content: center; align-items: center; display: flex; margin: 50px 0;">
            <div class="profile">
                <p class="role"> Director</p>
                <div class="profile-container">
                    <div class="profile-text">
                        <p class="name"><?php echo htmlspecialchars($mainDirectors[0]['name']); ?></p>
                        <?php if (!empty($mainDirectors[0]['status'])): ?>
                        <p class="status"> <?php echo htmlspecialchars($mainDirectors[0]['status']); ?> </p>
                        <?php endif; ?>
                        <?php if (!empty($mainDirectors[0]['title'])): ?>
                        <p class="title"><?php echo htmlspecialchars($mainDirectors[0]['title']); ?></p>
                        <?php endif; ?>
                    </div> 
                    <img src="/gcc/img/team-gcc/<?php echo htmlspecialchars($mainDirectors[0]['image_path']); ?>" alt="<?php echo htmlspecialchars($mainDirectors[0]['name']); ?>" class="profile-img-role" style="border: 1px solid black; border-radius: 50%;">
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Guidance Counselors Section -->
        <?php if (!empty($mainCounselors)): ?>
        <div style="text-align: center;">
            <p class="role">Guidance Counselor</p>
        </div>
        <div id="guidance-counselors" class="guidance-counselors" style="display: flex; justify-content: center; gap: 100px; margin-bottom: 50px;">
            <?php foreach ($mainCounselors as $counselor): ?>
            <div class="profile-card">
                <img src="/gcc/img/team-gcc/<?php echo htmlspecialchars($counselor['image_path']); ?>" alt="<?php echo htmlspecialchars($counselor['name']); ?>" class="profile-img-role" style="border: 1px solid #ccc; border-radius: 50%;">
                <p class="name"><?php echo htmlspecialchars($counselor['name']); ?></p>
                <?php if (!empty($counselor['status'])): ?>
                <p class="status"> <?php echo htmlspecialchars($counselor['status']); ?> </p>
                <?php endif; ?>
                <?php if (!empty($counselor['title'])): ?>
                <p class="title"><?php echo htmlspecialchars($counselor['title']); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Staff Section -->
        <?php if (!empty($mainStaff)): ?>
        <div style="text-align: center;">
            <p class="role">Guidance Staff</p>
        </div>
        <div id="staff" class="staff" style="display: flex; justify-content: center; gap: 100px;">
            <?php foreach ($mainStaff as $staff): ?>
            <div class="profile-card">
                <img src="/gcc/img/team-gcc/<?php echo htmlspecialchars($staff['image_path']); ?>" alt="<?php echo htmlspecialchars($staff['name']); ?>" class="profile-img-role" style="border: 1px solid #ccc; border-radius: 50%;">
                <p class="name"><?php echo htmlspecialchars($staff['name']); ?></p>
                <?php if (!empty($staff['status'])): ?>
                <p class="status"> <?php echo htmlspecialchars($staff['status']); ?> </p>
                <?php endif; ?>
                <?php if (!empty($staff['title'])): ?>
                <p class="title"><?php echo htmlspecialchars($staff['title']); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Coordinators -->
        <?php if (!empty($mainCoordinators)): ?>
        <div style="text-align: center;">
            <p class="role" style="margin-top: 100px"> Guidance Coordinators</p>
        </div>
        <div id="coords" class="coords" style="display: flex; justify-content: center; gap: 50px; margin-bottom: 50px;">
            <?php foreach ($mainCoordinators as $coordinator): ?>
            <div class="profile-card">
                <img src="/gcc/img/team-gcc/<?php echo htmlspecialchars($coordinator['image_path']); ?>" alt="<?php echo htmlspecialchars($coordinator['name']); ?>" class="profile-img-role" style="border: 1px solid #ccc; border-radius: 50%;">
                <p class="name"><?php echo htmlspecialchars($coordinator['name']); ?></p>
                <?php if (!empty($coordinator['status'])): ?>
                <p class="status"> <?php echo htmlspecialchars($coordinator['status']); ?> </p>
                <?php endif; ?>
                <?php if (!empty($coordinator['title'])): ?>
                <p class="title"<?php if (strlen($coordinator['title']) > 20): ?> style="max-width: 300px;"<?php endif; ?>><?php echo htmlspecialchars($coordinator['title']); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- BUTTON TO PAGE 2 -->
        <div class="button-container">
             <button class="go-to-page" onclick="showPage('esu-campus')">
                 <i class="fas fa-arrow-right"></i> 
                 <p class="text-esu"> Meet the Team ESU! </p>
             </button>
         </div>
    </div>

    <!-- ESU Campus -->
    <div id="esu-campus" class="page">
        <div style="padding: 40px 0 40px;">
            <p style="color: #16633F; display: flex; justify-content: center; align-items: center; font-size: 35px; font-weight: 600; margin: 0;">
                Guidance Coordinators
            </p>     
            <p style="color: #727070; display: flex; justify-content: center; align-items: center; font-size: 25px; font-weight: 600; margin: 0;">
                (ESU Campus)
            </p>     
        </div>
        <div id="coords" class="coords" style="display: flex; justify-content: center; gap: 100px; margin-bottom: 50px;">
            <?php if (!empty($esuTeamMembers)): ?>
                <?php foreach ($esuTeamMembers as $member): ?>
                <div class="profile-card">
                    <img src="/gcc/img/team-gcc/<?php echo htmlspecialchars($member['image_path']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="profile-img-role" style="border: 1px solid #ccc; border-radius: 50%;">
                    <p class="name"><?php echo htmlspecialchars($member['name']); ?></p>
                    <?php if (!empty($member['status'])): ?>
                    <p class="status"> <?php echo htmlspecialchars($member['status']); ?> </p>
                    <?php endif; ?>
                    <?php if (!empty($member['title'])): ?>
                    <p class="title"><?php echo htmlspecialchars($member['title']); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No team members found for ESU campus.</p>
            <?php endif; ?>
        </div>
        <!-- BUTTON TO PAGE 1 -->
        <div class="button-container">
             <button class="go-to-page" onclick="showPage('main-campus')">
                 <i class="fas fa-arrow-left"></i> 
                 <p class="text-esu"> Return to Main Campus! </p>
             </button>
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

<script src="/gcc/js/page2page.js"></script>
<script src="/gcc/js/sidebar.js"></script>
