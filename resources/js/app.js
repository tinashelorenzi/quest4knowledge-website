import './bootstrap';

// Quest4Knowledge Interactive Features

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all interactive features
    initScrollProgress();
    initScrollAnimations();
    initSmoothScrolling();
    initParallax();
    initPricingTabs();
    initFormValidation();
    initMobileMenu();
    
    // Add loading animation to elements
    addLoadingAnimations();
});

// Scroll progress indicator
function initScrollProgress() {
    const scrollProgress = document.getElementById('scrollProgress');
    if (!scrollProgress) return;
    
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        scrollProgress.style.width = scrollPercent + '%';
    });
}

// Animate elements on scroll
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Add stagger effect for multiple elements
                const delay = Array.from(entry.target.parentElement.children).indexOf(entry.target) * 100;
                entry.target.style.animationDelay = delay + 'ms';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

// Smooth scrolling for navigation links
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Parallax effect for hero section
function initParallax() {
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero');
        const shapes = document.querySelectorAll('.shape');
        
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
        
        // Move floating shapes at different speeds
        shapes.forEach((shape, index) => {
            const speed = 0.2 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px)`;
        });
        
        ticking = false;
    }
    
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });
}

// Pricing tabs functionality
function initPricingTabs() {
    window.switchTab = function(tabType) {
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');
        
        // Update pricing based on tab selection
        const prices = {
            'in-person': ['R300', 'R270', 'R250'],
            'online': ['R250', 'R220', 'R200']
        };
        
        const priceElements = document.querySelectorAll('.price');
        priceElements.forEach((element, index) => {
            const newPrice = prices[tabType][index];
            element.innerHTML = newPrice + ' <span class="price-unit">p/h</span>';
        });
        
        // Add animation to price change
        priceElements.forEach(element => {
            element.style.transform = 'scale(1.1)';
            setTimeout(() => {
                element.style.transform = 'scale(1)';
            }, 200);
        });
    };
}

// Video play functionality
window.playVideo = function() {
    // You can integrate with your video player here
    const videoContainer = document.querySelector('.video-container');
    
    // Create a simple modal or redirect to video
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">
            <div style="background: white; padding: 20px; border-radius: 10px; text-align: center; max-width: 400px;">
                <h3 style="margin-bottom: 10px; color: #6B46C1;">Video Player</h3>
                <p style="margin-bottom: 20px; color: #6B7280;">Integrate with your preferred video player (YouTube, Vimeo, etc.)</p>
                <button onclick="this.parentElement.parentElement.remove()" style="background: #6B46C1; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Close</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
};

// Form validation (for future contact forms)
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#EF4444';
                    input.style.boxShadow = '0 0 0 2px rgba(239, 68, 68, 0.1)';
                } else {
                    input.style.borderColor = '#D1D5DB';
                    input.style.boxShadow = 'none';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('Please fill in all required fields', 'error');
            }
        });
    });
}

// Mobile menu functionality
function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuBtn && navLinks) {
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
}

// Add loading animations to elements
function addLoadingAnimations() {
    const elements = document.querySelectorAll('.hero h1, .hero p, .hero-cta, .hero-video');
    elements.forEach((element, index) => {
        element.style.animationDelay = (index * 0.2) + 's';
    });
}

// Show notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div style="position: fixed; top: 20px; right: 20px; background: ${type === 'error' ? '#EF4444' : '#10B981'}; color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            ${message}
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Floating shapes interaction
function initFloatingShapes() {
    const shapes = document.querySelectorAll('.shape');
    shapes.forEach((shape, index) => {
        shape.addEventListener('mouseover', () => {
            shape.style.transform = 'scale(1.2)';
            shape.style.background = 'rgba(253, 224, 71, 0.3)';
        });
        
        shape.addEventListener('mouseout', () => {
            shape.style.transform = 'scale(1)';
            shape.style.background = 'rgba(255, 255, 255, 0.1)';
        });
        
        // Add random movement
        setInterval(() => {
            const randomX = Math.random() * 20 - 10;
            const randomY = Math.random() * 20 - 10;
            shape.style.transform += ` translate(${randomX}px, ${randomY}px)`;
        }, 3000 + (index * 500));
    });
}

// Initialize floating shapes
initFloatingShapes();

// Keyboard navigation support
document.addEventListener('keydown', function(e) {
    if (e.key === 'Tab') {
        document.body.classList.add('keyboard-navigation');
    }
});

document.addEventListener('mousedown', function() {
    document.body.classList.remove('keyboard-navigation');
});

// Lazy loading for images (if you add images later)
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize lazy loading
initLazyLoading();

// Performance monitoring
function initPerformanceMonitoring() {
    if ('performance' in window) {
        window.addEventListener('load', () => {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log(`Page loaded in ${loadTime}ms`);
        });
    }
}

// Initialize performance monitoring
initPerformanceMonitoring();

// Add service worker for offline functionality (optional)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js')
            .then(function(registration) {
                console.log('SW registered: ', registration);
            })
            .catch(function(registrationError) {
                console.log('SW registration failed: ', registrationError);
            });
    });
}

// Export functions for use in other modules
export {
    initScrollProgress,
    initScrollAnimations,
    initSmoothScrolling,
    showNotification
};