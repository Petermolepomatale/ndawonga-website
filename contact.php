<?php
$pageTitle = "Contact Us";
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/header.php';

$database = new Database();
$db = $database->getConnection();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $company = sanitizeInput($_POST['company'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    $inquiry_type = sanitizeInput($_POST['inquiry_type'] ?? 'general');

    if (empty($name) || empty($email) || empty($message)) {
        $error = "Please fill in all required fields.";
    } elseif (!validateEmail($email)) {
        $error = "Please enter a valid email address.";
    } else {
        try {
            $query = "INSERT INTO messages (name, email, phone, company, subject, message, inquiry_type) VALUES (:name, :email, :phone, :company, :subject, :message, :inquiry_type)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':inquiry_type', $inquiry_type);
            if ($stmt->execute()) {
                $success = "Thank you for your message! We'll get back to you soon.";
                $_POST = array();
            } else {
                $error = "Sorry, there was an error sending your message. Please try again.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<style>
    .contact-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/images/logo.jpg') center/cover no-repeat;
        color: white;
        padding: 80px 0 40px;
        margin-top: 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .contact-hero-logo {
        width: 120px;
        height: auto;
        margin-bottom: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        border: 3px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }
    
    .contact-hero-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(0,0,0,0.5);
    }
    
    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
    }
    
    .contact-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }
    
    .form-section {
        padding: 40px;
    }
    
    .info-section {
        background: linear-gradient(135deg, #2c3e50, #3498db);
        color: white;
        padding: 40px;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .info-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    
    .floating-label {
        position: relative;
        margin-bottom: 25px;
    }
    
    .floating-input {
        border: none;
        border-bottom: 2px solid #e0e0e0;
        border-radius: 0;
        padding: 10px 0;
        background: transparent;
        transition: all 0.3s;
    }
    
    .floating-input:focus {
        border-bottom-color: #3498db;
        box-shadow: none;
        outline: none;
    }
    
    .floating-label label {
        position: absolute;
        top: 10px;
        left: 0;
        transition: all 0.3s;
        pointer-events: none;
        color: #999;
    }
    
    .floating-input:focus + label,
    .floating-input:not(:placeholder-shown) + label {
        top: -15px;
        font-size: 12px;
        color: #3498db;
    }
    
    .contact-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transition: all 0.3s;
        margin-right: 10px;
    }
    
    .social-icon:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #3498db, #2c3e50);
        border: none;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .submit-btn:active {
        transform: translateY(-1px);
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(52, 152, 219, 0);
        }
    }
    
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .map-container {
        height: 200px;
        background: #f8f9fa;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 20px;
        position: relative;
    }
    
    .map-placeholder {
        width: 100%;
        height: 100%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .contact-container {
            margin-top: 0;
        }
        
        .form-section, .info-section {
            padding: 30px 20px;
        }
    }
</style>

<section class="contact-hero">
    <div class="container">
        <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="contact-hero-logo">
        <h1 class="display-4 fw-bold mb-3">Get In Touch</h1>
        <p class="lead mb-4">We're here to help and answer any questions you might have</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Reach out to our team for inquiries, quotes, or partnership opportunities. We look forward to hearing from you!</p>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row contact-container">
        <div class="col-lg-8 form-section">
            <h2 class="mb-4">Send Us a Message</h2>
            
            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <form id="contactForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="floating-label">
                            <input type="text" class="form-control floating-input" id="name" name="name" placeholder=" " value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                            <label for="name">Full Name *</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="floating-label">
                            <input type="email" class="form-control floating-input" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                            <label for="email">Email Address *</label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="floating-label">
                            <input type="tel" class="form-control floating-input" id="phone" name="phone" placeholder=" " value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                            <label for="phone">Phone Number</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="floating-label">
                            <input type="text" class="form-control floating-input" id="company" name="company" placeholder=" " value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>">
                            <label for="company">Company</label>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="inquiry_type" class="form-label">Inquiry Type</label>
                    <select class="form-select" id="inquiry_type" name="inquiry_type">
                        <option value="general" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] == 'general') ? 'selected' : ''; ?>>General Inquiry</option>
                        <option value="quote" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] == 'quote') ? 'selected' : ''; ?>>Request Quote</option>
                        <option value="tender" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] == 'tender') ? 'selected' : ''; ?>>Tender Information</option>
                        <option value="partnership" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] == 'partnership') ? 'selected' : ''; ?>>Partnership Opportunity</option>
                        <option value="career" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] == 'career') ? 'selected' : ''; ?>>Career Opportunity</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <div class="floating-label">
                        <input type="text" class="form-control floating-input" id="subject" name="subject" placeholder=" " value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                        <label for="subject">Subject</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="message" class="form-label">Message *</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    <div class="form-text">Character count: <span id="charCount">0</span></div>
                </div>
                
                <button type="submit" class="btn submit-btn pulse">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
            </form>
        </div>
        
        <div class="col-lg-4 info-section">
            <h3 class="mb-4">Contact Information</h3>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h5>Physical Address</h5>
                    <p class="mb-0">2250 Tshabalala Street<br>Protea-North, P.O Chiawelo<br>1818</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <h5>Phone Numbers</h5>
                    <p class="mb-0">Cell: +27 79 486 8145<br>Cell: +27 61 117 4354<br>Office: +27 11 941 5913</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-fax"></i>
                </div>
                <div>
                    <h5>Fax</h5>
                    <p class="mb-0">+27 86 225 1914</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h5>Email Addresses</h5>
                    <p class="mb-0">david@ndawonga.co.za<br>info@ndawonga.co.za</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div>
                    <h5>Website</h5>
                    <p class="mb-0">www.ndawonga.co.za</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div>
                    <h5>Registration</h5>
                    <p class="mb-0">Co-operative Reg: 2012/004592/24</p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-4 fade-in">
                <div class="contact-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <h5>Business Hours</h5>
                    <p class="mb-0">Mon - Fri: 8:00 AM - 5:00 PM</p>
                    <p class="mb-0">Sat: 8:00 AM - 1:00 PM</p>
                </div>
            </div>
            
            <hr class="my-4">
            
            <h5 class="mb-3">Follow Us</h5>
            <div class="social-links">
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
            
            <div class="map-container mt-4">
                <div class="map-placeholder">
                    <div class="text-center">
                        <i class="fas fa-map-marked-alt fa-2x mb-2"></i>
                        <p>Interactive Map<br><small>Click to view location</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for message textarea
        const messageTextarea = document.getElementById('message');
        const charCount = document.getElementById('charCount');
        
        if (messageTextarea && charCount) {
            messageTextarea.addEventListener('input', function() {
                charCount.textContent = this.value.length;
            });
            
            // Initialize count on page load
            charCount.textContent = messageTextarea.value.length;
        }
        
        // Floating label functionality
        const floatingInputs = document.querySelectorAll('.floating-input');
        floatingInputs.forEach(input => {
            // Check if input has value on page load
            if (input.value) {
                input.parentNode.classList.add('focused');
            }
            
            input.addEventListener('focus', function() {
                this.parentNode.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentNode.classList.remove('focused');
                }
            });
        });
        
        // Fade in animation for contact info items
        const fadeElements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(el => {
            observer.observe(el);
        });
        
        // Form submission animation
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sending...';
                    submitBtn.disabled = true;
                }
            });
        }
        
        // Interactive map placeholder
        const mapPlaceholder = document.querySelector('.map-placeholder');
        if (mapPlaceholder) {
            mapPlaceholder.addEventListener('click', function() {
                this.innerHTML = `
                    <div class="text-center p-3">
                        <i class="fas fa-map-marked-alt fa-2x mb-2"></i>
                        <p>Map Loading...</p>
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `;
                
                // Simulate map loading
                setTimeout(() => {
                    this.innerHTML = `
                        <div class="text-center p-3">
                            <i class="fas fa-map-marked-alt fa-2x mb-2 text-primary"></i>
                            <p>Location: 2250 Tshabalala Street<br>Protea-North, P.O Chiawelo<br>1818</p>
                            <button class="btn btn-sm btn-outline-primary">View Larger Map</button>
                        </div>
                    `;
                }, 2000);
            });
        }
        
        // Input validation with visual feedback
        const requiredInputs = document.querySelectorAll('input[required], textarea[required]');
        requiredInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
        
        // Add subtle animation to the submit button on hover
        const submitButton = document.querySelector('.submit-btn');
        if (submitButton) {
            submitButton.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            submitButton.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        }
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>