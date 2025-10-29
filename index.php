<?php  
$pageTitle = "Home"; 
require_once __DIR__ . '/config.php'; 
require_once __DIR__ . '/includes/database.php'; 
include __DIR__ . '/includes/header.php';   

// Use safer connection handling
$db = (new Database())->getConnection();

// Prepare data containers
$services = [];
$projects = [];
$team = [];
$clients = [];

if ($db) {
    try {
        // Get services
        $stmt = $db->prepare("SELECT * FROM services WHERE is_active = 1 ORDER BY display_order LIMIT 6");
        $stmt->execute();
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        // Get projects
        $stmt = $db->prepare("SELECT * FROM projects WHERE status = 'completed' ORDER BY created_at DESC LIMIT 3");
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        // Get team members
        $stmt = $db->prepare("SELECT * FROM team WHERE is_active = 1 ORDER BY display_order LIMIT 4");
        $stmt->execute();
        $team = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
        // Get clients
        $stmt = $db->prepare("SELECT * FROM clients WHERE is_featured = 1 ORDER BY display_order LIMIT 8");
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    } catch (PDOException $e) {
        error_log('Home queries error: ' . $e->getMessage());
    }
}

// Fallback data
if (empty($services)) {
    $services = [
        ['title' => 'Civil Engineering', 'description' => 'Road construction, earthworks, and infrastructure development', 'icon_class' => 'fa-road'],
        ['title' => 'Waste Management', 'description' => 'Comprehensive waste management solutions', 'icon_class' => 'fa-trash-alt'],
        ['title' => 'Construction', 'description' => 'Building and construction projects', 'icon_class' => 'fa-building'],
        ['title' => 'Maintenance', 'description' => 'Ongoing maintenance and support', 'icon_class' => 'fa-tools'],
        ['title' => 'Project Management', 'description' => 'End-to-end project management services', 'icon_class' => 'fa-project-diagram'],
        ['title' => 'Consulting', 'description' => 'Expert consulting and advisory services', 'icon_class' => 'fa-lightbulb'],
    ];
}

if (empty($clients)) {
    $clients = [
        ['name' => 'City of Johannesburg', 'logo' => 'assets/images/City of Johannesburg.png'],
        ['name' => 'Gauteng Province', 'logo' => 'assets/images/Gauteng Province.jpeg'],
        ['name' => 'Department of Public Works', 'logo' => 'assets/images/Department of Public Works.jpeg'],
        ['name' => 'Ekurhuleni Metro', 'logo' => 'assets/images/Ekurhuleni Metro.png'],
        ['name' => 'Transnet', 'logo' => 'assets/images/Transnet.jpeg'],
        ['name' => 'Eskom', 'logo' => 'assets/images/Eskom.jpg'],
        ['name' => 'SANRAL (South African National Roads Agency)', 'logo' => 'assets/images/SANRAL (South African National Roads Agency).jpg'],
        ['name' => 'Water Affairs', 'logo' => 'assets/images/Water Affairs.png'],
    ];
}
?>

<!-- Background Automation System -->
<div class="background-automation">
    <div class="bg-slide active" style="background-image: url('assets/images/1.jpg')"></div>
    <div class="bg-slide" style="background-image: url('assets/images/2.jpg')"></div>
    <div class="bg-slide" style="background-image: url('assets/images/3.jpg')"></div>
    <div class="bg-slide" style="background-image: url('assets/images/4.jpg')"></div>
    <div class="bg-overlay"></div>
</div>

<!-- Floating Particles -->
<div class="floating-particles">
    <div class="particle"></div><div class="particle"></div><div class="particle"></div>
    <div class="particle"></div><div class="particle"></div><div class="particle"></div>
    <div class="particle"></div><div class="particle"></div><div class="particle"></div>
</div>

