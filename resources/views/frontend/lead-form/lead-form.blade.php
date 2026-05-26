<style>
    /* ── Lead Form Hero Section ── */
    .lf-hero {
        background: linear-gradient(135deg, #0A3F87 0%, #1a5bb5 100%);
        padding: 120px 0 60px;
        text-align: center;
        color: #fff;
    }

    .lf-hero h1 {
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
        color: #ffffff;
    }

    .lf-hero p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        max-width: 520px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ── Form Section ── */
    .lf-section {
        background: #f8fafc;
        padding: 80px 0 100px;
    }

    .lf-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        gap: 50px;
        align-items: flex-start;
        padding: 0 20px;
    }

    /* Left info panel */
    .lf-info {
        flex: 1;
        padding-top: 10px;
    }

    .lf-info h2 {
        font-size: 28px;
        font-weight: 700;
        color: #0A3F87;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .lf-info p {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.7;
        margin-bottom: 32px;
    }

    .lf-features {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .lf-features li {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 22px;
        font-size: 15px;
        color: #374151;
        line-height: 1.5;
    }

    .lf-features li .lf-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        background: rgba(10, 63, 135, 0.08);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lf-features li .lf-icon svg {
        width: 20px;
        height: 20px;
        stroke: #0A3F87;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .lf-features li strong {
        display: block;
        color: #1a1a2e;
        font-weight: 600;
        margin-bottom: 2px;
    }

    /* Right form card */
    .lf-card {
        flex: 1;
        max-width: 500px;
        background: #ffffff;
        border-radius: 16px;
        padding: 44px 40px;
        box-shadow: 0 8px 40px rgba(10, 63, 135, 0.08);
        border: 1px solid rgba(10, 63, 135, 0.06);
        position: relative;
        margin-top: -120px;
    }

    .lf-card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .lf-card-sub {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 28px;
    }

    /* Form fields */
    .lf-field {
        margin-bottom: 20px;
    }

    .lf-field label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
        letter-spacing: 0.2px;
    }

    .lf-field input,
    .lf-field select {
        width: 100%;
        padding: 13px 16px;
        font-size: 14px;
        font-family: inherit;
        color: #1f2937;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        outline: none;
        transition: all 0.25s ease;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .lf-field select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
        cursor: pointer;
        color: #6b7280;
    }

    .lf-field select:valid {
        color: #1f2937;
    }

    .lf-field input:focus,
    .lf-field select:focus {
        border-color: #48b1fb;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(72, 177, 251, 0.12);
    }

    .lf-field input::placeholder {
        color: #b0b7c3;
    }

    .lf-row {
        display: flex;
        gap: 14px;
    }

    .lf-row .lf-field {
        flex: 1;
    }

    /* Submit button */
    .lf-btn {
        width: 100%;
        padding: 15px;
        font-size: 15px;
        font-weight: 600;
        font-family: inherit;
        letter-spacing: 0.3px;
        color: #ffffff;
        background: #0A3F87;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-top: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(10, 63, 135, 0.25);
        position: relative;
        overflow: hidden;
    }

    .lf-btn:hover {
        background: #48b1fb;
        box-shadow: 0 6px 20px rgba(72, 177, 251, 0.35);
        transform: translateY(-1px);
    }

    .lf-btn:active {
        transform: translateY(0);
    }

    .lf-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .lf-btn .btn-text { display: inline; }
    .lf-btn .btn-loader { display: none; align-items: center; justify-content: center; gap: 8px; }

    .lf-btn:disabled .btn-text { display: none; }
    .lf-btn:disabled .btn-loader { display: inline-flex; }

    .lf-secure {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 14px;
        font-size: 12px;
        color: #9ca3af;
    }

    .lf-secure svg {
        width: 14px;
        height: 14px;
        stroke: #9ca3af;
        fill: none;
        stroke-width: 2;
    }

    /* Messages */
    .lf-msg {
        padding: 14px 16px;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
        display: none;
        line-height: 1.5;
    }

    .lf-msg.success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .lf-msg.error {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .lf-field-error {
        font-size: 12px;
        color: #dc2626;
        margin-top: 5px;
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
        .lf-wrapper {
            flex-direction: column;
            max-width: 540px;
        }

        .lf-card {
            max-width: 100%;
            margin-top: 0;
        }

        .lf-info {
            text-align: center;
        }

        .lf-features li {
            justify-content: center;
            text-align: left;
        }

        .lf-hero h1 {
            font-size: 30px;
        }
    }

    @media (max-width: 540px) {
        .lf-hero {
            padding: 80px 20px 50px;
        }

        .lf-hero h1 {
            font-size: 26px;
        }

        .lf-section {
            padding: 50px 0 70px;
        }

        .lf-card {
            padding: 32px 24px;
        }

        .lf-row {
            flex-direction: column;
            gap: 0;
        }

        .lf-info h2 {
            font-size: 22px;
        }
    }
</style>

{{-- ── Hero Banner ── --}}
<section class="lf-hero">
    <div class="container">
        <h1>Find the Right Care for Your Loved One</h1>
        <p>Fill out a quick enquiry and our care specialists will reach out with a personalised plan.</p>
    </div>
</section>

{{-- ── Form + Info Section ── --}}
<section class="lf-section">
    <div class="lf-wrapper">

        {{-- Left: Info --}}
        <div class="lf-info">
            <h2>Why Families Choose Care&nbsp;365</h2>
            <p>We provide compassionate, personalised elder care in a safe and luxurious environment across Sri&nbsp;Lanka.</p>

            <ul class="lf-features">
                <li>
                    <span class="lf-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    </span>
                    <div>
                        <strong>24 / 7 Medical Support</strong>
                        Round-the-clock professional healthcare monitoring.
                    </div>
                </li>
                <li>
                    <span class="lf-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </span>
                    <div>
                        <strong>Home-Like Environment</strong>
                        Comfortable, welcoming spaces designed for seniors.
                    </div>
                </li>
                <li>
                    <span class="lf-icon">
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    <div>
                        <strong>Tailored Care Plans</strong>
                        Every resident receives an individually crafted care programme.
                    </div>
                </li>
                <li>
                    <span class="lf-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </span>
                    <div>
                        <strong>Engaging Activities</strong>
                        Daily social, recreational &amp; spiritual programmes.
                    </div>
                </li>
            </ul>
        </div>

        {{-- Right: Form Card --}}    

        <div class="lf-card">
            <div class="lf-card-title">Not Sure Which Care Option Is Right?</div>
            <div class="lf-card-sub">Get our free Elder Care Planning Guide</div>

            <div class="lf-msg" id="leadMsg"></div>

            <form id="leadForm" novalidate>
                <div class="lf-field">
                    <label for="leadName">Full Name</label>
                    <input type="text" id="leadName" name="name" placeholder="e.g. Kamal Perera" required>
                    <div class="lf-field-error" id="err-name"></div>
                </div>

                <div class="lf-row">
                    <div class="lf-field">
                        <label for="leadEmail">Email Address</label>
                        <input type="email" id="leadEmail" name="email" placeholder="you@email.com" required>
                        <div class="lf-field-error" id="err-email"></div>
                    </div>
                    <div class="lf-field">
                        <label for="leadPhone">Phone Number</label>
                        <input type="tel" id="leadPhone" name="phone" placeholder="07X XXX XXXX" required>
                        <div class="lf-field-error" id="err-phone"></div>
                    </div>
                </div>

                <div class="lf-row">
                    <div class="lf-field">
                        <label for="leadAge">Resident's Age</label>
                        <input type="number" id="leadAge" name="age" placeholder="Age" min="60" max="120" required>
                        <div class="lf-field-error" id="err-age"></div>
                    </div>
                    <div class="lf-field">
                        <label for="leadCare">Care Type</label>
                        <select id="leadCare" name="care_type" required>
                            <option value="" disabled selected hidden>Select care type</option>
                            <option value="companion">Companion Care</option>
                            <option value="shared">Shared Comfort</option>
                            <option value="private">Private Heaven</option>
                            <option value="dementia">Dementia / Specialized</option>
                            <option value="other">Not Sure</option>
                        </select>
                        <div class="lf-field-error" id="err-care_type"></div>
                    </div>
                </div>

                <div class="lf-field">
                    <label for="leadTimeline">When Do You Need Care?</label>
                    <select id="leadTimeline" name="timeline" required>
                        <option value="" disabled selected hidden>Select timeline</option>
                        <option value="immediate">Immediately</option>
                        <option value="1-3">1 – 3 months</option>
                        <option value="3-6">3 – 6 months</option>
                        <option value="planning">Just planning ahead</option>
                    </select>
                    <div class="lf-field-error" id="err-timeline"></div>
                </div>

                <button type="submit" class="lf-btn" id="leadBtn">
                    <span class="btn-text">Get My Free Care Plan</span>
                    <span class="btn-loader">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" opacity="0.25"/>
                            <path d="M12 2a10 10 0 0 1 10 10" opacity="0.75">
                                <animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="0.8s" repeatCount="indefinite"/>
                            </path>
                        </svg>
                        Submitting…
                    </span>
                </button>

                <div class="lf-secure">
                    <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Your information is secure and will never be shared.
                </div>
            </form>
        </div>

    </div>
</section>

<script>
document.getElementById('leadForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Clear errors
    document.querySelectorAll('.lf-field-error').forEach(function(el) { el.textContent = ''; });
    var msg = document.getElementById('leadMsg');
    msg.style.display = 'none';

    var btn = document.getElementById('leadBtn');
    btn.disabled = true;

    var params = new URLSearchParams(new FormData(this)).toString();

    fetch("{{ route('lead-form.submit') }}?" + params, {
        method: 'GET',
        headers: { 'Accept': 'application/json' }
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data.success) {
            msg.className = 'lf-msg success';
            msg.textContent = data.message;
            msg.style.display = 'block';
            document.getElementById('leadForm').reset();
        } else if (data.errors) {
            Object.keys(data.errors).forEach(function(field) {
                var errEl = document.getElementById('err-' + field);
                if (errEl) errEl.textContent = data.errors[field][0];
            });
        } else {
            msg.className = 'lf-msg error';
            msg.textContent = data.message || 'Something went wrong. Please try again.';
            msg.style.display = 'block';
        }
    })
    .catch(function() {
        msg.className = 'lf-msg error';
        msg.textContent = 'Network error. Please try again.';
        msg.style.display = 'block';
    })
    .finally(function() {
        btn.disabled = false;
    });
});
</script>
