<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #1e293b;                /* slate-800 for good readability */
            background-color: #f0f9ff;     /* very light blue-gray bg */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #bfdbfe;     /* subtle light blue border */
        }
        .header {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
            color: #1e40af;                /* deep blue text */
            padding: 35px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid #e0f2fe;
        }
        .field:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #3b82f6;                /* bright but professional blue */
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .value {
            color: #1e293b;
            font-size: 16px;
            word-break: break-word;
        }
        .footer {
            background: #f0f9ff;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #475569;
            border-top: 1px solid #bfdbfe;
        }
        .emoji {
            font-size: 28px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><span class="emoji">📧</span> New Contact Form Submission</h1>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">Name</div>
                <div class="value">{{ $data['name'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email Address</div>
                <div class="value">{{ $data['email'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Phone Number</div>
                <div class="value">{{ $data['number'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Service Interested In</div>
                <div class="value">{{ $data['subject'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Message</div>
                <div class="value">{{ $data['message'] }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>This email was sent from Care 365 contact form</p>
            <p>Received on {{ date('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>