<!-- Main Content -->
<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-up" data-aos-duration="1200">
                        <!-- Animated Badge -->
                        <div class="hero-badge animated-badge">
                            <div class="badge-sparkle"></div>
                            <i class="fas fa-award"></i>
                            <span>Level 1 B-BBEE Certified</span>
                        </div>

                        <!-- Company Logo in Hero -->
                        <div class="hero-logo" data-aos="fade-up" data-aos-delay="100">
                            <div class="logo-container">
                                <div class="logo-icon">
                                    <i class="fas fa-hard-hat"></i>
                                    <div class="logo-glow"></div>
                                </div>
                                <div class="logo-text">
                                    <span class="logo-main">NDAWONGA</span>
                                    <span class="logo-subtitle">TRADING & PROJECTS</span>
                                </div>
                            </div>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="hero-title">
                            <span class="title-line">Building</span>
                            <span class="title-gradient">South Africa's</span>
                            <span class="title-line">Future Together</span>
                        </h1>

                        <!-- Animated Subtitle -->
                        <p class="hero-subtitle typing-animation">
                            100% Black-Owned Civil Engineering & Construction Specialists
                        </p>

                        <!-- Stats Grid -->
                        <div class="hero-stats-grid">
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="stat-icon">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number" data-count="50">0</div>
                                    <div class="stat-label">Projects Completed</div>
                                </div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number" data-count="15">0</div>
                                    <div class="stat-label">Years Experience</div>
                                </div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="stat-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number" data-count="100">0</div>
                                    <div class="stat-label">% Satisfaction</div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="hero-actions" data-aos="fade-up" data-aos-delay="500">
                            <a href="projects-gallery.php" class="btn btn-futuristic primary">
                                <span class="btn-content">
                                    <i class="fas fa-eye"></i>
                                    View Our Projects
                                </span>
                                <div class="btn-glow"></div>
                            </a>
                            <a href="contact.php" class="btn btn-futuristic secondary">
                                <span class="btn-content">
                                    <i class="fas fa-comments"></i>
                                    Get Free Quote
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-visual" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">
                        <!-- 3D Floating Cards -->
                        <div class="floating-cards-3d">
                            <div class="card-3d card-1" data-aos="fade-up" data-aos-delay="400">
                                <div class="card-inner">
                                    <div class="card-icon">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    <div class="card-content">
                                        <h4>CIDB Registered</h4>
                                        <p>Grade 5CE & 4ME</p>
                                    </div>
                                    <div class="card-glow"></div>
                                </div>
                            </div>
                            <div class="card-3d card-2" data-aos="fade-up" data-aos-delay="600">
                                <div class="card-inner">
                                    <div class="card-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-content">
                                        <h4>51% Women-Owned</h4>
                                        <p>Empowerment Focused</p>
                                    </div>
                                    <div class="card-glow"></div>
                                </div>
                            </div>
                            <div class="card-3d card-3" data-aos="fade-up" data-aos-delay="800">
                                <div class="card-inner">
                                    <div class="card-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="card-content">
                                        <h4>Safety Certified</h4>
                                        <p>Quality Management</p>
                                    </div>
                                    <div class="card-glow"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Animated Construction Visual -->
                        <div class="construction-visual">
                            <div class="building-animation">
                                <div class="building-base"></div>
                                <div class="building-floors">
                                    <div class="floor"></div>
                                    <div class="floor"></div>
                                    <div class="floor"></div>
                                    <div class="floor"></div>
                                    <div class="floor"></div>
                                </div>
                                <div class="construction-crane">
                                    <div class="crane-base"></div>
                                    <div class="crane-arm"></div>
                                    <div class="crane-hook"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="1000">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
            <span>Explore More</span>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="certifications-section">
        <div class="container">
            <div class="certifications-grid">
                <div class="cert-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="cert-icon">
                        <i class="fas fa-award"></i>
                        <div class="pulse-effect"></div>
                    </div>
                    <div class="cert-content">
                        <h4>Level 1 B-BBEE</h4>
                        <p>100% Black Owned</p>
                        <span class="cert-badge">Premium</span>
                    </div>
                </div>
                <div class="cert-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="cert-icon">
                        <i class="fas fa-certificate"></i>
                        <div class="pulse-effect"></div>
                    </div>
                    <div class="cert-content">
                        <h4>CIDB Registered</h4>
                        <p>Grade 5CE & 4ME</p>
                        <span class="cert-badge">Certified</span>
                    </div>
                </div>
                <div class="cert-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="cert-icon">
                        <i class="fas fa-users"></i>
                        <div class="pulse-effect"></div>
                    </div>
                    <div class="cert-content">
                        <h4>Women-Owned</h4>
                        <p>51% Women Ownership</p>
                        <span class="cert-badge">Empowered</span>
                    </div>
                </div>
                <div class="cert-card" data-aos="zoom-in" data-aos-delay="400">
                    <div class="cert-icon">
                        <i class="fas fa-shield-alt"></i>
                        <div class="pulse-effect"></div>
                    </div>
                    <div class="cert-content">
                        <h4>Safety Certified</h4>
                        <p>Quality Management</p>
                        <span class="cert-badge">Standard</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Our <span class="text-gradient">Services</span></h2>
                <p class="section-subtitle">Comprehensive civil engineering and construction solutions powered by innovation and expertise</p>
                <div class="section-decoration">
                    <div class="decoration-line"></div>
                    <div class="decoration-dot"></div>
                    <div class="decoration-line"></div>
                </div>
            </div>

            <div class="services-grid">
                <?php foreach ($services as $index => $service): ?>
                <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="service-icon">
                        <i class="fas <?php echo $service['icon_class']; ?>"></i>
                        <div class="icon-glow"></div>
                    </div>
                    <div class="service-content">
                        <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                        <div class="service-features">
                            <span><i class="fas fa-check"></i> Expert Team</span>
                            <span><i class="fas fa-check"></i> Quality Assured</span>
                            <span><i class="fas fa-check"></i> Timely Delivery</span>
                        </div>
                    </div>
                    <div class="service-hover">
                        <a href="services-comprehensive.php" class="service-link">
                            <span>Explore Service</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card-glow"></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <div class="services-cta-buttons">
                    <a href="services.php" class="btn btn-modern">
                        <span>View All Services</span>
                        <i class="fas fa-arrow-right"></i>
                        <div class="btn-shine"></div>
                    </a>
                    <a href="services-comprehensive.php" class="btn btn-modern outline">
                        <span>Comprehensive Services</span>
                        <i class="fas fa-clipboard-list"></i>
                        <div class="btn-shine"></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="clients-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Trusted By <span class="text-gradient">Industry Leaders</span></h2>
                <p class="section-subtitle">We're proud to partner with leading organizations across South Africa</p>
            </div>

            <div class="clients-carousel" data-aos="fade-up">
                <div class="clients-track">
                    <?php foreach (array_merge($clients, $clients) as $index => $client): ?>
                    <div class="client-logo" data-aos="zoom-in" data-aos-delay="<?php echo $index * 50; ?>">
                        <div class="logo-container">
                            <img src="<?php echo $client['logo']; ?>" alt="<?php echo htmlspecialchars($client['name']); ?>" class="client-logo-img">
                            <div class="logo-tooltip"><?php echo $client['name']; ?></div>
                        </div>
                        <div class="client-glow"></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Showcase -->
    <section class="projects-showcase">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Featured <span class="text-gradient">Projects</span></h2>
                <p class="section-subtitle">Showcasing our successful civil engineering and construction projects across South Africa</p>
            </div>

            <div class="projects-grid">
                <?php 
                $projectData = [
                    [
                        'title' => 'RBA Protea Glen Sectional Development', 
                        'location' => 'Protea Glen, Johannesburg',
                        'description' => 'Residential sectional development project comprising multiple housing units with complete infrastructure.',
                        'budget' => 'R 489K',
                        'icon' => 'fa-home'
                    ],
                    [
                        'title' => 'Rea Vaya BRT Phase 1 NMT', 
                        'location' => 'Johannesburg CBD',
                        'description' => 'Implementation of Non-Motorized Transport infrastructure for Rea Vaya Bus Rapid Transit system.',
                        'budget' => 'R 1.2M',
                        'icon' => 'fa-bus'
                    ],
                    [
                        'title' => 'Winnie Mandela Clinic Refurbishment', 
                        'location' => 'Johannesburg',
                        'description' => 'Comprehensive refurbishment and upgrade of healthcare facility with modern infrastructure.',
                        'budget' => 'R 1.3M',
                        'icon' => 'fa-hospital'
                    ]
                ];

                foreach ($projectData as $index => $project): ?>
                <div class="project-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 150; ?>">
                    <div class="project-visual">
                        <div class="project-icon">
                            <i class="fas <?php echo $project['icon']; ?>"></i>
                        </div>
                        <div class="project-glow"></div>
                        <div class="project-pulse"></div>
                    </div>
                    <div class="project-content">
                        <h3><?php echo $project['title']; ?></h3>
                        <p class="project-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo $project['location']; ?>
                        </p>
                        <p class="project-description"><?php echo $project['description']; ?></p>
                        <div class="project-meta">
                            <span class="budget"><?php echo $project['budget']; ?></span>
                            <span class="status completed">Completed</span>
                        </div>
                        <div class="project-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%"></div>
                            </div>
                            <span>100% Complete</span>
                        </div>
                    </div>
                    <div class="project-hover">
                        <a href="projects-completed.php" class="project-link">
                            <i class="fas fa-external-link-alt"></i>
                            View Project Details
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <div class="projects-cta-buttons">
                    <a href="projects.php" class="btn btn-modern outline">
                        <span>All Projects</span>
                        <i class="fas fa-project-diagram"></i>
                    </a>
                    <a href="projects-completed.php" class="btn btn-modern">
                        <span>Completed Projects</span>
                        <i class="fas fa-check-circle"></i>
                        <div class="btn-shine"></div>
                    </a>
                    <a href="projects-gallery.php" class="btn btn-modern outline">
                        <span>Project Gallery</span>
                        <i class="fas fa-images"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Counter -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-aos="fade-up">
                    <div class="stat-visual">
                        <div class="stat-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-visual">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-count="15">0</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-visual">
                        <div class="stat-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-count="100">0</div>
                        <div class="stat-label">% Client Satisfaction</div>
                    </div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-visual">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-count="25">0</div>
                        <div class="stat-label">Expert Team Members</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Floating Action Menu -->
