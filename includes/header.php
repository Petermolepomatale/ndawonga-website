<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Ndawonga Trading and Projects | Civil Engineering Excellence</title>
    <meta name="description" content="Ndawonga Trading and Projects - 100% Black-Owned Civil Engineering & Waste Management Specialists. CIDB Registered with grades 5CE4SO4ME2GB2SQA. Building South Africa's future with excellence.">
    <meta name="keywords" content="civil engineering, construction, waste management, CIDB registered, black-owned, South Africa, infrastructure, building">
    <meta name="author" content="Ndawonga Trading and Projects">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Ndawonga Trading and Projects | Civil Engineering Excellence">
    <meta property="og:description" content="100% Black-Owned Civil Engineering & Waste Management Specialists. CIDB Registered. Building South Africa's future.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.ndawonga.co.za">
    <meta property="og:image" content="https://www.ndawonga.co.za/assets/images/og-image.jpg">
    
    <!-- Security Headers -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://www.googletagmanager.com https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com https://use.fontawesome.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://use.fontawesome.com; img-src 'self' data: https: blob:; connect-src 'self' https://www.google-analytics.com;">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Ndawonga Trading and Projects",
        "url": "https://www.ndawonga.co.za",
        "logo": "https://www.ndawonga.co.za/assets/images/logo.jpg",
        "description": "100% Black-Owned Civil Engineering & Waste Management Specialists",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Johannesburg",
            "addressRegion": "Gauteng",
            "addressCountry": "South Africa"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+27-11-123-4567",
            "contactType": "customer service",
            "email": "info@ndawonga.co.za"
        }
    }
    </script>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    
    <!-- Fallback FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
        /* FontAwesome Icon Fix */
        .fas, .far, .fab, .fal, .fad, .fass, .fasr, .fasl {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Pro", "Font Awesome 6 Brands", "FontAwesome" !important;
            font-weight: 900 !important;
            font-style: normal !important;
            font-variant: normal !important;
            text-rendering: auto !important;
            line-height: 1 !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
        
        .fab {
            font-weight: 400 !important;
        }
        
        .far {
            font-weight: 400 !important;
        }
        
        /* Ensure icons are displayed properly */
        i[class*="fa-"]:before {
            display: inline-block !important;
            text-rendering: auto !important;
            -webkit-font-smoothing: antialiased !important;
        }
        
        /* Critical CSS - Fixed Navigation */
        .custom-navbar {
            background: rgba(26, 54, 93, 1) !important;
            backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
            border-bottom: 2px solid #d4af37;
        }
        
        /* Company Logo Styles */
        .company-logo {
            height: 50px;
            width: auto;
            margin-right: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .company-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }
        
        .brand-wrapper {
            display: flex;
            align-items: center;
        }
        
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            border: 1px solid transparent;
            margin: 0 5px;
            padding: 8px 15px !important;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            background: rgba(212, 175, 55, 0.2);
            border-color: rgba(212, 175, 55, 0.5);
            transform: translateY(-2px);
        }
        
        .navbar-nav .nav-link.active {
            background: rgba(212, 175, 55, 0.3);
            border-color: #d4af37;
            color: #d4af37 !important;
        }
        
        .brand-name, .brand-tagline {
            color: white !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        .btn-cta {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%) !important;
            color: #1a365d !important;
            border: none !important;
            font-weight: 700 !important;
        }
        
        /* Dropdown Styles */
        .navbar-nav .dropdown-menu {
            background: rgba(26, 54, 93, 0.95) !important;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            margin-top: 8px;
            min-width: 220px;
        }
        
        .navbar-nav .dropdown-item {
            color: white !important;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 6px;
            margin: 2px 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-nav .dropdown-item:hover {
            background: rgba(212, 175, 55, 0.2) !important;
            color: #d4af37 !important;
            transform: translateX(5px);
        }
        
        .navbar-nav .dropdown-item i {
            width: 16px;
            text-align: center;
            opacity: 0.8;
        }
        
        .navbar-nav .dropdown-toggle::after {
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            margin-left: 0.5em;
            transition: transform 0.3s ease;
        }
        
        .navbar-nav .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }
        
        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
        }
        
        /* Mobile dropdown fixes */
        @media (max-width: 991px) {
            .navbar-nav .dropdown-menu {
                background: rgba(26, 54, 93, 0.98) !important;
                border: none;
                box-shadow: none;
                margin-top: 0;
                border-radius: 0;
            }
            
            .navbar-nav .dropdown-item {
                margin: 0;
                border-radius: 0;
                padding-left: 30px;
            }
        }
        
        /* Page Titles */
        .page-header {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            color: white;
            padding: 120px 0 60px;
            margin-top: 76px;
            text-align: center;
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Preloader */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        
        .loader-circle {
            width: 60px;
            height: 60px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top: 3px solid #d4af37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        
        .loader-text {
            color: white;
            font-size: 24px;
            font-weight: 700;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .page-title { font-size: 2rem; }
            .navbar-nav .nav-link { margin: 5px 0; }
        }
    </style>
    
    <link rel="icon" href="assets/images/favicon.ico">
    <meta name="theme-color" content="#1a365d">
    
    <!-- FontAwesome Fallback Script -->
    <script>
        // Check if FontAwesome is loaded, if not load fallback
        document.addEventListener('DOMContentLoaded', function() {
            // Test if FontAwesome is loaded by checking if the font is available
            var testElement = document.createElement('i');
            testElement.className = 'fas fa-home';
            testElement.style.position = 'absolute';
            testElement.style.left = '-9999px';
            document.body.appendChild(testElement);
            
            var computedStyle = window.getComputedStyle(testElement, ':before');
            var fontFamily = computedStyle.getPropertyValue('font-family');
            
            // If FontAwesome is not loaded, load alternative
            if (!fontFamily || fontFamily.indexOf('Font Awesome') === -1) {
                console.log('Loading FontAwesome fallback...');
                var fallbackLink = document.createElement('link');
                fallbackLink.rel = 'stylesheet';
                fallbackLink.href = 'https://use.fontawesome.com/releases/v6.4.0/css/all.css';
                document.head.appendChild(fallbackLink);
                
                // Also try Kit version as backup
                setTimeout(function() {
                    var kitScript = document.createElement('script');
                    kitScript.src = 'https://kit.fontawesome.com/a076d05399.js';
                    kitScript.crossOrigin = 'anonymous';
                    document.head.appendChild(kitScript);
                }, 1000);
            }
            
            document.body.removeChild(testElement);
            
            // Enhanced dropdown functionality
            const dropdowns = document.querySelectorAll('.navbar-nav .dropdown');
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // Desktop hover behavior
                if (window.innerWidth > 991) {
                    dropdown.addEventListener('mouseenter', function() {
                        menu.classList.add('show');
                        toggle.setAttribute('aria-expanded', 'true');
                    });
                    
                    dropdown.addEventListener('mouseleave', function() {
                        menu.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                    });
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 991) {
                    // Remove hover listeners on mobile
                    dropdowns.forEach(dropdown => {
                        dropdown.replaceWith(dropdown.cloneNode(true));
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="preloader" id="preloader">
        <div class="preloader-content">
            <div class="logo-loader">
                <div class="loader-circle"></div>
                <div class="loader-text">Ndawonga</div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <div class="brand-wrapper">
                    <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="company-logo">
                    <div class="brand-text">
                        <span class="brand-name">Ndawonga</span>
                        <span class="brand-tagline">Trading & Projects</span>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a></li>
                    
                    <!-- Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo (in_array(basename($_SERVER['PHP_SELF']), ['services.php', 'services-comprehensive.php']) ? 'active' : ''); ?>" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="services.php"><i class="fas fa-list"></i> All Services</a></li>
                            <li><a class="dropdown-item" href="services-comprehensive.php"><i class="fas fa-clipboard-list"></i> Comprehensive Services</a></li>
                        </ul>
                    </li>
                    
                    <!-- Projects Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo (in_array(basename($_SERVER['PHP_SELF']), ['projects.php', 'projects-completed.php', 'projects-gallery.php']) ? 'active' : ''); ?>" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Projects
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="projectsDropdown">
                            <li><a class="dropdown-item" href="projects.php"><i class="fas fa-project-diagram"></i> All Projects</a></li>
                            <li><a class="dropdown-item" href="projects-completed.php"><i class="fas fa-check-circle"></i> Completed Projects</a></li>
                            <li><a class="dropdown-item" href="projects-gallery.php"><i class="fas fa-images"></i> Project Gallery</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'team.php') ? 'active' : ''; ?>" href="team.php">Team</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'tenders.php') ? 'active' : ''; ?>" href="tenders.php">Tenders</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn-cta" href="contact.php">
                            <span>Get Quote</span> 
                            <i class="fas fa-arrow-right"></i>
                            <small class="d-block" style="font-size: 0.7rem; opacity: 0.8;">CIDB: 5CE4SO4ME2GB2SQA</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

