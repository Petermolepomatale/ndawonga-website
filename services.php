<?php
$pageTitle = "Services";
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/database.php';
include __DIR__ . '/includes/header.php';

$database = new Database();
$db = $database->getConnection();
?>

<!-- Hero Section -->
<section class="services-hero position-relative text-white text-center d-flex align-items-center justify-content-center" style="background-image: url('/assets/images/4.jpg'); background-size: cover; background-position: center; height: 80vh;">
    <div class="overlay-dark"></div>
    <div class="hero-content position-relative z-3">
        <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="services-hero-logo mb-4" data-aos="zoom-in">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-down">Our Services</h1>
        <p class="lead mb-4" data-aos="fade-up">Comprehensive Civil Engineering, Construction & Environmental Solutions</p>
        <a href="#services-list" class="btn btn-warning rounded-pill shadow px-5">Explore Services</a>
    </div>
</section>

<!-- Services Section -->
<section id="services-list" class="py-5 bg-light position-relative overflow-hidden">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary" data-aos="zoom-in">What We Do Best</h2>
            <p class="text-muted">Our multidisciplinary expertise ensures we deliver excellence across all sectors.</p>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-auto">
                <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="civil">Civil</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="waste">Waste</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="construction">Construction</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="maintenance">Maintenance</button>
            </div>
        </div>

        <div class="row" id="service-container">
            <?php
            $services = [];
            if ($db) {
                try {
                    $query = "SELECT * FROM services WHERE is_active = 1 ORDER BY display_order";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    error_log('Services query error: ' . $e->getMessage());
                }
            }

            if (!empty($services)) {
                foreach ($services as $service) {
                    $category = strtolower(str_replace(' ', '', $service['category'] ?? 'general'));
                    echo '
                    <div class="col-md-6 col-lg-4 mb-4 service-item" data-category="' . htmlspecialchars($category) . '" data-aos="fade-up">
                        <div class="service-card p-4 h-100 shadow-lg border-0 rounded-4" data-tilt>
                            <div class="text-center mb-3">
                                <i class="fas ' . htmlspecialchars($service['icon_class']) . ' fa-3x text-warning" aria-hidden="true"></i>
                            </div>
                            <h5 class="fw-bold text-primary mb-2">' . htmlspecialchars($service['title']) . '</h5>
                            <p class="text-muted">' . htmlspecialchars($service['description']) . '</p>
                            <a href="contact.php?service=' . urlencode($service['title']) . '" class="btn btn-warning rounded-pill px-4 mt-3">Get Quote</a>
                        </div>
                    </div>';
                }
            } else {
                $fallback = [
                    ['title' => 'Civil Engineering', 'description' => 'Road construction, earthworks, and infrastructure development', 'icon_class' => 'fa-road', 'category' => 'civil'],
                    ['title' => 'Waste Management', 'description' => 'Comprehensive waste management and recycling services', 'icon_class' => 'fa-trash-alt', 'category' => 'waste'],
                    ['title' => 'Construction Projects', 'description' => 'Building and infrastructure project management', 'icon_class' => 'fa-building', 'category' => 'construction'],
                    ['title' => 'Maintenance Services', 'description' => 'Ongoing maintenance and technical support', 'icon_class' => 'fa-tools', 'category' => 'maintenance'],
                ];
                foreach ($fallback as $service) {
                    echo '
                    <div class="col-md-6 col-lg-4 mb-4 service-item" data-category="' . htmlspecialchars($service['category']) . '" data-aos="fade-up">
                        <div class="service-card p-4 h-100 shadow-lg border-0 rounded-4" data-tilt>
                            <div class="text-center mb-3">
                                <i class="fas ' . htmlspecialchars($service['icon_class']) . ' fa-3x text-warning" aria-hidden="true"></i>
                            </div>
                            <h5 class="fw-bold text-primary mb-2">' . htmlspecialchars($service['title']) . '</h5>
                            <p class="text-muted">' . htmlspecialchars($service['description']) . '</p>
                            <a href="contact.php" class="btn btn-warning rounded-pill px-4 mt-3">Get Quote</a>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 text-white text-center" style="background: linear-gradient(135deg, #1a365d, #2d3748);">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3"><h2 class="fw-bold counter" data-target="120">0</h2><p>Projects Completed</p></div>
            <div class="col-md-3"><h2 class="fw-bold counter" data-target="80">0</h2><p>Satisfied Clients</p></div>
            <div class="col-md-3"><h2 class="fw-bold counter" data-target="15">0</h2><p>Years Experience</p></div>
            <div class="col-md-3"><h2 class="fw-bold counter" data-target="20">0</h2><p>Awards Earned</p></div>
        </div>
    </div>
</section>

<!-- Capabilities Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Service Capabilities</h2>
            <p class="text-muted">We combine expertise and technology to deliver end-to-end infrastructure excellence.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold text-warning mb-3"><i class="fas fa-hard-hat me-2"></i> Civil Engineering</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Road Construction & Rehabilitation</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Bulk Earthworks</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Water & Sanitation Infrastructure</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Stormwater Management</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Bridge & Culvert Construction</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold text-warning mb-3"><i class="fas fa-recycle me-2"></i> Waste Management</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Solid Waste Collection</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Recycling Programs</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Landfill Management</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Waste-to-Energy Projects</li>
                        <li><i class="fas fa-check text-success me-2" aria-hidden="true"></i> Environmental Compliance</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industry Sectors Carousel (NEW) -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Industry Sectors</h2>
            <p class="text-muted">We deliver across government and commercial spheres</p>
        </div>

        <div class="sectors-wrapper position-relative">
            <button class="sector-nav left" aria-label="Scroll left">&lt;</button>

            <div class="sectors-track" id="sectorsTrack" tabindex="0" role="list">
                <!-- hardcoded sectors (replace or extend as needed) -->
                <?php
                $sectors = [
                    ['title' => 'Municipal', 'icon' => 'fa-city', 'image' => '/assets/images/18.jpg'],
                    ['title' => 'Commercial', 'icon' => 'fa-store', 'image' => '/assets/images/19.jpg'],
                    ['title' => 'Environmental', 'icon' => 'fa-leaf', 'image' => '/assets/images/20.jpg'],
                    ['title' => 'Residential', 'icon' => 'fa-home', 'image' => '/assets/images/21.jpg'],
                    ['title' => 'Industrial', 'icon' => 'fa-industry', 'image' => '/assets/images/22.jpg'],
                    ['title' => 'Infrastructure', 'icon' => 'fa-road', 'image' => '/assets/images/23.jpg'],
                ];
                foreach ($sectors as $s): ?>
                    <div class="sector-card" role="listitem" data-aos="fade-left">
                        <div class="sector-bg" style="background-image: url('<?php echo $s['image']; ?>');"></div>
                        <div class="sector-content">
                            <i class="fas <?php echo $s['icon']; ?> sector-icon" aria-hidden="true"></i>
                            <h5 class="sector-title"><?php echo htmlspecialchars($s['title']); ?></h5>
                            <p class="sector-desc">Expert services tailored for <?php echo htmlspecialchars(strtolower($s['title'])); ?> projects.</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="sector-nav right" aria-label="Scroll right">&gt;</button>
        </div>
    </div>
</section>

<!-- Floating Contact CTA -->
<div class="floating-cta">
    <a href="/contact.php" class="btn btn-warning rounded-pill shadow-lg px-4 py-2">
        <i class="fas fa-envelope me-2" aria-hidden="true"></i> Contact Us
    </a>
</div>

<!-- Dependencies -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://unpkg.com/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
/* core visuals */
.overlay-dark { position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.55); }

/* Services Hero Logo */
.services-hero-logo {
    width: 120px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    border: 2px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
}

.services-hero-logo:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(0,0,0,0.5);
}
.services-hero { position: relative; height: 80vh; display:flex; align-items:center; justify-content:center; }
.hero-content { z-index: 3; }
.service-card { background:#fff; transition:all .45s cubic-bezier(.2,.8,.2,1); border-radius:14px; }
.service-card:hover { transform: translateY(-10px) rotateX(0.5deg); box-shadow: 0 18px 40px rgba(0,0,0,0.12); }
.glass-card { background: rgba(255,255,255,0.98); border-radius:16px; box-shadow: 0 8px 30px rgba(0,0,0,0.06); }

/* sectors carousel */
.sectors-wrapper { position: relative; margin: 0 auto; }
.sectors-track { display:flex; gap:20px; overflow:hidden; padding:20px 40px; scroll-behavior: smooth; }
.sector-card { min-width:260px; max-width:320px; height:360px; border-radius:16px; position:relative; overflow:hidden; cursor:grab; flex: 0 0 auto; box-shadow: 0 12px 30px rgba(0,0,0,0.08); transition: transform .35s ease, box-shadow .35s ease; }
.sector-card:active { cursor:grabbing; }
.sector-bg { position:absolute; inset:0; background-size:cover; background-position:center; filter:brightness(.55); transform: scale(1.06); transition: transform 0.6s ease; }
.sector-content { position:absolute; bottom:0; left:0; right:0; padding:20px; color:#fff; backdrop-filter: blur(6px); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.55) 60%); }
.sector-icon { font-size:32px; background: rgba(255,255,255,0.12); padding:14px; border-radius:50%; display:inline-block; margin-bottom:12px; color:#ffd966; }
.sector-title { font-weight:700; margin:0 0 6px 0; }
.sector-desc { font-size:0.92rem; opacity:0.95; margin:0; }

/* hover pop & tilt */
.sector-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 26px 50px rgba(0,0,0,0.16); }
.sector-card:hover .sector-bg { transform: scale(1.12); }

/* nav arrows */
.sector-nav { position:absolute; top:50%; transform:translateY(-50%); width:46px; height:46px; border-radius:50%; border:0; background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.12); z-index:5; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; }
.sector-nav.left { left:8px; }
.sector-nav.right { right:8px; }

/* responsive */
@media(max-width: 992px) {
    .sector-card { min-width: 230px; height:320px; }
    .sectors-track { padding: 12px 20px; gap:14px; }
}
@media(max-width: 576px) {
    .services-hero { height: 60vh; }
    .sector-nav { display:none; }
}

/* misc */
.floating-cta { position:fixed; bottom:30px; right:30px; z-index:1000; }
.filter-btn.active { background:#1a365d; color:#fff; border-color:#1a365d; }
.counter { font-size:2.5rem; color:#ffd700; }
</style>

<script>
AOS.init({ once: true, duration: 800 });
VanillaTilt.init(document.querySelectorAll("[data-tilt]"), { max: 10, speed: 400, glare: true, "max-glare": 0.12 });

// filter buttons
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.service-item').forEach(item => {
            item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'block' : 'none';
        });
    });
});