<div class="floating-action-menu">
    <div class="fab-main">
        <i class="fas fa-plus"></i>
    </div>
    <div class="fab-actions">
        <div class="fab-action" data-tooltip="Quick Quote">
            <i class="fas fa-calculator"></i>
        </div>
        <div class="fab-action" data-tooltip="Call Us">
            <i class="fas fa-phone"></i>
        </div>
        <div class="fab-action" data-tooltip="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </div>
        <div class="fab-action" data-tooltip="Email">
            <i class="fas fa-envelope"></i>
        </div>
    </div>
</div>

<!-- Scroll to Top -->
<button class="scroll-to-top" id="scrollToTop">
    <i class="fas fa-chevron-up"></i>
    <div class="scroll-glow"></div>
</button>

<!-- Loading Animation -->
<div class="page-loader">
    <div class="loader-content">
        <div class="loader-logo">
            <div class="logo-spinner">
                <i class="fas fa-hard-hat"></i>
            </div>
            <span>Ndawonga</span>
        </div>
        <div class="loader-progress">
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>
</div>

<style>
/* Import modern fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

:root {
    --primary: #0066cc;
    --primary-dark: #0052a3;
    --secondary: #00d4ff;
    --accent: #ff6b35;
    --success: #00c851;
    --warning: #ffbb33;
    --danger: #ff4444;
    --dark: #1a1a2e;
    --darker: #16213e;
    --light: #f8f9fa;
    --lighter: #ffffff;
    --gradient: linear-gradient(135deg, var(--primary), var(--secondary));
    --gradient-dark: linear-gradient(135deg, var(--dark), var(--darker));
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 25px 50px rgba(0, 0, 0, 0.15);
    --shadow-glow: 0 0 30px rgba(0, 102, 204, 0.3);
    --border-radius: 16px;
    --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--darker);
    color: var(--lighter);
    overflow-x: hidden;
    line-height: 1.6;
}

/* Advanced Navbar Styles */
.navbar-advanced {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background: rgba(26, 26, 46, 0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
}

.navbar-advanced.scrolled {
    background: rgba(22, 33, 62, 0.98);
    box-shadow: var(--shadow-lg);
}

.nav-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Logo Styles */
.nav-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: var(--transition);
}

