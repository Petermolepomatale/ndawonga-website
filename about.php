<?php
$pageTitle = "About Us";
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/database.php';
include __DIR__ . '/includes/header.php';

$database = new Database();
$db = $database->getConnection();

// Helper: produce an image URL for images stored at /assets/images/1.jpg ... /assets/images/26.jpg
function imgPath($n) {
    return '/assets/images/' . intval($n) . '.jpg';
}
?>

<!-- Enhanced About Page -->
<section class="hero-immersive">
    <div class="hero-media" id="heroMedia">
        <!-- will be filled by JS: parallax slideshow using images 1..3 -->
    </div>
    <div class="hero-overlay">
        <div class="container hero-content">
            <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="hero-logo mb-4">
            <h1 class="hero-title">Ndawonga Trading &amp; Projects</h1>
            <p class="hero-sub">100% Black-Owned Civil Engineering &amp; Waste Management — Building South Africa's future.</p>
            <div class="hero-cta">
                <a href="#our-story" class="btn btn-primary">Our Story</a>
                <a href="#leadership" class="btn btn-ghost">Meet the Team</a>
            </div>
            <div class="hero-meta">
                <div class="meta-item">
                    <strong class="meta-number" data-count="50">0</strong>
                    <span>Projects</span>
                </div>
                <div class="meta-item">
                    <strong class="meta-number" data-count="15">0</strong>
                    <span>Years</span>
                </div>
                <div class="meta-item">
                    <strong class="meta-number" data-count="100">0</strong>
                    <span>% Satisfaction</span>
                </div>
            </div>
        </div>
        <a href="#our-story" class="scroll-down" aria-label="Scroll down">
            <span></span>
        </a>
    </div>
</section>

<section id="our-story" class="py-5 bg-light glass-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-tilt data-tilt-scale="1.02">
                <div class="glass-card p-4">
                    <h2>Building Excellence Since 2012</h2>
                    <p class="lead">Ndawonga Trading and Projects Co-operative Ltd was founded in 2012 by a team of highly qualified professionals. This co-operative is 100% black owned and 51% owned by women and military veterans. We are a Level 1 B-BBEE company with CIDB grades 5CE, 4ME, 4SO, 2GB PE, 2SQ PE and 1EB.</p>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <h5 class="mb-1 text-primary">Our Mission</h5>
                            <p>We are driven by the need to provide long term quality solutions to our customers which in turn will lead to solid relationships. Through continued innovation, customer focus, leveraging off our efficiencies, skills development of our staff and the environment, we will strive to meet our customer requirements, supplier, staff and shareholders return expectations, responsibly, honestly and with integrity.</p>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-1 text-primary">Our Vision</h5>
                            <p>To be the construction contractor of choice to our customers, delivering quality work backed by service excellence, knowledgeable and experienced staff.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="interactive-visual">
                    <!-- a rotating mosaic built from your images 4..9 -->
                    <div class="mosaic">
                        <?php for ($i=4; $i<=9; $i++): ?>
                            <div class="mosaic-item"><img src="<?= imgPath($i) ?>" loading="lazy" alt="Ndawonga image <?= $i ?>"></div>
                        <?php endfor; ?>
                    </div>
                    <div class="mosaic-overlay">
                        <h4>15+ Years</h4>
                        <p>Delivering transformational infrastructure</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CIDB & Certifications -->
<section class="py-5 cidb-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Certifications &amp; CIDB Grades</h2>
            <p class="lead">Recognised industry certifications and active CIDB registrations</p>
        </div>
        <div class="row gx-4">
            <div class="col-md-6">
                <div class="cidb-cards">
                    <div class="cidb-card metallic">
                        <div class="cidb-icon">CIDB</div>
                        <h5>Registered Contractor</h5>
                        <p class="muted">Construction Industry Development Board</p>
                    </div>
                    <div class="grades">
                        <?php $grades = ['5CE'=>'Civil Engineering (Grade 5)','4SO'=>'Site Operations (Grade 4)','4ME'=>'Mechanical Engineering (Grade 4)','2GB'=>'General Building (Grade 2)','2SQA'=>'Specialist Quality Assurance (Grade 2)'];
                        foreach ($grades as $key=>$desc): ?>
                            <div class="grade">
                                <span class="badge-grade"><?= $key ?></span>
                                <div class="grade-desc"><?= $desc ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="cert-list p-3">
                    <h6>Additional Certifications</h6>
                    <ul>
                        <li>B-BBEE Level 1</li>
                        <li>ISO 9001:2015</li>
                        <li>OHSAS 18001</li>
                    </ul>
                    <div class="ring-stats mt-4">
                        <div class="ring" data-value="0.85">
                            <svg viewBox="0 0 36 36" class="circular"><path class="bg" d="M18 2.0845a15.9155 15.9155 0 1 0 0 31.831a15.9155 15.9155 0 1 0 0-31.831"/></svg>
                            <div class="ring-label"><strong>85%</strong><small>Waste Diverted</small></div>
                        </div>
                        <div class="ring" data-value="0.60">
                            <svg viewBox="0 0 36 36" class="circular"><path class="bg" d="M18 2.0845a15.9155 15.9155 0 1 0 0 31.831a15.9155 15.9155 0 1 0 0-31.831"/></svg>
                            <div class="ring-label"><strong>50+</strong><small>Locations</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Section -->
