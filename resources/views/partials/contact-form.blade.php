<section class="contact-section" id="contact-form">
    <div class="section-container">
        <div class="section-header fade-in">
            <h2>Get in Touch</h2>
            <p>Ready to start your learning journey? Send us a message and we'll get back to you soon!</p>
        </div>
        
        <div class="contact-form-container fade-in">
            <div class="alert success" id="homeContactSuccess" style="display: none;"></div>
            <div class="alert error" id="homeContactError" style="display: none;"></div>
            
            <form id="homeContactForm" class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="home_name">Full Name *</label>
                        <input type="text" id="home_name" name="name" required>
                        <div class="form-errors" id="homeNameError"></div>
                    </div>
                    <div class="form-group">
                        <label for="home_email">Email Address *</label>
                        <input type="email" id="home_email" name="email" required>
                        <div class="form-errors" id="homeEmailError"></div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="home_phone">Phone Number *</label>
                        <input type="tel" id="home_phone" name="phone" required>
                        <div class="form-errors" id="homePhoneError"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="home_message">Message *</label>
                    <textarea id="home_message" name="message" placeholder="Tell us about your tutoring needs..." required></textarea>
                    <div class="form-errors" id="homeMessageError"></div>
                </div>
                
                <div class="loading" id="homeLoading" style="display: none;">
                    <i class="fas fa-spinner"></i> Sending your message...
                </div>
                
                <button type="submit" class="btn btn-primary" id="homeSubmitBtn">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</section>

<style>
    .contact-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .section-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-header h2 {
        color: white;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
    }
    
    .section-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    .contact-form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .contact-form {
        background: rgba(255, 255, 255, 0.1);
        padding: 40px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-row .form-group {
        flex: 1;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: white;
        font-weight: bold;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transition: all 0.3s;
    }
    
    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: white;
        background: rgba(255, 255, 255, 0.3);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-errors {
        color: #ffebee;
        font-size: 14px;
        margin-top: 5px;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    
    .alert.success {
        background-color: rgba(76, 175, 80, 0.2);
        color: #e8f5e8;
        border: 1px solid rgba(76, 175, 80, 0.3);
    }
    
    .alert.error {
        background-color: rgba(244, 67, 54, 0.2);
        color: #ffebee;
        border: 1px solid rgba(244, 67, 54, 0.3);
    }
    
    .loading {
        text-align: center;
        color: white;
        margin-bottom: 20px;
    }
    
    .loading i {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .contact-section {
            padding: 60px 0;
        }
        
        .section-header h2 {
            font-size: 2rem;
        }
        
        .section-header p {
            font-size: 1rem;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .contact-form {
            padding: 20px;
        }
        
        .section-container {
            padding: 0 15px;
        }
    }
    
    @media (max-width: 480px) {
        .section-header h2 {
            font-size: 1.8rem;
        }
        
        .contact-form {
            padding: 15px;
        }
        
        .section-container {
            padding: 0 10px;
        }
    }
</style>

<script>
    document.getElementById('homeContactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        document.querySelectorAll('.form-errors').forEach(el => el.textContent = '');
        document.getElementById('homeContactSuccess').style.display = 'none';
        document.getElementById('homeContactError').style.display = 'none';
        
        // Show loading
        document.getElementById('homeLoading').style.display = 'block';
        document.getElementById('homeSubmitBtn').disabled = true;
        
        // Get form data
        const formData = new FormData(this);
        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            message: formData.get('message')
        };
        
        // Send request
        fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('homeLoading').style.display = 'none';
            document.getElementById('homeSubmitBtn').disabled = false;
            
            if (data.success) {
                document.getElementById('homeContactSuccess').textContent = data.message;
                document.getElementById('homeContactSuccess').style.display = 'block';
                document.getElementById('homeContactForm').reset();
                
                // Scroll to success message
                document.getElementById('homeContactSuccess').scrollIntoView({ behavior: 'smooth' });
            } else {
                if (data.errors) {
                    // Display validation errors
                    Object.keys(data.errors).forEach(field => {
                        const errorElement = document.getElementById('home' + field.charAt(0).toUpperCase() + field.slice(1) + 'Error');
                        if (errorElement) {
                            errorElement.textContent = data.errors[field][0];
                        }
                    });
                } else {
                    // Display general error
                    document.getElementById('homeContactError').textContent = data.message || 'An error occurred. Please try again.';
                    document.getElementById('homeContactError').style.display = 'block';
                }
            }
        })
        .catch(error => {
            document.getElementById('homeLoading').style.display = 'none';
            document.getElementById('homeSubmitBtn').disabled = false;
            document.getElementById('homeContactError').textContent = 'An error occurred. Please try again.';
            document.getElementById('homeContactError').style.display = 'block';
        });
    });
</script>