.logo-icon {
    width: 45px;
    height: 45px;
    background: var(--gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.logo-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient);
    opacity: 0;
    transition: var(--transition);
    animation: pulse 2s infinite;
}

.nav-logo:hover .logo-glow {
    opacity: 0.3;
}

.logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1;
}

.logo-main {
    font-size: 1.4rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--secondary), var(--primary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.logo-subtitle {
    font-size: 0.7rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.7);
    letter-spacing: 1px;
}

/* Navigation Links */
.nav-links {
    display: flex;
    align-items: center;
    gap: 2rem;
    list-style: none;
}

.nav-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.nav-link::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--gradient);
    transition: var(--transition);
}

.nav-link:hover {
    color: white;
    background: rgba(255, 255, 255, 0.05);
}

.nav-link:hover::before {
    width: 100%;
}

.nav-link.active {
    color: var(--secondary);
    background: rgba(0, 212, 255, 0.1);
}

.nav-link.active::before {
    width: 100%;
}

/* Navbar CTA Buttons */
.nav-cta {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.cta-button {
    padding: 10px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
}

.cta-primary {
    background: var(--gradient);
    color: white;
    box-shadow: var(--shadow-glow);
}

.cta-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Mobile Menu Toggle */
.mobile-toggle {
    display: none;
    flex-direction: column;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
}

.bar {
    width: 25px;
    height: 3px;
    background: white;
    border-radius: 2px;
    transition: var(--transition);
}

.mobile-toggle.active .bar:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

.mobile-toggle.active .bar:nth-child(2) {
    opacity: 0;
}

.mobile-toggle.active .bar:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
}