<section id="leadership" class="py-5 leaders-section bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Leadership</h2>
            <p class="lead">The people who make Ndawonga happen</p>
        </div>
        <div class="row g-4">
            <?php
            $leaders = [
                ['name'=>'Mr David Banda','role'=>'Operations Director','img'=>11],
                ['name'=>'Mr Thato Manda','role'=>'HR & PR Director','img'=>12],
                ['name'=>'Mr Mike Msisinyane','role'=>'Construction Manager','img'=>13],
                ['name'=>'Ms Lorraine Mbaba','role'=>'Finance & Admin Manager','img'=>14],
                ['name'=>'Mr Neo Cheka','role'=>'Administrator','img'=>15],
                ['name'=>'Mr Istifaa Malenyane','role'=>'Site Supervisor','img'=>16],
                ['name'=>'Mr Shisana Hlatela','role'=>'Safety Officer','img'=>17],
            ];
            foreach ($leaders as $idx => $l): ?>
                <div class="col-md-4">
                    <div class="leader-card" data-tilt data-tilt-max="8">
                        <div class="leader-media">
                            <img src="<?= imgPath($l['img']) ?>" alt="<?= htmlspecialchars($l['name']) ?>" loading="lazy">
                        </div>
                        <div class="leader-body">
                            <h5><?= htmlspecialchars($l['name']) ?></h5>
                            <p class="role small muted"><?= htmlspecialchars($l['role']) ?></p>
                            <p class="small"><?= ($l['role'] === 'Operations Director') ? 'Designing and executing operational strategy, budgets and stakeholder relationships.' : 'Responsible for leadership and delivery within their function.' ?></p>
                            <div class="leader-meta">
                                <button class="btn btn-sm btn-outline" data-bs-toggle="modal" data-bs-target="#leadModal<?= $idx ?>">Read more</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="leadModal<?= $idx ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?= htmlspecialchars($l['name']) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5"><img src="<?= imgPath($l['img']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($l['name']) ?>"></div>
                                        <div class="col-md-7">
                                            <h6><?= htmlspecialchars($l['role']) ?></h6>
                                            <p class="small muted">Detailed responsibilities and accomplishments.</p>
                                            <ul>
                                                <li>Leadership &amp; day-to-day management</li>
                                                <li>Project oversight &amp; stakeholder engagement</li>
                                                <li>Health, safety &amp; quality compliance</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Projects Tracker -->
<section class="py-5 projects-tracker bg-gradient">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Project Tracker</h2>
            <p class="lead">Track scope, cost and schedule across government and commercial spheres</p>
        </div>
        <div class="tracker-grid">
            <div class="tracker-card">
                <h6>National</h6>
                <div class="progress" data-progress="0.72"><span style="width:0%"></span></div>
                <div class="tracker-details"><span>Scope: 72%</span><span>ETA: 12 months</span></div>
            </div>
            <div class="tracker-card">
                <h6>Provincial</h6>
                <div class="progress" data-progress="0.56"><span style="width:0%"></span></div>
                <div class="tracker-details"><span>Scope: 56%</span><span>ETA: 8 months</span></div>
            </div>
            <div class="tracker-card">
                <h6>Municipal</h6>
                <div class="progress" data-progress="0.88"><span style="width:0%"></span></div>
                <div class="tracker-details"><span>Scope: 88%</span><span>ETA: 4 months</span></div>
            </div>
            <div class="tracker-card">
                <h6>Commercial</h6>
                <div class="progress" data-progress="0.40"><span style="width:0%"></span></div>
                <div class="tracker-details"><span>Scope: 40%</span><span>ETA: 6 months</span></div>
            </div>
        </div>
    </div>
</section>