// counters
document.querySelectorAll('.counter').forEach(counter => {
    const animate = () => {
        const target = +counter.getAttribute('data-target');
        const speed = 200;
        let count = 0;
        const step = Math.ceil(target / speed);
        const tick = () => {
            count += step;
            if (count < target) {
                counter.textContent = count;
                requestAnimationFrame(tick);
            } else {
                counter.textContent = target;
            }
        };
        tick();
    };
    // trigger when in view
    const obs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animate();
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.6 });
    obs.observe(counter);
});

/* Sectors track auto-scroll + manual nav + pause-on-hover */
const track = document.getElementById('sectorsTrack');
let autoScrollSpeed = 0.6; // px per frame-ish
let isPaused = false;

// continuous auto scroll using RAF
let scrollPos = 0;
function autoScroll() {
    if (!isPaused) {
        scrollPos += autoScrollSpeed;
        // loop when reaching end
        if (scrollPos >= (track.scrollWidth - track.clientWidth)) scrollPos = 0;
        track.scrollLeft = scrollPos;
    }
    requestAnimationFrame(autoScroll);
}
requestAnimationFrame(autoScroll);

// pause on hover / focus
track.addEventListener('mouseenter', () => isPaused = true);
track.addEventListener('mouseleave', () => isPaused = false);
track.addEventListener('focusin', () => isPaused = true);
track.addEventListener('focusout', () => isPaused = false);

