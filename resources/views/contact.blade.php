<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Quest4Knowledge</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-top: 40px;
        }

        .header h1 {
            color: #6B46C1;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6B46C1;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            background-color: #6B46C1;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn:hover {
            background-color: #553C9A;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-errors {
            color: #721c24;
            font-size: 14px;
            margin-top: 5px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #6B46C1;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .contact-info {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .contact-info h3 {
            color: #6B46C1;
            margin-bottom: 20px;
        }

        .contact-info p {
            margin-bottom: 10px;
            color: #666;
        }

        .loading {
            display: none;
            text-align: center;
            color: #6B46C1;
        }

        .loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
        
        <div class="header">
            <h1>Contact Us</h1>
            <p>Get in touch with us for any questions or tutoring inquiries</p>
        </div>

        <div class="contact-form">
            <div class="alert success" id="successAlert"></div>
            <div class="alert error" id="errorAlert"></div>
            
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>
                    <div class="form-errors" id="nameError"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                    <div class="form-errors" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required>
                    <div class="form-errors" id="phoneError"></div>
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" placeholder="Tell us about your tutoring needs or any questions you have..." required></textarea>
                    <div class="form-errors" id="messageError"></div>
                </div>

                <div class="loading" id="loading">
                    <i class="fas fa-spinner"></i> Sending your message...
                </div>

                <button type="submit" class="btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Other Ways to Reach Us</h3>
            <p><i class="fas fa-envelope"></i> maryna@quest4knowledge.co.za</p>
            <p><i class="fas fa-clock"></i> We typically respond within 24 hours</p>
        </div>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            document.querySelectorAll('.form-errors').forEach(el => el.textContent = '');
            document.getElementById('successAlert').style.display = 'none';
            document.getElementById('errorAlert').style.display = 'none';
            
            // Show loading
            document.getElementById('loading').style.display = 'block';
            document.getElementById('submitBtn').disabled = true;
            
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
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submitBtn').disabled = false;
                
                if (data.success) {
                    document.getElementById('successAlert').textContent = data.message;
                    document.getElementById('successAlert').style.display = 'block';
                    document.getElementById('contactForm').reset();
                    
                    // Scroll to success message
                    document.getElementById('successAlert').scrollIntoView({ behavior: 'smooth' });
                } else {
                    if (data.errors) {
                        // Display validation errors
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(field + 'Error');
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                            }
                        });
                    } else {
                        // Display general error
                        document.getElementById('errorAlert').textContent = data.message || 'An error occurred. Please try again.';
                        document.getElementById('errorAlert').style.display = 'block';
                    }
                }
            })
            .catch(error => {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('errorAlert').textContent = 'An error occurred. Please try again.';
                document.getElementById('errorAlert').style.display = 'block';
            });
        });
    </script>
</body>
</html>