/* Hero Logo */
.hero-logo {
    margin-bottom: 2rem;
}

.hero-logo .logo-container {
    display: flex;
    align-items: center;
    gap: 15px;
}

.hero-logo .logo-icon {
    width: 60px;
    height: 60px;
    font-size: 1.8rem;
}

.hero-logo .logo-main {
    font-size: 2.5rem;
}

.hero-logo .logo-subtitle {
    font-size: 0.9rem;
    letter-spacing: 2px;
}

/* Background Automation */
.background-automation {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -2;
}

.bg-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 1.5s ease-in-out;
}

.bg-slide.active {
    opacity: 1;
}

.bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(26, 26, 46, 0.9) 0%, rgba(22, 33, 62, 0.8) 100%);
}

/* Floating Particles */
.floating-particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    pointer-events: none;
}

.particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.particle:nth-child(1) { top: 20%; left: 10%; width: 4px; height: 4px; animation-delay: 0s; }
.particle:nth-child(2) { top: 60%; left: 80%; width: 6px; height: 6px; animation-delay: 1s; }
.particle:nth-child(3) { top: 40%; left: 50%; width: 3px; height: 3px; animation-delay: 2s; }
.particle:nth-child(4) { top: 80%; left: 30%; width: 5px; height: 5px; animation-delay: 3s; }
.particle:nth-child(5) { top: 30%; left: 70%; width: 4px; height: 4px; animation-delay: 4s; }
.particle:nth-child(6) { top: 70%; left: 20%; width: 6px; height: 6px; animation-delay: 5s; }

@keyframes float {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-20px) translateX(10px); }
}

/* Hero Section */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 120px 0 80px;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-badge.animated-badge {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, var(--accent), #ff8c00);
    color: white;
    padding: 12px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    animation: pulse 2s infinite;
}

.badge-sparkle {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    opacity: 0.7;
    animation: sparkle 3s infinite;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 24px;
}

.title-line {
    display: block;
}

