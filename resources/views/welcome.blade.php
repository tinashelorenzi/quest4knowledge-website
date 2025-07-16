<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Quest4Knowledge') }} - Personalized Tutoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/homepage.css'])
</head>
<body>
    <div class="scroll-indicator">
        <div class="scroll-progress" id="scrollProgress"></div>
    </div>

    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <nav>
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                QUEST4KNOWLEDGE
            </div>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#pricing">Pricing</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="auth-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                @endif
                <a href="#request" class="cta-nav">REQUEST A TUTOR</a>
            </div>
            <button class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#contact">Contact</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
                <li><a href="#request" class="cta-nav" style="display: inline-block; margin-top: 20px;">REQUEST A TUTOR</a></li>
            </ul>
        </div>

        <section class="hero" id="home">
            <div class="hero-content">
                <h1>Personalized Tutoring With The Greatest Results</h1>
                <p>Unlock your inner genius with our expert tutors and personalized learning approach that gets results.</p>
                
                <div class="hero-cta">
                    <a href="#request" class="btn btn-primary">BOOK YOUR FIRST LESSON</a>
                    <a href="#about" class="btn btn-secondary">Learn More</a>
                </div>

                <div class="hero-video">
                    <div class="video-container" onclick="playVideo()">
                        <div class="play-btn">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="features" id="about">
        <div class="container">
            <div class="animate-on-scroll">
                <h2 style="text-align: center; color: #6B46C1; font-size: 2.5rem; margin-bottom: 20px;">How It Works</h2>
                <p style="text-align: center; color: #6B7280; font-size: 1.1rem; margin-bottom: 40px;">It's Pretty Simple!</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3>Step 1: Request a Tutor</h3>
                    <p>Fill out a short form so we can get a basic understanding of what you need.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Step 2: We Reach Out</h3>
                    <p>An Agent will reach out to you with one of our vetted tutors for you to choose from.</p>
                </div>
                
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Step 3: Get Learning!</h3>
                    <p>Have a great tutoring session or more with your perfect tutor.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing" id="pricing">
        <div class="section-container">
            <div class="section-header fade-in">
                <h2>Affordable Pricing</h2>
                <p>Flexible packages designed to fit your budget and learning goals. Choose what works best for you.</p>
            </div>
            
            <div class="pricing-toggle fade-in">
                <button class="toggle-btn active" onclick="switchPricing('in-person')">In-Person</button>
                <button class="toggle-btn" onclick="switchPricing('online')">Online</button>
            </div>
            
            <div class="pricing-grid" id="pricing-grid">
                <div class="pricing-loading">
                    <div class="loading-spinner"></div>
                    <span style="margin-left: 10px;">Loading packages...</span>
                </div>
            </div>
        </div>
    </section>
    </section>

    @include('partials.contact-form')


    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>ABOUT US</h3>
                    <p>Tutoring That Gets Results. Online & In-Person, High School & University.</p>
                </div>
                
                <div class="footer-section">
                    <h3>FOR PARENTS</h3>
                    <a href="#request">Request A Tutor</a>
                    <a href="#pricing">Prices</a>
                    <a href="#contact">Contact</a>
                </div>
                
                <div class="footer-section">
                    <h3>FOR TUTORS</h3>
                    <a href="#become-tutor">Become A Tutor</a>
                    <a href="#portal">Portal</a>
                </div>
                
                <div class="footer-section">
                    <h3>CONTACT US</h3>
                    <p>Email: info@quest4knowledge.co.za</p>
                    <p>Tel: 087 255 3614</p>
                    <p>Web: www.quest4knowledge.co.za</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>Copyright © 2025 Quest4Knowledge Tutors | Built with ❤️ by Cybernash Technologies</p>
            </div>
        </div>
    </footer>

    <script>
        let allPackages = [];
        let currentPricingType = 'in-person';
        
        // Load packages on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPackages();
            
            // All your existing JavaScript code remains the same...
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            const navbar = document.querySelector('.navbar');
            
            // Mobile menu toggle
            mobileMenuBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });
            
            // Close mobile menu when clicking on links
            document.querySelectorAll('.mobile-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuBtn.classList.remove('active');
                    mobileMenu.classList.remove('active');
                });
            });
            
            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const scrollProgress = document.querySelector('.scroll-progress');
                const scrollTop = window.pageYOffset;
                const docHeight = document.body.scrollHeight - window.innerHeight;
                const scrollPercent = (scrollTop / docHeight);
                
                scrollProgress.style.transform = `scaleX(${scrollPercent})`;
                
                if (scrollTop > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
            
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offsetTop = target.offsetTop - 70;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.fade-in').forEach(el => {
                observer.observe(el);
            });
            
            // Counter animation for stats
            function animateCounters() {
                const counters = document.querySelectorAll('.stat-number');
                counters.forEach(counter => {
                    const target = counter.textContent;
                    const numericTarget = parseInt(target.replace(/[^0-9]/g, ''));
                    
                    if (numericTarget) {
                        let current = 0;
                        const increment = numericTarget / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= numericTarget) {
                                current = numericTarget;
                                clearInterval(timer);
                            }
                            counter.textContent = Math.floor(current) + target.replace(/[0-9]/g, '');
                        }, 50);
                    }
                });
            }
            
            // Trigger counter animation when hero is visible
            const heroObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        heroObserver.unobserve(entry.target);
                    }
                });
            });
            
            const heroStats = document.querySelector('.stats-grid');
            if (heroStats) {
                heroObserver.observe(heroStats);
            }
        });

        // Function to load packages from API
        async function loadPackages() {
            try {
                const response = await fetch('/api/packages');
                const data = await response.json();
                
                if (data.success) {
                    allPackages = data.data;
                    renderPackages(currentPricingType);
                } else {
                    console.error('Error loading packages:', data.message);
                    renderErrorState();
                }
            } catch (error) {
                console.error('Error fetching packages:', error);
                renderErrorState();
            }
        }

        // Function to render packages
        function renderPackages(type) {
            const pricingGrid = document.getElementById('pricing-grid');
            
            if (!pricingGrid) return;
            
            if (allPackages.length === 0) {
                renderErrorState();
                return;
            }
            
            let packagesHtml = '';
            
            allPackages.forEach(package => {
                const hourlyRate = type === 'online' ? package.formatted_hourly_rate_online : package.formatted_hourly_rate_in_person;
                const featuredBadge = package.is_featured ? '<div class="featured-badge">Most Popular</div>' : '';
                const featuredClass = package.is_featured ? ' featured' : '';
                
                // Build features HTML
                let featuresHtml = '';
                if (package.features && package.features.length > 0) {
                    featuresHtml = package.features.map(f => `<div class="feature">✓ ${f.feature}</div>`).join('');
                } else {
                    featuresHtml = '<div class="feature">✓ Personalized learning sessions</div>';
                }
                
                packagesHtml += `
                    <div class="pricing-card fade-in${featuredClass}">
                        ${featuredBadge}
                        <div>
                            <h3>${package.name}</h3>
                            <div class="price">${hourlyRate}<span class="price-unit">/hr</span></div>
                            <p class="price-description">${package.description || 'Perfect for your learning journey'}</p>
                            <div class="package-features">
                                ${featuresHtml}
                            </div>
                        </div>
                        <a href="#request" class="btn btn-primary">Get Started</a>
                    </div>
                `;
            });
            
            pricingGrid.innerHTML = packagesHtml;
            
            // Re-trigger animations
            setTimeout(() => {
                document.querySelectorAll('.pricing-card').forEach(card => {
                    card.classList.add('visible');
                });
            }, 100);
        }

        // Function to render error state
        function renderErrorState() {
            const pricingGrid = document.getElementById('pricing-grid');
            
            const errorHtml = `
                <div class="pricing-error">
                    <h3>Unable to load packages</h3>
                    <p>Please try refreshing the page or contact us for pricing information.</p>
                    <a href="#contact" class="btn btn-primary" style="margin-top: 20px;">Contact Us</a>
                </div>
            `;
            
            pricingGrid.innerHTML = errorHtml;
        }

        // Updated pricing toggle functionality
        function switchPricing(type) {
            const toggleBtns = document.querySelectorAll('.toggle-btn');
            toggleBtns.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            currentPricingType = type;
            
            if (allPackages.length > 0) {
                renderPackages(type);
            }
        }
        
        // All your existing JavaScript functions remain the same...
        
        // Add some interactive hover effects
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.querySelectorAll('.step-card, .pricing-card').forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        if (!this.classList.contains('featured')) {
                            this.style.transform = 'translateY(-10px) scale(1.02)';
                        }
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        if (!this.classList.contains('featured')) {
                            this.style.transform = 'translateY(0) scale(1)';
                        }
                    });
                });
            }, 1000);
        });
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            // Mobile menu toggle
            mobileMenuBtn.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });
            
            // Close mobile menu when clicking on links
            document.querySelectorAll('.mobile-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuBtn.classList.remove('active');
                    mobileMenu.classList.remove('active');
                });
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenuBtn.classList.remove('active');
                    mobileMenu.classList.remove('active');
                }
            });
        });

        // Scroll progress indicator
        window.addEventListener('scroll', () => {
            const scrollProgress = document.getElementById('scrollProgress');
            const scrollTop = window.pageYOffset;
            const docHeight = document.body.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Pricing tabs functionality
        function switchTab(tabType) {
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
        }

        // Video play functionality
        function playVideo() {
            // You can integrate with your video player here
            alert('Video would play here - integrate with your video player of choice!');
        }

        // Add floating animation to shapes
        const shapes = document.querySelectorAll('.shape');
        shapes.forEach((shape, index) => {
            shape.addEventListener('mouseover', () => {
                shape.style.transform = 'scale(1.2)';
            });
            
            shape.addEventListener('mouseout', () => {
                shape.style.transform = 'scale(1)';
            });
        });

        // Add parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    </script>
</body>
</html>