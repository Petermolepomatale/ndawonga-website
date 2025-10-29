<?php
$pageTitle = "Completed Projects";
require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-check-circle"></i> Completed Projects</li>
        </ol>
    </div>
</nav>

<style>
/* Breadcrumb Navigation */
.breadcrumb-nav {
    background: rgba(26, 54, 93, 0.95);
    padding: 100px 0 20px;
    margin-top: 76px;
}

.breadcrumb {
    background: transparent;
    margin: 0;
    padding: 0;
}

.breadcrumb-item {
    color: rgba(255, 255, 255, 0.7);
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #d4af37;
}

.breadcrumb-item.active {
    color: #d4af37;
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: rgba(255, 255, 255, 0.5);
    margin: 0 10px;
}

.breadcrumb-item i {
    margin-right: 5px;
}

.projects-hero {
    background: linear-gradient(135deg, #1a5276, #2980b9);
    color: white;
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
}

.projects-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.projects-timeline {
    padding: 80px 0;
    background: #f8f9fa;
}

.timeline-section {
    margin-bottom: 60px;
}

.year-header {
    text-align: center;
    margin-bottom: 50px;
}

.year-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a5276;
    margin-bottom: 10px;
}

.year-subtitle {
    color: #666;
    font-size: 1.1rem;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.project-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border-top: 4px solid #1a5276;
}

.project-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.project-header {
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.project-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a5276;
    margin-bottom: 10px;
}

.project-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 10px;
}

.project-client {
    color: #666;
    font-weight: 500;
}

.project-content {
    padding: 25px;
}

