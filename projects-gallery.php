<?php
$pageTitle = "Projects Gallery";
require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';

// Get projects from database if available
$projects = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("
            SELECT p.*, tm.name as manager_name 
            FROM projects p 
            LEFT JOIN team_members tm ON p.project_manager_id = tm.id 
            WHERE p.status = 'completed' 
            ORDER BY p.created_at DESC
        ");
        $projects = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Projects query error: " . $e->getMessage());
    }
}

// Helper function to get project image
function get_project_image($project) {
    if (!empty($project['image_path'])) {
        return $project['image_path'];
    }
    
    // Fallback images based on category
    $categoryImages = [
        'infrastructure' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'commercial' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'municipal' => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'national' => 'https://images.unsplash.com/photo-1519996529937-47d2dfd7f7bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    ];
    
    return $categoryImages[$project['category'] ?? 'commercial'] ?? $categoryImages['commercial'];
}
?>

<style>
:root {
    --primary: #1a365d;
    --secondary: #2b6cb0;
    --accent: #e53e3e;
    --gold: #d4af37;
    --light: #f7fafc;
    --dark: #1a202c;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--dark);
    color: white;
    overflow-x: hidden;
}

/* Enhanced Breadcrumb */
.breadcrumb-nav {
    background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
    padding: 120px 0 30px;
    margin-top: 76px;
    position: relative;
    overflow: hidden;
}

.breadcrumb-nav::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.breadcrumb {
    background: transparent;
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 2;
}

.breadcrumb-item {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.breadcrumb-item a:hover {
    color: var(--gold);
    transform: translateY(-2px);
}

.breadcrumb-item.active {
    color: var(--gold);
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(255, 255, 255, 0.6);
    margin: 0 15px;
    font-size: 1.2rem;
}

.breadcrumb-item i {
    margin-right: 8px;
    font-size: 1.1rem;
}

/* Hero Section */
.gallery-hero {
    background: linear-gradient(135deg, rgba(26, 54, 93, 0.95) 0%, rgba(43, 108, 176, 0.9) 100%);
    padding: 80px 0 60px;
    position: relative;
    overflow: hidden;
}

.gallery-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
}

.gallery-title {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #fff 0%, var(--gold) 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    position: relative;
    display: inline-block;
}

.gallery-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 5px;
    background: linear-gradient(to right, var(--gold), var(--accent));
    border-radius: 3px;
}

.gallery-subtitle {
    font-size: 1.3rem;
    font-weight: 300;
    margin-bottom: 40px;
    color: rgba(255, 255, 255, 0.9);
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Stats Section */
.stats-section {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 50px 30px;
    margin: -40px auto 60px;
    max-width: 1200px;
    position: relative;
    z-index: 20;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
}

.stat-card {
    text-align: center;
    padding: 25px 15px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    transition: all 0.4s ease;
    border: 1px solid rgba(255, 255, 255, 0.05);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(to right, var(--gold), var(--accent));
}

.stat-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.12);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--gold), var(--accent));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 10px;
    line-height: 1;
}

.stat-text {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    max-width: 1200px;
    margin: 0 auto 50px;
    padding: 0 20px;
}

.filter-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
}

.filter-btn {
    padding: 12px 28px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: white;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.4s ease;
    font-weight: 600;
    font-size: 0.95rem;
    position: relative;
    overflow: hidden;
}

.filter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--gold), var(--accent));
    z-index: -1;
    transition: transform 0.4s ease;
    transform: scaleX(0);
    transform-origin: right;
}

.filter-btn.active, .filter-btn:hover {
    color: white;
    border-color: transparent;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
}

.filter-btn.active::before, .filter-btn:hover::before {
    transform: scaleX(1);
    transform-origin: left;
}

/* Gallery Grid */
.gallery-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px 80px;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.project-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    overflow: hidden;
    transition: all 0.5s ease;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    height: 450px;
    cursor: pointer;
}

.project-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(to right, var(--gold), var(--accent));
    z-index: 2;
}

.project-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    background: rgba(255, 255, 255, 0.12);
}