<!-- Clients Wheel -->
<section class="py-5 clients-wheel bg-white">
    <div class="container text-center">
        <h2>Our Valued Clients</h2>
        <p class="lead">Trusted partnerships across sectors</p>
        <div class="wheel" id="clientWheel">
            <div class="wheel-item"><img src="assets/images/City of Johannesburg.png" alt="City of Johannesburg" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/Gauteng Province.jpeg" alt="Gauteng Province" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/Department of Public Works.jpeg" alt="Department of Public Works" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/Ekurhuleni Metro.png" alt="Ekurhuleni Metro" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/Transnet.jpeg" alt="Transnet" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/Eskom.jpg" alt="Eskom" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/SANRAL (South African National Roads Agency).jpg" alt="SANRAL" loading="lazy"></div>
            <div class="wheel-item"><img src="assets/images/Water Affairs.png" alt="Water Affairs" loading="lazy"></div>
        </div>
    </div>
</section>

<!-- Testimonials (kept simple but stylish) -->
<section class="py-5 testimonials bg-light">
    <div class="container">
        <h2 class="text-center mb-4">What Our Clients Say</h2>
        <div class="test-grid">
            <blockquote class="quote">
                "Ndawonga Trading and Projects delivered exceptional results on our BRT infrastructure project. Their professionalism and attention to detail exceeded our expectations." <cite>— Sarah Mthembu, Rea Vaya</cite>
            </blockquote>
            <blockquote class="quote">
                "Outstanding waste management solutions that transformed our operations. Ndawonga's innovative approach helped us achieve our sustainability goals." <cite>— Michael Johnson, Pick n Pay</cite>
            </blockquote>
            <blockquote class="quote">
                "Reliable, efficient, and committed to excellence. Ndawonga has been our trusted partner for multiple infrastructure projects." <cite>— Thabo Molefe, City of Johannesburg</cite>
            </blockquote>
        </div>
    </div>
</section>

<style>
/* ---------- Enhanced styles (scoped) ---------- */
:root{
  --brand:#1a365d;
  --accent:#d4af37;
  --glass: rgba(255,255,255,0.12);
}

/* Hero Logo Styles */
.hero-logo {
    width: 150px;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    border: 3px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
    animation: logoFloat 3s ease-in-out infinite;
}

.hero-logo:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(0,0,0,0.6);
}

