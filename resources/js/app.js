import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// After a search redirects to /#event-list, smoothly settle the scroll
// position on the results section (accounting for the sticky navbar height)
// instead of the browser's default instant jump.
window.addEventListener('load', () => {
    if (window.location.hash === '#event-list') {
        const target = document.getElementById('event-list');
        if (target) {
            requestAnimationFrame(() => {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }
    }
});
