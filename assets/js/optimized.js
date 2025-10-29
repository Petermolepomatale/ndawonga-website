// Optimized JavaScript for Ndawonga Website
// Lightweight and performance-focused

(function() {
    'use strict';
    
    // Utility functions
    const utils = {
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },
        
        throttle: function(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        }
    };

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeCore();
        initializeNavigation();
        initializeScrollEffects();
        initializeTestimonials();
        initializeQuickActions();
        initializeForms();
    });

    // Core initialization
    function initializeCore() {
        // Set current year
        const yearElement = document.getElementById('current-year');
        if (yearElement) {
            yearElement.textContent = new Date().getFullYear();
        }

        // Initialize AOS if available
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
                disable: 'mobile'
            });
        }

        // Preloader
        setTimeout(() => {
            const preloader = document.querySelector('.preloader');
            if (preloader) {
                preloader.classList.add('fade-out');
            }
        }, 1000);
    }

    // Navigation
    function initializeNavigation() {
        const navbar = document.querySelector('.custom-navbar');
        if (!navbar) return;

        const scrollHandler = utils.throttle(() => {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, 16);

        window.addEventListener('scroll', scrollHandler);
    }

    // Scroll effects
    function initializeScrollEffects() {
        const scrollToTopBtn = document.getElementById('scrollToTop');
        if (!scrollToTopBtn) return;

        const scrollHandler = utils.throttle(() => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        }, 16);

        window.addEventListener('scroll', scrollHandler);

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Testimonials
    function initializeTestimonials() {
        const slides = document.querySelectorAll('.testimonial-slide');
        const dots = document.querySelectorAll('.dot');
        const prevBtn = document.querySelector('.prev-testimonial');
        const nextBtn = document.querySelector('.next-testimonial');
        
        if (slides.length === 0) return;

        let currentSlide = 0;
        let autoPlayInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function startAutoPlay() {
            autoPlayInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', () => {
            stopAutoPlay();
            nextSlide();
            startAutoPlay();
        });

        if (prevBtn) prevBtn.addEventListener('click', () => {
            stopAutoPlay();
            prevSlide();
            startAutoPlay();
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopAutoPlay();
                currentSlide = index;
                showSlide(currentSlide);
                startAutoPlay();
            });
        });

        // Start auto-play
        startAutoPlay();

        // Pause on hover
        const testimonialSection = document.querySelector('.testimonials-section');
        if (testimonialSection) {
            testimonialSection.addEventListener('mouseenter', stopAutoPlay);
            testimonialSection.addEventListener('mouseleave', startAutoPlay);
        }
    }

    // Quick Actions
    function initializeQuickActions() {
        const quickActions = document.querySelectorAll('.quick-action');
        
        quickActions.forEach(action => {
            action.addEventListener('click', function() {
                const actionType = this.getAttribute('data-action');
                
                switch(actionType) {
                    case 'quote':
                        window.location.href = 'contact.php';
                        break;
                    case 'call':
                        window.open('tel:+27111234567', '_self');
                        break;
                    case 'whatsapp':
                        const message = encodeURIComponent('Hello! I would like to inquire about your services.');
                        window.open(`https://wa.me/27111234567?text=${message}`, '_blank');
                        break;
                }
            });
        });
    }

    // Forms
    function initializeForms() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && this.checkValidity()) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                    submitBtn.disabled = true;
                }
            });
        });

        // Email validation
        const emailInputs = document.querySelectorAll('input[type="email"]');
        emailInputs.forEach(input => {
            input.addEventListener('blur', function() {
                const email = this.value.trim();
                const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                
                if (email && !isValid) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });
    }

    // Smooth scrolling for anchor links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[href^="#"]');
        if (!link) return;
        
        const href = link.getAttribute('href');
        if (href && href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                const offsetTop = target.offsetTop - 100;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        }
    });

    // Client carousel pause on hover
    const clientsCarousel = document.querySelector('.clients-carousel');
    if (clientsCarousel) {
        clientsCarousel.addEventListener('mouseenter', () => {
            clientsCarousel.style.animationPlayState = 'paused';
        });
        
        clientsCarousel.addEventListener('mouseleave', () => {
            clientsCarousel.style.animationPlayState = 'running';
        });
    }

    // Chatbot functionality (simplified)
    const chatbotToggle = document.getElementById('chatbotToggle');
    const chatbotContainer = document.getElementById('chatbotContainer');
    const closeChatbot = document.getElementById('closeChatbot');

    if (chatbotToggle && chatbotContainer) {
        chatbotToggle.addEventListener('click', () => {
            chatbotContainer.classList.toggle('active');
        });
    }

    if (closeChatbot && chatbotContainer) {
        closeChatbot.addEventListener('click', () => {
            chatbotContainer.classList.remove('active');
        });
    }

})();