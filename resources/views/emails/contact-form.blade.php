<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #6B46C1;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field label {
            font-weight: bold;
            color: #6B46C1;
        }
        .field p {
            margin: 5px 0;
            background-color: white;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
        <p>Submitted on {{ $contact->formatted_created_at }}</p>
    </div>
    
    <div class="content">
        <div class="field">
            <label>Name:</label>
            <p>{{ $contact->name }}</p>
        </div>
        
        <div class="field">
            <label>Email:</label>
            <p>{{ $contact->email }}</p>
        </div>
        
        <div class="field">
            <label>Phone:</label>
            <p>{{ $contact->phone }}</p>
        </div>
        
        <div class="field">
            <label>Message:</label>
            <p>{{ nl2br(e($contact->message)) }}</p>
        </div>
    </div>
    
    <div class="footer">
        <p>This email was sent from the Quest4Knowledge contact form.</p>
        <p>You can manage contact submissions in your admin panel.</p>
    </div>
</body>
</html>