// drag-to-scroll (nice UX for touch/desktop)
let isDown = false, startX, scrollLeft;
track.addEventListener('mousedown', (e) => {
    isDown = true; track.classList.add('dragging');
    startX = e.pageX - track.offsetLeft;
    scrollLeft = track.scrollLeft;
});
track.addEventListener('mouseleave', () => { isDown = false; track.classList.remove('dragging'); });
track.addEventListener('mouseup', () => { isDown = false; track.classList.remove('dragging'); });
track.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    const x = e.pageX - track.offsetLeft;
    const walk = (x - startX) * 1; // scroll-fast multiplier
    track.scrollLeft = scrollLeft - walk;
    scrollPos = track.scrollLeft;
});

// nav arrows
document.querySelectorAll('.sector-nav').forEach(btn => {
    btn.addEventListener('click', () => {
        isPaused = true;
        const amt = (track.clientWidth * 0.6); // how much to scroll
        if (btn.classList.contains('left')) {
            smoothScrollTo(track, Math.max(0, track.scrollLeft - amt), 400);
        } else {
            smoothScrollTo(track, Math.min(track.scrollWidth, track.scrollLeft + amt), 400);
        }
        setTimeout(()=> isPaused = false, 700);
    });
});

// small smooth scroll util
function smoothScrollTo(el, to, duration) {
    const start = el.scrollLeft, change = to - start, startTime = performance.now();
    function animateScroll(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        el.scrollLeft = start + change * easeInOutQuad(progress);
        if (progress < 1) requestAnimationFrame(animateScroll);
    }
    requestAnimationFrame(animateScroll);
}
function easeInOutQuad(t){ return t<0.5 ? 2*t*t : -1+(4-2*t)*t; }

