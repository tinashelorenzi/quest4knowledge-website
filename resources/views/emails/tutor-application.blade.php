<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #8000ff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .section { margin-bottom: 20px; }
        .section h3 { color: #8000ff; border-bottom: 2px solid #8000ff; padding-bottom: 5px; }
        .info-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 10px; }
        .info-item { padding: 5px 0; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Tutor Application</h1>
        </div>
        
        <div class="content">
            <div class="section">
                <h3>Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item"><span class="label">Full Name:</span></div>
                    <div class="info-item">{{ $application->full_name }}</div>
                    
                    <div class="info-item"><span class="label">Email:</span></div>
                    <div class="info-item">{{ $application->email }}</div>
                    
                    <div class="info-item"><span class="label">Phone:</span></div>
                    <div class="info-item">{{ $application->phone }}</div>
                    
                    <div class="info-item"><span class="label">Address:</span></div>
                    <div class="info-item">
                        {{ $application->street_address }}
                        @if($application->address_line), {{ $application->address_line }}@endif<br>
                        {{ $application->city }}, {{ $application->state }} {{ $application->zip_code }}
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>Education & Subjects</h3>
                <div class="info-grid">
                    <div class="info-item"><span class="label">Education Level:</span></div>
                    <div class="info-item">{{ $application->education_level }}</div>
                    
                    <div class="info-item"><span class="label">Tutoring Subjects:</span></div>
                    <div class="info-item">{{ implode(', ', $application->tutoring_subjects) }}</div>
                    
                    @if($application->other_subjects)
                    <div class="info-item"><span class="label">Other Subjects:</span></div>
                    <div class="info-item">{{ $application->other_subjects }}</div>
                    @endif
                </div>
            </div>

            <div class="section">
                <h3>Teaching Information</h3>
                <div class="info-grid">
                    <div class="info-item"><span class="label">Teaching Certification:</span></div>
                    <div class="info-item">{{ $application->has_teaching_certification ? 'Yes' : 'No' }}</div>
                    
                    <div class="info-item"><span class="label">Experience (Years):</span></div>
                    <div class="info-item">{{ $application->teaching_experience_years }}</div>
                    
                    <div class="info-item"><span class="label">Online Tutoring:</span></div>
                    <div class="info-item">{{ $application->can_do_online_tutoring ? 'Yes' : 'No' }}</div>
                    
                    <div class="info-item"><span class="label">Teaching Methods:</span></div>
                    <div class="info-item">{{ implode(', ', $application->teaching_methods) }}</div>
                    
                    <div class="info-item"><span class="label">Available Days:</span></div>
                    <div class="info-item">{{ implode(', ', $application->available_days) }}</div>
                    
                    <div class="info-item"><span class="label">Available Times:</span></div>
                    <div class="info-item">{{ implode(', ', $application->available_times) }}</div>
                    
                    <div class="info-item"><span class="label">Flexible Scheduling:</span></div>
                    <div class="info-item">{{ $application->flexible_scheduling ? 'Yes' : 'No' }}</div>
                </div>
            </div>

            <div class="section">
                <h3>Documents</h3>
                <ul>
                    @if($application->matric_transcript)
                        <li>Matric Transcript: Uploaded</li>
                    @endif
                    @if($application->university_transcript)
                        <li>University Transcript: Uploaded</li>
                    @endif
                    @if($application->id_document)
                        <li>ID Document: Uploaded</li>
                    @endif
                    @if($application->police_clearance)
                        <li>Police Clearance: Uploaded</li>
                    @endif
                </ul>
            </div>

            <div class="section">
                <p>Please review this application in the admin panel at: <a href="{{ url('/admin/tutor-applications') }}">{{ url('/admin/tutor-applications') }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>