.card-image {
    height: 220px;
    position: relative;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.project-card:hover .card-image img {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
    display: flex;
    align-items: flex-end;
    padding: 20px;
    opacity: 0;
    transition: all 0.4s ease;
}

.project-card:hover .card-overlay {
    opacity: 1;
}

.card-badge {
    background: linear-gradient(135deg, var(--gold), var(--accent));
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-content {
    padding: 25px;
    height: 230px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-header {
    margin-bottom: 15px;
}

.project-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: white;
    line-height: 1.3;
}

.project-desc {
    font-size: 0.95rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 15px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.project-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.7);
}

.meta-item i {
    color: var(--gold);
    font-size: 1rem;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.view-btn {
    padding: 10px 25px;
    background: linear-gradient(135deg, var(--gold), var(--accent));
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    border: none;
    cursor: pointer;
}

.view-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
    color: white;
    text-decoration: none;
}

.like-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: rgba(255, 255, 255, 0.7);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.like-btn:hover, .like-btn.active {
    background: var(--accent);
    color: white;
    border-color: var(--accent);
}

/* Floating Elements */
.floating-elements {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: -1;
}

.floating-element {
    position: absolute;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 50%;
    animation: float 20s infinite linear;
}

@keyframes float {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    100% {
        transform: translateY(-1000px) rotate(720deg);
    }
}

/* Cross Navigation */
.cross-navigation {
    background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
    padding: 80px 0;
    margin-top: 40px;
    position: relative;
    overflow: hidden;
}

.cross-navigation::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.nav-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 50px;
    color: white;
    position: relative;
    z-index: 2;
}

.nav-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.nav-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
}

.nav-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(to right, var(--gold), var(--accent));
}

.nav-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.12);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.nav-link-card {
    display: block;
    padding: 40px 30px;
    text-decoration: none;
    color: inherit;
    text-align: center;
    height: 100%;
}

.nav-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--gold), var(--accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 2rem;
    color: white;
    transition: all 0.3s ease;
}

.nav-card:hover .nav-icon {
    transform: scale(1.1) rotate(5deg);
}

.nav-card h4 {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: white;
}

.nav-card p {
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-size: 1rem;
    line-height: 1.6;
}

/* Modal Styles */
.project-modal .modal-content {
    background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
    border-radius: 25px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
}

.project-modal .modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 25px 30px;
    position: relative;
}

.project-modal .modal-body {
    padding: 30px;
}

.modal-project-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 15px;
    margin-bottom: 25px;
}

.modal-project-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: white;
}

.modal-project-desc {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 1.1rem;
}

.modal-project-meta {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
}

.modal-meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    font-size: 1rem;
}

.modal-meta-item:last-child {
    margin-bottom: 0;
}

.modal-meta-item i {
    width: 25px;
    color: var(--gold);
    font-size: 1.1rem;
    margin-right: 10px;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    }
}

