<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Request a Tutor - Quest4Knowledge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .glass-morphism {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .pulse-glow {
            animation: pulseGlow 2s infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.4); }
            50% { box-shadow: 0 0 40px rgba(139, 92, 246, 0.6); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .form-field-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-field-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
        }
        
        .parallax-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 300% 300%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .typing-effect {
            border-right: 2px solid #667eea;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
            white-space: nowrap;
            overflow: hidden;
        }
        
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #667eea; }
        }
        
        .success-animation {
            animation: successPulse 0.6s ease-out;
        }
        
        @keyframes successPulse {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .loading-dots::after {
            content: '';
            animation: dots 1.5s infinite;
        }
        
        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            90%, 100% { content: '...'; }
        }
    </style>
</head>
<body class="parallax-bg min-h-screen">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-20 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 glass-morphism">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">Quest4Knowledge</span>
                </div>
                <a href="/" class="text-white hover:text-purple-200 transition-colors duration-300 flex items-center space-x-2">
                    <i class="fas fa-home"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative z-10 text-center py-20 px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-6xl md:text-7xl font-black text-white mb-6 leading-tight">
                Find Your Perfect
                <span class="block gradient-text">Tutor Today</span>
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 mb-8 leading-relaxed max-w-3xl mx-auto">
                Connect with expert tutors who will help you excel in your studies. 
                Personalized learning experiences that fit your schedule and learning style.
            </p>
            <div class="flex justify-center">
                <div class="pulse-glow bg-white/20 backdrop-blur-sm rounded-2xl p-2">
                    <button onclick="scrollToForm()" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        <i class="fas fa-rocket mr-2"></i>
                        Start Your Journey
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="relative z-10 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-morphism rounded-3xl p-8 text-center hover-lift">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2">500+</h3>
                    <p class="text-purple-100">Expert Tutors</p>
                </div>
                <div class="glass-morphism rounded-3xl p-8 text-center hover-lift">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2">50+</h3>
                    <p class="text-purple-100">Subjects Available</p>
                </div>
                <div class="glass-morphism rounded-3xl p-8 text-center hover-lift">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2">4.9/5</h3>
                    <p class="text-purple-100">Average Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section id="request-form" class="relative z-10 py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                
                <!-- Left Side - Info Cards -->
                <div class="space-y-8">
                    <div class="glass-morphism rounded-3xl p-8 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-lightning-bolt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">Quick Matching</h3>
                                <p class="text-purple-100 leading-relaxed">Our advanced algorithm matches you with the perfect tutor in under 24 hours based on your specific needs and learning style.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-morphism rounded-3xl p-8 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">Verified Experts</h3>
                                <p class="text-purple-100 leading-relaxed">All our tutors are thoroughly vetted professionals with proven track records and excellent student feedback.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-morphism rounded-3xl p-8 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">Flexible Scheduling</h3>
                                <p class="text-purple-100 leading-relaxed">Book sessions that fit your busy schedule. Available 7 days a week with both online and in-person options.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-morphism rounded-3xl p-8 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-trophy text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">Proven Results</h3>
                                <p class="text-purple-100 leading-relaxed">Students see an average improvement of 2+ grade levels within 3 months of consistent tutoring.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="glass-morphism rounded-3xl p-8 lg:p-12 card-hover">
                    <div class="text-center mb-8">
                        <h2 class="text-4xl font-bold text-white mb-4">Get Started Today</h2>
                        <p class="text-purple-100 text-lg">Fill out this form and we'll match you with the perfect tutor!</p>
                    </div>

                    <form id="tutorRequestForm" class="space-y-6">
                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="block text-white font-semibold mb-2">
                                    <i class="fas fa-user mr-2 text-purple-300"></i>First Name
                                </label>
                                <input type="text" name="first_name" required 
                                       class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-purple-200 focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                            </div>
                            <div class="form-group">
                                <label class="block text-white font-semibold mb-2">
                                    <i class="fas fa-user mr-2 text-purple-300"></i>Last Name
                                </label>
                                <input type="text" name="last_name" required 
                                       class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-purple-200 focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="block text-white font-semibold mb-2">
                                    <i class="fas fa-envelope mr-2 text-purple-300"></i>Email Address
                                </label>
                                <input type="email" name="email" required 
                                       class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-purple-200 focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                            </div>
                            <div class="form-group">
                                <label class="block text-white font-semibold mb-2">
                                    <i class="fas fa-phone mr-2 text-purple-300"></i>Phone Number
                                </label>
                                <input type="tel" name="phone" required 
                                       class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-purple-200 focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="form-group">
                            <label class="block text-white font-semibold mb-2">
                                <i class="fas fa-book mr-2 text-purple-300"></i>Subject Needed
                            </label>
                            <select name="subject" required 
                                    class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                                <option value="" class="text-gray-800">Select a subject...</option>
                                <option value="mathematics" class="text-gray-800">Mathematics</option>
                                <option value="science" class="text-gray-800">Science</option>
                                <option value="english" class="text-gray-800">English</option>
                                <option value="history" class="text-gray-800">History</option>
                                <option value="languages" class="text-gray-800">Languages</option>
                                <option value="computer_science" class="text-gray-800">Computer Science</option>
                                <option value="other" class="text-gray-800">Other</option>
                            </select>
                        </div>

                        <!-- Level and Preference -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="block text-white font-semibold mb-2">
                                    <i class="fas fa-graduation-cap mr-2 text-purple-300"></i>Education Level
                                </label>
                                <select name="level" required 
                                        class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                                    <option value="" class="text-gray-800">Select level...</option>
                                    <option value="primary" class="text-gray-800">Primary School</option>
                                    <option value="high_school" class="text-gray-800">High School</option>
                                    <option value="university" class="text-gray-800">University</option>
                                    <option value="adult_learning" class="text-gray-800">Adult Learning</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="block text-white font-semibold mb-2">
                                    <i class="fas fa-laptop mr-2 text-purple-300"></i>Tutoring Preference
                                </label>
                                <select name="preference" required 
                                        class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm">
                                    <option value="" class="text-gray-800">Select preference...</option>
                                    <option value="online" class="text-gray-800">Online</option>
                                    <option value="in_person" class="text-gray-800">In Person</option>
                                    <option value="both" class="text-gray-800">Both</option>
                                </select>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="form-group">
                            <label class="block text-white font-semibold mb-2">
                                <i class="fas fa-comment mr-2 text-purple-300"></i>Additional Message (Optional)
                            </label>
                            <textarea name="message" rows="4" placeholder="Tell us about your specific needs, goals, or any special requirements..."
                                      class="form-field-focus w-full px-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-purple-200 focus:outline-none focus:border-purple-400 focus:bg-white/20 backdrop-blur-sm resize-none"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-5 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl pulse-glow text-lg">
                                <span id="submit-text">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Request Your Tutor
                                </span>
                                <span id="loading-text" class="hidden">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    <span class="loading-dots">Submitting</span>
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Success Message -->
                    <div id="success-message" class="hidden text-center py-8">
                        <div class="success-animation">
                            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check text-white text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Request Submitted Successfully!</h3>
                            <p class="text-purple-100">We'll match you with the perfect tutor and contact you within 24 hours.</p>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div id="error-message" class="hidden bg-red-500/20 border border-red-500/30 text-red-100 px-6 py-4 rounded-2xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>There was an error submitting your request. Please try again.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <footer class="relative z-10 py-16 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <div class="glass-morphism rounded-3xl p-12 hover-lift">
                <h2 class="text-4xl font-bold text-white mb-4">Ready to Excel?</h2>
                <p class="text-xl text-purple-100 mb-8">Join thousands of students who have improved their grades with our expert tutors.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="flex items-center space-x-2 text-purple-100">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>No Setup Fees</span>
                    </div>
                    <div class="flex items-center space-x-2 text-purple-100">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>Cancel Anytime</span>
                    </div>
                    <div class="flex items-center space-x-2 text-purple-100">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>100% Satisfaction Guarantee</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll to form
        function scrollToForm() {
            document.getElementById('request-form').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Form submission handling
        document.getElementById('tutorRequestForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const submitText = document.getElementById('submit-text');
            const loadingText = document.getElementById('loading-text');
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            const form = e.target;
            
            // Show loading state
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75');
            
            // Hide any previous messages
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            
            try {
                // Simulate API call (replace with actual endpoint)
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Show success message
                form.classList.add('hidden');
                successMessage.classList.remove('hidden');
                
                // Trigger confetti effect (if you want to add it)
                // You could add a confetti library here
                
            } catch (error) {
                console.error('Error submitting form:', error);
                errorMessage.classList.remove('hidden');
                
                // Reset button state
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75');
            }
        });

        // Add real-time form validation
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.remove('border-red-400');
                    this.classList.add('border-green-400');
                } else {
                    this.classList.remove('border-green-400');
                    this.classList.add('border-red-400');
                }
            });
        });

        // Add typing effect to placeholder text
        const messageTextarea = document.querySelector('textarea[name="message"]');
        if (messageTextarea) {
            const placeholders = [
                "I need help with calculus homework...",
                "Looking for SAT prep tutoring...",
                "Need assistance with my thesis...",
                "Want to improve my English writing...",
                "Struggling with organic chemistry..."
            ];
            
            let currentIndex = 0;
            
            function changePlaceholder() {
                messageTextarea.placeholder = placeholders[currentIndex];
                currentIndex = (currentIndex + 1) % placeholders.length;
            }
            
            setInterval(changePlaceholder, 3000);
        }

        // Add parallax effect to background elements
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            document.querySelector('.parallax-bg').style.transform = `translateY(${rate}px)`;
        });

        // Add interaction feedback
        const interactiveElements = document.querySelectorAll('.hover-lift, .card-hover');
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = this.classList.contains('hover-lift') ? 'translateY(-8px)' : 'translateY(-4px) scale(1.02)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>