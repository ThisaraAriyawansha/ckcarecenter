<!-- Exit-Intent Popup Modal -->

<link rel="stylesheet" href="{{ asset('css/frontend/exit-popup.css') }}">
<script defer src="{{ asset('js/frontend/exit-popup.js') }}"></script>

<div id="exit-popup" class="exit-popup">
  <div class="exit-popup__inner">
    <!-- Close Button -->
    <button type="button" class="exit-popup__close" aria-label="Close">&times;</button>

    <h2>Not Sure Which Care Option Is Right?</h2>
    <p>Get our free Elder Care Planning Guide</p>

    <!-- Lead Form -->
    <form id="guide-form" method="POST" action="{{ route('exit-popup.submit') }}">
      @csrf

      <input type="text" name="name" class="popup-input" placeholder="Name" required aria-label="Name">
      <input type="email" name="email" class="popup-input" placeholder="Email" required aria-label="Email">
      <input type="tel" name="phone" class="popup-input" placeholder="Phone" required aria-label="Phone">
      <input type="number" name="age" class="popup-input" placeholder="Senior's Age" min="60" max="120" required aria-label="Age">

      <select name="care_type" class="popup-input popup-select" required aria-label="Care Type">
        <option value="">Care Type</option>
        <option value="companion">Companion Care</option>
        <option value="shared">Shared Comfort</option>
        <option value="private">Private Heaven</option>
        <option value="dementia">Dementia/Specialized</option>
        <option value="other">Not Sure</option>
      </select>

      <select name="timeline" class="popup-input popup-select" required aria-label="Timeline">
        <option value="">Timeline</option>
        <option value="immediate">Immediately</option>
        <option value="1-3">1–3 months</option>
        <option value="3-6">3–6 months</option>
        <option value="planning">Just planning</option>
      </select>

      <button type="submit" class="popup-btn">Get the Free Guide</button>
    </form>

    <p class="privacy-notice">Your information is secure and private</p>
  </div>
</div>

<!-- Notification Container -->
<div id="notification-container"></div>