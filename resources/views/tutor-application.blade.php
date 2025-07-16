<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quest4Knowledge - Tutor Registration Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Navbar Styles */
        nav {
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 30px;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
            font-size: 30px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: #FDE047;
            transform: translateY(-2px);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #FDE047;
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .cta-nav {
            background: #FDE047;
            color: #6B46C1;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-nav:hover {
            background: #FEF08A;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .auth-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .auth-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .auth-links a:hover {
            color: #FDE047;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            cursor: pointer;
            background: none;
            border: none;
            padding: 8px;
            z-index: 1001;
        }

        .mobile-menu-btn span {
            width: 25px;
            height: 3px;
            background: white;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .mobile-menu-btn.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .mobile-menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(107, 70, 193, 0.95);
            backdrop-filter: blur(20px);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        .mobile-menu ul {
            list-style: none;
            text-align: center;
        }

        .mobile-menu li {
            margin: 20px 0;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .mobile-menu a:hover {
            color: #FDE047;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .auth-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: flex;
            }
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .form-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .form-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .form-step {
            display: none;
            padding: 40px;
            animation: fadeIn 0.3s ease-in;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            background: #8000ff;
            padding: 20px 40px;
            color: white;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step.completed .step-number {
            background: #FFD700;
            color: #8000ff;
        }

        .step.active .step-number {
            background: #FFD700;
            color: #8000ff;
        }

        .step-number {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            line-height: 30px;
            margin-bottom: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .step-title {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .required {
            color: #e74c3c;
        }

        .description {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            font-style: italic;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row > div {
            flex: 1;
        }

        .form-row.single {
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #8000ff;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #6600cc;
            box-shadow: 0 0 0 2px rgba(128, 0, 255, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group,
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .checkbox-item,
        .radio-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            min-width: 120px;
        }

        .checkbox-item:hover,
        .radio-item:hover {
            border-color: #8000ff;
            background: rgba(128, 0, 255, 0.05);
        }

        .checkbox-item input,
        .radio-item input {
            margin-right: 8px;
        }

        .checkbox-item input:checked + label,
        .radio-item input:checked + label {
            color: #8000ff;
            font-weight: 600;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #8000ff;
            color: white;
        }

        .btn-primary:hover {
            background: #6600cc;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .btn-submit {
            background: #FFD700;
            color: #000000;
            font-weight: 600;
        }

        .btn-submit:hover {
            background: #FFC800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .file-upload {
            position: relative;
            display: block;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-label {
            display: block;
            padding: 30px;
            border: 2px dashed #8000ff;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(128, 0, 255, 0.05);
        }

        .file-upload-label:hover {
            background: rgba(128, 0, 255, 0.1);
        }

        .file-upload-icon {
            font-size: 2rem;
            color: #8000ff;
            margin-bottom: 10px;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #8000ff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .success-message {
            text-align: center;
            padding: 30px;
            background: #8000ff;
            color: white;
            border-radius: 8px;
        }

        .success-message h3 {
            margin-bottom: 15px;
            color: white;
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }

        .consent-box {
            border: 2px solid #8000ff;
            padding: 20px;
            border-radius: 8px;
            background: rgba(128, 0, 255, 0.05);
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .form-step {
                padding: 20px;
            }

            .step-indicator {
                padding: 15px 20px;
            }

            .step-title {
                font-size: 0.8rem;
            }

            .form-row {
                flex-direction: column;
                gap: 10px;
            }

            .navigation-buttons {
                flex-direction: column;
            }

            .checkbox-group,
            .radio-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @include('partials.navbar')
        <div class="form-header">
            <h1><i class="fas fa-graduation-cap"></i> Tutor Registration Form</h1>
            <p>Apply to become a tutor with Quest4Knowledge</p>
        </div>

        <div class="form-container">
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-title">Personal Information</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-title">Education and Qualifications</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-title">Teaching Experience</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-title">Documentation</div>
                </div>
                <div class="step" data-step="5">
                    <div class="step-number">5</div>
                    <div class="step-title">Consent and Review</div>
                </div>
            </div>

            <form id="tutorApplicationForm" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Step 1: Personal Information -->
                <div class="form-step active" data-step="1">
                    <h2>Personal Information</h2>
                    
                    <div class="form-group">
                        <label>Name <span class="required">*</span></label>
                        <div class="form-row">
                            <div>
                                <select name="prefix" id="prefix">
                                    <option value="">Select Prefix</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Prof">Prof</option>
                                </select>
                            </div>
                            <div>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 15px;">
                            <div>
                                <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name">
                            </div>
                            <div>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div>
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" name="email" id="email" placeholder="john@example.com" required>
                            </div>
                            <div>
                                <label for="phone">Phone <span class="required">*</span></label>
                                <input type="tel" name="phone" id="phone" placeholder="+1 300 400 5000" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <div class="form-row single">
                            <input type="text" name="street_address" id="street_address" placeholder="Street Address" required>
                        </div>
                        <div class="form-row" style="margin-top: 15px;">
                            <div>
                                <input type="text" name="address_line" id="address_line" placeholder="Apartment, suite, etc (optional)">
                            </div>
                            <div>
                                <input type="text" name="city" id="city" placeholder="City" required>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 15px;">
                            <div>
                                <input type="text" name="state" id="state" placeholder="State/Province" required>
                            </div>
                            <div>
                                <input type="text" name="zip_code" id="zip_code" placeholder="ZIP / Postal Code" required>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <div></div>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next Step <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 2: Education & Qualifications -->
                <div class="form-step" data-step="2">
                    <h2>Education & Qualifications</h2>
                    
                    <div class="form-group">
                        <label for="highest_qualification">Highest Level of Education <span class="required">*</span></label>
                        <div class="description">What is your Highest Level of Education?</div>
                        <select name="education_level" id="education_level" required>
                            <option value="">Select your highest qualification</option>
                            <option value="High School">High School (Matric)</option>
                            <option value="Bachelors">BSc (Bachelors)</option>
                            <option value="MSc(Masters)">MSc (Masters)</option>
                            <option value="PhD(Doctorate)">PhD (Doctorate)</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tutoring Subjects (High School) <span class="required">*</span></label>
                        <div class="description">What subjects/courses are you willing to teach?</div>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Mathematics" id="math">
                                <label for="math">Mathematics</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Mathematics-Literacy" id="math-lit">
                                <label for="math-lit">Mathematics Literacy</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Physical Sciences" id="physics">
                                <label for="physics">Physical Sciences</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Biology(Life-Sciences)" id="biology">
                                <label for="biology">Biology (Life Sciences)</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Accounting" id="accounting">
                                <label for="accounting">Accounting</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Business-Studies" id="business">
                                <label for="business">Business Studies</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Computer-Applications-Technology" id="cat">
                                <label for="cat">Computer Applications Technology</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Geography" id="geography">
                                <label for="geography">Geography</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="History" id="history">
                                <label for="history">History</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Economics" id="economics">
                                <label for="economics">Economics</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="tutoring_subjects[]" value="Other" id="other-subject">
                                <label for="other-subject">Other</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="other_subjects">Other Subjects</label>
                        <div class="description">If other subjects not provided above, please specify them separated by a comma</div>
                        <textarea name="other_subjects" id="other_subjects" placeholder="E.g. French, German, Art, etc."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Academic Transcript (High School) <span class="required">*</span></label>
                        <div class="description">Please upload a copy of your Matric Academic Transcript</div>
                        <div class="file-upload">
                                                         <input type="file" name="matric_transcript" id="matric_transcript" required>
                                                         <label for="matric_transcript" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">Max 8MB</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Academic Transcript (Uni/College)</label>
                        <div class="description">Please upload a copy of your University or College Transcript if applicable</div>
                        <div class="file-upload">
                            <input type="file" name="university_transcript" id="university_transcript">
                            <label for="university_transcript" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">Max 8MB</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Teaching Certification <span class="required">*</span></label>
                        <div class="description">Do you have any teaching certifications (This will not affect the outcome of your application)</div>
                        <div class="radio-group">
                            <div class="radio-item">
                                                                 <input type="radio" name="has_teaching_certification" value="1" id="cert-yes" required>
                                <label for="cert-yes">Yes</label>
                            </div>
                            <div class="radio-item">
                                                                 <input type="radio" name="has_teaching_certification" value="0" id="cert-no" required>
                                <label for="cert-no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous Step</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next Step <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 3: Teaching Experience -->
                <div class="form-step" data-step="3">
                    <h2>Teaching Experience</h2>
                    
                    <div class="form-group">
                        <label for="teaching_experience">Teaching Experience <span class="required">*</span></label>
                        <div class="description">How many years of teaching/tutoring experience do you have (Formal and informal)?</div>
                                                 <input type="number" name="teaching_experience_years" id="teaching_experience_years" min="1" max="150" placeholder="e.g., 2" required>
                    </div>

                    <div class="form-group">
                        <label>Online Tutoring <span class="required">*</span></label>
                        <div class="description">Are you able to perform online tutoring?</div>
                        <div class="radio-group">
                            <div class="radio-item">
                                                                 <input type="radio" name="can_do_online_tutoring" value="1" id="online-yes" required>
                                <label for="online-yes">Yes</label>
                            </div>
                            <div class="radio-item">
                                                                 <input type="radio" name="can_do_online_tutoring" value="0" id="online-no" required>
                                <label for="online-no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Teaching Methods <span class="required">*</span></label>
                        <div class="description">What teaching methods are you able to conduct?</div>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" name="teaching_methods[]" value="Online" id="method-online">
                                <label for="method-online">Online</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="teaching_methods[]" value="In-Person" id="method-person">
                                <label for="method-person">In-Person</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="teaching_methods[]" value="Hybrid" id="method-hybrid">
                                <label for="method-hybrid">Hybrid</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tutoring Days <span class="required">*</span></label>
                        <div class="description">What days are you available for tutoring?</div>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Sunday" id="day-sunday">
                                <label for="day-sunday">Sunday</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Monday" id="day-monday">
                                <label for="day-monday">Monday</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Tuesday" id="day-tuesday">
                                <label for="day-tuesday">Tuesday</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Wednesday" id="day-wednesday">
                                <label for="day-wednesday">Wednesday</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Thursday" id="day-thursday">
                                <label for="day-thursday">Thursday</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Friday" id="day-friday">
                                <label for="day-friday">Friday</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_days[]" value="Saturday" id="day-saturday">
                                <label for="day-saturday">Saturday</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tutoring Times <span class="required">*</span></label>
                        <div class="description">What time slots are you available?</div>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_times[]" value="Morning" id="time-morning">
                                <label for="time-morning">Morning</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_times[]" value="Afternoon" id="time-afternoon">
                                <label for="time-afternoon">Afternoon</label>
                            </div>
                            <div class="checkbox-item">
                                                                 <input type="checkbox" name="available_times[]" value="Evening" id="time-evening">
                                <label for="time-evening">Evening</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Flexible Scheduling <span class="required">*</span></label>
                        <div class="description">Are you open and available for flexible scheduling?</div>
                        <div class="checkbox-group">
                                                         <div class="radio-item">
                                 <input type="radio" name="flexible_scheduling" value="1" id="flexible-yes" required>
                                 <label for="flexible-yes">Yes</label>
                             </div>
                             <div class="radio-item">
                                 <input type="radio" name="flexible_scheduling" value="0" id="flexible-no" required>
                                 <label for="flexible-no">No</label>
                             </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous Step</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next Step <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 4: Documentation -->
                <div class="form-step" data-step="4">
                    <h2>Documentation</h2>
                    
                    <div class="form-group">
                        <label>ID Document/Passport <span class="required">*</span></label>
                        <div class="description">Please upload your relevant Identity Documentation</div>
                        <div class="file-upload">
                            <input type="file" name="id_document" id="id_document" required>
                            <label for="id_document" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">Max 8MB</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Police Clearance (Advised)</label>
                        <div class="description">Please upload a valid police clearance, it is optional however advised to increase chances of acceptance</div>
                        <div class="file-upload">
                            <input type="file" name="police_clearance" id="police_clearance">
                            <label for="police_clearance" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">Max 8MB</div>
                            </label>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous Step</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next Step <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 5: Consent & Review -->
                <div class="form-step" data-step="5">
                    <h2>Consent & Review</h2>
                    
                    <div class="form-group">
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                            <h3 style="color: #8000ff; margin-bottom: 15px;">Application Summary</h3>
                            <p>Please review your information before submitting. You can go back to previous steps to make any changes.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="consent-box">
                            <div style="display: flex; align-items: flex-start; gap: 10px;">
                                <input type="checkbox" name="consent" id="consent" required style="margin-top: 5px;">
                                <label for="consent">
                                    <strong>Consent <span class="required">*</span></strong><br>
                                    Yes, I agree with the <a href="#" target="_blank" style="color: #8000ff;">privacy policy</a> and <a href="#" target="_blank" style="color: #8000ff;">terms and conditions</a>.<br>
                                    I furthermore agree that the information provided is truthful to the best of my ability and accept rejection in the event that it is not.
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="loading" id="loadingDiv">
                        <div class="spinner"></div>
                        <p>Submitting your application...</p>
                    </div>

                    <div id="successMessage" class="success-message" style="display: none;">
                        <h3><i class="fas fa-check-circle"></i> Application Submitted Successfully!</h3>
                        <p>Thank you for completing your application, we will reach out to you by email soon!</p>
                    </div>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous Step</button>
                        <button type="submit" class="btn btn-submit" id="submitBtn"><i class="fas fa-paper-plane"></i> Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 5;

        // Initialize the form
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Tutor Registration Form initialized');
            showStep(1);
        });

        function updateStepIndicator() {
            console.log('Updating step indicator, current step:', currentStep);
            document.querySelectorAll('.step').forEach((step, index) => {
                const stepNumber = index + 1;
                step.classList.remove('active', 'completed');
                
                if (stepNumber < currentStep) {
                    step.classList.add('completed');
                } else if (stepNumber === currentStep) {
                    step.classList.add('active');
                }
            });
        }

        function showStep(step) {
            console.log('Showing step:', step);
            
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(s => {
                s.classList.remove('active');
            });
            
            // Show current step
            const targetStep = document.querySelector(`.form-step[data-step="${step}"]`);
            if (targetStep) {
                targetStep.classList.add('active');
                console.log('Step', step, 'is now active');
            } else {
                console.error('Step element not found for step:', step);
            }
            
            currentStep = step;
            updateStepIndicator();
            
            // Scroll to top of form
            document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth' });
        }

        function nextStep() {
            console.log('Next step requested, current:', currentStep);
            
            if (!validateCurrentStep()) {
                console.log('Validation failed for step:', currentStep);
                return;
            }

            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        }

        function prevStep() {
            console.log('Previous step requested, current:', currentStep);
            
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        function validateCurrentStep() {
            const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
            const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(error => error.remove());

            requiredFields.forEach(field => {
                if (field.type === 'checkbox' || field.type === 'radio') {
                    if (field.name.includes('[]')) {
                        // For checkbox groups
                        const checkboxGroup = currentStepElement.querySelectorAll(`input[name="${field.name}"]`);
                        const isChecked = Array.from(checkboxGroup).some(cb => cb.checked);
                        if (!isChecked) {
                            showFieldError(field, 'Please select at least one option');
                            isValid = false;
                        }
                    } else {
                        // For radio groups
                        const radioGroup = currentStepElement.querySelectorAll(`input[name="${field.name}"]`);
                        const isChecked = Array.from(radioGroup).some(rb => rb.checked);
                        if (!isChecked) {
                            showFieldError(field, 'Please select an option');
                            isValid = false;
                        }
                    }
                } else if (field.type === 'file') {
                    if (!field.files.length) {
                        showFieldError(field, 'Please select a file');
                        isValid = false;
                    }
                } else {
                    if (!field.value.trim()) {
                        showFieldError(field, 'This field is required');
                        isValid = false;
                    }
                }
            });

            return isValid;
        }

        function showFieldError(field, message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = message;
            
            // Insert error message after the field's parent container
            const parent = field.closest('.form-group') || field.parentNode;
            parent.appendChild(errorDiv);
        }

        // Form submission
        document.getElementById('tutorApplicationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!validateCurrentStep()) {
                return;
            }

            const loadingDiv = document.getElementById('loadingDiv');
            const submitBtn = document.getElementById('submitBtn');
            const successMessage = document.getElementById('successMessage');
            
            loadingDiv.style.display = 'block';
            submitBtn.disabled = true;

            const formData = new FormData(this);

            try {
                const response = await fetch('/tutor-application', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const result = await response.json();

                if (!result.success) {
                    throw new Error(result.message || 'Application submission failed');
                }

                loadingDiv.style.display = 'none';
                successMessage.style.display = 'block';
                submitBtn.style.display = 'none';
                
                // Scroll to success message
                successMessage.scrollIntoView({ behavior: 'smooth' });
                
            } catch (error) {
                loadingDiv.style.display = 'none';
                submitBtn.disabled = false;
                alert('There was an error submitting your application. Please try again.');
                console.error('Error:', error);
            }
        });

        // File upload feedback
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
                    label.innerHTML = `
                        <div class="file-upload-icon"><i class="fas fa-check-circle" style="color: green;"></i></div>
                        <div>${fileName}</div>
                        <div style="font-size: 14px; color: #888;">File selected successfully (${fileSize} MB)</div>
                    `;
                    label.style.background = 'rgba(0, 128, 0, 0.05)';
                    label.style.borderColor = 'green';
                }
            });
        });

        // Email validation
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            // Remove previous error
            const existingError = this.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            if (email && !emailRegex.test(email)) {
                showFieldError(this, 'Please enter a valid email address');
            }
        });

        // Prevent form submission on Enter key (except for textarea)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                e.preventDefault();
                if (e.target.closest('.form-step')) {
                    nextStep();
                }
            }
        });

        console.log('Tutor application form script loaded successfully');

        // Mobile menu functionality
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');

        mobileMenuBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
            });
        });
    </script>
</body>
</html>