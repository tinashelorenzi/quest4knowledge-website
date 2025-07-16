<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quest4Knowledge - Tutor Application</title>
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
        }

        .form-step.active {
            display: block;
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
        }

        .step-title {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row.single {
            grid-template-columns: 1fr;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #8000ff;
        }

        .required {
            color: #ff4444;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #8000ff;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #6600cc;
            box-shadow: 0 0 0 3px rgba(128, 0, 255, 0.1);
        }

        .checkbox-group, .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-item, .radio-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-item:hover, .radio-item:hover {
            border-color: #8000ff;
            background: rgba(128, 0, 255, 0.05);
        }

        .checkbox-item input, .radio-item input {
            width: auto;
            margin-right: 10px;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
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
            padding: 20px;
            border: 2px dashed #8000ff;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background: rgba(128, 0, 255, 0.05);
        }

        .file-upload-icon {
            font-size: 2rem;
            color: #8000ff;
            margin-bottom: 10px;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #8000ff;
            color: white;
        }

        .btn-primary:hover {
            background: #6600cc;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #666;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .btn-submit {
            background: #FFD700;
            color: #8000ff;
        }

        .btn-submit:hover {
            background: #FFC800;
            transform: translateY(-2px);
        }

        .error-message {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
            background: rgba(255, 68, 68, 0.1);
            padding: 8px 12px;
            border-radius: 4px;
            border-left: 3px solid #ff4444;
        }

        .success-message {
            text-align: center;
            padding: 30px;
            background: rgba(76, 175, 80, 0.1);
            border: 2px solid #4CAF50;
            border-radius: 8px;
            margin: 20px 0;
        }

        .success-message h3 {
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .success-message i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .loading {
            text-align: center;
            padding: 20px;
            display: none;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(128, 0, 255, 0.3);
            border-radius: 50%;
            border-top-color: #8000ff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .form-step {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .step-indicator {
                padding: 15px 20px;
            }

            .step-title {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1><i class="fas fa-graduation-cap"></i> Join Our Team</h1>
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
                    <div class="step-title">Education & Qualifications</div>
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
                    <div class="step-title">Consent & Review</div>
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
                                <input type="text" name="zip_code" id="zip_code" placeholder="ZIP/Postal Code" required>
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
                        <label for="education_level">Highest Level of Education <span class="required">*</span></label>
                        <select name="education_level" id="education_level" required>
                            <option value="">Select Education Level</option>
                            <option value="High School">High School (Matric)</option>
                            <option value="Bachelors">BSc (Bachelors)</option>
                            <option value="MSc(Masters)">MSc (Masters)</option>
                            <option value="PhD(Doctorate)">PhD (Doctorate)</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tutoring Subjects (High School) <span class="required">*</span></label>
                        <p style="color: #666; margin-bottom: 15px;">What subjects/courses are you willing to teach?</p>
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
                        <textarea name="other_subjects" id="other_subjects" rows="3" placeholder="If other subjects not provided above, please specify them separated by a comma"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Academic Transcript (High School)</label>
                        <p style="color: #666; margin-bottom: 15px;">Please upload a copy of your Matric Academic Transcript</p>
                        <div class="file-upload">
                            <input type="file" name="matric_transcript" id="matric_transcript" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="matric_transcript" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">PDF, JPG, PNG (max 8MB)</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Academic Transcript (University/College)</label>
                        <p style="color: #666; margin-bottom: 15px;">Please upload a copy of your University or College Transcript if applicable</p>
                        <div class="file-upload">
                            <input type="file" name="university_transcript" id="university_transcript" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="university_transcript" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">PDF, JPG, PNG (max 8MB)</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Teaching Certification <span class="required">*</span></label>
                        <p style="color: #666; margin-bottom: 15px;">Do you have any teaching certifications? (This will not affect the outcome of your application)</p>
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
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next Step <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 3: Teaching Experience -->
                <div class="form-step" data-step="3">
                    <h2>Teaching Experience</h2>
                    
                    <div class="form-group">
                        <label for="teaching_experience_years">Teaching Experience <span class="required">*</span></label>
                        <p style="color: #666; margin-bottom: 15px;">How many years of teaching/tutoring experience do you have (Formal and informal)?</p>
                        <input type="number" name="teaching_experience_years" id="teaching_experience_years" min="1" max="150" placeholder="e.g. 5" required>
                    </div>

                    <div class="form-group">
                        <label>Online Tutoring <span class="required">*</span></label>
                        <p style="color: #666; margin-bottom: 15px;">Are you able to perform online tutoring?</p>
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
                        <p style="color: #666; margin-bottom: 15px;">What teaching methods are you able to conduct?</p>
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
                        <p style="color: #666; margin-bottom: 15px;">What days are you available for tutoring?</p>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Sunday" id="day-sun">
                                <label for="day-sun">Sunday</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Monday" id="day-mon">
                                <label for="day-mon">Monday</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Tuesday" id="day-tue">
                                <label for="day-tue">Tuesday</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Wednesday" id="day-wed">
                                <label for="day-wed">Wednesday</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Thursday" id="day-thu">
                                <label for="day-thu">Thursday</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Friday" id="day-fri">
                                <label for="day-fri">Friday</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="available_days[]" value="Saturday" id="day-sat">
                                <label for="day-sat">Saturday</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tutoring Times <span class="required">*</span></label>
                        <p style="color: #666; margin-bottom: 15px;">What time slots are you available?</p>
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
                        <p style="color: #666; margin-bottom: 15px;">Are you open and available for flexible scheduling?</p>
                        <div class="radio-group">
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
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next Step <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 4: Documentation -->
                <div class="form-step" data-step="4">
                    <h2>Documentation</h2>
                    
                    <div class="form-group">
                        <label>ID Document/Passport <span class="required">*</span></label>
                        <p style="color: #666; margin-bottom: 15px;">Please upload your relevant Identity Documentation</p>
                        <div class="file-upload">
                            <input type="file" name="id_document" id="id_document" accept=".pdf,.jpg,.jpeg,.png" required>
                            <label for="id_document" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">PDF, JPG, PNG (max 8MB)</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Police Clearance (Advised)</label>
                        <p style="color: #666; margin-bottom: 15px;">Please upload a valid police clearance. It is optional however advised to increase chances of acceptance</p>
                        <div class="file-upload">
                            <input type="file" name="police_clearance" id="police_clearance" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="police_clearance" class="file-upload-label">
                                <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div>Click to upload or drag and drop</div>
                                <div style="font-size: 14px; color: #888;">PDF, JPG, PNG (max 8MB)</div>
                            </label>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous</button>
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
                        <div class="checkbox-item" style="border: 2px solid #8000ff; padding: 20px;">
                            <input type="checkbox" name="consent" id="consent" required>
                            <label for="consent">
                                <strong>Consent <span class="required">*</span></strong><br>
                                Yes, I agree with the privacy policy and terms and conditions.<br>
                                I furthermore agree that the information provided is truthful to the best of my ability and accept rejection in the event that it is not.
                            </label>
                        </div>
                    </div>

                    <div class="loading" id="loadingDiv">
                        <div class="spinner"></div>
                        <p>Submitting your application...</p>
                    </div>

                    <div id="successMessage" class="success-message" style="display: none;">
                        <h3><i class="fas fa-check-circle"></i> Application Submitted Successfully!</h3>
                        <p>Thank you for completing your application. We will reach out to you by email soon!</p>
                    </div>

                    <div class="navigation-buttons">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Previous</button>
                        <button type="submit" class="btn btn-submit" id="submitBtn"><i class="fas fa-paper-plane"></i> Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 5;

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
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            const targetStep = document.querySelector(`[data-step="${step}"]`);
            if (targetStep) {
                targetStep.classList.add('active');
                console.log('Step', step, 'is now active');
            } else {
                console.error('Step element not found for step:', step);
            }
            updateStepIndicator();
        }

        function nextStep() {
            console.log('Next step called, current step:', currentStep);
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        }

        function prevStep() {
            console.log('Previous step called, current step:', currentStep);
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function validateCurrentStep() {
            console.log('Validating step:', currentStep);
            const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
            if (!currentStepElement) {
                console.error('Current step element not found');
                return false;
            }
            
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            // Clear previous error messages
            currentStepElement.querySelectorAll('.error-message').forEach(msg => msg.remove());

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    showError(field, 'This field is required');
                    isValid = false;
                }
            });

            // Special validation for checkbox groups
            if (currentStep === 2) {
                const subjects = currentStepElement.querySelectorAll('input[name="tutoring_subjects[]"]:checked');
                if (subjects.length === 0) {
                    showError(document.querySelector('input[name="tutoring_subjects[]"]').closest('.form-group'), 'Please select at least one subject');
                    isValid = false;
                }
            }

            if (currentStep === 3) {
                const methods = currentStepElement.querySelectorAll('input[name="teaching_methods[]"]:checked');
                const days = currentStepElement.querySelectorAll('input[name="available_days[]"]:checked');
                const times = currentStepElement.querySelectorAll('input[name="available_times[]"]:checked');

                if (methods.length === 0) {
                    showError(document.querySelector('input[name="teaching_methods[]"]').closest('.form-group'), 'Please select at least one teaching method');
                    isValid = false;
                }
                if (days.length === 0) {
                    showError(document.querySelector('input[name="available_days[]"]').closest('.form-group'), 'Please select at least one day');
                    isValid = false;
                }
                if (times.length === 0) {
                    showError(document.querySelector('input[name="available_times[]"]').closest('.form-group'), 'Please select at least one time slot');
                    isValid = false;
                }
            }

            console.log('Validation result:', isValid);
            return isValid;
        }

        function showError(element, message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.style.color = '#ff4444';
            errorDiv.style.fontSize = '14px';
            errorDiv.style.marginTop = '5px';
            errorDiv.textContent = message;
            
            if (element.closest('.form-group')) {
                element.closest('.form-group').appendChild(errorDiv);
            } else {
                element.parentNode.insertBefore(errorDiv, element.nextSibling);
            }
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

                if (result.success) {
                    loadingDiv.style.display = 'none';
                    successMessage.style.display = 'block';
                    submitBtn.style.display = 'none';
                    
                    // Scroll to success message
                    successMessage.scrollIntoView({ behavior: 'smooth' });
                } else {
                    throw new Error(result.message || 'Application submission failed');
                }
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
                    label.innerHTML = `
                        <div class="file-upload-icon"><i class="fas fa-check-circle" style="color: green;"></i></div>
                        <div>${fileName}</div>
                        <div style="font-size: 14px; color: #888;">File selected successfully</div>
                    `;
                    label.style.background = 'rgba(0, 128, 0, 0.05)';
                    label.style.borderColor = 'green';
                }
            });
        });

        // Initialize
        console.log('Initializing tutor application form...');
        updateStepIndicator();
        console.log('Form initialized successfully');
    </script>
</body>
</html>