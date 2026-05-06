<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #e52a2a; padding-bottom: 10px; margin-bottom: 20px; }
        .reply-box { background-color: #f9f9f9; padding: 15px; border-left: 4px solid #e52a2a; margin-bottom: 20px; }
        .original-message { color: #666; font-size: 0.9em; margin-top: 30px; border-top: 1px solid #eee; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>RYB Vehicle Trading</h2>
        </div>
        
        <p>Dear {{ $inquiry->user->name }},</p>
        
        <p>Thank you for reaching out to us regarding your recent inquiry. Our team has reviewed your message and provided the following response:</p>
        
        <div class="reply-box">
            {!! nl2br(e($adminReply)) !!}
        </div>
        
        <p>If you have any further questions, please do not hesitate to reply to this email or contact us via your dashboard.</p>
        
        <p>Best regards,<br>
        <strong>The RYB Vehicle Trading Team</strong></p>
        
        <div class="original-message">
            <strong>Your Original Message:</strong><br>
            <em>{{ $inquiry->message }}</em>
        </div>
    </div>
</body>
</html>