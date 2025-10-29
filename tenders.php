<?php
$pageTitle = "Tenders";
require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';
?>

<style>
/* 🌟 Beautiful Custom Styling */
.tender-section {
    background: linear-gradient(135deg, #eef2f3 0%, #8e9eab 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 100px;
    padding-bottom: 80px;
}

.tender-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    border: 1px solid rgba(255,255,255,0.3);
}

.tender-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.tender-icon {
    font-size: 4rem;
    color: #007bff;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.section-title {
    font-weight: 700;
    font-size: 2.5rem;
    letter-spacing: 1px;
    color: #333;
}

/* Tender Hero Logo */
.tender-hero-logo {
    width: 120px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
    animation: float 6s ease-in-out infinite;
}

.tender-hero-logo:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(0,0,0,0.3);
}

.lead {
    color: #555;
}

.btn-refresh {
    margin-top: 20px;
    border-radius: 30px;
    padding: 10px 25px;
    transition: all 0.3s ease;
}

.btn-refresh:hover {
    background-color: #007bff;
    color: white;
    transform: scale(1.05);
}

/* Smooth fade-in animation */
.fade-in {
    animation: fadeInUp 1s ease both;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(40px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<section class="tender-section">
    <div class="container text-center fade-in">
        <div class="mb-5">
            <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="tender-hero-logo mb-4">
            <h1 class="section-title">📄 Tenders</h1>
            <p class="lead">Explore our current and upcoming tender opportunities</p>
            <hr class="mx-auto" style="width: 80px; border: 2px solid #007bff; border-radius: 5px;">
        </div>

        <div class="card tender-card mx-auto p-5" style="max-width: 700px;">
            <div class="card-body">
                <i class="fas fa-briefcase tender-icon mb-4"></i>
                <h4 class="mb-3 fw-bold text-dark">No Tenders Available</h4>
                <p class="text-muted mb-4">We currently have no open tenders. Please check back soon or contact us for more information.</p>
                <a href="#" class="btn btn-outline-primary btn-refresh">
                    <i class="fas fa-sync-alt me-2"></i>Refresh
                </a>
            </div>
        </div>

        <div class="mt-5 text-muted small">
            <i class="fas fa-clock me-2"></i>Last Updated: <?php echo date("F j, Y, g:i a"); ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
