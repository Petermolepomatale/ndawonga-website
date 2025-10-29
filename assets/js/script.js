document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            let isValid = true;

            if (!validateEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            } else {
                clearError(email);
            }

            if (phone.value && !validatePhone(phone.value)) {
                showError(phone, 'Please enter a valid phone number');
                isValid = false;
            } else {
                clearError(phone);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    const filterButtons = document.querySelectorAll('[data-filter]');
    const projectItems = document.querySelectorAll('.project-item');
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                projectItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.addEventListener('click', function () {
            if (this.form && this.form.checkValidity()) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                this.disabled = true;
            }
        });
    });

    const yearElement = document.getElementById('current-year');
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
    // Initialize AOS if available
    if (window.AOS && typeof AOS.init === 'function') {
        AOS.init({ duration: 1000, once: true, offset: 100 });
    }
    // Navbar scroll effect
    const navbar = document.querySelector('.custom-navbar');
    if (navbar) {
        const onScroll = () => {
            if (window.scrollY > 100) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        };
        window.addEventListener('scroll', onScroll);
        onScroll();
    }
});

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^[0-9+\-\s()]{10,}$/;
    return re.test(phone);
}

function showError(input, message) {
    const formGroup = input.closest('.mb-3');
    let errorElement = formGroup ? formGroup.querySelector('.error-message') : null;
    if (!errorElement && formGroup) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message text-danger small mt-1';
        formGroup.appendChild(errorElement);
    }
    if (errorElement) {
        errorElement.textContent = message;
    }
    input.classList.add('is-invalid');
}

function clearError(input) {
    const formGroup = input.closest('.mb-3');
    const errorElement = formGroup ? formGroup.querySelector('.error-message') : null;
    if (errorElement) {
        errorElement.remove();
    }
    input.classList.remove('is-invalid');
}

async function loadContent(url, containerId) {
    try {
        const response = await fetch(url);
        const data = await response.text();
        const container = document.getElementById(containerId);
        if (container) container.innerHTML = data;
    } catch (error) {
        console.error('Error loading content:', error);
    }
}

if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                }
                imageObserver.unobserve(img);
            }
        });
    });
    document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
}

// Preloader fade out
window.addEventListener('load', function () {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        setTimeout(() => preloader.classList.add('fade-out'), 1000);
    }
});


// Testimonials Slider Functionality
document.addEventListener('DOMContentLoaded', function () {
    const testimonialSlides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev-testimonial');
    const nextBtn = document.querySelector('.next-testimonial');
    let currentSlide = 0;

    function showSlide(index) {
        testimonialSlides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % testimonialSlides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + testimonialSlides.length) % testimonialSlides.length;
        showSlide(currentSlide);
    }

    // Event listeners
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Auto-play testimonials
    if (testimonialSlides.length > 0) {
        setInterval(nextSlide, 5000);
    }

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

    // Enhanced scroll animations for success stories
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

    document.querySelectorAll('.success-story-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Add dynamic counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
            const suffix = counter.textContent.replace(/[\d]/g, '');
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current) + suffix;
                }
            }, 30);
        });
    }

    // Trigger counter animation when success stories come into view
    const successSection = document.querySelector('.clients-section');
    if (successSection) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    sectionObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        sectionObserver.observe(successSection);
    }
});

