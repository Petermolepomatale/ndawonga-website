<?php
$pageTitle = "Comprehensive Services";
require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="services.php"><i class="fas fa-list"></i> Services</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-clipboard-list"></i> Comprehensive Services</li>
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

.services-hero {
    background: linear-gradient(135deg, #1a5276, #2980b9);
    color: white;
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
}

.services-hero::before {
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

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin: 80px 0;
}

.service-category {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border-top: 4px solid #1a5276;
}

.service-category:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.service-header {
    background: linear-gradient(135deg, #1a5276, #2980b9);
    color: white;
    padding: 30px;
    text-align: center;
}

.service-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
}

.service-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.service-subtitle {
    opacity: 0.9;
    font-size: 1rem;
}

.service-content {
    padding: 30px;
}

.service-list {
    list-style: none;
    padding: 0;
}

.service-list li {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.service-list li:last-child {
    border-bottom: none;
}

.service-list li:hover {
    background: #f8f9fa;
    padding-left: 10px;
}

.service-list li i {
    color: #1a5276;
    margin-right: 15px;
    width: 20px;
    text-align: center;
}

.cidb-grades {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 80px 0;
    text-align: center;
}

.grades-container {
    max-width: 1000px;
    margin: 0 auto;
}

.grades-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #1a5276;
}

.grades-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 50px;
}

