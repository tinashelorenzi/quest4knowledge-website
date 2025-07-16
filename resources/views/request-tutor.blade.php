<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Request a Tutor - Quest4Knowledge</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .hero-section {
            text-align: center;
            padding: 60px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }

        .info-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .info-title {
            font-size: 2rem;
            color: #8000ff;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .feature-list {
            list-style: none;
            margin-bottom: 30px;
        }

        .feature-list li {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background: #8000ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
        }

        .success-stories {
            margin-top: 30px;
        }

        .story {
            background: #f8f9ff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #8000ff;
        }

        .story-quote {
            font-style: italic;
            color: #666;
            margin-bottom: 10px;
        }

        .story-author {
            font-weight: bold;
            color: #8000ff;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 40px 0;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #8000ff;
            display: block;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .stats-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 20px;
            }

            .info-section {
                padding: 30px 20px;
            }

            .main-content {
                padding: 20px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <h1 class="hero-title">Find Your Perfect Tutor</h1>
        <p class="hero-subtitle">Unlock your potential with personalized tutoring from Quest4Knowledge</p>
        
        <div class="stats-section">
            <div class="stat-card">
                <span class="stat-number">500+</span>
                <div class="stat-label">Students Helped</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">95%</span>
                <div class="stat-label">Success Rate</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">50+</span>
                <div class="stat-label">Expert Tutors</div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="content-grid">
            <div class="info-section">
                <h2 class="info-title">Why Choose Quest4Knowledge?</h2>
                
                <ul class="feature-list">
                    <li>
                        <div class="feature-icon">✓</div>
                        <div>
                            <strong>Expert Tutors:</strong> All our tutors are qualified professionals with proven track records
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">✓</div>
                        <div>
                            <strong>Flexible Learning:</strong> Choose between online or in-person sessions that fit your schedule
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">✓</div>
                        <div>
                            <strong>Personalized Approach:</strong> Customized learning plans tailored to your specific needs
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">✓</div>
                        <div>
                            <strong>All Levels:</strong> From primary school to university and adult learning
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">✓</div>
                        <div>
                            <strong>Proven Results:</strong> 95% of our students see grade improvements within 3 months
                        </div>
                    </li>
                </ul>

                <div class="success-stories">
                    <h3 style="color: #8000ff; margin-bottom: 20px;">Success Stories</h3>
                    
                    <div class="story">
                        <div class="story-quote">"My daughter went from failing math to getting A's in just 4 months. The tutor was patient and really understood her learning style."</div>
                        <div class="story-author">- Sarah M., Parent</div>
                    </div>
                    
                    <div class="story">
                        <div class="story-quote">"The online chemistry tutoring helped me pass my university exams. The flexible scheduling was perfect for my busy lifestyle."</div>
                        <div class="story-author">- James L., University Student</div>
                    </div>
                    
                    <div class="story">
                        <div class="story-quote">"Professional, knowledgeable, and really cares about student success. Highly recommend Quest4Knowledge!"</div>
                        <div class="story-author">- Michael R., High School Student</div>
                    </div>
                </div>
            </div>

            <div>
                @include('partials.lead-form')
            </div>
        </div>
    </div>
</body>
</html>