@media (max-width: 768px) {
    .gallery-title {
        font-size: 2.8rem;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-buttons {
        gap: 10px;
    }
    
    .filter-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .nav-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .gallery-title {
        font-size: 2.2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .project-card {
        height: 400px;
    }
    
    .card-content {
        padding: 20px;
    }
}
</style>

<!-- Floating Background Elements -->
<div class="floating-elements" id="floatingElements"></div>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="projects.php"><i class="fas fa-project-diagram"></i> Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-images"></i> Project Gallery</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="gallery-hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="gallery-title">Project Portfolio</h1>
            <p class="gallery-subtitle">Explore our portfolio of successful civil engineering and construction projects delivering excellence across national, provincial, municipal and commercial sectors</p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?php echo count($projects) > 0 ? count($projects) : '25+'; ?></div>
            <div class="stat-text">Projects Completed</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">15</div>
            <div class="stat-text">Years Experience</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">7</div>
            <div class="stat-text">Expert Team Members</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">3</div>
            <div class="stat-text">Government Levels</div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="filter-buttons">
        <button class="filter-btn active" data-filter="all">All Projects</button>
        <button class="filter-btn" data-filter="infrastructure">Infrastructure</button>
        <button class="filter-btn" data-filter="commercial">Commercial</button>
        <button class="filter-btn" data-filter="municipal">Municipal</button>
        <button class="filter-btn" data-filter="national">Government</button>
    </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-container">
    <div class="gallery-grid" id="galleryGrid">
        <?php if (count($projects) > 0): ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-card" data-category="<?php echo htmlspecialchars($project['government_level'] ?? 'commercial'); ?>">
                    <div class="card-image">
                        <img src="<?php echo get_project_image($project); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                        <div class="card-overlay">
                            <div class="card-badge"><?php echo ucfirst(htmlspecialchars($project['government_level'] ?? 'commercial')); ?></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h3 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="project-desc"><?php echo htmlspecialchars(substr($project['description'], 0, 120)) . '...'; ?></p>
                            <div class="project-meta">
                                <?php if (!empty($project['manager_name'])): ?>
                                    <div class="meta-item">
                                        <i class="fas fa-user-tie"></i>
                                        <span><?php echo htmlspecialchars($project['manager_name']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($project['government_level'])): ?>
                                    <div class="meta-item">
                                        <i class="fas fa-layer-group"></i>
                                        <span><?php echo ucfirst(htmlspecialchars($project['government_level'])); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="view-btn view-project" data-project='<?php echo json_encode($project); ?>'>View Details</button>
                            <button class="like-btn" data-project-id="<?php echo $project['id']; ?>">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Static project cards as fallback -->
            <?php
            $staticProjects = [
                [
                    'id' => 1,
                    'title' => 'Rea Vaya BRT Infrastructure',
                    'description' => 'Complete infrastructure development for Johannesburg Bus Rapid Transit system including road construction, station facilities, and drainage systems.',
                    'government_level' => 'municipal',
                    'manager_name' => 'David Banda',
                    'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 2,
                    'title' => 'Pick n Pay Waste Management',
                    'description' => 'Implementation of comprehensive waste management and recycling systems across 50+ Pick n Pay locations.',
                    'government_level' => 'commercial',
                    'manager_name' => 'Dinah Modimakwane',
                    'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 3,
                    'title' => 'Johannesburg Water Pipeline',
                    'description' => 'Construction of 25km water pipeline network to improve water supply reliability across Johannesburg communities.',
                    'government_level' => 'municipal',
                    'manager_name' => 'Thato Manda',
                    'image' => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 4,
                    'title' => 'Johannesburg Zoo Infrastructure',
                    'description' => 'Complete infrastructure upgrade including new animal enclosures, visitor facilities, and waste management systems.',
                    'government_level' => 'commercial',
                    'manager_name' => 'Dr. Tamala Manda',
                    'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 5,
                    'title' => 'Johannesburg Market Renovation',
                    'description' => 'Major renovation and modernization of Johannesburg Fresh Produce Market facilities including cold storage and loading bays.',
                    'government_level' => 'commercial',
                    'manager_name' => 'Vusi Khanyile',
                    'image' => 'https://images.unsplash.com/photo-1471289548843-5a1db0f4a2f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 6,
                    'title' => 'Educational Infrastructure',
                    'description' => 'Modern educational facilities designed for optimal learning environments with sustainable design principles.',
                    'government_level' => 'national',
                    'manager_name' => 'Portia Mlonjane',
                    'image' => 'https://images.unsplash.com/photo-1519996529937-47d2dfd7f7bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ]
            ];
            
            foreach ($staticProjects as $project): ?>
                <div class="project-card" data-category="<?php echo $project['government_level']; ?>">
                    <div class="card-image">
                        <img src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                        <div class="card-overlay">
                            <div class="card-badge"><?php echo ucfirst($project['government_level']); ?></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h3 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="project-desc"><?php echo htmlspecialchars($project['description']); ?></p>
                            <div class="project-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user-tie"></i>
                                    <span><?php echo htmlspecialchars($project['manager_name']); ?></span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-layer-group"></i>
                                    <span><?php echo ucfirst($project['government_level']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="view-btn view-project" data-project='<?php echo json_encode($project); ?>'>View Details</button>
                            <button class="like-btn" data-project-id="<?php echo $project['id']; ?>">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Cross Navigation -->
<section class="cross-navigation">
    <div class="container">
        <h2 class="nav-title">Explore More</h2>
        <div class="nav-grid">
            <div class="nav-card">
                <a href="projects.php" class="nav-link-card">
                    <div class="nav-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h4>All Projects</h4>
                    <p>Complete project overview with detailed information and timelines</p>
                </a>
            </div>
            <div class="nav-card">
                <a href="projects-completed.php" class="nav-link-card">
                    <div class="nav-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4>Completed Projects</h4>
                    <p>Detailed information about our successfully delivered projects</p>
                </a>
            </div>
            <div class="nav-card">
                <a href="services.php" class="nav-link-card">
                    <div class="nav-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h4>Our Services</h4>
                    <p>Discover the full range of construction and engineering services we offer</p>
                </a>
            </div>
            <div class="nav-card">
                <a href="contact.php" class="nav-link-card">
                    <div class="nav-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4>Start Project</h4>
                    <p>Begin your construction journey with our expert team</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Project Modal -->
<div class="modal fade project-modal" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalProjectImage" src="" alt="Project" class="modal-project-image">
                <h3 id="modalProjectTitle" class="modal-project-title"></h3>
                <p id="modalProjectDesc" class="modal-project-desc"></p>
                
                <div class="modal-project-meta">
                    <div class="modal-meta-item">
                        <i class="fas fa-user-tie"></i>
                        <span>Project Manager: <strong id="modalProjectManager"></strong></span>
                    </div>
                    <div class="modal-meta-item">
                        <i class="fas fa-layer-group"></i>
                        <span>Government Level: <strong id="modalProjectLevel"></strong></span>
                    </div>
                    <div class="modal-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Completion Date: <strong id="modalProjectDate"></strong></span>
                    </div>
                    <div class="modal-meta-item">
                        <i class="fas fa-tags"></i>
                        <span>Category: <strong id="modalProjectCategory"></strong></span>
                    </div>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="contact.php" class="btn view-btn">
                        <i class="fas fa-paper-plane me-2"></i>Start Similar Project
                    </a>
                    <button class="btn like-btn" id="modalLikeBtn">
                        <i class="far fa-heart me-2"></i>Save Project
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create floating background elements
    const floatingContainer = document.getElementById('floatingElements');
    for (let i = 0; i < 20; i++) {
        const element = document.createElement('div');
        element.classList.add('floating-element');
        
        // Random size and position
        const size = Math.random() * 120 + 30;
        element.style.width = `${size}px`;
        element.style.height = `${size}px`;
        element.style.left = `${Math.random() * 100}%`;
        element.style.top = `${Math.random() * 100 + 100}%`;
        
        // Random animation
        element.style.animationDuration = `${Math.random() * 25 + 15}s`;
        element.style.animationDelay = `${Math.random() * 5}s`;
        
        floatingContainer.appendChild(element);
    }
    
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');
            
            const filterValue = button.getAttribute('data-filter');
            
            projectCards.forEach(card => {
                if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 400);
                }
            });
        });
    });
    
    // Like button functionality
    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            
            if (this.classList.contains('active')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                // In a real app, you would save this to localStorage or send to server
                localStorage.setItem(`liked-${this.getAttribute('data-project-id')}`, 'true');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                localStorage.removeItem(`liked-${this.getAttribute('data-project-id')}`);
            }
        });
        
        // Check if project was previously liked
        const projectId = button.getAttribute('data-project-id');
        if (localStorage.getItem(`liked-${projectId}`)) {
            button.classList.add('active');
            const icon = button.querySelector('i');
            icon.classList.remove('far');
            icon.classList.add('fas');
        }
    });
    
    // Project modal functionality
    const viewButtons = document.querySelectorAll('.view-project');
    const projectModal = new bootstrap.Modal(document.getElementById('projectModal'));
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const projectData = JSON.parse(this.getAttribute('data-project'));
            
            // Populate modal with project data
            document.getElementById('modalProjectImage').src = projectData.image || projectData.image_path || 'assets/images/5.jpg';
            document.getElementById('modalProjectTitle').textContent = projectData.title;
            document.getElementById('modalProjectDesc').textContent = projectData.description;
            document.getElementById('modalProjectManager').textContent = projectData.manager_name || 'David Banda';
            document.getElementById('modalProjectLevel').textContent = projectData.government_level ? projectData.government_level.charAt(0).toUpperCase() + projectData.government_level.slice(1) : 'Commercial';
            document.getElementById('modalProjectDate').textContent = projectData.completion_date || '2023';
            document.getElementById('modalProjectCategory').textContent = projectData.category ? projectData.category.charAt(0).toUpperCase() + projectData.category.slice(1) : 'Construction';
            
            // Set up modal like button
            const modalLikeBtn = document.getElementById('modalLikeBtn');
            modalLikeBtn.setAttribute('data-project-id', projectData.id);
            
            if (localStorage.getItem(`liked-${projectData.id}`)) {
                modalLikeBtn.classList.add('active');
                modalLikeBtn.innerHTML = '<i class="fas fa-heart me-2"></i>Saved';
            } else {
                modalLikeBtn.classList.remove('active');
                modalLikeBtn.innerHTML = '<i class="far fa-heart me-2"></i>Save Project';
            }
            
            // Show modal
            projectModal.show();
        });
    });
    
    // Modal like button functionality
    document.getElementById('modalLikeBtn').addEventListener('click', function() {
        this.classList.toggle('active');
        const projectId = this.getAttribute('data-project-id');
        
        if (this.classList.contains('active')) {
            this.innerHTML = '<i class="fas fa-heart me-2"></i>Saved';
            localStorage.setItem(`liked-${projectId}`, 'true');
            
            // Update the corresponding card like button
            const cardLikeBtn = document.querySelector(`.like-btn[data-project-id="${projectId}"]`);
            if (cardLikeBtn) {
                cardLikeBtn.classList.add('active');
                const icon = cardLikeBtn.querySelector('i');
                icon.classList.remove('far');
                icon.classList.add('fas');
            }
        } else {
            this.innerHTML = '<i class="far fa-heart me-2"></i>Save Project';
            localStorage.removeItem(`liked-${projectId}`);
            
            // Update the corresponding card like button
            const cardLikeBtn = document.querySelector(`.like-btn[data-project-id="${projectId}"]`);
            if (cardLikeBtn) {
                cardLikeBtn.classList.remove('active');
                const icon = cardLikeBtn.querySelector('i');
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        }
    });
    
    // Add scroll animation to project cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all project cards
    document.querySelectorAll('.project-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>