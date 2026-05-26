<!DOCTYPE html>
<html>
<head>
    <title>New Exit Popup Submission</title>
    <style>
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
            line-height: 1.6; 
            color: #1d1d1f; 
            background-color: #f5f5f7;
            margin: 0;
            padding: 20px;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header { 
            background: linear-gradient(135deg, #2B6CB0, #1e5a8e);
            padding: 25px 30px;
            color: white;
            text-align: center;
        }
        .header h1 { 
            margin: 0 0 8px 0;
            font-size: 22px;
            font-weight: 600;
        }
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .content { 
            padding: 30px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin: 25px 0;
        }
        .info-item {
            background: #f8f9fa;
            padding: 16px;
            border-radius: 10px;
            border-left: 4px solid #2B6CB0;
        }
        .info-label {
            display: block;
            font-size: 12px;
            color: #86868b;
            font-weight: 500;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            display: block;
            font-size: 16px;
            color: #1d1d1f;
            font-weight: 500;
        }
        .footer {
            background: #f5f5f7;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e8e8ed;
            font-size: 12px;
            color: #86868b;
        }
        .logo {
            font-size: 18px;
            font-weight: 600;
            color: #2B6CB0;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Exit Popup Submission</h1>
            <p>Elder Care Planning Guide Request</p>
        </div>
        
        <div class="content">
            <div style="text-align: center; margin-bottom: 25px;">

                <p style="margin: 0; color: #86868b; font-size: 14px;">
                    Submitted at: {{ $submitted_at }}
                </p>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $name }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $email }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Phone</span>
                    <span class="info-value">{{ $phone }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Senior's Age</span>
                    <span class="info-value">{{ $age }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Care Type</span>
                    <span class="info-value">{{ $care_type }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Timeline</span>
                    <span class="info-value">{{ $timeline }}</span>
                </div>
            </div>
            
            <div style="
                background: #EFF6FF;
                padding: 16px;
                border-radius: 10px;
                border: 1px solid #BFDBFE;
                margin-top: 25px;
            ">
                <p style="margin: 0; color: #1e5a8e; font-size: 13px;">
                    <strong>Note:</strong> This lead has requested the Elder Care Planning Guide 
                    and indicated interest in {{ strtolower($care_type) }} with a timeline of 
                    {{ strtolower($timeline) }}.
                </p>
            </div>
        </div>
        
        <div class="footer">
            <div class="logo">Care 365</div>
            <p>This is an automated notification from the Care 365 website.<br>
            Please follow up with this lead within 24 hours.</p>
        </div>
    </div>
</body>
</html>