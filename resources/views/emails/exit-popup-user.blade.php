<!DOCTYPE html>
<html>
<head>
    <title>Your Elder Care Planning Guide</title>
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
            padding: 30px;
            color: white;
            text-align: center;
        }
        .header h1 { 
            margin: 0 0 10px 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 15px;
        }
        .content { 
            padding: 30px;
        }
        .success-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #34c759, #30d158);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(52,199,89,0.3);
        }
        .success-icon span {
            color: white;
            font-size: 28px;
        }
        .guide-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid #e8e8ed;
        }
        .guide-preview h3 {
            margin: 0 0 10px 0;
            color: #1d1d1f;
            font-size: 17px;
            font-weight: 600;
        }
        .guide-features {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
            margin-top: 12px;
        }
        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #515154;
        }
        .feature:before {
            content: "✓";
            color: #30d158;
            font-weight: bold;
        }
        .user-info {
            background: #EFF6FF;
            padding: 16px;
            border-radius: 10px;
            margin: 25px 0;
            border-left: 4px solid #2B6CB0;
        }
        .user-info h3 {
            margin: 0 0 12px 0;
            color: #1e5a8e;
            font-size: 16px;
            font-weight: 600;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(43, 108, 176, 0.1);
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #515154;
            font-size: 14px;
        }
        .info-value {
            color: #1d1d1f;
            font-weight: 500;
            font-size: 14px;
        }
        .cta-button {
            display: inline-block;
            background: white;
            color: #2B6CB0;
            border: 2px solid #2B6CB0;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 10px;
            text-decoration: none;
            margin: 20px 0;
            transition: all 0.2s;
        }
        .cta-button:hover {
            background: #EFF6FF;
            color: #1e5a8e;
            border-color: #1e5a8e;
        }
        .footer {
            background: #f5f5f7;
            padding: 18px 30px 14px;
            text-align: center;
            border-top: 1px solid #e8e8ed;
        }
        .footer-brand {
            font-size: 16px;
            font-weight: 600;
            color: #2B6CB0;
        }
        .footer-contacts {
            margin: 6px 0;
            font-size: 12px;
            color: #515154;
            line-height: 1.8;
        }
        .footer-contacts a {
            color: #515154;
            text-decoration: none;
        }
        .footer-separator {
            color: #d1d1d6;
            margin: 0 6px;
        }
        .footer-website a {
            color: #2B6CB0;
            text-decoration: none;
            font-size: 12px;
        }
        .footer-copyright {
            font-size: 10px;
            color: #a1a1a6;
            margin: 10px 0 0;
        }
        .footer-credit {
            font-size: 10px;
            color: #a1a1a6;
            margin: 2px 0 0;
        }
        .footer-credit a {
            color: #86868b;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Elder Care Planning Guide</h1>
            <p>Thank you for trusting Care 365</p>
        </div>
        
        <div class="content">
            <div style="text-align: center;">

                <h2 style="color: #1d1d1f; font-size: 22px; margin-bottom: 8px;">
                    Thank you, {{ $name }}!
                </h2>
                <p style="color: #86868b; margin-bottom: 25px; font-size: 15px;">
                    We've received your request for our Elder Care Planning Guide.<br>
                    Your guide will be delivered to this email shortly.
                </p>
            </div>
            

            
            <div class="user-info">
                <h3>Your Request Summary</h3>
                <div class="info-row">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Senior's Age:</span>
                    <span class="info-value">{{ $age }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Care Type:</span>
                    <span class="info-value">{{ $care_type }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Timeline:</span>
                    <span class="info-value">{{ $timeline }}</span>
                </div>
            </div>
            
            <div style="text-align: center;">
                <p style="color: #515154; margin-bottom: 20px; font-size: 14px;">
                    While you wait for your guide, feel free to explore our<br>
                    online resources or schedule a free consultation.
                </p>
                
                
                <p style="font-size: 13px; color: #86868b; margin-top: 25px;">
                    Need immediate assistance?<br>
                    Our care advisors are available to help.
                </p>
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-brand">Care 365</div>
            <div class="footer-contacts">
                <a href="tel:+94776604040">+94 77 660 40 40</a>
                <span class="footer-separator">|</span>
                <a href="https://wa.me/94779191818">+94 779 191 818</a>
                <span class="footer-separator">|</span>
                <a href="mailto:info@care36t5.com">info@care36t5.com</a>
                <br>
                <span class="footer-website"><a href="https://care36t5.com/">www.care36t5.com</a></span>
            </div>
            <p class="footer-copyright">&copy; {{ date('Y') }} Care 365. All rights reserved.</p>
            <p class="footer-credit">Design &amp; Developed by <a href="https://creatxsoftware.com/" target="_blank">CreatX Software</a></p>
        </div>
    </div>
</body>
</html>