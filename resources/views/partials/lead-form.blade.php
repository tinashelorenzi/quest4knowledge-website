<!-- Lead Form Partial -->
<div class="lead-form-container">
    <style>
        .lead-form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid #8000ff;
        }

        .lead-form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #8000ff;
            font-size: 2rem;
            font-weight: bold;
        }

        .lead-form-subtitle {
            text-align: center;
            margin-bottom: 30px;
            color: #666;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .required {
            color: #e74c3c;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row > div {
            flex: 1;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fff;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #8000ff;
            box-shadow: 0 0 0 3px rgba(128, 0, 255, 0.1);
        }

        select {
            cursor: pointer;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #8000ff, #6600cc);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #6600cc, #5500aa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(128, 0, 255, 0.3);
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .loading {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
            display: none;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .form-group.has-error input,
        .form-group.has-error select,
        .form-group.has-error textarea {
            border-color: #e74c3c;
        }

        @media (max-width: 768px) {
            .lead-form-container {
                padding: 20px;
                margin: 10px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .lead-form-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <form id="leadForm" class="lead-form">
        <h2 class="lead-form-title">Request a Tutor</h2>
        <p class="lead-form-subtitle">Fill out the form below and we'll get in touch with you soon!</p>

        <div class="alert alert-success" id="successAlert">
            <strong>Success!</strong> Thank you for your interest! We will contact you soon.
        </div>

        <div class="alert alert-error" id="errorAlert">
            <strong>Error!</strong> <span id="errorMessage">Please check your information and try again.</span>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="first_name">First Name <span class="required">*</span></label>
                <input type="text" id="first_name" name="first_name" required>
                <div class="error-message" id="first_name_error"></div>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name <span class="required">*</span></label>
                <input type="text" id="last_name" name="last_name" required>
                <div class="error-message" id="last_name_error"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="email_error"></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number <span class="required">*</span></label>
                <input type="tel" id="phone" name="phone" required>
                <div class="error-message" id="phone_error"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="level">Education Level <span class="required">*</span></label>
                <select id="level" name="level" required>
                    <option value="">Select your level</option>
                    <option value="primary_school">Primary School</option>
                    <option value="high_school">High School</option>
                    <option value="university">University</option>
                    <option value="adult_learning">Adult Learning</option>
                </select>
                <div class="error-message" id="level_error"></div>
            </div>
            <div class="form-group">
                <label for="preference">Tutoring Preference <span class="required">*</span></label>
                <select id="preference" name="preference" required>
                    <option value="">Select your preference</option>
                    <option value="online">Online</option>
                    <option value="in_person">In Person</option>
                    <option value="both">Both</option>
                </select>
                <div class="error-message" id="preference_error"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="message">Additional Message (Optional)</label>
            <textarea id="message" name="message" placeholder="Tell us about your tutoring needs, subjects you need help with, or any specific requirements..."></textarea>
            <div class="error-message" id="message_error"></div>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
            <span class="btn-text">Request Tutor</span>
            <div class="loading" id="loading">
                <div class="spinner"></div>
                <span>Submitting...</span>
            </div>
        </button>
    </form>

    <script>
        document.getElementById('leadForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const loading = document.getElementById('loading');
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            // Reset previous states
            clearErrors();
            hideAlerts();
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            loading.style.display = 'flex';
            
            // Collect form data
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            
            try {
                const response = await fetch('/api/leads', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Show success message
                    successAlert.style.display = 'block';
                    form.reset();
                    form.scrollIntoView({ behavior: 'smooth' });
                } else {
                    // Show validation errors
                    if (result.errors) {
                        showValidationErrors(result.errors);
                    } else {
                        showErrorAlert(result.message || 'Something went wrong. Please try again.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showErrorAlert('Network error. Please check your connection and try again.');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                loading.style.display = 'none';
            }
        });
        
        function clearErrors() {
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('has-error');
            });
            document.querySelectorAll('.error-message').forEach(error => {
                error.textContent = '';
                error.style.display = 'none';
            });
        }
        
        function hideAlerts() {
            document.getElementById('successAlert').style.display = 'none';
            document.getElementById('errorAlert').style.display = 'none';
        }
        
        function showValidationErrors(errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const errorElement = document.getElementById(field + '_error');
                const formGroup = document.getElementById(field)?.closest('.form-group');
                
                if (errorElement && formGroup) {
                    formGroup.classList.add('has-error');
                    errorElement.textContent = messages[0];
                    errorElement.style.display = 'block';
                }
            }
        }
        
        function showErrorAlert(message) {
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = message;
            errorAlert.style.display = 'block';
            errorAlert.scrollIntoView({ behavior: 'smooth' });
        }
        
        // Real-time validation
        document.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('blur', function() {
                const formGroup = this.closest('.form-group');
                const errorElement = document.getElementById(this.name + '_error');
                
                if (this.hasAttribute('required') && !this.value.trim()) {
                    formGroup.classList.add('has-error');
                    errorElement.textContent = 'This field is required.';
                    errorElement.style.display = 'block';
                } else if (this.type === 'email' && this.value && !isValidEmail(this.value)) {
                    formGroup.classList.add('has-error');
                    errorElement.textContent = 'Please enter a valid email address.';
                    errorElement.style.display = 'block';
                } else {
                    formGroup.classList.remove('has-error');
                    errorElement.style.display = 'none';
                }
            });
        });
        
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
</div>