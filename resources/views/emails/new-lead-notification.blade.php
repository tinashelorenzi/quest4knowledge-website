<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Lead Notification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #8000ff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .detail { margin: 10px 0; padding: 10px; background: white; border-radius: 5px; }
        .label { font-weight: bold; color: #8000ff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Lead Received!</h1>
        </div>
        <div class="content">
            <p>A new lead has been submitted through the Quest4Knowledge website.</p>
            
            <div class="detail">
                <span class="label">Name:</span> {{ $lead->full_name }}
            </div>
            
            <div class="detail">
                <span class="label">Email:</span> {{ $lead->email }}
            </div>
            
            <div class="detail">
                <span class="label">Phone:</span> {{ $lead->phone }}
            </div>
            
            <div class="detail">
                <span class="label">Level:</span> {{ ucwords(str_replace('_', ' ', $lead->level)) }}
            </div>
            
            <div class="detail">
                <span class="label">Preference:</span> {{ ucwords(str_replace('_', ' ', $lead->preference)) }}
            </div>
            
            @if($lead->message)
            <div class="detail">
                <span class="label">Message:</span><br>
                {{ $lead->message }}
            </div>
            @endif
            
            <div class="detail">
                <span class="label">Submitted:</span> {{ $lead->created_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>
</body>
</html>