.title-gradient {
    background: linear-gradient(135deg, var(--secondary), var(--primary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle.typing-animation {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 40px;
    border-right: 2px solid var(--secondary);
    white-space: nowrap;
    overflow: hidden;
    animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
}

.hero-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.stat-item {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: var(--border-radius);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
}

.stat-item:hover {
    transform: translateY(-5px);
    border-color: var(--secondary);
    box-shadow: var(--shadow-glow);
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: var(--gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.2rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--secondary);
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
}

.hero-actions {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.btn-futuristic {
    position: relative;
    padding: 16px 32px;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: var(--transition);
    overflow: hidden;
}

.btn-futuristic.primary {
    background: var(--gradient);
    color: white;
}

.btn-futuristic.secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
}

.btn-futuristic:hover .btn-glow {
    left: 100%;
}

/* 3D Floating Cards */
.floating-cards-3d {
    position: relative;
    height: 400px;
}

.card-3d {
    position: absolute;
    width: 280px;
    perspective: 1000px;
}

.card-1 { top: 20px; left: 0; }
.card-2 { top: 120px; right: 20px; }
.card-3 { bottom: 40px; left: 100px; }

.card-inner {
    position: relative;
    width: 100%;
    height: 120px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: var(--transition);
    transform-style: preserve-3d;
}

.card-3d:hover .card-inner {
    transform: translateY(-10px) rotateX(5deg);
    box-shadow: var(--shadow-glow);
}

.card-icon {
    width: 50px;
    height: 50px;
    background: var(--gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}

.card-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: var(--border-radius);
    background: var(--gradient);
    opacity: 0;
    transition: var(--transition);
    z-index: -1;
}

.card-3d:hover .card-glow {
    opacity: 0.3;
}

/* Construction Animation */
.construction-visual {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 300px;
    height: 300px;
}

.building-animation {
    position: relative;
    width: 100%;
    height: 100%;
}

.building-base {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 20px;
    background: #666;
    border-radius: 4px 4px 0 0;
}

.building-floors {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

.floor {
    width: 60px;
    height: 15px;
    background: #888;
    margin-bottom: 2px;
    border-radius: 2px;
    animation: buildUp 2s ease-in-out infinite;
}

.floor:nth-child(1) { animation-delay: 0s; }
.floor:nth-child(2) { animation-delay: 0.2s; }
.floor:nth-child(3) { animation-delay: 0.4s; }
.floor:nth-child(4) { animation-delay: 0.6s; }
.floor:nth-child(5) { animation-delay: 0.8s; }

@keyframes buildUp {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
    animation: bounce 2s infinite;
}

.scroll-arrow {
    width: 40px;
    height: 40px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40% { transform: translateX(-50%) translateY(-10px); }
    60% { transform: translateX(-50%) translateY(-5px); }
}

/* Certifications Section */
.certifications-section {
    padding: 80px 0;
    background: rgba(255, 255, 255, 0.02);
}

.certifications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.cert-card {
    background: rgba(255, 255, 255, 0.05);
    padding: 30px;
    border-radius: var(--border-radius);
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.cert-card:hover {
    transform: translateY(-10px);
    border-color: var(--secondary);
    box-shadow: var(--shadow-glow);
}

.cert-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    position: relative;
}

.pulse-effect {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    background: var(--gradient);
    animation: pulse 2s infinite;
    opacity: 0.6;
}

.cert-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: var(--accent);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Services Section */
.services-section {
    padding: 100px 0;
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 20px;
}

.section-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.7);
    max-width: 600px;
    margin: 0 auto;
}

.section-decoration {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.decoration-line {
    width: 60px;
    height: 2px;
    background: var(--gradient);
}

.decoration-dot {
    width: 8px;
    height: 8px;
    background: var(--secondary);
    border-radius: 50%;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.service-card {
    background: rgba(255, 255, 255, 0.05);
    padding: 40px 30px;
    border-radius: var(--border-radius);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.service-card:hover {
    transform: translateY(-10px);
    border-color: var(--secondary);
}

.service-icon {
    width: 70px;
    height: 70px;
    background: var(--gradient);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin-bottom: 25px;
    position: relative;
}

.icon-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 16px;
    background: var(--gradient);
    opacity: 0;
    transition: var(--transition);
}

.service-card:hover .icon-glow {
    opacity: 0.3;
    animation: pulse 2s infinite;
}

.service-features {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 20px 0;
}

.service-features span {
    background: rgba(255, 255, 255, 0.1);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.service-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.service-card:hover .service-hover {
    opacity: 0.9;
}

.service-link {
    color: white;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    backdrop-filter: blur(10px);
}

.card-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: var(--border-radius);
    background: var(--gradient);
    opacity: 0;
    transition: var(--transition);
    z-index: -1;
}

.service-card:hover .card-glow {
    opacity: 0.1;
}

/* Clients Section */
.clients-section {
    padding: 80px 0;
    background: rgba(255, 255, 255, 0.02);
}

.clients-carousel {
    overflow: hidden;
    position: relative;
}

.clients-track {
    display: flex;
    animation: scroll 30s linear infinite;
}

.client-logo {
    flex: 0 0 auto;
    width: 200px;
    margin: 0 20px;
}

.logo-container {
    background: rgba(255, 255, 255, 0.05);
    padding: 30px;
    border-radius: var(--border-radius);
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
    position: relative;
}

.logo-container:hover {
    transform: translateY(-5px);
    border-color: var(--secondary);
}

.client-logo-img {
    width: 120px;
    height: 80px;
    object-fit: contain;
    margin: 0 auto 15px;
    border-radius: 8px;
    transition: var(--transition);
    filter: brightness(0.9) contrast(1.1);
}

.logo-container:hover .client-logo-img {
    filter: brightness(1) contrast(1.2);
    transform: scale(1.05);
}

.logo-placeholder {
    width: 80px;
    height: 80px;
    background: var(--gradient);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-weight: 700;
    font-size: 1.2rem;
}

.logo-tooltip {
    position: absolute;
    bottom: -40px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--dark);
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.9rem;
    opacity: 0;
    transition: var(--transition);
    white-space: nowrap;
}

.logo-container:hover .logo-tooltip {
    opacity: 1;
    bottom: -50px;
}

@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Projects Showcase */
.projects-showcase {
    padding: 100px 0;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 30px;
}

.project-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--border-radius);
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
    position: relative;
}

.project-card:hover {
    transform: translateY(-10px);
    border-color: var(--secondary);
    box-shadow: var(--shadow-glow);
}

.project-visual {
    position: relative;
    height: 200px;
    background: var(--gradient-dark);
    display: flex;
    align-items: center;
    justify-content: center;
}

.project-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--secondary);
}

