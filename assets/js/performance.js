// Performance Optimization Script
(function() {
    'use strict';
    
    // Preload critical resources
    function preloadCriticalResources() {
        const criticalResources = [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'
        ];
        
        criticalResources.forEach(url => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'style';
            link.href = url;
            document.head.appendChild(link);
        });
    }
    
    // Optimize images
    function optimizeImages() {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            // Add loading="lazy" for better performance
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }
            
            // Add decoding="async" for better performance
            if (!img.hasAttribute('decoding')) {
                img.setAttribute('decoding', 'async');
            }
        });
    }
    
    // Reduce animations on slower devices
    function adaptToDeviceCapabilities() {
        // Check if device prefers reduced motion
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.style.setProperty('--animation-duration', '0.01ms');
            return;
        }
        
        // Reduce animations on slower devices
        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        if (connection && (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g')) {
            document.documentElement.style.setProperty('--animation-duration', '0.1s');
        }
    }
    
    // Defer non-critical JavaScript
    function deferNonCriticalJS() {
        const scripts = [
            'https://unpkg.com/aos@2.3.1/dist/aos.js'
        ];
        
        // Load after page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                scripts.forEach(src => {
                    const script = document.createElement('script');
                    script.src = src;
                    script.async = true;
                    document.head.appendChild(script);
                });
            }, 1000);
        });
    }
    
    // Initialize performance optimizations
    function init() {
        preloadCriticalResources();
        adaptToDeviceCapabilities();
        deferNonCriticalJS();
        
        // Optimize images when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', optimizeImages);
        } else {
            optimizeImages();
        }
    }
    
    init();
})();