// small accessibility: allow keyboard arrow nav when track focused
track.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') smoothScrollTo(track, track.scrollLeft + 300, 300);
    if (e.key === 'ArrowLeft') smoothScrollTo(track, track.scrollLeft - 300, 300);
});

</script>

<!-- Clients Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Our Trusted Clients</h2>
            <p class="text-muted">We're proud to serve leading organizations across South Africa</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/City of Johannesburg.png" alt="City of Johannesburg" class="client-logo-services">
                    <h6 class="mt-3 mb-0">City of Johannesburg</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/Gauteng Province.jpeg" alt="Gauteng Province" class="client-logo-services">
                    <h6 class="mt-3 mb-0">Gauteng Province</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/Department of Public Works.jpeg" alt="Department of Public Works" class="client-logo-services">
                    <h6 class="mt-3 mb-0">Department of Public Works</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/Ekurhuleni Metro.png" alt="Ekurhuleni Metro" class="client-logo-services">
                    <h6 class="mt-3 mb-0">Ekurhuleni Metro</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/Transnet.jpeg" alt="Transnet" class="client-logo-services">
                    <h6 class="mt-3 mb-0">Transnet</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/Eskom.jpg" alt="Eskom" class="client-logo-services">
                    <h6 class="mt-3 mb-0">Eskom</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/SANRAL (South African National Roads Agency).jpg" alt="SANRAL" class="client-logo-services">
                    <h6 class="mt-3 mb-0">SANRAL</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="client-logo-card text-center p-4">
                    <img src="assets/images/Water Affairs.png" alt="Water Affairs" class="client-logo-services">
                    <h6 class="mt-3 mb-0">Water Affairs</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.client-logo-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #eee;
}

.client-logo-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.client-logo-services {
    max-width: 100px;
    max-height: 60px;
    object-fit: contain;
    transition: all 0.3s ease;
}

.client-logo-card:hover .client-logo-services {
    transform: scale(1.1);
}

.client-logo-card h6 {
    color: #333;
    font-size: 0.9rem;
    font-weight: 600;
}
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
