import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Intersection Observer for scroll animations
document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.12,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.anim-bounce').forEach(el => observer.observe(el));
});
