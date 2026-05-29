// Scroll animations - play once only
(function () {
    'use strict';

    function initScrollAnimations() {
        var elements = document.querySelectorAll('.scrollanimation, .wow');
        if (!elements.length) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var delay = el.getAttribute('data-wow-delay') || el.getAttribute('data-delay') || '0s';

                    el.style.animationDelay = delay;

                    // Reset animation so it plays fresh when revealed
                    var animName = el.style.animationName;
                    el.style.animationName = 'none';
                    el.offsetHeight; // force reflow

                    el.style.animationName = animName || '';
                    el.style.visibility = 'visible';

                    if (el.classList.contains('wow')) {
                        el.classList.add('animated');
                    } else {
                        el.classList.add('visible');
                    }

                    // Unobserve so this element never re-animates
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });

        elements.forEach(function (el) {
            el.style.visibility = 'hidden';
            observer.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initScrollAnimations);
    } else {
        initScrollAnimations();
    }
})();