.project-pulse {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    border: 2px solid var(--secondary);
    border-radius: 50%;
    animation: radar 3s linear infinite;
}

.project-content {
    padding: 30px;
}

.project-location {
    color: var(--secondary);
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.project-meta {
    display: flex;
    justify-content: between;
    align-items: center;
    margin: 20px 0;
}

.budget {
    background: var(--gradient);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.status.completed {
    background: var(--success);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
}

.project-progress {
    margin-top: 20px;
}

.progress-bar {
    width: 100%;
    height: 6px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 8px;
}

.progress-fill {
    height: 100%;
    background: var(--gradient);
    border-radius: 3px;
    transition: width 1s ease-in-out;
}

.project-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.project-card:hover .project-hover {
    opacity: 1;
}

.project-link {
    color: white;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: var(--gradient);
    border-radius: 25px;
}

/* Stats Section */
.stats-section {
    padding: 80px 0;
    background: rgba(255, 255, 255, 0.02);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.stat-item {
    text-align: center;
    padding: 40px 20px;
}

.stat-visual {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
}

.stat-icon {
    width: 100%;
    height: 100%;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    position: relative;
    z-index: 2;
}

.stat-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient);
    border-radius: 50%;
    opacity: 0.5;
    animation: pulse 2s infinite;
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--secondary);
    margin-bottom: 10px;
}

/* Buttons */
.btn-modern {
    position: relative;
    padding: 16px 32px;
    background: var(--gradient);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: var(--transition);
    overflow: hidden;
}

.btn-modern.outline {
    background: transparent;
    border: 2px solid var(--secondary);
    color: var(--secondary);
}

.btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
}

.btn-modern:hover .btn-shine {
    left: 100%;
}

/* Floating Action Menu */
.floating-action-menu {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1000;
}

.fab-main {
    width: 60px;
    height: 60px;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    cursor: pointer;
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
    position: relative;
    z-index: 2;
}

.fab-main:hover {
    transform: scale(1.1);
}

.fab-actions {
    position: absolute;
    bottom: 70px;
    right: 0;
    display: flex;
    flex-direction: column;
    gap: 15px;
    opacity: 0;
    transform: translateY(20px);
    transition: var(--transition);
}

.floating-action-menu:hover .fab-actions {
    opacity: 1;
    transform: translateY(0);
}

.fab-action {
    width: 50px;
    height: 50px;
    background: var(--dark);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: white;
    cursor: pointer;
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
}

.fab-action:hover {
    transform: scale(1.1);
    background: var(--primary);
}

.fab-action[data-tooltip]::before {
    content: attr(data-tooltip);
    position: absolute;
    right: 60px;
    background: var(--dark);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    white-space: nowrap;
    opacity: 0;
    transition: var(--transition);
}

.fab-action:hover::before {
    opacity: 1;
    right: 70px;
}

/* Scroll to Top */
.scroll-to-top {
    position: fixed;
    bottom: 30px;
    left: 30px;
    width: 50px;
    height: 50px;
    background: var(--gradient);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.scroll-to-top:hover {
    transform: translateY(-5px);
}

.scroll-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: var(--gradient);
    opacity: 0;
    transition: var(--transition);
    animation: pulse 2s infinite;
}

.scroll-to-top:hover .scroll-glow {
    opacity: 0.6;
}

/* Page Loader */
.page-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--darker);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

.loader-content {
    text-align: center;
}

.loader-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
    font-size: 2rem;
    font-weight: 700;
    color: var(--secondary);
}

.logo-spinner {
    width: 50px;
    height: 50px;
    border: 3px solid rgba(255, 255, 255, 0.1);
    border-top: 3px solid var(--secondary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader-progress {
    width: 200px;
}

/* Animations */
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.05); opacity: 0.7; }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes sparkle {
    0%, 100% { transform: scale(1); opacity: 0.7; }
    50% { transform: scale(1.2); opacity: 1; }
}

