    </main>

    <footer class="footer-enhanced">
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="footer-brand">
                            <div class="brand-wrapper">
                                <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="footer-logo">
                                <div class="brand-text"><span class="brand-name">Ndawonga</span><span class="brand-tagline">Trading & Projects</span></div>
                            </div>
                            <p class="footer-description">100% Black-Owned Civil Engineering & Waste Management Specialists. Building South Africa's future with excellence and innovation.</p>
                            <div class="certification-badges">
                                <div class="cert-badge"><i class="fas fa-award"></i><span>B-BBEE Level 1</span></div>
                                <div class="cert-badge"><i class="fas fa-certificate"></i><span>CIDB Registered</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-4">
                        <h6>Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="projects.php">Projects</a></li>
                            <li><a href="team.php">Our Team</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <h6>Our Services</h6>
                        <ul class="footer-links">
                            <li><a href="services.php">Civil Engineering</a></li>
                            <li><a href="services.php">Waste Management</a></li>
                            <li><a href="services.php">Construction</a></li>
                            <li><a href="services.php">Project Management</a></li>
                            <li><a href="services.php">Maintenance</a></li>
                            <li><a href="services.php">Consulting</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <h6>Contact Info</h6>
                        <div class="contact-info">
                            <div class="contact-item"><i class="fas fa-map-marker-alt"></i><div><strong>Head Office</strong><p>2250 Tshabalala Street, Protea-North, P.O Chiawelo, 1818</p></div></div>
                            <div class="contact-item"><i class="fas fa-phone"></i><div><strong>Phone</strong><p>+27 79 486 8145 / +27 11 941 5913</p></div></div>
                            <div class="contact-item"><i class="fas fa-envelope"></i><div><strong>Email</strong><p>david@ndawonga.co.za / info@ndawonga.co.za</p></div></div>
                            <div class="contact-item"><i class="fas fa-clock"></i><div><strong>Business Hours</strong><p>Mon - Fri: 8:00 AM - 5:00 PM</p></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6"><p class="mb-0">&copy; <span id="current-year"></span> Ndawonga Trading and Projects Co-operative Ltd. All rights reserved.</p></div>
                    <div class="col-md-6">
                        <div class="footer-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/optimized.js" defer></script>
    <script>
        // FontAwesome and Animation Initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Hide preloader
            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.classList.add('fade-out');
                }
            }, 1000);
            
            // Simple fade-in animation for elements
            const elements = document.querySelectorAll('[data-aos]');
            elements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease';
                
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100);
            });
            
            // Force FontAwesome icon refresh
            const icons = document.querySelectorAll('i[class*="fa-"]');
            icons.forEach(icon => {
                // Force redraw
                icon.style.display = 'none';
                icon.offsetHeight; // Trigger reflow
                icon.style.display = '';
                
                // Add fallback text if icon doesn't load
                if (window.getComputedStyle(icon, ':before').content === 'none' || 
                    window.getComputedStyle(icon, ':before').content === '""') {
                    
                    // Add text fallback based on class
                    if (icon.classList.contains('fa-arrow-right')) icon.innerHTML = '→';
                    else if (icon.classList.contains('fa-robot')) icon.innerHTML = '🤖';
                    else if (icon.classList.contains('fa-times')) icon.innerHTML = '×';
                    else if (icon.classList.contains('fa-paper-plane')) icon.innerHTML = '✈';
                    else if (icon.classList.contains('fa-chevron-up')) icon.innerHTML = '↑';
                    else if (icon.classList.contains('fa-phone')) icon.innerHTML = '📞';
                    else if (icon.classList.contains('fa-envelope')) icon.innerHTML = '✉';
                    else if (icon.classList.contains('fa-award')) icon.innerHTML = '🏆';
                    else if (icon.classList.contains('fa-users')) icon.innerHTML = '👥';
                    else if (icon.classList.contains('fa-building')) icon.innerHTML = '🏢';
                    else if (icon.classList.contains('fa-star')) icon.innerHTML = '⭐';
                }
            });
        });
        
        // Additional FontAwesome loading check
        window.addEventListener('load', function() {
            // Check if FontAwesome loaded properly
            const testIcon = document.createElement('i');
            testIcon.className = 'fas fa-home';
            testIcon.style.position = 'absolute';
            testIcon.style.left = '-9999px';
            document.body.appendChild(testIcon);
            
            const computedStyle = window.getComputedStyle(testIcon, ':before');
            const content = computedStyle.getPropertyValue('content');
            
            if (!content || content === 'none' || content === '""') {
                console.log('FontAwesome not loaded properly, applying fixes...');
                
                // Apply CSS fixes
                const style = document.createElement('style');
                style.textContent = `
                    .fas, .far, .fab { 
                        font-family: "Font Awesome 6 Free", "FontAwesome" !important; 
                        font-weight: 900 !important;
                    }
                    .fab { font-weight: 400 !important; }
                `;
                document.head.appendChild(style);
            }
            
            document.body.removeChild(testIcon);
        });
    </script>
</body>
</html>