@keyframes logoFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}
.hero-immersive{position:relative;height:70vh;min-height:420px;display:flex;align-items:center;}
.hero-media{position:absolute;inset:0;overflow:hidden;}
.hero-media .slide{position:absolute;inset:0;background-size:cover;background-position:center;transform:scale(1.05);filter:brightness(0.6);}
.hero-overlay{position:relative;z-index:5;width:100%;}
.hero-content{padding:40px 20px;color:#fff;text-align:left}
.hero-title{font-size:2.6rem;letter-spacing:0.5px;background:linear-gradient(90deg,var(--accent),#fff);-webkit-background-clip:text;background-clip:text;color:transparent}
.hero-sub{opacity:0.95;margin-top:10px}
.hero-cta .btn{margin-right:12px}
.hero-meta{display:flex;gap:20px;margin-top:18px}
.meta-item{background:rgba(255,255,255,0.06);padding:10px 14px;border-radius:12px}
.meta-number{font-weight:800;font-size:1.2rem;color:var(--accent)}
.scroll-down{position:absolute;bottom:18px;left:50%;transform:translateX(-50%);z-index:6}
.scroll-down span{display:block;width:28px;height:42px;border-radius:20px;border:2px solid rgba(255,255,255,0.7);position:relative}
.scroll-down span:after{content:'';position:absolute;left:50%;top:8px;width:6px;height:6px;border-radius:50%;background:#fff;transform:translateX(-50%);animation:down 1.6s infinite}
@keyframes down{0%{top:8px}50%{top:24px}100%{top:8px}}

.glass-section{backdrop-filter: blur(6px);}
.glass-card{background:linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));border-radius:14px}
.interactive-visual .mosaic{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.mosaic-item img{width:100%;height:120px;object-fit:cover;border-radius:10px;transform:translateZ(0);}
.mosaic-overlay{position:absolute;right:40px;top:40px;background:var(--brand);color:#fff;padding:18px;border-radius:12px}

.cidb-section .cidb-card{display:flex;flex-direction:column;align-items:flex-start;padding:20px;border-radius:12px;background:#fff}
.badge-grade{display:inline-block;padding:8px 12px;border-radius:20px;background:var(--brand);color:#fff;font-weight:700;margin-right:12px}
.grade{display:flex;align-items:center;margin-bottom:12px}
.ring-stats{display:flex;gap:20px}
.ring{width:120px;height:120px;position:relative}
.circular{width:100%;height:100%}
.circular .bg{fill:none;stroke:#eee;stroke-width:3}
.circular .progress{fill:none;stroke:var(--accent);stroke-width:3;stroke-linecap:round;stroke-dasharray:0 100}
.ring-label{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center}

.leader-card{background:linear-gradient(180deg,#fff,#fbfbfb);border-radius:12px;box-shadow:0 6px 20px rgba(26,54,93,0.08);overflow:hidden}
.leader-media img{width:100%;height:220px;object-fit:cover}
.leader-body{padding:16px}
.leader-meta .btn{margin-top:8px}

.projects-tracker .tracker-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}
.tracker-card{background:#fff;padding:18px;border-radius:12px}
.progress{height:12px;background:#e9eef6;border-radius:12px;overflow:hidden}
.progress span{display:block;height:100%;background:linear-gradient(90deg,var(--brand),var(--accent));width:0%;transition:width 1.4s ease}

.clients-wheel{display:flex;justify-content:center;align-items:center;overflow:hidden;padding:40px}
#wheel{transform:translateZ(0)}
.wheel{display:flex;gap:24px;align-items:center;justify-content:center;transform-style:preserve-3d}
.wheel-item{width:140px;height:80px;display:flex;align-items:center;justify-content:center;background:#fff;border-radius:12px;padding:12px;box-shadow:0 8px 30px rgba(0,0,0,0.08)}
.wheel-item img{max-width:100%;max-height:60px;object-fit:contain}

.test-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.quote{background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.06)}

/* Responsive tweaks */
@media(max-width:768px){.hero-title{font-size:1.8rem}.hero-meta{display:none}.mosaic-item img{height:90px}}
</style>

<!-- Dependencies (CDNs) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
// Build hero slides from images 1..3
const heroMedia = document.getElementById('heroMedia');
const heroImgs = [<?= "'" . imgPath(1) . "', '" . imgPath(2) . "', '" . imgPath(3) . "'" ?>];
heroImgs.forEach((src, i)=>{
    const div = document.createElement('div');
    div.className = 'slide';
    div.style.backgroundImage = `url(${src})`;
    div.style.opacity = i===0?1:0;
    heroMedia.appendChild(div);
});
// Simple crossfade
let hIndex=0; setInterval(()=>{
    const slides = document.querySelectorAll('.hero-media .slide, .hero-media .slide');
    const els = document.querySelectorAll('#heroMedia .slide')
    els.forEach((s, i)=> s.style.opacity = (i===hIndex?1:0));
    hIndex = (hIndex+1) % els.length;
},4500);

// GSAP parallax for hero
gsap.to('.hero-media .slide',{scale:1, ease:'none', scrollTrigger:{trigger:'.hero-immersive',start:'top top',end:'bottom top',scrub:true}})

// Counters
document.querySelectorAll('.meta-number').forEach(el=>{
    const target = parseInt(el.dataset.count || 0);
    let curr = 0; const step = Math.max(1, Math.floor(target/50));
    const t = setInterval(()=>{curr+=step; if(curr>=target){el.textContent=target; clearInterval(t)} else el.textContent=curr},30);
});

// Animate tracker bars
document.querySelectorAll('.projects-tracker .progress').forEach(bar=>{
    const pct = parseFloat(bar.dataset.progress||0)*100;
    setTimeout(()=>{bar.querySelector('span').style.width = pct + '%'},400);
});

// Wheel rotate animation
const wheel = document.getElementById('clientWheel');
let angle = 0; setInterval(()=>{angle+=0.2; wheel.style.transform = `rotateY(${angle}deg)`},30);

// Ring animations (simple stroke-dasharray)
document.querySelectorAll('.ring').forEach(r=>{
    const val = parseFloat(r.dataset.value||0);
    const circle = document.createElementNS('http://www.w3.org/2000/svg','path');
    // We'll append a progress path to the svg
    const svg = r.querySelector('svg');
    const prog = document.createElementNS('http://www.w3.org/2000/svg','path');
    prog.setAttribute('d', 'M18 2.0845a15.9155 15.9155 0 1 0 0 31.831a15.9155 15.9155 0 1 0 0-31.831');
    prog.setAttribute('class','progress');
    prog.setAttribute('stroke-dasharray', (val*100) + ' 100');
    prog.setAttribute('style', 'stroke: '+getComputedStyle(document.documentElement).getPropertyValue('--accent')+';');
    svg.appendChild(prog);
});

// VanillaTilt init
VanillaTilt.init(document.querySelectorAll('[data-tilt]'),{max:8,speed:400,glare:true,'max-glare':0.12});

</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