@keyframes typing {
    from { width: 0; }
    to { width: 100%; }
}

@keyframes blink-caret {
    from, to { border-color: transparent; }
    50% { border-color: var(--secondary); }
}

@keyframes radar {
    0% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
    100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar-advanced {
        padding: 1rem;
    }
    
    .nav-links {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: var(--darker);
        flex-direction: column;
        padding: 1rem;
        box-shadow: var(--shadow-lg);
    }
    
    .nav-links.active {
        display: flex;
    }
    
    .nav-cta {
        display: none;
    }
    
    .mobile-toggle {
        display: flex;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
        
    .hero-stats-grid {
        grid-template-columns: 1fr;
    }
        
    .services-grid {
        grid-template-columns: 1fr;
    }
        
    .projects-grid {
        grid-template-columns: 1fr;
    }
        
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
        
    .floating-cards-3d {
        height: 300px;
        margin-top: 40px;
    }
        
    .card-3d {
        position: relative;
        margin-bottom: 20px;
    }
}

/* Button Groups */
.services-cta-buttons, .projects-cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.services-cta-buttons .btn-modern, .projects-cta-buttons .btn-modern {
    min-width: 200px;
}

/* Utility Classes */
.text-gradient {
    background: var(--gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

</style>

<script>
// Background Automation
document.addEventListener('DOMContentLoaded', function() {
    // Background slideshow
    const bgSlides = document.querySelectorAll('.bg-slide');
    let currentSlide = 0;
        
    function changeBackground() {
        bgSlides.forEach(slide => slide.classList.remove('active'));
        currentSlide = (currentSlide + 1) % bgSlides.length;
        bgSlides[currentSlide].classList.add('active');
    }
        
    setInterval(changeBackground, 5000);
        
    // Animated counters
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200;
        
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerText;
            const increment = target / speed;
                    
            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 1);
            } else {
                counter.innerText = target;
            }
        };
                
        // Start counting when element is in viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCount();
                    observer.unobserve(entry.target);
                }
            });
        });
                
        observer.observe(counter);
    });
        
    // Scroll to top
    const scrollToTop = document.getElementById('scrollToTop');
    scrollToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
        
    // Show/hide scroll to top based on scroll position
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollToTop.style.opacity = '1';
            scrollToTop.style.visibility = 'visible';
        } else {
            scrollToTop.style.opacity = '0';
            scrollToTop.style.visibility = 'hidden';
        }
    });
        
    // Page loader
    const loader = document.querySelector('.page-loader');
    window.addEventListener('load', () => {
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 1000);
    });
        
    // Floating action menu
    const fabMain = document.querySelector('.fab-main');
    fabMain.addEventListener('click', () => {
        const fabActions = document.querySelector('.fab-actions');
        fabActions.classList.toggle('active');
    });
        
    // Add click handlers for fab actions
    document.querySelectorAll('.fab-action').forEach(action => {
        action.addEventListener('click', function() {
            const actionType = this.getAttribute('data-tooltip').toLowerCase();
            switch(actionType) {
                case 'quick quote':
                    window.location.href = 'contact.php';
                    break;
                case 'call us':
                    window.location.href = 'tel:+27119415913';
                    break;
                case 'whatsapp':
                    window.open('https://wa.me/27794868145', '_blank');
                    break;
                case 'email':
                    window.location.href = 'mailto:david@ndawonga.co.za';
                    break;
            }
        });
    });
        
    // Add hover effects to cards
    document.querySelectorAll('.service-card, .project-card, .cert-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
                
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
        
    // Typing animation for hero subtitle
    const heroSubtitle = document.querySelector('.hero-subtitle.typing-animation');
    if (heroSubtitle) {
        const text = heroSubtitle.textContent;
        heroSubtitle.textContent = '';
        let i = 0;
                
        function typeWriter() {
            if (i < text.length) {
                heroSubtitle.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }
                
        // Start typing when element is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    typeWriter();
                    observer.unobserve(entry.target);
                }
            });
        });
                
        observer.observe(heroSubtitle);
    }

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar-advanced');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileToggle && navLinks) {
        mobileToggle.addEventListener('click', () => {
            mobileToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
    }
});

// AOS initialization
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>