// Enhanced client logo interactions
document.addEventListener('DOMContentLoaded', function () {
    const clientLogos = document.querySelectorAll('.client-logo');

    clientLogos.forEach(logo => {
        logo.addEventListener('mouseenter', function () {
            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.className = 'ripple-effect';
            ripple.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: rgba(212, 175, 55, 0.3);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                animation: ripple 0.6s ease-out;
                pointer-events: none;
            `;

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add ripple animation CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                width: 200px;
                height: 200px;
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});

// Enhanced Scroll to Top Functionality
document.addEventListener('DOMContentLoaded', function () {
    const scrollToTopBtn = document.getElementById('scrollToTop');

    if (scrollToTopBtn) {
        // Show/hide scroll to top button
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });

        // Smooth scroll to top
        scrollToTopBtn.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Quick Actions Menu Functionality
    const quickActions = document.querySelectorAll('.quick-action');

    quickActions.forEach(action => {
        action.addEventListener('click', function () {
            const actionType = this.getAttribute('data-action');

            switch (actionType) {
                case 'quote':
                    // Scroll to contact form or open quote modal
                    const contactSection = document.querySelector('#contact');
                    if (contactSection) {
                        contactSection.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        window.location.href = 'contact.php';
                    }
                    break;

                case 'call':
                    window.open('tel:+27111234567', '_self');
                    break;

                case 'whatsapp':
                    const message = encodeURIComponent('Hello! I would like to inquire about your services.');
                    window.open(`https://wa.me/27111234567?text=${message}`, '_blank');
                    break;
            }

            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Page Load Animation
    document.body.classList.add('page-transition');
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 100);

    // Enhanced Form Validation with Real-time Feedback
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                validateField(this);
            });

            input.addEventListener('input', function () {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });
    });

    function validateField(field) {
        const value = field.value.trim();
        const type = field.type;
        let isValid = true;
        let message = '';

        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            message = 'This field is required';
        }

        // Email validation
        if (type === 'email' && value && !validateEmail(value)) {
            isValid = false;
            message = 'Please enter a valid email address';
        }

        // Phone validation
        if (type === 'tel' && value && !validatePhone(value)) {
            isValid = false;
            message = 'Please enter a valid phone number';
        }

        // Update field appearance
        if (isValid) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            clearError(field);
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
            showError(field, message);
        }

        return isValid;
    }

    // Enhanced Image Lazy Loading with Intersection Observer
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;

                    // Add loading animation
                    img.style.opacity = '0';
                    img.style.transition = 'opacity 0.3s ease';

                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.onload = () => {
                            img.style.opacity = '1';
                            img.classList.remove('lazy');
                        };
                    }

                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Enhanced Navigation Active State Management
    function updateActiveNavigation() {
        const currentPage = window.location.pathname.split('/').pop() || 'index.php';
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPage || (currentPage === '' && href === 'index.php')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    updateActiveNavigation();

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const offsetTop = target.offsetTop - 100; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Enhanced Preloader with Progress
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress >= 100) {
                progress = 100;
                clearInterval(progressInterval);
                setTimeout(() => {
                    preloader.classList.add('fade-out');
                }, 500);
            }
        }, 100);
    }

    // Add keyboard navigation support
    document.addEventListener('keydown', function (e) {
        // ESC key to close modals/overlays
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal.show');
            if (activeModal) {
                const modal = bootstrap.Modal.getInstance(activeModal);
                if (modal) modal.hide();
            }

            const chatbot = document.querySelector('.chatbot-container.active');
            if (chatbot) {
                chatbot.classList.remove('active');
            }
        }

        // Ctrl/Cmd + K for search (if implemented)
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            // Focus search input if available
            const searchInput = document.querySelector('input[type="search"]');
            if (searchInput) {
                searchInput.focus();
            }
        }
    });

    // Performance monitoring
    if ('performance' in window) {
        window.addEventListener('load', function () {
            setTimeout(() => {
                const perfData = performance.getEntriesByType('navigation')[0];
                if (perfData) {
                    console.log(`Page load time: ${perfData.loadEventEnd - perfData.loadEventStart}ms`);
                }
            }, 0);
        });
    }
});

// Utility function for debouncing
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Enhanced error handling for AJAX requests
function handleAjaxError(xhr, status, error) {
    console.error('AJAX Error:', status, error);

    let message = 'An error occurred. Please try again.';
    if (xhr.status === 404) {
        message = 'The requested resource was not found.';
    } else if (xhr.status === 500) {
        message = 'Server error. Please contact support.';
    } else if (xhr.status === 0) {
        message = 'Network error. Please check your connection.';
    }

    // Show user-friendly error message
    showNotification(message, 'error');
}

// Enhanced notification system
function showNotification(message, type = 'info', duration = 5000) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type} show`;

    const icons = {
        success: 'check-circle',
        error: 'exclamation-circle',
        warning: 'exclamation-triangle',
        info: 'info-circle'
    };

    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${icons[type] || icons.info}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close">
            <i class="fas fa-times"></i>
        </button>
    `;

    document.body.appendChild(notification);

    // Auto remove
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, duration);

    // Manual close
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    });
}