.grades-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.grade-badge {
    background: white;
    padding: 30px 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.grade-badge:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.grade-code {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a5276;
    margin-bottom: 10px;
}

.grade-description {
    font-size: 0.9rem;
    color: #666;
}

.certifications {
    background: white;
    padding: 80px 0;
}

.cert-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.cert-card {
    text-align: center;
    padding: 40px 30px;
    border-radius: 15px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.cert-card:hover {
    background: #1a5276;
    color: white;
    transform: translateY(-5px);
}

.cert-icon {
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

.cert-card:hover .cert-icon {
    background: white;
    color: #1a5276;
}

.why-choose-us {
    background: linear-gradient(135deg, #1a5276, #2980b9);
    color: white;
    padding: 80px 0;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.feature-card {
    background: rgba(255,255,255,0.1);
    padding: 30px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
}

.feature-card:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-5px);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 1.5rem;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .grades-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<div class="services-hero">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">Our Services</h1>
            <p class="hero-subtitle">Comprehensive construction, waste management, and horticulture solutions</p>
            <p class="lead">CIDB Registered: 5CE, 4ME, 4SO, 2GB PE, 2SQ PE, 1EB | Level 1 B-BBEE | 100% Black Owned</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="services-grid">
        <!-- Construction Services -->
        <div class="service-category" data-aos="fade-up">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <h3 class="service-title">Construction</h3>
                <p class="service-subtitle">Complete building and civil engineering solutions</p>
            </div>
            <div class="service-content">
                <ul class="service-list">
                    <li><i class="fas fa-building"></i> General Building (masonry, painting, ceiling, tiling, partitioning, plastering)</li>
                    <li><i class="fas fa-road"></i> Civil Works (storm water, pipe laying, paving, kerbing, asphalting)</li>
                    <li><i class="fas fa-wrench"></i> Plumbing Works (pipe laying, rerouting, blocked drains, fittings)</li>
                    <li><i class="fas fa-shield-alt"></i> Fencing (palisade fence, clearview fence)</li>
                    <li><i class="fas fa-cogs"></i> Mechanical Works (HVAC, medical gas, autoclaves)</li>
                    <li><i class="fas fa-bolt"></i> Electrical Work including issuing of COC</li>
                    <li><i class="fas fa-hammer"></i> Demolition of Building structure (Internal, external demolition and rubble removal)</li>
                </ul>
            </div>
        </div>

        <!-- Waste Management Services -->
        <div class="service-category" data-aos="fade-up" data-aos-delay="100">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <h3 class="service-title">Waste Management</h3>
                <p class="service-subtitle">Community waste management services for municipalities and hospitals</p>
            </div>
            <div class="service-content">
                <ul class="service-list">
                    <li><i class="fas fa-broom"></i> Litter Picking</li>
                    <li><i class="fas fa-spray-can"></i> Jet Cleaning</li>
                    <li><i class="fas fa-tools"></i> Unblocking of blocked sewer drains</li>
                    <li><i class="fas fa-fire"></i> Ash removal</li>
                    <li><i class="fas fa-water"></i> Clearing Wetlands</li>
                </ul>
                <div class="mt-4">
                    <h6 class="text-primary">Serving:</h6>
                    <p class="mb-0">City of Johannesburg entities and Gauteng Hospitals</p>
                </div>
            </div>
        </div>

        <!-- Horticulture Services -->
        <div class="service-category" data-aos="fade-up" data-aos-delay="200">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="service-title">Horticulture Services</h3>
                <p class="service-subtitle">Professional landscaping and ecological maintenance</p>
            </div>
            <div class="service-content">
                <ul class="service-list">
                    <li><i class="fas fa-cut"></i> Grass & Tree Cutting</li>
                    <li><i class="fas fa-scissors"></i> Tree and Flowers Pruning</li>
                    <li><i class="fas fa-seedling"></i> Flowerbeds Maintenance</li>
                    <li><i class="fas fa-tree"></i> Ecological Maintenance</li>
                </ul>
                <div class="mt-4">
                    <h6 class="text-primary">Serving:</h6>
                    <p class="mb-0">City of Johannesburg entities and private companies</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CIDB Grades Section -->
<div class="cidb-grades">
    <div class="container">
        <div class="grades-container">
            <h2 class="grades-title">CIDB Registered Contractor</h2>
            <p class="grades-subtitle">Construction Industry Development Board Certified</p>
            
            <div class="grades-grid">
                <div class="grade-badge" data-aos="zoom-in">
                    <div class="grade-code">5CE</div>
                    <div class="grade-description">Civil Engineering<br>Grade 5</div>
                </div>
                <div class="grade-badge" data-aos="zoom-in" data-aos-delay="100">
                    <div class="grade-code">4ME</div>
                    <div class="grade-description">Mechanical Engineering<br>Grade 4</div>
                </div>
                <div class="grade-badge" data-aos="zoom-in" data-aos-delay="200">
                    <div class="grade-code">4SO</div>
                    <div class="grade-description">Site Operations<br>Grade 4</div>
                </div>
                <div class="grade-badge" data-aos="zoom-in" data-aos-delay="300">
                    <div class="grade-code">2GB PE</div>
                    <div class="grade-description">General Building<br>Grade 2 PE</div>
                </div>
                <div class="grade-badge" data-aos="zoom-in" data-aos-delay="400">
                    <div class="grade-code">2SQ PE</div>
                    <div class="grade-description">Specialist Quality<br>Grade 2 PE</div>
                </div>
                <div class="grade-badge" data-aos="zoom-in" data-aos-delay="500">
                    <div class="grade-code">1EB</div>
                    <div class="grade-description">Electrical Building<br>Grade 1</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Certifications -->
<div class="certifications">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Our Certifications</h2>
            <p class="section-subtitle">Maintaining the highest industry standards</p>
        </div>
        
        <div class="cert-grid">
            <div class="cert-card" data-aos="fade-up">
                <div class="cert-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h5>Level 1 B-BBEE</h5>
                <p>100% Black Owned<br>51% Women & Military Veterans</p>
            </div>
            <div class="cert-card" data-aos="fade-up" data-aos-delay="100">
                <div class="cert-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h5>CIDB Registered</h5>
                <p>Multiple grade certifications<br>across various disciplines</p>
            </div>
            <div class="cert-card" data-aos="fade-up" data-aos-delay="200">
                <div class="cert-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5>Safety Certified</h5>
                <p>Occupational Health & Safety<br>compliance standards</p>
            </div>
            <div class="cert-card" data-aos="fade-up" data-aos-delay="300">
                <div class="cert-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h5>Co-operative</h5>
                <p>Registered Co-operative<br>2012/004592/24</p>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="why-choose-us">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Keys to Our Success</h2>
            <p class="section-subtitle">What makes us the contractor of choice</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon">
                    <i class="fas fa-sitemap"></i>
                </div>
                <h5>Multi-Level Relationships</h5>
                <p>Strong relationships across national, provincial, municipal government spheres and commercial sectors</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h5>Skilled Labour Force</h5>
                <p>Highly trained and experienced workforce with qualified leaders and managers</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h5>Modern Equipment</h5>
                <p>Up to date equipment, technology and other related resources for efficient project delivery</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h5>Quality Workmanship</h5>
                <p>Excellent quality workmanship with high quality onsite project management</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h5>Accurate Estimates</h5>
                <p>Ensuring estimates on prices and completion dates are as accurate as possible</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h5>Project Tracking</h5>
                <p>Track the progress of each project to ensure scope, cost and schedule are maintained</p>
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

// Add smooth scrolling for internal links
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
</script>

<!-- Cross Navigation -->
<section class="cross-navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Explore More</h3>
                <div class="nav-cards">
                    <div class="nav-card">
                        <a href="services.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-list"></i>
                            </div>
                            <h4>All Services</h4>
                            <p>Browse our complete service list</p>
                        </a>
                    </div>
                    <div class="nav-card">
                        <a href="projects-completed.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h4>Completed Projects</h4>
                            <p>See our successful deliveries</p>
                        </a>
                    </div>
                    <div class="nav-card">
                        <a href="team.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4>Our Team</h4>
                            <p>Meet our expert professionals</p>
                        </a>
                    </div>
                    <div class="nav-card">
                        <a href="contact.php" class="nav-link-card">
                            <div class="nav-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4>Get Quote</h4>
                            <p>Request a service quote</p>
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