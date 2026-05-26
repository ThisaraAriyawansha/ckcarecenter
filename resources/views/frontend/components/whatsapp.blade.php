<style>
/* WhatsApp Chat Widget Styles */
.whatsapp-chat-widget {
    position: fixed;
    bottom: 10px;
    right: 20px;
    z-index: 9999;
    font-family: Arial, sans-serif;
}

/* WhatsApp Button */
.whatsapp-btn {
    display: flex;
    align-items: center;
    background: #128C7E; /* Darker green for better contrast */
    color: white;
    padding: 12px 18px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(18, 140, 126, 0.3);
    transition: all 0.3s ease;
    animation: float 3s ease-in-out infinite;
}

.whatsapp-btn:hover {
    background: #0D6E63; /* Even darker on hover */
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(18, 140, 126, 0.4);
}

.whatsapp-icon {
    font-size: 24px;
    margin-right: 10px;
}

.whatsapp-text {
    font-size: 14px;
    font-weight: 700; /* Increased from 600 to 700 */
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); /* Add subtle text shadow */
}

/* Chat Box */
.whatsapp-chat-box {
    position: absolute;
    bottom: 70px;
    right: 0;
    width: 320px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    display: none;
    overflow: hidden;
    animation: slideUp 0.3s ease;
}

.whatsapp-chat-box.active {
    display: block;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

/* Chat Header */
.chat-header {
    background: #075E54;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
}

.chat-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.chat-info h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: white;
}


.status {
    margin: 2px 0 0;
    font-size: 12px;
    opacity: 0.9;
}

.close-chat {
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s;
}

.close-chat:hover {
    background: rgba(255, 255, 255, 0.1);
}

/* Chat Body */
.chat-body {
    padding: 15px;
    max-height: 300px;
    overflow-y: auto;
    background: #ECE5DD;
}

.message {
    margin-bottom: 15px;
    max-width: 85%;
}

.message.received {
    margin-right: auto;
}

.message-content {
    background: white;
    padding: 10px 12px;
    border-radius: 8px 8px 8px 0;
    font-size: 14px;
    line-height: 1.4;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.message.received .message-content {
    background: white;
}

.message-time {
    font-size: 11px;
    color: #666;
    margin-top: 4px;
    text-align: left;
}

/* Chat Footer */
.chat-footer {
    padding: 15px;
    background: white;
    border-top: 1px solid #eee;
}

.whatsapp-cta-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #25D366;
    color: white;
    padding: 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: background 0.3s;
}

.whatsapp-cta-btn:hover {
    background: #128C7E;
}

.whatsapp-cta-btn i {
    margin-right: 8px;
    font-size: 18px;
}

.cta-note {
    font-size: 11px;
    color: #666;
    margin-top: 8px;
    text-align: center;
    line-height: 1.3;
}

/* Scrollbar Styling */
.chat-body::-webkit-scrollbar {
    width: 6px;
}

.chat-body::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chat-body::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .whatsapp-chat-widget {
        bottom: 10px;
        right: 15px;
    }
    
    .whatsapp-btn {
        padding: 10px 15px;
    }
    
    .whatsapp-text {
        display: none;
    }
    
    .whatsapp-icon {
        margin-right: 0;
        font-size: 22px;
    }
    
    .whatsapp-chat-box {
        width: 300px;
        right: 0px;
    }
    
    .chat-body {
        max-height: 250px;
    }
}

@media (max-width: 480px) {
    .whatsapp-chat-box {
        width: 280px;
        right: 0px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const whatsappBtn = document.getElementById('whatsappBtn');
    const whatsappChatBox = document.getElementById('whatsappChatBox');
    const closeChat = document.getElementById('closeChat');
    
    // Open chat box only when button is clicked
    whatsappBtn.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent event bubbling
        whatsappChatBox.classList.toggle('active');
    });
    
    // Close chat box when clicking the close button
    closeChat.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent event bubbling
        whatsappChatBox.classList.remove('active');
    });
    
    // Close chat box when clicking outside
    document.addEventListener('click', function(event) {
        if (!whatsappChatBox.contains(event.target) && !whatsappBtn.contains(event.target)) {
            whatsappChatBox.classList.remove('active');
        }
    });
    
});
</script>