.project-description {
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.project-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.project-status {
    background: #28a745;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.contact-person {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
    font-size: 0.9rem;
}

.contact-person strong {
    color: #1a5276;
}

.stats-section {
    background: linear-gradient(135deg, #1a5276, #2980b9);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    margin-top: 50px;
}

.stat-card {
    background: rgba(255,255,255,0.1);
    padding: 40px 30px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: #ffd700;
}

.stat-label {
    font-size: 1.1rem;
    opacity: 0.9;
}

.clients-section {
    padding: 80px 0;
    background: white;
}

.clients-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.client-card {
    text-align: center;
    padding: 30px;
    border-radius: 15px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.client-card:hover {
    background: #1a5276;
    color: white;
    transform: translateY(-5px);
}

.client-logo-wrapper {
    width: 120px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 10px;
    transition: all 0.3s ease;
}

.client-logo-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.client-card:hover .client-logo-wrapper {
    background: rgba(255,255,255,0.2);
    transform: scale(1.05);
}

.client-card:hover .client-logo-image {
    filter: brightness(1.1);
}

.client-icon {
    width: 60px;
    height: 60px;
    background: #1a5276;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
}

.client-card:hover .client-icon {
    background: white;
    color: #1a5276;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .projects-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<div class="projects-hero">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Completed Projects</h1>
            <p class="hero-subtitle">Over a decade of successful project delivery across multiple sectors</p>
            <p class="lead">Serving government entities, hospitals, schools, and commercial clients since 2012</p>
        </div>
    </div>
</div>

<div class="projects-timeline">
    <div class="container">
        <!-- 2021-2024 Projects -->
        <div class="timeline-section">
            <div class="year-header">
                <h2 class="year-title">2021 - 2024</h2>
                <p class="year-subtitle">Recent major projects and ongoing contracts</p>
            </div>
            
            <div class="projects-grid">
                <div class="project-card" data-aos="fade-up">
                    <div class="project-header">
                        <h3 class="project-title">Refurbishment Work at Winnie Mandela Clinic</h3>
                        <div class="project-value">R1,338,949.00</div>
                        <div class="project-client">DID - Winnie Mandela Clinic</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Comprehensive refurbishment work including building renovations, medical facility upgrades, and infrastructure improvements.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Mmekwa Mokoka – 076 392 3541<br>
                            <strong>Position:</strong> Senior Manager – DID
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-header">
                        <h3 class="project-title">Construction of Fence at Seana Marena High School</h3>
                        <div class="project-value">R994,913.00</div>
                        <div class="project-client">Gauteng Education</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Construction of comprehensive security fencing including palisade fence installation and gate systems for educational facility security.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Mpilo Ngcoyi – 068 175 6530<br>
                            <strong>Position:</strong> Projects Manager – Gauteng Education
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-header">
                        <h3 class="project-title">Building Renovations at Sterkfontein Hospital</h3>
                        <div class="project-value">R496,544.00</div>
                        <div class="project-client">Development & Infrastructure Dept</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Complete building renovations at Sterkfontein Hospital including infrastructure upgrades and facility improvements.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Anton Beukes – 083 327 2280<br>
                            <strong>Position:</strong> Inspector – Development & Infrastructure Dept
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2020 Projects -->
        <div class="timeline-section">
            <div class="year-header">
                <h2 class="year-title">2020</h2>
                <p class="year-subtitle">Healthcare and education infrastructure projects</p>
            </div>
            
            <div class="projects-grid">
                <div class="project-card" data-aos="fade-up">
                    <div class="project-header">
                        <h3 class="project-title">Repairs at Hleziphi Primary School</h3>
                        <div class="project-value">R498,302.00</div>
                        <div class="project-client">Gauteng Education</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Comprehensive repairs and maintenance work at Hleziphi Primary School to improve educational infrastructure.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Edgar Twalingca – 076 942 4335<br>
                            <strong>Position:</strong> Projects Manager – Gauteng Education
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-header">
                        <h3 class="project-title">Building Renovations at Randfontein Clinic</h3>
                        <div class="project-value">R471,000.00</div>
                        <div class="project-client">DID - Randfontein Clinic</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Major building renovations at Randfontein Clinic to improve healthcare facility standards and patient care.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Mr. Phatswane – 071 581 4838<br>
                            <strong>Position:</strong> Project Manager – DID
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2019 Projects -->
        <div class="timeline-section">
            <div class="year-header">
                <h2 class="year-title">2019</h2>
                <p class="year-subtitle">Infrastructure and facility management projects</p>
            </div>
            
            <div class="projects-grid">
                <div class="project-card" data-aos="fade-up">
                    <div class="project-header">
                        <h3 class="project-title">General Building Maintenance at CHBAH</h3>
                        <div class="project-value">R494,145.00</div>
                        <div class="project-client">DID - Chris Hani Baragwanath Hospital</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Comprehensive general building maintenance at Chris Hani Baragwanath Academic Hospital ensuring facility standards.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Mmekwa Mokoka – 076 392 3541<br>
                            <strong>Position:</strong> Senior Manager – DID
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-header">
                        <h3 class="project-title">Contract of Ash Removal for 12 Months at Sebokeng Hospital</h3>
                        <div class="project-value">R360,000.00</div>
                        <div class="project-client">DID - Sebokeng Hospital</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">12-month contract for ash removal services at Sebokeng Hospital ensuring proper waste management and environmental compliance.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> James Mokoena – 079 039 1469<br>
                            <strong>Position:</strong> Project Manager – DID Sebokeng Hospital
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-header">
                        <h3 class="project-title">Repairs and Maintenance at JHB Zoo</h3>
                        <div class="project-value">R116,003.00</div>
                        <div class="project-client">City Parks - JHB Zoo</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Comprehensive repairs and maintenance work at Johannesburg Zoo including infrastructure upgrades and facility improvements.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Desmond Mabunda – 062 261 3320<br>
                            <strong>Position:</strong> Project Manager – City Parks
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2012-2018 Projects -->
        <div class="timeline-section">
            <div class="year-header">
                <h2 class="year-title">2012 - 2018</h2>
                <p class="year-subtitle">Foundation projects and major infrastructure developments</p>
            </div>
            
            <div class="projects-grid">
                <div class="project-card" data-aos="fade-up">
                    <div class="project-header">
                        <h3 class="project-title">Rea Vaya BRT Phase 1 NMT Implementation Project</h3>
                        <div class="project-value">R1,200,000.00</div>
                        <div class="project-client">Axton Matrix - Rea Vaya BRT</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Major infrastructure project for Johannesburg Bus Rapid Transit system Phase 1 NMT implementation including road construction and station facilities.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Lesala Kolobe – 072 201 3146<br>
                            <strong>Position:</strong> Project Manager – Axton Matrix
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-header">
                        <h3 class="project-title">Hallmark Towers Demolition Project</h3>
                        <div class="project-value">R750,000.00</div>
                        <div class="project-client">Khulisa Construction</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Complete demolition project for Hallmark Towers including internal and external demolition with rubble removal.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> George Ngwenya – 081 756 5571<br>
                            <strong>Position:</strong> CEO – Khulisa Construction
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>

                <div class="project-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-header">
                        <h3 class="project-title">Construction of Storm Water Infrastructure</h3>
                        <div class="project-value">R580,000.00</div>
                        <div class="project-client">Kumani Projects</div>
                    </div>
                    <div class="project-content">
                        <p class="project-description">Comprehensive storm water infrastructure construction project (040/2014) including drainage systems and water management infrastructure.</p>
                        <div class="contact-person">
                            <strong>Contact:</strong> Gape Freddy Mosweu – 082 729 7931<br>
                            <strong>Position:</strong> CEO – Kumani Projects
                        </div>
                        <div class="project-meta">
                            <span class="project-status">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="stats-section">
    <div class="container">
        <h2 class="section-title">Project Statistics</h2>
        <p class="section-subtitle">Our track record of successful project delivery</p>
        
        <div class="stats-grid">
            <div class="stat-card" data-aos="zoom-in">
                <div class="stat-number">50+</div>
                <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-number">R15M+</div>
                <div class="stat-label">Total Project Value</div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-number">12+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-number">100%</div>
                <div class="stat-label">Client Satisfaction</div>
            </div>
        </div>
    </div>
</div>

<!-- Clients Section -->
<div class="clients-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Our Valued Clients</h2>
            <p class="section-subtitle">Trusted by leading organizations across multiple sectors</p>
        </div>
        
        <div class="clients-grid">
            <div class="client-card" data-aos="fade-up">
                <div class="client-logo-wrapper">
                    <img src="assets/images/City of Johannesburg.png" alt="City of Johannesburg" class="client-logo-image">
                </div>
                <h5>City of Johannesburg</h5>
                <p>Municipal infrastructure and development projects</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="100">
                <div class="client-logo-wrapper">
                    <img src="assets/images/Gauteng Province.jpeg" alt="Gauteng Province" class="client-logo-image">
                </div>
                <h5>Gauteng Province</h5>
                <p>Provincial government infrastructure projects</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="200">
                <div class="client-logo-wrapper">
                    <img src="assets/images/Department of Public Works.jpeg" alt="Department of Public Works" class="client-logo-image">
                </div>
                <h5>Department of Public Works</h5>
                <p>Government building and infrastructure maintenance</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="300">
                <div class="client-logo-wrapper">
                    <img src="assets/images/Ekurhuleni Metro.png" alt="Ekurhuleni Metro" class="client-logo-image">
                </div>
                <h5>Ekurhuleni Metro</h5>
                <p>Metropolitan municipal services and infrastructure</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="400">
                <div class="client-logo-wrapper">
                    <img src="assets/images/Transnet.jpeg" alt="Transnet" class="client-logo-image">
                </div>
                <h5>Transnet</h5>
                <p>Transport and logistics infrastructure projects</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="500">
                <div class="client-logo-wrapper">
                    <img src="assets/images/Eskom.jpg" alt="Eskom" class="client-logo-image">
                </div>
                <h5>Eskom</h5>
                <p>Power generation and distribution infrastructure</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="600">
                <div class="client-logo-wrapper">
                    <img src="assets/images/SANRAL (South African National Roads Agency).jpg" alt="SANRAL" class="client-logo-image">
                </div>
                <h5>SANRAL</h5>
                <p>National roads and highway infrastructure</p>
            </div>
            <div class="client-card" data-aos="fade-up" data-aos-delay="700">
                <div class="client-logo-wrapper">
                    <img src="assets/images/Water Affairs.png" alt="Water Affairs" class="client-logo-image">
                </div>
                <h5>Water Affairs</h5>
                <p>Water infrastructure and management projects</p>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize AOS if available
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
}
</script>

<!-- Cross Navigation -->
<section class="cross-navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Explore More</h3>
                <div class="nav-cards">
                    <div class="nav-card">
                        <a href="projects.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <h4>All Projects</h4>
                            <p>View our complete project portfolio</p>
                        </a>
                    </div>
                    <div class="nav-card">
                        <a href="projects-gallery.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <h4>Project Gallery</h4>
                            <p>Visual showcase of our work</p>
                        </a>
                    </div>
                    <div class="nav-card">
                        <a href="services.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h4>Our Services</h4>
                            <p>Discover what we can do for you</p>
                        </a>
                    </div>
                    <div class="nav-card">
                        <a href="contact.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4>Get Quote</h4>
                            <p>Start your project with us</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.cross-navigation {
    background: #f8f9fa;
    padding: 60px 0;
    margin-top: 40px;
}

.nav-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.nav-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.nav-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.nav-link-card {
    display: block;
    padding: 30px 20px;
    text-decoration: none;
    color: inherit;
    text-align: center;
}

.nav-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #1a5276, #2980b9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
    color: white;
}

.nav-card h4 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #1a5276;
}

.nav-card p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>