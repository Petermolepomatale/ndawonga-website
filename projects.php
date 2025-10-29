<?php
$pageTitle = "Projects";
define('NDAWONGA_SECURE', true);
require_once __DIR__ . '/config.php';

// Fetch projects from database with error handling
$projects = [];
if ($pdo) {
    try {
        $query = "SELECT 
            id, title, slug, category, description, full_description,
            client_name, location, start_date, end_date, budget, status,
            featured_image, is_featured, views_count, created_at, updated_at
            FROM projects 
            WHERE status IN ('completed', 'in-progress', 'pending')
            ORDER BY is_featured DESC, created_at DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Projects query error: ' . $e->getMessage());
        $projects = [];
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="projects-hero position-relative text-white text-center d-flex align-items-center justify-content-center"
         style="background-image: url('/assets/images/14.jpg'); background-size: cover; background-position: center; height: 75vh;">
    <div class="overlay-dark"></div>
    <div class="hero-content position-relative z-3" data-aos="fade-up">
        <h1 class="display-4 fw-bold mb-3">Our Projects. Our Legacy.</h1>
        <p class="lead mb-4">Engineering excellence and construction mastery, shaping tomorrow’s infrastructure.</p>
        <a href="#projects-grid" class="btn btn-warning rounded-pill px-5 shadow-lg">View Portfolio</a>
    </div>
</section>

<section class="py-5" style="margin-top: 20px;">
    <div class="container">

        <!-- Filter Bar -->
        <div class="text-center mb-5" data-aos="zoom-in">
            <div class="filter-bar shadow-sm p-2 rounded-pill bg-white d-inline-flex">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="civil_engineering">Civil Engineering</button>
                <button class="filter-btn" data-filter="waste_management">Waste Management</button>
                <button class="filter-btn" data-filter="construction">Construction</button>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="row" id="projects-grid">
            <?php if (count($projects) > 0): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="col-lg-4 col-md-6 mb-4 project-item" data-category="<?php echo htmlspecialchars($project['category'] ?? 'construction'); ?>" data-aos="fade-up">
                        <div class="project-card">
                            <div class="project-image-wrapper">
                                <img src="<?php echo $project['featured_image'] ?: 'assets/images/project-placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="img-fluid rounded-top">
                            </div>
                            <div class="project-info">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($project['title']); ?></h5>
                                <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i><?php echo htmlspecialchars($project['location']); ?></p>
                                <p class="text-muted small"><?php echo substr($project['description'], 0, 100) . '...'; ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        <?php 
                                        if (!empty($project['start_date'])) {
                                            echo date('M Y', strtotime($project['start_date']));
                                            if (!empty($project['end_date'])) {
                                                echo ' - ' . date('M Y', strtotime($project['end_date']));
                                            }
                                        }
                                        ?>
                                    </small>
                                    <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#projectModal<?php echo $project['id']; ?>">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Modal -->
                    <div class="modal fade" id="projectModal<?php echo $project['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold"><?php echo htmlspecialchars($project['title']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo $project['featured_image'] ?: 'assets/images/project-placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="img-fluid mb-3 rounded">
                                    <p><strong>Location:</strong> <?php echo htmlspecialchars($project['location']); ?></p>
                                    <?php if (!empty($project['start_date'])): ?>
                                        <p><strong>Duration:</strong> 
                                            <?php echo date('M Y', strtotime($project['start_date'])); ?>
                                            <?php if (!empty($project['end_date'])): ?>
                                                - <?php echo date('M Y', strtotime($project['end_date'])); ?>
                                            <?php endif; ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($project['budget'])): ?>
                                        <p><strong>Budget:</strong> R <?php echo number_format((float)$project['budget'], 2); ?></p>
                                    <?php endif; ?>
                                    <p><strong>Description:</strong></p>
                                    <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="card shadow-sm border-0">
                        <div class="card-body py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Projects Available</h5>
                            <p class="text-muted">Check back later for our latest projects.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Animations & Script -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>AOS.init({ once: true, duration: 900, offset: 120 });</script>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const buttons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('#projects-grid .project-item');
    buttons.forEach(btn => btn.addEventListener('click', function(){
        buttons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.getAttribute('data-filter');
        items.forEach(item => {
            const cat = item.getAttribute('data-category');
            item.style.display = (filter === 'all' || filter === cat) ? '' : 'none';
        });
    }));
});
</script>

<style>
/* Hero */
.projects-hero { position: relative; overflow: hidden; background-attachment: fixed; }
.overlay-dark { position: absolute; inset: 0; background: rgba(0,0,0,0.55); z-index: 1; }
.projects-hero .hero-content { z-index: 3; max-width: 800px; padding: 0 15px; }
.projects-hero h1 { text-shadow: 0 4px 10px rgba(0,0,0,0.5); }
.projects-hero p { color: #f1f1f1; text-shadow: 0 2px 6px rgba(0,0,0,0.3); }
.projects-hero .btn { transition: all 0.3s ease; }
.projects-hero .btn:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(255,193,7,0.4); }

/* Filter Bar */
.filter-bar { background:#fff; border-radius:50px; display:inline-flex; box-shadow:0 6px 20px rgba(0,0,0,0.1); }
.filter-btn {
    border:none; background:none; padding:10px 24px; border-radius:50px;
    font-weight:600; color:#1a365d; cursor:pointer; transition:all .3s ease;
}
.filter-btn.active, .filter-btn:hover {
    background:#1a365d; color:#fff; box-shadow:0 4px 14px rgba(26,54,93,0.3);
}

/* Project Cards */
.project-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
}
.project-card:hover { transform: translateY(-6px); box-shadow: 0 10px 35px rgba(0,0,0,0.15); }
.project-card img { transition: transform .6s ease; }
.project-card:hover img { transform: scale(1.1); filter: brightness(0.85); }
.project-info { padding: 20px; }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
