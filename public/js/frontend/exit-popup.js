// Custom notification
function showNotification(message, type = 'error') {
  const container = document.getElementById('notification-container');
  if (!container) return;

  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  
  const icon = type === 'success' ? '✓' : '✕';
  const bg = type === 'success' ? '#EFF6FF' : '#fef2f2';
  const color = type === 'success' ? '#2B6CB0' : '#ef4444';

  notification.innerHTML = `
    <div class="notification__icon" style="background:${bg};color:${color}">${icon}</div>
    <div class="notification__text">${message}</div>
  `;

  container.appendChild(notification);

  setTimeout(() => {
    notification.style.animation = 'slideOut 0.3s ease-in';
    setTimeout(() => notification.remove(), 300);
  }, 4000);
}

// Main logic (lazy init)
let popupInitialized = false;
let popupShown = false;
const sessionKey = 'exitPopupShown';

function initExitPopup() {
  if (popupInitialized) return;
  popupInitialized = true;

  const modal = document.getElementById('exit-popup');
  if (!modal) return;

  const form = document.getElementById('guide-form');
  if (sessionStorage.getItem(sessionKey)) return;

  // Exit intent (desktop)
  document.addEventListener('mouseout', (e) => {
    if (e.clientY < 10 && !popupShown) {
      setTimeout(showPopup, 100);
    }
  }, { passive: true });

  // Mobile scroll up trigger
  let lastScroll = 0;
  let scrollUpCount = 0;
  window.addEventListener('scroll', () => {
    if (popupShown) return;
    const scroll = window.pageYOffset || document.documentElement.scrollTop;
    if (scroll < lastScroll && scroll < 200) {
      scrollUpCount++;
      if (scrollUpCount > 3) showPopup();
    } else {
      scrollUpCount = 0;
    }
    lastScroll = scroll;
  }, { passive: true });

  function showPopup() {
    if (popupShown) return;
    modal.style.display = 'flex';
    popupShown = true;
    sessionStorage.setItem(sessionKey, 'true');

    setTimeout(() => {
      const input = modal.querySelector('input[name="name"]');
      if (input) input.focus();
    }, 300);
  }

  // Close handlers
  modal.addEventListener('click', (e) => {
    if (e.target === modal) modal.style.display = 'none';
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.style.display === 'flex') {
      modal.style.display = 'none';
    }
  });

  document.querySelector('.exit-popup__close')?.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // Form submit (AJAX)
  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Sending...';
      submitBtn.disabled = true;
      submitBtn.style.opacity = '0.6';

      try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });

        const data = await response.json();

        if (response.ok && data.success) {
          showNotification('Guide sent! Check your inbox', 'success');
          form.reset();
          setTimeout(() => modal.style.display = 'none', 2000);
        } else {
          showNotification(data.message || 'Something went wrong. Please try again.', 'error');
        }
      } catch (err) {
        console.error(err);
        showNotification('Unable to submit. Please try again.', 'error');
      } finally {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
      }
    });
  }
}

// Start listening only after first interaction (big perf win)
document.addEventListener('mousemove', initExitPopup, { once: true, passive: true });
document.addEventListener('scroll', initExitPopup, { once: true, passive: true });