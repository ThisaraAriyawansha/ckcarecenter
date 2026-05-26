<!-- Modern Alert Modal -->
<div id="alertModal" class="alert-modal">
    <div class="alert-modal-content">
        <div class="alert-icon" id="alertIcon"></div>
        <h3 id="alertTitle"></h3>
        <p id="alertMessage"></p>
        <button class="alert-close-btn" onclick="closeAlert()">Close</button>
    </div>
</div>

<style>
.alert-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    background-color: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(6px);
    animation: fadeIn 0.25s ease;
}

.alert-modal-content {
    position: relative;
    background: white;
    margin: 10% auto;
    padding: 28px 24px;
    border-radius: 16px;
    max-width: 90%;
    width: 420px;                /* max width on large screens */
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.18);
    border: 1px solid #e0f2fe;
    animation: slideDown 0.3s ease;
    color: #1e293b;              /* dark slate for text */
}

/* Mobile adjustments */
@media (max-width: 480px) {
    .alert-modal-content {
        margin: 15% auto 5%;
        padding: 24px 20px;
        border-radius: 14px;
        max-width: 92%;
    }
    
    .alert-icon {
        width: 64px;
        height: 64px;
        font-size: 32px;
    }
    
    .alert-modal-content h3 {
        font-size: 20px;
        margin: 12px 0;
    }
    
    .alert-modal-content p {
        font-size: 15px;
        margin: 0 0 20px;
    }
    
    .alert-close-btn {
        padding: 10px 32px;
        font-size: 15px;
    }
}

.alert-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: bold;
    background: #f0f9ff;           /* very light blue */
    color: #3b82f6;                /* blue icon */
    border: 2px solid #bfdbfe;
    box-shadow: 0 2px 10px rgba(59, 130, 246, 0.15);
}

.alert-modal-content h3 {
    margin: 12px 0 8px;
    font-size: 22px;
    font-weight: 600;
    color: #1e40af;
}

.alert-modal-content p {
    margin: 0 0 24px;
    font-size: 15.5px;
    line-height: 1.5;
    color: #475569;
}

.alert-close-btn {
    background: #3b82f6;
    color: white;
    border: none;
    padding: 11px 36px;
    font-size: 15.5px;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 3px 12px rgba(59, 130, 246, 0.25);
}

.alert-close-btn:hover,
.alert-close-btn:focus {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 5px 16px rgba(59, 130, 246, 0.35);
    outline: none;
}

/* Error state - still light theme, just slightly more noticeable */
.alert-modal.error .alert-icon {
    background: #fef2f2;
    color: #ef4444;
    border-color: #fecaca;
}

.alert-modal.error .alert-modal-content {
    border-color: #fecaca;
}

/* Loader (unchanged) */
.btn-loader {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideDown {
    from {
        transform: translateY(-40px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>